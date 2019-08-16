<?php 
	class Pages{
		// setting and getting variables
		private $id;
		private $pageName;
		private $pageUrl;
		private $pageFileName;
		private $division;
		private $dbConn;
		private $table= "pages";
		 // declaring arrary to save the pages name
		private	$accessPages=[];

		function set_id($id) { $this->id = $id; }
		function set_pageName($pageName) { $this->pageName = $pageName; }
		function get_pageName() { return $this->pageName; }
		function set_pageUrl($pageUrl) { $this->pageUrl = $pageUrl; }
		function set_pageFileName($pageFileName) { $this->pageFileName = $pageFileName; }
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
				$sql = "INSERT INTO $this->table (pages_name,pages_url,division,page_file_name) VALUES (:pages_name,:pages_url,:division,:pageFileName)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":pages_name",$this->pageName);
				$stmt->bindParam(":pages_url",$this->pageUrl);
				$stmt->bindParam(":pageFileName",$this->pageFileName);
				$stmt->bindParam(":division",$this->division);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
			// for update
			function update(){
				$sql="UPDATE $this->table SET pages_name=:pagesName,pages_url=:pagesUrl,division=:division,page_file_name=:pageFileName WHERE pages_id=:pagesId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":pagesName",$this->pageName);
					$stmt->bindParam(":pagesUrl",$this->pageUrl);
					$stmt->bindParam(":pageFileName",$this->pageFileName);
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
			function get_pages(){
				$sql="SELECT * FROM $this->table ORDER BY pages_name ASC";
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
			
			$sql="SELECT pages_url,page_file_name FROM $this->table WHERE pages_id=:Id";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":Id",$pagesId);
			if ($stmt->execute()) {
				$results= $stmt->fetch(PDO::FETCH_ASSOC);
				// add page to arrary then add the array to session
				$this->accessPages[]=$results["page_file_name"];
				$_SESSION['pagesAllowed']=$this->accessPages;
				
				print_r( $results["pages_url"]);
			}
			else{
				die();
				}
		}


	}

 ?>