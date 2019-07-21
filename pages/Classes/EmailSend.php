<?php 
	class EmailSend{
		// setting and getting variables
		private $id;
		private $dbConn;
		private $recordHide = "NO";
		private $table = "email_sent";

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_divisionFullname($divisionFullname) { $this->divisionFullname = $divisionFullname; }
		function get_madeby() { return $this->madeby; }
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

		function send_application_mail($url,$subject,$toEmail,$fullname){
			try{
				// send email to client
				$toEmail = trim($toEmail);
				$subject = trim(strtoupper($subject));
				$body = '<h2>Hello Sir/Madam,</h2>
						<h4>Please visit '.$url.' to access and make declaration for<b>'.$this->get_student_fullName($fullname).'</b> <br>
						for application completion of new membership of Ghana Institute of Surveyors</h2>';
				// email header
						$headers = "MIME-Version:1.0"."\r\n";
						$headers .= "Content-Type:text/html;charset=UTF-8"."\r\n";
						$headers .= "X-Priority: 1\r\n";
						$headers .= "X-Mailer: PHP/" . phpversion() ."\r\n";
				// Additional headers
						$headers .= "From: ghislsd.com <support@ghislsd.com>"."\r\n";	
						// sending the mail
						$response = mail($toEmail,$subject,$body,$headers);

						if ($response) {
							$sql = "INSERT INTO $this->table (receiver_email,delivery_response,user_id) VALUES (:receiverEmail,:deliveryResponse,:userId)";
							$stmt = $this->dbConn->prepare($sql);
							$stmt->bindParam(":receiverEmail",$toEmail);
							$stmt->bindParam(":deliveryResponse",$response);
							$stmt->bindParam(":userId",$_SESSION['user_id']);
							$stmt->execute();
						}else{
							die();
						}

			}catch(PDOException $e){
				echo '{"error":{"text": '.$e->getMessage().'}';
			}
		}


		// get student fullname

		public function get_student_fullName($student_id){
			$sql = "SELECT student_title,student_first_name,student_last_name FROM students WHERE student_id = :studentId ";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":studentId",$student_id);
			if ($stmt->execute()) {
				$results = $stmt->fetch(PDO::FETCH_ASSOC);

				return trim($results["student_title"])." ".trim($results["student_first_name"])." ".trim($results["student_last_name"]);
			}
		}

	}

 ?>