<?php include("header.php");
      require_once("Classes/Events.php");
      require_once("Classes/EventsRegister.php");
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
        <h3 class="box-title">EVENTS PAGE</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
              <!-- for search -->
              <div class="col-md-10">
                <form action="usersearch.php" method="POST">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="searchInput" autocomplete="off">
                    <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                  </div>
                 </form>
              </div>
              <!-- for add button -->

            </div>
            
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
                                                      <input type='button' name='view' value='VIEW EVENT TICKET' id='".trim($event["events_id"])."' class='btn btn-success btn-xs event_ticket' />
                                                    </td></tr>"; 
                                         }elseif (empty($eventsTicket)) {
                                            echo "<td>
                                                  <input type='button' name='view' value='REGISTER FOR EVENT' id ='".trim($event["events_id"])."' class='btn btn-danger btn-xs update_data' />
                                                </td></tr>";
                                        }
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
        <h4 class="modal-title"><center><u><b id="subject">ADD NEW EVENT</b></u></center></h4>
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
                  <input type="submit" id="save_btn" class="btn btn-success btn-block" name="submit" value="REGISTER FOR EVENT" />
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
                            $('#save_btn').val("Please wait ...");  
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
                    $("#save_btn").val("REGISTER FOR EVENT");
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
                      window.location.replace("ticket_generator.php");
                  }
                }

              });
    });

 //  // calculating the days difference between now and the end date set
                   //  var dateObj = new Date();
                   //  var month = dateObj.getUTCMonth() + 1; //months from 1-12
                   //  var day = dateObj.getUTCDate();
                   //  var year = dateObj.getUTCFullYear();
                   //  var todayDate = day + "-" + month + "-" + year;
                   //  // calculate the difference between the two dates
                   //  var today = new Date(28-11-2018);
                   //  var endDate = new Date(jsonObj[0].event_date_end);
                   //  var timeDiff = Math.abs(endDate.getTime() - today.getTime());
                   //  var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

                   // $("#daysCount").val(diffDays); 

 </script>




