<?php
	require_once("../Classes/School.php"); 
	session_start();
	class SchoolControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objSchool = new School;
							$objSchool->set_schoolName($objSchool->CleanData($_POST["schoolName"]));
							$objSchool->set_schoolAlias($objSchool->CleanData($_POST["schoolAlias"]));
							$objSchool->set_schoolRegion($objSchool->CleanData($_POST["schoolRegion"]));
							$objSchool->set_schoolTel($objSchool->CleanData($_POST["schoolTel"]));
							$objSchool->set_schoolWebsite($objSchool->CleanData($_POST["schoolWebsite"]));
							$objSchool->set_schoolEmail($objSchool->CleanData($_POST["schoolEmail"]));
							$objSchool->set_schoolAddress($objSchool->CleanData($_POST["schoolAddress"]));
							$objSchool->set_schoolLocation($objSchool->CleanData($_POST["schoolLocation"]));
							if ($objSchool->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objSchool = new School;
							$objSchool->set_id($objSchool->CleanData($_POST["data_id"]));
							$objSchool->set_schoolName($objSchool->CleanData($_POST["schoolName"]));
							$objSchool->set_schoolAlias($objSchool->CleanData($_POST["schoolAlias"]));
							$objSchool->set_schoolRegion($objSchool->CleanData($_POST["schoolRegion"]));
							$objSchool->set_schoolTel($objSchool->CleanData($_POST["schoolTel"]));
							$objSchool->set_schoolWebsite($objSchool->CleanData($_POST["schoolWebsite"]));
							$objSchool->set_schoolEmail($objSchool->CleanData($_POST["schoolEmail"]));
							$objSchool->set_schoolAddress($objSchool->CleanData($_POST["schoolAddress"]));
							$objSchool->set_schoolLocation($objSchool->CleanData($_POST["schoolLocation"]));
							if ($objSchool->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									  $objSchool = new School;
								      $objSchool->set_id($objSchool->CleanData($_POST["data_id"]));
								      $objSchool->set_recordHide("YES");
								      if ($objSchool->delete()) {
								      	return true;
								      }
								      else{
								      	return false;
								      }
								     
								 }else{die();}
						break;
					// 	// geting details of a school with id
						case 'updateModal':
							if(isset($_POST["data_id"])){
									 $objSchool = new School;  
								      $objSchool->set_id($objSchool->CleanData($_POST["data_id"]));
								      $company_details = $objSchool->get_school_by_id();
								      print_r($company_details);  
								 }else{die();}
						break;

					// get all schools for user select
							case 'get_schools':
								$objSchool = new School;
								if ($objSchool->get_schools_list()) {
									print_r($objSchool->get_schools_list());
								}
							break;
					// get all students
							case 'get_schools':
								$objSchool = new School;
								if ($objSchool->get_sschools_list()) {
									print_r($objSchool->get_sschools_list());
								}
							break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objSchoolControl = new SchoolControl;
 ?>