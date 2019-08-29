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

    <link href="plugins/bower_components/parsley/parsley.css" rel="stylesheet">
    <link href="plugins/bower_components/toastr/toastr.min.css" rel="stylesheet">

    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="pages/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body >
    <div class="row top_row">
        <div class="col-md-1 col-sm-3 col-xs-3">
          <a href="index.php"><img src="plugins/images/logo.jpg" class="img" width="100%" height="100%"></a>
        </div>
        <div class="col-md-9 col-sm-6 col-xs-6">
            <div id="headerTitle">Ghana Institution Of Surveyors ( LSD )</div>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-3 logSignBtn">
          <button data-toggle="modal" data-target="#signInModal" class="btn btn-primary logSignBtnB1"><b>Login <i class="glyphicon glyphicon-user"></i></b></button>
          <button style="border: 1px solid red;" data-toggle="modal" data-target="#signUpModal" class="btn btn-default"><b>Register <i class="glyphicon glyphicon-hourglass"></i></b></button>
        </div>
    </div><br>
    <!-- signup page -->
    <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" id="bg">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
            <h4 class="modal-title">APPLICANT SIGN UP</h4>
          </div>
          <div class="modal-body" id="bg">
          <form id="signUp_form" data-parsley-validate>
            <!--  -->
            <div class="row">
                <div class="col-md-2">
                    <label for="title" class="col-form-label">Name <span class="asterick">*</span></label>
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
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
                <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" id="studentFirstName" minlength="3" placeholder="Enter first name &hellip;" name="studentFirstName" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" id="studentLastName" minlength="3" placeholder="Enter last name &hellip;" name="studentLastName" autocomplete="off" required>
                    </div>
                </div>
            </div>

            <br>
            <!--  -->
            <div class="row">
                <div class="col-md-2">
                    <label for="title" class="col-form-label">Email <span class="asterick">*</span></label>
                </div> 
                <div class="col-md-10">
                    <div class="form-group">
                      <input type="email" class="form-control" id="studentEmail" placeholder="Enter email address eg: abc@domain.com &hellip;" name="studentEmail" autocomplete="off" required>
                    </div>
                </div>
            </div>

            <br>
            <!--  -->
            <div class="row">
                <div class="col-md-2">
                    <label for="title" class="col-form-label">Tel No <span class="asterick">*</span></label>
                </div> 
                <div class="col-md-10">
                    <div class="form-group">
                      <input type="number" class="form-control" minlength="10" id="studentTel" placeholder="Enter phone number eg: 020 xxxx xxx &hellip;" name="studentTel" autocomplete="off" required>
                    </div>
                </div>
            </div>

            <br>
            <!--  -->
            <div class="row">
                <div class="col-md-2">
                    <label for="title" class="col-form-label">Division <span class="asterick">*</span></label>
                </div> 
                <div class="col-md-10">
                    <div class="form-group">
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
            </div> 

            <br>
            <br>
             <!-- ////////////////////////  --> 
            <div class="row">
              <div class="col-md-6">
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-block btn-danger" id="cancel" name="cancel" > Close <i class="glyphicon glyphicon-remove"></i></button>
              </div>
               <!-- for insert query -->
              <input type="hidden" name="mode" id="signUpmode" value="insert">
              <div class="col-md-6">
                <button type="submit" class="btn btn-block btn-primary" id="signUp" name="signUp">Submit <i class="glyphicon glyphicon-floppy-disk"></i></button>
              </div>
            </div>

            <br>

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
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">Sign In</b></h4>
      </div>
      <div class="modal-body" id="bg">
        <form id="sigin_Form" method="POST" > 
           <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                     <!-- <form class="form-auth-small" id="insert_form" method="POST"> -->
                        <div class="form-group input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <label for="signin-username" class="control-label sr-only">Username</label>
                          <input type="text" class="form-control" id="professional_number" name="professional_number" minlength="2" placeholder="Enter Username &hellip;" autofocus required autocomplete="off">
                        </div>
                        <br>
                        <div class="form-group input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <label for="signin-password" class="control-label sr-only">Password</label>
                          <input type="password" class="form-control" id="userPassword" name="userPassword" minlength="3" placeholder="Enter Password &hellip;" required data-parsley-length="[4,10]">
                        </div>
                        <br>
                        <input type="hidden" name="mode" id="signInmode" value="login">
                        <button type="submit" name="submit" id="login" class="btn btn-primary btn-block waves-effect waves-light">LOGIN <i class="glyphicon glyphicon-log-in"></i></button> 
                        <br>
                  <!-- </form> -->
                </div>
              </div>
           </div>   
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- reset password -->
<!-- for password change -->
<div class="modal fade" id="passChModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
  <div class="modal-dialog modal">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">RESET PASSWORD</b></h4>
      </div>
      <div class="modal-body" id="bg">
        <form id="changePass_form" method="POST" data-parsley-validate> 
          <input type="hidden" id="chPassUserName" name="chPassUserName">
          <input type="hidden" id="chPassUserPassword" name="chPassUserPassword">
           <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                     <form class="form-auth-small" id="insert_form" method="POST">
                        <div class="form-group input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <label for="signin-password" class="control-label sr-only">Password</label>
                          <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter Password &hellip;" minlength="4" required>
                        </div>
                        <br>
                        <div class="form-group input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <label for="signin-password" class="control-label sr-only">Password</label>
                          <input type="password" class="form-control" id="newRetypePassword" name="newRetypePassword" placeholder="Retype Password &hellip;" minlength="4" required>

                        </div>
                        <br>
                        <input type="hidden" name="mode" value="changePass">
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="glyphicon glyphicon-remove"></i></button>
                          <button type="submit" class="btn btn-primary" id="resetPass_btn">Reset Password <i class="glyphicon glyphicon-floppy-disk"></i></button>
                       </div>
                  </form>
                </div>
              </div>
           </div>   
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--  -->
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script type="pages/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/bower_components/parsley/parsley.min.js"></script>
<script src="plugins/bower_components/toastr/toastr.min.js"></script>
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
                    console.log(data);
                     if (data == "success") {
                      toastr.success('Login Successfully');
                      window.location.replace("pages/dashboard.php");
                     }
                     else if(data == "error"){
                      toastr.error('There was an error');
                      $('#sigin_Form')[0].reset();
                      $('#signInModal').modal('hide');
                     }
                     else if ((data !="success") || (data !="error")) {
                      var fields = data.split('-');
                      var username = fields[0];
                      var passwd = fields[1];

                      $('#chPassUserName').val(username);
                      $('#chPassUserPassword').val(passwd);
                      $('#signInModal').modal('hide');
                      $('#passChModal').modal('show');
                      $('#professional_number').val("");
                      $('#userPassword').val("");
                      $('#login').text("LOGIN").prop('disabled',false);

                     }
                } 

                });  
            });
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
// Change password 
$("#changePass_form").on("submit",function(e){
    e.preventDefault();
    $.ajax({
    url:"pages/Script/users.php",
    method:"POST",
    data:$("#changePass_form").serialize(),
    beforeSend:function(){ 
      $('#resetPass_btn').text("Loading ...").prop("disabled",true); 
          
    },
    success:function(data){ 
    // console.log(data); 
       if (data == "success") {
           toastr.success('Successfully');
          $("#passChModal").modal("hide");
       }
       else if(data == "error"){
       toastr.error('There was an error');
        $('#newPassword').val("");
        $('#newRetypePassword').val("");
        $('#resetPass_btn').text("Reset Password").prop("disabled",false);

       }
    } 

    });  
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

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

          if (data == "success") {toastr.success('Successfully'); alert("Thank you for registering, your username and password will be sent to you shortly");} 
          else if(data == "error") {toastr.error('There was an error'); alert("Sorry, there was an error saving your profile please try again");}
          else if(data == "email_exits") {toastr.error('There was an error'); alert("Sorry, Email ID already exits");}
               
        } 

        });  
    });
});

</script>


