<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="tasksubject">ADD TASK</b></h4>
      </div>
      <div class="modal-body" id="bg">
      <form id="task_insert_form" method="POST">
              <div class="row">
                <div class="col-md-3">
                     <div class="form-group">
                       <label for="tsk">Select Committee<span class="asterick"> *</span></label>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="form-group">
                      <select class="form-control" name="commId" id="commId" required>
                       <?php
                           // check if member has any committess
                           if (!empty($_SESSION['member_committees'])) {
                               $objCommittee = new Committee;
                               // loop through member committees and display them
                               foreach ($_SESSION['member_committees'] as $committee) {
                                  $committeeDetails = $objCommittee->get_member_committees($committee);
                                  // print_r($committeeDetails);
                                  echo " <option value='".$committeeDetails[0]["committee_id"]."'>".$committeeDetails[0]["committee_name"]."</option>";
                               }
                           }
                           ?>
                      </select>
                     </div>
                  </div>
              </div> 
              <div class="row">
                <div class="col-md-3">
                     <div class="form-group">
                       <label for="tsk">Task Name <span class="asterick" autocomplete="off"> *</span></label>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="form-group">
                       <input type="text" class="form-control" minlength="3" id="commTaskName" name="commTaskName" required>
                     </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                     <div class="form-group">
                       <label for="tsk">Task Complete Date <span class="asterick"> *</span></label>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="form-group">
                       <input type="text" class="form-control" id="commTaskExpiry" name="commTaskExpiry" data-toggle="datepicker" required autocomplete="off" readonly>
                     </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                     <div class="form-group">
                       <label for="tsk">Task Description </label>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="form-group">
                       <textarea class="form-control" id="commTaskDesc" name="commTaskDesc" rows="6" autocomplete="off"></textarea>
                     </div>
                  </div>
              </div>
              <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="taskdata_id" value="">
              <!-- for insert query -->
              <input type="hidden" name="mode" id="taskmode" value="insert">
              <div class=" modal-footer" id="bg">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info" id="tasksave_btn">Add Task <i class="fa fa-save"></i></button>
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<script>  
      $(document).ready(function(){
        // for reset modal when close
        $('#addTaskModal').on('hidden.bs.modal', function () {
            $("#tasksubject").html("ADD TASK");
            $("#task_insert_form")[0].reset();
          })

        // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

        //for inserting 
          $("#task_insert_form").on("submit",function(e){
          e.preventDefault();
                $.ajax({
                url:"Script/committeeTask.php",
                method:"POST",
                data:$("#task_insert_form").serialize(),
                beforeSend:function(){  
                    $('#tasksave_btn').text("Please wait ...");  
               },
                success:function(data){ 
                // console.log(data); 
                     $("#addTaskModal").modal("hide");
                     $("#task_insert_form")[0].reset();
                     if (data == "success") {
                      location.reload();
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });

        // for update
        $('.table').on('click', '.task_update_data', function () { 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/committeeTask.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#tasksubject").html("UPDATE TASK");
                    $("#commId").val(jsonObj[0].committee_id);
                    $("#commTaskName").val(jsonObj[0].committee_task_name);
                    $("#commTaskExpiry").val(jsonObj[0].committee_task_complete_date);
                    $("#commTaskDesc").val(jsonObj[0].committee_task_description);
                    $("#taskdata_id").val(jsonObj[0].committee_task_id);
                    $("#tasksave_btn").text("Update Task");
                    $("#taskmode").val("update");
                    $("#addTaskModal").modal("show");
                }  
               });  
          });

      // for delete
        $('.table').on('click', '.task_del_data', function () {
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/committeeTask.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          location.reload();
                      }  
                     }); 

               }else{
                return false;
              }  
          });



});  
 </script>