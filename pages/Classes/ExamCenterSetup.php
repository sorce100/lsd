<?php 
	class ExamCenterSetup{
		// setting and getting variables
		private $id;
		private $centerName;
		private $centerRegion;
		private $centerExamSubject;
		private $dbConn;
		private $recordHide = "NO";
		private $table= "exam_center_setup";

		function set_id($id) { $this->id = $id; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }
		function set_centerName($centerName) { $this->centerName = $centerName; }
		function set_centerRegion($centerRegion) { $this->centerRegion = $centerRegion; }
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
				$sql = "INSERT INTO $this->table (exam_center_name,exam_center_region,division,user_id,record_hide) VALUES (:centerName,:centerRegion,:division,:userId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":centerName",$this->centerName);
				$stmt->bindParam(":centerRegion",$this->centerRegion);
				$stmt->bindParam(":division",$_SESSION['division']);
				$stmt->bindParam(":userId",$_SESSION['user_id']);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					return trim($this->dbConn->lastInsertId());
				}
				else{
					die();
					}
			}
			// for update
			function update(){
				$sql="UPDATE $this->table SET exam_center_name=:centerName,exam_center_region=:centerRegion WHERE exam_center_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":centerName",$this->centerName);
					$stmt->bindParam(":centerRegion",$this->centerRegion);
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
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE exam_center_id=:Id";
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
			function get_centers(){
				$sql="SELECT * FROM $this->table WHERE record_hide=:recordHide ORDER BY exam_center_id DESC";
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
			function get_center_by_id(){
				$returnData = [];
				$sql="SELECT * FROM $this->table WHERE exam_center_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ($results as $result) {
						$result['exam_subjects'] = $this->get_center_subjects($result['exam_center_id']);
						// add row to array
						$returnData[] = $result;
					}  
					return json_encode($returnData);
				}
				else{
					die();
					}
				}
		// get student exam center details

			function student_exam_center($centerId){
				$sql="SELECT * FROM $this->table WHERE exam_center_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$centerId);
				if ($stmt->execute()) {
					$result= $stmt->fetch(PDO::FETCH_ASSOC);
					$result['exam_subjects'] = $this->get_center_subjects($result['exam_center_id']);
					return $result;
				}
				else{
					die();
					}
			}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// FOR EXAM SUBJECT //////////////////////////////////////////////////////////////////////////////////
			function subject_insert(){
				$sql = "INSERT INTO exam_center_subjects (subject_name,center_id,record_hide) VALUES (:subjectName,:centerId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":subjectName",$this->centerExamSubject);
				$stmt->bindParam(":centerId",$this->id);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}

			// subject update
			function subject_update(){
				$sql="UPDATE exam_center_subjects SET subject_name=:subjectName WHERE center_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":subjectName",$this->centerExamSubject);
					$stmt->bindParam(":Id",$this->id);
					if ($stmt->execute()) {
						return true;
					}
					else{
						return false;
						}

			}

			// get subjects for center
			function get_center_subjects($centerId){
				$sql="SELECT subject_name FROM exam_center_subjects WHERE center_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$centerId);
				if ($stmt->execute()) {
					$result= $stmt->fetch(PDO::FETCH_ASSOC);
					return $result['subject_name'];
				}
				else{
					die();
					}
			}

}

?>