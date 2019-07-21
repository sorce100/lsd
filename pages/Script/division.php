<?php
	require_once("../Classes/Division.php"); 
	session_start();
	class DivisionControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objDivision = new Division;
							$objDivision->set_divisionFullname($objDivision->CleanData($_POST["divisionFullname"]));
							$objDivision->set_divisionAlias($objDivision->CleanData($_POST["divisonAlias"]));
							$objDivision->set_divisionYoutube(trim($_POST["divisionYoutube"]));
							$objDivision->set_madeby($_SESSION['user_id']);
							if ($objDivision->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objDivision = new Division;
							$objDivision->set_id($objDivision->CleanData($_POST["data_id"]));
							$objDivision->set_divisionFullname($objDivision->CleanData($_POST["divisionFullname"]));
							$objDivision->set_divisionAlias($objDivision->CleanData($_POST["divisonAlias"]));
							$objDivision->set_divisionYoutube(trim($_POST["divisionYoutube"]));
							if ($objDivision->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									  $objDivision = new Division;
								      $objDivision->set_id($objDivision->CleanData($_POST["data_id"]));
								      $objDivision->set_recordHide("YES");
								      if ($objDivision->delete()) {
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
									 $objDivision = new Division;  
								      $objDivision->set_id($objDivision->CleanData($_POST["data_id"]));
								      $division_details = $objDivision->get_division_by_id();
								      print_r($division_details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objDivisionControl = new DivisionControl;
 ?>