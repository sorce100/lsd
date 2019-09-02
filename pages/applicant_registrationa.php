<?php 
ob_start();
include("header.php");

if ($_SESSION['account_type'] !== "student") {
  header("Location:dashboard.php");
}
require_once("Classes/Division.php");
require_once("Classes/NewApplication.php");
require_once("Classes/Members.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">NEW MEMBER REGISTRATION</div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <!-- for search -->
            <div class="col-md-12">
              <!-- content -->
              <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="newapptab">
                  <a href="#sectionA">
                    <h4 class="list-group-item-heading"><b>SECTION A</b></h4><br>
                    <p class="list-group-item-text">Start application processing</p>
                  </a>

                </li>
                <li class="newapptab">
                  <a href="#sectionB">
                    <h4 class="list-group-item-heading"><b>SECTION B</b></h4><br>
                    <p class="list-group-item-text">College Principal Declaration</p>
                  </a>
                </li>
                <li class="newapptab">
                  <a href="#sectionC">
                    <h4 class="list-group-item-heading"><b>SECTION C</b></h4><br>
                    <p class="list-group-item-text">Trainer / Employer Declaration</p>
                  </a>
                </li>
                <li class="newapptab">
                  <a href="#sectionD">
                    <h4 class="list-group-item-heading"><b>SECTION D</b></h4><br>
                    <p class="list-group-item-text">Proposers Declaration (Fellows Only)</p>
                  </a>
                </li>
                <li class="newapptab">
                  <a href="#sectionE">
                    <h4 class="list-group-item-heading"><b>SECTION E</b></h4><br>
                    <p class="list-group-item-text">Submit For Approval</p>
                  </a>
                </li>
              </ul>

            </div>

            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <h2><b>SECTION A STATUS</b></h2>
                    <!-- check if application has started nor not -->
                    <?php 
                      $objNewApplication = new NewApplication;
                      $startStatus = $objNewApplication->check_application_start();
                      if (empty($startStatus)) {
                          echo '<button id="startBtn" class="btn btn-danger btn-lg">Start Application <i class="glyphicon glyphicon-thumbs-up"></i></button>';
                      }
                      else if(!empty($startStatus)){
                          echo '<h3>APPLICATION STARTED, PENDING DECLARATIONS <span class="glyphicon glyphicon-ok" style="color:green;"></span></h3>';
                      }
                     ?>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-md-12 well">
                    <h2 class="text-center"><b> SECTION B STATUS </b></h2>
                    <?php 
                      $objNewApplication = new NewApplication;
                      $startStatus = $objNewApplication->check_declarations("col_declare_date");
                      if (empty($startStatus)) {
                          echo '<h3 class="text-center">NO DECLARATIONS <span class="glyphicon glyphicon-remove" style="color:red;"></span></h3>';
                      }
                      else if(!empty($startStatus)){
                          echo '<h3 class="text-center">APPROVED, DECLARATION SUCCESSFUL <span class="glyphicon glyphicon-ok" style="color:green;"></span></h3>';
                      }
                     ?>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-md-12 well">
                    <h2 class="text-center"><b> SECTION C STATUS </b></h2>
                    <?php 
                      $objNewApplication = new NewApplication;
                      $startStatus = $objNewApplication->check_declarations("emp_declare_date");
                      if (empty($startStatus)) {
                          echo '<h3 class="text-center">NO DECLARATIONS <span class="glyphicon glyphicon-remove" style="color:red;"></span></h3>';
                      }
                      else if(!empty($startStatus)){
                          echo '<h3 class="text-center">APPROVED, DECLARATION SUCCESSFUL <span class="glyphicon glyphicon-ok" style="color:green;"></span></h3>';
                      }
                     ?>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-md-12 well">
                    <h2 class="text-center"><b> SECTION D STATUS </b></h2>
                    <?php 
                      $objNewApplication = new NewApplication;
                      $startStatus = $objNewApplication->check_declarations("member_declare_date");
                      if (empty($startStatus)) {
                          echo '<h3 class="text-center">NO DECLARATIONS <span class="glyphicon glyphicon-remove" style="color:red;"></span></h3>';
                      }
                      else if(!empty($startStatus)){
                          echo '<h3 class="text-center">APPROVED, DECLARATION SUCCESSFUL <span class="glyphicon glyphicon-ok" style="color:green;"></span></h3>';
                      }
                     ?>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-md-12 well">
                    <h2 class="text-center"><b> SECTION E STATUS </b></h2>
                    <?php 
                      $objNewApplication = new NewApplication;
                      $completionStatus = $objNewApplication->check_declarations_completion();
                      if ($completionStatus == "COMPLETE") {
                          echo '<button id="completeReviewBtn" class="btn btn-danger btn-md" style="margin-left:41%;">SUBMIT FOR APPROVAL</button>';
                      }
                      elseif ($completionStatus == "INCOMPLETE") {
                          echo '<h3 class="text-center">APPLICATION PENDING <span class="glyphicon glyphicon-remove" style="color:red;"></span></h3>';
                      }
                     ?>
                </div>

            <!-- end of content -->
        </div>
    </div>
</div>
<!--  -->

<!-- Modal to show when page loads up -->
  <div class="modal fade" id="onloadModal" role="dialog">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center><h2 class="modal-title"><b style="color: red;"><u>REQUIREMENT FOR ENROLMENT AS A TRAINEE PROFESSIONAL SURVEYOR</u></b></h2></center>
       </div>
       <div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
             <ol>
               <li>
                 In the event of having to sit for any of the Examinations/Test of Professional/Technical Competence of the Institution, I desire to present myself in due course for scollegeEmailame.
               </li><br>
               <li>
                 undertake to pay both the Registration Fee and Annual Subscriptions on enrolment as a Trainee Professional Surveyor. On being admitted as a Trainee Professional Surveyor and in consideration thereof, I promise to abide by the Constitution, Bye-Laws, Rules of Conduct (Regulations) and Code of Ethics of the Ghana Institution of Surveyors.
               </li><br>
               <li>
                 <b>Upload a copy of your Curriculum Vitae in pdf or doc format.</b>
               </li><br>
               <li>
                 <b>Provide College and Trainer/Employer email addresses respectively for application completion.</b>
               </li>
             </ol>
            </div>
          </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
       </div>
     </div>
   </div>
 </div> 


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">NEW MEMBER REGISTRATION APPLICATION</b></h4>
      </div>
      <div class="modal-body" id="bg">
        <form id="insert_form"  method="POST" enctype="multipart/form-data">
          <!--  -->
            <br>
            <div class="row">
              <div class="form-section">
                <div class="col-md-2">
                  <label>Select Division <span class="asterick">*</span></label>
                </div>
                <div class="col-md-10">
                  <select class="form-control" name="applicationDiv" id="applicationDiv" required>
                    <option selected disabled>Please Select</option>
                    <!-- grab the divisions fullname -->
                    <?php 
                        $objDivision = new Division;
                        $divisions = $objDivision->get_divisions(); 
                        foreach ($divisions as $division) {
                          echo "<option value=".$division["division_id"].">".$division["division_alias"]."</option>";
                        }
                      ?>
                  </select>
                </div>
              </div>
            </div>
            <!--  -->
            <div class="row">
              <div class="form-section">
                <center><h2><u>SECTION A</u></h2></center>
                <div class="col-md-12">
                  <h4>
                    <span class="asterick">*</span> Upload Certified True Copies of relevant Certificates. <u><b>Without the said Certified copies, your application will not be considered</b> <span class="asterick">(PDF and doc only)</span></u>
                  </h4>
                </div>
                <br>
                <div class="col-md-12">
                  <div class="table-responsive">  
                     <table class="table" id="dynamic_field">  
                      <tr>  
                          <td width="10%">
                            <button type="button" name="add" id="add" class="btn btn-danger">ADD NEW DOCUMENT</button>
                          </td>
                          <td width="60%">
                            <input type="text" name="certIssuer[]" autocomplete="off" placeholder="Enter name of Cert issuer" class="form-control certIssuer" required/>
                          </td>
                          <td width="30%">
                            <input type="file" name="certFiles[]"  class="form-control certFiles" required/>
                          </td>  
                      </tr>  
                     </table>  
                  </div>
                </div>
              </div>
            </div>
            <!--  -->
            <div class="form-section">
              <center><h2><u>SECTION A (DECLARATIONS REQUESTS)</u></h2></center>
              <hr>
              <div class="row">
                <div class="col-md-3">
                  <label>COLLEGE EMAIL<span class="asterick">*</span></label>
                </div>
                <div class="col-md-9">
                  <input type="email" class="form-control" id="collegeEmail" placeholder="eg: schoolemail@gmail.com &hellip;" name="collegeEmail" autocomplete="off" required>
                </div>
              </div>

              <hr>

              <!--  -->
              <div class="row">
                <div class="col-md-3">
                  <label>EMPLOYER/TRAINER EMAIL <span class="asterick"> *</span></label>
                </div>
                <div class="col-md-9">
                  <input type="email" class="form-control" id="employerEmail" placeholder="eg: employeremail@gmail.com &hellip;" name="employerEmail" autocomplete="off" required>
                </div>
              </div>
              <!--  -->
              <hr>

              <div class="row">
                <div class="col-md-3">
                  <label>SELECT PROPOSER (FELLOW) <span class="asterick">*</span></label>
                </div>
                <div class="col-md-9">
                  <select class="form-control selectFellowSelect2" style="width: 100%;" name="memberDeclare_id" id="memberDeclare_id" required>  
                    <option selected disabled>Please Select</option>
                    <?php 
                      $objMembers = new Members();
                      foreach ($objMembers->get_fghis_members() as $member) {
                        echo "<option value=".trim($member["professional_number"]).">".trim($member["first_name"])." ".trim($member["last_name"])."   (".trim($member["professional_number"]).")</option>";
                      }
                     ?>
                  </select>
                </div>
              </div>

              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-3">
                  <label>ADD NOTE FOR PROPOSER</label>
                </div>
                <div class="col-md-9">
                  <textarea rows="5" class="form-control" name="memberDeclare_note" id="memberDeclare_note" placeholder="Add any note to FELLOW"></textarea>
                </div>
              </div>

            <!-- progress bar -->
            <hr>
            <div class="row">
              <div class="col-md-12">
                <!--for progress modal  -->
                <div class="progress">
                  <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;height: 50px;"> 0% </div>
                </div>
              </div>
            </div>

          </div>
            <!--  -->
            <input type="hidden" name="mode" value="insertA"> 
            <span class="clearfix"></span>
            <br>
            <div class="modal-footer">
                <div class="form-navigation">
                    <button type="button" class="previous btn btn-danger pull-left"><i class="fa fa-arrow-left"></i> Previous</button>
                    <button type="button" class="next btn btn-info pull-right">Next <i class="fa fa-arrow-right"></i></button>
                    <!-- <input type="submit" class="btn btn-default pull-right"> -->
                    <button type="submit" id="save_btn" class="btn btn-success pull-right"> Start Application <i class="fa fa-send"></i></button>
                    <span class="clearfix"></span>
                  </div>
              </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- /.row -->
 <div class="modal fade" id="sectionEModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">NEW MEMBER APPLICATION DETAILS</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
        <form> 
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                          <td width="30%"><b>APPLICANT START DATE</b></td>
                          <td width="30%" id="startDate"></td>
                        </tr>
                        <tr>
                          <td><b>COLLEGE DECLARATION DATE</b></td>
                          <td id="colDeclareDate"></td>
                        </tr>
                        <tr>
                          <td><b>EMPLOYER DECLARATION DATE</b></td>
                          <td id="empDeclareDate"></td>
                        </tr>
                        <tr>
                          <td><b>PROPOSER DECLARATION DATE</b></td>
                          <td id="proposerDeclareDate"></td>
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="proposerDeclare">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="submitApproval" class="btn btn-success btn-block" value="SUBMIT APPLICATION FOR APPROVAL" />
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <!-- /.row -->
<?php include('footer.php') ?>
<!-- multistep modal -->
<script>
$(document).ready(function(){
  // reset progress bar
  $('#progressBar').prop('aria-valuemax',0).css('width',0 + '%').text(0 + '%');

  // for multistep
  $(function () {
      var $sections = $('.form-section');

      function navigateTo(index) {
        // Mark the current section with the class 'current'
        $sections
          .removeClass('current')
          .eq(index)
            .addClass('current');
        // Show only the navigation buttons that make sense for the current section:
        $('.form-navigation .previous').toggle(index > 0);
        var atTheEnd = index >= $sections.length - 1;
        $('.form-navigation .next').toggle(!atTheEnd);
        $('.form-navigation [type=submit]').toggle(atTheEnd);
      }

      function curIndex() {
        // Return the current index by looking at which section has the class 'current'
        return $sections.index($sections.filter('.current'));
      }

      // Previous button is easy, just go back
      $('.form-navigation .previous').click(function() {
        navigateTo(curIndex() - 1);
      });

      // Next button goes forward iff current block validates
      $('.form-navigation .next').click(function() {
        $('#insert_form').parsley().whenValidate({
          group: 'block-' + curIndex()
        }).done(function() {
          navigateTo(curIndex() + 1);
        });
      });

      // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
      $sections.each(function(index, section) {
        $(section).find(':input').attr('data-parsley-group', 'block-' + index);
      });
      navigateTo(0); // Start at the beginning
    });
////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // $('.table').DataTable().destroy();

    $('#onloadModal').modal('show');
    
    $('#startBtn').click(function(){
      $('#myModal').modal('show');
    });

    $(".selectFellowSelect2").select2({
      dropdownParent: $("#myModal")
    });

    $("#insert_form").on("submit",function(e){
      e.preventDefault();
      if (confirm("ARE YOU SURE YOU WANT TO SAVE AND START APPLICATION?")) {
        // check if division id not empty and files is not empty
          var division = $("#applicationDiv").val();
          var certIssuer = $('.certIssuer').val();
          var trainerEmail = $('.trainerEmail').val();
          var employerEmail = $('.employerEmail').val();
          var memberDeclare_id = $('#memberDeclare_id').val();
          if (division != '' && certIssuer != '' && trainerEmail != '' && employerEmail != '' && memberDeclare_id != '') {
              $.ajax({
              // for progress bar
              xhr:function(){
                let xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress',function(e){
                  // check if upload length is true or false
                  if (e.lengthComputable) {
                    let uploadPercent = Math.round((e.loaded/e.total)*100);
                    // updating progress bar pecentage
                    $('#progressBar').prop('aria-valuemax',uploadPercent).css('width',uploadPercent + '%').text(uploadPercent + '%');
                  }
                });
                return xhr;
              },
              url:"Script/newApplication.php",
              method:"POST",
              enctype: 'multipart/form-data',
              data:new FormData(this),  
              contentType:false,  
              processData:false,
              beforeSend:function(){  
                $('#save_btn').text("Please wait.......").attr('disabled',true);  
              },
              success:function(data){
                toastr.success(' Successfull');
                $('#myModal').modal('hide');
                alert(data);  
                // console.log(data);  
                window.location.replace("applicant_registrationa.php");
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

// FOR CLICK TO ADD DOCUMENT NAMES AND UPLOADS
  var i=1;  
    $('#add').click(function(){  
         i++;  
         $('#dynamic_field').append('<tr id="row'+i+'"><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove X</button></td><td><input type="text" name="certIssuer[]" placeholder="Enter name of cert issuer" autocomplete="off" class="form-control certIssuer" /></td><td><input type="file" name="certFiles[]"  class="form-control certFiles" /></td></tr>');  
    });  
    $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#row'+button_id+'').remove();  
    });


// for showing section 3, submit for acceptance
  $('#completeReviewBtn').click(function(){
         var mode = "applicant_details_review"; 
         $.ajax({  
              url:"Script/newApplication.php",  
              method:"POST",  
              data:{mode:mode},  
              success:function(data){
                  var jsonObj = JSON.parse(data);  
                  $("#startDate").html(jsonObj["application_startDate"]);
                  $("#colDeclareDate").html(jsonObj["col_declare_date"]);
                  $("#empDeclareDate").html(jsonObj["emp_declare_date"]);
                  $("#proposerDeclareDate").html(jsonObj["member_declare_date"]);
                  $("#data_id").val(jsonObj["new_application_id"]);
                  $('#sectionEModal').modal('show');
              }  
          });
      
     });

// submit for appoval
 $('#submitApproval').click(function(){
    if (confirm("ARE YOU SURE YOU WANT TO SAVE AND START APPLICATION?")) {
       var mode = "insertE"; 
       var data_id = $("#data_id").val();
       $.ajax({  
            url:"Script/newApplication.php",  
            method:"POST",  
            data:{mode:mode,data_id:data_id},  
            success:function(data){
                alert(data);
                $('#sectionEModal').modal('hide');
            }  
        });
      }else{
        return false;
      }
        
  });

});
</script>