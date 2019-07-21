<?php 
      include("header.php");
      require_once("Classes/ExamCenterSetup.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">Examination Center Setup</h3>
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
              <div class="col-md-2">
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> Add New</button>
              </div>
            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Center Name</th>
<!--                             <th>Total</th> -->
                            <th>Region</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                      <!-- <td>".sizeof(json_decode($center["exam_center_subject"]))."</td> -->
                      <?php
                          $objExamCenterSetup = new ExamCenterSetup;
                          $centers = $objExamCenterSetup->get_centers(); 
                          foreach ($centers as $center) {
                                  echo "
                                      <tr >
                                        <td>".$center["exam_center_name"]."</td>
                                        
                                        <td>".$center["exam_center_region"]."</td>
                                        <td>".$center["date_done"]."</td>
                                        <td>
                                          <input type='button' value='Update' id='".trim($center["exam_center_id"])."' class='btn btn-info btn-xs update_data' />

                                          <input type='button' value='Delete' id='".trim($center["exam_center_id"])."' class='btn btn-danger btn-xs del_data' />
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
<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title" id="subject">Add New Center</h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST"> 
              <div class="row">
                <!-- center name and region-->
                <div class="col-md-8">
                    <div class="form-group">
                       <label for="centerName">Exams Center Name</label>
                       <input type="text" class="form-control" id="centerName" placeholder="Exam center name &hellip;" name="centerName" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="centerRegion">Region</label>
                       <select class="form-control regionSelect2" name="centerRegion" id="centerRegion" required>
                        <option selected disabled>Select Center Region</option>
                        <option value="Greater Accra">Greater Accra </option>
                        <option value="Central">Central </option>
                        <option value="Eastern">Eastern </option>
                        <option value="Western">Western </option>
                        <option value="Ashanti">Ashanti </option>
                        <option value="Northern">Northern </option>
                        <option value="Upper East">Upper East </option>
                        <option value="Upper West">Upper West Wa</option>
                        <option value="Volta">Volta </option>
                        <option value="Brong Ahafo">Brong Ahafo </option>
                       </select>
                    </div>
                </div>
              </div>
              <hr>
              <!-- EXAMS SUBJECT OFFERED -->
              <div class="row">
                <div class="col-md-10 subjectAddDiv">
                  <label for="centerName">Center Exams Title</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <input class="form-control" type="text" id="centerExamSubject" name="centerExamSubject[]" autocomplete="off" required>
                    <span class="input-group-addon "><i class="fa fa-trash"></i></span>
                  </div>
                </div>
                <div class="col-md-2">
                  <span name="addNewSubject" class=" btn btn-info" id="addNewSubject"><b>Add Subject</b></span>
                </div>
              </div>
              <hr>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="SAVE CENTER" />
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
        // FOR CLICK TO ADD FOR new subject
        let i=1;  
          $('#addNewSubject').click(function(){  
               i++;  
               $('.subjectAddDiv').append('<div class="input-group" id="row'+i+'" style="margin-top:7px;"><span class="input-group-addon"><i class="fa fa-pencil"></i></span><input class="form-control" type="text" id="centerExamSubject" name="centerExamSubject[]" autocomplete="off"><span class="input-group-addon btn_remove" id="'+i+'" style="background-color:#DE8280;color:#fff;"><i class="fa fa-trash"></i></span></div>');  
          });  
          $(document).on('click', '.btn_remove', function(){  
               let button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
          });
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#subject").html("Add New Center");
            $("#insert_form")[0].reset();
            
          });

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
                $.ajax({
                url:"Script/examCenterSetup.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                    $('#save_btn').val("Please wait ...").prop('disabled',true);  
               },
                success:function(data){  
                  // alert(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("examcenter_setup.php");
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
                url:"Script/examCenterSetup.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                  // clear the subjects div before updating content
                    $('.subjectAddDiv').html('');

                    var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("Update Exam Center");
                    $("#centerName").val(jsonObj[0].exam_center_name);
                    $("#centerRegion").val(jsonObj[0].exam_center_region);
                    //////////////////////////////////////////////////////////
                    // update exams titiles
                    let jsonObjSubject = JSON.parse(jsonObj[0].exam_subjects);
                    for (let i = 0; i < jsonObjSubject.length; i++) {
                      // console.log(jsonObjChecklist[i]);
                      $('.subjectAddDiv').append('<div class="input-group" id="row'+i+'" style="margin-top:7px;">'+
                        '<span class="input-group-addon"><i class="fa fa-pencil"></i></span>'+
                        '<input class="form-control" type="text" value="'+jsonObjSubject[i]+'" id="centerExamSubject" name="centerExamSubject[]" autocomplete="off">'+
                        '<span class="input-group-addon btn_remove" id="'+i+'" style="background-color:#DE8280;color:#fff;"><i class="fa fa-trash"></i></span></div>');
                    }
                    
                    $("#data_id").val(jsonObj[0].exam_center_id);
                    $("#save_btn").val("Update Exam Center");
                    $("#mode").val("update");
                    $("#myModal").modal("show");
                  }  
               });  
          });

      // for delete
        $(document).on('click', '.del_data', function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/examCenterSetup.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("examcenter_setup.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });

          });  
 </script>