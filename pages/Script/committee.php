<?php
	require_once("../Classes/Committee.php"); 
	session_start();
	class committeeControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objCommittee= new Committee;
							$objCommittee->set_committeeName($objCommittee->CleanData($_POST["committeeName"]));
							$objCommittee->set_committeeFolder(substr(str_shuffle('abcdefghijklmnopqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,7));
							$objCommittee->set_committeeMembers(json_encode($_POST["committeeMembers"]));
							$objCommittee->set_committeePages(json_encode($_POST["committeePages"]));
							$committeeId = $objCommittee->insert();
							if (!empty($committeeId)) {
								foreach ($_POST["committeeMembers"] as $memberId) {
									$objCommittee->update_member_committee($memberId,$committeeId);
								}
								echo "success";
							}
							else{
								echo "error";
							}
						break;
					// for update
						case 'update':
							$objCommittee= new Committee;
							$objCommittee->set_id($objCommittee->CleanData($_POST["data_id"]));
							$objCommittee->set_committeeName($objCommittee->CleanData($_POST["committeeName"]));
							$objCommittee->set_committeeMembers(json_encode($_POST["committeeMembers"]));
							$objCommittee->set_committeePages(json_encode($_POST["committeePages"]));
							
							if ($objCommittee->update()) {
									foreach ($_POST["committeeMembers"] as $memberId) {
										$objCommittee->update_member_committee($memberId,trim($_POST["data_id"]));
									}
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									  $objCommittee= new Committee;
								      $objCommittee->set_id($objCommittee->CleanData($_POST["data_id"]));
								      $objCommittee->set_recordHide("YES");
								      if ($objCommittee->delete()) {
								      	return true;
								      }
								      else{
								      	return false;
								      }
								     
								 }else{die();}
						break;
						// geting details of a member with id
						case 'getInfo':
							if(isset($_POST["data_id"])){
									 $objCommittee= new Committee;  
								      $objCommittee->set_id($objCommittee->CleanData($_POST["data_id"]));
								      $details = $objCommittee->get_committee_by_id();
								      print_r($details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objcommitteeControl = new committeeControl;
 ?>