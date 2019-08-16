<?php
	require_once("../Classes/ExamCenterSetup.php"); 
	session_start();
	class examCenterSetupControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objExamCenterSetup = new ExamCenterSetup;
							$objExamCenterSetup->set_centerName($objExamCenterSetup->CleanData($_POST["centerName"]));
							$objExamCenterSetup->set_centerRegion($objExamCenterSetup->CleanData($_POST["centerRegion"]));
							$returnedCenterId = $objExamCenterSetup->insert();
							if (!empty($returnedCenterId)) {
								echo "success";
							}
							else{
								echo "error";
							}
						break;
					// for update
						case 'update':
							$objExamCenterSetup = new ExamCenterSetup;
							$objExamCenterSetup->set_centerName($objExamCenterSetup->CleanData($_POST["centerName"]));
							$objExamCenterSetup->set_centerRegion($objExamCenterSetup->CleanData($_POST["centerRegion"]));
							$objExamCenterSetup->set_id($objExamCenterSetup->CleanData($_POST["data_id"]));
							if ($objExamCenterSetup->update()) {
								
								echo "success";
							}
							else{
								echo "error";
							}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
								 $objExamCenterSetup = new ExamCenterSetup;
							      $objExamCenterSetup->set_id($objExamCenterSetup->CleanData($_POST["data_id"]));
							      $objExamCenterSetup->set_recordHide('YES');
							      if ($objExamCenterSetup->delete()) {
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
								 $objExamCenterSetup = new ExamCenterSetup;  
							      $objExamCenterSetup->set_id($objExamCenterSetup->CleanData($_POST["data_id"]));
							      $group_details = $objExamCenterSetup->get_center_by_id();
							      print_r($group_details);  
							 }else{die();}
						break;
						// get all notes
						case 'get_all':
							$objExamCenterSetup = new ExamCenterSetup;
							$objExamCenterSetup->set_id($objExamCenterSetup->CleanData($_POST["data_id"]));
							print_r(json_encode($objExamCenterSetup->get_centers(),true));
						break;
						default:
							echo "error";
							break;
					}

				}
			}

	$objexamCenterSetupControl = new examCenterSetupControl;
 ?>