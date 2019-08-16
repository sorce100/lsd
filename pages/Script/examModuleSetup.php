<?php
	require_once("../Classes/ExamModuleSetup.php"); 
	session_start();
	class examModuleSetupControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objExamModuleSetup = new ExamModuleSetup;
							$objExamModuleSetup->set_centerExamPart($objExamModuleSetup->CleanData($_POST["centerExamPart"]));
							$objExamModuleSetup->set_centerExamSubject(json_encode($_POST["centerExamSubject"]));
							$objExamModuleSetup->set_centerId($objExamModuleSetup->CleanData($_POST["centerId"]));
							$returnedCenterId = $objExamModuleSetup->insert();
							if (!empty($returnedCenterId)) {

								echo "success";
							}
							else{
								echo "error";
							}
						break;
					// for update
						case 'update':
							$objExamModuleSetup = new ExamModuleSetup;
							$objExamModuleSetup->set_centerExamPart($objExamModuleSetup->CleanData($_POST["centerExamPart"]));
							$objExamModuleSetup->set_centerExamSubject(json_encode($_POST["centerExamSubject"]));
							$objExamModuleSetup->set_id($objExamModuleSetup->CleanData($_POST["data_id"]));
							if ($objExamModuleSetup->update()) {
								echo "success";
							}
							else{
								echo "error";
							}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
								 $objExamModuleSetup = new ExamModuleSetup;
							      $objExamModuleSetup->set_id($objExamModuleSetup->CleanData($_POST["data_id"]));
							      $objExamModuleSetup->set_recordHide('YES');
							      if ($objExamModuleSetup->delete()) {
							      	echo "success";
							      }
							      else{
							      	echo "error";
							      }
							     
							 }else{die();}
						break;
						// geting details of a member with id
						case 'updateModal':
							if(isset($_POST["data_id"])){
								 $objExamModuleSetup = new ExamModuleSetup;  
							      $objExamModuleSetup->set_id($objExamModuleSetup->CleanData($_POST["data_id"]));
							      $group_details = $objExamModuleSetup->get_center_module_by_id();
							      print_r($group_details);  
							 }else{die();}
						break;
						// get all notes
						case 'get_all':
							$objExamModuleSetup = new ExamModuleSetup;
							$objExamModuleSetup->set_id($objExamModuleSetup->CleanData($_POST["data_id"]));
							print_r(json_encode($objExamModuleSetup->get_centers(),true));
						break;
						default:
							echo "error";
							break;
					}

				}
			}

	$objexamModuleSetupControl = new examModuleSetupControl;
 ?>