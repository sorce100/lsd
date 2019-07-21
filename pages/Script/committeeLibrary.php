<?php
	require_once("../Classes/CommitteeLibrary.php"); 
	session_start();
	class committeeLibraryControl{

		function __construct(){
			$FolderPath = "../../uploads/committee/";
			$filesUploaded = [];
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							if (empty($_POST["commLibrarySubject"])) {
								echo "error";
								die();
							}
							if ($_FILES['file_array']['error'][0] != "4") {
								$foldername=trim($_POST["comm_folderName"]);
								$foldercreate=$FolderPath.$foldername."/";
								// create folder in the library folder
								if(!is_dir($foldercreate)) {
									mkdir($foldercreate,0777,true);
								}
								// make file upload
								if (!empty($_FILES['file_array']['name'][0])) {
									// declaring a new variable for the gloabl 
									$files=$_FILES['file_array'];
									$allowed=array('pdf','docx','doc','ppt','pptx','xls','xlsx','png','jpeg','jpg','txt');

									foreach ($files['name'] as $position => $file_name) {
										$file_tmp =$files['tmp_name'][$position];
										$file_size =$files['size'][$position];
										$file_error =$files['error'][$position];
										$file_ext=explode('.',$file_name);
										$filename= current($file_ext);
										$file_ext = strtolower(end($file_ext));

										if (in_array($file_ext,$allowed)) {
											// check if ther is any errors from the uploaded file
											if ($file_error === 0) {
												// check if file uploaded has ther righ size
												if ($file_size < 900000000000000000) {
													// creating unique ids for uploads instead of names of files, number is in microsecond
													$filenewname=$filename.".".$file_ext;
													// $structure="/uploads/agent_files/".$folder."/";				
													$filedestination = $foldercreate.$filenewname;
													// moving file from temporal location to permanent storage
													$fileup=move_uploaded_file($file_tmp,$filedestination);
													
												}
													// end of if to check file size
											}
													// end of file error
													else{
														echo "error";
														die();
													}
										}
											// end of if file is allowed
										// add files to array to save
										$filesUploaded[]=$filenewname;
									}
									
								// if file is uploaded successfully then save details in database
									if ($fileup) {
										$objCommitteeLibrary = new CommitteeLibrary;
										$objCommitteeLibrary->set_commLibrarySubject($objCommitteeLibrary->CleanData($_POST["commLibrarySubject"]));
										$objCommitteeLibrary->set_commLibraryFolderName($objCommitteeLibrary->CleanData($_POST["comm_folderName"]));
										$objCommitteeLibrary->set_commLibraryFiles(json_encode($filesUploaded));
										$objCommitteeLibrary->set_commId($objCommitteeLibrary->CleanData($_POST["data_id"]));
										if ($objCommitteeLibrary->insert()) {
											echo "success";
										}
										else{
											echo "error";
										}
									}
								}

							// if no image is uploaded

							}
							else if ($_FILES['file_array']['error'][0] == "4") {
								echo "error";
							}
							
						break;
					// for update
						case 'update':
							if ($_FILES['file_array']['error'][0] == "4"){
									$objCommitteeLibrary->set_commLibrarySubject($objCommitteeLibrary->CleanData($_POST["commLibrarySubject"]));
									$objCommitteeLibrary->set_commLibraryFolderName($objCommitteeLibrary->CleanData($_POST["comm_folderName"]));
									$objCommitteeLibrary->set_commLibraryFiles(json_encode($_FILES['file_array']['name']));
									$objCommitteeLibrary->set_id($objCommitteeLibrary->CleanData($_POST["data_id"]));
									if ($objCommitteeLibrary->update()) {
										echo "success";
									}
									else{
										echo "error";
									}
								
							}else if ($_FILES['file_array']['error'][0] != "4") {
								$foldercreate;
								$foldername;
								// check if foldername is empty

								if (trim($_POST["folderName"]) == "NONE" ) {
									$foldername=trim($_POST["vecRegNum"]."-".$_POST["vecMake"]);
									$foldercreate=$FolderPath.$foldername."/";

									// create folder in the library folder
									if(!is_dir($foldercreate)) {
										mkdir($foldercreate,0777,true);
									}else{
										echo "error";
									}
								}
								else{
									$foldername = trim($_POST["folderName"]);
									$foldercreate = $FolderPath.$foldername."/";
								}

								// delete all files in the folder
								$getFolder = new RecursiveDirectoryIterator($foldercreate, FilesystemIterator::SKIP_DOTS);
								$contents = new RecursiveIteratorIterator($getFolder, RecursiveIteratorIterator::CHILD_FIRST);
								foreach ( $contents as $content ) {
								    $content->isDir() ?  rmdir($content) : unlink($content);
								}

								// make file upload
								if (!empty($_FILES['file_array']['name'][0])) {
									// declaring a new variable for the gloabl 
									$files=$_FILES['file_array'];
									$allowed=array('png','jpeg','jpg');

									foreach ($files['name'] as $position => $file_name) {
										$file_tmp =$files['tmp_name'][$position];
										$file_size =$files['size'][$position];
										$file_error =$files['error'][$position];
										$file_ext=explode('.',$file_name);
										$filename= current($file_ext);
										$file_ext = strtolower(end($file_ext));

										if (in_array($file_ext,$allowed)) {
											// check if ther is any errors from the uploaded file
											if ($file_error === 0) {
												// check if file uploaded has ther righ size
												if ($file_size < 100000000000000000) {
													// creating unique ids for uploads instead of names of files, number is in microsecond
													$filenewname=$filename.".".$file_ext;
													// $structure="/uploads/agent_files/".$folder."/";				
													$filedestination = $foldercreate.$filenewname;
													// moving file from temporal location to permanent storage
													$fileup=move_uploaded_file($file_tmp,$filedestination);
												}
													// end of if to check file size
											}
											// end of file erroe
											else{
												echo "error";
												die();
											}
										}
										// end of if file is allowed
										else{
											echo "error";
											die();
										}
								}
									
								// if file is uploaded successfully then save details in database
									if ($fileup) {
										$objCommitteeLibrary = new CommitteeLibrary;
										$objCommitteeLibrary->set_vecRegNum($objCommitteeLibrary->CleanData($_POST["vecRegNum"]));
										$objCommitteeLibrary->set_vecChasis($objCommitteeLibrary->CleanData($_POST["vecChasis"]));
										$objCommitteeLibrary->set_vecType($objCommitteeLibrary->CleanData($_POST["vecType"]));
										$objCommitteeLibrary->set_vecYear($objCommitteeLibrary->CleanData($_POST["vecYear"]));
										$objCommitteeLibrary->set_vecMake($objCommitteeLibrary->CleanData($_POST["vecMake"]));
										$objCommitteeLibrary->set_VecModel($objCommitteeLibrary->CleanData($_POST["VecModel"]));
										$objCommitteeLibrary->set_vecTransmission($objCommitteeLibrary->CleanData($_POST["vecTransmission"]));
										$objCommitteeLibrary->set_vecFuelType($objCommitteeLibrary->CleanData($_POST["vecFuelType"]));
										$objCommitteeLibrary->set_vecRegRegion($objCommitteeLibrary->CleanData($_POST["vecRegRegion"]));
										$objCommitteeLibrary->set_vecStatus($objCommitteeLibrary->CleanData($_POST["vecStatus"]));
										$objCommitteeLibrary->set_vecOperator($objCommitteeLibrary->CleanData($_POST["vecOperator"]));
										$objCommitteeLibrary->set_vecOwnership($objCommitteeLibrary->CleanData($_POST["vecOwnership"]));
										$objCommitteeLibrary->set_vecColor($objCommitteeLibrary->CleanData($_POST["vecColor"]));
										$objCommitteeLibrary->set_vecNote($objCommitteeLibrary->CleanData($_POST["vecNote"]));
										$objCommitteeLibrary->set_vecImage($objCommitteeLibrary->CleanData($filenewname));
										$objCommitteeLibrary->set_vecFolder($objCommitteeLibrary->CleanData($foldername));
										$objCommitteeLibrary->set_id($objCommitteeLibrary->CleanData($_POST["data_id"]));
										if ($objCommitteeLibrary->update()) {
												echo "success";
											}
											else{
												echo "error";
											}
										}
								}
							}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
								// if foldername isset then delete folder and from database
								if (trim($_POST["folderName"]) != "NONE") {
									$folderName = $FolderPath.trim($_POST["folderName"])."/";

									if (is_dir($folderName)) {
										// deleting the files and the folder 
										$getFolder = new RecursiveDirectoryIterator($folderName, FilesystemIterator::SKIP_DOTS);
										$contents = new RecursiveIteratorIterator($getFolder, RecursiveIteratorIterator::CHILD_FIRST);
										foreach ( $contents as $content ) {
										    $content->isDir() ?  rmdir($content) : unlink($content);
										}
										// now delete folder
										if (rmdir($folderName)) {
											// if folder is removed now we clear the records from the database
											  $objCommitteeLibrary = new CommitteeLibrary;
											  $objCommitteeLibrary->set_recordHide("YES");
										      $objCommitteeLibrary->set_id($objCommitteeLibrary->CleanData($_POST["data_id"]));
										      if ($objCommitteeLibrary->delete()) {
													echo "success";
												}
												else{
													echo "error";
												}
										}
									}
								}else if (trim($_POST["folderName"]) == "NONE") {
									 // else if no foldername then just delete entry
									  $objCommitteeLibrary = new CommitteeLibrary;
									  $objCommitteeLibrary->set_recordHide("YES");
								      $objCommitteeLibrary->set_id($objCommitteeLibrary->CleanData($_POST["data_id"]));
								      if ($objCommitteeLibrary->delete()) {
											echo "success";
										}
										else{
											echo "error";
										}

								}
								  
							       
							 }else{die();}
						break;
						// geting details of a member with id
						case 'updateModal':
							if(isset($_POST["data_id"])){
								  $objCommitteeLibrary = new CommitteeLibrary;  
							      $objCommitteeLibrary->set_id($objCommitteeLibrary->CleanData($_POST["data_id"]));
							      $vehicle_details = $objCommitteeLibrary->get_vehicle_by_id();
							      print_r($vehicle_details);  
							 }else{die();}
						break;
						// get all
						case 'getAll':
							$objCommitteeLibrary = new CommitteeLibrary;
							$objCommitteeLibrary->set_commId($objCommitteeLibrary->CleanData($_POST["committeeId"]));
							print_r(json_encode($objCommitteeLibrary->get_committee_librarys(),true));

						break;

						default:
							echo "error";
							die();
							break;
					}

				}
			}

	$objcommitteeLibraryControl = new committeeLibraryControl;
 ?>