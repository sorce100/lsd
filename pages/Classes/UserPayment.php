<?php 
	class UserPayment{
		private $id;
		private $paymentSurveyor;
		private $paymentPurpose;
		private $paymentAmount;
		private $division;
		private $dbConn;
		private $recordHide = "NO";
		private $table = 'user_payment';
		private $userId;

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_paymentSurveyor($paymentSurveyor) { $this->paymentSurveyor = $paymentSurveyor; }
		function get_paymentSurveyor() { return $this->paymentSurveyor; }
		function set_paymentPurpose($paymentPurpose) { $this->paymentPurpose = $paymentPurpose; }
		function get_paymentPurpose() { return $this->paymentPurpose; }
		function set_paymentAmount($paymentAmount) { $this->paymentAmount = $paymentAmount; }
		function get_paymentAmount() { return $this->paymentAmount; }
		function set_division($division) { $this->division = $division; }
		function set_userId($userId) { $this->userId = $userId; }
		function get_userId() { return $this->userId; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }
		// construct for constuct and initializing the database object
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
			
		// saving members details into database
		function insert(){
			$sql="INSERT INTO $this->table (surveyor_type,payment_purpose,payment_amount,division,record_hide,user_id) VALUES (:surveyorType,:paymentPurpose,:paymentAmount,:division,:recordHide,:userId)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":surveyorType",$this->paymentSurveyor);
			$stmt->bindParam(":paymentPurpose",$this->paymentPurpose);
			$stmt->bindParam(":paymentAmount",$this->paymentAmount);
			$stmt->bindParam(":division",$_SESSION['division']);
			$stmt->bindParam(":recordHide",$this->recordHide);
			$stmt->bindParam(":paymentAmount",$this->paymentAmount);
			$stmt->bindParam(":userId",$this->userId);
			if ($stmt->execute()) {
				return true;
			}
			else{
				return false;
				}

			}

		// for update
			function update(){
				$sql="UPDATE $this->table SET surveyor_type=:surveyorType,payment_purpose=:paymentPurpose,payment_amount=:paymentAmount WHERE user_payment_id=:id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":surveyorType",$this->paymentSurveyor);
					$stmt->bindParam(":paymentPurpose",$this->paymentPurpose);
					$stmt->bindParam(":paymentAmount",$this->paymentAmount);
					// $stmt->bindParam(":file_name",NULL);
					$stmt->bindParam(":id",$this->id);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}
			}

		// for delete
			function delete(){
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE user_payment_id=:Id";
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

		// get all records
			function get_user_payments(){
				$sql="SELECT * FROM $this->table WHERE division=:division AND record_hide=:recordHide ORDER BY user_payment_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":division",$_SESSION['division']);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					return false;
					}

				}

			// Get details of a member using their login user_id
			function get_user_payments_id(){
				$sql="SELECT * FROM $this->table WHERE user_payment_id=:id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":id",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					return false;
					}
				}
}
 ?>