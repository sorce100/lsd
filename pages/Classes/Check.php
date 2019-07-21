<?php
require_once("SessionLogs.php");
session_start();
 
class Check{
	
	function __construct(){
		// auth
		if(!isset($_SESSION['user_id']) || (trim($_SESSION['user_id']) == '')) {
				header("location:../index.php");
				exit();
			}


		$TimeOutMinutes = 120; // This is your TimeOut period in minutes
		$LogOff_URL = "../index.php"; // If timed out, it will be redirected to this page
		$TimeOutSeconds = $TimeOutMinutes * 60; // TimeOut in Seconds
		if (isset($_SESSION['SessionStartTime'])) {
		    $InactiveTime = time() - $_SESSION['SessionStartTime'];
		    if ($InactiveTime >= $TimeOutSeconds) {
		        session_destroy();
		        // log the logout time of user
				$objSessionLogs = new SessionLogs();
				$objSessionLogs->session_log_end();

		        header("Location: $LogOff_URL");
		    }
		}
		$_SESSION['SessionStartTime'] = time();
	}
}

?>  
