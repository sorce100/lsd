<?php 
	class CpdRegister{
		// setting and getting variables
		private $id;
		private $cpdId;
		private $cpdRegisterAmt;
		private $cpdPayed = "YES";
		private $cpdRecordTitle;
		private $cpdRecordDate;
		private $cpdRecordAuthors;
		private $cpdRecordMarks;
		private $dbConn;
		private $recordHide="NO";
		private $table = "cpd_register";

		function set_id($id) { $this->id = $id; }
		function set_cpdId($cpdId) { $this->cpdId = $cpdId; }
		function set_cpdRegisterAmt($cpdRegisterAmt) { $this->cpdRegisterAmt = $cpdRegisterAmt; }
		function set_cpdPayed($cpdPayed) { $this->cpdPayed = $cpdPayed; }
		function set_cpdRecordTitle($cpdRecordTitle) { $this->cpdRecordTitle = $cpdRecordTitle; }
		function set_cpdRecordDate($cpdRecordDate) { $this->cpdRecordDate = $cpdRecordDate; }
		function set_cpdRecordAuthors($cpdRecordAuthors) { $this->cpdRecordAuthors = $cpdRecordAuthors; }
		function set_cpdRecordMarks($cpdRecordMarks) { $this->cpdRecordMarks = $cpdRecordMarks; }

		public function __construct(){
			require_once("db/db.php");
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

		// clean data for data input
		public function CleanData($data){
			$data = trim($data);
			$data=htmlentities($data,ENT_QUOTES, 'UTF-8');
			$data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
			return $data;
			}

		// insert pages
			function member_cpd_register(){
				$date = date('d-m-Y');
				$sql = "INSERT INTO $this->table (cpd_id,cpd_amount,cpd_payed,cpd_amount_payed_date,record_hide,member_id) VALUES (:cpdId,:cpdRegisterAmt,:cpdPayed,:cptAmtPayedDate,:recordHide,:memberId)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":cpdId",$this->cpdId);
				$stmt->bindParam(":cpdRegisterAmt",$this->cpdRegisterAmt);
				$stmt->bindParam(":cpdPayed",$this->cpdPayed);
				$stmt->bindParam(":cptAmtPayedDate",$date);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":memberId",$_SESSION['member_id']);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}

			// get user
			function get_cpdRegister_by_id(){
				$sql='SELECT r.cpd_register_id,r.cpd_id,r.member_id,cr.cpd_record_id,cr.cpd_record_title,cr.cpd_record_date,cr.cpd_record_authors,cr.cpd_record_marks 
					FROM cpd_register AS r 
					LEFT JOIN cpd_records AS cr
					ON  r.cpd_register_id = cr.cpd_register_id
					WHERE r.record_hide=:recordHide
					AND r.cpd_register_id=:Id
					ORDER BY cr.cpd_record_id DESC';
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":Id",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
				}



			}


		// get member cpd records with cpd registration
			function get_member_cpd_registration(){
				$sql='SELECT m.first_name,m.last_name,m.professional_number,r.cpd_register_id,r.cpd_amount_payed_date,c.cpd_name 
					FROM cpd_register AS r 
					INNER JOIN members AS m 
					ON  m.professional_number = r.member_id
					INNER JOIN cpd_setup AS c
					ON  c.cpd_id = r.cpd_id
					WHERE r.record_hide=:recordHide 
					ORDER BY r.cpd_register_id DESC';
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
				}

			}
			

	}


 ?>