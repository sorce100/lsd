<?php
	require_once("../Classes/UserPayment.php"); 
	require_once("../Classes/UserBalance.php"); 
	require_once("../Classes/WalletHistory.php"); 
	session_start();
	class UserPaymentControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objUserPayment = new UserPayment;
							$objUserPayment->set_paymentSurveyor($objUserPayment->CleanData(strtoupper($_POST["paymentSurveyor"])));
							$objUserPayment->set_paymentPurpose($objUserPayment->CleanData(strtoupper($_POST["paymentPurpose"])));
							$objUserPayment->set_paymentAmount($objUserPayment->CleanData($_POST["paymentAmount"]));
							$objUserPayment->set_userId($_SESSION['user_id']);
							
							if ($objUserPayment->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objUserPayment = new UserPayment;
							$objUserPayment->set_paymentSurveyor($objUserPayment->CleanData(strtoupper($_POST["paymentSurveyor"])));
							$objUserPayment->set_paymentPurpose($objUserPayment->CleanData(strtoupper($_POST["paymentPurpose"])));
							$objUserPayment->set_paymentAmount($objUserPayment->CleanData($_POST["paymentAmount"]));
							$objUserPayment->set_id($objUserPayment->CleanData($_POST["data_id"]));
							if ($objUserPayment->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objUserPayment = new UserPayment;
								      $objUserPayment->set_id($objUserPayment->CleanData($_POST["data_id"]));
								      $objUserPayment->set_recordHide($objUserPayment->CleanData("YES"));
								      if ($objUserPayment->delete()) {
								      	return true;
								      }
								      else{
								      	return false;
								      }
								     
								 }else{die();}
						break;
						// geting details of a member with id
						case 'updateModal':
							if(isset($_POST["data_id"])){
									 $objUserPayment = new UserPayment;  
								      $objUserPayment->set_id($objUserPayment->CleanData($_POST["data_id"]));
								      $UserPayment_details = $objUserPayment->get_user_payments_id();
								      print_r($UserPayment_details);  
								 }else{die();}
						break;

						// for making payment of dues Set for 
						case 'make_payment':
							if(isset($_POST["paymentAmount"])){
									// checking balance if there is enough to make payment
									 $objUserBalance = new UserBalance;
									 $getBalance = $objUserBalance->get_balance();
									 if (trim($getBalance["current_balance"]) > trim($_POST["paymentAmount"])) {
									 		// if there is enough balance then set the properties of the class
									 		$objUserBalance->set_reason($objUserBalance->CleanData($_POST["paymentReason"]));
									 		$objUserBalance->set_type($objUserBalance->CleanData("DEBIT"));
									 		$objUserBalance->set_purpose($objUserBalance->CleanData("DUES"));
									 		$objUserBalance->set_pay_amount($objUserBalance->CleanData($_POST["paymentAmount"]));
									 		$objUserBalance->set_balance(trim($getBalance["current_balance"]) - trim($_POST["paymentAmount"]));
											$objUserBalance->set_member_id($_SESSION['member_id']);

									  		if ($objUserBalance->wallet_save()) {
									  			echo "Succcessful, Payment done successfully";
									  		}else{return false;}
									 }else{echo "Sorry, insufficient Balance in your wallet";} 	
								     
								 }else{die();}
						break;

						// getting the contribution history
						case 'getHistory':
							$objWalletHistory = new WalletHistory;
							$objWalletHistory->set_member_id($_SESSION['member_id']);
							$objWalletHistory->set_purpose(trim("DUES"));
							$historyDetails = $objWalletHistory->get_walletHistory_byId();
							print_r($historyDetails);
							
							break;


						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objUserPaymentControl = new UserPaymentControl;
 ?>