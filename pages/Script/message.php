<?php
	require_once("../Classes/Messages.php"); 
	session_start();
	class MessagesControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objMessages = new Messages;
							$objMessages->set_messageGroup($objMessages->CleanData($_POST["messageGroup"]));
							$objMessages->set_messageSubject($objMessages->CleanData($_POST["messageSubject"]));
							$objMessages->set_messageContent($_POST["messageContent"]);
							$objMessages->set_messageSender($objMessages->CleanData($_SESSION['user_id']));
							$objMessages->set_memberList(json_encode($_POST["memberList"]));
							if ($objMessages->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objMessages = new Messages;
							$objMessages->set_groupName($objMessages->CleanData($_POST["groupName"]));
							$objMessages->set_groupPages(json_encode($_POST["groupPages"]));
							$objMessages->set_id($objMessages->CleanData($_POST["data_id"]));
							if ($objMessages->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objMessages = new Messages;
								      $objMessages->set_id($objMessages->CleanData($_POST["data_id"]));
								      if ($objMessages->delete()) {
								      	return true;
								      }
								      else{
								      	return false;
								      }
								     
								 }else{die();}
						break;
						// geting details of a member with id
						case 'readMessage':
							if(isset($_POST["data_id"])){
									  $objMessages = new Messages;  
								      $objMessages->set_id($objMessages->CleanData($_POST["data_id"]));
								      $message_details = $objMessages->get_messages_by_id();
								      print_r($message_details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objMessagesControl = new MessagesControl;
 ?>