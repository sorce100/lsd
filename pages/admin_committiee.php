<?php 
      include("header.php");
      require_once("Classes/Committee.php");
      require_once("Classes/Members.php");
      require_once("Classes/Pages.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">COMMITTEE SETUP</h3>
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>COMMITTEE NAME</th>
                            <th>TOTAL MEMBERS</th>
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
                                    <td>".count(json_decode($committe["committee_members"]))."</td>
                                    <td>
                                      <input type='button' name='view' value='Update' id='".trim($committe["committee_id"])."' class='btn btn-info btn-xs update_data' />
                                      <input type='button' name='view' value='Delete' id='".trim($committe["committee_id"])."' class='btn btn-danger btn-xs del_data' />
                                    </td>
                                  </tr>";
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
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADD NEW COMMITTEE</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
      <form id="insert_form" method="POST"> 
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">COMMITTEE NAME</label>
                        <input type="text" class="form-control" id="committeeName" name="committeeName" placeholder="Enter committee name" autocomplete="off" required>
                    </div>
                  </div>

                  <br>

                  <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified" style="background-color: #f4f4f4;">
                      <li class="active"><a data-toggle="tab" href="#addMembers"><b>Add Members</b></a></li>
                      <li><a data-toggle="tab" href="#addPages"><b>Add Pages</b></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="addMembers" class="tab-pane fade in active">
                          <!-- <center><b><u>ADD PAGES</u></b></center> -->
                           <div class="table-responsive">
                             <table class="table table-hover">
                               <thead>
                                  <th width="10%"></th>
                                  <th width="20%">Diploma No</th>
                                  <th width="40%">Member Name</th>
                                  
                               </thead>
                               <tbody id="comMemList">
                                <?php
                                    $objMembers = new Members;
                                    $members = $objMembers->get_members();
                                    foreach ($members as $member) {
                                        // if (trim($page["division"]) == $_SESSION['division']) {
                                          echo '<tr>
                                                   <td><input type="checkbox" class="input-md" name="committeeMembers[]" id="committeeMembers" value="'.trim($member["members_id"]).'"></td>
                                                   <td>'.$member["professional_number"].'</td>
                                                   <td>'.$member["first_name"]." ".$member["other_name"]." ".$member["last_name"].'</td>
                                                
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
                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD COMMITTEE" />
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
                          $('#save_btn').val("Please wait ...");  
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
                       if ($.isArray(JSON.parse(jsonObj[0].committee_members))) {
                          // select the checkboxes
                          let membersArray = JSON.parse(jsonObj[0].committee_members);
                          // console.log(membersArray);
                          for (let i = 0; i < membersArray.length; ++i) {
                            $('#committeeMembers[value="'+membersArray[i]+'"]').each(function() {
                                $(this).prop('checked',true);
                            });
                          }
                       }
                       // for committee pages select
                       if ($.isArray(JSON.parse(jsonObj[0].committee_pages))) {
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
                        $("#save_btn").val("UPDATE PAGE");
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