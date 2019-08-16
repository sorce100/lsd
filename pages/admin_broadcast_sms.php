<?php
  include("header.php");
  require_once("Classes/Messages.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">SMS BROADCAST SETUP </div>
            <div class="panel-title pull-right">
               <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> NEW BROADCAST</button>
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

            </div>
            <!-- end of content -->
        </div>
    </div>

</div>
<!--  -->
<!-- modal  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header" id="bg">
       <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
      <h4 class="modal-title"><b id="subject">BROADCAST MESSAGES</b></h4>
    </div>
    <div class="modal-body" id="bg">
      <form id="insert_form" method="POST">
         <div class="row">
           <!-- select group or general members  -->
           <div class="col-md-6">
             <div class="row">
               <div class="col-md-12">
                 <div class="form-group">
                      <label for="title">SELECT RECEIVER GROUP</label>
                      <select class="form-control" name="broadcastAccounts" id="broadcastAccounts" required>
                        <option  disabled selected>Select Receivers</option>
                        <option value="members">Members</option>
                        <option value="students">Applicants</option>
                      </select>
                  </div>
               </div>

               <hr>

               <!-- for members list -->
               <div class="col-md-12">
                 <div class="table-responsive"><br>
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th></th>
                                  <th><input type="checkbox" id="select_all"/> <b>select all</b></th>
                                  <th>ID</th>
                                  <th>NAME</th>
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
           <div class="col-md-6">
               <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">COMPOSE BROADCAST SMS</label>
                        <textarea class="form-control" id="smsContent" name="smsContent" autocomplete="off" rows="10" placeholder="Enter text message to be sent to selected receivers" required></textarea>
                    </div>
                 </div>
               </div>
               <input type="hidden" name="mode" id="mode" value="insert">
                <div class="well modal-footer" id="bg">
                    <button type="submit" class="btn btn-info btn-block" id="save_btn">ASEND BROADCAST MESSAGE <i class="fa fa-send"></i></button>
                </div>
            </div>
        </form>
     <!-- for inputing the messages and the message title -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include("footer.php");?>

<script>

// for reset modal when close
    $('#myModal').on('hidden.bs.modal', function () {
        $("#subject").html("BROADCAST MESSAGES");
        $("#insert_form")[0].reset();
      })

    // for search
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#memberList tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    // checkboxes select all
    $('#select_all').change(function() {
        var checkboxes = $(this).closest('form').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
    });

// query using the group id from the users table
$("#broadcastAccounts").change(function(){
    var accountType = $(this).val();
    switch (accountType){
      case 'members':
        var mode = "get_members";
            $.ajax({
            url:"Script/members.php",
            method:"POST",
            data:{mode:mode},
            beforeSend:function(){  
                  $('#memberList').html('');
                 },
            success:function(data){
                  // display the list now
                  var jsonObj = JSON.parse(data);
                  for (var i = 0; i < jsonObj.length; ++i) {
                    $('#memberList').append('<tr><td></td><td><input type="checkbox" class="input-md" name="memberList[]" id="memberList[]" value="'+jsonObj[i].members_id+'|'+jsonObj[i].personal_contact+'|member"></td><td>'+jsonObj[i].professional_number+'</td><td>'+jsonObj[i].first_name+' '+jsonObj[i].last_name+'</td></tr>');
                  }
            } 

          });
      break;
      case 'students':
          var mode = "get_students";
            $.ajax({
            url:"Script/student.php",
            method:"POST",
            data:{mode:mode},
            beforeSend:function(){  
                  $('#memberList').html('');
                 },
            success:function(data){
              // console.log(data);
                  // display the list now
                  var jsonObj = JSON.parse(data);
                  for (var i = 0; i < jsonObj.length; ++i) {
                    $('#memberList').append('<tr><td></td><td><input type="checkbox" class="input-md" name="memberList[]" id="memberList" value="'+jsonObj[i].student_id+'|'+jsonObj[i].student_tel+'|student"></td><td>'+jsonObj[i].student_id+'</td><td>'+jsonObj[i].student_first_name+' '+jsonObj[i].student_last_name+'</td></tr>');
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
            url:"Script/sms.php",
            method:"POST",
            data:$("#insert_form").serialize(),
            beforeSend:function(){  
                      $('#save_btn').text("Please wait ...");  
                 },
            success:function(data){
            // alert(data);  
                 $("#myModal").modal("hide");
                 $("#insert_form")[0].reset();
                  location.reload();
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
            // alert(data);
            var jsonObj = JSON.parse(data);  
             // changing modal title
            $("#subject").html("READ MESSAGES");
            $("#messageGroup").val(jsonObj.message_group).attr('disabled', 'true');
            $("#messageSubject").val(jsonObj.message_subject).attr('readonly', 'true');
            $("#messageContent").val(jsonObj.message_content).attr('readonly', 'true');
            $("#data_id").val(jsonObj.message_id);
            // $("#save_btn").val("CLOSE");
            $("#mode").val("update");
            $("#myModal").modal("show");

          }  
       });

});  

</script>