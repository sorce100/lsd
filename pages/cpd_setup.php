<?php 
  include("header.php");
  require_once("Classes/CpdSetup.php");
  require_once("Classes/CpdRegister.php");
?>
<br>
<div class="row">
  <!-- first part of div -->
  <div class="col-md-12 ">
    <div class="panel panelTabs" >
      <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#subscribers">CPD SUBSCRIBERS <i class="fa fa-users"></i></a></li>
        <li><a data-toggle="tab" href="#setup">CPD SETUP <i class="fa fa-cog"></i></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tab-content">
          <!-- /////////////////////////////////////////////////////////// -->
            <div id="subscribers" class="tab-pane fade in active">
                 <div class="panel panel-default">
                    <div class="panel-heading ">
                        <div class="panel-title pull-left">CPD SUBSCRIBERS</div>
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
                                            <th>CPD</th>
                                            <th>CPD MEMBER</th>
                                            <th>DIPLOMA NO</th>
                                            <th>DATE REGISTERED</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="resultsDisplay">
                                       <?php
                                          $objCpdRegister = new CpdRegister;
                                          $cpdregisters = $objCpdRegister->get_member_cpd_registration(); 
                                          foreach ($cpdregisters as $registers) {
                                                  echo "
                                                      <tr>
                                                        <td>".$registers["cpd_name"]."</td>
                                                        <td>".$registers["first_name"]." ".$registers["last_name"]."</td>
                                                        <td>".$registers["professional_number"]."</td>
                                                        <td>".$registers["cpd_amount_payed_date"]."</td>
                                                        <td>
                                                          <button type='button' id='".trim($registers["cpd_register_id"])."' class='btn btn-info btn-xs cpd_update_member_records'>Update Records <i class='fa fa-edit'></i></button>
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
            <!-- ///////////////////////////////////////////////////////////////////////////// -->
            <!-- tabs content for sent messages -->
            <div id="setup" class="tab-pane fade">
                <div class="panel panel-default">
                    <div class="panel-heading ">
                        <div class="panel-title pull-left">CPD SETUP</div>
                        <div class="panel-title pull-right">
                           <button data-toggle="modal" data-target="#cpdSetupModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEW </button>
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
                                            <th>CPD NAME</th>
                                            <th>CPD AMOUNT (₵)</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="resultsDisplay">
                                        <?php
                                          $objCpdSetup = new CpdSetup;
                                          $cpds = $objCpdSetup->get_cpd(); 
                                          foreach ($cpds as $cpd) {
                                                echo "
                                                    <tr>
                                                      <td>".$cpd["cpd_name"]."</td>
                                                      <td>".$cpd["cpd_amount"]."</td>
                                                      <td>
                                                        <button type='button' id='".trim($cpd["cpd_id"])."' class='btn btn-info btn-xs cpdupdate_data'>Update <i class='fa fa-edit'></i></button>
                                                      </td>
                                                      <td>
                                                        <button type='button' id='".trim($cpd["cpd_id"])."' class='btn btn-danger btn-xs cpddel_data'>Delete <i class='fa fa-trash'></i></button>
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
            <!-- /////////////////////////////////////////////////////////////////////////////////// -->
        </div>  
    </div>
        <!-- end of content -->
    
</div>

<!-- /.row -->

 <div class="modal fade" id="cpdSetupModal" tabindex="-1" role="dialog" aria-labelledby="cpdSetupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">CPD SETUP</b></h4>
      </div>
      <div class="modal-body" id="bg">
        <form id="cpd_insert_form" method="POST"> 
          <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">CPD Name <span class="asterick"> *</span></label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                    <input type="text" class="form-control" id="cpdRegisterName" name="cpdRegisterName" placeholder="Enter CPD Name" autocomplete="off" required>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">Register Amount (₵)<span class="asterick"> *</span></label>
                </div>
            </div>
            <div class="col-md-9">
              <div class="form-group">
                  <input type="number" class="form-control" id="cpdRegisterAmt" name="cpdRegisterAmt" maxlength="6" placeholder="Enter Price for Registeration" autocomplete="off" required>
              </div>
            </div>
          </div>
          <!-- for inserting the page id -->
          <input type="hidden" name="data_id" id="cpddata_id" value="">
          <!-- for insert query -->
          <input type="hidden" name="mode" id="cpdmode" value="insert">
          <div class=" modal-footer" id="bg">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
            <button type="submit" class="btn btn-info" id="cpdcpdsave_btn">Add CPD <i class="fa fa-save"></i></button>
          </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<div class="modal fade" id="inputCpdMemberRecordsModal" tabindex="-1" role="dialog" aria-labelledby="cpdSetupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" ><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">CPD REGISTER RECORDS</b></h4>
      </div>
      <div class="modal-body" id="bg">
       <form id="cpdRecordsForm">
         <div class="row">
          <div class="col-md-12">
              <span name="addNewCpdRecord" class=" btn btn-danger" id="addNewCpdRecord"><b>Add New Record<i class="fa fa-plus"></i></b></span>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-3"><label for="centerName"><b>Enter CPD Title <span class="asterick">*</span></b></label></div>
            <div class="col-md-3"><label for="centerName"><b>Select CPD Date <span class="asterick">*</span></b></label></div>
            <div class="col-md-3"><label for="centerName"><b>Enter CPD Authors <span class="asterick">*</span></b></label></div>
            <div class="col-md-3"><label for="centerName"><b>Enter CPD Marks <span class="asterick">*</span></b></label></div>
          </div>
          <hr>
          <div class="cpdRecordDetailsDiv">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                     <textarea class="form-control" id="cpdRecordTitle" placeholder="Enter cpd Title" name="cpdRecordTitle[]" autocomplete="off" rows="6" required> </textarea>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="date" class="form-control" id="cpdRecordDate" name="cpdRecordDate[]" placeholder="Select Cpd Date" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                     <textarea class="form-control" id="cpdRecordAuthors" placeholder="Enter Authors" name="cpdRecordAuthors[]" autocomplete="off" rows="6" required> </textarea>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                     <input type="number" class="form-control" id="cpdRecordMarks" placeholder="Enter Marks" name="cpdRecordMarks[]" autocomplete="off" required>
                  </div>
                </div>
                
              </div>
           
         </div>   
      </div>
      <!-- for inserting registerid -->
      <input type="hidden" name="cpdRecordId" id="cpdRecordId">
      <input type="hidden" name="cpdId" id="cpdId" value="">
      <input type="hidden" name="cpdRegisterId" id="cpdRegisterId" value="">
      <input type="hidden" name="cpdMemberId" id="cpdMemberId" value="">

      <input type="hidden" name="mode" id="cpdRegisterIdMode" value="cpdRecordInsert">
      <div class=" modal-footer" id="bg">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
        <button type="submit" class="btn btn-info" id="cpdrecordsave_btn">Update Record <i class="fa fa-save"></i></button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
        // FOR CLICK TO ADD FOR new subject
        let i=1;  
          $('#addNewCpdRecord').click(function(){  
               i++;  
               $('.cpdRecordDetailsDiv').append('<div class="row" id="row'+i+'">'+
                  '<div class="col-md-3">'+
                    '<div class="form-group">'+
                       '<textarea class="form-control" id="cpdRecordTitle" placeholder="Enter cpd Title" name="cpdRecordTitle[]" autocomplete="off" rows="6" required> </textarea>'+
                    '</div>'+
                 '</div>'+
                  '<div class="col-md-3">'+
                    '<div class="form-group">'+
                       '<input type="date" class="form-control" id="cpdRecordDate" name="cpdRecordDate[]" data-toggle="datepicker" placeholder="Select Cpd Date" autocomplete="off" >'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-3">'+
                    '<div class="form-group">'+
                       '<textarea class="form-control" id="cpdRecordAuthors" placeholder="Enter Authors" name="cpdRecordAuthors[]" autocomplete="off" rows="6" required> </textarea>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-2">'+
                    '<div class="form-group">'+
                       '<input type="number" class="form-control" id="cpdRecordMarks" placeholder="Enter Marks" name="cpdRecordMarks[]" autocomplete="off" required>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-1">'+
                    '<span class="btn btn-danger btn_remove" id="'+i+'"><i class="fa fa-trash"></i></span>'+
                  '</div>'+
                '</div>');
          }); 

          $(document).on('click', '.btn_remove', function(){  
               let button_id = $(this).prop("id");   
               // console.log(button_id);
               if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 $('#row'+button_id).remove();

               }else{
                return false;
              }
          });
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       // for date time picker
        $(function() {
            $('[data-toggle="datepicker"]').datepicker({
              language: 'en-GB',
              format: 'dd-mm-yyyy',
              autoHide: true,
              zIndex: 2048,
            });
          });
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // for reset modal when close
        $('#cpdSetupModal').on('hidden.bs.modal', function () {
            $("#subject").html("CPD SETUP");
            $("#cpd_insert_form")[0].reset();
            $('.cpdRecordDetailsDiv').html('');
          });

        // for search
        $("#searchInput").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });



        //for inserting 
          $("#cpd_insert_form").on("submit",function(e){
          e.preventDefault();
                $.ajax({
                url:"Script/cpdSetup.php",
                method:"POST",
                data:$("#cpd_insert_form").serialize(),
                beforeSend:function(){  
                  $('#cpdsave_btn').text("Please wait ...");  
               },
                success:function(data){  
                     $("#cpdSetupModal").modal("hide");
                     $("#cpd_insert_form")[0].reset();
                     if (data == "success") {
                       location.reload();
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });

        // for update
        $('.table').on('click', '.cpdupdate_data', function () { 
           let mode= "updateModal"; 
           let data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/cpdSetup.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     let jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("CPD UPDATE");
                    $("#cpdRegisterName").val(jsonObj[0].cpd_name);
                    $("#cpdRegisterAmt").val(jsonObj[0].cpd_amount);
                    $("#cpddata_id").val(jsonObj[0].cpd_id);
                    $("#cpdsave_btn").text("Update cpd");
                    $("#cpdmode").val("update");
                    $("#cpdSetupModal").modal("show");
                }  
               });  
          });

      
// for delete
        $('.table').on('click', '.cpddel_data', function () {
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 let mode= "delete"; 
                 let data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/cpdSetup.php",  
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

// ///////////////////////////////////////////////////////////////////////////
// for displaying cpd registered records modal
  $('.table').on('click', '.cpd_update_member_records', function () {
    $('.cpdRecordDetailsDiv').html('');
    let cpdRegId = $(this).attr("id");
    $("#cpdRegisterId").val(cpdRegId);
    // check to see if records already inserted before showing modal
     let mode= "updateModal"; 
     let data_id = $(this).attr("id");  
     $.ajax({  
          url:"Script/cpdRegister.php",  
          method:"POST",  
          data:{data_id:data_id,mode:mode},  
          success:function(data){
            // console.log(data);
              let jsonObj = JSON.parse(data);
              // jsondecode title, date, authors and marks
              let jsonObjTitle = JSON.parse(jsonObj[0].cpd_record_title);
              let jsonObjDate = JSON.parse(jsonObj[0].cpd_record_date);
              let jsonObjAuthors = JSON.parse(jsonObj[0].cpd_record_authors);
              let jsonObjMarks = JSON.parse(jsonObj[0].cpd_record_marks);

              if (jsonObj[0].cpd_record_id !== null && jsonObj[0].cpd_record_id !== '') {
                   // changing modal title
                  for (let i = 0; i < jsonObjTitle.length; i++) {
                    // console.log(jsonObjTitle[i])
                    $('.cpdRecordDetailsDiv').append('<div class="row" id="row'+i+'">'+
                      '<div class="col-md-3">'+
                        '<div class="form-group">'+
                           '<textarea class="form-control" id="cpdRecordTitle" placeholder="Enter cpd Title" name="cpdRecordTitle[]" autocomplete="off" rows="6" required>'+jsonObjTitle[i]+'</textarea>'+
                        '</div>'+
                     '</div>'+
                      '<div class="col-md-3">'+
                        '<div class="form-group">'+
                           '<input type="date" class="form-control" id="cpdRecordDate" name="cpdRecordDate[]" data-toggle="datepicker" value="'+jsonObjDate[i]+'">'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-3">'+
                        '<div class="form-group">'+
                           '<textarea class="form-control" id="cpdRecordAuthors" placeholder="Enter Authors" name="cpdRecordAuthors[]" autocomplete="off" rows="6" required>'+jsonObjAuthors[i]+'</textarea>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-2">'+
                        '<div class="form-group">'+
                           '<input type="number" class="form-control" id="cpdRecordMarks" placeholder="Enter Marks" name="cpdRecordMarks[]" value="'+jsonObjMarks[i]+'" required>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-1">'+
                        '<span class="btn btn-danger btn_remove" id="'+i+'"><i class="fa fa-trash"></i></span>'+
                      '</div>'+
                    '</div>');

                  }
              }

              $("#cpdRecordId").val(jsonObj[0].cpd_record_id);
              $("#cpdId").val(jsonObj[0].cpd_id);
              $("#cpdMemberId").val(jsonObj[0].member_id);

              $("#inputCpdMemberRecordsModal").modal("show");
          }  
      });
    
  });

// Inserting User cpd Records 
    $("#cpdRecordsForm").on("submit",function(e){
          e.preventDefault();
          $.ajax({
          url:"Script/CpdRecord.php",
          method:"POST",
          data:$("#cpdRecordsForm").serialize(),
          beforeSend:function(){  
            $('#cpdrecordsave_btn').text("Please wait ...");  
         },
          success:function(data){ 
            console.log(data);
             $("#inputCpdMemberRecordsModal").modal("hide");
             $("#cpdRecordsForm")[0].reset();
             if (data == "success") {
               location.reload();
             }
             else if(data == "error"){
              
             }
          } 

        });  
  });



}); 
 </script>