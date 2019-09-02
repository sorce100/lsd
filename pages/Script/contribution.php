<?php
	require_once("../Classes/Contribution.php"); 
	require_once("../Classes/UserBalance.php");
	require_once("../Classes/WalletHistory.php"); 
	session_start();
	class ContributionControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objContribution = new Contribution;
							$objContribution->set_contributionName($objContribution->CleanData(strtoupper($_POST["contributionName"])));
							$objContribution->set_contributionDue($objContribution->CleanData(strtoupper($_POST["contributionDue"])));
							if ($objContribution->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objContribution = new Contribution;
							$objContribution->set_contributionName($objContribution->CleanData(strtoupper($_POST["contributionName"])));
							$objContribution->set_contributionDue($objContribution->CleanData(strtoupper($_POST["contributionDue"])));
							$objContribution->set_id($objContribution->CleanData($_POST["data_id"]));
							if ($objContribution->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objContribution = new Contribution;
								      $objContribution->set_id($objContribution->CleanData($_POST["data_id"]));
								      if ($objContribution->delete()) {
								      	return true;
								      }
								      else{
								      	return false;
								      }
								     
								 }else{die();}
						break;
						// geting details of a member with id
						case 'updateModal':
							if(isset($_POST["data_id"])){
									 $objContribution = new Contribution;  
								      $objContribution->set_id($objContribution->CleanData($_POST["data_id"]));
								      $contribution_details = $objContribution->get_contribution_by_id();
								      print_r($contribution_details);  
								 }else{die();}
						break;
						// when member make contribution
						case 'contributionPay':
							if(isset($_POST["contributionAmount"])){
									// checking balance if there is enough to make payment
									 $objUserBalance = new UserBalance;
									 $getBalance = $objUserBalance->get_balance();
									 if (trim($getBalance["current_balance"]) > trim($_POST["contributionAmount"])) {
									 		// if there is enough balance then set the properties of the class
									 		$objUserBalance->set_reason($objUserBalance->CleanData($_POST["contributionName"]));
									 		$objUserBalance->set_type($objUserBalance->CleanData("DEBIT"));
									 		$objUserBalance->set_purpose($objUserBalance->CleanData("CONTRIBUTION"));
									 		$objUserBalance->set_pay_amount($objUserBalance->CleanData($_POST["contributionAmount"]));
									 		$objUserBalance->set_balance(trim($getBalance["current_balance"]) - trim($_POST["contributionAmount"]));
											$objUserBalance->set_member_id($_SESSION['member_id']);
											$objUserBalance->set_paymentContributionId($objUserBalance->CleanData($_POST["contribution_id"]));

									  		if ($objUserBalance->wallet_save()) {
									  			// now send to the contribution register table
									  			 $objContribution = new Contribution;
									  			 $objContribution->set_id($objContribution->CleanData($_POST["contribution_id"]));
									  			 $objContribution->set_payAmount($objContribution->CleanData($_POST["contributionAmount"]));
									  			 $objContribution->set_memberId($_SESSION['member_id']);
									  			 if ($objContribution->contribution_save()) {
									  			 	echo "success";
									  			 }
									  			
									  			// error returned while saving into the wallet history
									  		}else{return false;}
									  	}else{echo "insufficient_Balance";}	
								     
								 }else{die();}
						break;

						// getting the contribution history
						case 'getHistory':
							$objWalletHistory = new WalletHistory;
							$objWalletHistory->set_member_id($_SESSION['member_id']);
							$objWalletHistory->set_purpose(trim("CONTRIBUTION"));
							$historyDetails = $objWalletHistory->get_walletHistory_byId();
							print_r($historyDetails);
							
							break;
						// getting all the contributions made from the contributions table
						case 'view_contributions':
							$objContribution = new Contribution;
							$objContribution->set_id($objContribution->CleanData($_POST["contribution_id"]));
							$contributers_list = $objContribution->get_list_by_contributionId();
							print_r($contributers_list);
							break;

						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objContributionControl = new ContributionControl;
 ?>