<?php 
	require_once("db/db.php");
	class Sms{
		// setting and getting variables
		private $id; 
		private $userId;
		private $dbConn;
		private $table= "sms";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_userId($userId) { $this->userId = $userId; }
		function get_userId() { return $this->userId; }

		public function __construct(){
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

		// clean data for data input
		public function CleanData($data){
			$data = trim($data);
			$data=htmlentities($data,ENT_QUOTES, 'UTF-8');
			$data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
			return $data;
		}

		// insert pages
		public function send_sms($smsDestination,$smsMessage){
			$smsDestination = explode('/', $smsDestination);

			$url ="http://206.225.81.36/ucm_api/index.php"; 
            $request_id = "UCM _" . preg_replace('/\D/', '', date('Y-m-d H:i:s'));
            $smsReference = date('Y-m-d H:i:s');
            $data = [  
                'reference' => $smsReference, // your own reference
                'message_type' => "1",
                'message' => $smsMessage, 
                'user_id' => "313", 
                'app_id' => "600157", 
                'org_id' => "139", 
                'src_address' => 'GHIS LSD', //not more than 11 characters
                'dst_address' => $smsDestination[0],
                'service_id' => "", 
                'operation' => "send", 
                'timestamp' => preg_replace('/\D/', '', date("YYYYmmddHHiiss")), 
                'auth_key' => md5(600157 . date("YYYYmmddHHiiss") . "!QAZ2wsx*") 
            ];
            	$curl = curl_init($url); 
              	curl_setopt($curl, CURLOPT_HEADER, false); 
            	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            	curl_setopt($curl, CURLOPT_POST, true); 
            	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                $ucm_response = curl_exec($curl);

                if ($ucm_response) {
                	// $ucm_response = "'".$ucm_response."'";
                	$response = json_decode($ucm_response,true);

                	$sql = "INSERT INTO $this->table (sms_message,user_id,sms_destination,division) VALUES (:smsMessage,:userId,:smsDestination,:division)";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":smsMessage",$ucm_response);
					// $stmt->bindParam(":smsDestination",$smsDestination[0]);
					// $stmt->bindParam(":division",$_SESSION["division"]);
					$stmt->bindParam(":userId",$_SESSION["user_id"]);
					$stmt->bindParam(":smsDestination",$smsDestination[0]);
					$stmt->bindParam(":division",$_SESSION["division"]);
					if ($stmt->execute()) {
						return true;
					}
					else{
						die();
						}
                }

		}

	}

 ?>