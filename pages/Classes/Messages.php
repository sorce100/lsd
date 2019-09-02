<?php 
	class Messages{
		// setting and getting variables
		private $id;
		private $messageGroup;
		private $messageSubject;
		private $messageContent;
		private $memberList;
		private $messageSender;
		private $messageMode = "SENT";
		private $messageStatus = "NEW";
		private $recordhide = "NO";
		private $dbConn;
		private $table = "messages";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_messageGroup($messageGroup) { $this->messageGroup = $messageGroup; }
		function get_messageGroup() { return $this->messageGroup; }
		function set_messageSubject($messageSubject) { $this->messageSubject = $messageSubject; }
		function get_messageSubject() { return $this->messageSubject; }
		function set_messageContent($messageContent) { $this->messageContent = $messageContent; }
		function get_messageContent() { return $this->messageContent; }
		function set_memberList($memberList) { $this->memberList = $memberList; }
		function get_memberList() { return $this->memberList; }
		function set_messageMode($messageMode) { $this->messageMode = $messageMode; }
		function get_messageMode() { return $this->messageMode; }
		function set_recordhide($recordhide) { $this->recordhide = $recordhide; }
		function set_messageSender($messageSender) { $this->messageSender = $messageSender; }
		function get_messageSender() { return $this->messageSender; }

		
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
				$sql = "INSERT INTO $this->table (message_group,message_sender,message_receivers,message_subject,message_content,message_mode,message_status,record_hide) VALUES (:messageGroup,:messageSender,:messageReceivers,:messageSubject,:messageContent,:messageMode,:messageStatus,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":messageGroup",$this->messageGroup);
				$stmt->bindParam(":messageSender",$this->messageSender);
				$stmt->bindParam(":messageReceivers",$this->memberList);
				$stmt->bindParam(":messageSubject",$this->messageSubject);
				$stmt->bindParam(":messageContent",$this->messageContent);
				$stmt->bindParam(":messageMode",$this->messageMode);
				$stmt->bindParam(":messageStatus",$this->messageStatus);
				$stmt->bindParam(":recordHide",$this->recordhide);
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


		// get messages sent by user, sorted on page using the user_id
			function get_sent_messages(){
				$sql="SELECT * FROM $this->table WHERE message_mode = :messageMode AND message_sender = :messagesender ORDER BY message_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":messageMode",$this->messageMode);
				$stmt->bindParam(":messagesender",$_SESSION['user_id']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}
		// get the messages received 
			function get_received_messages(){
				$sql="SELECT * FROM $this->table WHERE message_mode = :messageMode ORDER BY message_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":messageMode",$this->messageMode);
				if ($stmt->execute()) {
					$newResults = [];
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// get user
			function get_messages_by_id(){
				$sql="SELECT m.message_sender,m.message_subject,m.message_content,m.date_done,u.user_id,u.member_id 
				FROM $this->table AS m
				LEFT JOIN users AS u
				ON u.user_id = m.message_sender
				WHERE m.message_id=:messageId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":messageId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}

		// get group name by id
			function get_groupName_by_id(){
				$sql="SELECT group_id,group_name FROM $this->table WHERE group_id=:groupId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":groupId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}

		// getting all pages for user login dashboard based on group number

				function menu_pages_id($groupId){
					
					$sql="SELECT group_pages FROM $this->table WHERE group_id=:groupId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":groupId",$groupId);
					if ($stmt->execute()) {
						$results = $stmt->fetch(PDO::FETCH_ASSOC);
						$pages = json_decode($results["group_pages"]);
						return $pages;
					}
					else{
						die();
						}

				}


	}

 ?>