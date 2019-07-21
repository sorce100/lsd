<?php 
  require_once("header.php");
  require_once("Classes/StudentRegister.php");
  $displayArray="";
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">REGISTERED STUDENTS PAGE</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
              <!-- for search -->
              <div class="col-md-12">
                <form method="POST">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="searchInput" autocomplete="off">
                    <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                  </div>
                 </form>
              </div>
              <!-- for add button -->

            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Exam Center</th>
                            <th>Student</th>
                            <th>Exam Score</th>
                            <th>Lat Updated</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                      <?php
                          $objStudentRegister = new StudentRegister;
                          $students = $objStudentRegister->get_all(); 
                          foreach ($students as $student) {
                                  echo "
                                      <tr >
                                        <td>".$student["exam_center_id"]."</td>
                                        <td>".$student["student_id"]."</td>";
                                        $jsonDecodeScore = json_decode($student["exam_score"]);
                                        $jsonDecodeName = json_decode($student["exam_score_name"]);
                                        if (!empty($jsonDecodeName)) {
                                          for ($i=0; $i < sizeof($jsonDecodeName); $i++) { 
                                            $displayArray .="<b>".$jsonDecodeName[$i] ." => ". $jsonDecodeScore[$i]." % </b><br>";
                                          }
                                        }
                                        echo "<td>".$displayArray."</td>
                                        <td>".$student["date_done"]."</td>
                                        <td>
                                          <button type='button' id='".trim($student["exam_name"]).'|'.trim($student["exam_register_id"])."' class='btn btn-info btn-xs input_score' alt='".trim($student["exam_name"])."'>Input Results <i class='fa fa-pencil'></i> </button> 
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
<!-- /.row -->
<!-- registed_students -->
 <div class="modal fade" id="examNamesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title">Student Registered Exams</h4>
      </div>
      <div class="modal-body" id="bg">
        <!-- DISPLAY LIST OF ALL STUDENTS THAT HAVE REGISTERED FOR THAT COURSE -->
        <table class="table table-hover table-bordered">
            <thead>
                <tr style="background-color:#f4f4f5;color:black!important;">
                    <th>Exam Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="examNames"></tbody>
         </table>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal for inputing the quizes and exams score -->
<div class="modal fade" id="studentRecordsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
      </div>
      <div class="modal-body" id="bg">
        <!-- DISPLAY LIST OF ALL STUDENTS THAT HAVE REGISTERED FOR THAT COURSE -->
        <form id="studentScoreSubmit">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Exam Score (%)</label>
                    <input type="number" class="form-control" id="examScoreValue" name="examScoreValue" placeholder="Eg. 100" autocomplete="off" required>
                </div>
                <input type="hidden" name="examRegid" id="examRegid" value="">
                <input type="hidden" name="examName" id="examName" value="">

                <input type="hidden" name="mode" id="mode" value="insertScore">
                <div class="well modal-footer" id="bg">
                    <input type="submit" id="saveExamScoreValueBtn" class="btn btn-danger btn-block" name="submit" value="Add Score" />
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
        // to contain courses selected for lecturer
         var courseSelectedId = [];
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD LECTURER");
            $("#insert_form")[0].reset();
            $('#lectureCoursesSelect').html('');
          })

        // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        // viewing registered stuent records
        $('.table').on('click', '.input_score', function () {
           $('#examNames').html(''); 
           var mode= "updateModal"; 
           var examNamesRegisterId = $(this).prop("id");
            //split examname and register id
            // 0=examName
            // 1=registrationId
           var examNameRegIdSplit = examNamesRegisterId.split('|');
           var jsonObj = JSON.parse(examNameRegIdSplit[0]);
           for (var i = 0; i < jsonObj.length; i++) {
             $('#examNames').append('<tr>'+
              '<td>'+jsonObj[i]+'</td><td><button id="'+jsonObj[i]+'" class="btn btn-info addExamScore">Add Score <i class="fa fa-edit"></i></button></td></tr>');
           }
           // insert the registration id into the hidden field
           $('#examRegid').val(examNameRegIdSplit[1]);
           $('#examNamesModal').modal('show');
        });

    // enter exams score
        $('.table').on('click', '.addExamScore', function () {
          let examSubName = $(this).prop('id');
          // insert exam name in hidden filed
          $('#examName').val(examSubName);
          $('#studentRecordsModal').modal('show');

        });

    // save exam score value
        $("#studentScoreSubmit").on("submit",function(e){
            e.preventDefault();
            $.ajax({
            url:"Script/studentRegister.php",
            method:"POST",
            data:$("#studentScoreSubmit").serialize(),
            beforeSend:function(){  
                  $('#saveExamScoreValueBtn').val("Please wait ...").prop('disabled',true);  
             },
            success:function(data){ 
                 $("#studentScoreSubmit")[0].reset();
                 $("#studentRecordsModal").modal("hide");
                 if (data == "success") {
                  $('#saveExamScoreValueBtn').val("Add Score").prop('disabled',false);
                  alert("Added Successfully");
                 }
                 else if(data == "error"){
                  alert("There was an error");
                 }
            } 

            });  
          });

});  
 </script>