<?php
      include("header.php");
      require_once("Classes/Student.php");
      require_once("Classes/Division.php");
      require_once("Classes/ExamCenterSetup.php");

?>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">REGISTERED APPLICANTS </div>
            <div class="panel-title pull-right">
              <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEW</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <!-- for search -->
            <div class="col-md-12">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="searchInput" autocomplete="off">
                  <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                </div>
            </div>
            <!-- content -->
            <div class="col-md-12">
              <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>STUDENT NAME</th>
                            <th>DATE/TIME</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                   <tbody id="resultsDisplay">
                        <?php
                          $objStudent = new Student;
                          $students = $objStudent->get_students(); 
                          foreach ($students as $student) {
                                  echo "
                                      <tr>
                                        <td>".$student["student_first_name"]." ".$student["student_last_name"]."</td>
                                        <td>".$student["date_done"]."</td>
                                        <td>
                                          <button type='button' id='".trim($student["student_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                        </td>
                                        <td>
                                          <button type='button' id='".trim($student["student_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
                                        </td>
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
</div>
<!--  -->
<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" id="bg">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
            <h4 class="modal-title"><b id="subject">NEW APPLICANT</b></h4>
          </div>
          <div class="modal-body" id="bg">
          <form id="insert_form"> 
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
                      <input type="text" class="form-control" id="studentFirstName" placeholder="Enter first name &hellip;" name="studentFirstName" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" id="studentLastName" placeholder="Enter last name &hellip;" name="studentLastName" autocomplete="off" required>
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
                      <input type="number" class="form-control" id="studentTel" placeholder="Enter phone number eg: 020 xxxx xxx &hellip;" name="studentTel" autocomplete="off" required>
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
              <input type="hidden" name="data_id" id="data_id" value="">
              <div class="col-md-6">
                <button type="submit" class="btn btn-block btn-info" id="signUp" name="signUp">Submit <i class="glyphicon glyphicon-floppy-disk"></i></button>
              </div>
            </div>

            <br>
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
            $("#insert_form")[0].reset();
          });

        // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

         // save student register details
          $("#insert_form").on("submit",function(e){
                e.preventDefault();
                var mode = "insert";
                $.ajax({
                url:"Script/student.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          // $('#signUp').val("Please wait ...").attr('disabled',true);  
                     },
                success:function(data){  
                  alert(data);
                        // alert("Saved Successfully");
                        // $("#insert_form")[0].reset();
                        // $("#myModal").modal("hide");
                } 

                });  
            });

        // for update
        $('.table').on('click', '.update_data', function () {
        // $('.update_data').click(function(){ 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/student.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                  console.log(data);
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("Update Student Records");
                    $("#studentTitle").val(jsonObj[0].student_title);
                    $("#studentFirstName").val(jsonObj[0].student_first_name);
                    $("#studentLastName").val(jsonObj[0].student_last_name);
                    $("#studentEmail").val(jsonObj[0].student_email);
                    $("#studentLevel").val(jsonObj[0].student_level);
                    $("#studentTel").val(jsonObj[0].student_tel);
                    $("#division").val(jsonObj[0].division);
                    $("#examCenter").val(jsonObj[0].exam_center_id);
                    $("#data_id").val(jsonObj[0].student_id);
                    $("#save_btn").val("Update Student");
                    $("#mode").val("update");
                    $("#myModal").modal("show");
                }  
               });  
          });

      
// for delete
        $('.table').on('click', '.del_data', function () {
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/surveyor.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("admin_surveyor_type.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });

          })  
 </script>