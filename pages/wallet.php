<?php include("header.php");
      require_once("Classes/UserBalance.php");
      require_once("Classes/WalletHistory.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">BALANCE AND WALLET HISTORY</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
            <div class="row">
                <!-- jumbotron for displaying wallet balance and uploading balance -->
                <div class="col-lg-12 col-md-12 col-sm-12" >
                    <div class="jumbotron">
                         <?php 
                            $objUserBalance = new UserBalance;
                            $getBalance = $objUserBalance->get_balance();
                            echo "<h2><b>CURRENT BALANCE:</b><span> ₵".trim($getBalance["current_balance"])."</span></h2>";
                          ?>
                    </div>
                </div>
                <!-- <div class="col-lg-6 col-md-6 col-sm-6" >
                     <center><h3><b><u>LOAD WALLET</u></b></h3></center>
                      <a href="#" class="btn btn-info btn-block">CLICK TO LOAD WALLET</a>
                </div> -->
            </div><hr>
            <div class="row">
              <!-- for search -->
              <div class="col-md-12">
                <form action="usersearch.php" method="POST">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="searchInput" autocomplete="off">
                    <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                  </div>
                 </form>
              </div>
            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover tableList">
                    <thead>
                        <tr>
                       
                            <th>TYPE</th>
                            <th>PURPOSE</th>
                            <th>REASON</th>
                            <th>AMOUNT (₵)</th>
                            <th>BALANCE (₵)</th>
                            <th>DATE</th>
        
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                      <?php
                          $objWalletHistory = new WalletHistory;
                          $historys = $objWalletHistory->get_member_walletHistory($_SESSION['member_id']); 
                          foreach ($historys as $history) {
                                  echo "
                                      <tr >
                                        <td>".$history["type"]."</td>
                                        <td>".$history["purpose"]."</td>
                                        <td>".$history["reason"]."</td>
                                        <td>".$history["amount_payed"]."</td>
                                        <td>".$history["balance"]."</td>
                                        <td>".$history["date_done"]."</td>
                                        
                                      </tr>
                                    ";
                              }
                         ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
        // $('.tableList').dataTable({ordering: false,});
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD NEW PAEG");
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
                $.ajax({
                url:"Script/groups.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                  // alert(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("admin_groups.php");
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });
        // for update
        $('.update_data').click(function(){ 
             var mode= "updateModal"; 
             var data_id = $(this).attr("id");  
             $.ajax({  
                  url:"Script/groups.php",  
                  method:"POST",  
                  data:{data_id:data_id,mode:mode},  
                  success:function(data){
                        // passing data from server for particular id selected
                       var jsonObj = JSON.parse(data);
                       // passing the group pages array stored in database
                       var grouppagesArray = JSON.parse(jsonObj[0].group_pages);
                         //looping through all input id with the checkbox id 
                         var checkbox = $('input[id = "pageCheckBox"]').each(function(){ 
                              // grabbing the checkboxes values
                             var Pages = $(this).val(); 
                              // looping througth the array to get the ids
                              for (var i = 0; i < grouppagesArray.length; ++i) {
                                // for comparing if returned array is contained in the input id's values
                                    if (grouppagesArray[i] == Pages) {
                                      // select the checkbox if the id's meet
                                          $(this).attr('checked',true);
                                        }
                                    }
                               });
                         // changing modal title
                        $("#subject").html("UPDATE GROUP DETAILS");
                        $("#data_id").val(jsonObj[0].group_id);
                        $("#groupName").val(jsonObj[0].group_name);
                        $("#save_btn").val("UPDATE PAGE");
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
                      url:"Script/groups.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("admin_groups.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });

          });  
 </script>