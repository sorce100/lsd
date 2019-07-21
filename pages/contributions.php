<?php include("header.php");
      require_once("Classes/Contribution.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">CONTRIBUTIONS PAGE</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
              <!-- for search -->
              <div class="col-md-10">
                <form action="usersearch.php" method="POST">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="consearchInput" autocomplete="off">
                    <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                  </div>
                 </form>
              </div>
               <!-- for add button -->
              <div class="col-md-2">
                 <button id="contHistorybtn" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> HISTORY</button>
              </div>

            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>CONTRIBUTION NAME</th>
                            <th>DUE DATE</th>
                        </tr>
                    </thead>
                    <tbody id="contresultsDisplay">
                        <?php
                          $objContribution = new Contribution;
                          $contributions = $objContribution->get_contributions(); 
                          foreach ($contributions as $contribution) {
                                  echo "
                                      <tr class='row'>
                                        <td>".$contribution["contribution_name"]."</td>
                                        <td>".$contribution["due_date"]."</td>
                                        <td>
                                          <input type='button' name='view' value='CONTRIBUTE' id='".trim($contribution["contribution_id"])."' class='btn btn-success btn-xs make_contribution' />
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
<!-- Adding modal -->
 <div class="modal fade" id="contributionModal" tabindex="-1" role="dialog" aria-labelledby="contributionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject"></b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="contributions_form" method="POST"> 
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">CONTRIBUTION NAME</label>
                        <input type="text" class="form-control" id="contributionName" name="contributionName" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">ENTER AMOUNT TO CONTRIBUTE</label>
                        <input type="number" class="form-control" id="contributionAmount" name="contributionAmount" required>
                    </div>
                  </div>
             </div>
             <!-- hiddin the contribution id -->
             <input type="hidden" name="contribution_id" id="contribution_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="contributionPay">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="contributions_save_btn" class="btn btn-danger btn-block" name="submit" value="MAKE CONTRIBUTION" />
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- history modal -->
 <div class="modal fade" id="contributionsHistoryModal" tabindex="-1" role="dialog" aria-labelledby="contributionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="contributionsSubject">CONTRIBUTION HISTROY</b></u></center></h4>
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
                          $("#contributionModal").modal("hide");
                          $("#contributions_form")[0].reset();
                          window.location.replace("contributions.php");
                         }else if(data == "insufficient_Balance"){
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
                    $("#save_btn").val("MAKE CONTRIBUTION");
                    $("#contributionModal").modal("show");
                }  
               });  
          });

    // for contributions history
    $("#contHistorybtn").click(function(){
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
})  
 </script>