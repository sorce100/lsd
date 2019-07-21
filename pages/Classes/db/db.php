<?php 
	class DbConnect{
		private $host = "localhost";
		private $dbname = "ghislsd_db";
		private $user = "root";
		private $password = "";

		public function connect(){
			try {
					$conn = new PDO("mysql:host=".$this->host."; dbname=".$this->dbname,$this->user,$this->password);
					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					return $conn;
				
			} catch (PDOException $e) {
				echo "Database Error:".$e->getMessage();
				
			}
		}
	}
 ?>