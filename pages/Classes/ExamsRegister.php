<?php 
	class ExamsRegister{
		// setting and getting variables
		private $id;
		private $examCenterId;
		private $examCenterModuleId;
		private $studentId;
		private $status= "NEW";
		private $examScore;
		private $examNameIndex;
		private $recordHide= "NO";
		private $dbConn;
		private $table= "exam_register";

		function set_id($id) { $this->id = $id; }
		function set_examCenterId($examCenterId) { $this->examCenterId = $examCenterId; }
		function set_examCenterModuleId($examCenterModuleId) { $this->examCenterModuleId = $examCenterModuleId; }
		function set_studentId($studentId) { $this->studentId = $studentId; }
		function set_status($status) { $this->status = $status; }
		function set_examScore($examScore) { $this->examScore = $examScore; }
		function set_examNameIndex($examNameIndex) { $this->examNameIndex = $examNameIndex; }
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
				$sql = "INSERT INTO $this->table (exam_center_id,exam_center_module_id,student_id,date_registered,status,user_id,record_hide) VALUES (:examCenterId,:examCenterModuleId,:studentId,:dateRegistered,:status,:userId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":examCenterId",$this->examCenterId);
				$stmt->bindParam(":examCenterModuleId",$this->examCenterModuleId);
				$stmt->bindParam(":studentId",$_SESSION['student_id']);
				$stmt->bindParam(":dateRegistered",$date);
				$stmt->bindParam(":status",$this->status);
				$stmt->bindParam(":userId",$_SESSION['user_id']);
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
				$examsScoreAssocArrayDeclare=[];
				$examNameIndexArrayDeclare=[];
				// pull the exam score and the name of the exams,decode and add to the array before encoding to allow multiple  scores for the same exam center
				$returnSql="SELECT exam_score,exam_name_index FROM $this->table WHERE exam_register_id =:Id";
				$returnStmt = $this->dbConn->prepare($returnSql);
				$returnStmt->bindParam(":Id",$this->id);
				if ($returnStmt->execute()) {
					$result= $returnStmt->fetch(PDO::FETCH_ASSOC);
					$examScoreArray = json_decode($result['exam_score']);
					// if exams score associative arrary is not empty then get the vrious arrays then store them in various ids
						if (!empty($examScoreArray)) {
							foreach ($examScoreArray as $key => $examScore) {
								$examsScoreAssocArrayDeclare[$key]=$examScore;
							}

							$examNameIndexArray = json_decode($result['exam_name_index']);
							foreach ($examNameIndexArray as $examNameIndex) {
								$examNameIndexArrayDeclare[]=$examNameIndex;
							}
						}
				
					// for exams score associative array
					$examsScoreAssocArrayDeclare[$this->examNameIndex] = $this->examScore;
					// for exams subjects array index
					if (!in_array($this->examNameIndex, $examNameIndexArrayDeclare)) {
						$examNameIndexArrayDeclare[]=$this->examNameIndex;
					}
					$this->status="OLD";
					$sql = "UPDATE $this->table SET exam_score=:examScore,exam_name_index=:examNameIndex,status=:status WHERE exam_register_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindValue(":examScore",json_encode($examsScoreAssocArrayDeclare));
					$stmt->bindValue(":examNameIndex",json_encode($examNameIndexArrayDeclare));
					$stmt->bindParam(":status",$this->status);
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
			function get_applicants_registered(){
				$sql="SELECT rg.exam_center_id,rg.exam_center_module_id,rg.date_registered,rg.exam_score,rg.exam_name_index,
				c.exam_center_id,c.exam_center_name,c.exam_center_region,
				md.module_id,md.center_exam_part,md.subject_name 
				FROM $this->table AS rg 
				LEFT JOIN exam_center_setup AS c 
				ON rg.exam_center_id = c.exam_center_id
				LEFT JOIN exam_center_modules AS md
				ON rg.exam_center_module_id = md.module_id
				WHERE rg.student_id=:studentId ORDER BY exam_register_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":studentId",$_SESSION['student_id']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
				}

			}

		// get all registered students
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			function get_all_reg_applicants(){
				$sql="SELECT er.exam_register_id,er.exam_center_id,er.exam_center_module_id,er.student_id,er.date_registered ,er.exam_score,st.student_id,st.student_first_name,st.student_last_name ,md.module_id,md.center_exam_part, md.subject_name	
				FROM exam_register AS er  
				INNER JOIN students AS st
				ON er.student_id = st.student_id
				INNER JOIN exam_center_modules AS md
				ON er.exam_center_module_id = md.module_id
				WHERE er.exam_center_id = :centerId
				AND er.record_hide=:recordHide
				ORDER BY exam_register_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":centerId",$this->examCenterId);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
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

// get all applicant full details and exams detials
			 function get_exams_registered_applicants(){
			 	$sql="SELECT c.exam_center_id,c.exam_center_name,c.exam_center_region,s.student_id,s.student_title,s.student_first_name,s.student_last_name,m.module_id,m.center_exam_part, 
			 	FROM students AS s
			 	INNER JOIN exam_center_subjects AS m
			 	ON m.center_id = c.exam_center_id
			 	INNER JOIN exam_center_setup AS c
			 	ON s.student_id = c.exam_center_id
			 	WHERE student_id=:Id";
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