<?php
      include("header.php");
      require_once("Classes/Student.php");
      require_once("Classes/Division.php");
      require_once("Classes/ExamCenterSetup.php");

?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">Student Setup</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
              <!-- for search -->
              <div class="col-md-10">
                <form action="usersearch.php" method="POST">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="searchInput" autocomplete="off">
                    <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                  </div>
                 </form>
              </div>
              <!-- for add button -->
              <div class="col-md-2">
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEW</button>
              </div>
            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>STUDENT NAME</th>
                            <th>DATE/TIME</th>
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
                                          <input type='button' name='view' value='Update' id='".trim($student["student_id"])."' class='btn btn-info btn-xs update_data' />
                                        
                                          <input type='button' name='view' value='Delete' id='".trim($student["student_id"])."' class='btn btn-danger btn-xs del_data' />
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
<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" id="bg">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
            <h4 class="modal-title"><b id="subject">SIGN UP STUDENT</b></h4>
          </div>
          <div class="modal-body" id="bg">
          <form id="insert_form"> 
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
              </div><br>
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
              </div><br>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="division">SELECT DIVISON</label>
                    <select class="form-control" name="division" id="division" required>
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
                    <label for="centerId">SELECT EXAM CENTER</label>
                    <select class="form-control" name="examCenter" id="examCenter" required>
                      <option  disabled selected>Select School</option>
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
              </div><br>  
              <div class="row">
                 <!-- for insert query -->
                <input type="hidden" name="mode" id="mode" value="insert">
                <!-- for inserting the page id -->
                <input type="hidden" name="data_id" id="data_id" value="">
                <div class="col-md-12">
                  <input type="submit" class="btn btn-block btn-info" id="save_btn" name="save_btn" value="Add Student" />
                </div>
              </div><br>
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