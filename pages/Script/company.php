<?php
	require_once("../Classes/Company.php"); 
	session_start();
	class CompanyControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objCompany = new Company;
							$objCompany->set_companyName($objCompany->CleanData($_POST["companyName"]));
							$objCompany->set_companyMembers(json_encode($_POST["companyMembers"]));
							if ($objCompany->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objCompany = new Company;
							$objCompany->set_id($objCompany->CleanData($_POST["data_id"]));
							$objCompany->set_companyName($objCompany->CleanData($_POST["companyName"]));
							$objCompany->set_companyMembers(json_encode($_POST["companyMembers"]));
							if ($objCompany->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									  $objCompany = new Company;
								      $objCompany->set_id($objCompany->CleanData($_POST["data_id"]));
								      $objCompany->set_recordHide("YES");
								      if ($objCompany->delete()) {
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
									 $objCompany = new Company;  
								      $objCompany->set_id($objCompany->CleanData($_POST["data_id"]));
								      $company_details = $objCompany->get_company_by_id();
								      print_r($company_details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objCompanyControl = new CompanyControl;
 ?>