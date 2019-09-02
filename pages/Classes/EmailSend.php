<?php
	Class EmailSend{
		private $id;
		private $dbConn;
		private $responseStatus;
		private $table = "email_sent";


		public function __construct(){
			require_once("db/db.php");
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}


		// $mail->SMTPDebug = 1;                               // Enable verbose debug output

		public function send_email($receiverEmail,$emailSubject,$emailBody){

			try{
				require_once 'phpmailer/PHPMailerAutoload.php';
				require_once 'phpmailer/credential.php';
				$mail = new PHPMailer;

				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = EMAIL;                 // SMTP username
				$mail->Password = PASSWD;                           // SMTP password
				$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                    // TCP port to connect to
				// the name of the AccountName<Accountemail.com>
				$mail->setFrom(EMAIL, 'GhiS LSD');
				$mail->addAddress($receiverEmail);     // Add a recipient
				$mail->addReplyTo(EMAIL);
				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = $emailSubject;

				$mail->Body    = $emailBody;
				// alternative body when user does not read html like when example google skips loding for minimal loading time
				// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				if(!$mail->send()) {
					$this->responseStatus = $mail->ErrorInfo;
				    
				    $this->saveDetails($receiverEmail,$emailSubject,$emailBody,$this->responseStatus);
				} else {
					$this->responseStatus = 'success';
				    $this->saveDetails($receiverEmail,$emailSubject,$emailBody,$this->responseStatus);
				}

			}catch(PDOException $e){
				$this->responseStatus = $e->getMessage();
				$this->saveDetails($receiverEmail,$emailSubject,$emailBody,$this->responseStatus);
			}
		}


		// save email details
		private function saveDetails($receiverEmail,$emailSubject,$emailBody,$response){
			$sql = "INSERT INTO $this->table (receiver_email,email_subject,email_body,delivery_response,user_id) VALUES (:receiverEmail,:emailSubject,:emailBody,:deliveryResponse,:userId)";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(":receiverEmail",$receiverEmail);
			$stmt->bindParam(":emailSubject",$emailSubject);
			$stmt->bindParam(":emailBody",$emailBody);
			$stmt->bindParam(":deliveryResponse",$response);
			$stmt->bindParam(":userId",$_SESSION['user_id']);
			$stmt->execute();
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