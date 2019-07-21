<?php 
	date_default_timezone_set('Africa/Accra');
	class SessionLogs{
		// setting and getting variables
		private $id;
		private $table = "users_session_log";
		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }

		public function __construct(){
			require_once("db/db.php");
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

			function session_log_start(){
				$date = date("l jS \of F Y \/ h:i:s A");
				$sql = "INSERT INTO $this->table (user_id,session_start,division) VALUES (:userId,:sessionStart,:division)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":userId",$_SESSION['user_id']);
				$stmt->bindParam(":sessionStart",$date);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					$_SESSION['session_log_id'] = trim($this->dbConn->lastInsertId());
					return true;
				}
				else{
					die();
					}
			}

		// when the user logs out
			function session_log_end(){
				$sql = "UPDATE $this->table SET  session_end=:sessionEnd WHERE users_session_log_id=:usersSessionLogId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":sessionEnd",date("l jS \of F Y \/ h:i:s A"));
				$stmt->bindParam(":usersSessionLogId",$_SESSION['session_log_id']);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}

		// get all logs
			function get_session(){
				$sql = "SELECT user_id,session_start,session_end FROM $this->table WHERE division=:division ORDER BY users_session_log_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}
			}
	}

 ?>