<?php include("header.php");
      require_once("Classes/Members.php");
?>

<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">LSD MEMBERS PAGE </div>
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
            <!-- end of content -->
        </div>
    </div>
</div>
<!--  -->
<?php include("footer.php");?>

<script>  
  $(document).ready(function(){
    // for search
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#resultsDisplay tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

  });  
</script>