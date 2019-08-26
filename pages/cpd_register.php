<?php 
      include("header.php");
      require_once("Classes/CpdSetup.php");
?>
<br>

<div class="row">
    <div class="col-md-12">
            <!-- tabs content for sent messages -->
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="panel-title pull-left">CPD REGISTRATION AND DETAILS</div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <!-- content -->
                    <div class="col-md-12">
                        <div class="table-responsive"><br>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>CPD NAME</th>
                                        <th>CPD AMOUNT (₵)</th>
                                        <th>CPD REG DATE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="resultsDisplay">
                                    <?php
                                      $objCpdSetup = new CpdSetup;
                                      $cpds = $objCpdSetup->get_cpds_and_register(); 
                                      foreach ($cpds as $cpd) {
                                        echo "
                                            <tr>
                                              <td>".$cpd["cpd_name"]."</td>
                                              <td>".$cpd["cpd_amount"]."</td>
                                              <td>".$cpd["cpd_amount_payed_date"]."</td>";

                                              if ($cpd["cpd_payed"] == "YES") {
                                                echo "<td><button type='button' id='".trim($cpd["cpd_register_id"])."' class='btn btn-danger btn-xs cpd_view_records'>View Records  <i class='fa fa-eye'></i></button></td></tr>";
                                              }
                                              elseif (empty($cpd["cpd_payed"])) {
                                                echo "<td><button type='button' id='".trim($cpd["cpd_id"])."|".trim($cpd["cpd_name"])."|".trim($cpd["cpd_amount"])."' class='btn btn-info btn-xs cpd_register'>Register  <i class='fa fa-check-square-o'></i></button></td></tr>";
                                              }
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
        <!-- end of content -->
</div>



<!-- /.row -->
 <div class="modal fade" id="cpdSetupModal" tabindex="-1" role="dialog" aria-labelledby="cpdSetupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" ><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">CPD REGISTRATION</b></h4>
      </div>
      <div class="modal-body" id="bg">
        <form id="cpd_register_form" method="POST"> 
          <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">Select CPD <span class="asterick"> *</span></label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                    <input type="text" class="form-control" id="cpdIdDisplay" name="cpdIdDisplay" readonly required>
                    <!-- storing cpd setup id -->
                    <input type="hidden" id="cpdId" name="cpdId">
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">Amount (₵) <span class="asterick"> *</span></label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                    <input type="number" class="form-control" id="cpdRegisterAmt" name="cpdRegisterAmt" autocomplete="off" readonly required>
                </div>
              </div>
          </div>
          <!-- for inserting the page id -->
          <input type="hidden" name="data_id" id="cpddata_id" value="">
          <!-- for insert query -->
          <input type="hidden" name="mode" id="cpdmode" value="cpdRegister">
          <div class=" modal-footer" id="bg">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
            <button type="submit" class="btn btn-info" id="cpdregsave_btn">Register CPD <i class="fa fa-save"></i></button>
          </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- modal for viewing registerd Cpd details -->
<div class="modal fade" id="viewMemberCpdModal" tabindex="-1" role="dialog" aria-labelledby="cpdSetupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" ><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">MEMBER CPD DETAILS</b></h4>
      </div>
      <div class="modal-body" id="bg">
       <form id="cpdRecordsForm">
          <div class="row">
            <div class="col-md-3"><label for="centerName"><b>CPD Title </b></label></div>
            <div class="col-md-3"><label for="centerName"><b>CPD Date </b></label></div>
            <div class="col-md-3"><label for="centerName"><b>CPD Authors </b></label></div>
            <div class="col-md-3"><label for="centerName"><b>CPD Marks </b></label></div>
          </div>
          <hr>
          <div class="cpdRecordDetailsDiv">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                     <textarea class="form-control" id="cpdRecordTitle" placeholder="Enter cpd Title" autocomplete="off" rows="6" required> </textarea>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="date" class="form-control" id="cpdRecordDate" placeholder="Select Cpd Date" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                     <textarea class="form-control" id="cpdRecordAuthors" placeholder="Enter Authors" autocomplete="off" rows="6" required> </textarea>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                     <input type="number" class="form-control" id="cpdRecordMarks" placeholder="Enter Marks" autocomplete="off" required>
                  </div>
                </div>
                
              </div>
           
         </div> 
        </form>  
      </div>
      <div class=" modal-footer" id="bg">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php include("footer.php");?>

 <script>  
    $(document).ready(function(){
        // for reset modal when close
        $('#cpdSetupModal').on('hidden.bs.modal', function () {
            $("#subject").html("CPD SETUP");
            $("#cpd_register_form")[0].reset();
            $("#cpdRegisterAmt").html('');
          })

        // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

        //for inserting 
          $("#cpd_register_form").on("submit",function(e){
            e.preventDefault();
            if (confirm("DO YOU WANT TO REGISTER FOR THIS CPD")) {
                $.ajax({
                url:"Script/cpdRegister.php",
                method:"POST",
                data:$("#cpd_register_form").serialize(),
                beforeSend:function(){  
                  $('#cpdregsave_btn').text("Please wait ...");  
               },
                success:function(data){  
                     $("#cpdSetupModal").modal("hide");
                     $("#cpd_register_form")[0].reset();

                     alert(data);

                     location.reload();
                } 

              });

            }else{
                return false;
              }    

           });


        // for registration of member cpd
        $('.table').on('click', '.cpd_register', function () { 
          let cpdRegDetail = $(this).prop('id');
          ///////////////////////////////////////
          var cpdRegDetailSplit = cpdRegDetail.split("|");
          // (0) cpd id (1) cpd name (2) cpd amount
          $("#cpdId").val(cpdRegDetailSplit[0]);
          $("#cpdIdDisplay").val(cpdRegDetailSplit[1]);
          $("#cpdRegisterAmt").val(cpdRegDetailSplit[2]);

          $("#cpdSetupModal").modal("show");
        });

      // for showing cpd records after registration
      
      $('.table').on('click', '.cpd_view_records', function () {
        $('.cpdRecordDetailsDiv').html('');
        // check to see if records already inserted before showing modal
         let mode= "getMemberRecord"; 
         let cpdRegId = $(this).attr("id");  
         $.ajax({  
              url:"Script/cpdRecord.php",  
              method:"POST",  
              data:{cpdRegId:cpdRegId,mode:mode},  
              success:function(data){
                // console.log(data);
                  let jsonObj = JSON.parse(data);
                  // jsondecode title, date, authors and marks
                  let jsonObjTitle = JSON.parse(jsonObj[0].cpd_record_title);
                  let jsonObjDate = JSON.parse(jsonObj[0].cpd_record_date);
                  let jsonObjAuthors = JSON.parse(jsonObj[0].cpd_record_authors);
                  let jsonObjMarks = JSON.parse(jsonObj[0].cpd_record_marks);

                  if ((jsonObj[0].cpd_record_title != "null") || (jsonObj[0].cpd_record_marks != "null") ) {
                       // changing modal title
                      for (let i = 0; i < jsonObjTitle.length; i++) {
                        
                        $('.cpdRecordDetailsDiv').append('<div class="row" id="row'+i+'">'+
                          '<div class="col-md-3">'+
                            '<div class="form-group">'+
                               '<textarea class="form-control" id="cpdRecordTitle" placeholder="Enter cpd Title" autocomplete="off" rows="6" readonly>'+jsonObjTitle[i]+'</textarea>'+
                            '</div>'+
                         '</div>'+
                          '<div class="col-md-3">'+
                            '<div class="form-group">'+
                               '<input type="date" class="form-control" id="cpdRecordDate" data-toggle="datepicker" value="'+jsonObjDate[i]+'" readonly>'+
                            '</div>'+
                          '</div>'+
                          '<div class="col-md-3">'+
                            '<div class="form-group">'+
                               '<textarea class="form-control" id="cpdRecordAuthors" placeholder="Enter Authors" autocomplete="off" rows="6" readonly>'+jsonObjAuthors[i]+'</textarea>'+
                            '</div>'+
                          '</div>'+
                          '<div class="col-md-3">'+
                            '<div class="form-group">'+
                               '<input type="number" class="form-control" id="cpdRecordMarks" placeholder="Enter Marks" value="'+jsonObjMarks[i]+'" readonly>'+
                            '</div>'+
                          '</div>'+
                        '</div>');

                      }
                  }
              }  
          });

        $("#viewMemberCpdModal").modal("show");
      });


});  
 </script>