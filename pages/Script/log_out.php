<?php
require_once("../Classes/Users.php");
require_once("../Classes/SessionLogs.php");
session_start();
// update user is offline
$objUsers = new Users();
$objUsers->session_status_update('OFFLINE');

// log the logout time of user
$objSessionLogs = new SessionLogs();
$objSessionLogs->session_log_end();

if(session_destroy())
{
header("Location: ../../index.php");
}

?>
