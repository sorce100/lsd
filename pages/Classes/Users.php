<?php 
	class Users{
		// setting and getting variables
		private $id;
		private $userPassword;
		private $status;
		private $memberId;
		private $accountType;
		private $accountTypeId;
		private $groupId;
		private $division;
		private $accStatus="NEVER";
		private $dbConn;
		private $table= "users";
		private $passwordReset ="NO";
		private $recordHide = "NO";
		private $accountStage = "OLD";

		function set_passwordReset($passwordReset) { $this->passwordReset = $passwordReset; }
		function get_passwordReset() { return $this->passwordReset; }
		function set_accountType($accountType) { $this->accountType = $accountType; }
		function get_accountType() { return $this->accountType; }
		function set_accountTypeId($accountTypeId) { $this->accountTypeId = $accountTypeId; }
		function get_accountTypeId() { return $this->accountTypeId; }
		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_userPassword($userPassword) { $this->userPassword = $userPassword; }
		function get_userPassword() { return $this->userPassword; }
		function set_status($status) { $this->status = $status; }
		function set_memberId($memberId) { $this->memberId = $memberId; }
		function get_memberId() { return $this->memberId; }
		function set_groupId($groupId) { $this->groupId = $groupId; }
		function get_groupId() { return $this->groupId; }
		function set_division($division) { $this->division = $division; }
		function get_division() { return $this->division; }
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

		// for login
		function login(){
			$sql="SELECT * FROM $this->table WHERE member_id = :memberId AND status = :status";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":memberId",$this->memberId);
			$stmt->bindParam(":status",$this->status);
			if ($stmt->execute()) {
				$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $results;
			}
			else{
				die();
				}

			}

		// insert users
			function insert(){
				$sql = "INSERT INTO $this->table (account_type,account_type_id,member_id,user_password,group_id,reset_password,status,division,	user_login_status,record_hide) VALUES (:accountType,:accountTypeId,:memberId,:userPassword,:groupId,:resetPassword,:status,:division,	userLoginStatus,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":accountType",$this->accountType);
				$stmt->bindParam(":accountTypeId",$this->accountTypeId);
				$stmt->bindParam(":memberId",$this->memberId);
				$stmt->bindParam(":userPassword",$this->userPassword);
				$stmt->bindParam(":groupId",$this->groupId);
				$stmt->bindParam(":resetPassword",$this->passwordReset);
				$stmt->bindParam(":status",$this->status);
				$stmt->bindParam(":division",$this->division);
				$stmt->bindParam(":userLoginStatus",$this->accStatus);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					if ($this->accountType == 'member') {
						$returnUserId = $this->dbConn->lastInsertId();
						// if user is created successfully, return the user_id generated then update member table with it
						$sqlupdate = "UPDATE members SET user_id=:returnUserId WHERE professional_number=:memberId";
						$stmt = $this->dbConn->prepare($sqlupdate);
						$stmt->bindParam(":returnUserId",$returnUserId);
						$stmt->bindParam(":memberId",$this->memberId);
						$stmt->execute();

						return $returnUserId;
					}else{
						// return what id the account type is not a member
						contine;
					}
				}
				else{
					die();
					}
			}
			// for update
			function update(){

				$sql = "UPDATE $this->table SET user_password=:userPassword,group_id=:groupId,reset_password=:resetPassword,status=:status,account_stage=:accountStage WHERE user_id=:user_id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":userPassword",$this->userPassword);
				$stmt->bindParam(":groupId",$this->groupId);
				$stmt->bindParam(":resetPassword",$this->passwordReset);
				$stmt->bindParam(":status",$this->status);
				$stmt->bindParam(":accountStage",$this->accountStage);
				$stmt->bindParam(":user_id",$this->id);
				$stmt->execute();
				if ($stmt->execute()) {
					return true;
				}
			}

			// change password
			function change_password(){
				$sql="UPDATE $this->table SET user_password = :userPassword,reset_password = :passwordReset WHERE member_id=:userName";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":userPassword",$this->userPassword);
				$stmt->bindParam(":passwordReset",$this->passwordReset);
				$stmt->bindParam(":userName",$this->memberId);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}


			// for delete
			function delete(){
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE user_id=:userId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":userId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
				}
			

		// get users for members
			function get_member_users(){
				$accountType = 'member';
				$sql="SELECT * FROM $this->table WHERE account_type=:accountType AND division=:division AND record_hide=:recordHide ORDER BY user_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":accountType",$accountType);
				$stmt->bindParam(":division",$_SESSION['division']);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

			// get administrators
			function get_administrators(){
				$accountType = 'administrator';
				$sql="SELECT * FROM $this->table WHERE account_type=:accountType  ORDER BY user_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":accountType",$accountType);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// get user
			function get_user(){
				$sql="SELECT * FROM $this->table WHERE user_id=:user_id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":user_id",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}

		// get users for members
			function get_student_users(){
				$accountType = 'student';
				$sql="SELECT * FROM $this->table WHERE account_type=:accountType AND division=:division AND record_hide=:recordHide ORDER BY user_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":accountType",$accountType);
				$stmt->bindParam(":division",$_SESSION['division']);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}
			
		// get password of the user
			function get_password(){
				$sql="SELECT user_password FROM $this->table WHERE user_id=:user_id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":user_id",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return $results['user_password'];
				}
				else{
					die();
					}
				}
		// get member committies
				function get_member_details($data){
					$sql = "SELECT committes FROM members WHERE professional_number=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":Id",$data);
					if ($stmt->execute()) {
						$results = $stmt->fetch(PDO::FETCH_ASSOC);
						if (!empty($results)) {
							return json_decode($results['committes']);
						}
						else{
							return false;
						}
						
					}
				}
		// get student id,level and school beloging to
				function get_student_details($data){
					$sql="SELECT student_id,exam_center_id FROM students WHERE record_hide=:recordHide AND student_id=:studentId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":recordHide",$this->recordHide);
					$stmt->bindParam(":studentId",$data);
					if ($stmt->execute()) {
						$results= $stmt->fetch(PDO::FETCH_ASSOC);
						return $results;
					}
					else{
						die();
						}
				}

		// get lecturer details 
				function get_lecturer_details($data){
					$sql="SELECT lecturer_id,lecturer_courses,school_id FROM lecturers WHERE record_hide=:recordHide AND lecturer_id=:lecturerId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":recordHide",$this->recordHide);
					$stmt->bindParam(":lecturerId",$data);
					if ($stmt->execute()) {
						$results= $stmt->fetch(PDO::FETCH_ASSOC);
						return $results;
					}
					else{
						die();
						}
				}

		// get username of user per user_id
				function get_username_byId(){
					$sql="SELECT member_id FROM $this->table WHERE user_id=:userId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":userId",$this->id);
					if ($stmt->execute()) {
						$results = $stmt->fetch(PDO::FETCH_ASSOC);
						$professionalNumber =  $results["member_id"];
						// get member full name 
						$nameSql = "SELECT first_name,last_name FROM members WHERE professional_number=:professionalNumber";
						$nameStmt = $this->dbConn->prepare($nameSql);
						$nameStmt->bindParam(":professionalNumber",$professionalNumber);
						if ($nameStmt->execute()) {
							$nameResults = $nameStmt->fetch(PDO::FETCH_ASSOC);
							return $nameResults['first_name']." ".$nameResults['last_name'];
						}
						else{
							return $professionalNumber;
						}
					}
					else{
						die();
						}
				}
		// get member fullname for header
				function get_header_fullname($data){
						$nameSql = "SELECT first_name,last_name FROM members WHERE professional_number=:professionalNumber";
						$nameStmt = $this->dbConn->prepare($nameSql);
						$nameStmt->bindParam(":professionalNumber",$data);
						if ($nameStmt->execute()) {
							$nameResults = $nameStmt->fetch(PDO::FETCH_ASSOC);
							if (!empty($nameResults)) {
								return $nameResults['first_name']." ".$nameResults['last_name'];
							}
							else{
								return $data;
							}
							
						}
				}


		//count account stage new for lecturers and students
				function count_new_stage($data){
						$accountStageValue = "NEW";
						$sql = "SELECT user_id FROM $this->table WHERE account_type=:accountType AND account_stage=:accountStage AND division=:division AND record_hide=:recordHide";
						$stmt = $this->dbConn->prepare($sql);
						$stmt->bindParam(":accountType",$data);
						$stmt->bindParam(":accountStage",$accountStageValue);
						$stmt->bindParam(":division",$_SESSION['division']);
						$stmt->bindParam(":recordHide",$this->recordHide);
						if ($stmt->execute()) {
							$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
								return sizeof($results);
						}
						else{
							return $data;
						}
				}
//////////////////////////////////////////////////////////////////////////
//FOR MESSAGES
/////////////////////////////////////////////////////////////////////////
			function get_all_members(){
				$sql="SELECT user_id,account_type,member_id,division FROM $this->table ORDER BY account_type DESC";
				$stmt = $this->dbConn->prepare($sql);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}

			}


			function get_group_members(){
				$sql="SELECT user_id,account_type,member_id,division FROM $this->table WHERE group_id=:groupId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":groupId",$this->groupId);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}

			}
//////////////////////////////////////////////////////////////////////////
//FOR UPDATING SESSION DETAILS
/////////////////////////////////////////////////////////////////////////

			function session_status_update($userLoginStatus){
				$sql="UPDATE $this->table SET user_login_status=:userLoginStatus WHERE user_id=:userId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":userLoginStatus",$userLoginStatus);
				$stmt->bindParam(":userId",$_SESSION['user_id']);
				if ($stmt->execute()) {
					// if online successful then grab the 
					return true;
				}
				else{
					return false;
					}
				}

			function get_userName($userId){
				$sql="SELECT member_id FROM $this->table WHERE user_id=:userId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":userId",$userId);
				if ($stmt->execute()) {
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
					return $results["member_id"];
				}
				else{
					return false;
					}
			}
}

 ?>