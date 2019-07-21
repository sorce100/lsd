<?php 
	class Library{
		private $table = "library";
		private $dbConn;
		private $id;
		private $librarySubject;
		private $libraryCategory;
		private $libraryDescription;
		private $folderName;
		private $division;
		private $userId;
		private $recordHide = "NO";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_librarySubject($librarySubject) { $this->librarySubject = $librarySubject; }
		function get_librarySubject() { return $this->librarySubject; }
		function set_libraryCategory($libraryCategory) { $this->libraryCategory = $libraryCategory; }
		function get_libraryCategory() { return $this->libraryCategory; }
		function set_libraryDescription($libraryDescription) { $this->libraryDescription = $libraryDescription; }
		function get_libraryDescription() { return $this->libraryDescription; }
		function set_folderName($folderName) { $this->folderName = $folderName; }
		function get_folderName() { return $this->folderName; }
		function set_division($division) { $this->division = $division; }
		function get_division() { return $this->division; }
		function set_userId($userId) { $this->userId = $userId; }
		function get_userId() { return $this->userId; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }
		function get_recordHide() { return $this->recordHide; }

		// construct for constuct and initializing the database object
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
			
		// saving members details into database
		function insert(){
			$sql="INSERT INTO $this->table (library_subject,library_category,library_description,folder_name,division,user_id,record_hide) VALUES (:librarySubject,:libraryCategory,:libraryDescription,:folderName,:division,:userId,:recordHide)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":librarySubject",$this->librarySubject);
			$stmt->bindParam(":libraryCategory",$this->libraryCategory);
			$stmt->bindParam(":libraryDescription",$this->libraryDescription);
			$stmt->bindParam(":folderName",$this->folderName);
			$stmt->bindParam(":division",$this->division);
			$stmt->bindParam(":userId",$this->userId);
			$stmt->bindParam(":recordHide",$this->recordHide);
			if ($stmt->execute()) {
				return true;
			}
			else{
				return false;
				}

			}

		// for update
			function update(){
				$sql="UPDATE $this->table SET library_subject=:librarySubject,library_category=:libraryCategory,library_description=:libraryDescription WHERE library_id=:libraryId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":librarySubject",$this->librarySubject);
					$stmt->bindParam(":libraryCategory",$this->libraryCategory);
					$stmt->bindParam(":libraryDescription",$this->libraryDescription);
					// $stmt->bindParam(":file_name",NULL);
					$stmt->bindParam(":libraryId",$this->id);

					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}
			}

		// for delete
			function delete(){
				$sql="DELETE FROM $this->table WHERE library_id=:libraryId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":libraryId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}

			// get all news for admin news page
			function get_librarys(){
				$sql="SELECT * FROM $this->table WHERE division=:division ORDER BY library_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					return false;
					}

				}
		
			// Get details of a member using their login user_id
			function get_library_by_id(){
				$sql="SELECT * FROM $this->table WHERE library_id=:libraryId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":libraryId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					return false;
					}
				}
			// get library subjects
			function get_library_subject(){
				$sql="SELECT * FROM $this->table WHERE division=:division ORDER BY library_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":division",$this->division);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					return false;
					}

				}
	}
 ?>