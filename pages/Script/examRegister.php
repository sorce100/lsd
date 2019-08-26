<?php
	require_once("../Classes/ExamsRegister.php"); 
	session_start();
	class ExamsRegisterControl{

		function __construct(){
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objExamsRegister = new ExamsRegister;
							$objExamsRegister->set_examCenterId(trim($_POST["centerId"]));
							$objExamsRegister->set_examCenterModuleId(trim($_POST["moduleId"]));
							if ($objExamsRegister->insert()) {
								echo "success";
							}
							else{
								echo "error";
							}
						break;
					// for update
						case 'registed_students':
							$objExamsRegister = new ExamsRegister;
							$objExamsRegister->set_courseId($objExamsRegister->CleanData($_POST["data_id"]));
							if ($objExamsRegister->get_studentDetails_forCourseRegisted()) {
									$studentDetails =$objExamsRegister->get_studentDetails_forCourseRegisted();
									print_r($studentDetails);
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objExamsRegister = new ExamsRegister;
								      $objExamsRegister->set_id($objExamsRegister->CleanData($_POST["data_id"]));
								      if ($objExamsRegister->delete()) {
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
								 $objExamsRegister = new ExamsRegister;  
							      $objExamsRegister->set_id($objExamsRegister->CleanData($_POST["data_id"]));
							      $pages_details = $objExamsRegister->get_pages_by_id();
							      print_r($pages_details);  
							 }else{die();}
						break;
						// get all details of applicant exams names and event register

						case 'getExamsRegisteredMembers':
							if(isset($_POST["examcenterId"])){
								 $objExamsRegister = new ExamsRegister;  
							      $objExamsRegister->set_id($objExamsRegister->CleanData($_POST["data_id"]));
							      $pages_details = $objExamsRegister->get_pages_by_id();
							      print_r($pages_details);  
							 }else{die();}
						break;
						case 'insertScore':
							$objExamsRegister = new ExamsRegister;
							//make an associative array for exam name and score percentage

							$objExamsRegister->set_examScore($objExamsRegister->CleanData($_POST["examScoreValue"]));
							$objExamsRegister->set_examScoreName($objExamsRegister->CleanData($_POST["examName"]));
							$objExamsRegister->set_id($objExamsRegister->CleanData($_POST["examRegid"]));

							if ($objExamsRegister->insert_exam_score()) {
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

	$objExamsRegisterControl = new ExamsRegisterControl;
 ?>