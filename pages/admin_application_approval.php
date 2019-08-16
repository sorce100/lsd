<?php 
      include("header.php");
      require_once("Classes/NewApplication.php");
      require_once("Classes/EmailSend.php");
      require_once("Classes/Division.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">NEW APPLICANT APPROVAL PAGE </div>
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
                            <th></th>
                            <th>CODE</th>
                            <th>DIVISION APPLIED</th>
                            <th>APPLICANT FULLNAME</th>
                            <th>APPLICATION DATE</th>
        
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                      <?php
                          // division object
                          $objDivision = new Division;
                          // for applicants fullname
                          $objEmailSend = new EmailSend;
                          // for application object
                          $objNewApplication = new NewApplication;
                          $applications = $objNewApplication->get_applications(); 
                          foreach ($applications as $application) {
                                  echo "
                                      <tr class='row'>
                                        <td>".trim($application["application_code"])."</td>
                                        <td>".$objDivision->get_alias_byId($application["application_division"])."</td>
                                        <td>".$objEmailSend->get_student_fullName($application["student_id"])."</td>
                                        <td>".$application["application_startDate"]."</td>";

                                  if (empty($application["app_accept_date"])) {
                                    echo "<td>
                                    <button type='button' data-toggle='modal' data-target='#myModal' id='".trim($application["new_application_id"])."' class='btn btn-info btn-xs confirmApp'>CONFIRM APPLICATION <i class='fa fa-edit'></i></button>
                                    </td></tr>";
                                  }
                                  elseif (!empty($application["app_accept_date"])) {
                                    echo "<td>
                                    <button type='button' id='".trim($application["new_application_id"])."' class='btn btn-success btn-xs viewCompleted'>COMPLETED <i class='fa fa-trash'></i></button>
                                    </td></tr>";
                                  }
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

<!-- /.row -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header" id="bg">
                   <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
                  <h4 class="modal-title"><center><u><b id="subject">SUBMITTED NEW MEMBER REGISTRATION APPLICATION</b></u></center></h4>
                </div>
                <div class="modal-body" id="bg">
                  <form id="insert_form"  method="POST" enctype="multipart/form-data">
                        <fieldset>
                          <center><h2><u>SECTION A</u></h2></center>
                          <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                   <label for="appCode">APPLICANTION CODE</label>
                                  <input type="text" class="form-control" id="appCode" readonly>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                   <label for="appStartDate">APPLICANTION START DATE</label>
                                  <input type="text" class="form-control" id="appStartDate" readonly>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                   <label for="appFullName">APPLICANT FULL NAME</label>
                                  <input type="text" class="form-control" id="appFullName" readonly>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                   <label for="appDob">APPLICANT DATE OF BIRTH</label>
                                  <input type="text" class="form-control" id="appDob" readonly>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                   <label for="appAge">APPLICANT AGE</label>
                                  <input type="text" class="form-control" id="appAge" readonly>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                   <label for="appEmail">APPLICANT EMAIL</label>
                                  <input type="text" class="form-control" id="appEmail" readonly>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                   <label for="appTel">APPLICANT TELEPHONE NUMBER</label>
                                  <input type="text" class="form-control" id="appTel" readonly>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                   <label for="appTel">APPLICANT POSTAL ADDRESS</label>
                                   <textarea class="form-control" rows="3" id="appPostAdd" readonly></textarea>
                                </div>
                              </div>
                          </div>
                          <br>
                            <!-- buttons -->
                           <input type="button" class="next btn-info btn-block" value="APPLICANTION FILES" />
                        </fieldset>
                        <fieldset>
                          <center><h2><u>SECTION A (II)</u></h2></center>
                            <div class="col-md-12">
                              <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <th>APPLICATION FILE SUBJECT</th>
                                    <th>APPLICATION FILE UPLOADED</th>
                                  </thead>
                                  <tbody id="appFiles">
                                    
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          <input type="button" name="previous" class="previous btn-danger btn-block" value="APPLICANT DETAILS" /><br>
                          <input type="button" name="next" class="next btn-info btn-block" value="COLLEGE DECLARATION" /><br>
                        </fieldset>
                        <fieldset>
                          <center><h2><u>SECTION B</u></h2></center>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                 <label for="colPrinFullName">PRINCIPAL FULLNAME</label>
                                 <input type="text" class="form-control" id="colPrinFullName" readonly>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                 <label for="colName">NAME OF INSTITUITION</label>
                                 <input type="text" class="form-control" id="colName" readonly>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                 <label for="colCourseDate">DATE COURSE COMMENCED</label>
                                 <input type="text" class="form-control" id="colCourseDate" readonly>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                 <label for="colTechDivision">TECHNICAL DIVISION</label>
                                 <input type="text" class="form-control" id="colTechDivision" readonly>
                              </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                              <div class="form-group">
                                 <label for="colInstructorName">PRINCIPAL INSTRUCTORS FULLNAME</label>
                                 <input type="text" class="form-control" id="colInstructorName" readonly>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                 <label for="colProfNum">DIPLOMA NO:</label>
                                 <input type="text" class="form-control" id="colProfNum" readonly>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                 <label for="colDeclareDate">DECLARATION DATE</label>
                                 <input type="text" class="form-control" id="colDeclareDate" readonly>
                              </div>
                            </div>
                          </div>
                          <br>
                          <!-- buttons -->
                          <input type="button" name="previous" class="previous btn-danger btn-block" value="APPLICANTION FILES" /><br>
                          <input type="button" name="next" class="next btn-info btn-block" value="EMPLOYER / TRAINER DECLARATION" /><br>
                        </fieldset>

                          <fieldset>
                            <center><h2><u>SECTION C</u></h2></center>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="empFirmName">NAME OF FIRM / PUBLIC SERVICE</label>
                                       <input type="text" class="form-control" id="empFirmName" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="empLoc">LOCATION AND POSTAL ADDRESS</label>
                                       <textarea class="form-control" rows="3" id="empLoc" readonly></textarea>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                       <label for="empTecDivision">TECHNICAL DEPARTMENT / DIVISION</label>
                                       <input type="text" class="form-control" id="empTecDivision" readonly>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                       <label for="empTel">TELEPHONE NUMBER</label>
                                       <input type="text" class="form-control" id="empTel" readonly>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                       <label for="empInstructor">NAME OF INSTRUCTOR</label>
                                       <input type="text" class="form-control" id="empInstructor" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                       <label for="empInstructorProfNo">DIPLOMA NO:</label>
                                       <input type="text" class="form-control" id="empInstructorProfNo" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="empBranchOffice">LOCATION OF HEAD / BRANCH OFFICE</label>
                                       <input type="text" class="form-control" id="empBranchOffice" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="empDeclareDate">DECLARATION DATE</label>
                                       <input type="text" class="form-control" id="empDeclareDate" readonly>
                                    </div>
                                </div>
                              </div>
                              <input type="button" name="previous" class="previous btn-danger btn-block" value="COLLEGE DECLARATION" /><br>
                              <input type="button" name="next" class="next btn-info btn-block" value="PROPOSER DECLARATION" />
                          </fieldset>
                          <fieldset>
                            <center><h2><u>SECTION D</u></h2></center>
                            <div class="col-md-12">
                                <div class="form-group">
                                   <label for="proFullName">FELLOW FULLNAME</label>
                                   <input type="text" class="form-control" id="proFullName" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label for="proProfNo">DIPLOMA NO:</label>
                                   <input type="text" class="form-control" id="proProfNo" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label for="proYearElected">YEAR ELECTED AS FELLOW</label>
                                   <input type="text" class="form-control" id="proYearElected" readonly>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                   <label for="proEmployment">PLACE OF EMPLOYMENT</label>
                                   <input type="text" class="form-control" id="proEmployment" readonly>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                   <label for="proTel">TELEPHONE NUMBER</label>
                                   <input type="text" class="form-control" id="proTel" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                   <label for="proPostalAddress">POSTAL ADDRESS</label>
                                   <input type="text" class="form-control" id="proPostalAddress" readonly>
                                </div>
                            </div>
                            <input type="button" name="previous" class="previous btn-danger btn-block" value="COLLEGE DECLARATION" /><br>
                            <input type="button" name="next" class="next btn-info btn-block" value="APPLICATION ASSESSMENT" />
                          </fieldset>
                          <fieldset>
                            <center><h2><span style="color: red;">*</span><u>APPLICATION REVIEW</u></h2></center>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label for="appAcceptStatus">APPLICATION ACCEPTANCE STATUS</label>
                                   <select class="form-control" id="appAcceptStatus">
                                     <option  disabled selected>Select Application accepted / denied </option>
                                     <option value="ACCEPTED">ACCEPTED</option>
                                     <option value="DENIED">DENIED</option>
                                   </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="assignProNumDiv">
                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                   <label for="proEmployment">APPLICATION ACCEPTANCE REASON</label>
                                   <textarea class="form-control" rows="5" id="appAcceptReason"></textarea>
                                </div>
                            </div>

                            <input type="button" name="previous" class="previous btn-danger btn-block" value="PROPOSER DECLARATION" /><br>
                            <input type="submit" name="submit" class="submit btn-success btn-block" value="MAKE ASSESSMENT" />
                          </fieldset>
                        </form>
                         <!-- Circles which indicates the steps of the form: -->
                        <div style="text-align:center;margin-top:40px;">
                          <span class="step active"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                        </div>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
        </div>
    </div>
</div>

 
<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD DIVISION");
            $("#insert_form")[0].reset();
          })

        // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        // for accept to enter diploma number of deny application
         $("#appAcceptStatus").change(function(){
            var status = $(this).val();
            switch (status){
              case 'ACCEPTED':
                $("#assignProNumDiv").html('<div class="form-group"><label for="assignProNum">ASSIGN DIPLOMA NUMBER</label><input type="number" class="form-control" name="assignProNum" id="assignProNum"></div>');
              break;
              case 'DENIED':
                $("#assignProNumDiv").html('');
              break;
            }
          });

        //for inserting 
          $("#insert_form").on("submit",function(e){
          e.preventDefault();
                $.ajax({
                url:"Script/division.php",
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
                      window.location.replace("super_division.php");
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });

         // for update
        $('.confirmApp').click(function(){ 
           var mode = "confirm_details"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/newApplication.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     $("#appFiles").html('');
                     var jsonObj = JSON.parse(data);
                     ////////////////////////////////  
                     // for applicant details step 1
                     ////////////////////////////////
                      $("#appCode").val(jsonObj["application_code"]);
                      $("#appStartDate").val(jsonObj["application_startDate"]);
                      $("#appFullName").val(jsonObj["studentFullname"]);
                      $("#appDob").val(jsonObj["studentdob"]);
                      $("#appAge").val(jsonObj["age"]);
                      $("#appEmail").val(jsonObj["studentemail"]);
                      $("#appTel").val(jsonObj["studenttel"]);
                      $("#appPostAdd").val(jsonObj["studentpostAddress"]);
                      ////////////////////////////////
                      // for files uploaded set 2
                      ////////////////////////////////
                      var filesSubjectjsonObj = JSON.parse(jsonObj["files_subject"]);
                      var filesNamejsonObj = JSON.parse(jsonObj["files_name"]);
                      // $("#appFiles").html(filesNamejsonObj.length);
                      for (var i = 0; i < filesNamejsonObj.length; i++) {
                          $("#appFiles").append("<tr><td>"+filesSubjectjsonObj[i]+"</td><td>"+filesNamejsonObj[i]+"</td></tr>");
                      }
                      // append a button to download the zip of the files
                      $("#appFiles").append("<tr><td></td><td><button class='form-control btn btn-warning' name='' id='downloadFilesBtn'>Download Application Files</button></td></tr>");
                      // $("#appFiles").append("<a href='zipFile_download.php?folderName="+jsonObj["folder_name"]+"'>Download</a>");
                      // add foldername to the button for downloading files
                      $("#downloadFilesBtn").attr('name',jsonObj["folder_name"]);

                      ////////////////////////////////
                      // for college details step 3
                      ////////////////////////////////
                      $("#colPrinFullName").val(jsonObj["col_instructor_title"]+" "+jsonObj["col_instruct_fullname"]);
                      $("#colName").val(jsonObj["col_name"]);
                      $("#colCourseDate").val(jsonObj["col_stu_startDate"]);
                      $("#colTechDivision").val(jsonObj["col_competence_div"]);
                      $("#colInstructorName").val(jsonObj["col_principal_name"]);
                      $("#colProfNum").val(jsonObj["col_principal_profNum"]);
                      $("#colDeclareDate").val(jsonObj["col_declare_date"]);
                      ////////////////////////////////
                      // for employer/trainer details step 4
                      ////////////////////////////////
                      $("#empFirmName").val(jsonObj["emp_com_name"]);
                      $("#empLoc").val(jsonObj["emp_com_loc"]);
                      $("#empTecDivision").val(jsonObj["emp_tec_division"]);
                      $("#empTel").val(jsonObj["emp_tel"]);
                      $("#empInstructor").val(jsonObj["com_trianer_name"]);
                      $("#empInstructorProfNo").val(jsonObj["emp_trianer_profNum"]);
                      $("#empBranchOffice").val(jsonObj["emp_stu_branch"]);
                      $("#empDeclareDate").val(jsonObj["emp_declare_date"]);
                      ////////////////////////////////
                      // for proposers details
                      ////////////////////////////////
                      $("#proFullName").val(jsonObj["memberFullname"]);
                      $("#proProfNo").val(jsonObj["memberProfNum"]);
                      $("#proYearElected").val(jsonObj["memberYearElect"]);
                      $("#proEmployment").val(jsonObj["memberComName"]);
                      $("#proTel").val(jsonObj["memberTel"]);
                      $("#proPostalAddress").val(jsonObj["emp_com_loc"]);

                      $("#myModal").modal("show");
                  }  
               });  
          });


///////////////////////////////////////
//////////for downloading files
//////////////////////////////////////
  $(document).on('click', '#downloadFilesBtn', function(){
      if (confirm("ARE YOU SURE YOU WANT TO PROCEED DOWNLOADING FILES?")) {
          var mode= "appFilesDownload";
          var folderName = $(this).attr('name');
          $.ajax({  
                url:"Script/newApplication.php",  
                method:"POST",  
                data:{folderName:folderName,mode:mode},  
                success:function(data){
                    // return false;
                }  
          });
      }else{
        return false;
      }
  });

});  
 </script>