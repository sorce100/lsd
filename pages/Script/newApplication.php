<?php
	require_once("../Classes/NewApplication.php");
	require_once("../Classes/EmailSend.php"); 
	session_start();
	class NewApplicationControl{

		function __construct(){
			$Startdate = date("jS-F-Y");
			$application_code = date("Ym").rand(11,9999);
			$newApplicaitionFolderPath = "../../uploads/new_applications/";
			$filesName = [];
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insertA':
							if (empty($_FILES)){
								echo "NO_UPLOAD";
								die();
							}else if (!empty($_FILES)) {
								$foldername=trim(date("m-d-Yis-").$_SESSION['student_id'].$_SESSION['user_id']);
								$foldercreate=$newApplicaitionFolderPath.$foldername."/";
								// create folder in the library folder
								if(!mkdir($foldercreate,0777,true)) {
									echo "FOLDER CREATE ERROR";
									die();
								}
								// make file upload
								if (!empty($_FILES['certFiles']['name'][0])) {
									// declaring a new variable for the gloabl 
									$files=$_FILES['certFiles'];
									$allowed=array('docx','doc','pdf','png','jpeg','jpg');

									foreach ($files['name'] as $position => $file_name) {
										$file_tmp =$files['tmp_name'][$position];
										$file_size =$files['size'][$position];
										$file_error =$files['error'][$position];
										$file_ext=explode('.',$file_name);
										$filename= current($file_ext);
										$file_ext = strtolower(end($file_ext));

										if (!in_array($file_ext,$allowed)) {
											// for delete folders and its content when one file is uploaded

											if (is_dir($foldercreate)) {
												// deleting the files and the folder 
												$files = scandir($foldercreate);
												foreach ($files as $file) {
													if (($file === '.')||  ($file === '...') || ($file === '..')) {
														continue;
													}else{
														// die($file);
														unlink($foldercreate.$file);
													}
												}
												// now delete folder
												if (rmdir($foldercreate)) {
													echo "ERROR,WRONG FILES UPLOADED";
													die();
												}
											}
										}
										else if (in_array($file_ext,$allowed)) {
											// check if ther is any errors from the uploaded file
											if ($file_error === 0) {
												// check if file uploaded has ther righ size
												if ($file_size < 100000000000000000) {
													// creating unique ids for uploads instead of names of files, number is in microsecond
													$filenewname=$filename.".".$file_ext;
													// saving filesname in an array
													$filesname[] = $filenewname;

													$filedestination = $foldercreate.$filenewname;
													// moving file from temporal location to permanent storage
													$fileup=move_uploaded_file($file_tmp,$filedestination);
												}
													// end of if to check file size
											}
													// end of file erroe
													else{
														echo "ERROR UPLOADING FILES";
														die();
													}
										}
											// end of if file is allowed
								}
							}
									
								// if file is uploaded successfully then save details in database
									if ($fileup) {
										$objNewApplication = new NewApplication;
										$objNewApplication->set_applicationDiv($objNewApplication->CleanData($_POST["applicationDiv"]));
										$objNewApplication->set_applicationStage("START");
										$objNewApplication->set_folderName($foldername);
										$objNewApplication->set_filesSubject(json_encode($_POST["certIssuer"],true));
										$objNewApplication->set_filesName(json_encode($filesname,true));
										$objNewApplication->set_collegeEmail($objNewApplication->CleanData($_POST["collegeEmail"]));
										$objNewApplication->set_employerEmail($objNewApplication->CleanData($_POST["employerEmail"]));
										$objNewApplication->set_Startdate($Startdate);
										$objNewApplication->set_application_code($application_code);
										$objNewApplication->set_memberDeclare_id($objNewApplication->CleanData($_POST["memberDeclare_id"]));
										$objNewApplication->set_memberDeclare_note($_POST["memberDeclare_note"]);
										if ($objNewApplication->insert_A()) {
											// send emails to the college and empoyer emails given
											$objEmailSend = new EmailSend;
											// send to college
											$objEmailSend->send_application_mail("ghislsd.com/pages/applicant_registrationb.php?data=$application_code",
																					"NEW GhIS MEMBER REGISTRATION DECLARATION",
																					$_POST["collegeEmail"],
																					$_SESSION['student_id']
																				);
											// send to trainer of employer
											$objEmailSend->send_application_mail("ghislsd.com/pages/applicant_registrationc.php?data=$application_code",
																					"NEW GhIS MEMBER REGISTRATION DECLARATION",
																					$_POST["employerEmail"],
																					$_SESSION['student_id']
																				);

											echo "Application saved successfully.";
										}
										else{
											// if anything goes wrong then clear the file
											$folderDel = $newApplicaitionFolderPath.trim($foldername)."/";
											if (is_dir($folderDel)) {
												// deleting the files and the folder 
												$files = scandir($folderDel);
												foreach ($files as $file) {
													if (($file === '.')||  ($file === '...') || ($file === '..')) {
														continue;
													}else{
														// die($file);
														unlink($folderDel.$file);
													}
												}
												rmdir($folderDel);

											echo "There was an error processing this application";

											}
										}
									}
							}
						break;
					// for college insert
						case 'insertB':
							$objNewApplication = new NewApplication;
							$objNewApplication->set_col_instructorTitle($objNewApplication->CleanData($_POST["col_instructorTitle"]));
							$objNewApplication->set_col_instructFullname($objNewApplication->CleanData($_POST["col_instructFullname"]));
							$objNewApplication->set_col_Name($objNewApplication->CleanData($_POST["col_Name"]));
							$objNewApplication->set_col_stuStartDate($objNewApplication->CleanData($_POST["col_stuStartDate"]));
							$objNewApplication->set_col_competenceDiv($objNewApplication->CleanData($_POST["col_competenceDiv"]));
							$objNewApplication->set_col_principalName($objNewApplication->CleanData($_POST["col_principalName"]));
							$objNewApplication->set_col_principalProfNum($objNewApplication->CleanData($_POST["col_principalProfNum"]));
							$objNewApplication->set_Startdate($Startdate);
							$objNewApplication->set_application_code($_POST["application_code"]);
							$objNewApplication->set_memberDeclare_id($objNewApplication->CleanData($_POST["memberDeclare_id"]));
							$objNewApplication->set_memberDeclare_note($objNewApplication->CleanData($_POST["memberDeclare_note"]));
							if ($objNewApplication->insert_B()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for empoyer / trainer insert
						case 'insertC':
							$objNewApplication = new NewApplication;
							$objNewApplication->set_Startdate($Startdate);
							$objNewApplication->set_application_code($_POST["application_code"]);
							$objNewApplication->set_emp_comName($objNewApplication->CleanData($_POST["emp_comName"]));
							$objNewApplication->set_emp_comLoc($objNewApplication->CleanData($_POST["emp_comLoc"]));
							$objNewApplication->set_emp_tel($objNewApplication->CleanData($_POST["emp_tel"]));
							$objNewApplication->set_emp_tecDivision($objNewApplication->CleanData($_POST["emp_tecDivision"]));
							$objNewApplication->set_emp_stuBranch($objNewApplication->CleanData($_POST["emp_stuBranch"]));
							$objNewApplication->set_com_trianerName($objNewApplication->CleanData($_POST["com_trianerName"]));
							$objNewApplication->set_emp_ProfNum($objNewApplication->CleanData($_POST["emp_ProfNum"]));
							if ($objNewApplication->insert_C()) {
									echo "success";
							}
							else{
								echo "error";
							}
						break;
						case 'insertD';
							$objNewApplication = new NewApplication;
							$objNewApplication->set_Startdate($Startdate);
							$objNewApplication->set_id($objNewApplication->CleanData($_POST["data_id"]));
							$objNewApplication->set_studentId($objNewApplication->CleanData($_POST["student_id"]));
							$objNewApplication->set_memberDeclare_id($objNewApplication->CleanData($_SESSION["member_id"]));
							if ($objNewApplication->insert_D()) {
								echo "SUCCESSFULLY, APPLICATION DECLARATION MADE SUCCESSFULLY";
							}
							else{
								echo "SORRY, THERE WAS A PROBLEM WITH PROPOSERS DECLARATION";
							}
						break;
						case 'insertE':
							$objNewApplication = new NewApplication;
							$objNewApplication->set_id($objNewApplication->CleanData($_POST["data_id"]));
							$objNewApplication->set_applicationStage("SUBMITTED");
							if ($objNewApplication->insert_E()) {
								echo "SUCCESSFULLY, APPLICATION SUBMITTED SUCCESSFULLY, YOU WILL BE ALERTED WHEN DONE. THANK YOU";
							}
							else{
								echo "SORRY, THERE WAS A PROBLEM WITH SUBMITTION OF THE APPLICATION";
							}
						break;
						case 'proposer_viewApplication':
							if(isset($_POST["data_id"])){
								  $objNewApplication = new NewApplication; 
							      $objNewApplication->set_id($objNewApplication->CleanData($_POST["data_id"]));
							      $objNewApplication->set_studentId($objNewApplication->CleanData($_POST["student_id"]));
							      $application_details = $objNewApplication->proposer_viewApplication();
							      print_r($application_details);  
							 }else{die();}
						break;
						case 'applicant_details_review':
								  $objNewApplication = new NewApplication; 
							      $application_details = $objNewApplication->applicant_data_review();
							      print_r($application_details);  
						break;
						// for admin viewing details of application and for confirmation
						case 'confirm_details':
							if(isset($_POST["data_id"])){
								  $objNewApplication = new NewApplication; 
							      $objNewApplication->set_id($objNewApplication->CleanData($_POST["data_id"]));
							      $application_details = $objNewApplication->confirm_applicant_Details();
							      print_r($application_details);  
							 }else{die();}
						break;
						/////////////////////////////////////////////////
						//////// downloading files for application
						/////////////////////////////////////////////////
						case 'appFilesDownload':
						if(isset($_POST["folderName"])){
								  $objNewApplication = new NewApplication; 
							      $result = $objNewApplication->download_files_zip($_POST["folderName"]);
							      print_r($result);
						}else{die();}
						break;

						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objNewApplicationControl = new NewApplicationControl;
 ?>