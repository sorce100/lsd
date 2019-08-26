<?php 
      include("header.php");
      require_once("Classes/Users.php");
      require_once("Classes/Members.php");
      require_once("Classes/Groups.php");
      require_once("Classes/SessionLogs.php");
?>
<br>
<div class="row">
  <!-- first part of div -->
  <div class="col-md-12 ">
    <div class="panel panelTabs" >
      <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#memberAcc">Member Accounts <i class="fa fa-users"></i></a></li>
        <li><a data-toggle="tab" href="#applicantAcc">Applicants Accounts <i class="fa fa-users"></i>
          <span class="badge badge-danger">
              <?php 
                $objUsers = new Users();
                echo $objUsers->count_new_stage('student');
             ?>
          </span>
        </a></li> 
        <li><a data-toggle="tab" href="#sessionLogs">Session Logs <i class="fa fa-cog"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<div class="row">
  <!-- second part of div -->
  <div class="col-md-12 ">
      <div class="tab-content">
        <!-- first section -->
        <div id="memberAcc" class="tab-pane fade in active">
          <!--  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <div class="panel-title pull-left">MEMBER ACCOUNTS </div>
                    <div class="panel-title pull-right">
                       <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD USER</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <!-- for search -->
                    <div class="col-md-12">
                        <div class="input-group">
                          <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="membersearchInput" autocomplete="off">
                          <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                        </div>
                    </div>
                    <!-- content -->
                    <div class="col-md-12">
                      <!--  -->
                        <div class="table-responsive"><br>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>USERNAME</th>
                                        <th>ACCOUNT STATUS</th>
                                        <th>SESSION STATUS</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="memberresultsDisplay">
                                    <?php
                                      $objUsers = new Users();
                                      $users = $objUsers->get_member_users(); 
                                      foreach ($users as $user) {
                                              echo "
                                                  <tr>
                                                    <td>".$user["member_id"]."</td>
                                                    <td>".$user["status"]."</td>
                                                    <td>".$user["user_login_status"]."</td>
                                                    <td>
                                                      <button type='button' id='".trim($user["user_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                                    </td>
                                                    <td>
                                                      <button type='button' id='".trim($user["user_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
                                                    </td>
                                                  </tr>
                                                ";
                                          }
                                     ?>
                                </tbody>
                            </table>
                      <!--  -->
                    </div>
                    <!-- end of content -->
                </div>
            </div>
            <!--  -->
          </div>
        </div>
        <!-- first section -->
        <!-- second section -->
        <div id="applicantAcc" class="tab-pane fade">
          <!--  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <div class="panel-title pull-left">APPLICANTS ACCOUNTS</div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <!-- for search -->
                    <div class="col-md-12">
                        <div class="input-group">
                          <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="studentsearchInput" autocomplete="off">
                          <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                        </div>
                    </div>
                    <!-- content -->
                    <div class="col-md-12">
                      <!--  -->
                        <div class="table-responsive"><br>
                          <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>USERNAME</th>
                                        <th>ACCOUNT STATUS</th>
                                        <th>ACCOUNT LEVEL</th>
                                        <th>SESSION STATUS</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="studentresultsDisplay">
                                    <?php
                                      $objUsers = new Users();
                                      $users = $objUsers->get_student_users(); 
                                      foreach ($users as $user) {
                                              echo "
                                                  <tr>
                                                    <td>".$user["member_id"]."</td>
                                                    <td>".$user["status"]."</td>
                                                    <td>".$user["account_stage"]."</td>
                                                    <td>".$user["user_login_status"]."</td>
                                                    <td>
                                                      <button type='button' id='".trim($user["user_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                                    </td>
                                                    <td>
                                                      <button type='button' id='".trim($user["user_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
                                                    </td>
                                                  </tr>
                                                ";
                                          }
                                     ?>
                                </tbody>
                            </table>
                          </div>
                      <!--  -->
                    </div>
                    <!-- end of content -->
                </div>
            </div>
            <!--  -->
          </div>
          <!-- second section -->
        <!-- last section -->
        <div id="sessionLogs" class="tab-pane fade">
          <!--  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <div class="panel-title pull-left">SESSION LOGS</div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <!-- for search -->
                    <div class="col-md-12">
                        <div class="input-group">
                          <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="sessionLogsInput" autocomplete="off">
                          <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                        </div>
                    </div>
                    <!-- content -->
                    <div class="col-md-12">
                      <div class="table-responsive"><br>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>USER ACCOUNT</th>
                                        <th>SESSION START</th>
                                        <th>SESSION END</th>
                                    </tr>
                                </thead>
                                <tbody id="sessionLogsresultsDisplay">
                                    <?php
                                      // for username
                                      $objusers = new Users;
                                      $objSessionLogs = new SessionLogs;
                                      $sessions = $objSessionLogs->get_session(); 
                                      foreach ($sessions as $session) {
                                        echo "
                                            <tr >
                                              <td>".$objusers->get_userName($session["user_id"])."</td>
                                              <td>".$session["session_start"]."</td>
                                              <td>".$session["session_end"]."</td>
                                            </tr>
                                            ";
                                                    
                                      }
                                     ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end of content -->
                </div>
            </div>
            <!--  -->
        </div>
        <!-- last section -->
    </div>
  </div>
</div>


<!-- for modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; </span></button>
        <h4 class="modal-title" id="subject">Add User</h4>
      </div>
      <div class="modal-body" id="bg">
          <form id="users_form">
            <div class="row">
                <div class="col-md-12">
                  <div class="row">
                        <div class="col-md-2">
                            <label for="title" class="col-form-label">Select Account <span class="asterick">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                               <select class="form-control" name="accountType" id="accountType" required>
                                  <option id="member">member</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- 1 -->
                    <div class="row memberIdDiv">
                        <div class="col-md-2">
                            <label for="title" class="col-form-label">Select Member <span class="asterick">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                               <select class="form-control memberIDSelect2" style="width: 100%;" name="memberId" id="memberId" required>
                                  <option selected disabled>Select Member</option>
                                   <?php 
                                      $objMembers = new Members;
                                      $members = $objMembers->get_members(); 
                                      foreach ($members as $member) {
                                        if (empty($member['user_id'])) {
                                          echo '<option value='.$member["professional_number"].'|'.$member["members_id"].'|'.$member["personal_contact"].'|'.$member["first_name"].'_'.$member["last_name"].'>('.$member["professional_number"].') - '.$member["first_name"].' '.$member["last_name"] .'</option>';
                                        }
                                      }
                                  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- 2 -->
                    <div class="row">
                        <div class="col-md-2">
                            <label for="title" class="col-form-label">Username <span class="asterick">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                               <input type="text" name="userName" id="userName" value="" class="form-control" readonly required>
                            </div>
                        </div>
                    </div>
                    <!-- 3 -->
                    <div class="row">
                        <div class="col-md-2">
                            <label for="title" class="col-form-label">Password <span class="asterick">*</span></label>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                               <input type="Password" name="userPassword" id="userPassword" class="form-control" title="Must be 4 characters or more and contain at least 1 lower case letter" required="true">
                               <!-- <input type="Password" name="userPassword" id="userPassword" class="form-control" placeholder="User Account Password" pattern="(?=.*[a-z]).{4}" title="Must be 4 characters or more and contain at least 1 lower case letter" required> -->
                            </div>
                        </div>
                        <!-- for password reset -->
                        <div class="col-md-3">
                          <input type="checkbox" id="accPasswdReset" data-width="150"/>
                          <input type="hidden" name="accPasswdReset_log" id="accPasswdReset_log" value="reset" />

                        </div>
                    </div>
                    <!-- 4 -->
                    <div class="row">
                      <div class="col-md-2">
                        <label for="title" class="col-form-label">Group <span class="asterick">*</span></label>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                             <select name="groupId" class="form-control" id="groupId" required>
                              <option  disabled selected>Select Group</option>
                              <?php 
                                    $objGroups = new Groups;
                                    $groups = $objGroups->get_groups(); 
                                    foreach ($groups as $group) {
                                        echo '<option value="'.trim($group["group_id"]).'">'.$group["group_name"].'</option>';

                                    }
                               ?>
                              </select>
                        </div>
                      </div>
                    </div>
                    <!-- 5 -->
                    <div class="row">
                      <div class="col-md-2">
                        <label for="title" class="col-form-label">Account Status</label>
                      </div>
                      <div class="col-md-5">
                        <input type="checkbox" id="accStatus" data-width="100"/>
                        <input type="hidden" name="accStatus_log" id="accStatus_log" value="active" />

                      </div>
                    </div>
                    <br>
                     <!-- for insert query -->
                    <input type="hidden" name="mode" id="mode" value="insert">
                    <!-- for data_id -->
                    <input type="hidden" name="data_id" id="data_id" value="">
                   <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                      <button type="submit" class="btn btn-info" id="save_btn">Add User <i class="fa fa-save"></i></button>
                   </div>
                </div>
            </div>
          </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
        $(".memberIDSelect2").select2({
          dropdownParent: $("#myModal")
        });
/////////////////////////////////////////////////////////////////////////////////////////////
        $('#accPasswdReset').bootstrapToggle({
          on: 'Direct Login',
          off: 'Reset Pass',
          onstyle: 'success',
          offstyle: 'danger'
        });
       $('#accPasswdReset').change(function(){
          if($(this).prop('checked')){
           $('#accPasswdReset_log').val('NO');
          }else {
           $('#accPasswdReset_log').val('YES');
          }
       });
       // end of password reset

       // eccount status
      $('#accStatus').bootstrapToggle({
        on: 'ACTIVE',
        off: 'DISABLE',
        onstyle: 'success',
        offstyle: 'danger'
      });

      // triggring the check
      $('#accPasswdReset').bootstrapToggle('on');
      $('#accStatus').bootstrapToggle('on');

       $('#accStatus').change(function(){
        if($(this).prop('checked')){
         $('#accStatus_log').val('ACTIVE');
        }else{
         $('#accStatus_log').val('DISABLE');
        }
       });
  ///////////////////////////////////////////////////////////////////////////////////////////////////  

     // get license number for username
    $("#memberId").change(function(){
       let memberAccDetails = $('option:selected', this).val();
       var detailsSplit = memberAccDetails.split("|");
       // grabbing the username
       $("#userName").val(detailsSplit[0]);
    });    
  ///////////////////////////////////////////////////////////////////////////////////////////////////      
        
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#memberId").hide();
            $("#subject").html("ADD NEW MEMBER");
            $("#users_form")[0].reset();

            $('.memberIdDiv').show();
          });

        // for member search
        $("#membersearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#memberresultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
         // for school search
        $("#sessionLogsInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#sessionLogsresultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
         // for studentsearch
        $("#studentsearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#studentresultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

        // $('#users_form').parsley();
        // $('#users_form').parsley().reset();



        //for inserting 
          $("#users_form").on("submit",function(e){
                e.preventDefault();
                $.ajax({
                url:"Script/users.php",
                method:"POST",
                data:$("#users_form").serialize(),
                beforeSend:function(){  
                    $('#save_btn').text("Please wait ...");  
                 },
                success:function(data){  
                  console.log(data);
                  $("#myModal").modal("hide");
                   $("#users_form")[0].reset();
                   if (data == "success") {
                    location.reload();
                   }
                   else if(data == "error"){
                    
                   }
                } 

                });  
            });

        // for update
        $('.update_data').click(function(){ 
           $("#memberId").hide();
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/users.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                    var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE USER DETAILS");
                    $("#accountType").html('<option value="'+jsonObj[0].account_type+'">'+jsonObj[0].account_type+'</option>').attr('readonly',true);
                    // $('#memberId').html('<option value="'+jsonObj[0].member_id+'">'+jsonObj[0].member_id+'</option>').attr('readonly',true);
                    $('.memberIdDiv').hide();
                    $('#userName').val(jsonObj[0].member_id);
                    $('#groupId').val(jsonObj[0].group_id);
                    $("#status").val(jsonObj[0].status);
                    $("#userPassword").prop("required",false);
                    ////////////////////////////////////////////////////////////////////////////////////////////
                    // disable account password reset
                    if(jsonObj[0].reset_password == "OFF"){
                      $('#accPasswdReset').prop('checked', false).change();
                    }
                    ///////////////////////////////////////////////////////////////////////////////////////////
                    // if account status is off
                    if(jsonObj[0].status == "DISABLE"){
                      $('#accStatus').prop('checked', false).change();
                    }
                    //////////////////////////////////////////////////////////////////////////////////////////
                    $("#save_btn").text("update User");
                    $("#mode").val("update");
                    $("#data_id").val(data_id);
                    $("#myModal").modal("show");
                }  
               });  
          });


// for delete
        $('.del_data').click(function(){
           if (confirm("ARE YOU SURE YOU WANT TO DELETE USER?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/users.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                        location.reload();
                      }  
                     }); 

               }else{
                return false;
              }  
          });

          })  
 </script>