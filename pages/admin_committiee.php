<?php 
      include("header.php");
      require_once("Classes/Committee.php");
      require_once("Classes/Members.php");
      require_once("Classes/Pages.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">COMMITTEE SETUP</div>
            <div class="panel-title pull-right">
               <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEW</button>
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
                            <th>COMMITTEE NAME</th>
                            <th>TOTAL MEMBERS</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                         <?php
                          $objCommittee = new Committee;
                          $committes = $objCommittee->get_committees(); 
                          foreach ($committes as $committe) {
                              echo "
                                  <tr>
                                    <td>".$committe["committee_name"]."</td>
                                    <td>".sizeof(json_decode($committe["committee_members"]))."</td>
                                    <td>
                                      <button type='button' id='".trim($committe["committee_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                    </td>
                                    <td>
                                      <button type='button' id='".trim($committe["committee_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
                                    </td>
                                  </tr>";
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
<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">ADD NEW COMMITTEE</b></h4>
      </div>
      <div class="modal-body" id="bg">
      <form id="insert_form" method="POST"> 
              <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">COMMITTEE NAME <span class="asterick">*</span></label>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" class="form-control" id="committeeName" name="committeeName" placeholder="Enter committee name" autocomplete="off" required>
                    </div>
                  </div>
              </div>

              <hr>

              <div class="row">
                  <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified panelTabs" >
                      <li class="active"><a data-toggle="tab" href="#addMembers"><b>Add Members <i class="fa fa-users"></i></b></a></li>
                      <li><a data-toggle="tab" href="#addPages"><b>Add Pages <i class="fa fa-file"></i></b></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="addMembers" class="tab-pane fade in active">
                          <!-- <center><b><u>ADD PAGES</u></b></center> -->
                           <div class="table-responsive">
                             <table class="table table-hover">
                               <thead>
                                  <th width="5%">Select Members</th>
                                  <th width="20%">Diploma No</th>
                                  <th width="40%">Member Name</th>
                                  <th width="5%">Select Admin</th>
                                  
                               </thead>
                               <tbody id="comMemList">
                                <?php
                                    $objMembers = new Members;
                                    $members = $objMembers->get_members();
                                    foreach ($members as $member) {
                                        // if (trim($page["division"]) == $_SESSION['division']) {
                                          echo '<tr>
                                                   <td>
                                                      <input type="checkbox" class="input-md" name="committeeMembers[]" id="committeeMembers" value="'.trim($member["members_id"]).'">
                                                   </td>
                                                   <td>'.$member["professional_number"].'</td>
                                                   <td>'.$member["first_name"]." ".$member["other_name"]." ".$member["last_name"].'</td>
                                                   <td>
                                                      <input type="checkbox" class="input-md" name="committeeAdmins[]" id="committeeAdmins" value="'.trim($member["members_id"]).'">
                                                   </td>
                                                 </tr>';
                                          // }
                                        }
                                  ?>
                               </tbody>
                             </table>
                           </div>
                        </div>
                        <div id="addPages" class="tab-pane fade">
                          <!-- Add pages for committee -->
                          <div class="table-responsive">
                             <table class="table table-hover">
                               <thead>
                                  <th>Add Page</th>
                                  <th>Page Name</th>
                               </thead>
                               <tbody>
                                <?php
                                  $objPages = new Pages;
                                  $pages = $objPages->get_pages();
                                  foreach ($pages as $page) {
                                    echo '<tr>
                                             <td><input type="checkbox" class="input-md" name="committeePages[]" id="committeePages" value="'.trim($page["pages_id"]).'"></td>
                                             <td>'.trim($page["pages_name"]).'</td>
                                           </tr>';
                                    }
                                  ?>
                               </tbody>
                             </table>
                           </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
             </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-info" id="save_btn">Add Committee <i class="fa fa-save"></i></button>
            </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include("footer.php");?>
 <script>  
      $(document).ready(function(){

        // check all checkboxes
        $('body').on('change', '#committeeMembers', function() {
           let rows, checked;
           rows = $('#comMemList').find('tbody tr');
           checked = $(this).prop('checked');
           $.each(rows, function() {
              let checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', checked);
           });
         });
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#subject").html("ADD NEW COMMITTEE");
            $("#insert_form")[0].reset();
          })

        // for committee members search
        $("#commMemSearch").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#comMemDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

        // for search
        $("#searchInput").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

         //for inserting 
          $("#insert_form").on("submit",function(e){
                e.preventDefault();
                $('.table').DataTable().destroy();
                $.ajax({
                url:"Script/committee.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').text("Please wait ...");  
                     },
                success:function(data){  
                  console.log(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("admin_committiee.php");
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });
        // for update
        $('.update_data').click(function(){ 
             let mode= "getInfo"; 
             let data_id = $(this).attr("id");  
             $.ajax({  
                  url:"Script/committee.php",  
                  method:"POST",  
                  data:{data_id:data_id,mode:mode},  
                  success:function(data){
                    
                        // passing data from server for particular id selected
                       let jsonObj = JSON.parse(data);
                       // destroy data table to represent the data then enable
                          $('.table').DataTable().destroy();
                       // passing the group pages array stored in database
                       if (jsonObj[0].committee_members!="") {
                          // select the checkboxes
                          let membersArray = JSON.parse(jsonObj[0].committee_members);
                          // console.log(membersArray);
                          for (let i = 0; i < membersArray.length; ++i) {
                            $('#committeeMembers[value="'+membersArray[i]+'"]').each(function() {
                                $(this).prop('checked',true);
                            });
                          }
                       }
                       // admins of the page
                        if (jsonObj[0].committee_admins!="") {
                          // select the checkboxes
                          let adminsArray = JSON.parse(jsonObj[0].committee_admins);
                          // console.log(membersArray);
                          for (let i = 0; i < adminsArray.length; ++i) {
                            $('#committeeAdmins[value="'+adminsArray[i]+'"]').each(function() {
                                $(this).prop('checked',true);
                            });
                          }
                       }
                       // for committee pages select
                       if (jsonObj[0].committee_pages!="") {
                          // select the checkboxes
                          let pagesArray = JSON.parse(jsonObj[0].committee_pages);
                          // console.log(pagesArray);
                          for (let i = 0; i < pagesArray.length; ++i) {
                            $('#committeePages[value="'+pagesArray[i]+'"]').each(function() {
                                $(this).prop('checked',true);
                            });
                          }
                       }
                       $('.table').dataTable({ordering: false,});
                         // changing modal title
                        $("#subject").html("UPDATE COMMITTEE DETAILS");
                        $("#data_id").val(jsonObj[0].committee_id);
                        $("#committeeName").val(jsonObj[0].committee_name);
                        $("#save_btn").text("Update Committee");
                        $("#mode").val("update");
                        $("#myModal").modal("show");
                        }  
                 });  
          });
      
// for delete
        $('.del_data').click(function(){
           if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
               
                 let mode= "delete"; 
                 let data_id = $(this).attr("id");  
                 $.ajax({  
                      url:"Script/committee.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("admin_committiee.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });

}); 
 </script>