<?php 
	class LiveStreamRegister{
		// setting and getting variables
		private $id;
		private $youtubeStreamId;
		private $userId;
		private $youtubeRate;
		private $youtubePrice;
		private $youtubePaymentStatus;
		private $dbConn;
		private $recordHide = "NO";
		private $table= "youtube_stream_register";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_youtubeStreamId($youtubeStreamId) { $this->youtubeStreamId = $youtubeStreamId; }
		function get_youtubeStreamId() { return $this->youtubeStreamId; }
		function set_userId($userId) { $this->userId = $userId; }
		function get_userId() { return $this->userId; }
		function set_youtubeRate($youtubeRate) { $this->youtubeRate = $youtubeRate; }
		function get_youtubeRate() { return $this->youtubeRate; }
		function set_youtubePrice($youtubePrice) { $this->youtubePrice = $youtubePrice; }
		function get_youtubePrice() { return $this->youtubePrice; }
		function set_youtubePaymentStatus($youtubePaymentStatus) { $this->youtubePaymentStatus = $youtubePaymentStatus; }
		function get_youtubePaymentStatus() { return $this->youtubePaymentStatus; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }
		function get_recordHide() { return $this->recordHide; }

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
			function youtube_stream_insert(){
				// check if the user has already registerd
				$checkSql = "SELECT youtube_stream_reg_id FROM $this->table WHERE youtube_stream_id =:youtubeStreamId AND user_id =:userId";
				$checkstmt = $this->dbConn->prepare($checkSql);
				$checkstmt->bindParam(":youtubeStreamId",$this->youtubeStreamId);
				$checkstmt->bindParam(":userId",$this->userId);
				$checkstmt->execute();
				$results= $checkstmt->fetch(PDO::FETCH_ASSOC);
				if (!empty($results["youtube_stream_reg_id"])) {
					return true;
				}
				else if (empty($results["youtube_stream_reg_id"])) {
					
					$sql = "INSERT INTO $this->table (youtube_stream_id,user_id,youtube_rate,youtube_price,youtube_payment_status,record_hide) VALUES (:youtubeStreamId,:userId,:youtubeRate,:youtubePrice,:youtubePaymentStatus,:recordHide)";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":youtubeStreamId",$this->youtubeStreamId);
					$stmt->bindParam(":userId",$this->userId);
					$stmt->bindParam(":youtubeRate",$this->youtubeRate);
					$stmt->bindParam(":youtubePrice",$this->youtubePrice);
					$stmt->bindParam(":youtubePaymentStatus",$this->youtubePaymentStatus);
					$stmt->bindParam(":recordHide",$this->recordHide);
					if ($stmt->execute()) {
						return true;
					}
					else{
						die();
						}
				}
			}
			// for update
			function check_if_payed(){
				$checkSql = "SELECT youtube_payment_status FROM $this->table WHERE youtube_stream_id =:youtubeStreamId AND user_id =:userId";
				$checkstmt = $this->dbConn->prepare($checkSql);
				$checkstmt->bindParam(":youtubeStreamId",$this->youtubeStreamId);
				$checkstmt->bindParam(":userId",$this->userId);
				$checkstmt->execute();
				$results= $checkstmt->fetch(PDO::FETCH_ASSOC);
				return $results["youtube_payment_status"];
			}

		// get user
			function get_evenReg_streamers(){
				$sql="SELECT * FROM $this->table WHERE youtube_stream_id=:youtubeStreamId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":youtubeStreamId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results,true);
				}
				else{
					die();
					}
				}

	}

 ?>