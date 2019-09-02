<?php 
	class UserBalance{
		private $dbConn;
		private $table = "wallet_history";
		// for balance stuff
		private $purpose;
		private $user_id;
		private $member_id;
		private $reason;
		private $type;
		private $pay_amount;
		private $balance;
		private $paymentContributionId;

		function set_purpose($purpose) { $this->purpose = $purpose; }
		function get_purpose() { return $this->purpose; }
		function set_user_id($user_id) { $this->user_id = $user_id; }
		function get_user_id() { return $this->user_id; }
		function set_member_id($member_id) { $this->member_id = $member_id; }
		function get_member_id() { return $this->member_id; }
		function set_reason($reason) { $this->reason = $reason; }
		function get_reason() { return $this->reason; }
		function set_type($type) { $this->type = $type; }
		function get_type() { return $this->type; }
		function set_pay_amount($pay_amount) { $this->pay_amount = $pay_amount; }
		function get_pay_amount() { return $this->pay_amount; }
		function set_balance($balance) { $this->balance = $balance; }
		function set_paymentContributionId($paymentContributionId) { $this->paymentContributionId = $paymentContributionId; }
		// function get_balance() { return $this->balance; }


		public function __construct(){
			require_once("db/db.php");
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

		// get users
			function get_balance(){
				$sql="SELECT current_balance FROM members WHERE professional_number = :memberId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":memberId",$_SESSION['member_id']);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// clean data for data input
		public function CleanData($data){
			$data = trim($data);
			$data=htmlentities($data,ENT_QUOTES, 'UTF-8');
			$data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
			return $data;
			}

		// saving into the wallet
			function wallet_save(){
					$sql="INSERT INTO $this->table (member_id,type,purpose,reason,amount_payed,balance,division,payment_contribution_id) VALUES (:memberId,:type,:purpose,:reason,:amountPayed,:balance,:division,:paymentContributionId)";
						$stmt = $this->dbConn->prepare($sql);
						$stmt->bindParam(":memberId",$this->member_id);
						$stmt->bindParam(":type",$this->type);
						$stmt->bindParam(":purpose",$this->purpose);
						$stmt->bindParam(":reason",$this->reason);
						$stmt->bindParam(":amountPayed",$this->pay_amount);
						$stmt->bindParam(":balance",$this->balance);
						$stmt->bindParam(":division",$_SESSION['division']);
						$stmt->bindParam(":paymentContributionId",$this->paymentContributionId);

						if ($stmt->execute()) {
							$balancesql = "UPDATE members SET current_balance=:balance WHERE professional_number=:memberId";
							$stmt = $this->dbConn->prepare($balancesql);
							$stmt->bindParam(":balance",$this->balance);
							$stmt->bindParam(":memberId",$this->member_id);
							if ($stmt->execute()) {return true;}else{return false;}
						}
						else{
							die();
							}
						}

			}


 ?>