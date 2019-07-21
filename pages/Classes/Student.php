<?php 
	class Student{
		// setting and getting variables
		private $id;
		private $studentTitle;
		private $studentFirstName;
		private $studentLastName;
		private $studentEmail;
		private $studentTel;
		private $studentDob;
		private $studentEmergencyTel;
		private $studentPostalAddress;
		private $studentHouseNum;
		private $StudentHouseLoc;
		private $division;
		private $examCenter;
		private $dbConn;
		private $recordHide = "NO";
		private $table= "students";
		private $studenPassword;
		private $studentMemberId;
		
		function set_id($id) { $this->id = $id; }
		function set_studentTitle($studentTitle) { $this->studentTitle = $studentTitle; }
		function set_studentFirstName($studentFirstName) { $this->studentFirstName = $studentFirstName; }
		function set_studentLastName($studentLastName) { $this->studentLastName = $studentLastName; }
		function set_studentEmail($studentEmail) { $this->studentEmail = $studentEmail; }
		function set_studentTel($studentTel) { $this->studentTel = $studentTel; }
		function set_studentDob($studentDob) { $this->studentDob = $studentDob; }
		function set_studentEmergencyTel($studentEmergencyTel) { $this->studentEmergencyTel = $studentEmergencyTel; }
		function set_studentPostalAddress($studentPostalAddress) { $this->studentPostalAddress = $studentPostalAddress; }
		function set_studentHouseNum($studentHouseNum) { $this->studentHouseNum = $studentHouseNum; }
		function set_StudentHouseLoc($StudentHouseLoc) { $this->StudentHouseLoc = $StudentHouseLoc; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }
		function set_examCenter($examCenter) { $this->examCenter = $examCenter; }
		function set_division($division) { $this->division = $division; }
		function set_studenPassword($studenPassword) { $this->studenPassword = $studenPassword; }
		function set_studentMemberId($studentMemberId) { $this->studentMemberId = $studentMemberId; }


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
					$accountType = 'student';
					$accountStage = 'NEW';
					$passwordReset = 'NO';
					$status = 'ACTIVE';

					$sql = "INSERT INTO $this->table (student_title,student_first_name,student_last_name,student_email,student_tel,exam_center_id,record_hide,division) VALUES (:studentTitle,:studentFirstName,:studentLastName,:studentEmail,:studentTel,:examCenter,:recordHide,:division)";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":studentTitle",$this->studentTitle);
					$stmt->bindParam(":studentFirstName",$this->studentFirstName);
					$stmt->bindParam(":studentLastName",$this->studentLastName);
					$stmt->bindParam(":studentEmail",$this->studentEmail);
					$stmt->bindParam(":studentTel",$this->studentTel);
					$stmt->bindParam(":examCenter",$this->examCenter);
					$stmt->bindParam(":recordHide",$this->recordHide);
					$stmt->bindParam(":division",$this->division);
					if ($stmt->execute()) {
							$studentId = $this->dbConn->lastInsertId();
							// // try and request for username and password for the student
							// $firstName = substr($this->studentFirstName,0,1);
							// $memberId = trim($firstName.'.'.$this->studentLastName);
							// insert into users table
							$accReqSql = "INSERT INTO users (account_type,account_type_id,account_stage,member_id,user_password,reset_password,status,division,record_hide) VALUES (:accountType,:accountTypeId,:accountStage,:memberId,:userPassword,:resetPassword,:status,:division,:recordHide) ";
								$accReqSqlstmt = $this->dbConn->prepare($accReqSql);
								$accReqSqlstmt->bindParam(":accountType",$accountType);
								$accReqSqlstmt->bindParam(":accountTypeId",$studentId);
								$accReqSqlstmt->bindParam(":accountStage",$accountStage);
								$accReqSqlstmt->bindParam(":memberId",$this->studentMemberId);
								$accReqSqlstmt->bindParam(":userPassword",$this->studenPassword);
								$accReqSqlstmt->bindParam(":resetPassword",$passwordReset);
								$accReqSqlstmt->bindParam(":status",$status);
								$accReqSqlstmt->bindParam(":division",$this->division);
								$accReqSqlstmt->bindParam(":recordHide",$this->recordHide);
								// if successfull return success
								if ($accReqSqlstmt->execute()) {
									return "success";
								}else{
									return "error";
								}
					}
					else{
						die();
						}
			}
			// for update
			function update(){
				$sql="UPDATE $this->table SET student_title=:studentTitle,student_first_name=:studentFirstName,student_last_name=:studentLastName,student_email=:studentEmail,student_tel=:studentTel,exam_center_id=:examCenter,division=:division WHERE student_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":studentTitle",$this->studentTitle);
					$stmt->bindParam(":studentFirstName",$this->studentFirstName);
					$stmt->bindParam(":studentLastName",$this->studentLastName);
					$stmt->bindParam(":studentEmail",$this->studentEmail);
					$stmt->bindParam(":studentTel",$this->studentTel);
					$stmt->bindParam(":examCenter",$this->examCenter);
					$stmt->bindParam(":division",$this->division);
					$stmt->bindParam(":Id",$this->id);
					if ($stmt->execute()) {
						
						return "success";
					}
					else{
						return "error";
						}
			}
			// for delete
			function delete(){
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE course_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":Id",$this->id);
				if ($stmt->execute()) {
					return "success";
				}
				else{
					return "error";
					}
			}


		// get students
			function get_students(){
				$sql="SELECT * FROM $this->table WHERE record_hide =:recordHide AND division = :division ORDER BY student_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// get school by id
			function get_student_by_id(){
				$sql="SELECT * FROM $this->table WHERE student_id=:Id";
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

		// get course name and code using searching with school id

			function get_courses_list(){
				$sql="SELECT * FROM $this->table WHERE school_id=:examCenter ORDER BY course_code";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":examCenter",$this->examCenter);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}

			}
			// get student list
		function get_student_list(){
					$sql="SELECT * FROM $this->table WHERE division=:division ORDER BY school_id ASC";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":division",$_SESSION['division']);
					if ($stmt->execute()) {
						$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
						return json_encode($results);
					}
					else{
						die();
						}

					}
		// Get details of a member using their login user_id
			function get_student_by_userId(){
				$sql="SELECT * FROM $this->table WHERE student_id=:accountTypeId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":accountTypeId",$_SESSION['account_type_id']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}
				}
		// update student profile students
		function update_profile(){
				$sql="UPDATE $this->table SET student_title=:studentTitle,student_first_name=:studentFirstName,student_last_name=:studentLastName,student_dob=:studentDob,student_email=:studentEmail,student_tel=:studentTel,student_emergency_tel=:studentEmergencyTel,student_post_address=:studentPostalAddress,student_house_num=:studentHouseNum,student_house_location=:StudentHouseLoc WHERE student_id=:accountTypeId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":studentTitle",$this->studentTitle);
					$stmt->bindParam(":studentFirstName",$this->studentFirstName);
					$stmt->bindParam(":studentLastName",$this->studentLastName);
					$stmt->bindParam(":studentDob",$this->studentDob);
					$stmt->bindParam(":studentEmail",$this->studentEmail);
					$stmt->bindParam(":studentTel",$this->studentTel);
					$stmt->bindParam(":studentEmergencyTel",$this->studentEmergencyTel);
					$stmt->bindParam(":studentPostalAddress",$this->studentPostalAddress);
					$stmt->bindParam(":studentHouseNum",$this->studentHouseNum);
					$stmt->bindParam(":StudentHouseLoc",$this->StudentHouseLoc);
					$stmt->bindParam(":accountTypeId",$_SESSION['account_type_id']);

					if ($stmt->execute()) {
						
						return "success";
					}
					else{
						die();
						}
			}

	// check if a particular email id exists and if the record is not hidden

		function check_email(){
			$sql = "SELECT student_id FROM $this->table WHERE student_email = :studentEmail AND record_hide=:recordHide";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":studentEmail",$this->studentEmail);
			$stmt->bindParam(":recordHide",$this->recordHide);
			if ($stmt->execute()) {
				$results = $stmt->fetch(PDO::FETCH_ASSOC);
				if (!empty($results)) {
					return "success";
				}
			}
			else{
				die();
				}
		}

	

	}

 ?>