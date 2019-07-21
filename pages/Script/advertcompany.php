<?php
	require_once("../Classes/AdvertCompany.php"); 
	session_start();
	class AdvertComControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objAdvertCompany = new AdvertCompany;
							$objAdvertCompany->set_advertCom($objAdvertCompany->CleanData($_POST["advertCom"]));
							$objAdvertCompany->set_advertComTel($objAdvertCompany->CleanData($_POST["advertComTel"]));
							$objAdvertCompany->set_advertComAddress($objAdvertCompany->CleanData($_POST["advertComAddress"]));
							$objAdvertCompany->set_advertComLocation($objAdvertCompany->CleanData($_POST["advertComLocation"]));
							$objAdvertCompany->set_advertComCategory($objAdvertCompany->CleanData($_POST["advertComCategory"]));
							$objAdvertCompany->set_madeBy($objAdvertCompany->CleanData($_POST["madeBy"]));

							if ($objAdvertCompany->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objAdvertCompany = new AdvertCompany;
							$objAdvertCompany->set_id($objAdvertCompany->CleanData($_POST["data_id"]));
							$objAdvertCompany->set_advertCom($objAdvertCompany->CleanData($_POST["advertCom"]));
							$objAdvertCompany->set_advertComTel($objAdvertCompany->CleanData($_POST["advertComTel"]));
							$objAdvertCompany->set_advertComAddress($objAdvertCompany->CleanData($_POST["advertComAddress"]));
							$objAdvertCompany->set_advertComLocation($objAdvertCompany->CleanData($_POST["advertComLocation"]));
							$objAdvertCompany->set_advertComCategory($objAdvertCompany->CleanData($_POST["advertComCategory"]));
							if ($objAdvertCompany->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									  $objAdvertCompany = new AdvertCompany;
								      $objAdvertCompany->set_id($objAdvertCompany->CleanData($_POST["data_id"]));
								      $objAdvertCompany->set_recordHide("YES");
								      if ($objAdvertCompany->delete()) {
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
									 $objAdvertCompany = new AdvertCompany;  
								      $objAdvertCompany->set_id($objAdvertCompany->CleanData($_POST["data_id"]));
								      $company_details = $objAdvertCompany->get_advert_by_id();
								      print_r($company_details);  
								 }else{die();}
						break;
	
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objAdvertComControl = new AdvertComControl;
 ?>