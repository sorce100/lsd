<?php
  include("header.php");
  require_once("Classes/Messages.php");
?>
<br>
<div class="row">
  <!-- first part of div -->
  <div class="col-md-12 ">
    <div class="panel panelTabs" >
      <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#inbox">INBOX <i class="fa fa-inbox"></i></a></li>
        <li><a data-toggle="tab" href="#sent">SENT <i class="fa fa-send"></i></a></li>
      </ul>
    </div>
  </div>
</div>


<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">MESSAGES</div>
            <div class="panel-title pull-right">
               <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> COMPOSE NEW</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <!-- content -->
            <div class="col-md-12">
                <div class="tab-content">
                    <div id="inbox" class="tab-pane fade in active">
                            <!-- for search -->
                            <div class="col-md-12">
                              
                                <div class="input-group">
                                  <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="membersearchInput" autocomplete="off">
                                  <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                                </div>
                            </div>
                          <br>
                          <div class="col-md-12">
                            <div class="table-responsive"><br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SUBJECT</th>
                                            <th>DATETIME RECEIVED</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="memberresultsDisplay">
                                        <?php
                                            $objSchoolMessages = new Messages;
                                            $sentMessages = $objSchoolMessages->get_received_messages(); 
                                            // foreach ($sentMessages as $sentMessage) {  
                                              foreach ($sentMessages as $sentMessage) {
                                                // decoding the message receivers array
                                                $decodedReceivers = json_decode($sentMessage["message_receivers"]);
                                                
                                                // loop through the array and compaare with the session user id for receivers
                                                for ($i=0; $i < sizeof($decodedReceivers); $i++) {
                                                  // compare with session id
                                                  if ($decodedReceivers[$i] == $_SESSION['user_id']) {
                                                      echo "
                                                          <tr>
                                                            <td>".$sentMessage["message_subject"]."</td>
                                                            <td>".$sentMessage["date_done"]."</td>
                                                            <td>".$sentMessage["message_status"]."</td>
                                                            <td>
                                                              <input type='button' name='view' value='READ MESSAGE' id='".trim($sentMessage["message_id"])."' class='btn btn-info btn-xs read_message' />
                                                            </td>
                                                          </tr>
                                                        ";
                                                  }
                                                  
                                                }
                                                
                                              }
                                           ?>
                                    </tbody>
                                </table>
                            </div>
                          </div>
                     </div>
                      <!-- tabs content for sent messages -->
                      <div id="sent" class="tab-pane fade">
                          <!-- for search -->
                            <div class="col-md-12">
                                <div class="input-group">
                                  <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="schoolsearchInput" autocomplete="off">
                                  <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                                </div>
                            </div>
                          <br>
                          <div class="col-md-12">
                            <div class="table-responsive"><br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SUBJECT</th>
                                            <th>DATETIME SENT</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="schoolresultsDisplay">
                                        <?php
                                            $objSchoolMessages = new Messages;
                                            $sentMessages = $objSchoolMessages->get_sent_messages(); 
                                            foreach ($sentMessages as $sentMessage) {                                
                                                    echo "
                                                        <tr>
                                                          <td>".$sentMessage["message_subject"]."</td>
                                                          <td>".$sentMessage["date_done"]."</td>
                                                          <td>
                                                            <input type='button' name='view' value='READ MESSAGE' id='".trim($sentMessage["message_id"])."' class='btn btn-info btn-xs read_message' />
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
            <!-- end of content -->
        </div>
    </div>

</div>



<!-- modal  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header" id="bg">
       <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
      <h4 class="modal-title"><b id="subject">COMPOSE MESSAGES</b></h4>
    </div>
    <div class="modal-body" id="bg">
      <form id="insert_form" method="POST">
         <div class="row">
           <!-- select group or general members  -->
           <div class="col-md-5">
             <div class="row">
               <div class="col-md-12">
                 <div class="form-group">
                      <label for="title">SELECT RECEIVER GROUP</label>
                      <select class="form-control" name="messageGroup" id="messageGroup" required>
                        <option  disabled selected>Select Group</option>
                        <option value="all">GENERAL USERS</option>
                        <option value="group">ACCOUNT MEMBERS</option>
                      </select>
                  </div>
               </div>
               <!-- for members list -->
               <div class="col-md-12">
                 <div class="table-responsive"><br>
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th></th>
                                  <th><input type="checkbox" id="select_all"/> <b>select all</b></th>
                                  <th>USERNAME</th>
                                  <th>ACCOUNT TYPE</th>
                              </tr>
                          </thead>
                          <tbody id="memberList">
                              
                          </tbody>
                      </table>
                  </div>
               </div>
             </div>
           </div>
           <!-- second part -->
           <div class="col-md-7" style="border-left: 1px solid #2F323E;">
             <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="title">MESSAGE SUBJECT</label>
                      <input type="text" class="form-control" id="messageSubject" name="messageSubject" placeholder="Enter subject of message" autocomplete="off" required>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                      <label for="title">MESSAGE CONTENT</label>
                      <textarea class="form-control" id="messageContent" name="messageContent" autocomplete="off" rows="16" required></textarea>
                  </div>
               </div>
             </div>
           </div>
         </div>
         <input type="hidden" name="mode" id="mode" value="insert">
          <div class="well modal-footer" id="bg">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
              <button type="submit" class="btn btn-info" id="save_btn">Send Message <i class="fa fa-save"></i></button>
          </div>
        </form>
     <!-- for inputing the messages and the message title -->
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- Messagge Reader modal -->
<div class="modal fade" id="msgReaderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">Message Reader</b></h4>
      </div>
      <div class="modal-body" id="bg">
        <form id="insert_form" method="POST"> 
            <div class="row">
                <div class="col-md-2">
                  <label for="title">SENDER</label>
                </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control" id="messageReaderSender" readonly>
                </div>
               </div>
               <div class="col-md-3">
                <div class="form-group">
                  <input type="text" class="form-control" id="messageReaderDate" readonly>
                </div>
               </div>
            </div>


            <div class="row">
              <div class="col-md-2">
                  <label for="title">SUBJECT</label>
              </div>
              <div class="col-md-10">
                  <div class="form-group">
                     <input type="text" class="form-control" id="messageReaderSubject" readonly>
                  </div>
               </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                  <label for="title">CONTENT</label>
              </div>
               <div class="col-md-10">
                  <div class="form-group">
                      
                      <textarea class="form-control" id="messageReaderContent" rows="16" readonly></textarea>
                  </div>
               </div>
             </div>

           <!-- for insert query -->
          <input type="hidden" name="mode" id="mode" value="insert">
          <div class=" modal-footer" id="bg">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
          </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include("footer.php");?>

<script>
  $(document).ready(function(){

      $('#insert_form').parsley();


      $('#myModal').on('hidden.bs.modal', function () {
        $("#insert_form")[0].reset();
        $('#insert_form').parsley().reset();
      });

      // checkboxes select all
      $('#select_all').change(function() {
          var checkboxes = $(this).closest('form').find(':checkbox');
          checkboxes.prop('checked', $(this).is(':checked'));
      });

      // for reset modal when close
      $('#myModal').on('hidden.bs.modal', function () {
          $("#subject").html("ADD NEW PAGE");
          $("#insert_form")[0].reset();
        })

      // for search
      $("#searchInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#resultsDisplay tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });

      // query using the group id from the users table
      $("#messageGroup").change(function(){
          var group = $(this).val();
          switch (group){
            case 'all':
              var mode = "get_all_members";
                  $.ajax({
                  url:"Script/users.php",
                  method:"POST",
                  data:{mode:mode},
                  beforeSend:function(){  
                        $('#memberList').html('');
                       },
                  success:function(data){
                        // display the list now
                        var jsonObj = JSON.parse(data);
                        for (var i = 0; i < jsonObj.length; ++i) {
                          $('#memberList').append('<tr><td></td><td><input type="checkbox" class="input-md" name="memberList[]" id="memberList[]" value="'+jsonObj[i].user_id+'"></td><td>'+jsonObj[i].member_id+'</td><td>'+jsonObj[i].account_type+'</td></tr>');
                        }
                  } 

                });
            break;
            case 'group':
                var mode = "get_group_members";
                  $.ajax({
                  url:"Script/users.php",
                  method:"POST",
                  data:{mode:mode},
                  beforeSend:function(){  
                        $('#memberList').html('');
                       },
                  success:function(data){
                        // display the list now
                        var jsonObj = JSON.parse(data);
                        for (var i = 0; i < jsonObj.length; ++i) {
                          $('#memberList').append('<tr><td></td><td><input type="checkbox" class="input-md" name="memberList[]" id="memberList" value="'+jsonObj[i].user_id+'"></td><td>'+jsonObj[i].member_id+'</td><td>'+jsonObj[i].account_type+'</td></tr>');
                        }
                  } 

                });
            break;
          }

        });

      // for inserting the messages into database
      $("#insert_form").on("submit",function(e){
          e.preventDefault();
                $.ajax({
                url:"Script/message.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').text("Please wait ...");  
                     },
                success:function(data){  
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                        toastr.success(' Successfull');
                        location.reload();
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
        });

      // read messages
      $('.read_message').click(function(){ 
         var mode= "readMessage"; 
         var data_id = $(this).attr("id");  
         $.ajax({  
              url:"Script/message.php",  
              method:"POST",  
              data:{data_id:data_id,mode:mode},  
              success:function(data){
                  // console.log(data);
                  var jsonObj = JSON.parse(data);  
                   // changing modal title
                  $("#subject").html("READ MESSAGES");
                  $("#messageReaderSender").val(jsonObj.member_id);
                  $("#messageReaderSubject").val(jsonObj.message_subject);
                  $("#messageReaderContent").val(jsonObj.message_content);
                  $("#messageReaderDate").val(jsonObj.date_done);
                  $("#msgReaderModal").modal("show");

                }  
             });

      });  
});
</script>