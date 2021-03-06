<?php include_once("Classes/Check.php");
      $objCheck = new Check;
      require_once("Classes/UserBalance.php");
      require_once("Classes/Users.php");
      $objUsers = new Users;
      
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ferdinand Kwarteng">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/logo.jpg">
    <title>GhIS LSD</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- for datetime picker -->
    <link rel="stylesheet" type="text/css" href="../plugins/bower_components\datepicker\datepicker.css">
    <!-- select 2 include -->
    <link rel="stylesheet" type="text/css" href="../plugins/bower_components\select2\select2.min.css">
    <!-- parsley -->
    <link rel="stylesheet" type="text/css" href="../plugins/bower_components\parsley\parsley.css">
    <!-- toastr -->
    <link href="../plugins/bower_components/toastr/toastr.min.css" rel="stylesheet">
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="css/datatables.css">
    <!-- fot button toggle -->
    <link rel="stylesheet" type="text/css" href="../plugins/bower_components\bootstrap-toggle\bootstrap-toggle.min.css">
    
    <!-- javascript -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../plugins/bower_components/ckeditor/ckeditor.js"></script>
    

</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <img src="../plugins/images/logo.jpg" alt="home" width="60px" height="60px" />
                    <span style="font-size: 20px;"><b>GhIS LSD</b></span>
                    
                </div>
                <!-- Name -->
                <ul class="nav navbar-top-links navbar-left pull-left">
                  <br>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" aria-expanded="false" style="color:white;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </ul>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <?php
                             // check if member account then show balance remainder 
                            if ($_SESSION['account_type'] ==  'member') {
                                $objUserBalance = new UserBalance;
                                $getBalance = $objUserBalance->get_balance();
                                echo "<a>CURRENT BALANCE (₵) :<b>".trim($getBalance["current_balance"])."</b></a>";
                            }
                         ?>
                    </li>

                    <li class="dropdown">
                        <a class="profile-pic dropdown-toggle" data-toggle="dropdown" href="#"> <img src="../plugins/images/avatar.png" alt="user-img" width="36" class="img-circle"><?php echo strtoupper($objUsers->get_header_fullname($_SESSION["member_id"])); ?> <i class="fa fa-chevron-circle-down"></i> </a>

                        <ul class="dropdown-menu">
                            <!-- <li><a href="../../"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li> -->
                            <li><a href="#" data-toggle="modal" data-target="#changePassModal" ><i  class="fa fa-exchange"></i> <span> CHANGE PASSWORD</span></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="Script/log_out.php"><i class="fa fa-power-off fa-fw" style="color: red;" aria-hidden="true"> </i> LOGOUT</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar  -->
        <!-- ============================================================== -->
        <div id="navbar">
            <div class="col-md-2">
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav slimscrollsidebar ">
                        <ul class="nav" id="side-menu">
                            <li style="padding: 70px 0 0;"><a href="dashboard.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Dashboard</a></li> 
                            
                            <!-- not added to pages -->
                            <!-- <li><a href="admin_advertisement.php" class="waves-effect"><i class="fa fa-bullhorn fa-fw" aria-hidden="true"></i>Advert Company </a></li>
                            <li><a href="advert_setup.php" class="waves-effect"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>Advert SetUp </a></li>  -->
                            
                            
                            <!-- end of not added to pages -->
                            <?php 
                            // getting the group id from session then getting the pages id from the database
                                require_once("Classes/Groups.php");
                                $objGroups = new Groups;
                                $pages_id = $objGroups->menu_pages_id($_SESSION['group_id']);

                                if (!empty($pages_id)) {
                                    // passing the pages id to  get the pages url
                                     require_once("Classes/Pages.php");
                                      $objPages = new Pages;
                                        foreach ($pages_id as $page_id) {
                                             $objPages->get_menu_pages($page_id);
                                        }
                                }
                                    
                                ?>
                        </ul>
                        <div class="center p-20">
                             <a href="Script/log_out.php" class="btn btn-danger btn-block waves-effect waves-light"> <i class="fa fa-power-off fa-fw" aria-hidden="true"> </i>LOGOUT</a>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <style type="text/css">
          #insert_form fieldset:not(:first-of-type) {
            display: none;
            }
        </style>
        <div id="page-wrapper">
            <div class="container-fluid"><br>
               
                <!-- /row -->
        <?php 
            function get_times( $default = '8:00', $interval = '+30 minutes' ) {

                $output = '';

                $current = strtotime( '00:00' );
                $end = strtotime( '23:59' );

                while( $current <= $end ) {
                    $time = date( 'H:i', $current );
                    $sel = ( $time == $default ) ? ' selected' : '';

                    $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h : i A', $current ) .'</option>';
                    $current = strtotime( $interval, $current );
                }

                return $output;
            }
        ?>

<!-- modal for changing password -->
     <div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header" id="bg">
                 <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
                <h4 class="modal-title"><b id="subject">Change Password</b></h4>
              </div>
              <div class="modal-body" id="bg">
                <form id="change_password_form" method="POST"> 
                    <!--  -->
                  <div class="row">
                    <div class="col-md-4"><label>New Password <span class="asterick"> *</span></label></div>
                    <div class="col-md-8">
                      <input type="password" class="form-control" id="newPasswd" name="newPasswd" minlength="4" autocomplete="off" placeholder="Enter New Password &hellip;" required>
                    </div>
                  </div>

                  <br>
                  <!--  -->
                  <div class="row">
                    <div class="col-md-4"><label>Retype Password <span class="asterick"> *</span></label></div>
                    <div class="col-md-8">
                      <input type="password" class="form-control" id="retypeNewPasswd" name="retypeNewPasswd" minlength="4" autocomplete="off" placeholder="Retype Password &hellip;" required>
                    </div>
                  </div>

                    <br>
                    <input type="hidden" name="mode" value="userChangePassword">

                    <div class=" modal-footer" id="bg">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                      <button type="submit" class="btn btn-info" id="changePass_btn">Change Password <i class="fa fa-exchange"></i></button>
                    </div>        
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    <script>
        $(document).ready(function(){
            $('#change_password_form').parsley();
            // for reset modal when close
            $('#changePassModal').on('hidden.bs.modal', function () {
                $('#change_password_form').parsley().reset();
                $("#change_password_form")[0].reset();

                $('#changePass_btn').text("Change Password").prop('disabled',false);  
            });

            // changing password
            $("#change_password_form").on("submit",function(e){
                e.preventDefault();
                $.ajax({
                url:"Script/users.php",
                method:"POST",
                data:$("#change_password_form").serialize(),
                beforeSend:function(){  
                    $('#changePass_btn').text("Please wait ...").prop('disabled',true);  
                 },
                success:function(data){  
                  // console.log(data);
                  $("#changePassModal").modal("hide");
                   $("#change_password_form")[0].reset();
                   if (data == "success") {
                    toastr.success('Password Changed Successfully');
                    // $.ajax({
                    //     url:"Script/log_out.php",
                    // });
                   window.location.href = "Script/log_out.php";
                   }
                   else if(data == "error"){
                    toastr.error('Sorry, There was a problem changing your password!');
                   }
                } 

                });  
            });



        });
    </script>