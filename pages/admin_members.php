<?php 
  include("header.php");
  require_once("Classes/Members.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">GhIS LSD MEMBERS PAGE </div>
            <div class="panel-title pull-right">
               <button data-toggle="modal" data-target="#addMemberModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD MEMBER</button>
            </div>
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
                                          <button type='button' id='".trim($member["members_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                        </td>
                                        <td>
                                          <button type='button' id='".trim($member["members_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
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

</div>


<!-- for adding new member -->
  <!-- Modal -->
  <div class="modal fade" id="addMemberModal" role="dialog">
    <div class="modal-dialog modal-xl">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"  aria-label="Close" id="close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
          <h4 class="modal-title" id="subject">Add New Members</h4>
        </div>

        <div class="modal-body">
          <form id="insert_form" method="POST">
            <!-- first step -->
            <div class="form-section">
              <h2>Step 1: Personal Details</h2>
              <br>
              <div class="row">
                <div class="col-md-2"><label>Name</label> <span class="asterick">*</span></div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control tcal" id="firstName" name="firstName" autocomplete="off" placeholder="Enter First Name &hellip;" required>
                  </div>
                </div>
                <div class="col-md-3">
                   <input type="text" class="form-control tcal" id="otherName" name="otherName" autocomplete="off" placeholder="Enter Middle Name &hellip;">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control tcal" id="lastName" name="lastName" autocomplete="off" placeholder="Enter Last Name &hellip;" required>
                </div>
              </div>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Tel No</label> <span class="asterick">*</span></div>
                <div class="col-md-4">
                  <input type="number" class="form-control" id="personalContact" name="personalContact" autocomplete="off" placeholder="Enter personal contact &hellip;" required>
                </div>
              </div>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Emergency Contact </label></div>
                <div class="col-md-4">
                 <input type="number" class="form-control" id="emergencyContact" name="emergencyContact"  autocomplete="off" placeholder="Enter emergency contact &hellip;">
                </div>
              </div>
              <hr>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>House Number</label></div>
                <div class="col-md-10">
                 <input type="text" class="form-control" id="houseNumber" name="houseNumber" autocomplete="off" placeholder="Enter house number  &hellip;">
                </div>
              </div>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>House Location</label></div>
                <div class="col-md-10">
                 <textarea rows="3" class="form-control" id="houseLocation" name="houseLocation" placeholder="Enter Directions to members' house &hellip;"></textarea>
                </div>
              </div>
              <hr>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Postal Address</label></div>
                <div class="col-md-10">
                 <textarea rows="3" class="form-control" id="postalAddress" name="postalAddress" placeholder="Enter Directions to members' house"></textarea>
                </div>
              </div>
            </div>
            <!-- second step -->
            <div class="form-section">
              <h2>STEP 2: GhIS LSD DETAILS</h2>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Professional Number <span class="asterick">*</span></label></div>
                <div class="col-md-10">
                 <input type="number" class="form-control" id="professionalNumber" name="professionalNumber" placeholder="Enter member professional number" autocomplete="off" required>
                </div>
              </div>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Surveyor Type <span class="asterick"> *</span></label></div>
                <div class="col-md-4">
                  <select name="surveyorType" class="form-control" id="surveyorType" required>
                      <option selected disabled>Please Select</option>
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
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Designation <span class="asterick">*</span></label></div>
                <div class="col-md-4">
                  <select name="designation" class="form-control" id="designation" required>
                      <option selected disabled>Please Select</option>
                      <option value="FGhIS">FGhIS</option>
                      <option value="MGhIS">MGhIS</option>
                      <option value="TechGhIS">TechGhIS</option>
                      <option value="Others">Others</option>
                    </select>
                </div>
              </div>
              <br>
            </div>
            <!-- third step -->
            <div class="form-section">
              <h2>STEP 3: COMPANY DETIALS</h2>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Company Name</label></div>
                <div class="col-md-10">
                 <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter Company Name" autocomplete="off">
                </div>
              </div>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Company Type</label></div>
                <div class="col-md-4" >
                   <select name="companyType" class="form-control" id="companyType">
                    <option disabled>Please Select</option>
                    <option value="PUBLIC SERVICE">PUBLIC SERVICE</option>
                    <option value="CIVIL SERVICE">CIVIL SERVICE</option>
                    <option value="PRIVATE">PRIVATE</option>
                    <option value="SELF EMPLOYED">SELF EMPLOYED</option>
                  </select>
                </div>
              </div>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Company Tel No</label></div> 
                <div class="col-md-10">
                  <div class="form-group">
                    <input type="number" class="form-control" name="companyContact" id="companyContact" placeholder="Enter company contact number &hellip;" autocomplete="off">
                   </div>
                </div>
              </div>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Company Email</label></div> 
                <div class="col-md-10">
                  <div class="form-group">
                    <input type="email" class="form-control" name="corporateEmail" id="corporateEmail" placeholder="Enter Phone number &hellip;" autocomplete="off">
                  </div>
                </div>
              </div>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Select Region</label></div> 
                <div class="col-md-4">
                  <div class="form-group">
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
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Office Location</label></div> 
                <div class="col-md-10">
                  <div class="form-group">
                     <textarea rows="3" class="form-control" name="officeLocation" id="officeLocation" placeholder="Enter Directions to the company &hellip;"></textarea>
                  </div>
                </div>
              </div>
              <br>
              <!--  -->
              <div class="row">
                <div class="col-md-2"><label>Office Postal</label></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea rows="3" class="form-control" name="comapanyAddress" id="comapanyAddress" placeholder="Enter postal address of company"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <!-- hide id -->
            <input type="hidden" name="data_id" id="data_id" value="">

            <br>
            <div class="modal-footer">
              <div class="form-navigation">
                  <button type="button" class="previous btn btn-danger pull-left"><i class="fa fa-arrow-left"></i> Previous</button>
                  <button type="button" class="next btn btn-info pull-right">Next <i class="fa fa-arrow-right"></i></button>
                  <!-- <input type="submit" class="btn btn-default pull-right"> -->
                  <button type="submit" id="save_btn" class="submit btn btn-success pull-right">Save <i class="fa fa-save"></i></button>
                  <span class="clearfix"></span>
                </div>
            </div>
          </form>
        </div>
      </div>
      
    </div>
  </div>

<?php include("footer.php");?>
 <script>  
      $(document).ready(function(){
        $(function () {
            let $sections = $('.form-section');

            function navigateTo(index) {
              // Mark the current section with the class 'current'
              $sections
                .removeClass('current')
                .eq(index)
                  .addClass('current');
              // Show only the navigation buttons that make sense for the current section:
              $('.form-navigation .previous').toggle(index > 0);
              let atTheEnd = index >= $sections.length - 1;
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



        // for reset modal when close
        $('#addMemberModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD NEW MEMBER");
            $("#insert_form")[0].reset();
            $('#save_btn').text("Save").prop('disabled',false);
            $('#insert_form').parsley().reset();
          });

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
              $.ajax({
              url:"Script/members.php",
              method:"POST",
              data:$("#insert_form").serialize(),
              beforeSend:function(){  
                  $('#save_btn').text("Please wait ...").prop('disabled',true);  
             },
              success:function(data){  
              console.log(data); 
                   $("#addMemberModal").modal("hide");
                   $("#insert_form")[0].reset();
                   if (data == "success") {
                    toastr.success(' Successfull');
                    $("#addMemberModal").modal("hide");
                   }
                   else if(data == "error"){
                    toastr.error('There was an error');
                   }
              } 

              });  
            });


        // for update
        $('.update_data').click(function(){ 
           let mode= "updateModal"; 
           let data_id = $(this).attr("id");  
           $.ajax({  
              url:"Script/members.php",  
              method:"POST",  
              data:{data_id:data_id,mode:mode},  
              success:function(data){
                 let jsonObj = JSON.parse(data);  
                 // alert(jsonObj[0].first_name);
                 // changing modal title
                 $("#subject").html("Update Member Details");
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
                $("#addMemberModal").modal("show");
              }  
             });  
          });

// for delete
        $('.del_data').click(function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
                 let mode= "delete"; 
                 let data_id = $(this).attr("id");  
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

  });  
 </script>