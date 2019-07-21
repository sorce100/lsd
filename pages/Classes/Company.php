<?php 
	class Company{
		// setting and getting variables
		private $id;
		private $companyName;
		private $companyMembers;
		private $dbConn;
		private $recordHide = "NO";
		private $table= "company";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_companyName($companyName) { $this->companyName = $companyName; }
		function get_companyName() { return $this->companyName; }
		function set_companyMembers($companyMembers) { $this->companyMembers = $companyMembers; }
		function get_companyMembers() { return $this->companyMembers; }
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
			function insert(){
				$sql = "INSERT INTO $this->table (company_name,company_members_id,record_hide) VALUES (:companyName,:companyMembersId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":companyName",$this->companyName);
				$stmt->bindParam(":companyMembersId",$this->companyMembers);
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
				$sql="UPDATE $this->table SET company_name=:companyName,company_members_id=:companyMembersId WHERE company_id=:companyId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":companyName",$this->companyName);
					$stmt->bindParam(":companyMembersId",$this->companyMembers);
					$stmt->bindParam(":companyId",$this->id);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}

			}
			// for delete
			function delete(){
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE company_id=:companyId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":companyId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}


		// get users
			function get_companys(){
				$sql="SELECT * FROM $this->table WHERE record_hide =:recordHide ORDER BY company_id DESC";
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
			function get_company_by_id(){
				$sql="SELECT * FROM $this->table WHERE company_id=:companyId";
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

	}

 ?>