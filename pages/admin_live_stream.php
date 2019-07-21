<?php 
      include("header.php");
      require_once("Classes/LiveStream.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">DIVISION LIVE STREAM SETUP PAGE</h3>
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
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEW EVENT</button>
              </div>
            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>STREAM TITLE</th>
                            <th>START DATE</th>
                            <th>START TIME</th>
                            <th>END TIME</th>
                            <th></th>
                            <th></th>
                            <th></th>
        
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                         <?php
                          $objLiveStream = new LiveStream;
                          $liveStreams = $objLiveStream->get_liveStreams(); 
                          foreach ($liveStreams as $liveStream) {
                                  echo "
                                      <tr>
                                        <td>".$liveStream["youtube_event_name"]."</td>
                                        <td>".$liveStream["youtube_start_date"]."</td>
                                        <td>".$liveStream["youtube_startTime"]."</td>
                                        <td>".$liveStream["youtube_endTime"]."</td>
                                       
                                        <td>
                                          <input type='button' name='view' value='Update' id='".trim($liveStream["youtube_stream_id"])."' class='btn btn-info btn-xs update_data' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Delete' id='".trim($liveStream["youtube_stream_id"])."' class='btn btn-danger btn-xs del_data' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Viewers' id='".trim($liveStream["youtube_stream_id"])."' class='btn btn-success btn-xs check_viewers' />
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
        <h4 class="modal-title"><center><u><b id="subject">ADD NEW LIVE STREAM</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST"> 
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">EVENT TITLE</label>
                        <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Enter event title" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">START DATE</label>
                        <input type="text" class="form-control" id="startDate" name="startDate" data-toggle="datepicker" placeholder="Click to select" autocomplete="off" required readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">START TIME</label>
                        <select class="form-control" id="startTime" name="startTime" required>
                          <option  disabled selected>Select Time</option>
                          <?php echo get_times(); ?>
                        </select>
                        
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">END TIME</label>
                        <select class="form-control" id="endTime" name="endTime" required>
                          <option  disabled selected>Select Time</option>
                          <?php echo get_times(); ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">RATE</label>
                        <select class="form-control" name="eventRate" id="eventRate" required>
                          <option  disabled selected>Select Rate</option>
                          <option value="FREE">FREE</option>
                          <option value="PAID">PAID</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6" id="enterAmtDiv">
                    <div class="form-group">
                        <label for="title">ENTER AMOUNT</label>
                        <input type="number" class="form-control" id="enterAmount" name="enterAmount" placeholder="Enter Amount to be paid">
                    </div>
                  </div>
                  
             </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD LIVE STREAM" />
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal to check registered viewers -->
 <div class="modal fade" id="streamersModal" tabindex="-1" role="dialog" aria-labelledby="streamersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">REGISTERED YOUTUBE EVENT STREAMERS</b></u></center></h4>
      </div>
      <div class="modal-body" >
        <div class="well">
          <h2>TOTAL AMOUNT (₵): <b><span id="totalAmount"></span></b></h2>
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
                    <tbody id="registeredStreamersBody">

                    </tbody>
                </table>
            </div>
      </div>
      <!-- <div class="well modal-footer" id="bg">

          <input type="#" id="participants_downloadBtn" class="btn btn-success btn-block" name="submit" value="DOWNLOAD PARTICIPANTS EXCEL" />
      </div> -->
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
        

        // for hiding the div when page loads
        $('#enterAmtDiv').hide();
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

        // click to show the text field for entering amount
        $("#eventRate").change(function(){
            var eventrate = $(this).val();
            switch(eventrate){
              case 'FREE':
                $('#enterAmtDiv').val('');
                $('#enterAmtDiv').hide();
              break;
              case 'PAID':
                $('#enterAmtDiv').show();
              break;
            }
          });


        //for inserting 
          $("#insert_form").on("submit",function(e){
          e.preventDefault();
                $.ajax({
                url:"Script/liveStream.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                  // alert(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("admin_live_stream.php");
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  

      });

  // update
  // for update
        $('.update_data').click(function(){ 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/liveStream.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE LIVE STREAM DETAILS");
                    $("#eventTitle").val(jsonObj[0].youtube_event_name);
                    $("#startDate").val(jsonObj[0].youtube_start_date);
                    $("#startTime").val(jsonObj[0].youtube_startTime);
                    $("#endTime").val(jsonObj[0].youtube_endTime);
                    $("#eventRate").val(jsonObj[0].youtube_rate);
                    $("#enterAmount").val(jsonObj[0].youtube_amount);
                    $("#data_id").val(jsonObj[0].youtube_stream_id);
                    $("#save_btn").val("UPDATE DETAILS");
                    $("#mode").val("update");
                    $("#myModal").modal("show");
                }  
               });  
          });

  // delete
  $('.del_data').click(function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/liveStream.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("admin_live_stream.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });
// view participants
$(".check_viewers").click(function(){
           var mode= "view_registered_Streamers"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/liveStream_register.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                   var jsonObj = JSON.parse(data);
                   if (jsonObj.length == 0) {
                         $("#registeredStreamersBody").html('<tr><td></td><td><b>Sorry, registered viewers </b></td></tr>');
                         $("#totalAmount").html('0.00');
                         $("#streamersModal").modal("show");
                      }
                    else if (jsonObj.length > 0) {
                            // clear content of contributions modal body
                              $("#registeredStreamersBody").empty();
                              var totalAmount = 0;
                             for (var i = 0; i < jsonObj.length; ++i) {
                                     totalAmount += parseInt(jsonObj[i].youtube_price);
                                     // grab username for user_id
                                     var mode = "get_username";
                                     var user_id = jsonObj[i].user_id;
                                     $.ajax({
                                        url:"Script/users.php",  
                                        method:"POST",  
                                        data:{user_id:user_id,mode:mode},  
                                        success:function(data){
                                          username = data;
                                        }
                                     });
                                     $("#registeredStreamersBody").append(
                                        '<tr class="row"><td>'+username+'</td><td>'+jsonObj[i].youtube_price+'</td><td>'+jsonObj[i].date_done+'</td></tr>'
                                      );
                              }
                        $("#totalAmount").html(totalAmount);
                        $("#streamersModal").modal("show");
                    }
                }  
          }); 
     });

});

 </script>