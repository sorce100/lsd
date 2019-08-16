<?php 
	class CommitteeLibrary{
		// setting and getting variables
		private $id;
		private $commLibrarySubject;
		private $commLibraryTask;
		private $commLibraryFolderName;
		private $commLibraryFiles;
		private $commId;
		private $division;
		private $dbConn;
		private $table= "committee_library";

		function set_id($id) { $this->id = $id; }
		function set_commLibrarySubject($commLibrarySubject) { $this->commLibrarySubject = $commLibrarySubject; }
		function set_commLibraryTask($commLibraryTask) { $this->commLibraryTask = $commLibraryTask; }
		function set_commLibraryFolderName($commLibraryFolderName) { $this->commLibraryFolderName = $commLibraryFolderName; }
		function set_commLibraryFiles($commLibraryFiles) { $this->commLibraryFiles = $commLibraryFiles; }
		function set_commId($commId) { $this->commId = $commId; }
		function set_division($division) { $this->division = $division; }

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
				$sql = "INSERT INTO $this->table (committee_library_subject,committee_library_task,committee_library_folderName,committee_library_files,committee_id,user_id,division) VALUES (:commLibrarySubject,:commLibraryTask,:commLibraryFolderName,:commLibraryFiles,:commId,:userid,:division)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":commLibrarySubject",$this->commLibrarySubject);
				$stmt->bindParam(":commLibraryTask",$this->commLibraryTask);
				$stmt->bindParam(":commLibraryFolderName",$this->commLibraryFolderName);
				$stmt->bindParam(":commLibraryFiles",$this->commLibraryFiles);
				$stmt->bindParam(":commId",$this->commId);
				$stmt->bindParam(":userid",$_SESSION['user_id']);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
			// for update
			function update(){
				$sql="UPDATE $this->table SET pages_name=:pagesName,pages_url=:pagesUrl,division=:division WHERE pages_id=:pagesId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":pagesName",$this->pageName);
					$stmt->bindParam(":pagesUrl",$this->pageUrl);
					$stmt->bindParam(":pagesId",$this->id);
					$stmt->bindParam(":division",$this->division);
					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}

			}
			// for delete
			function delete(){
				$sql="DELETE FROM $this->table WHERE pages_id=:pagesId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":pagesId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}

		// get users
			function get_committee_librarys(){
				$sql="SELECT * FROM $this->table WHERE committee_id=:committeeId ORDER BY committee_library_id ASC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":committeeId",$this->commId);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// get user
			function get_pages_by_id(){
				$sql="SELECT * FROM $this->table WHERE pages_id=:pagesId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":pagesId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}



			function get_menu_pages($pagesId){
				$sql="SELECT pages_url FROM $this->table WHERE pages_id=:pagesId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":pagesId",$pagesId);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					print_r( $results["pages_url"]);
				}
				else{
					die();
					}
				}


	}

 ?>