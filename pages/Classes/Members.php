<?php 
	class Members{
		private $table = "members";
		private $id;
		private $firstName;
		private $lastName;
		private $otherName;
		private $personalContact;
		private $emergencyContact;
		private $houseNumber;
		private $houseLocation;
		private $postalAddress;
		private $professionalNumber;
		private $surveyorType;
		private $designation;
		private $companyName;
		private $companyType;
		private $companyContact;
		private $corporateEmail;
		private $region;
		private $officeLocation;
		private $comapanyAddress;
		private $division;

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_firstName($firstName) { $this->firstName = $firstName; }
		function get_firstName() { return $this->firstName; }
		function set_lastName($lastName) { $this->lastName = $lastName; }
		function get_lastName() { return $this->lastName; }
		function set_otherName($otherName) { $this->otherName = $otherName; }
		function get_otherName() { return $this->otherName; }
		function set_personalContact($personalContact) { $this->personalContact = $personalContact; }
		function get_personalContact() { return $this->personalContact; }
		function set_emergencyContact($emergencyContact) { $this->emergencyContact = $emergencyContact; }
		function get_emergencyContact() { return $this->emergencyContact; }
		function set_houseNumber($houseNumber) { $this->houseNumber = $houseNumber; }
		function get_houseNumber() { return $this->houseNumber; }
		function set_houseLocation($houseLocation) { $this->houseLocation = $houseLocation; }
		function get_houseLocation() { return $this->houseLocation; }
		function set_postalAddress($postalAddress) { $this->postalAddress = $postalAddress; }
		function get_postalAddress() { return $this->postalAddress; }
		function set_professionalNumber($professionalNumber) { $this->professionalNumber = $professionalNumber; }
		function get_professionalNumber() { return $this->professionalNumber; }
		function set_surveyorType($surveyorType) { $this->surveyorType = $surveyorType; }
		function get_surveyorType() { return $this->surveyorType; }
		function set_designation($designation) { $this->designation = $designation; }
		function get_designation() { return $this->designation; }
		function set_companyName($companyName) { $this->companyName = $companyName; }
		function get_companyName() { return $this->companyName; }
		function set_companyType($companyType) { $this->companyType = $companyType; }
		function get_companyType() { return $this->companyType; }
		function set_companyContact($companyContact) { $this->companyContact = $companyContact; }
		function get_companyContact() { return $this->companyContact; }
		function set_corporateEmail($corporateEmail) { $this->corporateEmail = $corporateEmail; }
		function get_corporateEmail() { return $this->corporateEmail; }
		function set_region($region) { $this->region = $region; }
		function get_region() { return $this->region; }
		function set_officeLocation($officeLocation) { $this->officeLocation = $officeLocation; }
		function get_officeLocation() { return $this->officeLocation; }
		function set_comapanyAddress($comapanyAddress) { $this->comapanyAddress = $comapanyAddress; }
		function get_comapanyAddress() { return $this->comapanyAddress; }
		function set_division($division) { $this->division = $division; }


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

		// members count
		function members_count(){
			$sql="SELECT COUNT(members_id) as count FROM $this->table";
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
			$sql="INSERT INTO $this->table (first_name,last_name,other_name,personal_contact,emergency_contact,house_number,house_location,postal_address,professional_number,surveyor_type,designation,company_name,company_type,company_contact,corporate_email,region,office_location,company_address,division) VALUES (:first_name,:last_name,:other_name,:personal_contact,:emergency_contact,:house_number,:house_location,:postal_address,:professional_number,:surveyor_type,:designation,:company_name,:company_type,:company_contact,:corporate_email,:region,:office_location,:company_address,:division)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":first_name",$this->firstName);
			$stmt->bindParam(":last_name",$this->lastName);
			$stmt->bindParam(":other_name",$this->otherName);
			$stmt->bindParam(":personal_contact",$this->personalContact);
			$stmt->bindParam(":emergency_contact",$this->emergencyContact);
			$stmt->bindParam(":house_number",$this->houseNumber);
			$stmt->bindParam(":house_location",$this->houseLocation);
			$stmt->bindParam(":postal_address",$this->postalAddress);
			$stmt->bindParam(":professional_number",$this->professionalNumber);
			$stmt->bindParam(":surveyor_type",$this->surveyorType);
			$stmt->bindParam(":designation",$this->designation);
			$stmt->bindParam(":company_name",$this->companyName);
			$stmt->bindParam(":company_type",$this->companyType);
			$stmt->bindParam(":company_contact",$this->companyContact);
			$stmt->bindParam(":corporate_email",$this->corporateEmail);
			$stmt->bindParam(":region",$this->region);
			$stmt->bindParam(":office_location",$this->officeLocation);
			$stmt->bindParam(":company_address",$this->comapanyAddress);
			$stmt->bindParam(":division",$_SESSION['division']);

			if ($stmt->execute()) {
				$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $results;
			}
			else{
				die();
				}

			}

		// for update
			function update(){
				$sql="UPDATE $this->table SET first_name=:first_name,last_name=:last_name,other_name=:other_name,personal_contact=:personal_contact,emergency_contact=:emergency_contact,house_number=:house_number,house_location=:house_location,postal_address=:postal_address,professional_number=:professional_number,surveyor_type=:surveyor_type,designation=:designation,company_name=:company_name,company_type=:company_type,company_contact=:company_contact,corporate_email=:corporate_email,region=:region,office_location=:office_location,company_address=:company_address WHERE members_id=:members_id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":first_name",$this->firstName);
					$stmt->bindParam(":last_name",$this->lastName);
					$stmt->bindParam(":other_name",$this->otherName);
					$stmt->bindParam(":personal_contact",$this->personalContact);
					$stmt->bindParam(":emergency_contact",$this->emergencyContact);
					$stmt->bindParam(":house_number",$this->houseNumber);
					$stmt->bindParam(":house_location",$this->houseLocation);
					$stmt->bindParam(":postal_address",$this->postalAddress);
					$stmt->bindParam(":professional_number",$this->professionalNumber);
					$stmt->bindParam(":surveyor_type",$this->surveyorType);
					$stmt->bindParam(":designation",$this->designation);
					$stmt->bindParam(":company_name",$this->companyName);
					$stmt->bindParam(":company_type",$this->companyType);
					$stmt->bindParam(":company_contact",$this->companyContact);
					$stmt->bindParam(":corporate_email",$this->corporateEmail);
					$stmt->bindParam(":region",$this->region);
					$stmt->bindParam(":office_location",$this->officeLocation);
					$stmt->bindParam(":company_address",$this->comapanyAddress);
					$stmt->bindParam(":members_id",$this->id);

					if ($stmt->execute()) {
						
						return true;
					}
					else{
						die();
						}
			}

		// function for member profile update
			function update_profile(){
				$sql="UPDATE $this->table SET first_name=:first_name,last_name=:last_name,other_name=:other_name,personal_contact=:personal_contact,emergency_contact=:emergency_contact,house_number=:house_number,house_location=:house_location,postal_address=:postal_address,professional_number=:professional_number,surveyor_type=:surveyor_type,designation=:designation,company_name=:company_name,company_type=:company_type,company_contact=:company_contact,corporate_email=:corporate_email,region=:region,office_location=:office_location,company_address=:company_address WHERE members_id=:accountTypeId";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":first_name",$this->firstName);
					$stmt->bindParam(":last_name",$this->lastName);
					$stmt->bindParam(":other_name",$this->otherName);
					$stmt->bindParam(":personal_contact",$this->personalContact);
					$stmt->bindParam(":emergency_contact",$this->emergencyContact);
					$stmt->bindParam(":house_number",$this->houseNumber);
					$stmt->bindParam(":house_location",$this->houseLocation);
					$stmt->bindParam(":postal_address",$this->postalAddress);
					$stmt->bindParam(":professional_number",$this->professionalNumber);
					$stmt->bindParam(":surveyor_type",$this->surveyorType);
					$stmt->bindParam(":designation",$this->designation);
					$stmt->bindParam(":company_name",$this->companyName);
					$stmt->bindParam(":company_type",$this->companyType);
					$stmt->bindParam(":company_contact",$this->companyContact);
					$stmt->bindParam(":corporate_email",$this->corporateEmail);
					$stmt->bindParam(":region",$this->region);
					$stmt->bindParam(":office_location",$this->officeLocation);
					$stmt->bindParam(":company_address",$this->comapanyAddress);
					$stmt->bindParam(":accountTypeId",$_SESSION['account_type_id']);

					if ($stmt->execute()) {
						
						return true;
					}
					else{
						die();
						}
			}

		// for delete
			function delete(){
				$sql="DELETE FROM $this->table WHERE members_id=:members_id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":members_id",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}

		// get all records
			function get_members(){
				$sql="SELECT * FROM $this->table WHERE division=:division ORDER BY first_name ASC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

				}
		// get members by FGHID
			function get_fghis_members(){
				$designation="FGhIS";
				$sql="SELECT * FROM $this->table WHERE division=:division AND designation=:designation ORDER BY first_name ASC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":designation",$designation);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

				}
		// get members professional numbers for account select
				function get_member_list(){
				$sql="SELECT * FROM $this->table WHERE division=:division ORDER BY professional_number ASC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}

				}
		// get member
			function get_member(){
				$sql="SELECT * FROM $this->table WHERE members_id=:members_id";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":members_id",$this->id);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($results);
				}
				else{
					die();
					}
				}

		// for split names and saving them
			function split_names(){
				$sql="SELECT * FROM $this->table";
				$stmt = $this->dbConn->prepare($sql);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ($results as $row) {
						$id = trim($row["members_id"]);
						$fullname = trim($row["first_name"]);
						$split = explode(' ',$fullname,3);
						
						if (sizeof($split)==2) {
							$updatesql = "UPDATE $this->table SET first_name=:firstname, last_name=:lastname WHERE members_id=:membersid";
							$stmt = $this->dbConn->prepare($updatesql);
							$stmt->bindParam(":firstname",$split[0]);
							$stmt->bindParam(":lastname",$split[1]);
							$stmt->bindParam(":membersid",$id);
							$stmt->execute();
						}
						elseif (sizeof($split)==3) {

						$updatesql = "UPDATE $this->table SET first_name=:firstname, last_name=:lastname, other_name=:othername WHERE members_id=:membersid";
						$stmt = $this->dbConn->prepare($updatesql);

						$stmt->bindParam(":firstname",$split[0]);
						$stmt->bindParam(":lastname",$split[2]);
						$stmt->bindParam(":othername",$split[1]);
						$stmt->bindParam(":membersid",$id);
						$stmt->execute();
							}
					}
				}	
			}
		
			// Get details of a member using their login user_id
			function get_member_by_userId(){
				$sql="SELECT * FROM $this->table WHERE members_id=:accountTypeId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":accountTypeId",$_SESSION['account_type_id']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}
				}

			// get member surveyortype based on the professional number

			function get_member_surveyorType(){
				$sql="SELECT surveyor_type FROM $this->table WHERE professional_number=:data";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":data",$_SESSION['member_id']);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

}
 ?>