<?php
	require_once("../Classes/CommitteeTask.php"); 
	session_start();
	class CommitteeTasControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objCommitteeTask = new CommitteeTask;
							$objCommitteeTask->set_commId($objCommitteeTask->CleanData($_POST["commId"]));
							$objCommitteeTask->set_commTaskName($objCommitteeTask->CleanData($_POST["commTaskName"]));
							$objCommitteeTask->set_commTaskExpiry($objCommitteeTask->CleanData($_POST["commTaskExpiry"]));
							$objCommitteeTask->set_commTaskDesc(trim($_POST["commTaskDesc"]));
							if ($objCommitteeTask->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objCommitteeTask = new CommitteeTask;
							$objCommitteeTask->set_commTaskName($objCommitteeTask->CleanData($_POST["commTaskName"]));
							$objCommitteeTask->set_commTaskExpiry($objCommitteeTask->CleanData($_POST["commTaskExpiry"]));
							$objCommitteeTask->set_commTaskDesc(trim($_POST["commTaskDesc"]));
							$objCommitteeTask->set_id($objCommitteeTask->CleanData($_POST["data_id"]));
							if ($objCommitteeTask->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objCommitteeTask = new CommitteeTask;
								      $objCommitteeTask->set_recordHide("YES");
								      $objCommitteeTask->set_id($objCommitteeTask->CleanData($_POST["data_id"]));
								      if ($objCommitteeTask->delete()) {
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
									 $objCommitteeTask = new CommitteeTask;  
								      $objCommitteeTask->set_id($objCommitteeTask->CleanData($_POST["data_id"]));
								      $details = $objCommitteeTask->get_comm_tasks_by_id();
								      print_r($details);  
								 }else{die();}
						break;
						// getting all tasks of committee
						case 'getCommTasks':
							if(isset($_POST["commId"])){
								  $objCommitteeTask = new CommitteeTask;  
							      $objCommitteeTask->set_commId($objCommitteeTask->CleanData($_POST["commId"]));
							      $details = $objCommitteeTask->get_committee_tasks();
							      print_r($details);  
							 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objCommitteeTaskControl = new CommitteeTasControl;
 ?>