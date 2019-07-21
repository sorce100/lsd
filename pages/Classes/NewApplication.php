<?php 
	date_default_timezone_set('Africa/Accra');
	class NewApplication{
		// setting and getting variables
		private $id;
		private $dbConn;
		private $table = "new_application";
		private $recordHide = "NO";
		private $applicationStage = "START";
		private $applicationDiv;
		private $filesSubject;
		private $filesName;
		private $folderName;
		private $collegeEmail;
		private $employerEmail;
		private $col_instructorTitle;
		private $col_instructFullname;
		private $col_Name;
		private $col_stuStartDate;
		private $col_competenceDiv;
		private $col_principalName;
		private $col_principalProfNum;
		private $emp_comName;
		private $emp_comLoc;
		private $emp_tel;
		private $emp_tecDivision;
		private $emp_stuBranch;
		private $com_trianerName;
		private $emp_ProfNum;
		private $memberDeclare_id;
		private $memberDeclare_note;
		private $memberDeclare_date;
		private $Startdate;
		private $application_code;
		private $studentId;

		function set_id($id) { $this->id = $id; }
		function get_id() { return $this->id; }
		function set_applicationDiv($applicationDiv) { $this->applicationDiv = $applicationDiv; }
		function get_applicationDiv() { return $this->applicationDiv; }
		function set_filesSubject($filesSubject) { $this->filesSubject = $filesSubject; }
		function set_applicationStage($applicationStage) { $this->applicationStage = $applicationStage; }
		function get_applicationStage() { return $this->applicationStage; }
		function get_filesSubject() { return $this->filesSubject; }
		function set_filesName($filesName) { $this->filesName = $filesName; }
		function get_filesName() { return $this->filesName; }
		function set_folderName($folderName) { $this->folderName = $folderName; }
		function get_folderName() { return $this->folderName; }
		function set_collegeEmail($collegeEmail) { $this->collegeEmail = $collegeEmail; }
		function get_collegeEmail() { return $this->collegeEmail; }
		function set_employerEmail($employerEmail) { $this->employerEmail = $employerEmail; }
		function get_employerEmail() { return $this->employerEmail; }
		function set_col_instructorTitle($col_instructorTitle) { $this->col_instructorTitle = $col_instructorTitle; }
		function get_col_instructorTitle() { return $this->col_instructorTitle; }
		function set_col_instructFullname($col_instructFullname) { $this->col_instructFullname = $col_instructFullname; }
		function get_col_instructFullname() { return $this->col_instructFullname; }
		function set_col_Name($col_Name) { $this->col_Name = $col_Name; }
		function get_col_Name() { return $this->col_Name; }
		function set_col_stuStartDate($col_stuStartDate) { $this->col_stuStartDate = $col_stuStartDate; }
		function get_col_stuStartDate() { return $this->col_stuStartDate; }
		function set_col_competenceDiv($col_competenceDiv) { $this->col_competenceDiv = $col_competenceDiv; }
		function get_col_competenceDiv() { return $this->col_competenceDiv; }
		function set_col_principalName($col_principalName) { $this->col_principalName = $col_principalName; }
		function get_col_principalName() { return $this->col_principalName; }
		function set_col_principalProfNum($col_principalProfNum) { $this->col_principalProfNum = $col_principalProfNum; }
		function get_col_principalProfNum() { return $this->col_principalProfNum; }
		function set_emp_comName($emp_comName) { $this->emp_comName = $emp_comName; }
		function get_emp_comName() { return $this->emp_comName; }
		function set_emp_comLoc($emp_comLoc) { $this->emp_comLoc = $emp_comLoc; }
		function get_emp_comLoc() { return $this->emp_comLoc; }
		function set_emp_tel($emp_tel) { $this->emp_tel = $emp_tel; }
		function get_emp_tel() { return $this->emp_tel; }
		function set_emp_tecDivision($emp_tecDivision) { $this->emp_tecDivision = $emp_tecDivision; }
		function get_emp_tecDivision() { return $this->emp_tecDivision; }
		function set_emp_stuBranch($emp_stuBranch) { $this->emp_stuBranch = $emp_stuBranch; }
		function get_emp_stuBranch() { return $this->emp_stuBranch; }
		function set_com_trianerName($com_trianerName) { $this->com_trianerName = $com_trianerName; }
		function get_com_trianerName() { return $this->com_trianerName; }
		function set_emp_ProfNum($emp_ProfNum) { $this->emp_ProfNum = $emp_ProfNum; }
		function get_emp_ProfNum() { return $this->emp_ProfNum; }
		function set_memberDeclare_id($memberDeclare_id) { $this->memberDeclare_id = $memberDeclare_id; }
		function get_memberDeclare_id() { return $this->memberDeclare_id; }
		function set_memberDeclare_note($memberDeclare_note) { $this->memberDeclare_note = $memberDeclare_note; }
		function get_memberDeclare_note() { return $this->memberDeclare_note; }
		function set_memberDeclare_date($memberDeclare_date) { $this->memberDeclare_date = $memberDeclare_date; }
		function get_memberDeclare_date() { return $this->memberDeclare_date; }
		function set_recordHide($recordHide) { $this->recordHide = $recordHide; }
		function get_recordHide() { return $this->recordHide; }
		function set_Startdate($Startdate) { $this->Startdate = $Startdate; }
		function get_Startdate() { return $this->Startdate; }
		function set_application_code($application_code) { $this->application_code = $application_code; }
		function get_application_code() { return $this->application_code; }
		function set_studentId($studentId) { $this->studentId = $studentId; }
		
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
			function insert_A(){

				$sql = "INSERT INTO $this->table (application_division,application_stage,application_code,folder_name,files_subject,files_name,college_email,employer_email,application_startDate,student_id,user_id,record_hide,member_declare_id,member_declare_note) VALUES (:applicationDiv,:applicationStage,:applicationCode,:folderName,:filesSubject,:filesName,:collegeEmail,:employerEmail,:applicationStartDate,:studentId,:userId,:recordHide,:memberDeclareId,:memberDeclareNote)";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":applicationDiv",$this->applicationDiv);
				$stmt->bindParam(":applicationStage",$this->applicationStage);
				$stmt->bindParam(":applicationCode",$this->application_code);
				$stmt->bindParam(":folderName",$this->folderName);
				$stmt->bindParam(":filesSubject",$this->filesSubject);
				$stmt->bindParam(":filesName",$this->filesName);
				$stmt->bindParam(":collegeEmail",$this->collegeEmail);
				$stmt->bindParam(":employerEmail",$this->employerEmail);
				$stmt->bindParam(":applicationStartDate",$this->Startdate);
				$stmt->bindParam(":studentId",$_SESSION["student_id"]);
				$stmt->bindParam(":userId",$_SESSION["user_id"]);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":memberDeclareId",$this->memberDeclare_id);
				$stmt->bindParam(":memberDeclareNote",$this->memberDeclare_note);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
			function insert_B(){
				$sql = "UPDATE $this->table SET col_instructor_title = :colInstructorTitle,col_instruct_fullname = :colInstructFullname,col_name = :colName,col_stu_startDate = :colStuStartDate,col_competence_div = :colCompetenceDiv,col_principal_name = :colPrincipalName,col_principal_profNum = :colPrincipalProfNum,col_declare_date = :colDeclareDate WHERE application_code = :applicationCode";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":colInstructorTitle",$this->col_instructorTitle);
				$stmt->bindParam(":colInstructFullname",$this->col_instructFullname);
				$stmt->bindParam(":colName",$this->col_Name);
				$stmt->bindParam(":colStuStartDate",$this->col_stuStartDate);
				$stmt->bindParam(":colCompetenceDiv",$this->col_competenceDiv);
				$stmt->bindParam(":colPrincipalName",$this->col_principalName);
				$stmt->bindParam(":colPrincipalProfNum",$this->col_principalProfNum);
				$stmt->bindParam(":colDeclareDate",$this->Startdate);
				$stmt->bindParam(":applicationCode",$this->application_code);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}

			function insert_C(){
				$sql = "UPDATE $this->table SET emp_com_name=:empComName,emp_com_loc=:empComLoc,emp_tel=:empTel,emp_tec_division=:empTecDivision,emp_stu_branch=:empStuBranch,com_trianer_name=:comTrianerName,emp_trianer_profNum=:empTrianerProfNum,emp_declare_date=:empDeclareDate  WHERE application_code = :applicationCode";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":empComName",$this->emp_comName);
				$stmt->bindParam(":empComLoc",$this->emp_comLoc);
				$stmt->bindParam(":empTel",$this->emp_tel);
				$stmt->bindParam(":empTecDivision",$this->emp_tecDivision);
				$stmt->bindParam(":empStuBranch",$this->emp_stuBranch);
				$stmt->bindParam(":comTrianerName",$this->com_trianerName);
				$stmt->bindParam(":empTrianerProfNum",$this->emp_ProfNum);
				$stmt->bindParam(":empDeclareDate",$this->Startdate);
				$stmt->bindParam(":applicationCode",$this->application_code);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
			function insert_D(){
				$sql = "UPDATE $this->table SET member_declare_date=:memberDeclareDate WHERE new_application_id = :new_applicationId AND student_id=:studentId AND member_declare_id=:memberDeclareId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":memberDeclareDate",$this->Startdate);
				$stmt->bindParam(":new_applicationId",$this->id);
				$stmt->bindParam(":studentId",$this->studentId);
				$stmt->bindParam(":memberDeclareId",$this->memberDeclare_id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
			function insert_E(){
				$sql = "UPDATE $this->table SET application_stage=:applicationStage WHERE new_application_id = :new_applicationId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":applicationStage",$this->applicationStage);
				$stmt->bindParam(":new_applicationId",$this->id);
				if ($stmt->execute()) {
					return true;
				}
				else{
					die();
					}
			}
//////////////////////////////////////////
/////////////// ALL APPLICATIONS THAT DONE
			function get_applications(){
				$appStage="SUBMITTED";
				$sql="SELECT application_code,application_division,student_id,application_startDate,new_application_id,app_accept_date FROM $this->table WHERE application_division=:applicationDivision AND record_hide=:recordHide AND application_stage=:applicationStage ORDER BY application_stage DESC";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":applicationDivision",$_SESSION["division"]);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":applicationStage",$appStage);
				if ($stmt->execute()) {
					$results= $stmt->fetchALL(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}
			}

		// check if application if student has started the application
			function check_application_start(){
				$sql="SELECT new_application_id FROM $this->table WHERE student_id=:studentId AND record_hide=:recordHide";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":studentId",$_SESSION["account_type_id"]);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return $results["new_application_id"];
				}
				else{
					die();
					}
			}
		// check declarations
			function check_declarations($declareDates){
				$sql="SELECT $declareDates FROM $this->table WHERE student_id=:studentId AND record_hide=:recordHide";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":studentId",$_SESSION["account_type_id"]);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					return $results[$declareDates];
				}
				else{
					die();
					}
				}
		// check if all declaratiion dates are present 
			function check_declarations_completion(){
				$sql="SELECT application_startDate,col_declare_date,emp_declare_date,member_declare_date FROM $this->table WHERE student_id=:studentId AND record_hide=:recordHide AND application_stage=:applicationStage";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":studentId",$_SESSION["account_type_id"]);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":applicationStage",$this->applicationStage);
				if ($stmt->execute()) {
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
					if (empty($results["application_startDate"]) || empty($results["col_declare_date"]) || empty($results["emp_declare_date"]) || empty($results["member_declare_date"])) {
						return "INCOMPLETE";
					}else{
						return "COMPLETE";
					}
				}
			}

		// get details of declaration dates for applicant review when completed
			function applicant_data_review(){
				$sql="SELECT new_application_id,application_startDate,col_declare_date,emp_declare_date,member_declare_date FROM $this->table WHERE student_id=:studentId AND record_hide=:recordHide";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":studentId",$_SESSION["account_type_id"]);
				$stmt->bindParam(":recordHide",$this->recordHide);
				if ($stmt->execute()) {
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
					return json_encode($results,true);
				}
				else{
					die();
					}
				}

		// check if college has filled out
			function college_code_check($applicationCode){
				$sql="SELECT application_code,col_declare_date FROM $this->table WHERE application_code=:applicationCode";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":applicationCode",trim($applicationCode));
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					$appCode = trim($results["application_code"]);
					$declareDate = trim($results["col_declare_date"]);

					if ($appCode == $applicationCode) {
						if (!empty($appCode) && empty($declareDate)) {
							return "TRUE";
						}
						elseif (!empty($appCode) && !empty($declareDate)) {
							return "FALSE";
						}
					}
				}
				else{
					die();
					}
			}
		// check if employer or trainer has filled out
			function employer_code_check($applicationCode){
				$sql="SELECT application_code,emp_declare_date FROM $this->table WHERE application_code=:applicationCode";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":applicationCode",trim($applicationCode));
				if ($stmt->execute()) {
					$results= $stmt->fetch(PDO::FETCH_ASSOC);
					$appCode = trim($results["application_code"]);
					$declareDate = trim($results["emp_declare_date"]);

					if ($appCode == $applicationCode) {
						if (!empty($appCode) && empty($declareDate)) {
							return "TRUE";
						}
						elseif (!empty($appCode) && !empty($declareDate)) {
							return "FALSE";
						}
					}
				}
				else{
					die();
					}
			}
		// get student details for college declaration verification
			function collegeDeclare_studentInfo($appCode){
				$sql="SELECT student_id FROM $this->table WHERE application_code=:applicationCode";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":applicationCode",trim($appCode));
				$stmt->execute();
				$results= $stmt->fetch(PDO::FETCH_ASSOC);
				$studentId = $results['student_id'];

				$stusql = "SELECT student_title,student_first_name,student_last_name,student_dob,student_email,student_tel FROM students WHERE student_id = :studentId ";
				$stustmt = $this->dbConn->prepare($stusql);
				$stustmt->bindParam(":studentId",$studentId);
				if ($stustmt->execute()) {
					return $stustmt->fetch(PDO::FETCH_ASSOC);
				}
			}

		// get proposer declaration list

			function get_proposer_list(){
				$sql="SELECT student_id,new_application_id,member_declare_date FROM $this->table WHERE application_stage=:applicationStage AND record_hide=:recordHide AND member_declare_id=:memberId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":applicationStage",$this->applicationStage);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":memberId",$_SESSION['member_id']);
				if ($stmt->execute()) {
					$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $results;
				}
				else{
					die();
					}
				}

		// view application details made for proposer
			function proposer_viewApplication(){
				$sql="SELECT application_startDate,col_declare_date,emp_declare_date,member_declare_note FROM $this->table WHERE application_stage=:applicationStage AND record_hide=:recordHide AND student_id=:studentId AND new_application_id=:newApplicationId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":applicationStage",$this->applicationStage);
				$stmt->bindParam(":recordHide",$this->recordHide);
				$stmt->bindParam(":studentId",$this->studentId);
				$stmt->bindParam(":newApplicationId",$this->id);
				if ($stmt->execute()) {
					$results = $stmt->fetch(PDO::FETCH_ASSOC);
					return json_encode($results,true);
				}
				else{
					die();
					}
				}
////////////////////////////////////////////////////
////////// GET DETAILS OF YET TO CONFIRMED APPLICANT
			function confirm_applicant_Details(){
				$sql="SELECT * FROM $this->table WHERE new_application_id=:newApplicationId";
				$stmt = $this->dbConn->prepare($sql);
				$stmt->bindParam(":newApplicationId",$this->id);
				if ($stmt->execute()) {
					$mainResults = $stmt->fetch(PDO::FETCH_ASSOC);
					///////////////////////////
					// grab students details
					//////////////////////////
					$sqlStudent = "SELECT student_title,student_first_name,student_last_name,student_dob,student_tel,student_email,student_post_address FROM students WHERE student_id=:studentId";
					$stmtStudent = $this->dbConn->prepare($sqlStudent);
					$stmtStudent->bindParam(":studentId",$mainResults['student_id']);
					$stmtStudent->execute();
					$studentResults = $stmtStudent->fetch(PDO::FETCH_ASSOC);
					// now add results from student to the main results
					$mainResults["studentFullname"] = $studentResults["student_title"]." ".$studentResults["student_first_name"]." ".$studentResults["student_last_name"];
					$mainResults["studentdob"] = $studentResults["student_dob"];
					// explodee dob for age calculation
					if (!empty($mainResults["studentdob"])) {
						$yearBorn = explode('-',$mainResults["studentdob"]);
						$mainResults["age"] = (date('Y')-$yearBorn[2])." Years";
					}
					elseif (empty($mainResults["studentdob"])) {
						$mainResults["age"] = "NOT UPDATED";
					}
					

					$mainResults["studenttel"] = $studentResults["student_tel"];
					$mainResults["studentemail"] = $studentResults["student_email"];
					$mainResults["studentpostAddress"] = $studentResults["student_post_address"];
					///////////////////////////
					// grab member/proposer details
					//////////////////////////
					$sqlMember = "SELECT first_name,other_name,last_name,professional_number,personal_contact,postal_address,company_name,year_elected FROM members WHERE professional_number=:professionalNumber";
					$stmtMember = $this->dbConn->prepare($sqlMember);
					$stmtMember->bindParam(":professionalNumber",$mainResults['member_declare_id']);
					$stmtMember->execute();
					$memberResults = $stmtMember->fetch(PDO::FETCH_ASSOC);
					// retriving details
					$mainResults["memberFullname"] = $memberResults["first_name"]." ".$memberResults["other_name"]." ".$memberResults["last_name"];
					$mainResults["memberProfNum"] = $memberResults["professional_number"];
					$mainResults["memberTel"] = $memberResults["personal_contact"];
					$mainResults["memberPostAdd"] = $memberResults["postal_address"];
					$mainResults["memberComName"] = $memberResults["company_name"];
					$mainResults["memberYearElect"] = $memberResults["year_elected"];

					return json_encode($mainResults,true);
				}	
				else{
					die();
					}
			}

///////////////////////////////////////////////////////////////
////////// DOWNLOAD APPLICATION FILES ZIP
///////////////////////////////////////////////////////////////
			function download_files_zip($folderName){
					$folderName= trim($folderName);
					$folderName=htmlentities(trim($folderName),ENT_QUOTES, 'UTF-8');
					$folderName = filter_var($folderName,FILTER_SANITIZE_SPECIAL_CHARS);
	
				    $rootPath = "../../uploads/new_applications/";
				    $zipname=$folderName.'.zip';
				    $zip = new ZipArchive();
				    $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
				    // Create recursive directory iterator
				    /** @var SplFileInfo[] $files */
				    $files = new RecursiveIteratorIterator(
				        new RecursiveDirectoryIterator($rootPath),
				        RecursiveIteratorIterator::LEAVES_ONLY
				    );
				    foreach ($files as $name => $file)
				    {
				        // Skip directories (they would be added automatically)
				        if (!$file->isDir())
				        {
				            // Get real and relative path for current file
				            $filePath = $file->getRealPath();
				            $relativePath = substr($filePath, strlen($rootPath) + 1);

				            // Add current file to archive
				            $zip->addFile($filePath, $relativePath);
				        }
				    }
				    // Zip archive will be created only after closing object
				    $zip->close();
				    header("content-type:application/octect-stream");
				    header("content-disposition:attachment; folderName=$zipname");
				    // Read the file to download
				    readfile($zipname);
				    // delete file after it has being downloaded and return to tha calling page
				    unlink($zipname);
			}
}

?>