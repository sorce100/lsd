<?php
	require_once("../Classes/StudentRegister.php"); 
	session_start();
	class studentRegisterControl{

		function __construct(){
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objStudentRegister = new StudentRegister;
							$objStudentRegister->set_examCenterId(trim($_POST["centerId"]));
							$objStudentRegister->set_examName(json_encode($_POST["subjectSelect"]));
							if ($objStudentRegister->insert()) {
								echo "success";
							}
							else{
								echo "error";
							}
						break;
					// for update
						case 'registed_students':
							$objStudentRegister = new StudentRegister;
							$objStudentRegister->set_courseId($objStudentRegister->CleanData($_POST["data_id"]));
							if ($objStudentRegister->get_studentDetails_forCourseRegisted()) {
									$studentDetails =$objStudentRegister->get_studentDetails_forCourseRegisted();
									print_r($studentDetails);
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objStudentRegister = new StudentRegister;
								      $objStudentRegister->set_id($objStudentRegister->CleanData($_POST["data_id"]));
								      if ($objStudentRegister->delete()) {
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
									 $objStudentRegister = new StudentRegister;  
								      $objStudentRegister->set_id($objStudentRegister->CleanData($_POST["data_id"]));
								      $pages_details = $objStudentRegister->get_pages_by_id();
								      print_r($pages_details);  
								 }else{die();}
						break;
						case 'insertScore':
							$objStudentRegister = new StudentRegister;
							//make an associative array for exam name and score percentage

							$objStudentRegister->set_examScore($objStudentRegister->CleanData($_POST["examScoreValue"]));
							$objStudentRegister->set_examScoreName($objStudentRegister->CleanData($_POST["examName"]));
							$objStudentRegister->set_id($objStudentRegister->CleanData($_POST["examRegid"]));

							if ($objStudentRegister->insert_exam_score()) {
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

	$objstudentRegisterControl = new studentRegisterControl;
 ?>