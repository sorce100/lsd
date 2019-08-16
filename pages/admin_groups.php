<?php include("header.php");
      require_once("Classes/Groups.php");
      require_once("Classes/Pages.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">GROUPS SETUP PAGE</div>
            <div class="panel-title pull-right">
               <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD GROUP</button>
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
                            <th>GROUP NAME</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                      <?php
                          $objGroups = new Groups;
                          $groups = $objGroups->get_groups(); 
                          foreach ($groups as $group) {
                                      if (trim($group["division"]) == $_SESSION['division']) {
                                      echo "
                                          <tr>
                                            <td>".$group["group_name"]."</td>
                                            <td>
                                              <button type='button' id='".trim($group["group_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                            </td>
                                            <td>
                                              <button type='button' id='".trim($group["group_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
                                            </td>
                                          </tr>
                                        ";
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



 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">ADD NEW GROUP</b></h4>
      </div>
      <div class="modal-body" id="bg">
      <form id="insert_form" method="POST"> 
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">GROUP NAME</label>
                        <input type="text" class="form-control" id="groupName" name="groupName" placeholder="Enter group name" autocomplete="off" required>
                    </div>
                  </div>
              </div>
              <hr>
              <div class="row">
                  <div class="col-md-12">
                     
                     <div class="table-responsive">
                       <table class="table table-hover">
                         <thead>
                            <th><input type="checkbox" id="select_all"/> <b>select all</b></th>
                            <th>Page Name</th>
                         </thead>
                         <tbody>
                          <?php
                              
                              $objPages = new Pages;
                              $pages = $objPages->get_pages();
                              foreach ($pages as $page) {
                                  // if (trim($page["division"]) == $_SESSION['division']) {
                                  
                                    echo '<tr>
                                             <td><input type="checkbox" class="input-md" name="groupPages[]" id="pageCheckBox" value="'.trim($page["pages_id"]).'"></td>
                                             <td>'.trim($page["pages_name"]).'</td>
                                           </tr>';
                                    // }
                                  }
                            ?>
                         </tbody>
                       </table>
                     </div>
                  </div>
             </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <!-- <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD GROUP" /> -->
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info" id="save_btn">Add Group <i class="fa fa-save"></i></button>
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
            $("#subject").html("ADD NEW PAGE");
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
            $('.table').DataTable().destroy();
          e.preventDefault();
                $.ajax({
                url:"Script/groups.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').text("Please wait ...");  
                     },
                success:function(data){
                    $('.table').dataTable({ordering: false,});  
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
                    $('.table').DataTable().destroy();
                        // passing data from server for particular id selected
                       var jsonObj = JSON.parse(data);
                       // passing the group pages array stored in database
                       var grouppagesArray = JSON.parse(jsonObj[0].group_pages);
                       // console.log(grouppagesArray);
                         //looping through all input id with the checkbox id 
                         var checkbox = $('input[id = "pageCheckBox"]').each(function(){ 
                                  // grabbing the checkboxes values
                                  var Pages = $(this).val(); 
                                  // looping througth the array to get the ids
                                  if (grouppagesArray != null) {
                                      for (var i = 0; i < grouppagesArray.length; ++i) {
                                      // for comparing if returned array is contained in the input id's values
                                      if (grouppagesArray[i] == Pages) {
                                        // select the checkbox if the id's meet
                                            $(this).attr('checked',true);
                                          }
                                      }
                                  }
                                
                               });
                        $('.table').dataTable({ordering: false,});  
                         // changing modal title
                        $("#subject").html("UPDATE GROUP DETAILS");
                        $("#data_id").val(jsonObj[0].group_id);
                        $("#groupName").val(jsonObj[0].group_name);
                        $("#save_btn").text("update Group");
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