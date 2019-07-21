<?php 
	class Groups{
		// setting and getting variables
		private $id;
		private $groupName;
		private $groupPages;
		private $dbConn;
		private $table= "groups";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_groupName($groupName) { $this->groupName = $groupName; }
		function get_groupName() { return $this->groupName; }
		function set_groupPages($groupPages) { $this->groupPages = $groupPages; }
		function get_groupPages() { return $this->groupPages; }
		
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
				$sql = "INSERT INTO $this->table (group_name,group_pages) VALUES (:groupName,:groupPages)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":groupName",$this->groupName);
				$stmt->bindParam(":groupPages",$this->groupPages);
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
			function get_groups(){
				$sql="SELECT * FROM $this->table ORDER BY group_id DESC";
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
			function get_groups_by_id(){
				$sql="SELECT * FROM $this->table WHERE group_id=:groupId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":groupId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
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