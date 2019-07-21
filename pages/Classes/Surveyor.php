<?php 
	class Surveyor{
		// setting and getting variables
		private $id;
		private $surveyorType;
		private $dbConn;
		private $table= "surveyor";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_surveyorType($surveyorType) { $this->surveyorType = $surveyorType; }
		function get_surveyorType() { return $this->surveyorType; }




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
				$sql = "INSERT INTO $this->table (surveyor_type) VALUES (:surveyorType)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":surveyorType",$this->surveyorType);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
			// for update
			function update(){
				$sql="UPDATE $this->table SET surveyor_type=:surveyorType WHERE surveyor_id=:surveyorId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":surveyorType",$this->surveyorType);
					$stmt->bindParam(":surveyorId",$this->id);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}

			}
			// for delete
			function delete(){
				$sql="DELETE FROM $this->table WHERE surveyor_id=:surveyorId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":surveyorId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}


		// get users
			function get_surveyorTypes(){
				$sql="SELECT * FROM $this->table ORDER BY surveyor_id ASC";
				$stmt = $this->dbConn->prepare($sql);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// get user
			function get_surveyorType_by_id(){
				$sql="SELECT * FROM $this->table WHERE surveyor_id=:surveyorId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":surveyorId",$this->id);
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