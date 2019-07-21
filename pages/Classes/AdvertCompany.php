<?php 
	class AdvertCompany{
		// setting and getting variables
		private $id;
		
		private $dbConn;
		private $recordHide = "NO";
		private $table= "advert_company";
		private $advertCom;
		private $advertComTel;
		private $advertComAddress;
		private $advertComLocation;
		private $advertComCategory;
		private $madeBy;

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_advertCom($advertCom) { $this->advertCom = $advertCom; }
		function get_advertCom() { return $this->advertCom; }
		function set_advertComTel($advertComTel) { $this->advertComTel = $advertComTel; }
		function get_advertComTel() { return $this->advertComTel; }
		function set_advertComAddress($advertComAddress) { $this->advertComAddress = $advertComAddress; }
		function get_advertComAddress() { return $this->advertComAddress; }
		function set_advertComLocation($advertComLocation) { $this->advertComLocation = $advertComLocation; }
		function get_advertComLocation() { return $this->advertComLocation; }
		function set_advertComCategory($advertComCategory) { $this->advertComCategory = $advertComCategory; }
		function get_advertComCategory() { return $this->advertComCategory; }
		function set_madeBy($madeBy) { $this->madeBy = $madeBy; }
		function get_madeBy() { return $this->madeBy; }
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
				$sql = "INSERT INTO $this->table (advert_com_name,advert_com_address,advert_com_location,advert_com_tel,advert_com_category,made_by,record_hide) VALUES (:advertComName,:advertComAddress,:advertComLocation,:adverComTel,:advertComCategory,:madeBy,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":advertComName",$this->advertCom);
				$stmt->bindParam(":advertComAddress",$this->advertComAddress);
				$stmt->bindParam(":advertComLocation",$this->advertComLocation);
				$stmt->bindParam(":adverComTel",$this->advertComTel);
				$stmt->bindParam(":advertComCategory",$this->advertComCategory);
				$stmt->bindParam(":madeBy",$this->madeBy);
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
				$sql="UPDATE $this->table SET advert_com_name=:advertComName,advert_com_address=:advertComAddress,advert_com_location=:advertComLocation,advert_com_tel=:adverComTel,advert_com_category=:advertComCategory WHERE advert_com_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":advertComName",$this->advertCom);
					$stmt->bindParam(":advertComAddress",$this->advertComAddress);
					$stmt->bindParam(":advertComLocation",$this->advertComLocation);
					$stmt->bindParam(":adverComTel",$this->advertComTel);
					$stmt->bindParam(":advertComCategory",$this->advertComCategory);
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
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE advert_com_id=:Id";
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
			function get_advert_companys(){
				$sql="SELECT * FROM $this->table WHERE record_hide =:recordHide ORDER BY advert_com_id DESC";
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
			function get_advert_by_id(){
				$sql="SELECT * FROM $this->table WHERE advert_com_id=:Id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":Id",$this->id);
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