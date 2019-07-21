<?php 
date_default_timezone_set("Africa/Accra");
	class LiveStream{
		// setting and getting variables
		private $id;
		private $eventTitle;
		private $startDate;
		private $startTime;
		private $endTime;
		private $eventRate;
		private $enterAmount;
		private $division;
		private $userId;
		private $dbConn;
		private $recordHide = "NO";
		private $table = "youtube_stream";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_eventTitle($eventTitle) { $this->eventTitle = $eventTitle; }
		function get_eventTitle() { return $this->eventTitle; }
		function set_startDate($startDate) { $this->startDate = $startDate; }
		function get_startDate() { return $this->startDate; }
		function set_eventRate($eventRate) { $this->eventRate = $eventRate; }
		function set_startTime($startTime) { $this->startTime = $startTime; }
		function get_startTime() { return $this->startTime; }
		function set_endTime($endTime) { $this->endTime = $endTime; }
		function get_endTime() { return $this->endTime; }
		function get_eventRate() { return $this->eventRate; }
		function set_enterAmount($enterAmount) { $this->enterAmount = $enterAmount; }
		function get_enterAmount() { return $this->enterAmount; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }
		function get_recordHide() { return $this->recordHide; }
		function set_division($division) { $this->division = $division; }
		function get_division() { return $this->division; }
		function set_userId($userId) { $this->userId = $userId; }
		function get_userId() { return $this->userId; }


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
				$sql = "INSERT INTO $this->table (youtube_event_name,youtube_start_date,youtube_startTime,youtube_endTime,youtube_rate,youtube_amount,division,user_id,record_hide) VALUES (:youtubeEventName,:youtubeStartDate,:youtubeStartTime,:youtubeEndTime,:youtubeRate,:youtubeAmount,:division,:userId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":youtubeEventName",$this->eventTitle);
				$stmt->bindParam(":youtubeStartDate",$this->startDate);
				$stmt->bindParam(":youtubeStartTime",$this->startTime);
				$stmt->bindParam(":youtubeEndTime",$this->endTime);
				$stmt->bindParam(":youtubeRate",$this->eventRate);
				$stmt->bindParam(":youtubeAmount",$this->enterAmount);
				$stmt->bindParam(":division",$this->division);
				$stmt->bindParam(":userId",$this->userId);
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
				$sql="UPDATE $this->table SET youtube_event_name = :youtubeEventName,youtube_start_date = :youtubeStartDate,youtube_startTime = :youtubeStartTime,youtube_endTime = :youtubeEndTime,youtube_rate = :youtubeRate,youtube_amount = :youtubeAmount WHERE youtube_stream_id=:youtubeStreamId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":youtubeEventName",$this->eventTitle);
					$stmt->bindParam(":youtubeStartDate",$this->startDate);
					$stmt->bindParam(":youtubeStartTime",$this->startTime);
					$stmt->bindParam(":youtubeEndTime",$this->endTime);
					$stmt->bindParam(":youtubeRate",$this->eventRate);
					$stmt->bindParam(":youtubeAmount",$this->enterAmount);
					$stmt->bindParam(":youtubeStreamId",$this->id);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}

			}
			// for delete
			function delete(){
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE youtube_stream_id=:youtubeStreamId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":youtubeStreamId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}


		// get users
			function get_liveStreams(){
				$sql="SELECT * FROM $this->table WHERE record_hide =:recordHide AND division = :division ORDER BY youtube_stream_id DESC";
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

		// get user
			function get_liveStream_by_id(){
				$sql="SELECT * FROM $this->table WHERE youtube_stream_id=:youtubeStreamId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":youtubeStreamId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}
		// get the livestreams for today
			function month_liveStream_count(){
				$count=0;
				$sql="SELECT youtube_start_date FROM $this->table WHERE record_hide=:recordHide";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					// foreach ($results as $result) {
					// 	$streamDate = trim($result['youtube_start_date']);
					// 	$currentdate = date("d-m-Y");
					// 	$d1 = new DateTime($streamDate);
     //                	$d2 = new DateTime($currentdate);
     //                	$interval = $d1->diff($d2);
	    //                 $interval->format('%m months');
	    //                 if(($interval->y ==0) && ($interval->m == 1)) {
	    //                 	$count += 1;
	    //                 }
					// }
					return sizeof($results);
				}
				else{
					die();
					}
			}

////////////////////////////////////////////////
//////Get division alias
///////////////////////////////////////////////
function get_division_alias($data){
				$sql="SELECT division_alias FROM division WHERE division_id=:divisionId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":divisionId",$data);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return $results["division_alias"];
				}
				else{
					die();
					}
				}



	}

 ?>