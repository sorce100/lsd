<?php 
      include("header.php");
      require_once("Classes/Pages.php");
      require_once("Classes/Division.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">PAGE SETUP</h3>
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
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD PAGE</button>
              </div>
            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>PAGE NAME</th>
                            <th>PAGE URL</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                        <?php
                          $objPages = new Pages;
                          $pages = $objPages->get_pages(); 
                          foreach ($pages as $page) {
                                  echo "
                                      <tr>
                                        <td>".$page["pages_name"]."</td>
                                        <td>".$page["pages_url"]."</td>
                                        <td>
                                          <input type='button' name='view' value='Update' id='".trim($page["pages_id"])."' class='btn btn-info btn-xs update_data' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Delete' id='".trim($page["pages_id"])."' class='btn btn-danger btn-xs del_data' />
                                        </td>
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

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADD NEW PAGE</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST"> 
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">PAGE NAME</label>
                        <input type="text" class="form-control" id="pageName" name="pageName" placeholder="Enter page name" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">SELECT DIVISION</label>
                        <select class="form-control" name="pageDivision" id="pageDivision" required>
                           <option  disabled selected>Select Division</option>
                           <?php 
                              $objDivision = new Division;
                              $divisions = $objDivision->get_divisions(); 
                              foreach ($divisions as $division) {
                                      echo "<option value=".$division["division_id"].">".$division["division_alias"]."</option>";
                                    }
                            ?>
                          </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                       <label for="pageUrl">PAGE URL</label>
                       <input type="text" class="form-control" name="pageUrl" id="pageUrl" placeholder="Enter page url" autocomplete="off" required>
                     </div>
                  </div>
             </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD PAGE" />
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
                url:"Script/pages.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("super_pages.php");
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });



        // for update
        $('.table').on('click', '.update_data', function () { 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/pages.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE PAGE DETAILS");
                    $("#pageName").val(jsonObj[0].pages_name);
                    $("#pageUrl").val(jsonObj[0].pages_url);
                    $("#pageDivision").val(jsonObj[0].division);
                    $("#data_id").val(jsonObj[0].pages_id);
                    $("#save_btn").val("UPDATE PAGE");
                    $("#mode").val("update");
                    $("#myModal").modal("show");
                }  
               });  
          });

      
// for delete
        $('.table').on('click', '.del_data', function () {
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 var mode= "delete"; 
                 var data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/pages.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("super_pages.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });

          })  
 </script>