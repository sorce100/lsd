<?php
	require_once("../Classes/Sms.php"); 
	session_start();
	class SmsControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
						// explode value into data_id and tel number
						$data_idTelNumAccType = $_POST['memberList'];
						$sms_Content = $_POST['smsContent'];
						for ($i=0; $i<sizeof($data_idTelNumAccType); $i++) { 
							$explodeData = explode('|', $data_idTelNumAccType[$i]);
							$data_id = $explodeData[0];
							$TelNum = $explodeData[1];
							$AccType = $explodeData[2];
							// for sms class
							$objSms = new Sms();
							// send sms account user
							$objSms->send_sms($TelNum,$sms_Content);
						}
						
						break;
					
					}
				}
		}

	$objSmsControl = new SmsControl;
 ?>