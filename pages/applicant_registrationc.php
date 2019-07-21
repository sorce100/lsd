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
$checkCode = $objNewApplication->employer_code_check($objNewApplication->CleanData($appCode));

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
         <center><h2 class="modal-title"><b style="color: red;"><u>TRAINER OR EMPLOYER OF TRAINEE PROFESSIONAL SURVEYOR</u></b></h2></center>
       </div>
       <div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
             <ol>
               <li>
                 To be completed by the <b>Principal or by a Partner in the firm</b> where the candidate is training/employed. Where the candidate is trained/employed in the Public Service or by a large undertaking, the authorization of the Head (or his authorized deputy) of the technical department in which the candidate is engaged must be obtained.
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
        <h3 class="box-title">NEW MEMBER REGISTRATION (TRAINER’S/EMPLOYER’S DECLARATION)</h3>
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
                    <center><h2><u>SECTION C</u></h2></center>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="emp_comName"><span style="color: red;">*</span> NAME OF FIRM OR PUBLIC SERVICE</label>
                            <input type="text" class="form-control" id="emp_comName" placeholder="Eg: Minitries &hellip;" name="emp_comName" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="emp_comLoc"><span style="color: red;">*</span> LOCATION AND POSTAL ADDRESS</label>
                            <textarea class="form-control" placeholder="Enter the location and address of the firm or company" id="emp_comLoc" name="emp_comLoc" required autocomplete="off" required></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="emp_tel"><span style="color: red;">*</span> TELEPHONE NUMBER</label>
                            <input type="number" class="form-control" id="emp_tel" name="emp_tel" placeholder="020XXXXXXX" autocomplete="off" required> 
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="emp_tecDivision"><span style="color: red;">*</span> TECHNICAL DEPARTMENT/DIVISION</label>
                            <input type="text" class="form-control" id="emp_tecDivision" name="emp_tecDivision" placeholder="Candidates technical department" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="emp_stuBranch"><span style="color: red;">*</span> HEAD / BRANCH CANDIDATE ASSIGNED</label>
                            <input type="text" class="form-control" id="emp_stuBranch" name="emp_stuBranch" placeholder="Candidates working branch of the company or firm" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-12"><br><br><b><span style="color:red;">*</span><b>The name and qualifications of the person directly responsible for the candidate’s training and making this declaration</b><br><br></div>
                      <div class="col-md-9">
                        <div class="form-group">
                            <label for="com_trianerName"><span style="color: red;">*</span> TRAINER'S FULL NAME</label>
                            <input type="text" class="form-control" id="com_trianerName" name="com_trianerName" placeholder="Enter name of trainer of candidate" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="emp_ProfNum">DIPLOMA NUMBER</label>
                            <input type="number" class="form-control" id="emp_ProfNum" name="emp_ProfNum" placeholder="Enter Dip No" autocomplete="off" required>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="mode" value="insertC">
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
                  var emp_comName = $("#emp_comName").val();
                  var emp_comLoc = $('#emp_comLoc').val();
                  var emp_tel = $('#emp_tel').val();
                  var emp_stuBranch = $('#emp_stuBranch').val();
                  if (emp_comName != '' && emp_comLoc != '' && emp_tel != '' && emp_stuBranch != '') {
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