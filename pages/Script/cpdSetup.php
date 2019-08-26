<?php
	require_once("../Classes/CpdSetup.php"); 
	session_start();
	class CpdSetupControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objCpdSetup= new CpdSetup;
							$objCpdSetup->set_cpdRegisterName($objCpdSetup->CleanData($_POST["cpdRegisterName"]));
							$objCpdSetup->set_cpdRegisterAmt(trim($_POST["cpdRegisterAmt"]));
							if ($objCpdSetup->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objCpdSetup= new CpdSetup;
							$objCpdSetup->set_cpdRegisterName($objCpdSetup->CleanData($_POST["cpdRegisterName"]));
							$objCpdSetup->set_cpdRegisterAmt(trim($_POST["cpdRegisterAmt"]));
							$objCpdSetup->set_id($objCpdSetup->CleanData($_POST["data_id"]));
							if ($objCpdSetup->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objCpdSetup= new CpdSetup;
								      $objCpdSetup->set_recordHide('YES');
								      $objCpdSetup->set_id($objCpdSetup->CleanData($_POST["data_id"]));
								      if ($objCpdSetup->delete()) {
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
									 $objCpdSetup= new CpdSetup;  
								      $objCpdSetup->set_id($objCpdSetup->CleanData($_POST["data_id"]));
								      $details = $objCpdSetup->get_cpd_by_id();
								      print_r($details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objCpdSetupControl = new CpdSetupControl;
 ?>