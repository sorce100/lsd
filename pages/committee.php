<?php 
      include("header.php");
      require_once("Classes/Committee.php");
      require_once("Classes/Members.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">MEMBER COMMITTEES</div>
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
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                         <?php
                         // check if member has any committess
                         if (!empty($_SESSION['member_committees'])) {
                             $objCommittee = new Committee;
                             // loop through member committees and display them
                             foreach ($_SESSION['member_committees'] as $committee) {
                                $committeeDetails = $objCommittee->get_member_committees($committee);
                                // print_r($committeeDetails);
                                echo "<tr>
                                        <td>".$committeeDetails[0]["committee_name"]."</td>
                                        <td>".count(json_decode($committeeDetails[0]["committee_members"]))."</td>
                                        <td>
                                          <button type='button' name='view' value='".trim($committeeDetails[0]["committee_folder"])."' id='".trim($committeeDetails[0]["committee_id"])."' class='btn btn-info btn-xs get_committee_info'>Access Committee <i class='fa fa-eye'></i></button>
                                        </td>
                                      </tr>";
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

</div>

<!-- /.row -->
<?php require_once('committee_include.php'); ?>