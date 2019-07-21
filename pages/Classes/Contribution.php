<?php 
	class Contribution{
		// setting and getting variables
		private $id;
		private $contributionName;
		private $contributionDue;
		private $payAmount;
		private $memberId;
		private $dbConn;
		private $table = "contribution";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_contributionName($contributionName) { $this->contributionName = $contributionName; }
		function get_contributionName() { return $this->contributionName; }
		function set_contributionDue($contributionDue) { $this->contributionDue = $contributionDue; }
		function get_contributionDue() { return $this->contributionDue; }
		function set_reason($reason) { $this->reason = $reason; }
		function get_reason() { return $this->reason; }
		function set_type($type) { $this->type = $type; }
		function get_type() { return $this->type; }
		function set_payAmount($payAmount) { $this->payAmount = $payAmount; }
		function get_payAmount() { return $this->payAmount; }
		function set_balance($balance) { $this->balance = $balance; }
		function get_balance() { return $this->balance; }
		function set_user_id($user_id) { $this->user_id = $user_id; }
		function get_user_id() { return $this->user_id; }
		function set_memberId($memberId) { $this->memberId = $memberId; }
		function get_memberId() { return $this->memberId; }



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
				$sql = "INSERT INTO $this->table (contribution_name,due_date) VALUES (:contributionName,:contributionDue)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":contributionName",$this->contributionName);
				$stmt->bindParam(":contributionDue",$this->contributionDue);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
			// for update
			function update(){
				$sql="UPDATE $this->table SET contribution_name=:contributionName,due_date=:contributionDue WHERE contribution_id=:contributionId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":contributionName",$this->contributionName);
					$stmt->bindParam(":contributionDue",$this->contributionDue);
					$stmt->bindParam(":contributionId",$this->id);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}

			}
			// for delete
			function delete(){
				$sql="DELETE FROM $this->table WHERE contribution_id=:contributionId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":contributionId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}


		// get users
			function get_contributions(){
				$sql="SELECT * FROM $this->table ORDER BY contribution_id DESC";
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
			function get_contribution_by_id(){
				$sql="SELECT * FROM $this->table WHERE contribution_id=:contributionId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":contributionId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}
		// contribution register
				function contribution_save(){
					$sql="INSERT INTO contribution_register (contribution_id,member_id,contributed_amount) VALUES (:contributionId,:memberId,:contributedAmount)";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":contributionId",$this->id);
					$stmt->bindParam(":memberId",$this->memberId);
					$stmt->bindParam(":contributedAmount",$this->payAmount);
					if ($stmt->execute()) {
						return true;
					}
					else{
						return false;
						}
				}
		// select all from contribution register based on contribution id 
			function get_list_by_contributionId(){
				$sql="SELECT * FROM contribution_register WHERE contribution_id=:contributionId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":contributionId",$this->id);
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