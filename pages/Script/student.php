<?php
	require_once("../Classes/Student.php"); 
	require_once("../Classes/Sms.php"); 
	session_start();
	class SchoolCourceControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objStudent = new Student;
							$objStudent->set_studentEmail($objStudent->CleanData($_POST["studentEmail"]));
							if ($objStudent->check_email()) {
									echo "email_exits";
									die();
								}
								else{
									$firstname = trim($_POST["studentFirstName"]);
									$lastname = trim($_POST["studentLastName"]);
									$tel = trim($_POST["studentTel"]);
									$objStudent->set_studentTitle($objStudent->CleanData($_POST["studentTitle"]));
									$objStudent->set_studentFirstName($objStudent->CleanData($firstname));
									$objStudent->set_studentLastName($objStudent->CleanData($lastname));
									$objStudent->set_studentEmail($objStudent->CleanData($_POST["studentEmail"]));
									$objStudent->set_studentTel($tel);
									$objStudent->set_examCenter($objStudent->CleanData($_POST["examCenter"]));
									$objStudent->set_division($objStudent->CleanData($_POST["division"]));
									// set memberId and the password
									$passwd = date('Y').rand(1,23789);
									$userPassword = password_hash($passwd, PASSWORD_DEFAULT);
									$memberId = substr($firstname,0,1).'.'.$lastname;

									$objStudent->set_studenPassword($userPassword);
									$objStudent->set_studentMemberId($memberId);
									if ($objStudent->insert()) {
										////////////////////////////////////////////////////////////////////////////////
										// for sms class
											$objSms = new Sms();
											// send sms account user
											$objSms->send_sms("$tel","Dear $firstname, your GhIS LSD trainee account has being created successfully. Please log on https://ghislsd.com with credentials, username: $memberId and password : $passwd");

										/////////////////////////////////////////////////////////////////////////////////////////
										echo "success";
									}
									else{
										echo "error";
									}
								}
						break;
					// for update
						case 'update':
								$objStudent = new Student;
								$objStudent->set_studentTitle($objStudent->CleanData($_POST["studentTitle"]));
								$objStudent->set_studentFirstName($objStudent->CleanData($_POST["studentFirstName"]));
								$objStudent->set_studentLastName($objStudent->CleanData($_POST["studentLastName"]));
								$objStudent->set_studentEmail($objStudent->CleanData($_POST["studentEmail"]));
								$objStudent->set_studentTel($_POST["studentTel"]);
								$objStudent->set_examCenter($objStudent->CleanData($_POST["examCenter"]));
								$objStudent->set_division($objStudent->CleanData($_POST["division"]));
								$objStudent->set_id($objStudent->CleanData($_POST["data_id"]));
								if ($objStudent->update()) {
										echo "success";
									}
									else{
										echo "error";
									}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									  $objStudent = new Student;
								      $objStudent->set_id($objStudent->CleanData($_POST["data_id"]));
								      $objStudent->set_recordHide("YES");
								      if ($objStudent->delete()) {
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
									  $objStudent = new Student;  
								      $objStudent->set_id($objStudent->CleanData($_POST["data_id"]));
								      $student_details = $objStudent->get_student_by_id();
								      print_r($student_details);  
								 }else{die();}
						break;

					// get all schools for user select
							case 'get_schools':
								$objStudent = new Student;
								if ($objStudent->get_schools_list()) {
									print_r($objStudent->get_schools_list());
								}
							break;
					// get list of courses by using school id
							case 'get_courses':
								$objStudent = new Student;
								$objStudent->set_schoolId($_SESSION['school_id']);
								print_r($objStudent->get_courses_list());
								
							break;
					// get all students
							case 'get_students':
								$objStudent = new Student;
								if ($objStudent->get_student_list()) {
									print_r($objStudent->get_student_list());
								}
							break;
					// updating details of student
						case 'profileUpdate':
								$objStudent = new Student;
								$objStudent->set_studentTitle($objStudent->CleanData($_POST["studentTitle"]));
								$objStudent->set_studentFirstName($objStudent->CleanData($_POST["studentFirstName"]));
								$objStudent->set_studentLastName($objStudent->CleanData($_POST["studentLastName"]));
								$objStudent->set_studentEmail($objStudent->CleanData($_POST["studentEmail"]));
								$objStudent->set_studentTel($objStudent->CleanData($_POST["studentTel"]));
								$objStudent->set_studentEmergencyTel($objStudent->CleanData($_POST["studentEmergencyTel"]));
								$objStudent->set_studentDob($objStudent->CleanData($_POST["studentDob"]));
								$objStudent->set_studentPostalAddress($objStudent->CleanData($_POST["studentPostalAddress"]));
								$objStudent->set_studentHouseNum($objStudent->CleanData($_POST["studentHouseNum"]));
								$objStudent->set_StudentHouseLoc($objStudent->CleanData($_POST["StudentHouseLoc"]));
								if ($objStudent->update_profile()) {
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

	$objStudentCourceControl = new SchoolCourceControl;
 ?>