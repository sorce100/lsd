<?php
  ob_start(); 
  require_once("header.php");
  // retrive page file name
  $retrievedFileName = basename($_SERVER['PHP_SELF']);
  if (!in_array($retrievedFileName, $_SESSION['pagesAllowed'])) {
    header('Location: ../pages/dashboard.php');
  }

  require_once("Classes/ExamsRegister.php");
  require_once("Classes/ExamCenterSetup.php");
  
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">REGISTERED APPLICANTS PAGE </div>
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
                                <th>Center Name</th>
                                <th>Region</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="resultsDisplay">
                          <?php
                            $objExamCenterSetup = new ExamCenterSetup;
                            $centers = $objExamCenterSetup->get_centers(); 
                            foreach ($centers as $center) {
                                echo "
                                    <tr >
                                      <td>".$center["exam_center_name"]."</td>
                                      <td>".$center["exam_center_region"]."</td>
                                      <td>
                                        <button type='button' id='".trim($center["exam_center_id"])."' class='btn btn-info btn-xs viewCenterApplicants'>View Registered Applicants <i class='fa fa-eye'></i></button>
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


<!-- registed_students -->
 <div class="modal fade" id="examsRegisterdListModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title">Exams Registered Applicants</h4>
      </div>
      <div class="modal-body" id="bg">
        <!-- DISPLAY LIST OF ALL STUDENTS THAT HAVE REGISTERED FOR THAT COURSE -->
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr style="background-color:#f4f4f5;color:black!important;">
                        <th>Applicant Name</th>
                        <th>Date Registered</th>
                        <th>Registered Module</th>
                        <th>Exams Subject Score</th>
                        <th>Input Score</th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <tbody id="registeredApplicantsDiv"></tbody>
             </table>
          </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal for inputing the quizes and exams score -->
<div class="modal fade" id="applicantsExamsScoreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
      </div>
      <div class="modal-body" id="bg">
        <!-- DISPLAY LIST OF ALL STUDENTS THAT HAVE REGISTERED FOR THAT COURSE -->
        <form id="input_score_submit">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Exam Score (%)</label>
                    <input type="number" class="form-control" id="examScoreValue" name="examScoreValue" placeholder="Eg. 100" autocomplete="off" required>
                </div>
                <input type="hidden" name="examRegid" id="examRegid" value="">
                <input type="hidden" name="examNameIndex" id="examNameIndex" value="">

                <input type="hidden" name="mode" id="mode" value="insertScore">
                <div class="well modal-footer" id="bg">
                    <!-- <input type="submit" id="saveExamScoreValueBtn" class="btn btn-danger btn-block" name="submit" value="Add Score" /> -->
                    <button type="submit" id="saveExamScoreValueBtn" class="btn btn-danger btn-block" name="submit">Add Score <i class="fa fa-save"></i></button>
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
        $('#input_score_submit').parsley();
        // to contain courses selected for lecturer
         let courseSelectedId = [];
        // for reset modal when close
        $('#examsRegisterdListModal').on('hidden.bs.modal', function () {
            $('#input_score_submit').parsley().reset();
            $('#registeredApplicantsDiv').html('');
          });
        $('#applicantsExamsScoreModal').on('hidden.bs.modal', function () {
            $('#input_score_submit').parsley().reset();
          });

        // for search
        $("#searchInput").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
/////////////////////////////////////////////////////////////////////////////////////////////////
        // viewing registered stuent records
        $('.table').on('click', '.inputApplicantScore', function () {
          let examNamesIndexRegisterId = $(this).prop("id");
            //split examname and register id
            // 0=examName
            // 1=registrationId
          let examNameindexRegIdSplit = examNamesIndexRegisterId.split('|');
          let examNameindex = examNameindexRegIdSplit[0];
          let regId = examNameindexRegIdSplit[1];
          
          $('#examNameIndex').val(examNameindex);
          $('#examRegid').val(regId);

          $('#applicantsExamsScoreModal').modal('show');
        });
//////////////////////////////////////////////////////////////////////////////////////////////////


    // view register for applicants for exams center
        $('.table').on('click', '.viewCenterApplicants', function () {
            $('#registeredApplicantsDiv').html('');
            let mode= "getExamsRegisteredApplicants";
            let examcenterId = $(this).prop("id");
            // for storing values for exams subjects per the module seletected
            let examsSubjectsAndScore = '';
            let examsSubjectsInputs = '';
            $.ajax({
              url:"Script/examRegister.php",
              method:"POST",
              data:{examcenterId:examcenterId,mode:mode},
              beforeSend:function(){  
                    // $('#saveExamScoreValueBtn').val("Please wait ...").prop('disabled',true);  
               },
              success:function(data){ 
               let jsonObj = JSON.parse(data);
               for (let i = 0; i < jsonObj.length; i++) {
                  // decode exams score
                  let jsonObjExamsScore = JSON.parse(jsonObj[i].exam_score);
                  // for filtering through the exams subjects names attached to the module
                  // add 1 to the exam subject index cus the index was giving issue
                  let jsonObjExamSubject = JSON.parse(jsonObj[i].subject_name);
                   for (let j = 0; j < jsonObjExamSubject.length; j++) {
                    // for getting exams subjects and scores add 1 to the score index because it was stored with plus 1
                    examsSubjectsAndScore += jsonObjExamSubject[j] + " => <strong>"+ jsonObjExamsScore[j+1] +' %</strong><hr>';
                    // for the exams subjects iwth  btn
                    examsSubjectsInputs +='<strong> '+jsonObjExamSubject[j]+'</strong> '+
                                    '<button type="button" id="'+(j+1)+'|'+jsonObj[i].exam_register_id+'" class="btn btn-info btn-xs inputApplicantScore">Add Score <i class="fa fa-calculator"></i></button>'+
                                    '<hr>';
                   }

                  $('#registeredApplicantsDiv').append(
                    '<tr>'+
                      '<td>'+jsonObj[i].student_first_name+' '+jsonObj[i].student_last_name+'</td>'+
                      '<td>'+jsonObj[i].date_registered+'</td>'+
                      '<td>'+jsonObj[i].center_exam_part+'</td>'+
                      '<td>'+examsSubjectsAndScore+'</td>'+
                      '<td>'+examsSubjectsInputs+'</td>'+
                    '<tr>');
                }
                  
              } 

            });  

          $('#applicantsListDiv').append();
          $('#examsRegisterdListModal').modal('show');
        });
//////////////////////////////////////////////////////////////////////////////////////////////////////
    // save exam score value
        $("#input_score_submit").on("submit",function(e){
            e.preventDefault();
            $.ajax({
            url:"Script/examRegister.php",
            method:"POST",
            data:$("#input_score_submit").serialize(),
            beforeSend:function(){  
                $('#saveExamScoreValueBtn').text("Please wait ...").prop('disabled',true);  
             },
            success:function(data){
            // console.log(data); 
                 $("#input_score_submit")[0].reset();
                 $("#applicantsExamsScoreModal").modal("hide");
                 if (data == "success") {
                  $('#saveExamScoreValueBtn').text("Add Score").prop('disabled',false);
                  toastr.success(' Successfull');
                  // alert("Added Successfully");
                 }
                 else if(data == "error"){
                  // alert("There was an error");
                  toastr.error('There was an error');
                 }
            } 

            });  
          });

});  
 </script>