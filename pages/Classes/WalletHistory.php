<?php 
	class WalletHistory{
		// setting and getting variables
		private $id;
		private $dbConn;
		private $table = "wallet_history";
		private $member_id;
		private $purpose;

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_member_id($member_id) { $this->member_id = $member_id; }
		function get_member_id() { return $this->member_id; }
		function set_purpose($purpose) { $this->purpose = $purpose; }
		function get_purpose() { return $this->purpose; }


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

		// get wallet history by user
			function get_member_walletHistory($memberId){
				$sql="SELECT * FROM $this->table WHERE member_id = :memberId  ORDER BY wallet_history_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":memberId",$memberId);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// get users
			function get_walletHistory_byId(){
				$sql="SELECT * FROM $this->table WHERE member_id = :memberId AND purpose=:purpose ORDER BY wallet_history_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":memberId",$this->member_id);
				$stmt->bindParam(":purpose",$this->purpose);
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