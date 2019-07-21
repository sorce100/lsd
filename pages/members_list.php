<?php include("header.php");
      require_once("Classes/Members.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">LSD MEMBERS PAGE</h3>
        <div class="white-box">
            <!-- button for search and add new members button -->
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">GhIS DIP NO</th>
                            <th scope="col">FIRST NAME</th>
                            <th scope="col">LAST NAME</th>
                            <th scope="col">SURVEYOR TYPE</th>
                            <th scope="col">TEL NO</th>
                            <th scope="col">REGION</th>
                        </tr>
                    </thead>
                   <tbody id="resultsDisplay">
                        <?php
                          $objMembers = new Members();
                          $members = $objMembers->get_members(); 
                          foreach ($members as $member) {
                              // $data = json_encode($member,true);
                                  echo "
                                      <tr>
                                        <td>".$member["professional_number"]."</td>
                                        <td>".$member["first_name"]."</td>
                                        <td>".$member["last_name"]."</td>
                                        <td>".$member["surveyor_type"]."</td>
                                        <td>".$member["personal_contact"]."</td>
                                        <td>".$member["region"]."</td>
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
<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADD NEW SURVEYOR TYPE</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST"> 
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">ENTER SURVEYOR TYPE NAME</label>
                        <input type="text" class="form-control" id="surveyorType" name="surveyorType" placeholder="Enter type name" autocomplete="off" required>
                    </div>
                  </div>
                 
             </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD NEW TYPE" />
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
            $("#subject").html("ADD NEW SURVEYOR TYPE");
            $("#insert_form")[0].reset();
          })

        // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });


});  
 </script>