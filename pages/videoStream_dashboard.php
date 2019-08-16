<?php 
include("header.php");
require_once("Classes/LiveStream.php");
require_once("Classes/Division.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">LIVE STREAM DASHBOARD</div>
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
                            <th>DIVISION</th>
                            <th>EVENT TITLE</th>
                            <th>START DATE</th>
                            <th>START TIME</th>
                            <th>END TIME</th>
                            <th>PRICE</th>
                            <th>AMOUNT</th>
                            <th></th>
                        </tr>
                    </thead>
                   <tbody id="resultsDisplay">
                        <?php
                          $objLiveStream = new LiveStream;
                          $livestreams = $objLiveStream->get_liveStreams(); 
                          foreach ($livestreams as $livestream) {
                                $currentdate = date("Y-m-d");
                                $streamDate = $livestream["youtube_start_date"];
                                $d1 = new DateTime($streamDate);
                                $d2 = new DateTime($currentdate);
                                $interval = $d2->diff($d1);
                                $interval->format('%m months');
                                if(($interval->y ==0) && ($interval->m <= 3)) {
                                  if ($currentdate == $streamDate) {
                                      echo "
                                          <tr>
                                            <td>".$objLiveStream->get_division_alias($livestream["division"])."</td>
                                            <td>".$livestream["youtube_event_name"]."</td>
                                            <td>".$livestream["youtube_start_date"]."</td>
                                            <td>".$livestream["youtube_startTime"]."</td>
                                            <td>".$livestream["youtube_endTime"]."</td>
                                            <td>".$livestream["youtube_rate"]."</td>
                                            <td>".$livestream["youtube_amount"]."</td>
                                            <td>";
                                        if ($livestream["youtube_rate"] == "FREE") {
                                          echo "<input type='button' name='".trim($livestream["youtube_rate"])."' value='WATCH' id='".trim($livestream["youtube_stream_id"])."' class='btn btn-success btn-xs free_watch' />
                                            </td>
                                          </tr>";
                                        }
                                        else if($livestream["youtube_rate"] == "PAID"){
                                          echo "<input type='button' name='".trim($livestream["youtube_amount"])."' value='MAKE PAYMENT' id='".trim($livestream["youtube_stream_id"])."' class='btn btn-info btn-xs make_payment' />
                                            </td>
                                          </tr>";
                                      }
                                  }
                                  else{
                                     echo "
                                          <tr>
                                            <td>".$objLiveStream->get_division_alias($livestream["division"])."</td>
                                            <td>".$livestream["youtube_event_name"]."</td>
                                            <td>".$livestream["youtube_start_date"]."</td>
                                            <td>".$livestream["youtube_startTime"]."</td>
                                            <td>".$livestream["youtube_endTime"]."</td>
                                            <td>".$livestream["youtube_rate"]."</td>
                                            <td>".$livestream["youtube_amount"]."</td>
                                            <td>";
                                        if ($livestream["youtube_rate"] == "FREE") {
                                          echo "<input type='button' name='".trim($livestream["youtube_rate"])."' value='WATCH' id='".trim($livestream["youtube_stream_id"])."' class='btn btn-success btn-xs free_watch' />
                                            </td>
                                          </tr>
                                        ";
                                        }
                                        else if($livestream["youtube_rate"] == "PAID"){
                                          echo "<input type='button' name='".trim($livestream["youtube_amount"])."' value='MAKE PAYMENT' id='".trim($livestream["youtube_stream_id"])."' class='btn btn-info btn-xs make_payment' />
                                            </td>
                                          </tr>
                                        ";
                                      }
                                  }
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

<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">MAKE PAYMENT</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
        <form id="insert_form" method="POST"> 
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">AMOUNT TO PAY (₵)</label>
                        <input type="text" class="form-control" id="streamPrice" name="streamPrice" autocomplete="off" readonly>
                    </div>
                  </div>
              </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
              <!-- Rate for youtube live whether free or paid -->
              <input type="hidden" name="streamRate" id="streamRate" value="FREE">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="CheckPayment" class="btn btn-success btn-block" name="submit" value="MAKE PAYMENT" />
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
            $("#subject").html("MAKE PAYMENT");
            $("#insert_form")[0].reset();
          })

        // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });


// else if its being paid then direct to the make payment before viewing
    $('.make_payment').click(function(){
      var youtubeAmount = $(this).attr("name");
      var youTubeStream_id = $(this).attr("id");
      $('#streamPrice').val(youtubeAmount);
      $('#streamRate').val("PAID");
      $('#data_id').val(youTubeStream_id);

        // check if user already payed to redirect else just show modal for payment
        var mode = "check_if_payed";
        $.ajax({  
                url:"Script/liveStream_register.php",  
                method:"POST",  
                data:{mode:mode,data_id:youTubeStream_id},  
                success:function(data){
                  // alert(data);
                    if (data == "success") {
                        window.location.replace("Embeded_live.php");
                    }
                    else if (data == "error"){
                      $('#myModal').modal('show');
                    }
                }
        });
     });

// if its free then direct the youtube page
    $('.free_watch').click(function(){ 
        var mode = "free_watch";
          var streamPrice = "0";
          var streamRate = $(this).attr("name");
          var data_id =  $(this).attr("id");
           $.ajax({  
                url:"Script/liveStream_register.php",  
                method:"POST",  
                data:{streamRate:streamRate,streamPrice:streamPrice,mode:mode,data_id:data_id},  
                success:function(data){
                  // alert(data);
                  if (data == "success") {window.location.replace("Embeded_live.php");}
                }
            });
    });

// check if funds are enough then allow user to watch stream
    
    $('#CheckPayment').click(function(){
      // check if already paid
      if (confirm("ARE YOU SURE YOU MAKE STREAMING PAYMENT?")) {
          var mode = "paid_watch";
          var streamPrice = $('#streamPrice').val();
          var streamRate = $('#streamRate').val();
          var data_id =  $('#data_id').val();
           $.ajax({  
                url:"Script/liveStream_register.php",  
                method:"POST",  
                data:{streamRate:streamRate,streamPrice:streamPrice,mode:mode,data_id:data_id},  
                success:function(data){
                  // alert(data);
                  if (data == "success") {window.location.replace("Embeded_live.php");}
                  else if (data == "error") {window.location.replace("videoStream_dashboard.php");}
                  else{alert(data);window.location.replace("videoStream_dashboard.php");}
                }
            });

      }else{
            return false;
          }

    });


});  
</script>