<?php
	require_once("../Classes/Members.php"); 
	session_start();
	class MembersControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objMembers = new Members();
							$objMembers->set_firstName($objMembers->CleanData($_POST["firstName"]));
							$objMembers->set_lastName($objMembers->CleanData($_POST["lastName"]));
							$objMembers->set_otherName($objMembers->CleanData($_POST["otherName"]));
							$objMembers->set_personalContact($objMembers->CleanData($_POST["personalContact"]));
							$objMembers->set_emergencyContact($objMembers->CleanData($_POST["emergencyContact"]));
							$objMembers->set_houseNumber($objMembers->CleanData($_POST["houseNumber"]));
							$objMembers->set_houseLocation($objMembers->CleanData($_POST["houseLocation"]));
							$objMembers->set_postalAddress($objMembers->CleanData($_POST["postalAddress"]));
							$objMembers->set_professionalNumber($objMembers->CleanData($_POST["professionalNumber"]));
							$objMembers->set_surveyorType($objMembers->CleanData($_POST["surveyorType"]));
							$objMembers->set_designation($objMembers->CleanData($_POST["designation"]));
							$objMembers->set_companyName($objMembers->CleanData($_POST["companyName"]));
							$objMembers->set_companyType($objMembers->CleanData($_POST["companyType"]));
							$objMembers->set_companyContact($objMembers->CleanData($_POST["companyContact"]));
							$objMembers->set_corporateEmail($objMembers->CleanData($_POST["corporateEmail"]));
							$objMembers->set_region($objMembers->CleanData($_POST["region"]));
							$objMembers->set_officeLocation($objMembers->CleanData($_POST["officeLocation"]));
							$objMembers->set_comapanyAddress($objMembers->CleanData($_POST["comapanyAddress"]));
							if ($objMembers->insert()) {
									echo "success";

								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objMembers = new Members();
							$objMembers->set_id($objMembers->CleanData($_POST["data_id"]));
							$objMembers->set_firstName($objMembers->CleanData($_POST["firstName"]));
							$objMembers->set_lastName($objMembers->CleanData($_POST["lastName"]));
							$objMembers->set_otherName($objMembers->CleanData($_POST["otherName"]));
							$objMembers->set_personalContact($objMembers->CleanData($_POST["personalContact"]));
							$objMembers->set_emergencyContact($objMembers->CleanData($_POST["emergencyContact"]));
							$objMembers->set_houseNumber($objMembers->CleanData($_POST["houseNumber"]));
							$objMembers->set_houseLocation($objMembers->CleanData($_POST["houseLocation"]));
							$objMembers->set_postalAddress($objMembers->CleanData($_POST["postalAddress"]));
							$objMembers->set_professionalNumber($objMembers->CleanData($_POST["professionalNumber"]));
							$objMembers->set_surveyorType($objMembers->CleanData($_POST["surveyorType"]));
							$objMembers->set_designation($objMembers->CleanData($_POST["designation"]));
							$objMembers->set_companyName($objMembers->CleanData($_POST["companyName"]));
							$objMembers->set_companyType($objMembers->CleanData($_POST["companyType"]));
							$objMembers->set_companyContact($objMembers->CleanData($_POST["companyContact"]));
							$objMembers->set_corporateEmail($objMembers->CleanData($_POST["corporateEmail"]));
							$objMembers->set_region($objMembers->CleanData($_POST["region"]));
							$objMembers->set_officeLocation($objMembers->CleanData($_POST["officeLocation"]));
							$objMembers->set_comapanyAddress($objMembers->CleanData($_POST["comapanyAddress"]));
							if ($objMembers->update()) {
									echo "success";

								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
						
							if(isset($_POST["data_id"])){
									  $objMembers = new Members();    
								      $objMembers->set_id($objMembers->CleanData($_POST["data_id"]));
								      $member_details = $objMembers->delete();
								      echo $member_details;  
								 }else{die();}
						break;
						// geting details of a member with id
						case 'updateModal':
							if(isset($_POST["data_id"])){
									  $objMembers = new Members();    
								      $objMembers->set_id($objMembers->CleanData($_POST["data_id"]));
								      $member_details = $objMembers->get_member();
								      echo $member_details;  
								 }else{die();}
						break;
						// updating details of members
						case 'profileUpdate':
							$objMembers = new Members();
							$objMembers->set_firstName($objMembers->CleanData($_POST["firstName"]));
							$objMembers->set_lastName($objMembers->CleanData($_POST["lastName"]));
							$objMembers->set_otherName($objMembers->CleanData($_POST["otherName"]));
							$objMembers->set_personalContact($objMembers->CleanData($_POST["personalContact"]));
							$objMembers->set_emergencyContact($objMembers->CleanData($_POST["emergencyContact"]));
							$objMembers->set_houseNumber($objMembers->CleanData($_POST["houseNumber"]));
							$objMembers->set_houseLocation($objMembers->CleanData($_POST["houseLocation"]));
							$objMembers->set_postalAddress($objMembers->CleanData($_POST["postalAddress"]));
							$objMembers->set_professionalNumber($objMembers->CleanData($_POST["professionalNumber"]));
							$objMembers->set_surveyorType($objMembers->CleanData($_POST["surveyorType"]));
							$objMembers->set_designation($objMembers->CleanData($_POST["designation"]));
							$objMembers->set_companyName($objMembers->CleanData($_POST["companyName"]));
							$objMembers->set_companyType($objMembers->CleanData($_POST["companyType"]));
							$objMembers->set_companyContact($objMembers->CleanData($_POST["companyContact"]));
							$objMembers->set_corporateEmail($objMembers->CleanData($_POST["corporateEmail"]));
							$objMembers->set_region($objMembers->CleanData($_POST["region"]));
							$objMembers->set_officeLocation($objMembers->CleanData($_POST["officeLocation"]));
							$objMembers->set_comapanyAddress($objMembers->CleanData($_POST["comapanyAddress"]));
							if ($objMembers->update_profile()) {
									echo "success";

								}
								else{
									echo "error";
								}
						break;

						// get all members
						case 'get_members':
							$objMembers = new Members();
							if ($objMembers->get_member_list()) {
								print_r($objMembers->get_member_list());
							}
							break;
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objMembersControl = new MembersControl();
 ?>