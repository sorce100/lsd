<?php 
  require_once("pages/Classes/Events.php");
  require_once("pages/Classes/Division.php");
  require_once("pages/Classes/ExamCenterSetup.php");
  // header("Location: {$_SERVER['HTTP_REFERER']}"); 
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GhIS | HOME</title>
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/logo.jpg">
    <!-- Bootstrap -->
    <link href="pages/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
  </head>
  <body >
    <div class="row top_row">
        <div class="col-md-1 col-sm-3 col-xs-3">
          <a href="index.php"><img src="plugins/images/logo.jpg" class="img-responsive img-circle" width="100" height="100"></a>
        </div>
        <div class="col-md-9 col-sm-6 col-xs-6">
            <div id="headerTitle"><a href="index.php">Ghana Institution Of Surveyors ( LSD )</a></div>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-3 logSignBtn">
          <span><a data-toggle="modal" data-target="#signInModal" class="btn btn-primary"><b>Login <i class="glyphicon glyphicon-user"></i></b></a></span>
          <span><a style="border: 1px solid red;" data-toggle="modal" data-target="#signUpModal" class="btn btn-default"><b>Register <i class="glyphicon glyphicon-hourglass"></i></b></a></span>
        </div>
    </div><br>
    <!-- signup page -->
    <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" id="bg">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
            <h4 class="modal-title">TRAINEE SIGN UP</h4>
          </div>
          <div class="modal-body" id="bg">
          <form id="signUp_form"> 
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="studentTitle">TITLE</label>
                    <select class="form-control" name="studentTitle" id="studentTitle" required>
                      <option  disabled selected>Select title</option>
                      <option value="Mr">Mr</option>
                      <option value="Mrs">Mrs</option>
                      <option value="Miss">Miss</option>
                      <option value="Dr">Dr</option>
                      <option value="Prof">Prof</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="studentFirstName">FIRST NAME</label>
                    <input type="text" class="form-control" id="studentFirstName" placeholder="Enter first name &hellip;" name="studentFirstName" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="studentLastName">LAST NAME</label>
                    <input type="text" class="form-control" id="studentLastName" placeholder="Enter last name &hellip;" name="studentLastName" autocomplete="off" required>
                  </div>
                </div>
              </div><br><br>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="studentEmail">EMAIL ADDRESS</label>
                    <input type="email" class="form-control" id="studentEmail" placeholder="Enter email address eg: abc@domain.com &hellip;" name="studentEmail" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="studentTel">TEL NUMBER</label>
                    <input type="number" class="form-control" id="studentTel" placeholder="Enter phone number eg: 020 xxxx xxx &hellip;" name="studentTel" autocomplete="off" required>
                  </div>
                </div>
              </div><br><br>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="schoolId">SELECT DIVISON</label>
                    <select class="form-control" name="division" id="division" required>
                      <option  disabled selected>Select Division</option>
                      <?php 
                          $objDivision = new Division;
                          $divisions = $objDivision->get_divison_alias();
                          foreach ($divisions as $division) {
                            echo '<option value="'.$division["division_id"].'">'.$division["division_alias"].'</option>';
                          }
                       ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="examCenter">SELECT EXAM CENTER</label>
                    <select class="form-control" name="examCenter" id="examCenter" required>
                      <option  disabled selected>Select</option>
                       <?php 
                          $objExamCenterSetup = new ExamCenterSetup;
                          $centers = $objExamCenterSetup->get_centers();
                          foreach ($centers as $center) {
                            echo '<option value="'.$center["exam_center_id"].'">'.$center["exam_center_name"].'</option>';
                          }
                       ?>
                    </select>
                  </div>
                </div>
              </div><br> <br> 
              <div class="row">
                <div class="col-md-6">
                  <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-block btn-danger" id="cancel" name="cancel" > Close <i class="glyphicon glyphicon-remove"></i></button>
                </div>
                 <!-- for insert query -->
                <input type="hidden" name="mode" id="signUpmode" value="insert">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-block btn-primary" id="signUp" name="signUp">Save <i class="glyphicon glyphicon-floppy-disk"></i></button>
                </div>
              </div><br>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- sign in modal -->
<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
  <div class="modal-dialog modal">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">User Sign In</b></h4>
      </div>
      <div class="modal-body" id="bg">
        <form id="sigin_Form" method="POST"> 
           <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                     <form class="form-auth-small" id="insert_form" method="POST">
                        <div class="form-group input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <label for="signin-username" class="control-label sr-only">Username</label>
                          <input type="text" class="form-control" id="professional_number" name="professional_number" placeholder="Enter Username &hellip;" autofocus required autocomplete="off">
                        </div>
                        <br>
                        <div class="form-group input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <label for="signin-password" class="control-label sr-only">Password</label>
                          <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Enter Password &hellip;" required data-parsley-length="[4,10]">
                        </div>
                        <br>
                        <input type="hidden" name="mode" id="signInmode" value="login">
                        <button type="submit" name="submit" id="login" class="btn btn-lg btn-primary btn-block waves-effect waves-light">LOGIN <i class="glyphicon glyphicon-remove"></i></button> 
                        <br>
                  </form>
                </div>
              </div>
           </div>   
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="pages/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
  $(document).ready(function(){
    $("#sigin_Form").on("submit",function(e){
          e.preventDefault();
                $.ajax({
                url:"pages/Script/users.php",
                method:"POST",
                data:$("#sigin_Form").serialize(),
                beforeSend:function(){  
                          $('#login').text("Loading ...").prop('disabled',true);  
                     },
                success:function(data){  
                    // alert(data);
                     if (data == "success") {
                      window.location.replace("pages/dashboard.php");
                     }
                     else if(data == "error"){
                      location.reload();
                     }
                     else if (data=="reset") {
                       window.location.replace("reset_password.php");
                     }
                } 

                });  
            });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

     // for reset modal when close
      $('#signUpModal').on('hidden.bs.modal', function () {
          $("#signUp_form")[0].reset();
          $('#signUp').text("Sign Up").attr('disabled',false);
        });

    // save student register details
  $("#signUp_form").on("submit",function(e){
        e.preventDefault();
        var mode = "insert";
        $.ajax({
        url:"pages/Script/student.php",
        method:"POST",
        data:$("#signUp_form").serialize(),
        beforeSend:function(){  
                  $('#signUp').text("Please wait ...").attr('disabled',true);  
             },
        success:function(data){
                $("#signUp_form")[0].reset();
                $("#signUpModal").modal("hide");

                if (data == "success") {alert("Thank you for registering, your username and password will be sent to you shortly");} 
                else if(data == "error") { alert("Sorry, there was an error saving your profile please try again");}
                else if(data == "email_exits") {alert("Sorry, Email ID already exits");}
               
        } 

        });  
    });
});

</script>