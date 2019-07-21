<?php 
	class Events{
		// setting and getting variables
		private $id;
		private $eventTheme;
		private $eventVenue;
		private $eventFee;
		private $eventStartDate;
		private $eventEndDate;
		private $startTime;
		private $endTime;
		private $dbConn;
		private $table= "events";
		private $record_hide = "NO";
		private $hotelNames;
		private $hotelPrices;
		private $eventType;

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_eventTheme($eventTheme) { $this->eventTheme = $eventTheme; }
		function get_eventTheme() { return $this->eventTheme; }
		function set_eventVenue($eventVenue) { $this->eventVenue = $eventVenue; }
		function get_eventVenue() { return $this->eventVenue; }
		function set_eventFee($eventFee) { $this->eventFee = $eventFee; }
		function get_eventFee() { return $this->eventFee; }
		function set_eventStartDate($eventStartDate) { $this->eventStartDate = $eventStartDate; }
		function get_eventStartDate() { return $this->eventStartDate; }
		function set_startTime($startTime) { $this->startTime = $startTime; }
		function get_startTime() { return $this->startTime; }
		function set_endTime($endTime) { $this->endTime = $endTime; }
		function get_endTime() { return $this->endTime; }
		function set_eventEndDate($eventEndDate) { $this->eventEndDate = $eventEndDate; }
		function get_eventEndDate() { return $this->eventEndDate; }
		function set_hotelNames($hotelNames) { $this->hotelNames = $hotelNames; }
		function get_hotelNames() { return $this->hotelNames; }
		function set_hotelPrices($hotelPrices) { $this->hotelPrices = $hotelPrices; }
		function get_hotelPrices() { return $this->hotelPrices; }
		function set_eventType($eventType) { $this->eventType = $eventType; }
		function set_record_hide($record_hide) { $this->record_hide = $record_hide; }

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
				$sql = "INSERT INTO $this->table (event_type,events_theme,event_venue,event_fee,event_date_start,event_date_end,start_time,end_time,hotel_names,hotel_prices,division,user_id,record_hide) VALUES (:eventType,:eventTheme,:eventVenue,:eventFee,:eventStartDate,:eventEndDate,:startTime,:endTime,:hotelNames,:hotelPrices,:division,:userId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventType",$this->eventType);
				$stmt->bindParam(":eventTheme",$this->eventTheme);
				$stmt->bindParam(":eventVenue",$this->eventVenue);
				$stmt->bindParam(":eventFee",$this->eventFee);
				$stmt->bindParam(":eventStartDate",$this->eventStartDate);
				$stmt->bindParam(":eventEndDate",$this->eventEndDate);
				$stmt->bindParam(":startTime",$this->startTime);
				$stmt->bindParam(":endTime",$this->endTime);
				$stmt->bindParam(":hotelNames",$this->hotelNames);
				$stmt->bindParam(":hotelPrices",$this->hotelPrices);
				$stmt->bindParam(":division",$_SESSION['division']);
				$stmt->bindParam(":userId",$_SESSION['user_id']);
				$stmt->bindParam(":recordHide",$this->record_hide);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
		// meeting insert
			function meeting_insert(){
				$sql = "INSERT INTO $this->table (event_type,events_theme,event_venue,event_date_end,start_time,end_time,division,user_id,record_hide) VALUES (:eventType,:eventTheme,:eventVenue,:eventEndDate,:startTime,:endTime,:division,:userId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventType",$this->eventType);
				$stmt->bindParam(":eventTheme",$this->eventTheme);
				$stmt->bindParam(":eventVenue",$this->eventVenue);
				$stmt->bindParam(":eventEndDate",$this->eventEndDate);
				$stmt->bindParam(":startTime",$this->startTime);
				$stmt->bindParam(":endTime",$this->endTime);
				$stmt->bindParam(":division",$_SESSION['division']);
				$stmt->bindParam(":userId",$_SESSION['user_id']);
				$stmt->bindParam(":recordHide",$this->record_hide);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
			// for update
			function update(){
				$sql="UPDATE $this->table SET events_theme=:eventTheme,event_venue=:eventVenue,event_fee=:eventFee,event_date_start=:eventStartDate,start_time=:startTime,end_time=:endTime,event_date_end=:eventEndDate,hotel_names=:hotelNames,hotel_prices= :hotelPrices WHERE events_id=:eventId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":eventTheme",$this->eventTheme);
					$stmt->bindParam(":eventVenue",$this->eventVenue);
					$stmt->bindParam(":eventFee",$this->eventFee);
					$stmt->bindParam(":eventStartDate",$this->eventStartDate);
					$stmt->bindParam(":eventEndDate",$this->eventEndDate);
					$stmt->bindParam(":startTime",$this->startTime);
					$stmt->bindParam(":endTime",$this->endTime);
					$stmt->bindParam(":hotelNames",$this->hotelNames);
					$stmt->bindParam(":hotelPrices",$this->hotelPrices);
					$stmt->bindParam(":eventId",$this->id);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}

			}
			// update meeting
			function update_meeting(){
				$sql="UPDATE $this->table SET events_theme=:eventTheme,event_venue=:eventVenue,event_date_end=:eventEndDate,start_time=:startTime,end_time=:endTime WHERE events_id=:eventId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":eventTheme",$this->eventTheme);
					$stmt->bindParam(":eventVenue",$this->eventVenue);
					$stmt->bindParam(":eventEndDate",$this->eventEndDate);
					$stmt->bindParam(":startTime",$this->startTime);
					$stmt->bindParam(":endTime",$this->endTime);
					$stmt->bindParam(":eventId",$this->id);
					if ($stmt->execute()) {
						return true;
					}
					else{
						return false;
						}

			}
			// for delete
			function delete(){
				$sql="DELETE FROM $this->table WHERE events_id=:eventId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}


		// get events
			function get_events(){
				$type = "Event";
				$sql="SELECT * FROM $this->table WHERE event_type=:eventType AND record_hide=:recordHide ORDER BY events_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventType",$type);
				$stmt->bindParam(":recordHide",$this->record_hide);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}
			// get all meetings
			function get_meetings(){
				$type = "Meeting";
				$sql="SELECT * FROM $this->table WHERE event_type=:eventType AND record_hide=:recordHide ORDER BY events_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventType",$type);
				$stmt->bindParam(":recordHide",$this->record_hide);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

			// get last 5 inserted events
			function get_events_limit5(){
				$sql="SELECT * FROM $this->table ORDER BY events_id DESC ";
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
			function get_events_by_id(){
				$sql="SELECT * FROM $this->table WHERE events_id=:eventId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}
		// get user
			function get_events_general($eventId){
				$sql="SELECT * FROM $this->table WHERE events_id=:eventId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":eventId",$eventId);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}
				}

		// get event price by Id
				function get_event_price(){
					$sql="SELECT event_fee FROM $this->table WHERE events_id=:eventId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":eventId",$this->id);
					if ($stmt->execute()) {
						$results= $stmt->fetch(PDO::FETCH_ASSOC);
						return json_encode($results);
					}
					else{
						die();
						}
				}
		// get all events hotels name and prices ranges set by admin
			function get_hotels(){
				$sql="SELECT hotel_names,hotel_prices FROM $this->table ORDER BY events_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}
		

	}

 ?>