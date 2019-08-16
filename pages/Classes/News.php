<?php 
	class News{
		private $table = "news";
		private $dbConn;
		private $id;
		private $newsTitle;
		private $newscategory;
		private $newsContent;
		private $madeBy;
		private $fileName;
		private $folderName;

	
		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_newsTitle($newsTitle) { $this->newsTitle = $newsTitle; }
		function get_newsTitle() { return $this->newsTitle; }
		function set_newscategory($newscategory) { $this->newscategory = $newscategory; }
		function get_newscategory() { return $this->newscategory; }
		function set_newsContent($newsContent) { $this->newsContent = $newsContent; }
		function get_newsContent() { return $this->newsContent; }
		function set_madeBy($madeBy) { $this->madeBy = $madeBy; }
		function get_madeBy() { return $this->madeBy; }
		function set_fileName($fileName) { $this->fileName = $fileName; }
		function get_fileName() { return $this->fileName; }
		function set_folderName($folderName) { $this->folderName = $folderName; }
		function get_folderName() { return $this->folderName; }



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

		// news images path
		public function newImagePath(){
			return "../../uploads/news/";
		}

		// members count
		function news_count(){
			$sql="SELECT COUNT(news_id) as count FROM $this->table";
			try{
				$stmt = $this->dbConn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row){
					$result = $this->CleanData($row["count"]);	
					return $result;
					}
			}catch(PDOException $e){
				echo '{"error":{"text": '.$e->getMessage().'}';
			}
		}
			
		// saving members details into database
		function insert(){
			$sql="INSERT INTO $this->table (news_title,news_category,news_content,folder_name,file_name,made_by,division) VALUES (:newsTitle,:newscategory,:newsContent,:folderName,:fileName,:made_by,:division)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":newsTitle",$this->newsTitle);
			$stmt->bindParam(":newscategory",$this->newscategory);
			$stmt->bindParam(":newsContent",$this->newsContent);
			$stmt->bindParam(":folderName",$this->folderName);
			$stmt->bindParam(":fileName",$this->fileName);
			$stmt->bindParam(":made_by",$this->madeBy);
			$stmt->bindParam(":division",$_SESSION['division']);
			if ($stmt->execute()) {
				return true;
			}
			else{
				return false;
				}

			}

		// for update
			function update(){
				$sql="UPDATE $this->table SET news_title=:newsTitle,news_category=:newscategory,news_content=:newsContent,file_name=:fileName WHERE news_id=:newsId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":newsTitle",$this->newsTitle);
					$stmt->bindParam(":newscategory",$this->newscategory);
					$stmt->bindParam(":newsContent",$this->newsContent);
					$stmt->bindParam(":fileName",$this->fileName);
					$stmt->bindParam(":newsId",$this->id);

					if ($stmt->execute()) {
						
						return true;
					}
					else{
						return false;
						}
			}

		// for delete
			function delete(){
				$sql="DELETE FROM $this->table WHERE news_id=:newsId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":newsId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					return false;
					}
			}
			// get all news for admin news page
			function get_news_all(){
				$sql="SELECT * FROM $this->table WHERE made_by=:madeBy ORDER BY news_id DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":madeBy",$_SESSION['user_id']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					return false;
					}

				}

		// get all records
			function get_news(){
				$sql="SELECT * FROM $this->table ORDER BY news_id DESC LIMIT 3";
				$stmt = $this->dbConn->prepare($sql);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					return false;
					}

				}

			// get news but limit
				function get_news_limit(){
				$sql="SELECT * FROM $this->table ORDER BY news_id DESC LIMIT 5";
				$stmt = $this->dbConn->prepare($sql);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					return false;
					}

				}
			// get news but limit by 3
				function get_news_limit_by3(){
				$sql="SELECT * FROM $this->table ORDER BY news_id DESC LIMIT 3";
				$stmt = $this->dbConn->prepare($sql);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					return false;
					}

				}
		
			// Get details of a member using their login user_id
			function get_news_by_id(){
				$sql="SELECT * FROM $this->table WHERE news_id=:newsId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":newsId",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					return false;
					}
				}





				// string shortener for when news header is too long 
				function string_shorten($text, $char) {
			    $text = substr($text, 0, $char); //First chop the string to the given character length
			    if(substr($text, 0, strrpos($text, ' '))!='') $text = substr($text, 0, strrpos($text, ' ')); //If there exists any space just before the end of the chopped string take upto that portion only.
			    //In this way we remove any incomplete word from the paragraph
			    $text = $text.'...'; //Add continuation ... sign
			    return $text; //Return the value
			}

}
 ?>