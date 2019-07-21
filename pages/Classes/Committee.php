<?php 
	class Committee{
		// setting and getting variables
		private $id;
		private $committeeName;
		private $committeeMembers;
		private $committeeFolder;
		private $committeePages;
		private $dbConn;
		private $recordHide = "NO";
		private $table= "committee_setup";

		function set_id($id) { $this->id = $id; }
		function set_committeeName($committeeName) { $this->committeeName = $committeeName; }
		function set_committeeMembers($committeeMembers) { $this->committeeMembers = $committeeMembers; }
		function set_committeeFolder($committeeFolder) { $this->committeeFolder = $committeeFolder; }
		function set_committeePages($committeePages) { $this->committeePages = $committeePages; }
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
				$sql = "INSERT INTO $this->table (committee_name,committee_members,committee_folder,committee_pages,division,user_id,record_hide) VALUES (:committeeName,:committeeMembers,:committeeFolder,:committeePages,:division,:userId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":committeeName",$this->committeeName);
				$stmt->bindParam(":committeeMembers",$this->committeeMembers);
				$stmt->bindParam(":committeeFolder",$this->committeeFolder);
				$stmt->bindParam(":committeePages",$this->committeePages);
				$stmt->bindParam(":division",$_SESSION["division"]);
				$stmt->bindParam(":userId",$_SESSION["user_id"]);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					return trim($this->dbConn->lastInsertId());
				}
				else{
					die();
					}
			}
			// for update
			function update(){
				$sql="UPDATE $this->table SET committee_name=:committeeName,committee_members=:committeeMembers,committee_pages=:committeePages WHERE committee_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":committeeName",$this->committeeName);
					$stmt->bindParam(":committeeMembers",$this->committeeMembers);
					$stmt->bindParam(":committeePages",$this->committeePages);
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
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE committee_id=:Id";
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
			function get_committees(){
				$sql="SELECT * FROM $this->table WHERE record_hide =:recordHide ORDER BY committee_id DESC";
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
		// get members committes
			function get_member_committees($data){
				$sql="SELECT * FROM $this->table WHERE committee_id=:companyId AND record_hide=:recordHide";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":companyId",$data);
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
			function get_committee_by_id(){
				$sql="SELECT * FROM $this->table WHERE committee_id=:companyId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":companyId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}


			// update member committees using their member id


			function update_member_committee($memberId,$committeeId){
				$committeesArray = array();
				$sql="SELECT committes FROM members WHERE members_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$memberId);
				if ($stmt->execute()) {
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
					if (!empty($results["committes"])) {
						// get committes of member
						$results = json_decode($results["committes"]);
						foreach ($results as $returnedCommId) {
							array_push($committeesArray,$returnedCommId);
						}
						// add new committee to member
						if (!in_array($committeeId,$committeesArray)) {
							array_push($committeesArray,$committeeId);
						}
					}
					elseif (empty($results["committes"])) {
						array_push($committeesArray,$committeeId);
						// $committeesArray = $committeeId;
					}
					// now update member with new committee
					$updateSql = "UPDATE members set committes=:newCommittes WHERE members_id=:Id";
					$stmt = $this->dbConn->prepare($updateSql);
					$stmt->bindParam(":newCommittes",json_encode($committeesArray));
					$stmt->bindParam(":Id",$memberId);
					$stmt->execute();
					return $committeesArray;
				}
				else{
					die();
				}

			}

	}

 ?>