<?php 
include("headerPublic.php");
require_once("Classes/NewApplication.php");
require_once("Classes/Student.php");
// retriving application code
$url = trim($_SERVER['REQUEST_URI']);
$parseURL = parse_url($url);
$codeBase = $parseURL["query"];
$code = explode("=",$codeBase);
$appCode = $code[1];
// check if the college declaration not already made
$objNewApplication = new NewApplication();
$checkCode = $objNewApplication->college_code_check($objNewApplication->CleanData($appCode));

// retrieve details of students
$results = $objNewApplication->collegeDeclare_studentInfo($appCode);
$fullname = trim($results["student_title"])." ".trim($results["student_first_name"])." ".trim($results["student_last_name"]);
$email = trim($results["student_email"]);
$dob = trim($results["student_dob"]);
$tel = trim($results["student_tel"]);
?>
<!-- Modal to show when page loads up -->
  <div class="modal fade" id="onloadModal" role="dialog">
   <div class="modal-dialog modal-xl">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center><h2 class="modal-title"><b style="color: red;"><u>COLLEGE DECLARATION FOR TRAINEE PROFESSIONAL SURVEYOR</u></b></h2></center>
       </div>
       <div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
             <ol>
               <li>
                 To be completed when the candidate is engaged in Full-time/Part-time* course of Professional Instruction in <b>ESTATE SURVEYING AND VALUATION /QUANTITY SURVEYING/LAND SURVEYING</b>
               </li><br>
               
             </ol>
            </div>
          </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div> 

 <div class="row">
    <div class="col-md-12">
        <h3 class="box-title">NEW MEMBER REGISTRATION (COLLEGE DECLARATION)</h3>
        <div class="white-box">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td width="30%"><b>APPLICANT FULL NAME</b></td>
                        <td width="30%"><?php echo $fullname; ?></td>
                      </tr>
                      <tr>
                        <td><b>DATE OF BIRTH</b></td>
                        <td><?php echo $dob; ?></td>
                      </tr>
                      <tr>
                        <td><b>EMAIL</b></td>
                        <td><?php echo $email; ?></td>
                      </tr>
                      <tr>
                        <td><b>TELEPHONE NUMBER</b></td>
                        <td><?php echo $tel; ?></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>
                          <?php 
                              if ($checkCode == "TRUE" ) {
                                echo '<button id="declarationBtn" class="btn btn-danger">MAKE DECLARATION</button>';
                              }
                              elseif ($checkCode == "FALSE") {
                                echo '<b>Thank you, declaration of the application submitted successfully.</b>';
                              }
                           ?>
                          
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header" id="bg">
                   <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
                  <h4 class="modal-title"><center><u><b id="subject">NEW MEMBER REGISTRATION APPLICATION</b></u></center></h4>
                </div>
                <div class="modal-body" id="bg">
                  <form id="insert_form"  method="POST">
                    <fieldset>
                      <center><h2><u>SECTION B</u></h2></center>
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="col_instructorTitle"><span style="color: red;">*</span> TITLE</label>
                            <select class="form-control" name="col_instructorTitle" id="col_instructorTitle" required>
                              <option  disabled selected>Select title</option>
                              <option value="Mr">Mr</option>
                              <option value="Mrs">Mrs</option>
                              <option value="Miss">Miss</option>
                              <option value="Dr">Dr</option>
                              <option value="Prof">Prof</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group">
                             <label for="col_instructFullname"><span style="color: red;">*</span> INSTRUCTOR FULL NAME</label>
                            <input type="text" class="form-control" id="col_instructFullname" placeholder="Eg: John Doe &hellip;" name="col_instructFullname" autocomplete="off" required>
                               
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label for="col_Name"><span style="color: red;">*</span> NAME OF COLLEGE</label>
                              <input type="text" class="form-control" id="col_Name" placeholder="Eg: Surveyors college &hellip;" name="col_Name" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                              <label for="col_stuStartDate"><span style="color: red;">*</span> DATE COURSE COMMENCED</label>
                              <input type="text" class="form-control" id="col_stuStartDate" name="col_stuStartDate" data-toggle="datepicker" placeholder="Click here to select" readonly required>
                          </div>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                              <label for="col_competenceDiv"><span style="color: red;">*</span> ENTER DIVISION OF TECHNICAL COMPENTENCE</label>
                              <input type="text" class="form-control" id="col_competenceDiv" name="col_competenceDiv" placeholder="Applicants divison of competence" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="col-md-12"><b><span style="color:red;">*</span> Ignore if not applicable</b><br><br></div>
                        <div class="col-md-9">
                          <div class="form-group">
                              <label for="col_principalName">PRINCIPAL FULL NAME</label>
                              <input type="text" class="form-control" id="col_principalName" name="col_principalName" placeholder="Enter name of Principal of college" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                              <label for="col_principalProfNum">DIPLOMA NUMBER</label>
                              <input type="number" class="form-control" id="col_principalProfNum" name="col_principalProfNum" placeholder="Enter Dip No" autocomplete="off">
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="mode" value="insertB">
                      <input type="hidden" name="application_code" value="<?php echo $appCode; ?>">
                      <input type="submit" name="submit" id="save_btn" class="submit btn-success btn-block" value="SUBMIT DECLARATION" /><br>
                    </fieldset>
                  </form>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>
    </div>
</div>
    <!-- /.row -->
<?php include("footer.php");?>
 <script>  
      $(document).ready(function(){
        
        $('#onloadModal').modal('show');

        $('#declarationBtn').click(function(){
          if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
            $('#myModal').modal('show');
          }
          else{
                return false;
              }  
        });

        $(function() {
            $('[data-toggle="datepicker"]').datepicker({
              language: 'en-GB',
              format: 'dd-mm-yyyy',
              autoHide: true,
              zIndex: 2048,
            });
          });

        $("#insert_form").on("submit",function(e){
          e.preventDefault();
              if (confirm("ARE YOU SURE YOU WANT TO DECLARATION?")) {
                // check if division id not empty and files is not empty
                  var col_instructFullname = $("#col_instructFullname").val();
                  var col_Name = $('#col_Name').val();
                  var col_stuStartDate = $('#col_stuStartDate').val();
                  var employerEmail = $('#col_competenceDiv').val();
                  if (col_instructFullname != '' && col_Name != '' && col_stuStartDate != '' && col_competenceDiv != '') {
                      $.ajax({
                      url:"Script/newApplication.php",
                      method:"POST",
                      data:$("#insert_form").serialize(),
                      beforeSend:function(){  
                        $('#save_btn').val("Generating code ...");  
                      },
                      success:function(data){
                      window.location.reload();
                      } 

                      });  
                  }else{
                    alert("Fields cannot be empty");
                    return false;
                  }
              }else{
                return false;
              } 
        });


});
 </script>