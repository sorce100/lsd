<?php
	require_once("../Classes/Users.php");
	require_once("../Classes/Groups.php");
	require_once("../Classes/Sms.php"); 
	require_once("../Classes/SessionLogs.php");
	session_start();
	class UsersControl{
		private $userpassword;
		private $resetpassword;
		function __construct(){
			switch (trim($_POST["mode"])) {
						// for login
						case 'login':

							$objUsers = new Users();
							$objUsers->set_memberId($objUsers->CleanData($_POST["professional_number"]));
							$objUsers->set_status($objUsers->CleanData("ACTIVE"));

							$users = $objUsers->login();
							foreach ($users as $user) {
								$this->userpassword = $objUsers->CleanData($user["user_password"]);
								$this->resetpassword = $objUsers->CleanData($user["reset_password"]);
							}
								if (password_verify ($objUsers->CleanData($_POST["userPassword"]) ,  $this->userpassword)) {
										// check if password change is required
										if ($this->resetpassword == "YES") {
											echo "reset";
											
										}elseif ($this->resetpassword == "NO") {
											$_SESSION['user_id'] = $objUsers->CleanData($user['user_id']); // Initializing Session
											$_SESSION['member_id'] = $objUsers->CleanData($user['member_id']);
											$_SESSION['group_id'] = $objUsers->CleanData($user['group_id']);
											$_SESSION['account_type'] = $objUsers->CleanData($user['account_type']);
											$_SESSION['account_type_id'] = $objUsers->CleanData($user['account_type_id']);
											$_SESSION['division'] = $objUsers->CleanData($user['division']);

											if ($objUsers->CleanData($user['account_type']) == "member") {
												$_SESSION['member_committees'] = $objUsers->get_member_details($_SESSION['member_id']);
											}
											if ($objUsers->CleanData($user['account_type']) == "student") {
												$studentDetails = $objUsers->get_student_details($_SESSION['account_type_id']);
												$_SESSION['student_id'] = $objUsers->CleanData($studentDetails["student_id"]);
												$_SESSION['exam_center_id'] = $objUsers->CleanData($studentDetails["exam_center_id"]);
											}
												// if login successfull then update user online
												$objUsers->session_status_update('ONLINE');
												// save in session log table
												$objSessionLogs = new SessionLogs();
												$objSessionLogs->session_log_start();
												
												echo "success";
										}

								}
								else{
									echo "error";
								}
						break;
						// for insert
						case 'insert':
							try{
									$objUsers = new Users();
									// spliting memberID as username and the account type primary key
									$results = $objUsers->CleanData($_POST["memberId"]);
									$username_accId = explode('|', $results);
									
									$this->userpassword = $objUsers->CleanData($_POST["userPassword"]);
									$objUsers->set_userPassword($objUsers->CleanData(password_hash($this->userpassword, PASSWORD_DEFAULT)));
									$objUsers->set_passwordReset($objUsers->CleanData($_POST["accPasswdReset_log"]));
									$objUsers->set_status($objUsers->CleanData($_POST["accStatus_log"]));
									$objUsers->set_division($objUsers->CleanData($_SESSION['division']));
									$objUsers->set_accountType($objUsers->CleanData($_POST["accountType"]));
									$objUsers->set_memberId($objUsers->CleanData($username_accId[0]));
									$objUsers->set_accountTypeId($objUsers->CleanData($username_accId[1]));
									$objUsers->set_groupId($objUsers->CleanData($_POST["groupId"]));
									if ($objUsers->insert()) {
											// for sms class
											$objSms = new Sms();
											// send sms account user
											$objSms->send_sms("$username_accId[2]","Dear $username_accId[3], your GhIS account has being created successfully. Please log on http://ghislsd.com with credentials, username: $username_accId[0] and password : $this->userpassword");
											echo "success";

										}
										else{
											echo "error";
										}

								}catch(PDOException $e){$e->getMessage();}

						break;
						// for update
						case 'update':
							
									$objUsers = new Users();
									$objUsers->set_id($objUsers->CleanData($_POST["data_id"]));

									if (!empty($_POST["userPassword"])) {
										$this->userpassword = $objUsers->CleanData($_POST["userPassword"]);
										$objUsers->set_userPassword($objUsers->CleanData(password_hash($this->userpassword, PASSWORD_DEFAULT)));
									}
									elseif (empty($_POST["userPassword"])) {
										$objUsers->set_userPassword($objUsers->get_password());
									}
									
									$objUsers->set_status($objUsers->CleanData($_POST["accStatus_log"]));
									$objUsers->set_passwordReset($objUsers->CleanData($_POST["accPasswdReset_log"]));
									$objUsers->set_groupId($objUsers->CleanData($_POST["groupId"]));
									if ($objUsers->update()) {
											echo "success";

										}
										else{
											echo "error";
										}

								
						break;
						// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
								  $objUsers = new Users();    
							      $objUsers->set_id($objUsers->CleanData($_POST["data_id"]));
							      $objUsers->set_recordHide("YES");
							      $users_details = $objUsers->delete();
							      return true;
							 }else{die();}
						break;
						// for update modal
						case 'updateModal':
							if(isset($_POST["data_id"])){
									  $objUsers = new Users();    
								      $objUsers->set_id($objUsers->CleanData($_POST["data_id"]));
								      $userdetails = $objUsers->get_user();
								      echo $userdetails;  
								 }else{die();}
						break;
						case 'get_group_name':
							if(isset($_POST["data_id"])){
									  $objGroups = new Groups();    
								      $objGroups->set_id($objGroups->CleanData($_POST["data_id"]));
								      $groupname = $objGroups->get_groupName_by_id();
								      print_r($groupname);  
								 }else{die();}

						break;
						case 'get_all_members':
									  $objUsers = new Users();    
								      $allmembers = $objUsers->get_all_members();
								      print_r($allmembers);  
						break;
						case 'get_group_members':
									  $objUsers = new Users();
									  $objUsers->set_groupId($objUsers->CleanData($_SESSION['group_id']));    
								      $allmembers = $objUsers->get_group_members();
								      print_r($allmembers);  
						break;
						case 'get_username':
									  $objUsers = new Users();
									  $objUsers->set_id($objUsers->CleanData($_POST['user_id']));    
								      $username = $objUsers->get_username_byId();
								      print_r($username);  
							break;
						default:
							echo "There was a problem";
							break;
					
				}
			}
		}
	$objUsersControl = new UsersControl();
 ?>