<?php 
      include("header.php");
      require_once("Classes/Users.php");
      require_once("Classes/Division.php");
      require_once("Classes/Groups.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">DIVISION ADMINISTRATORS SETUP</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
              <!-- for add button -->
              <div class="col-md-2">
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD ADMINS</button>
              </div>
              <br>
              <div class="col-md-12">
                        <div class="table-responsive"><br>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>USERNAME</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody id="memberresultsDisplay">
                                    <?php
                                      $objUsers = new Users();
                                      $users = $objUsers->get_administrators(); 
                                      foreach ($users as $user) {
                                          if ($user["division"] == $_SESSION['division']) {
                                                  echo "
                                                      <tr class='row'>
                                                        <td>".$user["member_id"]."</td>
                                                        <td>".$user["status"]."</td>
                                                        <td>
                                                          <input type='button' name='view' value='Update' id='".trim($user["user_id"])."' class='btn btn-info btn-xs update_data' />
                                                        </td>
                                                        <td>
                                                          <input type='button' name='view' value='Delete' id='".trim($user["user_id"])."' class='btn btn-danger btn-xs del_data' />
                                                        </td>
                                                      </tr>
                                                    ";
                                              }
                                          }
                                     ?>
                                </tbody>
                            </table>
                        </div>
                      </div>
            </div>
            <br>
            
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
                          <input type="text" name="accountType" id="accountType" class="form-control" value="administrator" readonly>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                        <label for="title">SELECT ACCOUNT ID</label>
                          <select class="form-control" name="memberId" id="memberId" required>
                           <option  disabled selected>Select Division</option>
                           <?php 
                              $objDivision = new Division;
                              $divisions = $objDivision->get_divisions(); 
                              foreach ($divisions as $division) {
                                      echo "<option value=".$division["division_alias"]."|".$division["division_id"].">".$division["division_alias"]."</option>";
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
                      <option id="returngroudId"></option>
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

                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD DVISION ADMIN" />
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
                  // alert(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("super_users.php");
                     }
                     else if(data == "error"){
                      
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
                    $('#returngroudId').html(group_name(jsonObj[0].group_id));
                    $("#status").val(jsonObj[0].status);
                    $("#userName").val(jsonObj[0].user_name);
                    $("#save_btn").val("UPDATE USER");
                    $("#mode").val("update");
                    $("#data_id").val(data_id);
                    $("#myModal").modal("show");
                }  
               });  
          });


        // for grabbing group name
        function group_name(input){
           var mode = "get_group_name"; 
            $.ajax({  
              url:"Script/users.php",  
              method:"POST",  
              data:{data_id:input,mode:mode},  
              success:function(data){
                var jsonObj = JSON.parse(data);
                $('#returngroudId').html('');
                $('#returngroudId').append(jsonObj["group_name"]).attr('value',jsonObj["group_id"]);
                  
                }  
             });
        }



// for delete
        $('.del_data').click(function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/users.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          
                      }  
                     }); 

               }else{
                return false;
              }  
          });

          })  
 </script>