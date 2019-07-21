<?php
	require_once("../Classes/CommitteeNote.php"); 
	session_start();
	class CommitteeNoteControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objCommitteeNote = new CommitteeNote;
							$objCommitteeNote->set_commNoteTitle($objCommitteeNote->CleanData($_POST["commNoteTitle"]));
							$objCommitteeNote->set_commNoteMessage($objCommitteeNote->CleanData($_POST["commNoteMessage"]));
							$objCommitteeNote->set_commId($objCommitteeNote->CleanData($_POST["data_id"]));
							if ($objCommitteeNote->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objCommitteeNote = new CommitteeNote;
							$objCommitteeNote->set_groupName($objCommitteeNote->CleanData($_POST["groupName"]));
							$objCommitteeNote->set_groupPages(json_encode($_POST["groupPages"]));
							$objCommitteeNote->set_id($objCommitteeNote->CleanData($_POST["data_id"]));
							if ($objCommitteeNote->update()) {
								echo "success";
							}
							else{
								echo "error";
							}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
								 $objCommitteeNote = new CommitteeNote;
							      $objCommitteeNote->set_id($objCommitteeNote->CleanData($_POST["data_id"]));
							      if ($objCommitteeNote->delete()) {
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
								 $objCommitteeNote = new CommitteeNote;  
							      $objCommitteeNote->set_id($objCommitteeNote->CleanData($_POST["data_id"]));
							      $group_details = $objCommitteeNote->get_groups_by_id();
							      print_r($group_details);  
							 }else{die();}
						break;
						// get all notes
						case 'get_notes':
							$objCommitteeNote = new CommitteeNote;
							$objCommitteeNote->set_commId($objCommitteeNote->CleanData($_POST["data_id"]));
							print_r(json_encode($objCommitteeNote->get_committee_notes(),true));
						break;
						default:
							echo "error";
							break;
					}

				}
			}

	$objCommitteeNoteControl = new CommitteeNoteControl;
 ?>