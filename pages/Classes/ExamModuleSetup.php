<?php 
	class ExamModuleSetup{
		// setting and getting variables
		private $id;
		private $centerId;
		private $centerExamPart;
		private $centerExamSubject;
		private $dbConn;
		private $recordHide = "NO";
		private $table= "exam_center_subjects";

		function set_id($id) { $this->id = $id; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }
		function set_centerId($centerId) { $this->centerId = $centerId; }
		function set_centerExamPart($centerExamPart) { $this->centerExamPart = $centerExamPart; }
		function set_centerExamSubject($centerExamSubject) { $this->centerExamSubject = $centerExamSubject; }
		
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
		function insert(){
			$sql = "INSERT INTO $this->table (center_exam_part,subject_name,center_id,record_hide) VALUES (:centerExamPart,:subjectName,:centerId,:recordHide)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":centerExamPart",$this->centerExamPart);
			$stmt->bindParam(":subjectName",$this->centerExamSubject);
			$stmt->bindParam(":centerId",$this->centerId);
			$stmt->bindParam(":recordHide",$this->recordHide);
			if ($stmt->execute()) {
				return true;
			}
			else{
				die();
				}
		}
		// for update
		function update(){
			$sql="UPDATE $this->table SET subject_name=:subjectName,center_exam_part=:centerExamPart WHERE subject_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":subjectName",$this->centerExamSubject);
				$stmt->bindParam(":centerExamPart",$this->centerExamPart);
				$stmt->bindParam(":Id",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}

		}
		// for delete
		function delete(){
			$sql="UPDATE $this->table SET record_hide=:recordHide WHERE subject_id=:Id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":recordHide",$this->recordHide);
			$stmt->bindParam(":Id",$this->id);
			if ($stmt->execute()) {
				return true;
			}
			else{
				return false;
			}
		}


	// get users
		function get_center_modules(){
			$sql="SELECT * FROM $this->table WHERE record_hide=:recordHide ORDER BY subject_id DESC";
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

	// get user
		function get_center_module_by_id(){
			$sql="SELECT * FROM $this->table WHERE subject_id=:Id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":Id",$this->id);
			if ($stmt->execute()) {
				$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($results);
			}
			else{
				die();
				}
			}

			// get subjects for center
		function get_center_name($centerId){
			$sql="SELECT exam_center_name FROM exam_center_setup WHERE exam_center_id=:Id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":Id",$centerId);
			if ($stmt->execute()) {
				$result= $stmt->fetch(PDO::FETCH_ASSOC);
				return $result['exam_center_name'];
			}
			else{
				die();
				}
		}
		// get all exams modules based on center id
		function get_all_modules_by_center(){
			$sql="SELECT subject_id,center_exam_part,subject_name FROM $this->table WHERE center_id=:centerId";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":centerId",$this->centerId);
			if ($stmt->execute()) {
				$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($results);
			}
			else{
				die();
				}
			}

}

?>