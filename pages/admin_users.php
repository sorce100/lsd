<?php 
      include("header.php");
      require_once("Classes/Users.php");
      require_once("Classes/Members.php");
      require_once("Classes/Groups.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">USERS SETUP</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
              
              <!-- for add button -->
              <div class="col-md-12">
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-plus"></span> ADD USER</button>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                  <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#members"><b>MEMBERS</b></a></li>
                    <li><a data-toggle="tab" href="#students"><b>STUDENTS <span class="badge badge-danger">
                        <?php 
                          $objUsers = new Users();
                          echo $objUsers->count_new_stage('student');
                       ?>
                    </span></b></a></li>
                  </ul>

                  <div class="tab-content">
                    <div id="members" class="tab-pane fade in active">
                      <h3>GhIS Members Accounts</h3>
                      <br>
                        <!-- for search -->
                        <div class="col-md-12">
                          <form action="usersearch.php" method="POST">
                            <div class="input-group">
                              <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="membersearchInput" autocomplete="off">
                              <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                            </div>
                           </form>
                        </div>
                      <br>
                      <div class="col-md-12">
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
                                                      <input type='button' name='view' value='Update' id='".trim($user["user_id"])."' class='btn btn-info btn-xs update_data' />
                                                    </td>
                                                    <td>
                                                      <input type='button' name='view' value='Delete' id='".trim($user["user_id"])."' class='btn btn-danger btn-xs del_data' />
                                                    </td>
                                                  </tr>
                                                ";
                                          }
                                     ?>
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                    
                    
                    <div id="students" class="tab-pane fade">
                      <h3>Students Accounts</h3>
                      <br>
                      <!-- for search -->
                        <div class="col-md-12">
                          <form action="usersearch.php" method="POST">
                            <div class="input-group">
                              <input type="text" name="search" class="form-control" placeholder="student Search &hellip;" id="studentsearchInput" autocomplete="off">
                              <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                            </div>
                           </form>
                        </div>
                      <br>
                      <div class="col-md-12">
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
                                                      <input type='button' name='view' value='Update' id='".trim($user["user_id"])."' class='btn btn-info btn-xs update_data' />
                                                    </td>
                                                    <td>
                                                      <input type='button' name='view' value='Delete' id='".trim($user["user_id"])."' class='btn btn-danger btn-xs del_data' />
                                                    </td>
                                                  </tr>
                                                ";
                                          }
                                     ?>
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADD NEW MEMBER</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST">
              <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">SELECT ACCOUNT TYPE</label>
                        <select class="form-control" name="accountType" id="accountType" required>
                          <option value="member">Member</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                        <label for="title">SELECT ACCOUNT ID</label>
                        <select class="form-control memberIDSelect2" style="width: 100%;" name="memberId" id="memberId" required>
                        <option selected disabled>Select Member</option>
                         <?php 
                            $objMembers = new Members;
                            $members = $objMembers->get_members(); 
                            foreach ($members as $member) {
                                echo '<option value='.$member["professional_number"].'|'.$member["members_id"].'|'.$member["personal_contact"].'|'.$member["first_name"].'_'.$member["last_name"].'>('.$member["professional_number"].') - '.$member["first_name"].' '.$member["last_name"] .'</option>';

                            }
                        ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                       <label for="userPassword">ENTER PASSWORD</label>
                       <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Enter user password">
                     </div>
                  </div>
              </div> 
              <div class="row">
                <div class="col-md-4">
                    <label for="title">SELECT GROUP</label>
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
                  <div class="col-md-4">
                     <label for="title">ACCOUNT STATUS</label>
                    <select name="status" class="form-control" id="status">
                      <option value="ACTIVE">ACTIVE</option>
                      <option value="DISABLE">DISABLE</option>
                    </select>
                  </div>
                  
                  <div class="col-md-4">
                      <br>
                     <div class="custom-control custom-checkbox">
                        <h4><input type="checkbox" class="custom-control-input" id="passwordReset" name="passwordReset" value="YES">
                        <label class="custom-control-label" for="passwordReset"> CHANGE PASSWORD</label></h4>
                    </div>
                  </div>
             </div><br>
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <!-- for data_id -->
            <input type="hidden" name="data_id" id="data_id" value="">
            <div class="well modal-footer" id="bg">

                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD USER" />
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
        
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD NEW MEMBER");
            $("#insert_form")[0].reset();
          })

        // for member search
        $("#membersearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#memberresultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
         // for school search
        $("#schoolsearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#schoolresultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
         // for lecturer search
        $("#lecturersearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#lecturerresultsDisplay tr").filter(function() {
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

        $('#insert_form').parsley();
        $('#insert_form').parsley().reset();

        $(".memberIDSelect2").select2({
          dropdownParent: $("#myModal")
        });

      // check for account type selected and load the necessary list options
      $("#accountType").change(function(){
            var account = $(this).val();
            switch (account){
              case 'member':
                  var mode = "get_members";
                  $.ajax({
                  url:"Script/members.php",
                  method:"POST",
                  data:{mode:mode},
                  beforeSend:function(){  
                        // disable the form select to wait for list
                        $('#memberId').attr('disabled',true);
                        $('#memberId').html('');   
                       },
                  success:function(data){
                        $('#memberId').attr('disabled',false);
                        // display the list now
                        var jsonObj = JSON.parse(data);
                        for (var i = 0; i < jsonObj.length; ++i) {
                          $('#memberId').append('<option value='+jsonObj[i].professional_number+'|'+jsonObj[i].members_id+'|'+jsonObj[i].personal_contact+'|'+jsonObj[i].first_name+'_'+jsonObj[i].last_name+'>('+jsonObj[i].professional_number+') - '+jsonObj[i].first_name+' '+jsonObj[i].last_name +'</option>');
                        }
                        
                  } 

                });  
              break;
              case 'school':
                  var mode = "get_schools";
                  $.ajax({
                  url:"Script/school.php",
                  method:"POST",
                  data:{mode:mode},
                  beforeSend:function(){  
                          $('#memberId').attr('disabled',true);
                       },
                  success:function(data){
                        // empty content before 
                       $('#memberId').attr('disabled',false);
                       $('#memberId').html('');

                       var jsonObj = JSON.parse(data);
                       // do the school abbreviation then  use that as the display select for the schools
                          for (var i = 0; i < jsonObj.length; ++i) {
                          $('#memberId').append('<option value='+jsonObj[i].school_alias+'|'+jsonObj[i].school_id+'|'+jsonObj[i].school_tel+'>'+jsonObj[i].school_alias+'</option>');
                        }
                      } 

                  });  
              break;
              case '':
                  $('#memberId').attr('disabled',true);
                  $('#memberId').find('option').remove();
              break;
             
            }
      });



        //for inserting 
          $("#insert_form").on("submit",function(e){
          e.preventDefault();
                $.ajax({
                url:"Script/users.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                  if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
                      $("#myModal").modal("hide");
                       $("#insert_form")[0].reset();
                       if (data == "success") {
                        window.location.replace("admin_users.php");
                       }
                       else if(data == "error"){
                        
                       }
                  }
                  else{

                    return false;
                  }
                     
                } 

                });  
            });

        // for update
        $('.update_data').click(function(){ 
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
                    $('#memberId').html('<option value="'+jsonObj[0].member_id+'">'+jsonObj[0].member_id+'</option>').attr('readonly',true);
                    $('#groupId').val(jsonObj[0].group_id);
                    $("#status").val(jsonObj[0].status);
                    $("#userName").val(jsonObj[0].user_name);
                    $("#save_btn").val("UPDATE USER");
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
                          window.location.replace("admin_users.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });

          })  
 </script>