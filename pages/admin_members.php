<?php 
  include("header.php");
  require_once("Classes/Members.php");
?>
<style type="text/css">
  #insert_form fieldset:not(:first-of-type) {
    display: none;
    }
  textarea{
    resize: none;
        }
  </style>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">GhIS LSD MEMBERS PAGE</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
              
              <!-- for search -->
              <div class="col-md-10 col-sm-10 col-xs-10">
                <form>
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="searchInput" autocomplete="off">
                    <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                  </div>
                 </form>
              </div>
              <!-- for add button -->
              <div class="col-md-2 col-sm-2 col-xs-2">
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD MEMBER</button>
              </div>
            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">GhIS DIP NO</th>
                            <th scope="col">FIRST NAME</th>
                            <th scope="col">LAST NAME</th>
                            <th scope="col">SURVEYOR TYPE</th>
                            <th scope="col">DESIGNATION</th>
                            <th scope="col">REGION</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                        <?php
                          $objMembers = new Members();
                          $members = $objMembers->get_members(); 
                          foreach ($members as $member) {
                              // $data = json_encode($member,true);
                                  echo "
                                      <tr>
                                        <td>".$member["professional_number"]."</td>
                                        <td>".$member["first_name"]."</td>
                                        <td>".$member["last_name"]."</td>
                                        <td>".$member["surveyor_type"]."</td>
                                        <td>".$member["designation"]."</td>
                                        <td>".$member["region"]."</td>
                                        <td>
                                          <input type='button' name='view' value='Update' id='".trim($member["members_id"])."' class='btn btn-info btn-xs update_data' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Delete' id='".trim($member["members_id"])."' class='btn btn-danger btn-xs del_data' />
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

   <!-- for save modal -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
<button type="button" class="close" data-dismiss="modal"  aria-label="Close" id="close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h3 class="modal-title" align="center"><center><b><u id="subject">ADD NEW MEMBER</u></b></center></h3>
      </div>
      <div class="modal-body" id="bg">


 <form id="insert_form" method="POST">
  <fieldset>
    <center><h2>Step 1: Personal Details</h2></center>
        <div class="row">
            <!-- firstname -->
          <div class="col-md-4">
                <div class="form-group">
                  <label for="firstName">FIRST NAME</label>
                  <input type="text" class="form-control tcal" id="firstName" name="firstName" autocomplete="off" placeholder="Enter first name">
                </div>
          </div>
          <!-- lastname -->
          <div class="col-md-4">
                <div class="form-group">
                  <label for="lastName">LAST NAME</label>
                  <input type="text" class="form-control tcal" id="lastName" name="lastName" autocomplete="off" placeholder="Enter last name"> 
                </div>
          </div>
          <!-- othername -->
          <div class="col-md-4">
                <div class="form-group">
                  <label for="otherName">OTHER NAME</label>
                  <input type="text" class="form-control tcal" id="otherName" name="otherName" autocomplete="off" placeholder="Enter other names">
                </div>
          </div>
        </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="personalContact">PHONE NUMBER</label>
            <input type="number" class="form-control" id="personalContact" name="personalContact" autocomplete="off" placeholder="Enter personal contact">
          </div>
      </div>
      <div class="col-md-6">
                <div class="form-group">
                  <label for="emergencyContact">CONTACT INCASE OF EMERGENCY</label>
                  <input type="number" class="form-control" id="emergencyContact" name="emergencyContact"  autocomplete="off" placeholder="Enter emergency contact">
                </div>
          </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
            <label for="houseNumber">HOUSE NUMBER</label>
            <input type="text" class="form-control" id="houseNumber" name="houseNumber" autocomplete="off" placeholder="Enter house number">
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="houseLocation">LOCATION OF HOUSE</label>
             <textarea rows="6" class="form-control" id="houseLocation" name="houseLocation" placeholder="Enter Directions to members' house"></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="postalAddress">POSTAL ADDRESS</label>
            <textarea rows="6" class="form-control" id="postalAddress" name="postalAddress" placeholder="Enter member postal address"></textarea>
          </div>
        </div>
      </div><br>
      <!-- buttons -->
     <input type="button" class="next btn-info btn-block" value="Next" />
  </fieldset>

    <fieldset>
    <center><h2>STEP 2: GhIS LSD DETAILS</h2></center>
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <label for="professionalNumber">PROFESSIONAL NUMBER</label>
                  <input type="text" class="form-control" id="professionalNumber" name="professionalNumber" placeholder="Enter member professional number" autocomplete="off">
              </div>
            </div>  
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="surveyorType">TYPE OF SURVEYOR</label>
                    <select name="surveyorType" class="form-control" id="surveyorType">
                      <option></option>
                      <!-- LISTING ALL SURVEYOR TYPES FROM THE SURYORS TABLE -->
                        <?php 
                              require_once("Classes/Surveyor.php");
                              $objSurveyor = new Surveyor;
                              $types =  $objSurveyor->get_surveyorTypes();

                              foreach ($types as $type) {
                                echo ' <option value="'.$type["surveyor_type"].'">'.$type["surveyor_type"].'</option>';
                              }
                         ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                    <label for="designation">DESIGNATION</label>
                    <select name="designation" class="form-control" id="designation">
                      <option></option>
                      <option value="FGhIS">FGhIS</option>
                      <option value="MGhIS">MGhIS</option>
                      <option value="TechGhIS">TechGhIS</option>
                      <option value="Others">Others</option>
                    </select>
                </div> 
            </div>
        </div><br>
      <!-- buttons -->
      <input type="button" name="previous" class="previous btn-info btn-block" value="Previous" /><br>
      <input type="button" name="next" class="next btn-danger btn-block" value="Next" />
    </fieldset>

    <fieldset>
      <center><h2>STEP 3: COMPANY DETIALS</h2></center>
        <div class="row">
          <div class="col-md-7">
            <div class="form-group">
            <label for="companyName">COMPANY NAME</label>
            <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter Company Name" autocomplete="off">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
                <label for="companyType">TYPE OF COMPANY</label>
                <select name="companyType" class="form-control" id="companyType">
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
            <input type="number" class="form-control" name="companyContact" id="companyContact" placeholder="Enter company contact number" autocomplete="off">
           </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="corporateEmail">CORPORATE EMAIL</label>
            <input type="email" class="form-control" name="corporateEmail" id="corporateEmail" placeholder="Enter Phone number" autocomplete="off">
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-md-12">
                <div class="form-group">
                    <label for="roles">REGION</label>
                        <select name="region" class="form-control" autocomplete="off" id="region">
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
                 <textarea rows="6" class="form-control" name="officeLocation" id="officeLocation" placeholder="Enter Directions to the company"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="comapanyAddress"> COMPANY POSTAL ADDRESS</label>
                <textarea rows="6" class="form-control" name="comapanyAddress" id="comapanyAddress" placeholder="Enter postal address of company"></textarea>
              </div>
            </div>
      </div><br>
          <!-- for insert query -->
          <input type="hidden" name="mode" id="mode" value="insert">
          <!-- hide id -->
          <input type="hidden" name="data_id" id="data_id" value="">
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
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- update modal -->
<div id="updateModal" class="modal fade">  
      <div class="modal-dialog modal-lg">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title"><center><b><u>UPDATE MEMBER DETAILS</u></b></center></h4>  
                </div>  
                <div class="modal-body" id="update_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>

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
  <?php include("footer.php");?>
 <script>  
      $(document).ready(function(){
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD NEW MEMBER");
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
                $.ajax({
                url:"Script/members.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                     // $('#employee_detail').html(data); 
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      // window.location.replace("admin_members.php");
                       $("#myModal").modal("hide");
                     }
                     else if(data == "error"){
                     
                     }
                } 

                });  
            });



        // for update
        $('.update_data').click(function(){ 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/members.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // alert(jsonObj[0].first_name);
                     // changing modal title
                     $("#subject").html("UPDATE MEMBER DETAILS");
                    $("#firstName").val(jsonObj[0].first_name);
                    $("#lastName").val(jsonObj[0].last_name);
                    $("#otherName").val(jsonObj[0].other_name);
                    $("#personalContact").attr("type","text");
                    $("#personalContact").val(jsonObj[0].personal_contact);
                    $("#emergencyContact").attr("type","text");
                    $("#emergencyContact").val(jsonObj[0].emergency_contact);
                    $("#houseNumber").val(jsonObj[0].house_number);
                    $("#houseLocation").val(jsonObj[0].house_location);
                    $("#postalAddress").val(jsonObj[0].postal_address);
                    $("#professionalNumber").val(jsonObj[0].professional_number);
                    $("#surveyorType").val(jsonObj[0].surveyor_type);
                    $("#designation").val(jsonObj[0].designation);
                    $("#companyName").val(jsonObj[0].comapany_name);
                    $("#companyType").val(jsonObj[0].company_type);
                    $("#companyContact").attr("type","text");
                    $("#companyContact").val(jsonObj[0].company_contact);
                    $("#corporateEmail").val(jsonObj[0].corporate_email);
                    $("#region").val(jsonObj[0].region);
                    $("#officeLocation").val(jsonObj[0].office_location);
                    $("#comapanyAddress").val(jsonObj[0].company_address);
                    $("#data_id").val(jsonObj[0].members_id);
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
                      url:"Script/members.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          
                      }  
                     }); 

               }else{
                return false;
              }  
          });

          })  
 </script>