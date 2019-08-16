<?php 
      include("header.php");
      require_once("Classes/SessionLogs.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">USER SESSION LOGS PAGE</div>
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
                                <th>USER ACCOUNT</th>
                                <th>SESSION START</th>
                                <th>SESSION END</th>
                            </tr>
                        </thead>
                        <tbody id="resultsDisplay">
                            <?php
                              // for username
                              $objusers = new Users;
                              $objSessionLogs = new SessionLogs;
                              $sessions = $objSessionLogs->get_session(); 
                              foreach ($sessions as $session) {
                                      echo "
                                          <tr >
                                            <td>".$objusers->get_userName($session["user_id"])."</td>
                                            <td>".$session["session_start"]."</td>
                                            <td>".$session["session_end"]."</td>
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





