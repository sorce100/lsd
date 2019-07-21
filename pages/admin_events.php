<?php include("header.php");
      require_once("Classes/Events.php");
?>

<style type="text/css">
  #event_form fieldset:not(:first-of-type) {
    display: none;
    }
  textarea{
    resize: none;
        }
  </style>

<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">EVENT & MEETING SETUP PAGE</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
              <!-- for search -->
              <div class="col-md-10">
              </div>
              <!-- for add button -->
              <div class="col-md-2">
                <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span> Add New <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                      <li><a data-toggle="modal" data-target="#eventModal"><b>Add Event</b></a></li>
                      <li><a data-toggle="modal" data-target="#mettingModal"><b>Add Meeting</b></a></li>
                    </ul>
                </div>
              </div>
            </div>
            
            <ul class="nav nav-tabs nav-justified">
              <li class="active"><a data-toggle="tab" href="#eventsTab"><b>Events</b></a></li>
              <li><a data-toggle="tab" href="#meetingTab"><b>Meetings</b></a></li>
            </ul>
            <div class="tab-content">
              <div id="eventsTab" class="tab-pane fade in active">
                <div class="table-responsive"><br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                
                                <th>ID</th>
                                <th>THEME</th>
                                <th>START DATE</th>
                                <th>END DATE</th>
                                <th>FEE (₵)</th>
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
                                            <td>".$event["events_id"]."</td>
                                            <td>".substr($event["events_theme"], 0, 30)."</td>
                                            <td>".$event["event_date_start"]."</td>
                                            <td>".$event["event_date_end"]."</td>
                                            <td>".$event["event_fee"]."</td>
                                           
                                            <td>
                                              <input type='button' name='view' value='Update' id='".trim($event["events_id"])."' class='btn btn-info btn-xs update_data' />
                                          
                                              <input type='button' name='view' value='Delete' id='".trim($event["events_id"])."' class='btn btn-danger btn-xs del_data' />
                                            
                                              <input type='button' name='view' value='View Participants' id='".trim($event["events_id"])."' class='btn btn-success btn-xs view_participants' />
                                            </td>
                                          </tr>
                                        ";
                                  }
                             ?>
                        </tbody>
                    </table>
                </div>
              </div>
              <div id="meetingTab" class="tab-pane fade">
                <div class="table-responsive"><br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Meeting Title</th>
                                <th>Location</th>
                                <th>Date<th>
                                <th></th>
                            </tr>
                        </thead>
                       <tbody id="resultsDisplay">
                             <?php
                              $objEvents = new Events;
                              $events = $objEvents->get_meetings(); 
                              foreach ($events as $event) {
                                      echo "
                                          <tr>
                                            <td>".$event["events_theme"]."</td>
                                            <td>".$event["event_venue"]."</td>
                                            <td>".$event["event_date_end"]."</td>
                                           
                                            <td>
                                              <input type='button' name='view' value='Update' id='".trim($event["events_id"])."' class='btn btn-info btn-xs meeting_update' />
                                          
                                              <input type='button' name='view' value='Delete' id='".trim($event["events_id"])."' class='btn btn-danger btn-xs del_data' />
                                            
                                              <input type='button' name='view' value='View Participants' id='".trim($event["events_id"])."' class='btn btn-success btn-xs view_participants' />
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
    </div>
</div>
<!-- /.row -->

 <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADD NEW EVENT</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="event_form" method="POST">
          <fieldset> 
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">EVENT THEME</label>
                        <textarea rows="2" class="form-control" id="eventTheme" name="eventTheme" autocomplete="off" placeholder="Enter theme for the event eg: Annual Seminar"></textarea>
                    </div>
                  </div>
             </div>
             <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">EVENT VENUE</label>
                        <input type="text" class="form-control" id="eventVenue" name="eventVenue" placeholder="Enter event venue" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">EVENT FEE (₵)</label>
                        <input type="number" class="form-control" id="eventFee" name="eventFee" placeholder="Enter event fee" autocomplete="off" >
                    </div>
                  </div>
             </div>
             <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">EVENT START DATE</label>
                        <input type="text" class="form-control" id="eventStartDate" name="eventStartDate" data-toggle="datepicker" placeholder="Click to select start date" autocomplete="off" readonly>
                    </div>
                  </div>
                   <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">EVENT END DATE</label>
                        <input type="text" class="form-control" id="eventEndDate" name="eventEndDate" data-toggle="datepicker" placeholder="Click to select end date" autocomplete="off" readonly>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">START TIME</label>
                        <select class="form-control" id="startTime" name="startTime" >
                          <option  disabled selected>Select Time</option>
                          <?php echo get_times(); ?>
                        </select>
                        
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">END TIME</label>
                        <select class="form-control" id="endTime" name="endTime" >
                          <option  disabled selected>Select Time</option>
                          <?php echo get_times(); ?>
                        </select>
                        
                    </div>
                  </div>
             </div><br>
                <input type="button" class="next btn-info btn-block" value="ENTER HOTELS" />
            </fieldset>
            <fieldset>
              <!-- FOR CLICK TO ADD NEW INPUT FORM FOR CLICK TO ADD HOTEL NAME AND PRICES -->
              <div class="table-responsive">  
                   <table class="table" id="dynamic_field">  
                        <tr>  
                           <td><button type="button" name="add" id="add" class="btn btn-danger">Add New Hotel</button></td>
                             <td><input type="text" name="hotelNames[]" placeholder="Enter name of hotel" class="form-control hotelNames" /></td>
                             <td><input type="number" name="hotelPrices[]" placeholder="Enter price" class="form-control hotelPrices" /></td>  
                        </tr>  
                   </table>  
              </div>  

               <!-- for inserting the page id -->
                <input type="hidden" name="data_id" id="data_id" value="">
               <!-- for insert query -->
                <input type="hidden" name="mode" id="mode" value="insert">

                <input type="button" name="previous" class="previous btn-info btn-block" value="EVENT SETUP" /><br>
                <input type="submit" id="save_btn" class="btn btn-success btn-block" name="submit" value="ADD NEW EVENT" />

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
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
  <!-- modal for adding meeting -->
 <div class="modal fade" id="mettingModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title" id="meetingSubject">Add Meeting</h4>
      </div>
      <div class="modal-body" >
          <form id="meeting_form">
            <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="meetingTitle" name="meetingTitle" placeholder="Enter Title for meeting" autocomplete="off" >
                    </div>
                  </div>
             </div>
             <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                      <label for="title">Date</label>
                      <input type="text" class="form-control" id="meetingDate" placeholder="Meeting Date" name="meetingDate" data-toggle="datepicker" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">Meeting Start Time</label>
                        <select class="form-control" id="meetingstartTime" name="startTime" >
                          <option  disabled selected>Select Time</option>
                          <?php echo get_times(); ?>
                        </select>
                        
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">Meeting End Time</label>
                        <select class="form-control" id="meetingendTime" name="endTime" >
                          <option  disabled selected>Select Time</option>
                          <?php echo get_times(); ?>
                        </select>
                        
                    </div>
                  </div>
             </div>
             <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Location</label>
                        <textarea class="form-control" id="meetingLocation" name="meetingLocation" placeholder="Enter location for meeting" autocomplete="off"></textarea>
                    </div>
                  </div>
                  
             </div>
             <!-- for inserting the page id -->
            <input type="hidden" name="data_id" id="meetingData_id" value="">
           <!-- for insert query -->
            <input type="hidden" name="mode" id="meetingMode" value="meeting_insert">
          </div>
          <div class="well modal-footer" id="bg">
              <button type="submit" id="meetingBtn" class="btn btn-info btn-block"> SAVE <i class="fa fa-save"></i></button>
          </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- view registerd participants for event -->
 <div class="modal fade" id="viewParticipantsModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">REGISTERED PARTICIPANTS </b></u></center></h4>
      </div>
      <div class="modal-body" >
          <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                          <th></th>
                            <th>MEMBERS</th>
                            <th>AMOUNT (₵)</th>
                            <th>TICKET NUMBER</th>
                            <th>DATE DONE</th>
                        </tr>
                    </thead>
                    <tbody id="participantsBody">

                    </tbody>
                </table>
            </div>
      </div>
      <div class="well modal-footer" id="bg">
          <input type="button" id="participants_downloadBtn" class="btn btn-success btn-block" name="submit" value="DOWNLOAD PARTICIPANTS EXCEL" />
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

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
        $('#eventModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD NEW EVENT");
            $("#event_form,#meeting_form")[0].reset();
            // $("#participantsBody").html("<tr>message foo</tr>");
          })

        // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });



        //for events inserting 
          $("#event_form").on("submit",function(e){
            e.preventDefault();
                $.ajax({
                url:"Script/events.php",
                method:"POST",
                data:$("#event_form").serialize(),
                beforeSend:function(){  
                    $('#save_btn').val("Please wait ...").prop('disabled',true);   
               },
                success:function(data){  
                  // alert(data)
                     $("#eventModal").modal("hide");
                     $("#event_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("admin_events.php");
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });

        // for meeting insert
          $("#meeting_form").on("submit",function(e){
          e.preventDefault();
                $.ajax({
                url:"Script/events.php",
                method:"POST",
                data:$("#meeting_form").serialize(),
                beforeSend:function(){  
                    $('#meetingBtn').text("Please wait ...").prop('disabled',true);  
               },
                success:function(data){  
                  // alert(data)
                     $("#mettingModal").modal("hide");
                     $("#meeting_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("admin_events.php");
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });
        // for update
        $(document).on('click', '.update_data', function(){
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/events.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE EVENT DETAILS");
                    $("#eventTheme").val(jsonObj[0].events_theme);
                    $("#eventVenue").val(jsonObj[0].event_venue);
                    $("#eventFee").val(jsonObj[0].event_fee);
                    $("#eventStartDate").val(jsonObj[0].event_date_start);
                    $("#eventEndDate").val(jsonObj[0].event_date_end);
                    $("#startTime").val(jsonObj[0].start_time);
                    $("#endTime").val(jsonObj[0].end_time);
                    $("#data_id").val(jsonObj[0].events_id);
                    // decode hotelnames and hotelprices
                    var jsonObjHotelName = JSON.parse(jsonObj[0].hotel_names);
                    var jsonObjHotelPrice = JSON.parse(jsonObj[0].hotel_prices);

                    for (var i = 0; i < jsonObjHotelName.length; ++i) {
                      $('#dynamic_field').prepend('<tr><td></td><td><input type="text" name="hotelNames[]" value="'+jsonObjHotelName[i]+'" class="form-control hotelNames" /></td><td><input type="number" name="hotelPrices[]" value="'+jsonObjHotelPrice[i]+'" class="form-control hotelPrices" /></td></tr>');
                    }

                    $("#save_btn").val("UPDATE PAGE");
                    $("#mode").val("update");
                    $("#eventModal").modal("show");
                }  
               });  
          });
// update for meeting
        $(document).on('click', '.meeting_update', function(){
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/events.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#meetingSubject").html("Update Meeting");
                    $("#meetingTitle").val(jsonObj[0].events_theme);
                    $("#meetingLocation").val(jsonObj[0].event_venue);
                    $("#meetingDate").val(jsonObj[0].event_date_end);
                    $("#meetingData_id").val(jsonObj[0].events_id);
                    $("#meetingstartTime").val(jsonObj[0].start_time).trigger('change');
                    $("#meetingendTime").val(jsonObj[0].end_time).trigger('change');
                    $("#meetingBtn").text("Update Meeting");
                    $("#meetingMode").val("update_meeting");
                    $("#mettingModal").modal("show");
                }  
               });  
          });
// for delete
        $('.del_data').click(function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/events.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("admin_events.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });
    // click to view all members who have registered for the event and enable download in excel
              $(".view_participants").click(function(){
                  var mode= "view_participants";
                  var data_id = $(this).attr("id");
                  $.ajax({  
                            url:"Script/eventsregister.php",  
                            method:"POST",  
                            data:{data_id:data_id,mode:mode},  
                            success:function(data){
                              // alert(data);
                              if (data == "empty") {
                                    $("#participantsBody").html('<tr><td></td><td><b>Sorry, No registered participants for this event</b></td></tr>');
                                    $("#participants_downloadBtn").hide();
                                    $("#viewParticipantsModal").modal("show");
                              }else{
                                    var jsonObj = JSON.parse(data);
                                    for (var i = 0; i < jsonObj.length; ++i) {

                                         $("#participantsBody").html(
                                            '<tr class="row"><td>'+jsonObj[i].member_id+'</td><td>'+jsonObj[i].event_fee_payed+'</td><td>'+jsonObj[i].event_ticket+'</td><td>'+jsonObj[i].date_done+'</td></tr>'

                                          );

                                    }
                                    $("#participants_downloadBtn").show();
                                    $("#viewParticipantsModal").modal("show");
                                } 
                             }
                        }); 
                     });

    // FOR CLICK TO ADD FOR HOTEL NAME AND PRICE RANGE
    var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X Remove</button></td><td><input type="text" name="hotelNames[]" placeholder="Enter name of hotel" class="form-control hotelNames" /></td><td><input type="number" name="hotelPrices[]" placeholder="Enter price" class="form-control hotelPrices" /></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   

  })  
 </script>