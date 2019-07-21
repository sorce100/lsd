<?php include("header.php");
      require_once("Classes/Company.php");
      require_once("Classes/Events.php");
      require_once("Classes/Contribution.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">COMPANY SETUP PAGE</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
              <!-- for search -->
              <div class="col-md-10">
                <form >
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="searchInput" autocomplete="off">
                    <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                  </div>
                 </form>
              </div>
              <!-- for add button -->
              <div class="col-md-2">
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD COMPANY</button>
              </div>
            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>COMPANY NAME</th>
                            <th>TOTAL MEMBERS</th>
        
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                          <?php
                          $objCompany = new Company;
                          $companys = $objCompany->get_companys(); 
                          foreach ($companys as $company) {
                            $membersIdDecode = json_decode($company["company_members_id"]);
                                  echo "
                                      <tr class='row'>
                                        <td>".$company["company_name"]."</td>
                                        <td>".count($membersIdDecode)."</td>
                                        <td>
                                          <input type='button' name='view' value='Company Action' id='".trim($company["company_id"])."' class='btn btn-success btn-xs company_action' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Update' id='".trim($company["company_id"])."' class='btn btn-info btn-xs update_data' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Delete' id='".trim($company["company_id"])."' class='btn btn-danger btn-xs del_data' />
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

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADD NEW GROUP</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST"> 
              <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label for="title">COMPANY NAME</label>
                        <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter company name" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="col-md-7">
                     <center><b><u>SELECT MEMBERS BELONGING TO GROUP</u></b></center>
                     <div class="table-responsive">
                       <table class="table table-hover">
                         <thead>
                            <th></th>
                            <th width="10%">Select</th>
                            <th width="90%">Members Name</th>
                         </thead>
                         <tbody id="resultsDisplay">
                          <?php
                              require_once("Classes/Members.php");
                              $objMembers = new Members;
                              $members = $objMembers->get_members();
                              foreach ($members as $member) {
                               
                                echo '<tr>
                                         <td></td>
                                         <td><input type="checkbox" class="input-md" name="companyMembers[]" id="MemberCheckBox" value="'.trim($member["professional_number"]).'"></td>
                                         <td>'.trim($member["first_name"]).' '.trim($member["last_name"]).'</td>
                                       </tr>';
                                      }
                            ?>
                         </tbody>
                       </table>
                     </div>
                      
                  </div>
             </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD COMPANY" />
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- for buttons for the various events -->


<!-- for selecting actions for company -->
 <div class="modal fade" id="companyActionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">SELECT ACTION</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
        <div class="row">
          <div class="col-md-6">
            <button type="button" class="btn btn-default" id="add_event" style="padding: 35px;"><b>ADD EVENTS</b></button>
          </div>
          <div class="col-md-6">
            <button type="button" class="btn btn-default" id="make_contribution" style="padding: 35px;"><b>MAKE CONTRIBUTIONS</b></button>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- for add event -->
 <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADD EVENTS FOR COMPANY MEMBERS</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
        <!-- add event modal -->
        <form id="insert_form" method="POST">
          <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label for="title">SELECT EVENT</label>
                          <select class="form-control" id="comEventId" name="comEventId" required>
                            <option value=""></option>
                            <?php
                              $objEvents = new Events;
                              $events = $objEvents->get_events(); 
                                  foreach ($events as $event) { 
                                          echo "<option value=".$event["events_id"].">".$event["events_theme"]."</option>";
                                                }
                                      
                             ?>
                          </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">COMPANY EVENT CODE</label>
                        <input type="text" class="form-control" id="comEventCode" name="comEventCode" value="" readonly required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">TOTAL AMOUNT(₵)</label>
                        <input type="text" class="form-control" id="comEventTotal" name="comEventTotal" value="" autocomplete="off" readonly required>
                        <input type="hidden" id="membersTotal" value="">
                    </div>
                  </div>
              </div>
            <!-- for inserting the page id -->
            <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="company_event">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD COMPANY EVENT" />
            </div>  
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- for make contributions modal -->

 <div class="modal fade" id="makeContributionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">MAKE CONTRIBUTIONS</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
        <!-- add event modal -->
        <form id="insert_form" method="POST">
          <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">SELECT CONTRIBUTION TO MAKE</label>
                          <select class="form-control" id="comContributeId" name="comContributeId" required>
                            <option value=""></option>
                            <?php
                              $objContribution = new Contribution;
                              $contributions = $objContribution->get_contributions(); 
                                  foreach ($contributions as $contribution) { 
                                          echo "<option value=".$contribution["contribution_id"].">".$contribution["contribution_name"]."</option>";
                                                }
                                      
                             ?>
                          </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">ENTER AMOUNT TO CONTRIBUTE</label>
                        <input type="text" class="form-control" id="comContributeAmt" name="comContributeAmt" value="" autocomplete="off" required>
                        <input type="hidden" id="membersTotal" value="">
                    </div>
                  </div>
              </div>
            <!-- for inserting the page id -->
            <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="company_contribution">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="MAKE CONTRIBUTIONS" />
            </div>  
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD NEW PAGE");
            $("#insert_form")[0].reset();
          });

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
                url:"Script/company.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                  alert(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("admin_company.php");
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
                  url:"Script/company.php",  
                  method:"POST",  
                  data:{data_id:data_id,mode:mode},  
                  success:function(data){
                        // passing data from server for particular id selected
                       var jsonObj = JSON.parse(data);
                       // passing the group pages array stored in database
                       var companyMembersArray = JSON.parse(jsonObj[0].company_members_id);
                         //looping through all input id with the checkbox id 
                         var checkbox = $('input[id = "MemberCheckBox"]').each(function(){ 
                              // grabbing the checkboxes values
                             var Pages = $(this).val(); 
                              // looping througth the array to get the ids
                              for (var i = 0; i < companyMembersArray.length; ++i) {
                                // for comparing if returned array is contained in the input id's values
                                    if (companyMembersArray[i] == Pages) {
                                      // select the checkbox if the id's meet
                                          $(this).attr('checked',true);
                                        }
                                    }
                               });
                         // changing modal title
                        $("#subject").html("UPDATE COMPANY MEMBERS");
                        $("#data_id").val(jsonObj[0].company_id);
                        $("#companyName").val(jsonObj[0].company_name);
                        $("#save_btn").val("UPDATE COMPANY MEMBERS");
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
                      url:"Script/company.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("admin_company.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });


// for selecting actions for company 
        $('.company_action').click(function(){
          var membersTotal = $(this).parent().siblings(":first").next().text();
          $('#membersTotal').val(membersTotal);
          $('#companyActionModal').modal('show');
        });
// for showing add event modal when event button is clicked
      $('#add_event').click(function(){
        $('#addEventModal').modal('show');
        $('#companyActionModal').modal('hide');
      });

// add events and query to get price to make calculations for memebers
     $( '#comEventId' ).change(function() {
         var mode = "get_event_price";
         var data_id = $('#comEventId option:selected').val();
         // now we get the price for an event
         $.ajax({  
                  url:"Script/events.php",  
                  method:"POST",  
                  data:{data_id:data_id,mode:mode},  
                  success:function(data){
                    var jsonObj = JSON.parse(data);
                    var event_fee = jsonObj.event_fee;
                      // for total for event of all members
                      var total_amount =  parseInt($('#membersTotal').val()) * parseInt(event_fee);
                      $('#comEventTotal').empty().val(total_amount);
                      // for generating event ID
                       $('#comEventCode').empty().val("EV"+data_id+"COM");
                     
                  }  
                });

     });
// for making contribution for company
  $('#make_contribution').click(function(){
    $('#makeContributionModal').modal("show");

  });

});  
 </script>