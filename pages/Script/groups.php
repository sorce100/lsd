<?php
	require_once("../Classes/Groups.php"); 
	session_start();
	class GroupsControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objGroups = new Groups;
							$objGroups->set_groupName($objGroups->CleanData($_POST["groupName"]));
							$objGroups->set_groupPages(json_encode($_POST["groupPages"]));
							if ($objGroups->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objGroups = new Groups;
							$objGroups->set_groupName($objGroups->CleanData($_POST["groupName"]));
							$objGroups->set_groupPages(json_encode($_POST["groupPages"]));
							$objGroups->set_id($objGroups->CleanData($_POST["data_id"]));
							if ($objGroups->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objGroups = new Groups;
								      $objGroups->set_id($objGroups->CleanData($_POST["data_id"]));
								      if ($objGroups->delete()) {
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
									 $objGroups = new Groups;  
								      $objGroups->set_id($objGroups->CleanData($_POST["data_id"]));
								      $group_details = $objGroups->get_groups_by_id();
								      print_r($group_details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objGroupsControl = new GroupsControl;
 ?>