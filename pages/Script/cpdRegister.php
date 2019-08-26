<?php
	require_once("../Classes/CpdRegister.php"); 
	require_once("../Classes/UserBalance.php");
	require_once("../Classes/WalletHistory.php"); 
	session_start();
	class CpdRegisterControl{
		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// when member make contribution
						case 'cpdRegister':
							if(isset($_POST["cpdRegisterAmt"])){
									// checking balance if there is enough to make payment
									 $objUserBalance = new UserBalance;
									 $getBalance = $objUserBalance->get_balance();
									 if (trim($getBalance["current_balance"]) > trim($_POST["cpdRegisterAmt"])) {
									 		// if there is enough balance then set the properties of the class
									 		$objUserBalance->set_reason('CPD REGISTRATION');
									 		$objUserBalance->set_type($objUserBalance->CleanData("DEBIT"));
									 		$objUserBalance->set_purpose($objUserBalance->CleanData("CPD"));
									 		$objUserBalance->set_pay_amount($objUserBalance->CleanData($_POST["cpdRegisterAmt"]));
									 		$objUserBalance->set_balance(trim($getBalance["current_balance"]) - trim($_POST["cpdRegisterAmt"]));
											$objUserBalance->set_member_id($_SESSION['member_id']);

									  		if ($objUserBalance->wallet_save()) {
									  			// now send to the contribution register table
									  			 $objCpdRegister = new CpdRegister;
									  			 $objCpdRegister->set_cpdId($objCpdRegister->CleanData($_POST["cpdId"]));
									  			 $objCpdRegister->set_cpdRegisterAmt($objCpdRegister->CleanData($_POST["cpdRegisterAmt"]));
									  			 if ($objCpdRegister->member_cpd_register()) {
									  			 	echo "Successfully Registered";
									  			 }
									  			
									  			// error returned while saving into the wallet history
									  		}else{return false;}
									  	}else{echo "insufficient_Balance";}	
								     
								 }else{die();}
						break;
						// geting details 
						case 'updateModal':
							if(isset($_POST["data_id"])){
								 $objCpdRegister = new CpdRegister;
							      $objCpdRegister->set_id($objCpdRegister->CleanData($_POST["data_id"]));
							      $details = $objCpdRegister->get_cpdRegister_by_id();
							      print_r($details);  
							 }else{die();}
						break;
						// update cpd member records
						case 'cpdRecordInsert':
							$objCpdRegister = new CpdRegister;
							$objCpdRegister->set_cpdRecordTitle(json_encode($_POST["cpdRecordTitle"]));
							$objCpdRegister->set_cpdRecordDate(json_encode($_POST["cpdRecordDate"]));
							$objCpdRegister->set_cpdRecordAuthors(json_encode($_POST["cpdRecordAuthors"]));
							$objCpdRegister->set_cpdRecordMarks(json_encode($_POST["cpdRecordMarks"]));
							$objCpdRegister->set_id($objCpdRegister->CleanData($_POST["cpdRegisterId"]));
							if ($objCpdRegister->cpd_insert_records()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;

						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objCpdRegisterControl = new CpdRegisterControl;
 ?>