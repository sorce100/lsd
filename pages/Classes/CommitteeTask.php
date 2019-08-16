<?php 
	class CommitteeTask{
		// setting and getting variables
		private $id;
		private $dbConn;
		private $table= "committee_task";
		private $commId;
		private $commTaskName;
		private $commTaskExpiry;
		private $commTaskDesc;
		private $recordHide = "NO";

		function set_id($id) { $this->id = $id; }
		function set_commId($commId) { $this->commId = $commId; }
		function set_commTaskName($commTaskName) { $this->commTaskName = $commTaskName; }
		function set_commTaskExpiry($commTaskExpiry) { $this->commTaskExpiry = $commTaskExpiry; }
		function set_commTaskDesc($commTaskDesc) { $this->commTaskDesc = $commTaskDesc; }
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
				$sql = "INSERT INTO $this->table (committee_id,committee_task_name,committee_task_complete_date,committee_task_description,record_hide) VALUES (:commId,:commTaskName,:commTaskExpiry,:commTaskDesc,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":commId",$this->commId);
				$stmt->bindParam(":commTaskName",$this->commTaskName);
				$stmt->bindParam(":commTaskExpiry",$this->commTaskExpiry);
				$stmt->bindParam(":commTaskDesc",$this->commTaskDesc);
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
				$sql="UPDATE $this->table SET committee_task_name=:commTaskName,committee_task_complete_date=:commTaskExpiry,committee_task_description=:commTaskDesc WHERE committee_task_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":commTaskName",$this->commTaskName);
					$stmt->bindParam(":commTaskExpiry",$this->commTaskExpiry);
					$stmt->bindParam(":commTaskDesc",$this->commTaskDesc);
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
				$sql="UPDATE $this->table SET record_hide=:recordHide  WHERE committee_task_id=:Id";
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
			function get_comm_tasks(){
				$sql="SELECT * FROM $this->table WHERE record_hide=:recordHide ORDER BY committee_task_id DESC";
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
			function get_comm_tasks_by_id(){
				$sql="SELECT * FROM $this->table WHERE committee_task_id=:Id";
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
		// get all tasks of a committee
			function get_committee_tasks(){
				$sql="SELECT * FROM $this->table WHERE committee_id=:commId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":commId",$this->commId);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
			}

		// get committee name

			function get_committee_name($commId){
				$sql="SELECT committee_name FROM committee_setup WHERE committee_id=:commId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":commId",$commId);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return $results['committee_name'];
				}
				else{
					die();
					}
				}
	}

 ?>