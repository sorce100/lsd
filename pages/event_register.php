<?php include("header.php");
      require_once("Classes/Events.php");
      require_once("Classes/EventsRegister.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">EVENTS REGISTRATION PAGE</div>
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
                            <th>UPCOMING EVENTS</th>
                            <th>START DATE</th>
                            <th>END DATE</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                        <?php
                          $objEvents = new Events;
                          $events = $objEvents->get_events(); 
                          foreach ($events as $event) {
                                  echo "
                                      <tr>
                                        <td>".$event["events_theme"]."</td>
                                        <td>".$event["event_date_start"]."</td>
                                        <td>".$event["event_date_end"]."</td>";
                                        // check to see if member has registerd event from the event_register table then allow for ticket view and download
                                        $objEventsRegister = new EventsRegister;
                                        $eventsTicket = $objEventsRegister->get_event_ticket(trim($event["events_id"]),$_SESSION['member_id']);
                                         if (!empty($eventsTicket)) {
                                              echo "<td>
                                                      <button type='button' id='".trim($event["events_id"])."' class='btn btn-success btn-xs event_ticket'>VIEW EVENT TICKET <i class='fa fa-check-square-o'></i></button>
                                                    </td></tr>"; 
                                         }elseif (empty($eventsTicket)) {
                                            echo "<td>
                                                  <button type='button' id='".trim($event["events_id"])."' class='btn btn-info btn-xs update_data'>REGISTER FOR EVENT <i class='fa fa-shopping-cart'></i></button>
                                                </td></tr>";
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">ADD NEW EVENT</b></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST">

              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">EVENT THEME</label>
                        <textarea rows="2" class="form-control" id="eventTheme" name="eventTheme" autocomplete="off" required placeholder="Enter theme for the event eg: Annual Seminar" readonly></textarea>
                    </div>
                  </div>
             </div>
             <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">EVENT VENUE</label>
                        <input type="text" class="form-control" id="eventVenue" name="eventVenue" placeholder="Enter event venue" autocomplete="off" required readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">EVENT FEE (₵)</label>
                        <input type="number" class="form-control" id="eventFee" name="eventFee" placeholder="Enter event fee" autocomplete="off" required readonly>
                    </div>
                  </div>
             </div>
             <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">EVENT START DATE</label>
                        <input type="text" class="form-control" id="eventStartDate" name="eventStartDate" data-toggle="datepicker" placeholder="Click to select start date" autocomplete="off" required readonly>
                    </div>
                  </div>
                   <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">EVENT END DATE</label>
                        <input type="text" class="form-control" id="eventEndDate" name="eventEndDate" data-toggle="datepicker" placeholder="Click to select end date" autocomplete="off" required readonly>
                    </div>
                  </div>
             </div>
             <hr>

              <div class="row">
               <!--  -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hotelNamesPrices">SELECT HOTEL</label>
                        <select name="hotelNamesPrices" class="form-control" id="hotelNamesPrices">
                          <option value="NONE">None</option>
                          <!-- LISTING ALL Hotels and their price range -->
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hotelNamesPrices">SELECT NUMBER OF DAYS</label>
                        <select name="hotelNamesPrices" class="form-control" id="hotelNamesPrices">
                          <option value="NONE">None</option>
                          <option value="1 Day">1 Day</option>
                          <option value="2 Days">2 Days</option>
                          <option value="3 Days">3 Days</option>
                          <option value="4 Days">4 Days</option>
                          <option value="5 Days">5 Days</option>
                          <option value="6 Days">6 Days</option>
                          <option value="7 Days">7 Days</option>
                          <option value="8 Days">8 Days</option>
                          <option value="9 Days">9 Days</option>
                          <option value="10 Days">10 Days</option>
                          
                        </select>
                    </div>
                </div>
            </div>  
               <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
               <!-- for insert query -->
              <input type="hidden" name="mode" id="mode" value="insert">
              <div class="well modal-footer" id="bg">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                  <button type="submit" class="btn btn-info" id="save_btn">Register Event<i class="fa fa-save"></i></button>
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
            $("#subject").html("ADD NEW EVENT");
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
            if (confirm("ARE YOU SURE YOU WANT TO REGISTER FOR EVENT?")) {
                  $.ajax({
                  url:"Script/eventsregister.php",
                  method:"POST",
                  data:$("#insert_form").serialize(),
                  beforeSend:function(){  
                            $('#save_btn').text("Please wait ...");  
                       },
                  success:function(data){  
                    // alert(data);
                       $("#myModal").modal("hide");
                       $("#insert_form")[0].reset();
                       if (data == "success") {
                        window.location.replace("event_register.php");
                       }
                       else if(data == "insufficient_Balance"){
                        alert("Sorry, you do not have enough credit in your wallet. Please top up");
                       }
                    } 

                  });
                }else{ return false;}    
            });



        // for update
        $('.update_data').click(function(){ 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/events.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                  // alert(data);
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("REGISTER EVENT DETAILS");
                    $("#eventTheme").val(jsonObj[0].events_theme);
                    $("#eventVenue").val(jsonObj[0].event_venue);
                    $("#eventFee").val(jsonObj[0].event_fee);
                    $("#eventStartDate").val(jsonObj[0].event_date_start);
                    $("#eventEndDate").val(jsonObj[0].event_date_end);
                    $("#data_id").val(jsonObj[0].events_id);
                    $("#text").val("REGISTER FOR EVENT");
                    // $("#mode").val("update");
                    // getting the hotel names and price ranges
                      if (jQuery.isEmptyObject(jsonObj[0].hotel_names)) {
                              $("#myModal").modal("show");     
                      }else{

                             var hotelnamesJson = JSON.parse(jsonObj[0].hotel_names);
                             var hotelpricesJson = JSON.parse(jsonObj[0].hotel_prices);

                             for (var i = 0; i < hotelnamesJson.length; i++) {
                              var option = $('<option></option>').attr("value", hotelnamesJson[i]).text(hotelnamesJson[i] + " ( ₵"+ hotelpricesJson[i] + " )");
                              $("#hotelNamesPrices").append(option);
                             }
                            $("#myModal").modal("show");
                        }
                   }  
               });  
          });
    }); 

    // for getting the ticket pdf for registered event
    $(".event_ticket").click(function(){
        var mode= "ticket_check"; 
        var data_id = $(this).attr("id");
         $.ajax({  
                url:"Script/eventsregister.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                  if (data != null) {
                    window.open("ticket_generator.php", '_blank');
                  }
                }

              });
    });
 </script>




