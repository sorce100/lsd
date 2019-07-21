<?php 
include("header.php");
      require_once("Classes/Members.php");
      $objMembers = new Members();
      $memberData = $objMembers->get_member_by_userId();
      foreach ($memberData as $row) {
        $firstName = trim($row["first_name"]);
        $lastName = trim($row["last_name"]);
        $otherName = trim($row["other_name"]); 
        $personalContact = trim($row["personal_contact"]);
        $emergencyContact = trim($row["emergency_contact"]);
        $houseNumber = trim($row["house_number"]);
        $houseLocation = trim($row["house_location"]);
        $postalAddress = trim($row["postal_address"]);
        $professionalNumber = trim($row["professional_number"]);
        $surveyorType = trim($row["surveyor_type"]);
        $designation = trim($row["designation"]);
        $companyName = trim($row["company_name"]);
        $companyType = trim($row["company_type"]);
        $companyContact = trim($row["company_contact"]);
        $corporateEmail = trim($row["corporate_email"]);
        $region = trim($row["region"]);
        $officeLocation = trim($row["office_location"]);
        $companyAddress = trim($row["company_address"]);
      }
?>

 <div class="row">
  <h3 class="box-title">MEMBER PROFILE PAGE</h3>
  <div class="col-md-3">
    <div class="white-box well">
      <img src="../plugins/images/avatar.png" alt="user-img" width="400em" class="img img-responsive img-thumbnail">
    </div>
  </div>

    <div class="col-md-9">
        <div class="white-box">
                <form id="insert_form" action="scripts/admin_members_save.php"  method="POST">
                      <fieldset>
                        <center><h2><u>Personal Details</u></h2></center>
                            <div class="row">
                                <!-- firstname -->
                              <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="firstName">FIRST NAME</label>
                                      <input type="text" class="form-control tcal" id="firstName" name="firstName" autocomplete="off" value="<?php if(isset($firstName)){echo $firstName;}?>">
                                    </div>
                              </div>
                              <!-- lastname -->
                              <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="lastName">LAST NAME</label>
                                      <input type="text" class="form-control tcal" id="lastName" name="lastName" autocomplete="off" value="<?php if(isset($lastName)){echo $lastName;}?>">
                                    </div>
                              </div>
                              <!-- othername -->
                              <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="otherName">OTHER NAME</label>
                                      <input type="text" class="form-control tcal" id="otherName" name="otherName" autocomplete="off" value="<?php if(isset($otherName)){echo $otherName;}?>"> 
                                    </div>
                              </div>
                            </div>
                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="personalContact">PHONE NUMBER</label>
                                <input type="text" class="form-control" id="personalContact" name="personalContact" autocomplete="off" value="<?php if(isset($personalContact)){echo $personalContact;}?>"> 
                              </div>
                          </div>
                          <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="emergencyContact">CONTACT INCASE OF EMERGENCY</label>
                                      <input type="text" class="form-control" id="emergencyContact" name="emergencyContact"  autocomplete="off" value="<?php if(isset($emergencyContact)){echo $emergencyContact;}?>">
                                    </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label for="houseNumber">HOUSE NUMBER</label>
                                <input type="text" class="form-control" id="houseNumber" name="houseNumber" autocomplete="off" value="<?php if(isset($houseNumber)){echo $houseNumber;}?>">
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="houseLocation">LOCATION OF HOUSE</label>
                                 <textarea rows="6" class="form-control" id="houseLocation" name="houseLocation"><?php if(isset($houseLocation)){echo $houseLocation;}?></textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="postalAddress">POSTAL ADDRESS</label>
                                <textarea rows="6" class="form-control" id="postalAddress" name="postalAddress"><?php if(isset($postalAddress)){echo $postalAddress;}?></textarea>
                              </div>
                            </div>
                          </div><br>
                          <!-- buttons -->
                         <input type="button" class="next btn-info btn-block" value="Next" />
                      </fieldset>

                        <fieldset>
                        <center><h2><u>GhIS LSD DETAILS</u></h2></center>
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="professionalNumber">PROFESSIONAL NUMBER</label>
                                      <input type="text" class="form-control" id="professionalNumber" name="professionalNumber" autocomplete="off" value="<?php if(isset($professionalNumber)){echo $professionalNumber;}?>" readonly>
                                  </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="surveyorType">TYPE OF SURVEYOR</label>
                                        <select name="surveyorType" id="surveyorType" class="form-control" readonly>
                                          <?php   
                                                if (isset($surveyorType )) {
                                                       echo '<option value="'.$surveyorType.'">'.$surveyorType.'</option>';
                                                }
                                           ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="designation">DESIGNATION</label>
                                        <select name="designation" id="designation" class="form-control" readonly>
                                          <?php   
                                                if (isset($designation )) {
                                                       echo '<option value="'.$designation.'">'.$designation.'</option>';
                                                }
                                           ?>
                                        </select>
                                    </div> 
                                </div>
                            </div><br>
                          <!-- buttons -->
                          <input type="button" name="previous" class="previous btn-info btn-block" value="Previous" /><br>
                          <input type="button" name="next" class="next btn-danger btn-block" value="Next" />
                        </fieldset>

                        <fieldset>
                          <center><h2><u>COMPANY DETIALS</u></h2></center>
                            <div class="row">
                              <div class="col-md-7">
                                <div class="form-group">
                                <label for="companyName">COMPANY NAME</label>
                                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter Company Name" autocomplete="off" value="<?php if(isset($companyName)){echo $companyName;}?>">
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                    <label for="companyType">TYPE OF COMPANY</label>
                                    <select name="companyType" id="companyType" class="form-control">
                                       <?php   
                                                if (isset($companyType )) {
                                                      echo '<option value="'.$companyType.'">'.$companyType.'</option>';
                                                }
                                           ?>
                                      <option></option>
                                      <option value="PUBLIC SERVICE">PUBLIC SERVICE</option>
                                      <option value="CIVIL SERVICE">CIVIL SERVICE</option>
                                      <option value="PRIVATE">PRIVATE</option>
                                      <option value="SELF EMPLOYED">SELF EMPLOYED</option>
                                    </select>
                                </div> 
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="companyContact">COMPANY CONTACT NUMBER</label>
                                <input type="text" class="form-control" name="companyContact" id="companyContact" placeholder="Enter company contact number" autocomplete="off" value="<?php if(isset($companyContact)){echo $companyContact;}?>">
                               </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="corporateEmail">CORPORATE EMAIL</label>
                                <input type="email" class="form-control" name="corporateEmail" id="corporateEmail" placeholder="Enter Phone number" autocomplete="off" value="<?php if(isset($corporateEmail)){echo $corporateEmail;}?>">
                              </div>
                            </div>
                          </div>
                            <div class="row">
                              <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="roles">REGION</label>
                                            <select name="region" class="form-control" autocomplete="off" id="region">
                                               <?php   
                                                if (isset($region )) {
                                                      echo '<option value="'.$region.'">'.$region.'</option>';
                                                }
                                           ?>
                                               <option></option>
                                               <option value="Greater Accra">Greater Accra</option>
                                               <option value="Eastern">Eastern</option>
                                               <option value="Ashanti">Ashanti</option>
                                               <option value="Western">Western</option>
                                               <option value="Central">Central</option>
                                               <option value="Volta">Volta</option>
                                               <option value="Northern">Northern</option>
                                               <option value="Upper West">Upper West</option>
                                              <option value="Upper East">Upper East</option>
                                            </select>
                                      </div>
                                  </div>
                          </div>

                            <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="officeLocation">LOCATION OF OFFICE</label>
                                     <textarea rows="6" class="form-control" name="officeLocation" id="officeLocation" placeholder="Enter Directions to the company"><?php if(isset($officeLocation)){echo $officeLocation;}?></textarea>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="companyAddress"> COMPANY POSTAL ADDRESS</label>
                                    <textarea rows="6" class="form-control" name="companyAddress" id="companyAddress" placeholder="Enter postal address of company"><?php if(isset($companyAddress)){echo $companyAddress;}?></textarea>
                                  </div>
                                </div>
                          </div><br>
                              <input type="hidden" name="mode" id="mode" value="profileUpdate">
                            <!-- buttons -->
                             <input type="button" name="previous" class="previous btn-info btn-block" value="Previous" /><br>
                             <input type="submit" name="submit" id="save_btn" class="submit btn-success btn-block" value="Submit" />
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
    </div>
</div>
    <!-- /.row -->
<?php include("footer.php");?>
 <script>  
      $(document).ready(function(){
        $("#insert_form").on("submit",function(e){
          e.preventDefault();
           if (confirm("ARE YOU SURE YOU WANT TO UPDATE YOUR PROFILE?")) {
                $.ajax({
                url:"Script/members.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                  $('#save_btn').val("Updating records ...");  
                },
                success:function(data){  
                  window.location.replace("profile.php");
                } 

                });
            }else{
                return false;
              }  
        });
      });
 </script>