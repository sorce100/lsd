<?php include("header.php");
      require_once("Classes/Division.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">ADD DIVISION</h3>
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
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD DIVISION</button>
              </div>
            </div>
            
            <div class="table-responsive"><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>DIVISION ALIAS</th>
                            <th>DIVISION NAME</th>
        
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                      <?php
                          $objdivision = new Division;
                          $divisions = $objdivision->get_divisions(); 
                          foreach ($divisions as $division) {
                                  echo "
                                      <tr class='row'>
                                        <td>".$division["division_alias"]."</td>
                                        <td>".$division["division_fullname"]."</td>
                                       
                                        <td>
                                          <input type='button' name='view' value='Update' id='".trim($division["division_id"])."' class='btn btn-info btn-xs update_data' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Delete' id='".trim($division["division_id"])."' class='btn btn-danger btn-xs del_data' />
                                        </td>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADD NEW DIVISON</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="insert_form" method="POST"> 
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                       <label for="divisionFullname">DIVISION FULLNAME</label>
                       <input type="text" class="form-control" id="divisionFullname" placeholder="Enter divison fullname &hellip;" name="divisionFullname" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="divisonAlias">DIVISION ALIAS</label>
                       <input type="text" class="form-control" id="divisonAlias" placeholder="Enter division alias &hellip;" name="divisonAlias" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                       <label for="divisionYoutube">DIVISION YOUTUBE CHANNEL</label>
                       <input type="text" class="form-control" id="divisionYoutube" placeholder="Enter enter division youtube Id &hellip;" name="divisionYoutube" autocomplete="off">
                    </div>
                </div>
              </div>
             <!-- for inserting the page id -->
              <input type="hidden" name="data_id" id="data_id" value="">
             <!-- for insert query -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <div class="well modal-footer" id="bg">
                <input type="submit" id="save_btn" class="btn btn-danger btn-block" name="submit" value="ADD DIVISON" />
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
            $("#subject").html("ADD DIVISION");
            $("#insert_form")[0].reset();
            // var checkbox = $('input[id = "pageCheckBox"]').each(function(){ 
            //   $(this).attr('checked',false);
            // });
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
                url:"Script/division.php",
                method:"POST",
                data:$("#insert_form").serialize(),
                beforeSend:function(){  
                          $('#save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                  // alert(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("super_division.php");
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
                url:"Script/division.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE DIVISIONS");
                    $("#divisionFullname").val(jsonObj[0].division_fullname);
                    $("#divisonAlias").val(jsonObj[0].division_alias);
                    $("#divisionYoutube").val(jsonObj[0].division_youtube);
                    $("#data_id").val(jsonObj[0].division_id);
                    $("#save_btn").val("UPDATE Division");
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
                      url:"Script/division.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          window.location.replace("super_division.php");
                      }  
                     }); 

               }else{
                return false;
              }  
          });

          });  
 </script>