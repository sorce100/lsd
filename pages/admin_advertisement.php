<?php include("header.php");
  require_once("Classes/AdvertCompany.php");
?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">ADVERTISEMENT ACCOUNT SETUP PAGE</h3>
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
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEW</button>
              </div>
            </div>
            <div class="table-responsive"><br>
                <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>COMPANY NAME</th>
                            <th>CATEGORY</th>
                        </tr>
                    </thead>
                   <tbody id="resultsDisplay">
                        <?php
                          $objAdvertCompany = new AdvertCompany();
                          $advercoms = $objAdvertCompany->get_advert_companys(); 
                          foreach ($advercoms as $advercom) {
                                  echo "
                                      <tr class='row'>
                                        <td>".$advercom["advert_com_name"]."</td>
                                        <td>".$advercom["advert_com_category"]."</td>
                                        <td>
                                          <input type='button' name='view' value='Account Setup' id='".trim($advercom["advert_com_id"])."' class='btn btn-success btn-xs account_setup' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Update Details' id='".trim($advercom["advert_com_id"])."' class='btn btn-info btn-xs update_data' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Delete' id='".trim($advercom["advert_com_id"])."' class='btn btn-danger btn-xs del_data' />
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
<!-- modal  -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">NEW ADVERTISEMENT ACCOUNT</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
       <form method="POST" id="insert_form"> 
            <div class="row">
              <!-- name of the advert company -->
              <div class="col-md-12">
                <div class="form-group">
                   <label for="advertCom">NAME OF COMPANY</label>
                   <input type="text" class="form-control" id="advertCom" placeholder="Enter name of the company &hellip;" name="advertCom" autocomplete="off">
                </div>
              </div>
              <!-- telephone number -->
              <div class="col-md-6">
                <div class="form-group">
                   <label for="advertComTel">TEL NUMBER</label>
                   <input type="number" class="form-control" id="advertComTel" placeholder="Enter tel number &hellip;" name="advertComTel" autocomplete="off">
                </div>
              </div>
              <!-- product category -->
              <div class="col-md-6">
                <div class="form-group">
                   <label for="advertComCategory">ADVERT CATEGORY</label>
                   <select class="form-control" class="advertComCategory" name="advertComCategory">
                     <option value="services">Services</option>
                     <option value="Product">Product</option>
                   </select>
                </div>
              </div>
              <!-- address and location -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="advertComAddress">COMPANY ADDRESS</label>
                  <textarea rows="6" class="form-control" id="advertComAddress" name="advertComAddress" placeholder="Enter company address"></textarea>
                </div>
              </div>
              <!-- for company location -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="advertComLocation">COMPANY LOCATION</label>
                  <textarea rows="6" class="form-control" id="advertComLocation" name="advertComLocation" placeholder="Enter company location"></textarea>
                </div>
              </div>
            </div>
        <!-- news id -->
          <input type="hidden" name="data_id" id="data_id" value="">
      <!-- mode for submit -->
          <input type="hidden" name="mode" id="mode" value="insert">
      <!-- for made by -->
          <input type="hidden" name="madeBy" id="madeBy" value="<?php echo $_SESSION['user_id'];?>">
          <div class="well modal-footer" id="bg">
           <input type="submit" id="save_btn"  class="btn btn-danger btn-block" name="submit" value="ADD NEW COMPANY" />
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- account setup page -->
  <div class="modal fade" id="accountSetupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADVERTISEMENT ACCOUNT SETUP</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
       <form method="POST" id="insert_form"> 
            <div class="row">
              <!-- name of the advert company -->
              <div class="col-md-4">
                <div class="form-group">
                   <label for="advertCom">ADVERT DURATION</label>
                   <select class="form-control" id="advertComDuration" name="advertComDuration">
                     <option value="6 months">6 Months</option>
                     <option value="1 year">1 year</option>
                     <option value="2 year">2 year</option>
                     <option value="5 year">5 year</option>
                     <option value="10 year">10 year</option>
                   </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                   <label for="advertComAmount">AMOUNT </label>
                   <input type="number" class="form-control" id="advertComAmount" name="advertComAmount" autocomplete="off">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                   <label for="advertComPayMode">MODE OF PAYMENT</label>
                   <select class="form-control" id="advertComPayMode" name="advertComPayMode">
                     <option value="Cash">Cash</option>
                     <option value="Cheque">Cheque</option>
                     <option value="Special Offer">Special Offer</option>
                   </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                   <label for="advertComUsername">USERNAME </label>
                   <input type="text" class="form-control" id="advertComUsername" name="advertComUsername" autocomplete="off">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                   <label for="advertComPassword">PASSWORD </label>
                   <input type="password" class="form-control" id="advertComPassword" name="advertComPassword" autocomplete="off">
                </div>
              </div>
            </div>
        <!-- news id -->
          <input type="hidden" name="data_id" id="data_id" value="">
      <!-- mode for submit -->
          <input type="hidden" name="mode" id="mode" value="insert">
      <!-- for made by -->
          <input type="hidden" name="madeBy" id="madeBy" value="<?php echo $_SESSION['user_id'];?>">
          <div class="well modal-footer" id="bg">
              <input type="submit" id="save_btn"  class="btn btn-danger btn-block" name="submit" value="SETUP COMPANY" />
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
          $("#subject").html("NEW ADVERTISEMENT ACCOUNT");
          // to reset rest of the form
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
                url:"Script/advertcompany.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                     console.log(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("admin_advertisement.php");
                      // swal("SUCCESSFULL!", "", "error");
                     }
                     else if(data == "error"){
                      swal("NOT SUCCESSFULL!", "Please Check Data and try again", "error");
                     }
                } 

                });  
            });

// for update
        $('.update_data').click(function(){ 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/advertcompany.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     
                     // changing modal title
                    $("#subject").html("UPDATE ADVERTISEMENT ACCOUNT");
                    $("#advertCom").val(jsonObj[0].advert_com_name);
                    $("#advertComTel").val(jsonObj[0].advert_com_tel);
                    $("#advertComCategory").val(jsonObj[0].advert_com_category);
                    $("#advertComAddress").val(jsonObj[0].advert_com_address);
                    $("#advertComLocation").val(jsonObj[0].advert_com_location);
                    $("#data_id").val(jsonObj[0].advert_com_id);
                    $("#save_btn").val("UPDATE ADVERT ACCOUNT");
                    $("#mode").val("update");
                    $("#myModal").modal("show");
                }  
               });  
          });

        // for delete
          $('.del_data').click(function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/advertcompany.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          
                      }  
                     }); 

               }else{
                return false;
              }  
          });

  // for account setup
  $('.account_setup').click(function(){
    $('#accountSetupModal').modal('show');
  });


});
</script>

  