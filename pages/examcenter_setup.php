<?php 
  include("header.php");
  require_once("Classes/ExamCenterSetup.php");
  require_once("Classes/ExamModuleSetup.php");
?>
<br>
<div class="row">
  <!-- first part of div -->
  <div class="col-md-12 ">
    <div class="panel panelTabs" >
      <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#examscenter">Exam Center Setup <i class="fa fa-globe"></i></a></li>
        <li><a data-toggle="tab" href="#examsmodules">Exam Modules Setup <i class="fa fa-file"></i></a></li>
      </ul>
    </div>
  </div>
</div>


<div class="tab-content">
    <div id="examscenter" class="tab-pane fade in active">
      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <div class="row">
            <!-- <div class="col-sm-12"> -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     <div class="panel-title pull-left">EXAMINATION CENTER SETUP </div>
                    <div class="panel-title pull-right">
                       <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> Add New</button>
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
                      <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Center Name</th>
                                    <th>Region</th>
                                    <th>Date</th>
                                    <th></th>
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
                                              <button type='button' id='".trim($center["exam_center_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                            </td>
                                            <td>
                                              <button type='button' id='".trim($center["exam_center_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
                                            </td>
                                          </tr>
                                        ";
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
      <!--  -->
    </div>
    <div id="examsmodules" class="tab-pane fade">
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
      <div class="row">
          <!-- <div class="col-sm-12"> -->
          <div class="panel panel-default">
              <div class="panel-heading">
                   <div class="panel-title pull-left">EXAM CENTER MODULES </div>
                  <div class="panel-title pull-right">
                     <button data-toggle="modal" data-target="#examModuleModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> Add New</button>
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
                    <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>EXAM CENTER</th>
                                    <th>EXAM PART</th>
                                    <th>EXAM SUBJECTS</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="resultsDisplay">
                                <?php
                                  $objExamModuleSetup = new ExamModuleSetup;
                                  $modules = $objExamModuleSetup->get_center_modules(); 
                                  foreach ($modules as $module) {
                                          echo "
                                              <tr >
                                                <td>".$objExamModuleSetup->get_center_name($module["center_id"])."</td>
                                                <td>".$module["center_exam_part"]."</td>
                                                <td>".$module["subject_name"]."</td>
                                                <td>
                                                  <button type='button' id='".trim($module["subject_id"])."' class='btn btn-info btn-xs moduleupdate_data'>Update <i class='fa fa-edit'></i></button>
                                                </td>
                                                <td>
                                                  <button type='button' id='".trim($module["subject_id"])."' class='btn btn-danger btn-xs moduledel_data'>Delete <i class='fa fa-trash'></i></button>
                                                </td>
                                              </tr>
                                            ";
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
      <!--  -->
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

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
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info" id="save_btn">Add Center <i class="fa fa-save"></i></button>
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="examModuleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title" id="modulesubject">Add Exam Module</h4>
      </div>
      <div class="modal-body" id="bg">
      <form id="moduleinsert_form" method="POST"> 
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                       <label for="centerName">Select Center <span class="asterick"> *</span></label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                      <select class="form-control" id="centerId" name="centerId" required> 
                        <?php
                          $objExamCenterSetup = new ExamCenterSetup;
                          $centers = $objExamCenterSetup->get_centers(); 
                          foreach ($centers as $center) {
                              echo "<option value='".trim($center["exam_center_id"])."'>".$center["exam_center_name"]."</option>";
                          }
                        ?>
                      </select>

                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                       <label for="centerName">Exams Part <span class="asterick"> *</span></label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                       <input type="text" class="form-control" id="centerExamPart" placeholder="Part A or Part B" name="centerExamPart" autocomplete="off" required>
                    </div>
                </div>
              </div>
              <hr>
              <!-- EXAMS SUBJECT OFFERED -->
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                       <label for="centerName">Exams Modules <span class="asterick"> *</span></label>
                    </div>
                </div>
                <div class="col-md-8 subjectAddDiv">
                  <label for="centerName">Exams Subject</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <input class="form-control" type="text" id="centerExamSubject" name="centerExamSubject[]" autocomplete="off" required>
                    <span class="input-group-addon "><i class="fa fa-trash"></i></span>
                  </div>
                </div>
                <div class="col-md-2">
                  <span name="addNewSubject" class=" btn btn-danger" id="addNewSubject"><b>Add Subject <i class="fa fa-plus"></i></b></span>
                </div>
              </div>
              <hr>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="moduledata_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="modulemode" value="insert">
            <div class="well modal-footer" id="bg">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info" id="modulesave_btn">Add Module <i class="fa fa-save"></i></button>
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
        // FOR CLICK TO ADD FOR new subject
        let i=1;  
          $('#addNewSubject').click(function(){  
               i++;  
               $('.subjectAddDiv').append('<div class="input-group" id="row'+i+'" style="margin-top:7px;"><span class="input-group-addon"><i class="fa fa-pencil"></i></span><input class="form-control" type="text" id="centerExamSubject" name="centerExamSubject[]" autocomplete="off"><span class="input-group-addon btn_remove" id="'+i+'" style="background-color:#DE8280;color:#fff;"><i class="fa fa-trash"></i></span></div>');  
          });  
          $('table').on('click', '.btn_remove', function(){  
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
                    $('#save_btn').text("Please wait ...").prop('disabled',true);  
               },
                success:function(data){  
                  // alert(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      location.reload();
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });

         // for update
         $('table').on('click', '.update_data', function(){
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
                    $("#data_id").val(jsonObj[0].exam_center_id);
                    $("#save_btn").text("Update Exam Center");
                    $("#mode").val("update");
                    $("#myModal").modal("show");
                  }  
               });  
          });

      // for delete
        $('table').on('click', '.del_data', function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/examCenterSetup.php",  
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


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////exams module setup
////////////////////////////////////////////////////////////////////////////////////////////////////////////
      //for inserting 
      $("#moduleinsert_form").on("submit",function(e){
          e.preventDefault();
                $.ajax({
                url:"Script/examModuleSetup.php",
                method:"POST",
                data:$("#moduleinsert_form").serialize(),
                beforeSend:function(){  
                    $('#modulesave_btn').text("Please wait ...").prop('disabled',true);  
                },
                success:function(data){  
                  // alert(data);
                     $("#examModuleModal").modal("hide");
                     $("#moduleinsert_form")[0].reset();
                     if (data == "success") {
                      location.reload();
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });


      $('table').on('click', '.moduleupdate_data', function(){
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/examModuleSetup.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                  // clear the subjects div before updating content
                    $('.subjectAddDiv').html('');

                    var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#modulesubject").html("Update Exam Module");
                    $("#centerExamPart").val(jsonObj[0].center_exam_part);
                    //////////////////////////////////////////////////////////
                    // update exams titiles
                    let jsonObjSubject = JSON.parse(jsonObj[0].subject_name);
                    for (let i = 0; i < jsonObjSubject.length; i++) {
                      // console.log(jsonObjChecklist[i]);
                      $('.subjectAddDiv').append('<div class="input-group" id="row'+i+'" style="margin-top:7px;">'+
                        '<span class="input-group-addon"><i class="fa fa-pencil"></i></span>'+
                        '<input class="form-control" type="text" value="'+jsonObjSubject[i]+'" id="centerExamSubject" name="centerExamSubject[]" autocomplete="off">'+
                        '<span class="input-group-addon btn_remove" id="'+i+'" style="background-color:#DE8280;color:#fff;"><i class="fa fa-trash"></i></span></div>');
                    }
                    
                    $("#moduledata_id").val(jsonObj[0].subject_id);
                    $("#modulesave_btn").text("Update Module");
                    $("#modulemode").val("update");
                    $("#examModuleModal").modal("show");
                  }  
               });  
          });
      
       // for delete
        $('table').on('click', '.moduledel_data', function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/examCenterSetup.php",  
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

///////////////////////////////////////////////////////////////////////////////////////////////

});  
 </script>