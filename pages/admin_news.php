<?php include("header.php");
  require_once("Classes/News.php");
?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">NEWS SETUP PAGE</h3>
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
                 <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEWS</button>
              </div>
            </div>
            <div class="table-responsive"><br>
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
                                          <input type='button' name='view' value='Update' id='".trim($row["news_id"])."' class='btn btn-info btn-xs update_data' />
                                        </td>
                                        <td>
                                          <input type='button' name='view' value='Delete' id='".trim($row["news_id"])."' class='btn btn-danger btn-xs del_data' />
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
</div>
<!-- modal  -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><center><u><b id="subject">ADD NEWS</b></u></center></h4>
      </div>
      <div class="modal-body" id="bg">
     <form method="POST" id="insert_form" enctype="multipart/form-data"> 
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                 <label for="newsTitle">NEWS TITLE</label>
                <input type="text" class="form-control" id="newsTitle" placeholder="Enter title of news &hellip;" name="newsTitle" autocomplete="off">
                   
                  </div>
            </div>
             <div class="col-md-6">
                <label for="title">UPLOAD IMAGE</label>
                <input type="file" class="form-control" id="file" name="files[]" multiple>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                 <label for="roles">NEWS CATEGORY</label>
                    <select name="newscategory" id="newscategory" class="form-control">
                     <option value="general">General</option>
                     <option value="meeting">Meeting</option>
                     <option value="warning">Warning</option>
                     <option value="notice">Notice</option>>
                  </select>
            </div>
          </div>
         
          <div class="col-md-12">
              <div class="form-group">
                <label for="editor">NEWS CONTENT</label>
                <textarea name="editor" id="editor"></textarea>
                <input type="hidden" name="newsContent" id="newsContent" value="">
              </div>
          </div>
      <!-- news id -->
      <input type="hidden" name="data_id" id="data_id" value="">
    <!-- mode for submit -->
        <input type="hidden" name="mode" id="mode" value="insert">
    <!-- for made by -->
        <input type="hidden" name="madeBy" id="madeBy" value="<?php echo $_SESSION['user_id'];?>">

        <div class="well modal-footer" id="bg">
         <input type="submit" id="save_btn"  class="btn btn-danger btn-block" name="submit" value="ADD NEWS" />
        </div>
           
          </div>      
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 <?php include("footer.php");?>

 <script>
    $(document).ready(function(){
       //for ckeditor
      CKEDITOR.replace('editor');

      // for reset modal when close
      $('#myModal').on('hidden.bs.modal', function () {
          $("#subject").html("ADD NEWS");
          // to reset rest of the form
          $("#insert_form")[0].reset();
            // to reset ckeditor
             CKEDITOR.instances['editor'].setData(" ");
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
                // getting content from the ckeditor and hide it in an input form to send
                var ckeditorContent = CKEDITOR.instances['editor'].getData();
                $("#newsContent").val(ckeditorContent);
               
                $.ajax({
                url:"Script/news.php",
                method:"POST",
                enctype: 'multipart/form-data',
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                beforeSend:function(){  
                          $('#save_btn').val("Please wait ...");  
                     },
                success:function(data){  
                  // alert(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      window.location.replace("admin_news.php");
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
                url:"Script/news.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                     var jsonObj = JSON.parse(data);  
                     
                     // changing modal title
                    $("#subject").html("UPDATE NEWS DETAILS");
                    // console.log(option);
                    $("#newsTitle").val(jsonObj[0].news_title);
                    $("#newsCategory").val(jsonObj[0].news_category);
                    CKEDITOR.instances['editor'].setData(jsonObj[0].news_content);
                    $("#data_id").val(jsonObj[0].news_id);
                    $("#save_btn").val("UPDATE NEWS");
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
                      url:"Script/news.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                          
                      }  
                     }); 

               }else{
                return false;
              }  
          });
    });
  </script>