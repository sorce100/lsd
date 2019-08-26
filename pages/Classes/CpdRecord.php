<?php 
	class CpdRecord{
		// setting and getting variables
		private $id;
		private $cpdId;
		private $cpdRecordTitle;
		private $cpdRecordDate;
		private $cpdRecordAuthors;
		private $cpdRecordMarks;
		private $cpdMemberId;
		private $cpdRegisterId;
		private $dbConn;
		private $recordHide="NO";
		private $table = "cpd_records";

		function set_id($id) { $this->id = $id; }
		function set_cpdId($cpdId) { $this->cpdId = $cpdId; }
		function set_cpdRegisterAmt($cpdRegisterAmt) { $this->cpdRegisterAmt = $cpdRegisterAmt; }
		function set_cpdRecordTitle($cpdRecordTitle) { $this->cpdRecordTitle = $cpdRecordTitle; }
		function set_cpdRecordDate($cpdRecordDate) { $this->cpdRecordDate = $cpdRecordDate; }
		function set_cpdRecordAuthors($cpdRecordAuthors) { $this->cpdRecordAuthors = $cpdRecordAuthors; }
		function set_cpdRecordMarks($cpdRecordMarks) { $this->cpdRecordMarks = $cpdRecordMarks; }
		function set_cpdMemberId($cpdMemberId) { $this->cpdMemberId = $cpdMemberId; }
		function set_cpdRegisterId($cpdRegisterId) { $this->cpdRegisterId = $cpdRegisterId; }

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

			// insert if there is no record id but update if there is one
			
			function cpd_insert_records(){

				if (empty($this->id)) {
					$sql ="INSERT INTO $this->table (cpd_record_title,cpd_record_date,cpd_record_authors,cpd_record_marks,member_id,cpd_register_id,cpd_id,division) 
					VALUES(:cpdRecordTitle,:cpdRecordDate,:cpdRecordAuthors,:cpdRecordMarks,:memberId,:cpdRegisterId,:cpdId,:division)";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":cpdRecordTitle",$this->cpdRecordTitle);
					$stmt->bindParam(":cpdRecordDate",$this->cpdRecordDate);
					$stmt->bindParam(":cpdRecordAuthors",$this->cpdRecordAuthors);
					$stmt->bindParam(":cpdRecordMarks",$this->cpdRecordMarks);
					$stmt->bindParam(":memberId",$this->cpdMemberId);
					$stmt->bindParam(":cpdRegisterId",$this->cpdRegisterId);
					$stmt->bindParam(":cpdId",$this->cpdId);
					$stmt->bindParam(":division",$_SESSION['division']);
					if ($stmt->execute()) {
						return true;
					}
					else{
						die();
					}
				}
				elseif (!empty($this->id)) {
					$sql ="UPDATE $this->table 
					SET cpd_record_title=:cpdRecordTitle,cpd_record_date=:cpdRecordDate,cpd_record_authors=:cpdRecordAuthors,cpd_record_marks=:cpdRecordMarks
					WHERE member_id=:memberId 
					AND cpd_register_id=:cpdRegisterId 
					AND cpd_id=:cpdId 
					AND division=:division";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":cpdRecordTitle",$this->cpdRecordTitle);
					$stmt->bindParam(":cpdRecordDate",$this->cpdRecordDate);
					$stmt->bindParam(":cpdRecordAuthors",$this->cpdRecordAuthors);
					$stmt->bindParam(":cpdRecordMarks",$this->cpdRecordMarks);
					$stmt->bindParam(":memberId",$this->cpdMemberId);
					$stmt->bindParam(":cpdRegisterId",$this->cpdRegisterId);
					$stmt->bindParam(":cpdId",$this->cpdId);
					$stmt->bindParam(":division",$_SESSION['division']);
					if ($stmt->execute()) {
						return true;
					}
					else{
						die();
					}
				}

				
			}


		// get member cpd record
			function get_member_cpd_record(){
				$sql="SELECT * FROM $this->table WHERE cpd_register_id=:cpdRegisterId AND member_id=:memberId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":cpdRegisterId",$this->cpdRegisterId);
				$stmt->bindParam(":memberId",$_SESSION['member_id']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
			}


		// get mmeber details and cpd registration 
			function get_member_cpd_registration(){
				$sql='SELECT m.first_name,m.last_name,m.professional_number,r.cpd_register_id,r.cpd_amount_payed_date,c.cpd_name 
					FROM cpd_register AS r 
					INNER JOIN members AS m 
					ON  m.professional_number = r.member_id
					INNER JOIN cpd_setup AS c
					ON  c.cpd_id = r.cpd_id
					WHERE r.record_hide=:recordHide 
					ORDER BY r.cpd_register_id ASC';
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


			// for delete
			function delete(){
				$sql="DELETE FROM $this->table WHERE cpd_record_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}
			

	}


 ?>