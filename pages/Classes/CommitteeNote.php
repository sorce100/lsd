<?php 
	class CommitteeNote{
		// setting and getting variables
		private $id;
		private $commNoteTitle;
		private $commNoteMessage;
		private $commId;
		private $dbConn;
		private $recordHide = "NO";
		private $table= "committee_notes";

		function set_id($id) { $this->id = $id; }
		function set_commNoteTitle($commNoteTitle) { $this->commNoteTitle = $commNoteTitle; }
		function set_commNoteMessage($commNoteMessage) { $this->commNoteMessage = $commNoteMessage; }
		function set_commId($commId) { $this->commId = $commId; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }
		
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
				$sql = "INSERT INTO $this->table (committee_note_title,committee_note_message,committee_id,user_id,record_hide) VALUES (:commNoteTitle,:commNoteMessage,:commId,:userId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":commNoteTitle",$this->commNoteTitle);
				$stmt->bindParam(":commNoteMessage",$this->commNoteMessage);
				$stmt->bindParam(":commId",$this->commId);
				$stmt->bindParam(":userId",$_SESSION['user_id']);
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
				$sql="UPDATE $this->table SET committee_note_title=:commNoteTitle,committee_note_message=:commNoteMessage WHERE committee_note_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":commNoteTitle",$this->commNoteTitle);
					$stmt->bindParam(":commNoteMessage",$this->commNoteMessage);;
					$stmt->bindParam(":Id",$this->id);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}

			}
			// for delete
			function delete(){
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE committee_note_id=:Id";
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


		// get users
			function get_committee_notes(){
				$sql="SELECT * FROM $this->table WHERE record_hide=:recordHide AND committee_id=:commId ORDER BY committee_note_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":commId",$this->commId);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// get user
			function get_commNote_by_id(){
				$sql="SELECT * FROM $this->table WHERE committee_note_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$this->id);
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