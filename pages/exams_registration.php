<?php 
include("header.php");
require_once("Classes/ExamsRegister.php");
$objExamsRegister = new ExamsRegister;
require_once("Classes/ExamCenterSetup.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">EXAM REGISTRATION PAGE </div>
            <div class="panel-title pull-right">
              <?php if ($objExamsRegister->check_member_register()): ?>
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger pull-right">Register Exam <i class="fa fa-pencil"></i></button>
              <?php endif ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <!-- for search -->
            <!-- content -->
            <div class="col-md-12">
              <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Exams Center</th>
                            <th>Exams Center Region</th>
                            <th>Date Registered</th>
                            <th>Registered Module</th>
                            <th>Subject </th>
                            <th>Scores</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          
                          $registeredExams = $objExamsRegister->get_applicants_registered(); 
                          foreach ($registeredExams as $examDetails) {
                            // variable for subject score array filter
                            $subjectScoreHolder='';
                            $subjectOnlyHolder='';
                            // print_r($examDetails);
                            $decodeSubject = json_decode($examDetails['subject_name'],true);
                            $decodeScores = json_decode($examDetails['exam_score'],true);
                            for ($i=0; $i < sizeof($decodeSubject) ; $i++) { 
                              $subjectOnlyHolder .= "<strong>".$decodeSubject[$i]."</strong><hr>";
                              
                              if (!empty($decodeScores[$i+1])) {
                                $subjectScoreHolder .="<strong style='color:#F33155'>". $decodeScores[$i+1]." % </strong><hr>";
                              }
                              else{
                                 $subjectScoreHolder .="<strong style='color:#F33155'>PENDING<hr>";
                              }
                              
                            }
                            echo "
                                <tr>
                                  <td>".$examDetails['exam_center_name']."</td>
                                  <td>".$examDetails['exam_center_region']."</td>
                                  <td>".$examDetails['date_registered']."</td>
                                  <td>".$examDetails['center_exam_part']."</td>
                                  <td>".$subjectOnlyHolder."</td>
                                  <td>".$subjectScoreHolder."</td>

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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title">Exam Registration</h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST">
              <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">Select Center <span class="asterick">*</span></label>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <select class="form-control" id="centerId" name="centerId" required>
                        <option value="" selected disabled>Select Exam Center</option>
                        <?php
                          $objExamCenterSetup = new ExamCenterSetup;
                          $centers = $objExamCenterSetup->get_centers(); 
                          foreach ($centers as $center) {
                              echo "<option value='".trim($center["exam_center_id"])."'>".$center['exam_center_name']."</option>";
                          }
                         ?>
                      </select>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">Select Module <span class="asterick">*</span></label>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <select class="form-control" id="moduleId" name="moduleId" required>

                      </select>
                    </div>
                  </div>
              </div>
 <!--              <hr>
              <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">Module Content</label>
                    </div>
                  </div>
                  <div class="col-md-9">
                      <ul id="moduleContentDiv"></ul>
                  </div>
             </div> -->
             <br>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class=" modal-footer" id="bg">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
              <button type="submit" class="btn btn-info" id="save_btn">Register Exams <i class="fa fa-save"></i></button>
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
            $('#moduleId').html('');
            $('#moduleContentDiv').html('');
            $("#insert_form")[0].reset();
          })

        // for search
        $("#searchInput").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });


        //for inserting 
          $("#insert_form").on("submit",function(e){
          e.preventDefault();
          if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
                  $.ajax({
                  url:"Script/examRegister.php",
                  method:"POST",
                  data:$("#insert_form").serialize(),
                  beforeSend:function(){  
                      $('#save_btn').text("Please wait ...").attr('disabled',true);  
                 },
                  success:function(data){ 
                    
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      alert("Exams registered successfully!!!");
                      toastr.success(' Successfull');
                      window.reload();
                     }
                     else if(data == "error"){
                      toastr.error('There was an error');
                     }
                  } 

                  });
              }else{
                return false;
              }    
            });

        // for update
        $('table').on('click', '.update_data', function(){
           let mode= "updateModal"; 
           let data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/examRegister.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                    toastr.success(' Successfull');
                     let jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE COURSE");
                    $("#courseCode").val(jsonObj[0].course_code);
                    $("#courseName").val(jsonObj[0].course_name);
                    $("#courseLevel").val(jsonObj[0].course_level);
                    $("#courseSemester").val(jsonObj[0].course_semester);
                    $("#courseDetails").val(jsonObj[0].course_details);
                    $("#data_id").val(jsonObj[0].course_id);
                    $("#save_btn").text("Update Register");
                    $("#mode").val("update");
                    $("#myModal").modal("show");
                }  
               });  
          });

      
  // get module details on select of exam center
  
  $("#centerId").change(function(){
       $('#moduleId').html('');
       let centerId = $('option:selected', this).val();
       let mode= "getExamCenterModules";  
       $.ajax({  
            url:"Script/examModuleSetup.php",  
            method:"POST",  
            data:{centerId:centerId,mode:mode},  
            success:function(data){
                // toastr.success(' Successfull');
                let jsonObj = JSON.parse(data);  
                 // changing modal title
                 for (var i = 0; i < jsonObj.length; i++) {
                   
                   $('#moduleId').append('<option id="'+jsonObj[i].subject_name+'" class="moduleSubjectList" value="'+jsonObj[i].module_id+'">'+jsonObj[i].center_exam_part+'</option>');
                 }
                 
              }  
           });  

    }); 
    // click to view content of module subjects
    // $(".moduleSubjectList").change(function(){
    //    $('.moduleContentDiv').html('');
    //     let subjectList = $(this).prop('id');
    //     console.log(subjectList);
    //     let jsonObj = JSON.parse(subjectList);  
    //      // changing modal title
    //      for (var i = 0; i < jsonObj.length; i++) {
    //        $('#moduleContentDiv').append('<li>'+jsonObj[i]+'</li>');
    //      }

    // }); 



});  
</script>