<?php include("header.php");
      require_once("Classes/UserPayment.php");
      require_once("Classes/Members.php");
      require_once("Classes/Contribution.php");
      $objMembers = new Members;
      $surveyor_type = $objMembers->get_member_surveyorType();           
?>
<br>
<div class="row">
  <!-- first part of div -->
  <div class="col-md-12 ">
    <div class="panel panelTabs" >
      <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#dues">Annual Subscription <i class="fa fa-calendar"></i></a></li>
        <li><a data-toggle="tab" href="#contributions">Voluntary Contributions <i class="fa fa-money"></i></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="tab-content">
    <div id="dues" class="tab-pane fade in active">
      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
      <div class="row">
          <!-- <div class="col-sm-12"> -->
          <div class="panel panel-default">
              <div class="panel-heading">
                   <div class="panel-title pull-left">SUBSCRIPTIONS</div>
                  <div class="panel-title pull-right">
                     <button id="historybtn" class="btn btn-info"><span class="fa fa-list-ol"></span> HISTORY</button>
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
                                    <th>PURPOSE</th>
                                    <th>AMOUNT (₵)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="resultsDisplay">
                                <?php
                                  $objUserPayment = new UserPayment;
                                  $payments_details = $objUserPayment->get_user_payments();

                                  foreach ($payments_details as $payments_detail) {
                                        // comparing to the surveyor type to display the necessary dues
                                    if (($surveyor_type["surveyor_type"]) == ($payments_detail["surveyor_type"])) {
                                          echo "
                                              <tr>
                                                <td>".$payments_detail["payment_purpose"]."</td>
                                                <td>".$payments_detail["payment_amount"]."</td>
                                                <td>";
                                                if ($payments_detail['purpose'] != "DUES") {
                                                 echo " <button type='button' id='".trim($payments_detail["user_payment_id"])."' class='btn btn-info btn-xs update_data'>MAKE SUBSCRIPTION <i class='fa fa-money'></i></button>";
                                                }
                                                else{
                                                  echo "<button class='btn btn-success btn-xs' >Subscribed <i class='fa fa-check-square-o'></i></button>";
                                                }

                                                  echo "</td></tr>";
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
      <!--  -->
    </div>
    <div id="contributions" class="tab-pane fade">
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
      <div class="row">
          <!-- <div class="col-sm-12"> -->
          <div class="panel panel-default">
              <div class="panel-heading">
                   <div class="panel-title pull-left">CONTRIBUTIONS </div>
                  <div class="panel-title pull-right">
                     <button id="contHistorybtn" class="btn btn-info"><span class="fa fa-list-ol"></span> HISTORY</button>
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
                                    <th>CONTRIBUTION NAME</th>
                                    <th>DUE DATE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="resultsDisplay">
                                <?php
                                  $objContribution = new Contribution;
                                  $contributions = $objContribution->get_contributions(); 
                                  foreach ($contributions as $contribution) {
                                          echo "
                                              <tr>
                                                <td>".$contribution["contribution_name"]."</td>
                                                <td>".$contribution["due_date"]."</td>
                                                <td>
                                                  <button type='button' id='".trim($contribution["contribution_id"])."' class='btn btn-info btn-xs make_contribution'>MAKE CONTRIBUTE <i class='fa fa-money'></i></button>
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
      <!--  -->
    </div>
</div>



<!-- /.row -->

 <div class="modal fade" id="duesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="">PAY ANNUAL SUBSCRIPTION</b></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST"> 
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">PURPOSE OF PAYMENT</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                        <input type="text" class="form-control" id="paymentReason" name="paymentReason" autocomplete="off" required readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">AMOUNT TO PAY (GH ₵)</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                        <input type="number" class="form-control" id="paymentAmount" name="paymentAmount" required readonly>
                    </div>
                  </div>
                 
             </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="paymentId" id="paymentId" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="make_payment">
            <div class="well modal-footer" id="bg">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
              <button type="submit" class="btn btn-info" id="save_btn">Make Payment <i class="fa fa-money"></i></button>
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- history modal -->
 <div class="modal fade" id="duesHistoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-lg">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="">SUBSCRIPTION HISTROY</b></h4>
      </div>
      <div class="modal-body" >
          <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                          <th></th>
                            <th>PURPOSE</th>
                            <th>REASON</th>
                            <th>AMOUNT (₵)</th>
                            <th>DATE DONE</th>
                        </tr>
                    </thead>
                    <tbody id="historyBody">

                    </tbody>
                </table>
            </div>
          
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ///////////////////////Contributions//////////////////////////////////////////////////////////////////////////////////// -->
<!-- Adding modal -->
 <div class="modal fade" id="contributionModal" tabindex="-1" role="dialog" aria-labelledby="contributionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="">CONTRIBUTE</b></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="contributions_form" method="POST"> 
              <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">CONTRIBUTION NAME</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                        <input type="text" class="form-control" id="contributionName" name="contributionName" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                       <label for="title">ENTER AMOUNT <span class="asterick">*</span></label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                        <input type="number" class="form-control" id="contributionAmount" name="contributionAmount" required>
                    </div>
                  </div>
             </div>
             <!-- hiddin the contribution id -->
             <input type="hidden" name="contribution_id" id="contribution_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="contributionPay">
            <div class="well modal-footer" id="bg">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info" id="save_btn">Contribute <i class="fa fa-send"></i></button>
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- contributons history modal -->
<!-- history modal -->
 <div class="modal fade" id="contributionsHistoryModal" tabindex="-1" role="dialog" aria-labelledby="contributionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="">CONTRIBUTION HISTROY</b></h4>
      </div>
      <div class="modal-body" >
          <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                          <th></th>
                            <th>PURPOSE</th>
                            <th>REASON</th>
                            <th>AMOUNT (₵)</th>
                            <th>DATE DONE</th>
                        </tr>
                    </thead>
                    <tbody id="contributionshistoryBody">

                    </tbody>
                </table>
            </div>
          
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include("footer.php");?>

 <script>  
$(document).ready(function(){
  // for reset modal when close
  $('#duesModal').on('hidden.bs.modal', function () {
      $("#subject").html("SETUP NEW PAYMENT");
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
        if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
            $.ajax({
            url:"Script/userpayment.php",
            method:"POST",
            data:$("#insert_form").serialize(),
            beforeSend:function(){  
                      $('#save_btn').text("Please wait ...");  
                 },
            success:function(data){  
                 toastr.success(' Successfully');
                 $("#myModal").modal("hide");
                 $("#insert_form")[0].reset();
                  location.reload();
               } 

            });
        }else{
          return false;
          }

    });

  // for update
   $('.update_data').click(function(){ 
         var mode= "updateModal"; 
         var data_id = $(this).attr("id");  
         $.ajax({  
              url:"Script/userpayment.php",  
              method:"POST",  
              data:{data_id:data_id,mode:mode},  
              success:function(data){
                   var jsonObj = JSON.parse(data);  
                   // changing modal title
                  $("#subject").html("MAKE PAYMENT");
                  $("#paymentReason").val(jsonObj[0].payment_purpose);
                  $("#paymentAmount").val(jsonObj[0].payment_amount);
                  $("#paymentId").val(data_id);
                  $("#save_btn").text("Subscribe");
                  $("#duesModal").modal("show");
              }  
             });  
    });


// for contributions history
    $("#historybtn").click(function(){
      
      var mode= "getHistory";
      $.ajax({  
                url:"Script/userpayment.php",  
                method:"POST",  
                data:{mode:mode},  
                success:function(data){
                  $("#historyBody").html('');
                    var jsonObj = JSON.parse(data);
                    for (var i = 0; i < jsonObj.length; ++i) {

                         $("#historyBody").append(
                            '<tr class="row"><td>'+jsonObj[i].purpose+'</td><td>'+jsonObj[i].reason+'</td><td>'+jsonObj[i].amount_payed+'</td><td>'+jsonObj[i].date_done+'</td></tr>'

                          );

                    }
                    $("#duesHistoryModal").modal("show");
                } 
            }); 
          });
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // for reset modal when close
        $('#contributionModal').on('hidden.bs.modal', function () {
            $("#contributionsSubject").html("ADD NEW CONTRIBUTION");
            $("#contributions_form")[0].reset();
          })

        // for search
        $("#consearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#contresultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });



        //for inserting 
          $("#contributions_form").on("submit",function(e){
          e.preventDefault();
              if (confirm("ARE YOU SURE YOU WANT TO MAKE THIS CONTRIBUTION?")) {
                $.ajax({
                url:"Script/contribution.php",
                method:"POST",
                data:$("#contributions_form").serialize(),
                beforeSend:function(){  
                          $('#contributions_save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                if (data == "success") {
                    toastr.success(' Successfully');
                    $("#contributionModal").modal("hide");
                    $("#contributions_form")[0].reset();
                    alert("Contribution Made Successfully, Thank You !!!");
                    location.reload();
                   }else if(data == "insufficient_Balance"){
                    toastr.error('There was an error');
                    alert("Sorry, you do not have enough credit in your wallet. Please top up");
                    $("#contributionModal").modal("hide");
                    $("#contributions_form")[0].reset();
                   }
                } 

                });
              }else{ return false;}   
            });

        // for update
        $('.make_contribution').click(function(){ 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");
           $("#contribution_id").val(data_id);  
           $.ajax({  
                url:"Script/contribution.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE CONTRIBUTION DETAILS");
                    $("#contributionName").val(jsonObj[0].contribution_name);
                    $("#save_btn").text("MAKE CONTRIBUTION");
                    $("#contributionModal").modal("show");
                }  
               });  
          });

    // for contributions history
    $("#contHistorybtn").click(function(){
      $("#contributionshistoryBody").html('');
      var mode= "getHistory";
      $.ajax({  
                url:"Script/contribution.php",  
                method:"POST",  
                data:{mode:mode},  
                success:function(data){
                    var jsonObj = JSON.parse(data);
                    for (var i = 0; i < jsonObj.length; ++i) {

                         $("#contributionshistoryBody").append(
                            '<tr class="row"><td>'+jsonObj[i].purpose+'</td><td>'+jsonObj[i].reason+'</td><td>'+jsonObj[i].amount_payed+'</td><td>'+jsonObj[i].date_done+'</td></tr>'

                          );

                    }
                    $("#contributionsHistoryModal").modal("show");
                }  
            });

    });
}); 
 </script>