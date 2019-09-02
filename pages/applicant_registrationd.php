<?php 
      include("header.php");
      require_once("Classes/NewApplication.php");
      require_once("Classes/EmailSend.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">NEW APPLICANTS DECLARATION </div>
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
                            <th>APPLICANT NAME</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                        <tr>
                            <?php
                                $objEmailSend = new EmailSend;
                                $objNewApplication = new NewApplication;
                                $applicants = $objNewApplication->get_proposer_list();
                                foreach ($applicants as $applicant) {
                                  if (empty(trim($applicant['member_declare_date']))) {
                                      $student_id = trim($applicant['student_id']);
                                      $appId = trim($applicant['new_application_id']);
                                      // $fullName = $objEmailSend->recordHide;
                                      echo "<td>".$objEmailSend->get_student_fullName($student_id)."</td>";
                                      echo "<td><button type='button' name='".$student_id."' value='VIEW DETAILS' id='".$appId."' class='btn btn-info btn-xs view_app_details'>MAKE DECLARATION <i class='fa fa-check-square-o'></i></button></td>";
                                  }
                                }
                             ?>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
            <!-- end of content -->
        </div>
    </div>
</div>
<!--  -->

<!-- /.row -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">NEW MEMBER APPLICATION DETAILS</b></h4>
      </div>
      <div class="modal-body" id="bg">
        <form id="insert_form"> 
            <div class="row">
              <div class="col-md-4">
                  <label for="title">APPLICANT START DATE</label>
              </div>
              <div class="col-md-8">
                  <div class="form-group">
                     <input type="text" class="form-control" id="startDate" val="" readonly>
                  </div>
               </div>
            </div>
            <!--  -->
            <div class="row">
              <div class="col-md-4">
                  <label for="title">COLLEGE DECLARATION DATE</label>
              </div>
              <div class="col-md-8">
                  <div class="form-group">
                     <input type="text" class="form-control" id="colDeclareDate" val="" readonly>
                  </div>
               </div>
            </div>
            <!--  -->
            <div class="row">
              <div class="col-md-4">
                  <label for="title">EMPLOYER DECLARATION DATE</label>
              </div>
              <div class="col-md-8">
                  <div class="form-group">
                     <input type="text" class="form-control" id="empDeclareDate" val="" readonly>
                  </div>
               </div>
            </div>
            <!--  -->
            <div class="row">
              <div class="col-md-4">
                  <label for="title">APPLICANT NOTE</label>
              </div>
              <div class="col-md-8">
                  <div class="form-group">
                     <textarea class="form-control" rows="8" id="memberNote" readonly></textarea>
                  </div>
               </div>
            </div>


             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
              <input type="hidden" name="student_id" id="student_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="proposerDeclare">
            <div class="well modal-footer" id="bg">
                <button type="submit" id="save_btn" class="btn btn-info btn-block" name="submit" >DECLARE APPLICANT <i class="fa fa-save"></i></button>
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
            $("#subject").html("ADD NEW SURVEYOR TYPE");
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
          if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
              $.ajax({
                url:"Script/newApplication.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').text("Please wait ...").prop('disabled',true);  
                     },
                success:function(data){
                      toastr.success(' Successfull');
                      alert(data);  
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                      window.location.reload();
                } 

              });
            }else{
                return false;
              }  
          });
        // for update
        $('.view_app_details').click(function(){ 
          $("#startDate #colDeclareDate #empDeclareDate #memberNote").html('');
          $("#memberNote").val('');
           var mode = "proposer_viewApplication"; 
           var data_id = $(this).attr("id");
           var studentId = $(this).attr("name");
           $.ajax({  
                url:"Script/newApplication.php",  
                method:"POST",  
                data:{student_id:studentId,data_id:data_id,mode:mode},  
                success:function(data){
                    var jsonObj = JSON.parse(data);  
                    $("#startDate").val(jsonObj["application_startDate"]);
                    $("#colDeclareDate").val(jsonObj["col_declare_date"]);
                    $("#empDeclareDate").val(jsonObj["emp_declare_date"]);
                    $("#memberNote").val(jsonObj["member_declare_note"]);
                    $("#data_id").val(data_id);
                    $("#student_id").val(studentId);
                    $("#mode").val("insertD");
                    $("#myModal").modal("show");
                }  
            });  
          });


});
 </script>