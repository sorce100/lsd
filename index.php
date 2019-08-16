<?php 
  include("header.php"); 
?>
    <div class="row">
      <div class="col-md-9 well">
            <div class="page-header"><h3>GhIS LSD GENERAL NEWS</h3></div>
           <div id="newsPic_carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators"></ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner"></div>
            <!-- Controls -->
            <a class="left carousel-control" href="#newsPic_carousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#newsPic_carousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
      </div>
      <!-- <div class="col-md-1"></div> -->
      <div class="col-md-3">
        <div class="page-header"><h3>UPCOMING EVENTS</h3></div>
        <?php
            $objEvents = new Events;
            $events = $objEvents->get_events_limit5(); 
            foreach ($events as $event) {
                if ($event["event_type"] == "Event") {
                  echo "<div class='row well'><a id='viewEvent' href='generealRegister.php?data=".$event["events_id"]."'>"." ".$event["events_theme"]."</a><span class='badge'> Event</span></div><br />";
                }
                elseif ($event["event_type"] == "Meeting") {
                   echo "<div class='row well'><a id='viewMeeting' name=".$event["events_id"].">"." ".$event["events_theme"]."</a><span class='badge'> Meeting</span></div><br />";
                }
                    
            }
        ?>
      </div>
    </div>
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
  <!-- View Event Modal -->
  <div class="modal fade" id="viewMeetingModal" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title">Upcoming Meeting</h4>
      </div>
      <div class="modal-body" >
          <div class="row">
            <div class="col-md-13" id="meetingDetails">
              
            </div> 
          </div>
          <br> <br> 
          <!-- buttons for attending or not attending -->
          <div class="row">
            <div class="col-md-4">
              <label for="studentFirstName">WILL YOU BE ATTENDING ?</label>
            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn-block btn-info" id="meetingYes" name="" > YES <i class="glyphicon glyphicon-ok"></i></button>
            </div>

            <div class="col-md-4">
              <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-block btn-danger" id="meetingNo" name="meetingNo" > NO <i class="glyphicon glyphicon-remove"></i></button>

            </div>
          </div><br><hr><br>
          <!-- for entering name and diploma number when attending meeting -->
          <div class="row attendantDiv">
          </div>
      </div>
          
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <!-- mcafee antivirus -->
  <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
  </body>
</html>
<br><br>
<div class="clearfix"></div>
<footer>
  <div class="container-fluid">
    <center>
      <p class="copyright">POWERED BY <a href="http://theprismoid.com/" target="_blank">THE PRISMOIDAL COMPANY LIMITED</a> &copy; <?php echo date('Y'); ?>  All Rights Reserved.</p>
    </center>
  </div>
</footer>
 <?php include("footer.php"); ?>
<script>
  $(document).ready(function(){
            var mode = "get_all";
            $.ajax({  
                url:"pages/Script/news.php",  
                method:"POST",  
                data:{mode:mode},  
                success:function(data){
                    var jsonObj = JSON.parse(data);
                     for (var i = 0; i < jsonObj.length; ++i) {
                          var title = jsonObj[i].news_title;
                          var folder_name = jsonObj[i].folder_name;
                          var picsArray = JSON.parse(jsonObj[i].file_name);
                        for (var j = 0; j < picsArray.length; ++j) {
                              
                              $('<div class="item"><img src="uploads/news/'+folder_name+'/'+picsArray[j]+'" style="width:100%;height:500px;"><div class="carousel-caption"><h1>'+title+'</h1><a href="generalNews.php" class="btn btn-primary"><b>Click to Read more</b></a></div></div>').appendTo('.carousel-inner');
                              $('<li data-target="#newsPic_carousel" data-slide-to="'+i+'"></li>').appendTo('.carousel-indicators')
                        }
                        $('.item').first().addClass('active');
                        $('.carousel-indicators > li').first().addClass('active');
                        $('#newsPic_carousel').carousel();

                     }

                }  
            });
//////////////////////////////////////////////////////////////////////////////////////
    // for displaying form for user name input for meetin register
    $(document).on('click', '#meetingYes', function(){
      let eventId = $(this).prop('name');
      $('.attendantDiv').html('<div class="row">'+
                '<div class="col-md-6">'+
                  '<div class="form-group">'+
                    '<input type="email" class="form-control" id="attendantName" placeholder="Enter Full name" name="attendantName" autocomplete="off" required>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                  '<div class="form-group">'+
                    '<input type="number" class="form-control" id="attendantDipNo" placeholder="Enter Diploma Number ( optional )" name="attendantDipNo" autocomplete="off" required>'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-2">'+
                  '<button type="button" class="btn btn-block btn-success" id="meetingAttendSave" name="'+eventId+'" > Save <i class="glyphicon glyphicon-floppy-disk"></i></button>'+
                '<div>'+
              '</div>');
    });
//////////////////////////////////////////////////////////////////////////////////////
// save attendant details
    $(document).on('click', '#meetingAttendSave', function(e){
       e.preventDefault();

      let mode = 'meeting_register';
      let eventId = $(this).prop('name');
      let memberName = $('#attendantName').val();
      let dipNo = $('#attendantDipNo').val();

      if (memberName !="") {
        if (confirm("Register for this meeting ?")) {
            $.ajax({
              url:"pages/Script/eventsregister.php",
              method:"POST",
              data:{data_id:eventId,mode:mode,dipNo:dipNo,memberName:memberName},
              beforeSend:function(){  
                  $('#meetingAttendSave').val("Please wait ...").prop('disabled',true);  
               },
              success:function(data){  
                console.log(data);
                   $("#viewMeetingModal").modal("hide");
                   if (data == "success") {
                    alert('Registered Successfully, see you there!')
                   }
                   else {
                    alert("Sorry, there was a problem registering, please try again later");
                   }
                } 

            });
          }else{ return false;}
      }else{
        alert("Name cannot be empty");
      }


    });


//////////////////////////////////////////////////////////////////////////////////////
    // meeting view
    $(document).on('click', '#viewMeeting', function(){
      // let meetingId = $(this).prop('name');
      var mode= "updateModal"; 
           var data_id = $(this).prop('name');
           $.ajax({  
                url:"pages/Script/events.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                    $('#meetingYes').prop('name',jsonObj[0].events_id);// 
                    $('#meetingDetails').html('<div class="well">'+
                                                '<p class="text-left"><b>AGENDA : </b>'+jsonObj[0].events_theme+'</p><br>'+
                                                '<p class="text-left"><b>LOCATION : </b>'+jsonObj[0].event_venue+'</p><br>'+
                                                '<p class="text-left"><b>DATE : </b>'+jsonObj[0].event_date_end+'</p><br>'+
                                                '<p class="text-left"><b>TIME : </b>'+jsonObj[0].start_time+' - '+jsonObj[0].end_time+'</p>'+
                                              '</div>');
                    $("#viewMeetingModal").modal("show");
                }  
            });
    });

//////////////////////////////////////////////////////////////////////////////////////

});

</script>
