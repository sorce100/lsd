<?php
	require_once("../Classes/LiveStream.php"); 
	session_start();
	class LiveStreamControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objLiveStream = new LiveStream;
							$objLiveStream->set_eventTitle($objLiveStream->CleanData($_POST["eventTitle"]));
							$objLiveStream->set_startDate($objLiveStream->CleanData($_POST["startDate"]));
							$objLiveStream->set_eventRate($objLiveStream->CleanData($_POST["eventRate"]));
							$objLiveStream->set_startTime($objLiveStream->CleanData($_POST["startTime"]));
							$objLiveStream->set_endTime($objLiveStream->CleanData($_POST["endTime"]));
							$objLiveStream->set_enterAmount($objLiveStream->CleanData($_POST["enterAmount"]));
							$objLiveStream->set_userId($objLiveStream->CleanData($_SESSION['user_id']));
							$objLiveStream->set_division($objLiveStream->CleanData($_SESSION['division']));

							if ($objLiveStream->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objLiveStream = new LiveStream;
							$objLiveStream->set_id($objLiveStream->CleanData($_POST["data_id"]));
							$objLiveStream->set_eventTitle($objLiveStream->CleanData($_POST["eventTitle"]));
							$objLiveStream->set_startDate($objLiveStream->CleanData($_POST["startDate"]));
							$objLiveStream->set_startTime($objLiveStream->CleanData($_POST["startTime"]));
							$objLiveStream->set_endTime($objLiveStream->CleanData($_POST["endTime"]));
							$objLiveStream->set_eventRate($objLiveStream->CleanData($_POST["eventRate"]));
							$objLiveStream->set_enterAmount($objLiveStream->CleanData($_POST["enterAmount"]));
							if ($objLiveStream->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									  $objLiveStream = new LiveStream;
								      $objLiveStream->set_id($objLiveStream->CleanData($_POST["data_id"]));
								      $objLiveStream->set_recordHide("YES");
								      if ($objLiveStream->delete()) {
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
									 $objLiveStream = new LiveStream;  
								      $objLiveStream->set_id($objLiveStream->CleanData($_POST["data_id"]));
								      $liveStream_details = $objLiveStream->get_liveStream_by_id();
								      print_r($liveStream_details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objLiveStreamControl = new LiveStreamControl;
 ?>