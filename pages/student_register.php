<?php 
include("header.php");
require_once("Classes/studentRegister.php");
$objstudentRegister = new studentRegister;
require_once("Classes/ExamCenterSetup.php");

?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">STUDENT REGISTRATION PAGE</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
             <!-- click to register for semester -->
             <div class="col-md-11">
              <br>
              <?php if ($objstudentRegister->check_member_register()): ?>
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger pull-right">Register Exam <i class="fa fa-pencil"></i></button>
              <?php endif ?>
               
             </div>
            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Exams Center</th>
                            <th>Registered Exam</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          $registeredExams = $objstudentRegister->get_student_registered(); 
                          foreach ($registeredExams as $exam) {
                              $examSubDecode = json_decode($exam['exam_name']);
                              for ($i=0; $i < sizeof($examSubDecode); $i++) { 
                              echo "
                                  <tr>
                                    <td>".$exam['center_name']."</td>
                                    <td>".$examSubDecode[$i]."</td>
                                    <td>
                                      <input type='button' name='view' value='Check Results' id='".trim($exam["exam_register_id"])."' class='btn btn-info btn-xs checkResults' />
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
</div>
<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title">Exam Registration</h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST">
              <?php 
                $objExamCenterSetup = new ExamCenterSetup;
                $center = $objExamCenterSetup->student_exam_center($_SESSION['exam_center_id']);
                $exam_center_id =  $center["exam_center_id"];
                $centerName =  $center["exam_center_name"];
                $centerSubjects  = json_decode($center["exam_subjects"]);
               ?> 
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Exam Center</label>
                        <input type="text" class="form-control" id="examCenterName" name="examCenterName" readonly value="<?php if(isset($centerName)){echo $centerName;} ?>">
                    </div>
                  </div>
                  <!-- for center id -->
                  <input type="hidden" name="centerId" value="<?php echo $exam_center_id;?>">
                  <br>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">SELECT EXAMS TO REGISTER</label>
                        <br>
                          <div class="table-responsive">
                           <table class="table table-hover">
                             <thead>
                                <th>SELECT</th>
                                <th>EXAM NAME</th>
                             </thead>
                             <tbody id="courses">
                                <?php 
                                  foreach ($centerSubjects as $subject) {
                                   echo '<tr>
                                    <td><input type="checkbox" id="subjectSelect" name="subjectSelect[]" value="'.$subject.'"></td>
                                    <td>'.$subject.'</td>
                                   </tr>';
                                  }
                                ?>
                             </tbody> 
                           </table>
                         </div>
                    </div>
                  </div>
             </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
              <button type="submit" id="save_btn" class="btn btn-info btn-block">Register Exams <i class="fa fa-save"></i></button>
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
            $("#insert_form")[0].reset();
          })

        // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });


        //for inserting 
          $("#insert_form").on("submit",function(e){
          e.preventDefault();
          if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
                  $.ajax({
                  url:"Script/studentRegister.php",
                  method:"POST",
                  data:$("#insert_form").serialize(),
                  beforeSend:function(){  
                            $('#save_btn').val("Please wait ...").attr('disabled',true);  
                       },
                  success:function(data){  
                    alert("Exams registered successfully!!!");

                       $("#myModal").modal("hide");
                       $("#insert_form")[0].reset();
                       if (data == "success") {
                        window.location.replace("student_register.php");
                       }
                       else if(data == "error"){
                        
                       }
                  } 

                  });
              }else{
                return false;
              }    
            });

        // for update
        $('.update_data').click(function(){ 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/studentRegister.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE COURSE");
                    $("#courseCode").val(jsonObj[0].course_code);
                    $("#courseName").val(jsonObj[0].course_name);
                    $("#courseLevel").val(jsonObj[0].course_level);
                    $("#courseSemester").val(jsonObj[0].course_semester);
                    $("#courseDetails").val(jsonObj[0].course_details);
                    $("#data_id").val(jsonObj[0].course_id);
                    $("#save_btn").val("UPDATE PAGE");
                    $("#mode").val("update");
                    $("#myModal").modal("show");
                }  
               });  
          });

      
// for delete
        $('.del_data').click(function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/studentRegister.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("school_course.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });
 });  
 </script>