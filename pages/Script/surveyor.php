<?php
	require_once("../Classes/Surveyor.php"); 
	session_start();
	class SurveyorControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objSurveyor = new Surveyor;
							$objSurveyor->set_surveyorType($objSurveyor->CleanData(strtoupper($_POST["surveyorType"])));
							if ($objSurveyor->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objSurveyor = new Surveyor;
							$objSurveyor->set_surveyorType($objSurveyor->CleanData(strtoupper($_POST["surveyorType"])));
							$objSurveyor->set_id($objSurveyor->CleanData($_POST["data_id"]));
							if ($objSurveyor->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objSurveyor = new Surveyor;
								      $objSurveyor->set_id($objSurveyor->CleanData($_POST["data_id"]));
								      if ($objSurveyor->delete()) {
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
									 $objSurveyor = new Surveyor;  
								      $objSurveyor->set_id($objSurveyor->CleanData($_POST["data_id"]));
								      $surveyorType_details = $objSurveyor->get_surveyorType_by_id();
								      print_r($surveyorType_details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objSurveyorControl = new SurveyorControl;
 ?>