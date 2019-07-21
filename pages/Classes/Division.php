<?php 
	class Division{
		// setting and getting variables
		private $id;
		private $divisionFullname;
		private $divisionAlias;
		private $divisionYoutube;
		private $madeby;
		private $dbConn;
		private $recordHide = "NO";
		private $table= "division";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_divisionFullname($divisionFullname) { $this->divisionFullname = $divisionFullname; }
		function get_divisionFullname() { return $this->divisionFullname; }
		function set_divisionAlias($divisionAlias) { $this->divisionAlias = $divisionAlias; }
		function get_divisionAlias() { return $this->divisionAlias; }
		function set_divisionYoutube($divisionYoutube) { $this->divisionYoutube = $divisionYoutube; }
		function get_divisionYoutube() { return $this->divisionYoutube; }
		function set_madeby($madeby) { $this->madeby = $madeby; }
		function get_madeby() { return $this->madeby; }
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
				$sql = "INSERT INTO $this->table (division_fullname,division_alias,division_youtube,made_by,record_hide) VALUES (:divisionFullname,:divisionAlias,:divisionYoutube,:madeby,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":divisionFullname",$this->divisionFullname);
				$stmt->bindParam(":divisionAlias",$this->divisionAlias);
				$stmt->bindParam(":divisionYoutube",$this->divisionYoutube);
				$stmt->bindParam(":madeby",$this->madeby);
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
				$sql="UPDATE $this->table SET division_fullname=:divisionFullname,division_alias=:divisionAlias,division_youtube=:divisionYoutube WHERE division_id=:divisionId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":divisionFullname",$this->divisionFullname);
					$stmt->bindParam(":divisionAlias",$this->divisionAlias);
					$stmt->bindParam(":divisionYoutube",$this->divisionYoutube);
					$stmt->bindParam(":divisionId",$this->id);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}

			}
			// for delete
			function delete(){
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE division_id=:divisionId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":divisionId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}


		// get users
			function get_divisions(){
				$sql="SELECT * FROM $this->table WHERE record_hide =:recordHide ORDER BY division_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// get user
			function get_division_by_id(){
				$sql="SELECT * FROM $this->table WHERE division_id=:divisionId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":divisionId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}
		// get division alias
			function get_divison_alias(){
				$sql="SELECT division_id,division_alias FROM $this->table ORDER BY division_alias ASC";
				$stmt = $this->dbConn->prepare($sql);
				if ($stmt->execute()) {
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}
			}
		// get division name
			function get_alias_byId($divisionId){
				$sql="SELECT division_alias FROM $this->table WHERE division_id=:divisionId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":divisionId",$divisionId);
				if ($stmt->execute()) {
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
					return $results["division_alias"];
				}
				else{
					die();
					}
			}

	}

 ?>