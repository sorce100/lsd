<?php
	require_once("../Classes/Events.php"); 
	session_start();
	class EventsControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objEvents = new Events;
							$objEvents->set_eventType("Event");
							$objEvents->set_eventTheme($objEvents->CleanData($_POST["eventTheme"]));
							$objEvents->set_eventVenue($objEvents->CleanData($_POST["eventVenue"]));
							$objEvents->set_eventFee($objEvents->CleanData($_POST["eventFee"]));
							$objEvents->set_eventStartDate($objEvents->CleanData($_POST["eventStartDate"]));
							$objEvents->set_eventEndDate($objEvents->CleanData($_POST["eventEndDate"]));
							$objEvents->set_startTime($objEvents->CleanData($_POST["startTime"]));
							$objEvents->set_endTime($objEvents->CleanData($_POST["endTime"]));
							// removing empty indexes
							$hotelNames = array_filter($_POST["hotelNames"]);
							$hotelPrices = array_filter($_POST["hotelPrices"]);
							
							$objEvents->set_hotelNames(json_encode($hotelNames));
							$objEvents->set_hotelPrices(json_encode($hotelPrices));
							if ($objEvents->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;

					// for meeting insert
						case 'meeting_insert':
							$objEvents = new Events;
							$objEvents->set_eventType("Meeting");
							$objEvents->set_eventTheme($objEvents->CleanData($_POST["meetingTitle"]));
							$objEvents->set_eventVenue($objEvents->CleanData($_POST["meetingLocation"]));
							$objEvents->set_eventEndDate($objEvents->CleanData($_POST["meetingDate"]));
							$objEvents->set_startTime($objEvents->CleanData($_POST["startTime"]));
							$objEvents->set_endTime($objEvents->CleanData($_POST["endTime"]));
							if ($objEvents->meeting_insert()) {
								echo "success";
							}
							else{
								echo "error";
							}
						break;
					// for update
						case 'update':
							$objEvents = new Events;
							$objEvents->set_eventTheme($objEvents->CleanData($_POST["eventTheme"]));
							$objEvents->set_eventVenue($objEvents->CleanData($_POST["eventVenue"]));
							$objEvents->set_eventFee($objEvents->CleanData($_POST["eventFee"]));
							$objEvents->set_eventStartDate($objEvents->CleanData($_POST["eventStartDate"]));
							$objEvents->set_eventEndDate($objEvents->CleanData($_POST["eventEndDate"]));
							$objEvents->set_startTime($objEvents->CleanData($_POST["startTime"]));
							$objEvents->set_endTime($objEvents->CleanData($_POST["endTime"]));
							// removing empty indexes
							$hotelNames = array_filter($_POST["hotelNames"]);
							$hotelPrices = array_filter($_POST["hotelPrices"]);
							
							$objEvents->set_hotelNames(json_encode($hotelNames));
							$objEvents->set_hotelPrices(json_encode($hotelPrices));
							$objEvents->set_id($objEvents->CleanData($_POST["data_id"]));
							if ($objEvents->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// update meeting
						case 'update_meeting':
							$objEvents = new Events;
							$objEvents->set_eventTheme($objEvents->CleanData($_POST["meetingTitle"]));
							$objEvents->set_eventVenue($objEvents->CleanData($_POST["meetingLocation"]));
							$objEvents->set_eventEndDate($objEvents->CleanData($_POST["meetingDate"]));
							$objEvents->set_startTime($objEvents->CleanData($_POST["startTime"]));
							$objEvents->set_endTime($objEvents->CleanData($_POST["endTime"]));
							$objEvents->set_id($objEvents->CleanData($_POST["data_id"]));
							if ($objEvents->update_meeting()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objEvents = new Events;
								      $objEvents->set_id($objEvents->CleanData($_POST["data_id"]));
								      if ($objEvents->delete()) {
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
									 $objEvents = new Events;  
								      $objEvents->set_id($objEvents->CleanData($_POST["data_id"]));
								      $event_details = $objEvents->get_events_by_id();
								      print_r($event_details);  
								 }else{die();}
						break;
						// get event price
						case 'get_event_price':
							if(isset($_POST["data_id"])){
									 $objEvents = new Events;  
								      $objEvents->set_id($objEvents->CleanData($_POST["data_id"]));
								      $event_price = $objEvents->get_event_price();
								      print_r($event_price);  
								 }else{die();}
							break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objEventsControl = new EventsControl;
 ?>