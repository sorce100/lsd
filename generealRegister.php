<?php 
  require_once("header.php");
  require_once("pages/Classes/Events.php");

  $eventId = trim($_GET["data"]);
  if ( filter_var($eventId, FILTER_VALIDATE_INT) === false ) {
      header("Location:index.php");
  }
  elseif (filter_var($eventId, FILTER_VALIDATE_INT) != false) {
    // if its an integer then do stuff
    $objEvents = new Events;
    $events = $objEvents->get_events_general($eventId);
     foreach ($events as $event ) {
       $eventTitle = trim($event["events_theme"]);
       $eventVenue = trim($event["event_venue"]);
       $eventFee = trim($event["event_fee"]);
       $eventDateStart = trim($event["event_date_start"]);
       $eventDateEnd = trim($event["event_date_end"]);
       $eventStartTime = trim($event["start_time"]);
       $eventEndTime = trim($event["end_time"]);

     }
  }
?>
 <style>
    h3{
      text-align: center;
    }
    /*style for multistep modal*/
     #insert_form fieldset:not(:first-of-type) {
        display: none;
      }
     #generalEvent {
        position: absolute;
        top: 10%;
        left: 20%
      }
      textarea{
        resize: none;
      }
</style>

    <div class="row" style="overflow-y: auto !important;">
      <div class="col-md-12">
           <header id="showcase">
              <div class="showcase_form">
                  <h1><u>EVENT DETAILS</u></h1><br>
                   <h3><b>TITLE : </b><span class="eventtitle"><?php echo $eventTitle; ?></span></h3><br>
                   <h3><b>VENUE : </b><span class="eventtitle"><?php echo $eventVenue; ?></span></h3><br>
                   <h3><b>DATE : </b><span class="eventtitle"><?php echo $eventDateStart." <b>TO</b> ".$eventDateEnd; ?></span></h3><br>
                   <h3><b>TIME : </b><span class="eventtitle"><?php echo $eventStartTime." <b>TO</b> ".$eventEndTime; ?></span></h3><br>
                   <h3><b>FEE (₵) : </b><span class="eventtitle"><?php echo $eventFee; ?></h3><br><br>
                   <button data-toggle="modal" data-target="#generalEvent" class="btn-info btnstyle">CLICK TO REGISTER</button>
                  
              </div>
           </header>
      </div>
    </div>

<!-- modal for registration -->
   <div class="modal fade" id="generalEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close" id="close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h3 class="modal-title" align="center"><center><b><u id="subject">REGISTER FOR EVENT</u></b></center></h3>
      </div>
      <div class="modal-body" id="bg">
        <form id="insert_form" method="POST">
           <fieldset>
                  <center><h3>Step 1: Personal Details</h3></center><br />
                  <div class="row">
                      <!-- firstname -->
                    <div class="col-md-4">
                          <div class="form-group">
                            <label for="firstName">FIRST NAME</label>
                            <input type="text" class="form-control tcal" id="firstName" name="firstName" autocomplete="off" placeholder="Enter first name">
                          </div>
                    </div>
                    <!-- lastname -->
                    <div class="col-md-4">
                          <div class="form-group">
                            <label for="lastName">LAST NAME</label>
                            <input type="text" class="form-control tcal" id="lastName" name="lastName" autocomplete="off" placeholder="Enter last name"> 
                          </div>
                    </div>
                    <!-- othername -->
                    <div class="col-md-4">
                          <div class="form-group">
                            <label for="otherName">OTHER NAME</label>
                            <input type="text" class="form-control tcal" id="otherName" name="otherName" autocomplete="off" placeholder="Enter other names">
                          </div>
                    </div>
                  </div><br />
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="personalContact">PHONE NUMBER</label>
                      <input type="number" class="form-control" id="personalContact" name="personalContact" autocomplete="off" placeholder="Enter personal contact">
                    </div>
                </div>
                <div class="col-md-6">
                          <div class="form-group">
                            <label for="emergencyContact">CONTACT INCASE OF EMERGENCY</label>
                            <input type="number" class="form-control" id="emergencyContact" name="emergencyContact"  autocomplete="off" placeholder="Enter emergency contact">
                          </div>
                    </div>
              </div><br />
              <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                        <label for="houseNumber">HOUSE NUMBER</label>
                        <input type="text" class="form-control" id="houseNumber" name="houseNumber" autocomplete="off" placeholder="Enter house number">
                    </div>
                  </div>
              </div><br />
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="houseLocation">LOCATION OF HOUSE</label>
                       <textarea rows="6" class="form-control" id="houseLocation" name="houseLocation" placeholder="Enter Directions to members' house"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="postalAddress">POSTAL ADDRESS</label>
                      <textarea rows="6" class="form-control" id="postalAddress" name="postalAddress" placeholder="Enter member postal address"></textarea>
                    </div>
                  </div>
                </div><br>
                <!-- buttons -->
               <input type="button" class="next btn-success btn-block modalbtn" value="CHOOSE HOTEL" /><br>
            </fieldset>
           <fieldset>
              <center><h3>STEP 2: GhIS LSD DETAILS</h3></center><br />
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                        <label for="hotelNamesPrices">SELECT HOTEL</label>
                        <select name="hotelNamesPrices" class="form-control" id="hotelNamesPrices">
                          <option value="NONE">None</option>
                          <!-- LISTING ALL Hotels and their price range -->
                          <?php 
                            $objEvents = new Events;
                            $events = $objEvents->get_hotels(); 
                            foreach ($events as $event) {
                              // for hotel names
                              $hotelNamesSize = sizeof(json_decode($event["hotel_names"]));
                              $hotelNames  = json_decode($event["hotel_names"]);
                              // for hotel prices
                              $hotelPrices = json_decode($event["hotel_prices"]);
                              
                              for ($i=0; $i < $hotelNamesSize ; $i++) { 
                                echo '<option value="'.$hotelNames[$i].'">'.$hotelNames[$i]."\t\t\t(Price - ".$hotelPrices[$i].'GHC)</option>';
                              }
                            }
                           ?>
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
                  </div><br>
                <!-- buttons -->
                <input type="button" name="previous" class="previous btn-danger btn-block modalbtn" value="Personal Details" /><br>
                <input type="button" name="next" class="next btn-success btn-block modalbtn" value="Make Payment" /><br>
              </fieldset>
           <fieldset>
            <center><h3>FINAL STEP: MAKE PAYMENT</h3></center><br />
            <div class="row">
              <ul class="nav nav-tabs nav-justified">
                <li class="active"><a data-toggle="tab" href="#mobile_money"><b>SELECT MOBILE MONEY</b></a></li>
                <li><a data-toggle="tab" href="#bank_receipt"><b>SELECT BANK RECEIPT</b></a></li>
              </ul>
              <div class="tab-content"><br>
                <div id="mobile_money" class="tab-pane fade in active">
                  <div class="row">
                    <div class="form-group">
                        <label for="telNum">ENTER NUMBER</label>
                        <input type="number" class="form-control" id="telNum" name="telNum" autocomplete="off" placeholder="Enter phone number">
                    </div>
                  </div>
                </div>
                <div id="bank_receipt" class="tab-pane fade">
                  <div class="row">
                    <div class="form-group">
                        <label for="recieptFile">SELECT RECEIPT</label>
                        <input type="file" class="form-control" id="recieptFile" name="recieptFile">
                    </div>
                  </div>
                </div>
              </div><br>
            </div>
            <input type="button" name="previous" class="previous btn-danger btn-block modalbtn" value="Choose Hotel" /><br>
            <input type="button" name="next" class="next btn-success btn-block modalbtn" value="Register Event" /><br>
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
  <!-- for map and contact section -->
<?php require("footer.php"); ?>

<script>
  $(document).ready(function(){
        
  //for multistep modal 
      var current = 1,current_step,next_step,steps;
      fixStepIndicator(current);
      steps = $("fieldset").length;
      $(".next").click(function(){
        current_step = $(this).parent();
        next_step = $(this).parent().next();
        next_step.show();
        current_step.hide();
        fixStepIndicator(++current);
      });
      $(".previous").click(function(){
        current_step = $(this).parent();
        next_step = $(this).parent().prev();
        next_step.show();
        current_step.hide();
        fixStepIndicator(--current);
      });
      fixStepIndicator(current);
      
      function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      $('step').css('color','red');
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
  });
</script>


