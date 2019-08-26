
 <?php 
	class CpdSetup{
		// setting and getting variables
		private $id;
		private $cpdRegisterName;
		private $cpdRegisterAmt;
		private $division;
		private $dbConn;
		private $recordHide='NO';
		private $table= "cpd_setup";

		function set_id($id) { $this->id = $id; }
		function set_division($division) { $this->division = $division; }
		function set_cpdRegisterName($cpdRegisterName) { $this->cpdRegisterName = $cpdRegisterName; }
		function set_cpdRegisterAmt($cpdRegisterAmt) { $this->cpdRegisterAmt = $cpdRegisterAmt; }
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
				$sql = "INSERT INTO $this->table (cpd_name,cpd_amount,division,user_id,record_hide) VALUES (:cpdRegisterName,:cpdRegisterAmt,:division,:userId,:recordHide)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":cpdRegisterName",$this->cpdRegisterName);
				$stmt->bindParam(":cpdRegisterAmt",$this->cpdRegisterAmt);
				$stmt->bindParam(":division",$_SESSION['division']);
				$stmt->bindParam(":userId",$_SESSION['user_id']);
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
				$sql="UPDATE $this->table SET cpd_name=:cpdRegisterName,cpd_amount=:cpdRegisterAmt WHERE cpd_id=:Id";
					$stmt = $this->dbConn->prepare($sql);
					$stmt->bindParam(":cpdRegisterName",$this->cpdRegisterName);
					$stmt->bindParam(":cpdRegisterAmt",$this->cpdRegisterAmt);
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
				$sql="UPDATE $this->table SET record_hide=:recordHide WHERE cpd_id=:Id";
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

		// get all cpd
			function get_cpd(){
				$sql="SELECT * FROM $this->table WHERE record_hide=:recordHide AND division=:division ORDER BY cpd_id ASC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}



		// get all cpd
			function get_cpds_and_register(){
				$sql='SELECT c.cpd_name,c.cpd_amount,c.cpd_id,r.cpd_payed,r.cpd_register_id,r.cpd_register_id,r.cpd_amount_payed_date
					FROM cpd_setup AS c 
					LEFT JOIN cpd_register AS r 
					ON  c.cpd_id = r.cpd_id
					WHERE c.record_hide=:recordHide AND c.division=:division ORDER BY c.cpd_id ASC';
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":division",$_SESSION['division']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}

			}

		// get user
			function get_cpd_by_id(){
				$sql="SELECT * FROM $this->table WHERE cpd_id=:Id";
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