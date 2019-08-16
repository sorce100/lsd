<?php include("header.php");
      require_once("Classes/CommitteeTask.php");
      require_once("Classes/Contribution.php");
      require_once("Classes/News.php");
      require_once("Classes/Committee.php");
     
?>
<br>
<div class="row">
  <!-- first part of div -->
  <div class="col-md-12 ">
    <div class="panel panelTabs" >
      <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#comMembers">Committee Members <i class="fa fa-users"></i></a></li>
        <li><a data-toggle="tab" href="#comTasks">Committee Tasks <i class="fa fa-tasks"></i></a></li>
        <li><a data-toggle="tab" href="#comNews">Committee News <i class="fa fa-newspaper-o"></i></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="tab-content">
   <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <div id="comMembers" class="tab-pane fade in active">
      <div class="row">
          <!-- <div class="col-sm-12"> -->
          <div class="panel panel-default">
              <div class="panel-heading">
                   <div class="panel-title pull-left">COMMITTEE MEMBERS</div>
                  <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                  <!-- for search -->
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
      <!--  -->
    </div>
     
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <div id="comTasks" class="tab-pane fade">
      <div class="row">
          <!-- <div class="col-sm-12"> -->
          <div class="panel panel-default">
              <div class="panel-heading">
                   <div class="panel-title pull-left">COMMITTEE TASKS </div>
                  <div class="panel-title pull-right">
                     <button data-toggle="modal" data-target="#addTaskModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD TASKS</button>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                  <!-- for search -->
                  <!-- content -->
                  <div class="col-md-12">
                    <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>COMMITTEE</th>
                                    <th>TASK NAME</th>
                                    <th>COMPLETE DATE</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="resultsDisplay">
                                <?php
                                  $objCommitteeTask = new CommitteeTask;
                                  $tasks = $objCommitteeTask->get_comm_tasks(); 
                                  foreach ($tasks as $task) {
                                          echo "
                                              <tr>
                                                <td>".$objCommitteeTask->get_committee_name($task["committee_id"])."</td>
                                                <td>".$task["committee_task_name"]."</td>
                                                <td>".$task["committee_task_complete_date"]."</td>
                                                <td>
                                                  <button type='button' id='".trim($task["committee_task_id"])."' class='btn btn-info btn-xs task_update_data'>Update <i class='fa fa-edit'></i></button>
                                                </td>
                                                <td>
                                                  <button type='button' id='".trim($task["committee_task_id"])."' class='btn btn-danger btn-xs task_del_data'>Delete <i class='fa fa-trash'></i></button>
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
      </div>
      <!--  -->
    </div>
    
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <div id="comNews" class="tab-pane fade">
      <div class="row">
          <!-- <div class="col-sm-12"> -->
          <div class="panel panel-default">
              <div class="panel-heading">
                   <div class="panel-title pull-left">COMMITTEE NEWS </div>
                  <div class="panel-title pull-right">
                     <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> NEW PUBLISH</button>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                  <!-- for search -->
                  <!-- content -->
                  <div class="col-md-12">
                    <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>TITLE</th>
                                    <th>CATEGORY</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="resultsDisplay">
                                <?php
                                  $objNews = new News;
                                  $news = $objNews->get_news_all();

                                  foreach ($news as $row) {
                                          echo "
                                              <tr>
                                                <td>".$row["news_title"]."</td>
                                                <td>".$row["news_category"]."</td>
                                                <td>
                                                  <button type='button' id='".trim($row["news_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                                </td>
                                                <td>
                                                  <button type='button' id='".trim($row["news_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
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
      </div>
      <!--  -->
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

</div>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- modalS -->

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php require_once('admin_news_include.php'); ?>
<?php require_once('committee_include.php'); ?>
<?php require_once('committee_task_include.php'); ?>
 <script>  
$(document).ready(function(){
   $(function() {
    $('[data-toggle="datepicker"]').datepicker({
      language: 'en-GB',
      format: 'dd-mm-yyyy',
      autoHide: true,
      zIndex: 2048,
    });
  });

  // for reset modal when close
  $('#duesModal').on('hidden.bs.modal', function () {
      $("#subject").html("SETUP NEW PAYMENT");
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
        if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
            $.ajax({
            url:"Script/userpayment.php",
            method:"POST",
            data:$("#insert_form").serialize(),
            beforeSend:function(){  
                      $('#save_btn').text("Please wait ...");  
                 },
            success:function(data){  
                 alert(data);
                 $("#myModal").modal("hide");
                 $("#insert_form")[0].reset();
                  window.location.replace("payments.php");
               } 

            });
        }else{
          return false;
          }

    });

  // for update
   $('.update_data').click(function(){ 
         var mode= "updateModal"; 
         var data_id = $(this).attr("id");  
         $.ajax({  
              url:"Script/userpayment.php",  
              method:"POST",  
              data:{data_id:data_id,mode:mode},  
              success:function(data){
                   var jsonObj = JSON.parse(data);  
                   // changing modal title
                  $("#subject").html("MAKE PAYMENT");
                  $("#paymentReason").val(jsonObj[0].payment_purpose);
                  $("#paymentAmount").val(jsonObj[0].payment_amount);
                  $("#save_btn").text("MAKE CONTRIBUTION");
                  $("#duesModal").modal("show");
              }  
             });  
    });


// for contributions history
    $("#historybtn").click(function(){
      
      var mode= "getHistory";
      $.ajax({  
                url:"Script/userpayment.php",  
                method:"POST",  
                data:{mode:mode},  
                success:function(data){
                  $("#historyBody").html('');
                    var jsonObj = JSON.parse(data);
                    for (var i = 0; i < jsonObj.length; ++i) {

                         $("#historyBody").append(
                            '<tr class="row"><td>'+jsonObj[i].purpose+'</td><td>'+jsonObj[i].reason+'</td><td>'+jsonObj[i].amount_payed+'</td><td>'+jsonObj[i].date_done+'</td></tr>'

                          );

                    }
                    $("#duesHistoryModal").modal("show");
                } 
            }); 
          });
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // for reset modal when close
        $('#contributionModal').on('hidden.bs.modal', function () {
            $("#contributionsSubject").html("ADD NEW CONTRIBUTION");
            $("#contributions_form")[0].reset();
          })

        // for search
        $("#consearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#contresultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });



        //for inserting 
          $("#contributions_form").on("submit",function(e){
          e.preventDefault();
              if (confirm("ARE YOU SURE YOU WANT TO MAKE THIS CONTRIBUTION?")) {
                $.ajax({
                url:"Script/contribution.php",
                method:"POST",
                data:$("#contributions_form").serialize(),
                beforeSend:function(){  
                          $('#contributions_save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                      if (data == "success") {
                          $("#contributionModal").modal("hide");
                          $("#contributions_form")[0].reset();
                          window.location.replace("contributions.php");
                         }else if(data == "insufficient_Balance"){
                          alert("Sorry, you do not have enough credit in your wallet. Please top up");
                          $("#contributionModal").modal("hide");
                          $("#contributions_form")[0].reset();
                         }
                } 

                });
              }else{ return false;}   
            });

        // for update
        $('.make_contribution').click(function(){ 
           var mode= "updateModal"; 
           var data_id = $(this).attr("id");
           $("#contribution_id").val(data_id);  
           $.ajax({  
                url:"Script/contribution.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE CONTRIBUTION DETAILS");
                    $("#contributionName").val(jsonObj[0].contribution_name);
                    $("#save_btn").text("MAKE CONTRIBUTION");
                    $("#contributionModal").modal("show");
                }  
               });  
          });

    // for contributions history
    $("#contHistorybtn").click(function(){
      var mode= "getHistory";
      $.ajax({  
                url:"Script/contribution.php",  
                method:"POST",  
                data:{mode:mode},  
                success:function(data){
                    var jsonObj = JSON.parse(data);
                    for (var i = 0; i < jsonObj.length; ++i) {

                         $("#contributionshistoryBody").append(
                            '<tr class="row"><td>'+jsonObj[i].purpose+'</td><td>'+jsonObj[i].reason+'</td><td>'+jsonObj[i].amount_payed+'</td><td>'+jsonObj[i].date_done+'</td></tr>'

                          );

                    }
                    $("#contributionsHistoryModal").modal("show");
                }  
            });

    });
}); 
 </script>