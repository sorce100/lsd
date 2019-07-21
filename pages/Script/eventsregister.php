<?php
	require_once("../Classes/EventsRegister.php"); 
	require_once("../Classes/UserBalance.php");
	session_start();
	class EventsRegisterControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
						// 	GENERATING EVENT TICKET FOR MEMBER
							$ticket = "GhIS".trim($_POST["data_id"]).trim($_SESSION['member_id']);

							 $objUserBalance = new UserBalance;
							 $getBalance = $objUserBalance->get_balance();
							 if (trim($getBalance["current_balance"]) > trim($_POST["eventFee"])) {
							 		// if there is enough balance then set the properties of the class
							 		$objUserBalance->set_reason($objUserBalance->CleanData($_POST["eventTheme"]));
							 		$objUserBalance->set_type($objUserBalance->CleanData("DEBIT"));
							 		$objUserBalance->set_purpose($objUserBalance->CleanData("EVENT"));
							 		$objUserBalance->set_pay_amount($objUserBalance->CleanData($_POST["eventFee"]));
							 		$objUserBalance->set_balance(trim($getBalance["current_balance"]) - trim($_POST["eventFee"]));
									$objUserBalance->set_member_id($_SESSION['member_id']);
									// IF MONEY IS SAVED INTO WALLERT THEN EVENT IS BOOKED
							  		if ($objUserBalance->wallet_save()) {
							  				$objEventsRegister = new EventsRegister;
											$objEventsRegister->set_eventId($objEventsRegister->CleanData($_POST["data_id"]));
											$objEventsRegister->set_memberId($objEventsRegister->CleanData($_SESSION['member_id']));
											$objEventsRegister->set_eventFeePayed($objEventsRegister->CleanData($_POST["eventFee"]));
											$objEventsRegister->set_eventTicket($ticket);
											if ($objEventsRegister->insert()) {
													echo "success";
												}
												else{
													echo "error";
												}

							  			}else{return false;}
							  	}else{echo "insufficient_Balance";} 	
						break;
					// meeting register
						case 'meeting_register':
							$ticket = "Meeting".trim($_POST["data_id"]);
							$objEventsRegister = new EventsRegister;
							$objEventsRegister->set_eventId($objEventsRegister->CleanData($_POST["data_id"]));
							$objEventsRegister->set_memberId($objEventsRegister->CleanData($_POST["dipNo"]));
							$objEventsRegister->set_memberName($objEventsRegister->CleanData($_POST["memberName"]));
							$objEventsRegister->set_eventFeePayed('0');
							$objEventsRegister->set_eventTicket($ticket);
							if ($objEventsRegister->meeting_insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objEventsRegister = new EventsRegister;
								      $objEventsRegister->set_id($objEventsRegister->CleanData($_POST["data_id"]));
								      if ($objEventsRegister->delete()) {
								      	return true;
								      }
								      else{
								      	return false;
								      }
								     
								 }else{die();}
						break;
						// geting details of a member with id
						case 'ticket_check':
							if(isset($_POST["data_id"])){
									 $objEventsRegister = new EventsRegister;  
								      $objEventsRegister->set_eventId($objEventsRegister->CleanData($_POST["data_id"]));
									  $objEventsRegister->set_memberId($objEventsRegister->CleanData($_SESSION['member_id']));
								      $ticket = $objEventsRegister->check_event_ticket();
								      print_r($ticket);  
								 }else{die();}
						break;
						// getting list of all members who have registered for the event
						case 'view_participants':
							if(isset($_POST["data_id"])){
									 $objEventsRegister = new EventsRegister;  
								      $objEventsRegister->set_eventId($objEventsRegister->CleanData($_POST["data_id"]));
								      $participants = $objEventsRegister->get_participants();
								      $jsonDecode = count(json_decode($participants));
								      if ($jsonDecode == 0) {
								      		echo "empty";
								      }elseif ($jsonDecode >= 1) {
								      	 print_r($participants); 
								      }
								      
								 }else{die();}

							break;
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objEventsRegisterControl = new EventsRegisterControl;
 ?>