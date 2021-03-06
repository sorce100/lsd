<?php include("header.php");
      require_once("Classes/Contribution.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">CONTRIBUTIONS SETUP PAGE</div>
            <div class="panel-title pull-right">
               <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEW</button>
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
                                <th></th>
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
                                              <button type='button' id='".trim($contribution["contribution_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                            </td>
                                            <td>
                                              <button type='button' id='".trim($contribution["contribution_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
                                            </td>
                                            <td>

                                              <button type='button' id='".trim($contribution["contribution_id"])."' class='btn btn-success btn-xs view_contributions'>View Contributions <i class='fa fa-history'></i></button>
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

<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">ADD NEW CONTRIBUTION</b></h4>
      </div>
      <div class="modal-body" id="bg">
      <form id="insert_form" method="POST"> 
              <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">Purpose<span class="asterick"> *</span></label>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" class="form-control" id="contributionName" name="contributionName" placeholder="Enter contribution name" autocomplete="off" required>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">Due Date<span class="asterick"> *</span></label>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" class="form-control" id="contributionDue" name="contributionDue" data-toggle="datepicker" required autocomplete="off" readonly>
                    </div>
                  </div>
             </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info" id="save_btn">Add Contribution <i class="fa fa-save"></i></button>
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- for viewing those who have contributed and the sum of the money -->
 <div class="modal fade" id="viewContributionsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">MEMBER CONTRIBUTIONS</b></h4>
      </div>
      <div class="modal-body" >
        <div class="well">
          <h2>TOTAL CONTRIBUTION (₵): <b><span id="contributionTotal"></span></b></h2>
        </div>
          <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                          <th></th>
                            <th>MEMBERS</th>
                            <th>AMOUNT (₵)</th>
                            <th>DATE DONE</th>
                        </tr>
                    </thead>
                    <tbody id="contributionsBody">

                    </tbody>
                </table>
            </div>
      </div>
      <div class="well modal-footer" id="bg">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
        // for date time picker
        $(function() {
            $('[data-toggle="datepicker"]').datepicker({
              language: 'en-GB',
              format: 'dd-mm-yyyy',
              autoHide: true,
              zIndex: 2048,
            });
          });

        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD NEW CONTRIBUTION");
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
                url:"Script/contribution.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').text("Please wait ...");  
                     },
                success:function(data){  
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("admin_contributions.php");
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
                url:"Script/contribution.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE CONTRIBUTION DETAILS");
                    $("#contributionName").val(jsonObj[0].contribution_name);
                    $("#contributionDue").val(jsonObj[0].due_date);
                    $("#data_id").val(jsonObj[0].contribution_id);
                    $("#save_btn").text("Update Contribution");
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
                      url:"Script/contribution.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("admin_contributions.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });

  // for getting the total and the list of all contributed
  $(".view_contributions").click(function(){
    var mode= "view_contributions"; 
           var contribution_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/contribution.php",  
                method:"POST",  
                data:{contribution_id:contribution_id,mode:mode},  
                success:function(data){
                   var jsonObj = JSON.parse(data);
                   if (jsonObj.length == 0) {
                         $("#contributionsBody").html('<tr><td></td><td><b>Sorry, No contribution made</b></td></tr>');
                         $("#contributionTotal").html('0.00');
                         $("#viewContributionsModal").modal("show");
                      }
                    else if (jsonObj.length > 0) {
                            // clear content of contributions modal body
                            $("#contributionsBody").empty();
                            var contributionTotal = 0;
                         for (var i = 0; i < jsonObj.length; ++i) {
                                 contributionTotal += parseInt(jsonObj[i].contributed_amount);
                               $("#contributionsBody").append(
                                  '<tr class="row"><td>'+jsonObj[i].member_id+'</td><td>'+jsonObj[i].contributed_amount+'</td><td>'+jsonObj[i].date_done+'</td></tr>'
                                );
                          }
                        $("#contributionTotal").html(contributionTotal);
                        $("#viewContributionsModal").modal("show");
                    }
                }  
          }); 
     }); 

}); 
 </script>