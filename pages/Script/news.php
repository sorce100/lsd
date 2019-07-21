<?php
	require_once("../Classes/News.php"); 
	session_start();
	class NewsControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							if (empty($_FILES['files']['name'][0])) {
								$objNews = new News;
								$objNews->set_fileName("NULL");
								$objNews->set_folderName("NULL");
								$objNews->set_newsTitle(trim($_POST["newsTitle"]));
								$objNews->set_newscategory($objNews->CleanData($_POST["newscategory"]));
								$objNews->set_newsContent($_POST["newsContent"]);
								$objNews->set_madeBy($objNews->CleanData($_POST["madeBy"]));
								
								if ($objNews->insert()) {
										echo "success";
									}
									else{
										echo "error";
									}

							}else if (!empty($_FILES)) {
								$foldername=trim(date("m-d-Yis"));
								$foldercreate="../../uploads/news/".$foldername."/";
								// error for when folder could not created to contain images uploaded
								if(!mkdir($foldercreate,0777,true)) {
										echo "SORRY, FILE WAS NOT CREATED";
									}

								// for
								if (!empty($_FILES['files']['name'][0])) {
										// declaring a new variable for the gloabl 
										$files=$_FILES['files'];
										$allowed=array("jpg", "jpeg", "png", "gif");

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

														// get an array of the file names and convert to json
														$fileNamesArray[] = $filenewname;
														// moving file from temporal location to permanent storage
														$fileup=move_uploaded_file($file_tmp,$filedestination);
																}
																// end of if to check file size
															}
															// end of file erroe
															else{
																echo "Could not upload";
															}
														}
												// end of if file is allowed
												else{
													// return to the page 
													echo "Please enter the right file formats";
												}
										} 
									//if files have being successfully saved then you save the name
										if ($fileup) {
												$objNews = new News;
												$objNews->set_folderName($foldername);
												$objNews->set_fileName(json_encode($fileNamesArray));
												$objNews->set_newsTitle(trim($_POST["newsTitle"]));
												$objNews->set_newscategory($objNews->CleanData($_POST["newscategory"]));
												$objNews->set_newsContent($_POST["newsContent"]);
												$objNews->set_madeBy($objNews->CleanData($_POST["madeBy"]));
												
												if ($objNews->insert()) {
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
							$objNews = new News;
							$objNews->set_newsTitle($objNews->CleanData($_POST["newsTitle"]));
							$objNews->set_newscategory($objNews->CleanData($_POST["newscategory"]));
							$objNews->set_newsContent($_POST["newsContent"]);
							$objNews->set_id($objNews->CleanData($_POST["data_id"]));
							if ($objNews->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objNews = new News;
								      $objNews->set_id($objNews->CleanData($_POST["data_id"]));
								      $news_details = $objNews->delete();
								      echo $news_details;  
								 }else{die();}
						break;
						// geting details of a member with id
						case 'updateModal':
							if(isset($_POST["data_id"])){
									 $objNews = new News;  
								      $objNews->set_id($objNews->CleanData($_POST["data_id"]));
								      $news_details = $objNews->get_news_by_id();
								      print_r($news_details);  
								 }else{die();}
						break;
						// select all news
						case 'get_all':
							if(isset($_POST["mode"])){
									 $objNews = new News;  
								      $news_details = $objNews->get_news();
								      print_r($news_details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objNewsControl = new NewsControl;
 ?>