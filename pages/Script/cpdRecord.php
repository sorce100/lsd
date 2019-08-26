<?php
	require_once("../Classes/CpdRecord.php"); 
	session_start();
	class CpdRecordControl{
		function __construct(){
			switch (trim($_POST["mode"])) {

				case 'cpdRecordInsert':
					$objCpdRecord = new CpdRecord;
					$objCpdRecord->set_cpdRecordTitle(json_encode($_POST["cpdRecordTitle"]));
					$objCpdRecord->set_cpdRecordDate(json_encode($_POST["cpdRecordDate"]));
					$objCpdRecord->set_cpdRecordAuthors(json_encode($_POST["cpdRecordAuthors"]));
					$objCpdRecord->set_cpdRecordMarks(json_encode($_POST["cpdRecordMarks"]));
					$objCpdRecord->set_cpdId($objCpdRecord->CleanData($_POST["cpdId"]));
					$objCpdRecord->set_cpdRegisterId($objCpdRecord->CleanData($_POST["cpdRegisterId"]));
					$objCpdRecord->set_cpdMemberId($objCpdRecord->CleanData($_POST["cpdMemberId"]));
					$objCpdRecord->set_id($objCpdRecord->CleanData($_POST["cpdRecordId"]));
					if ($objCpdRecord->cpd_insert_records()) {
							echo "success";
					}
					else{
						echo "error";
					}
				break;
				// get record
				case 'getMemberRecord':
					if(isset($_POST["cpdRegId"])){
						 $objCpdRecord = new CpdRecord;  
					      $objCpdRecord->set_cpdRegisterId($objCpdRecord->CleanData($_POST["cpdRegId"]));
					      $details = $objCpdRecord->get_member_cpd_record();
					      print_r($details);  
					 }else{die();}
				break;
				// for delete
				case 'delete':
					if(isset($_POST["data_id"])){
						$objCpdRecord = new CpdRecord;
					      $objCpdRecord->set_id($objCpdRecord->CleanData($_POST["data_id"]));
					      if ($objCpdRecord->delete()) {
					      	return true;
					      }
					      else{
					      	return false;
					      }
					     
					 }else{die();}
				break;


				default:
					echo "There was a problem";
					break;
			}

		}
	}
	$objCpdRecordControl = new CpdRecordControl;
 ?>