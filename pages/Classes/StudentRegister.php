<?php 
	class StudentRegister{
		// setting and getting variables
		private $id;
		private $examCenterId;
		private $examName;
		private $studentId;
		private $status= "NEW";
		private $examScore;
		private $examScoreName;
		private $recordHide= "NO";
		private $dbConn;
		private $table= "exam_register";

		function set_id($id) { $this->id = $id; }
		function set_examCenterId($examCenterId) { $this->examCenterId = $examCenterId; }
		function set_examName($examName) { $this->examName = $examName; }
		function set_studentId($studentId) { $this->studentId = $studentId; }
		function set_status($status) { $this->status = $status; }
		function set_examScore($examScore) { $this->examScore = $examScore; }
		function set_examScoreName($examScoreName) { $this->examScoreName = $examScoreName; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }

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
				$date = date('d-m-Y');
				$sql = "INSERT INTO $this->table (exam_center_id,exam_name,student_id,date_registered,status,record_hide) VALUES (:examCenterId,:examName,:studentId,:dateRegistered,:status,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":examCenterId",$this->examCenterId);
				$stmt->bindParam(":examName",$this->examName);
				$stmt->bindParam(":studentId",$_SESSION['student_id']);
				$stmt->bindParam(":dateRegistered",$date);
				$stmt->bindParam(":status",$this->status);
				$stmt->bindParam(":recordHide",$this->recordHide);

				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
		// insert exams score
			function insert_exam_score(){
				// pull the exam score and the name of the exams,decode and add to the array before encoding to allow multiple  scores for the same exam center
				$returnSql="SELECT exam_score,exam_score_name FROM $this->table WHERE exam_register_id =:Id";
				$returnStmt = $this->dbConn->prepare($returnSql);
				$returnStmt->bindParam(":Id",$this->id);
				if ($returnStmt->execute()) {
					$result= $returnStmt->fetch(PDO::FETCH_ASSOC);
					$examScoreArray = json_decode($result['exam_score']);
					$examScoreNameArray = json_decode($result['exam_score_name']);
					// now add new values to array and save but dont allow the same value twice rather change the value
					for ($i=0; $i < sizeof($examScoreNameArray); $i++) { 
						// check if exam name is in the array
						if (in_array($this->examScoreName, $examScoreNameArray)) {
							// search for the key for the exam then use that to change value for score
							$arrayKey = array_search ($this->examScoreName, $examScoreNameArray);
							// change score value with the key given
							$examScoreArray[$arrayKey]=$this->examScore;
						}
						else{
							// if exam name is not in the array then add then save
							$examScoreNameArray[]=$this->examScoreName;
							$examScoreArray[]=$this->examScore;
						}
					}
					// now json_encode arrays back
					$examScoreNameEncode = json_encode($examScoreNameArray);
					$examScoreEncode = json_encode($examScoreArray);
				

					$status="OLD";
					$sql = "UPDATE $this->table SET exam_score=:examScore,exam_score_name=:examScoreName,status=:status,user_id=:userId WHERE exam_register_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":examScore",$examScoreEncode);
					$stmt->bindParam(":examScoreName",$examScoreNameEncode);
					$stmt->bindParam(":status",$status);
					$stmt->bindParam(":userId",$_SESSION['user_id']);
					$stmt->bindParam(":Id",$this->id);

					if ($stmt->execute()) {
						return true;
					}
					else{
						die();
					}
				}
				else{
					die();
				}
			}

		// get all details
			function get_student_registered(){
				$returnData =[];
				$sql="SELECT * FROM $this->table WHERE student_id=:studentId AND status=:status ORDER BY exam_register_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":studentId",$_SESSION['student_id']);
				$stmt->bindParam(":status",$this->status);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ($results as $result) {
						$result['center_name']=$this->get_exam_center_name($result['exam_center_id']);
						$returnData[] = $result;
					}
					return $returnData;
				}
				else{
					die();
				}

			}
		// get exam center name
			function get_exam_center_name($centerId){
				$sql="SELECT exam_center_name FROM exam_center_setup WHERE exam_center_id =:centerId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":centerId",$centerId);
				if ($stmt->execute()) {
					$result= $stmt->fetch(PDO::FETCH_ASSOC);
					return $result['exam_center_name'];
				}
				else{
					die();
				}

			}
		// get all registered students

			function get_all(){
				$returnData = [];
				$sql="SELECT * FROM $this->table WHERE record_hide=:recordHide ORDER BY exam_register_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ($results as $result) {
						$result["exam_center_id"]=$this->get_center_name($result["exam_center_id"]);
						$result["student_id"]=$this->get_student_name($result["student_id"]);
						$returnData[]=$result;
					}
					return $returnData;
				}
				else{
					die();
				}

			}

		// get users
			function check_member_register(){
				$sql="SELECT * FROM $this->table WHERE student_id=:studentId AND status=:status ORDER BY exam_register_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":studentId",$_SESSION['student_id']);
				$stmt->bindParam(":status",$this->status);

				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					if (sizeof($results)===0) {
						return true;
					}
					else{
						return false;
					}
					return $results;
				}
				else{
					die();
					}

			}

		// get user
			function get_studentDetails_forCourseRegisted(){
				$sql="SELECT student_id,course_reg_status FROM $this->table WHERE course_id=:courseId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":courseId",$this->courseId);
				if ($stmt->execute()) {
					$studentsId= $stmt->fetchAll(PDO::FETCH_ASSOC);
					// loop through students and get their username and store in an array
					foreach ($studentsId as $student) {
						$stuId = trim($student["student_id"]);
						$stuCourseStatus = trim($student["course_reg_status"]);
						// now we search for name and id and store in an array
						$stusql="SELECT student_title,student_first_name,student_last_name FROM students WHERE student_id=:studentId ORDER BY student_first_name";
						$stmt = $this->dbConn->prepare($stusql);
						$stmt->bindParam(":studentId",$stuId);
						if ($stmt->execute()) {
							$returnStu = $stmt->fetch(PDO::FETCH_ASSOC);
							$studentDetails[] = trim($returnStu["student_title"])." ".trim($returnStu["student_first_name"])." ".trim($returnStu["student_last_name"].":".$stuId.":".$stuCourseStatus);
						}
					}
					// after getting all the details, return the array
					return json_encode($studentDetails,true);
					
				}
				else{
					die();
					}
				}

// get center name
			function get_center_name($centerId){
				$sql="SELECT exam_center_name FROM exam_center_setup WHERE exam_center_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$centerId);
				if ($stmt->execute()) {
					$result= $stmt->fetch(PDO::FETCH_ASSOC);
					return $result["exam_center_name"];
				}
				else{
					die();
					}
			}

// get student name
			function get_student_name($studentId){
				$sql="SELECT student_title,student_first_name,student_last_name FROM students WHERE student_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$studentId);
				if ($stmt->execute()) {
					$result= $stmt->fetch(PDO::FETCH_ASSOC);
					return $result["student_title"]." ".$result["student_first_name"]." ".$result["student_last_name"];
				}
				else{
					die();
					}
			}
		


}

?>