<?php
	require_once("../Classes/Pages.php"); 
	session_start();
	class PagesControl{

		function __construct(){
			// print_r($_POST);
					switch (trim($_POST["mode"])) {
						// for insert
						case 'insert':
							$objPages = new Pages;
							$objPages->set_pageName($objPages->CleanData($_POST["pageName"]));
							$objPages->set_pageUrl(trim($_POST["pageUrl"]));
							$objPages->set_pageFileName($objPages->CleanData($_POST["pageFileName"]));
							$objPages->set_division(trim($_POST["pageDivision"]));
							if ($objPages->insert()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for update
						case 'update':
							$objPages = new Pages;
							$objPages->set_pageName($objPages->CleanData($_POST["pageName"]));
							$objPages->set_pageUrl(trim($_POST["pageUrl"]));
							$objPages->set_pageFileName($objPages->CleanData($_POST["pageFileName"]));
							$objPages->set_division(trim($_POST["pageDivision"]));
							$objPages->set_id($objPages->CleanData($_POST["data_id"]));
							if ($objPages->update()) {
									echo "success";
								}
								else{
									echo "error";
								}
						break;
					// for delete
						case 'delete':
							if(isset($_POST["data_id"])){
									 $objPages = new Pages;
								      $objPages->set_id($objPages->CleanData($_POST["data_id"]));
								      if ($objPages->delete()) {
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
									 $objPages = new Pages;  
								      $objPages->set_id($objPages->CleanData($_POST["data_id"]));
								      $pages_details = $objPages->get_pages_by_id();
								      print_r($pages_details);  
								 }else{die();}
						break;
						
						default:
							echo "There was a problem";
							break;
					}

				}
			}

	$objPagesControl = new PagesControl;
 ?>