<?php 
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;

	$app->add(new \Slim\Middleware\HttpBasicAuthentication([
	    "path" => ["/memberCheckTest", "/creditAccountTest", "/debitAccountTest"],
	    "realm" => "Protected",
	    "users" => [
	        "NIB" => "#-BU&q6nI",
	        "ghislsdapi" => "apiTest@123"
	    ],
	    "error" => function ($request, $response,$arguments) use ($app) {
	    	header('Content-Type:application/json');
	    	$returnData = $response->withJson(array('message' => 'Unauthorized','code' => '401'),401);
	    	return $returnData;
	    }
	]));
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// clean data
	function cleandata($data){
		$data=htmlentities(trim($data),ENT_QUOTES, 'UTF-8');
		$data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
		return trim($data);
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// member check
	function memberCheck($diplomaNum){
		// get the db object
		$db = new db();
		$db= $db->connect();
    	// query to make request
    	$sql="SELECT members_id FROM members WHERE professional_number=:profNum";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":profNum",$diplomaNum);
		if ($stmt->execute()) {
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// for saving headers
	function headerSave($headers,$diplomaNum,$response,$httpMethod,$requestType){
		date_default_timezone_set('Africa/Accra');
		$db = new db();
		$db= $db->connect();
		$sql = "INSERT INTO api_request (api_headers,http_method,request_type,api_headers_time,diploma_number,api_response,api_response_time) VALUES (:apiHeaders,:httpMethod,:requestType,:apiHeadersTime,:diplomaNum,:apiResponse,:apiResponseTime)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":apiHeaders",json_encode($headers));
		$stmt->bindParam(":httpMethod",$httpMethod);
		$stmt->bindParam(":requestType",$requestType);
		$stmt->bindParam(":apiHeadersTime",date("j-F-Y h:i:s A"));
		$stmt->bindParam(":diplomaNum",$diplomaNum);
		$stmt->bindParam(":apiResponse",$response);
		$stmt->bindParam(":apiResponseTime",date("j-F-Y h:i:s A"));
		$stmt->execute();
		$stmt = null;
		$db = null;
	}

	////////////////////////////////////////////
		////////CHECKING MEMBER ID
	////////////////////////////////////////////

	$app->get('/memberCheckTest/{diplomaNum}', function (Request $request, Response $response, array $args) {
	    $diplomaNum = cleandata($args['diplomaNum']);
	    // save request headers into database
	    // headerSave($request->getHeaders(),$diplomaNum);
	    try {
	    	$results = memberCheck($diplomaNum);
			if ($results) {
				// check if results is just one  then its successful , if not then the results has more than one diploma number
				if (sizeof($results)==1) {
					// response
					header('Content-Type:application/json');
					$returnData = $response->withJson(array('message' => 'Successful','diplomaNumber'=>$diplomaNum,'code' => '200'),200);
					headerSave($request->getHeaders(),$diplomaNum,$returnData,$request->getMethod(),"SEARCH");
					return $returnData;
				}
				elseif (sizeof($results)>1) {
					// response
					header('Content-Type:application/json');
					$returnData = $response->withJson(array('message' => 'Internal Server Error','code' => '500'),500);
					headerSave($request->getHeaders(),$diplomaNum,$returnData,$request->getMethod(),"SEARCH");
					return $returnData;
				}
				elseif (sizeof($results)==0) {
					// response
					header('Content-Type:application/json');
					$returnData = $response->withJson(array('message' => 'Not Found','code' => '404'),404);
					headerSave($request->getHeaders(),$diplomaNum,$returnData,$request->getMethod(),"SEARCH");
					return $returnData;
				}
				
			}
			else{
				header('Content-Type:application/json');
				$returnData = $response->withJson(array('message' => 'Bad Request','code' => '400'),400);
				headerSave($request->getHeaders(),$diplomaNum,$returnData,$request->getMethod(),"SEARCH");
					return $returnData;
			}
	    	
	    	// close connections
			$stmt = null;
			$db = null;
	    } catch (Exception $e) {
	    	die();
	    	echo '{"error":{"text": '.$e->getMessage().'}';
	    }
	});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////// CREDITING 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$app->post('/creditAccountTest/{diplomaNum}', function (Request $request, Response $response, array $args) {
		$receiveddata = $request->getBody();
		$diplomaNum = cleandata($args['diplomaNum']);
		// check if diploma number passed is in dp
		$results = memberCheck($diplomaNum);
		if ((sizeof($results)>1) || (sizeof($results)==0)) {
			header('Content-Type:application/json');
			$returnData = $response->withJson(array('message' => 'Not Found','code' => '404'),404);
			return $returnData;
			
		}

     	$jsonObj =json_decode($receiveddata, true);
     	if ((!isset($jsonObj["amount"])) || (!isset($jsonObj["transaction_id"]))) {
     		header('Content-Type:application/json');
			$returnData = $response->withJson(array('message' => 'Bad Request','code' => '400'),400);
			return $returnData;
			exit();
     	}
     	// check for unique transaction is empty then you can debit account else echo error
     	if (check_transaction_number($jsonObj["transaction_id"])) {
	     	 	try {
	     	 		// get the db object
					$db = new db();
					$db= $db->connect();

					$requestType="CREDIT";
					$amountDebited="NO";
					$date = date("j-F-Y h:i:s A");
			    	// query to make request
			    	$sql = "INSERT INTO api_request (http_method,request_type,api_headers,transaction_id,credit_amount,api_headers_time,api_response,api_response_time,diploma_number,amount_debited) VALUES (:httpMethod,:requestType,:apiHeaders,:transactionId,:creditAmount,:apiHeadersTime,:apiResponse,:apiResponseTime,:diplomaNumber,:amountDebited)";
	     	 		$stmt = $db->prepare($sql);
	     	 		$stmt->bindParam(":httpMethod",$request->getMethod());
	     	 		$stmt->bindParam(":requestType",$requestType);
	     	 		$stmt->bindParam(":apiHeaders",json_encode($request->getHeaders()));
	     	 		$stmt->bindParam(":transactionId",$jsonObj["transaction_id"]);
	     	 		$stmt->bindParam(":creditAmount",$jsonObj["amount"]);
	     	 		$stmt->bindParam(":apiHeadersTime",$date);
	     	 		$stmt->bindParam(":apiResponse",$receiveddata);
	     	 		$stmt->bindParam(":apiResponseTime",$date);
	     	 		$stmt->bindParam(":diplomaNumber",$diplomaNum);
	     	 		$stmt->bindParam(":amountDebited",$amountDebited);
	     	 		if ($stmt->execute()) {
	     	 			header('Content-Type:application/json');
						$returnData = $response->withJson(array('message' => 'Account Credit Successful','code' => '200'),200);
						// update user account and wallet 
						member_wallet_account_update($diplomaNum,$jsonObj["amount"],$requestType);

						return $returnData;
	     	 		}
					else{
						header('Content-Type:application/json');
						$returnData = $response->withJson(array('message' => 'Bad Request','code' => '400'),400);
						return $returnData;
					}
					$stmt = null;
					$db = null;
		     	 } catch (Exception $e) {
			     	 	die();
				    	echo '{"error":{"text": '.$e->getMessage().'}';
			     	 }
		  }
     	else{
     		// if transaction id is not unique then echo bad request
     		header('Content-Type:application/json');
			$returnData = $response->withJson(array('message' => 'Bad Request','code' => '400'),400);
			return $returnData;
     	}
	});

////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////// DEDBITING 
////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$app->post('/debitAccountTest/{diplomaNum}', function (Request $request, Response $response, array $args) {
		$receiveddata = $request->getBody();
		$diplomaNum = cleandata($args['diplomaNum']);
		// check if diploma number passed is in dp
		$results = memberCheck($diplomaNum);
		if ((sizeof($results)>1) || (sizeof($results)==0)) {
			header('Content-Type:application/json');
			$returnData = $response->withJson(array('message' => 'Not Found','code' => '404'),404);
			return $returnData;
			exit();
		}

     	$jsonObj =json_decode($receiveddata, true);
     	if ((!isset($jsonObj["amount"])) || (!isset($jsonObj["transaction_id"])) || (!isset($jsonObj["credit_transaction_id"]))) {
     		header('Content-Type:application/json');
			$returnData = $response->withJson(array('message' => 'Bad Request','code' => '400'),400);
			return $returnData;
			exit();
     	}
     	// check for unique transaction is empty then you can debit account else echo error
     	if (check_transaction_number($jsonObj["transaction_id"])) {
     		// check if amount credited is same as amount debited
     			if (check_credit_debit_amount($jsonObj["credit_transaction_id"],$jsonObj["amount"])) {
		     		try {// get the db object
						$db = new db();
						$db= $db->connect();

						$requestType="DEBIT";
						$date = date("j-F-Y h:i:s A"); 
				    	// query to make request
				    	$sql = "INSERT INTO api_request (http_method,request_type,api_headers,transaction_id,debit_amount,api_headers_time,api_response,api_response_time,diploma_number) VALUES (:httpMethod,:requestType,:apiHeaders,:transactionId,:debitAmount,:apiHeadersTime,:apiResponse,:apiResponseTime,:diplomaNumber)";
		     	 		$stmt = $db->prepare($sql);
		     	 		$stmt->bindParam(":httpMethod",$request->getMethod());
		     	 		$stmt->bindParam(":requestType",$requestType);
		     	 		$stmt->bindParam(":apiHeaders",json_encode($request->getHeaders()));
		     	 		$stmt->bindParam(":transactionId",$jsonObj["transaction_id"]);
		     	 		$stmt->bindParam(":debitAmount",$jsonObj["amount"]);
		     	 		$stmt->bindParam(":apiHeadersTime",$date);
		     	 		$stmt->bindParam(":apiResponse",$receiveddata);
		     	 		$stmt->bindParam(":apiResponseTime",$date);
		     	 		$stmt->bindParam(":diplomaNumber",$diplomaNum);

		     	 		if ($stmt->execute()) {
		     	 			// update user account and wallet 
							member_wallet_account_update($diplomaNum,$jsonObj["amount"],$requestType);
							// update transaction debit to YES when debit is successful so it cannot be debited again
							update_transaction_debit($jsonObj["credit_transaction_id"]);
							////////////////////////////////////////////////////////////////////////////////////////
		     	 			header('Content-Type:application/json');
							$returnData = $response->withJson(array('message' => 'Account Debit Successful','code' => '200'),200);
							return $returnData;
		     	 		}
						else{
							header('Content-Type:application/json');
							$returnData = $response->withJson(array('message' => 'Bad Request','code' => '400'),400);
							return $returnData;
						}
						$stmt = null;
						$db = null;
			     	 } catch (Exception $e) {
			     	 	die();
				    	echo '{"error":{"text": '.$e->getMessage().'}';
			     	 }
			    }
			    else{
			    	// if the debit amount is not he same as credit amountss
			    	header('Content-Type:application/json');
					$returnData = $response->withJson(array('message' => 'Conflict','code' => '409'),409);
					return $returnData;
			    }
     	
     	}else{
     		// if transaction id is not unique then echo bad request
     		header('Content-Type:application/json');
			$returnData = $response->withJson(array('message' => 'Bad Request','code' => '400'),400);
			return $returnData;
     	}

     	 
	});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// check unique transaction number
	function check_transaction_number($transactionId){
		// get the db object
		$db = new db();
		$db= $db->connect();
    	// query to make request
    	$sql="SELECT * FROM api_request WHERE transaction_id=:transactId";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":transactId",$transactionId);
		if ($stmt->execute()) {
			$results = sizeof($stmt->fetchAll(PDO::FETCH_ASSOC));
			// if transaction size is one or more than one then return false
			if (($results==1) || ($results>1)) {
				return false;
			}
			elseif ($results==0) {
				return true;
			}
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// check unique transaction number
	function check_credit_debit_amount($creditTransactionId,$debitAmt){
		$type="CREDIT";
		$amountdebited="NO";
		// get the db object
		$db = new db();
		$db= $db->connect();
    	// query to make request
    	$sql="SELECT credit_amount FROM api_request WHERE request_type=:requestType AND transaction_id=:transactId AND amount_debited=:amountDebited";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":requestType",$type);
		$stmt->bindParam(":transactId",$creditTransactionId);
		$stmt->bindParam(":amountDebited",$amountdebited);
		if ($stmt->execute()) {
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
			// if transaction size is one or more than one then return false
			if ((!empty($results)) && (sizeof($results == 1))) {
				// check to see if debit amount and initial credit amount is the same
				if (trim($results['credit_amount']) == $debitAmt) {
					return true;
				}
			}
			else {
				return false;
			}
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// update transaction number when transaction is debited

	function update_transaction_debit($creditTransactionId){
		$amountdebited="YES";
		$date = date("j-F-Y h:i:s A"); 
		// get the db object
		$db = new db();
		$db= $db->connect();
    	// query to make request
    	$sql ="UPDATE api_request SET amount_debited=:amountDebited,date_amount_debited=:dateAmountDebited WHERE transaction_id=:transactId";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":amountDebited",$amountdebited);
		$stmt->bindParam(":dateAmountDebited",$date);
		$stmt->bindParam(":transactId",$creditTransactionId);
		$stmt->execute();
	}




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// credit and debit member wallet account with credit or debit when api call is successfull
	function member_wallet_account_update($diplomaNum,$amount,$type){
		// get the db object
		$db = new db();
		$db= $db->connect();
    	// query to make request
    	$sql="SELECT current_balance FROM members WHERE professional_number=:profNum";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":profNum",$diplomaNum);
		if ($stmt->execute()) {
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
			// if its credit then add to returned balance
			if ($type == "CREDIT") {
				$currentBalance = trim($results["current_balance"])+$amount;
			}
			elseif ($type == "DEBIT") {
				$currentBalance = trim($results["current_balance"])-$amount;
			}

			// not update mmeber account with the new balance
			$updateSql ="UPDATE members SET current_balance=:currentBal WHERE professional_number=:profNum";
			$updatestmt = $db->prepare($updateSql);
			$updatestmt->bindParam(":currentBal",$currentBalance);
			$updatestmt->bindParam(":profNum",$diplomaNum);
			$updatestmt->execute();
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			// update user wallet account
			$walletSql = "INSERT INTO wallet_history (member_id,type,purpose,reason,amount_payed,balance) VALUES (:memberId,:type,:purpose,:reason,:amountPayed,:balance)";
			$walletstmt = $db->prepare($walletSql);
			$walletstmt->bindParam(":memberId",$diplomaNum);
			$walletstmt->bindParam(":type",$type);
			$walletstmt->bindParam(":purpose",$type);
			$walletstmt->bindParam(":reason",$type);
			$walletstmt->bindParam(":amountPayed",$amount);
			$walletstmt->bindParam(":balance",$currentBalance);
			$walletstmt->execute();
		}
	}

?>