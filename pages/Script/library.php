<?php
	require_once("../Classes/Library.php"); 
	session_start();
	class LibraryControl{
		function __construct(){
			$libraryFolderPath = "../../uploads/library/";
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							if (empty($_FILES)){
								echo "NO_UPLOAD";
								die();
							}else if (!empty($_FILES)) {
								$foldername=trim(date("m-d-Yis-").$_SESSION['division'].$_SESSION['user_id']);
								$foldercreate=$libraryFolderPath.$foldername."/";
								// create folder in the library folder
								if(!mkdir($foldercreate,0777,true)) {
									echo "FOLDER CREATE ERROR";
									die();
								}
								// make file upload
								if (!empty($_FILES['file_array']['name'][0])) {
									// declaring a new variable for the gloabl 
									$files=$_FILES['file_array'];
									$allowed=array('docx','doc','txt','pdf','ppt','pptx','xls','txt','png','jpeg','jpg');

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
													echo "WRONG FILES UPLOADED";
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
													// $structure="/uploads/agent_files/".$folder."/";				
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
									
								// if file is uploaded successfully then save details in database
									if ($fileup) {
										$objLibrary = new Library;
										$objLibrary->set_librarySubject($objLibrary->CleanData($_POST["librarySubject"]));
										$objLibrary->set_libraryCategory($objLibrary->CleanData($_POST["libraryCategory"]));
										$objLibrary->set_libraryDescription($objLibrary->CleanData($_POST["libraryDescription"]));
										$objLibrary->set_folderName($foldername);
										$objLibrary->set_division($objLibrary->CleanData($_SESSION['division']));
										$objLibrary->set_userId($objLibrary->CleanData($_SESSION['user_id']));
										if ($objLibrary->insert()) {
												echo "success";
											}
											else{
												echo "error";
											}
										}
								}
							}
							
						break;
					// for update
						case 'update':
							if (empty($_FILES)){
									$objLibrary = new Library;
									$objLibrary->set_librarySubject($objLibrary->CleanData($_POST["librarySubject"]));
									$objLibrary->set_libraryCategory($objLibrary->CleanData($_POST["libraryCategory"]));
									$objLibrary->set_libraryDescription($objLibrary->CleanData($_POST["libraryDescription"]));
									$objLibrary->set_id($objLibrary->CleanData($_POST["data_id"]));
									if ($objLibrary->update()) {
										echo "success";
									}
									else{
										echo "error";
									}
								
							}else if (!empty($_FILES)) {
								$foldername=trim($_POST["folderName"]);
								$foldercreate=$libraryFolderPath.$foldername."/";
								// make file upload
								if (!empty($_FILES['file_array']['name'][0])) {
									// declaring a new variable for the gloabl 
									$files=$_FILES['file_array'];
									$allowed=array('docx','doc','txt','pdf','ppt','pptx','xls','txt','png','jpeg','jpg');

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
														echo "ERROR UPLOADING FILES";
														die();
													}
										}
											// end of if file is allowed
											else{
												echo "WRONG FILE FORMATS UPLOADED, CHECK AND REUPLOAD";
												die();
											}
								}
									
								// if file is uploaded successfully then save details in database
									if ($fileup) {
										$objLibrary = new Library;
										$objLibrary->set_librarySubject($objLibrary->CleanData($_POST["librarySubject"]));
										$objLibrary->set_libraryDescription($objLibrary->CleanData($_POST["libraryDescription"]));
										$objLibrary->set_id($objLibrary->CleanData($_POST["data_id"]));
										if ($objLibrary->update()) {
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
									if (isset($_POST["folderName"])) {
										$folderDel = $libraryFolderPath.trim($_POST["folderName"])."/";

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
											// now delete folder
											if (rmdir($folderDel)) {
												// if folder is removed now we clear the records from the database
												$objLibrary = new Library;
											      $objLibrary->set_id($objLibrary->CleanData($_POST["data_id"]));
											      if ($objLibrary->delete()) {
														echo "success";
													}
													else{
														echo "error";
													}
											}
										}
									}else{
									// else if no foldername then just delete entry
										  $objLibrary = new Library;
									      $objLibrary->set_id($objLibrary->CleanData($_POST["data_id"]));
									      if ($objLibrary->delete()) {
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
									  $objLibrary = new Library;  
								      $objLibrary->set_id($objLibrary->CleanData($_POST["data_id"]));
								      $library_details = $objLibrary->get_library_by_id();
								      print_r($library_details);  
								 }else{die();}
						break;
						// select all news
						case 'get_document_content':
							// files list array
							$fileListArray = [];

							if(isset($_POST["folderName"])){
								$parentFolder = trim($_POST["folderName"]);
								$folder = $libraryFolderPath.$parentFolder;
							    // Check directory exists or not
							    if(file_exists($folder) && is_dir($folder)){
							        // Scan the files in this directory
							        $result = scandir($folder);
							        // Filter out the current (.) and parent (..) directories
							        $files = array_diff($result, array('.', '..'));
							        if(count($files) > 0){
							            // Loop through retuned array
							            foreach($files as $file){
							                if(is_file("$folder/$file")){
							                    // Display filename
							                   $fileListArray[] = "<ul><li><b><span>".$file."</span> <span id='".$file."' name='".$parentFolder."' class='btn btn-danger btn-xs glyphicon glyphicon-trash file_del_btn'> DELETE FILE</span> </b></li></ul>";
							                } 
							            }
							            // return array of files
							            print_r(json_encode($fileListArray));
							        } else{
							            echo "ERROR: No files found in the directory.";
							        	}
							    } else {
							        echo "NO FOLDER";
							    }

							}else{
									die();
								}

						break;
						// removing file from folder
						case 'deleteFile';
							// check if foldername and filename have being set
							$fileName = trim($_POST["fileName"]);
							$folderName = trim($_POST["folderName"]);
							if (isset($fileName) AND isset($folderName)) {
								$delteFilePath = $libraryFolderPath.$folderName."/".$fileName;
								if (file_exists($delteFilePath)) {
									unlink($delteFilePath);
									echo "success";
								}else{
									echo "no_file";
								}
							}
						break;
////////////////////////////////////////////////////////////////////////////////
					//for library achivee
						case 'get_library_archive';
							if(isset($_POST["divison_id"])){
								  $objLibrary = new Library;  
							      $objLibrary->set_division($objLibrary->CleanData($_POST["divison_id"]));
							      $library_details = $objLibrary->get_library_subject();
							      print_r($library_details);  
							 }else{die();}
						break;

						case 'get_folder_content_display':
							// files list array
							$fileListArray = [];

							if(isset($_POST["folderName"])){
								$parentFolder = trim($_POST["folderName"]);
								$folder = $libraryFolderPath.$parentFolder;
							    // Check directory exists or not
							    if(file_exists($folder) && is_dir($folder)){
							        // Scan the files in this directory
							        $result = scandir($folder);
							        // Filter out the current (.) and parent (..) directories
							        $files = array_diff($result, array('.', '..'));
							        if(count($files) > 0){
							            // Loop through retuned array
							            foreach($files as $file){
							                if(is_file("$folder/$file")){
							                    // Display filename
							                   $fileListArray[] = "<ul><li><b><span>".$file."</span> <span id='".$file."' name='".$parentFolder."' class='btn btn-info btn-xs glyphicon glyphicon-file readFile'> READ FILE</span> </b></li></ul>";
							                } 
							            }
							            // return array of files
							            print_r(json_encode($fileListArray));
							        } else{
							            echo "ERROR: No files found in the directory.";
							        	}
							    } else {
							        echo "NO FOLDER";
							    }

							}else{
									die();
								}
						break;
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objLibraryControl = new LibraryControl;
 ?>