<?php
	require_once("../Classes/LiveStreamRegister.php");
	require_once("../Classes/UserBalance.php"); 
	session_start();
	class LiveStreamRegisterControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'paid_watch':

							// CHECK IF THERE IS SUFFICIENT BALANCE
							$objUserBalance = new UserBalance;
							$getBalance = $objUserBalance->get_balance();
								if (trim($getBalance["current_balance"]) >= trim($_POST["streamPrice"])) {
										$objLiveStreamRegister = new LiveStreamRegister;
										$objLiveStreamRegister->set_youtubeStreamId($objLiveStreamRegister->CleanData($_POST["data_id"]));
										$objLiveStreamRegister->set_userId($_SESSION['user_id']);
										$objLiveStreamRegister->set_youtubeRate($objLiveStreamRegister->CleanData($_POST["streamRate"]));
										$objLiveStreamRegister->set_youtubePrice($objLiveStreamRegister->CleanData($_POST["streamPrice"]));
										$objLiveStreamRegister->set_youtubePaymentStatus("PAID");
										$response = $objLiveStreamRegister->youtube_stream_insert();
										// print_r($response);
										if ($objLiveStreamRegister->youtube_stream_insert()) {
												// save into the wallet history
												$objUserBalance = new UserBalance;
												$objUserBalance->set_reason($objUserBalance->CleanData("YOUTUBE LIVE STREAMING PAYMENT"));
										 		$objUserBalance->set_type($objUserBalance->CleanData("DEBIT"));
										 		$objUserBalance->set_purpose($objUserBalance->CleanData("YOUTUBE"));
										 		$objUserBalance->set_pay_amount($objUserBalance->CleanData($_POST["streamPrice"]));
										 		$objUserBalance->set_balance(trim($getBalance["current_balance"]) - trim($_POST["streamPrice"]));
												$objUserBalance->set_member_id($_SESSION['member_id']);

												if ( $objUserBalance->wallet_save() ) {
													echo "success";
												}
												else{
													echo "SORRY! WALLET NO UPDATED";
												}
										}
										else{
											echo "ERROR REGISTERING FOR LIVE STREAM";
										}
								}
								else{
									echo "SORRY!YOU HAVE INSUFFICIENT BALANCE IN YOUR ACCOUNT";
								}
						break;
					// for update
						case 'free_watch':
							$objLiveStreamRegister = new LiveStreamRegister;
							$objLiveStreamRegister->set_youtubeStreamId($objLiveStreamRegister->CleanData($_POST["data_id"]));
							$objLiveStreamRegister->set_userId($_SESSION['user_id']);
							$objLiveStreamRegister->set_youtubeRate($objLiveStreamRegister->CleanData($_POST["streamRate"]));
							$objLiveStreamRegister->set_youtubePrice($objLiveStreamRegister->CleanData($_POST["streamPrice"]));
							$objLiveStreamRegister->set_youtubePaymentStatus("FREE");
							if ($objLiveStreamRegister->youtube_stream_insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'check_if_payed':
							if(isset($_POST["data_id"])){
									  $objLiveStreamRegister = new LiveStreamRegister;  
								      $objLiveStreamRegister->set_userId($objLiveStreamRegister->CleanData($_SESSION['user_id']));
								      $objLiveStreamRegister->set_youtubeStreamId($objLiveStreamRegister->CleanData($_POST["data_id"]));
								      $regStatus = trim($objLiveStreamRegister->check_if_payed());
								      if ($regStatus == "PAID") {
								        	echo "success";
								        }
								      else {
								      		echo "error";
								      }  
								 }else{die();}
						break;
						// geting details of a member with id
						case 'view_registered_Streamers':
							if(isset($_POST["data_id"])){
									 $objLiveStreamRegister = new LiveStreamRegister;  
								      $objLiveStreamRegister->set_id($objLiveStreamRegister->CleanData($_POST["data_id"]));
								      $regStreamers_details = $objLiveStreamRegister->get_evenReg_streamers();
								      print_r($regStreamers_details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objLiveStreamRegisterControl = new LiveStreamRegisterControl;
 ?>