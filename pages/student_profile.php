<?php 
include("header.php");
      require_once("Classes/Student.php");
      $objStudent = new Student();
      $studentsData = $objStudent->get_student_by_userId();
      foreach ($studentsData as $studentData) {
        $studentTitle = trim($studentData["student_title"]);
        $studentFirstName = trim($studentData["student_first_name"]);
        $studentLastName = trim($studentData["student_last_name"]);
        $studentEmail = trim($studentData["student_email"]); 
        $studentDob = trim($studentData["student_dob"]);
        $studentTel = trim($studentData["student_tel"]);
        $studentEmergencyTel = trim($studentData["student_emergency_tel"]);
        $studentPostalAddress = trim($studentData["student_post_address"]);
        $studentHouseNum = trim($studentData["student_house_num"]);
        $StudentHouseLoc = trim($studentData["student_house_location"]);
      }
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">APPLICANT PROFILE PAGE </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <!-- content -->
            <div class="col-md-12">
              <form id="insert_form" >
                        <center><h2><u>Applicant Personal Details</u></h2></center>
                          <div class="row">
                            <!-- student title -->
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="studentTitle">TITLE</label>
                                <select class="form-control" name="studentTitle" id="studentTitle" required>
                                  <option  disabled selected><?php if(isset($studentTitle)){echo $studentTitle;}?></option>
                                  <option value="Mr">Mr</option>
                                  <option value="Mrs">Mrs</option>
                                  <option value="Miss">Miss</option>
                                  <option value="Dr">Dr</option>
                                  <option value="Prof">Prof</option>
                                </select>
                              </div>
                            </div>
                              <!-- firstname -->
                            <div class="col-md-5">
                                  <div class="form-group">
                                    <label for="studentFirstName">FIRST NAME</label>
                                    <input type="text" class="form-control tcal" id="studentFirstName" name="studentFirstName" autocomplete="off" value="<?php if(isset($studentFirstName)){echo $studentFirstName;}?>" required>
                                  </div>
                            </div>
                            <!-- lastname -->
                            <div class="col-md-5">
                                  <div class="form-group">
                                    <label for="studentLastName">LAST NAME</label>
                                    <input type="text" class="form-control tcal" id="studentLastName" name="studentLastName" autocomplete="off" value="<?php if(isset($studentLastName)){echo $studentLastName;}?>" required>
                                  </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group">
                                    <label for="studentDob">DATE OF BIRTH</label>
                                    <input type="text" class="form-control" id="studentDob" name="studentDob" data-toggle="datepicker" value="<?php if(isset($studentDob)){echo $studentDob;}?>" required readonly>
                                  </div>
                            </div>
                            <div class="col-md-7">
                              <div class="form-group">
                                    <label for="studentEmail">EMAIL</label>
                                    <input type="text" class="form-control tcal" id="studentEmail" name="studentEmail" autocomplete="off" value="<?php if(isset($studentEmail)){echo $studentEmail;}?>" required>
                                  </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="studentTel">PHONE NUMBER</label>
                                <input type="text" class="form-control" id="studentTel" name="studentTel" autocomplete="off" value="<?php if(isset($studentTel)){echo $studentTel;}?>" required> 
                              </div>
                          </div>
                          <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="studentEmergencyTel">CONTACT INCASE OF EMERGENCY</label>
                                      <input type="text" class="form-control" id="studentEmergencyTel" name="studentEmergencyTel"  autocomplete="off" value="<?php if(isset($studentEmergencyTel)){echo $studentEmergencyTel;}?>" required>
                                    </div>
                              </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                                <div class="form-group">
                                <label for="studentPostalAddress">POSTAL ADDRESS</label>
                                <input type="text" class="form-control" id="studentPostalAddress" name="studentPostalAddress" autocomplete="off" value="<?php if(isset($studentPostalAddress)){echo $studentPostalAddress;}?>" required>
                              </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="studentHouseNum">HOUSE NUMBER</label>
                                <input type="text" class="form-control" id="studentHouseNum" name="studentHouseNum" autocomplete="off" value="<?php if(isset($studentHouseNum)){echo $studentHouseNum;}?>" required>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="StudentHouseLoc">LOCATION OF HOUSE</label>
                                 <textarea rows="4" class="form-control" id="StudentHouseLoc" name="StudentHouseLoc" required><?php if(isset($StudentHouseLoc)){echo $StudentHouseLoc;}?></textarea>
                              </div>
                            </div>
                          </div><br>
                              <input type="hidden" name="mode" id="mode" value="profileUpdate">
                            <!-- buttons -->
                             <button type="submit" class="btn btn-block btn-info" id="save_btn">UPDATE RECORDS <i class="fa fa-save"></i></button>
                      </form>
            </div>
            <!-- end of content -->
        </div>
    </div>
</div>
<!--  -->

    <!-- /.row -->
<?php include("footer.php");?>
 <script>  
      $(document).ready(function(){
        $('#insert_form').parsley();
        // for date time picker
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
           if (confirm("ARE YOU SURE YOU WANT TO UPDATE YOUR PROFILE?")) {
                $.ajax({
                url:"Script/student.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                  $('#save_btn').text("Updating records ...");  
                },
                success:function(data){  
                  // alert(data);
                  window.location.replace("student_profile.php");
                } 

                });
            }else{
                return false;
              }  
        });
      });
 </script>