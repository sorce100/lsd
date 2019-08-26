<?php 
	class EventsRegister{
		// setting and getting variables
		private $id;
		private $eventId;
		private $memberId;
		private $eventFeePayed;
		private $eventTicket;
		private $dbConn;
		private $memberName;
		private $table = "events_register";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_eventId($eventId) { $this->eventId = $eventId; }
		function get_eventId() { return $this->eventId; }
		function set_memberId($memberId) { $this->memberId = $memberId; }
		function get_memberId() { return $this->memberId; }
		function set_eventFeePayed($eventFeePayed) { $this->eventFeePayed = $eventFeePayed; }
		function get_eventFeePayed() { return $this->eventFeePayed; }
		function set_eventTicket($eventTicket) { $this->eventTicket = $eventTicket; }
		function get_eventTicket() { return $this->eventTicket; }
		function set_memberName($memberName) { $this->memberName = $memberName; }
		
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
				$sql = "INSERT INTO $this->table (event_id,member_id,event_fee_payed,event_ticket) VALUES (:eventId,:memberId,:eventFeePayed,:eventTicket)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventId",$this->eventId);
				$stmt->bindParam(":memberId",$this->memberId);
				$stmt->bindParam(":eventFeePayed",$this->eventFeePayed);
				$stmt->bindParam(":eventTicket",$this->eventTicket);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
		// meeting insert
			function meeting_insert(){
				$sql = "INSERT INTO $this->table (event_id,member_id,event_fee_payed,event_ticket,meeting_attend_name) VALUES (:eventId,:memberId,:eventFeePayed,:eventTicket,:meetingAttendName)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventId",$this->eventId);
				$stmt->bindParam(":memberId",$this->memberId);
				$stmt->bindParam(":eventFeePayed",$this->eventFeePayed);
				$stmt->bindParam(":eventTicket",$this->eventTicket);
				$stmt->bindParam(":meetingAttendName",$this->memberName);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
			// for update
			function update(){
				$sql="UPDATE $this->table SET group_name=:groupName,group_pages=:groupPages WHERE group_id=:groupId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":groupName",$this->groupName);
					$stmt->bindParam(":groupPages",$this->groupPages);
					$stmt->bindParam(":groupId",$this->id);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}

			}
			// for delete
			function delete(){
				$sql="DELETE FROM $this->table WHERE group_id=:groupId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":groupId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}


		// get users
			function get_event_ticket($eventId,$memberId){
				$sql="SELECT event_ticket FROM $this->table WHERE event_id=:eventId AND member_id=:memberId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventId",$eventId);
				$stmt->bindParam(":memberId",$memberId);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return $results["event_ticket"];
				}
				else{
					die();
					}
			}
		// for if member has registered based on eventid and members id
			function check_event_ticket(){
				$sql="SELECT event_ticket FROM $this->table WHERE event_id=:eventId AND member_id=:memberId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventId",$this->eventId);
				$stmt->bindParam(":memberId",$this->memberId);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return $results["event_ticket"];
				}
				else{
					die();
					}
				}

			function get_participants(){
				$sql="SELECT * FROM $this->table WHERE event_id=:eventId ORDER BY events_reg_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventId",$this->eventId);
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