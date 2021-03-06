<?php 
      include("header.php");
      require_once("Classes/Pages.php");
      require_once("Classes/Division.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading ">
             <div class="panel-title pull-left">
                PAGE SETUP
             </div>
            <div class="panel-title pull-right">
               <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD PAGE</button>
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
                                              <button type='button' id='".trim($page["pages_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                            </td>
                                            <td>
                                              <button type='button' id='".trim($page["pages_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
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
<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" class="btn-default btnClose">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">ADD NEW PAGE</b></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST"> 
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Page Name <span class="asterick"> *</span></label>
                        <input type="text" class="form-control" id="pageName" name="pageName" placeholder="Enter page name" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Select Division <span class="asterick"> *</span></label>
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
                       <label for="pageUrl">Page Url <span class="asterick"> *</span></label>
                       <textarea class="form-control" name="pageUrl" id="pageUrl" placeholder="Enter page url" autocomplete="off" required rows="5"></textarea>
                     </div>
                  </div>
             <!-- page file name -->

              <div class="col-md-12">
                  <label for="title" class="col-form-label">Page File Name <span class="asterick"> *</span></label>

                  <div class="form-group">
                     <input type="text" name="pageFileName" id="pageFileName" class="form-control" placeholder="xyz.php" autocomplete="off" required>
                  </div>
              </div>
              </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class=" modal-footer" id="bg">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
              <button type="submit" class="btn btn-info" id="save_btn">Add Page <i class="fa fa-save"></i></button>
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
                          $('#save_btn').text("Please wait ...");  
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
                    $("#subject").html("Update Page");
                    $("#pageName").val(jsonObj[0].pages_name);
                    $("#pageUrl").val(jsonObj[0].pages_url);
                    $("#pageFileName").val(jsonObj[0].page_file_name);
                    $("#pageDivision").val(jsonObj[0].division);
                    $("#data_id").val(jsonObj[0].pages_id);
                    $("#save_btn").text("Update Page");
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