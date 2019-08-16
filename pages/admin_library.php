<?php 
      include("header.php");
      require_once("Classes/Library.php");
?>

<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">DIVISION LIBRARY SETUP PAGE</div>
            <div class="panel-title pull-right">
               <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> NEW UPLOAD</button>
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
                            <th>SUBJECT</th>
                            <th>DATE UPLOADED</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="resultsDisplay">
                       <?php
                          $objLibrary = new Library;
                          $Library_details = $objLibrary->get_librarys(); 
                          foreach ($Library_details as $Library_detail) {
                                  echo "
                                      <tr>
                                        <td>".$Library_detail["library_subject"]."</td>
                                        <td>".$Library_detail["date_done"]."</td>
                                        <td>
                                          <button type='button' id='".trim($Library_detail["library_id"])."' class='btn btn-info btn-xs update_data'>Update <i class='fa fa-edit'></i></button>
                                        </td>
                                        <td>
                                        <button type='button' id='".trim($Library_detail["library_id"])."' class='btn btn-danger btn-xs del_data'>Delete <i class='fa fa-trash'></i></button>
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



 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title" ><b id="subject">UPLOAD DIGITAL LIBRARY</b></h4>
      </div>
      <div class="modal-body">
      <form id="insert_form" method="POST" enctype="multipart/form-data"> 
        <!-- for first person -->
            
            <div class="row">
              <div class="col-md-2">
                <label for="title">SUBJECT</label>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                    <input type="text"  maxlength="70" class="form-control" id="librarySubject" placeholder="Enter Subject of upload &hellip;" name="librarySubject" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <label for="title">CATEGORY</label>
              </div>
              <div class="col-md-10">
                <div class="form-group" >
                    <select class="form-control" name="libraryCategory" id="libraryCategory" required >
                      <option selected disabled> Please Select</option>
                      <option value="CPD">CPD</option>
                      <option value="Monthy Meetings">Monthy Meetings</option>
                      <option value="Seminar">Seminar</option>
                      <option value="Young Surveyors Network">Young Surveyors Network</option>
                      <option value="Libray">Libray</option>
                      <option value="Publications">Publications</option>
                      <option value="Conferences">Conferences</option>
                      <option value="Committee">Committee</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <label for="title">DESCRIPTION</label>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                  <textarea class="form-control" id="libraryDescription" placeholder="Enter any additional information about the subject &hellip;" name="libraryDescription" autocomplete="off" rows="5"></textarea>
                </div>
              </div>
            </div><br>
          
            <div class="input_fields_wrap">
                <button class="add_field_button btn-block btn-info" style="padding: 10px;"><span class="glyphicon glyphicon-plus"> </span> CLICK TO ADD MORE FILES <span class="glyphicon glyphicon-plus"></span> </button><br><br>
            </div>
            <div id="doc_display"></div>

              <!-- for insert query -->
              <input type="hidden" name="mode" id="mode" value="insert">
              <!-- hide id -->
              <input type="hidden" name="data_id" id="data_id" value="">
              <!-- for foldername -->
              <input type="hidden" name="folderName" id="folderName" value="">
            <div class="well modal-footer" id="bg">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
              <button type="submit" class="btn btn-info" id="save_btn">Upload Library <i class="fa fa-save"></i></button>
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
            $("#subject").html("SETUP NEW SCHOOL");
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
                $.ajax({
                url:"Script/library.php",
                method:"POST",
                enctype: 'multipart/form-data',
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                beforeSend:function(){  
                      $('#back_btn').hide();
                      $('#save_btn').text("Please wait ...");  
                     },
                success:function(data){  
                  alert(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();

                      window.location.replace("admin_library.php");

                  } 

                });  
            });

        // for update
        $('.update_data').click(function(){ 
           var mode = "updateModal"; 
           var data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/library.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                  // alert(data);
                    var jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE LIBRARY ARCHIVE");
                    $("#uploadPage_btn").html("VIEW UPLOADED DOCUMENTS >>>");
                    $("#librarySubject").val(jsonObj["library_subject"]);
                    $("#libraryCategory").val(jsonObj["library_category"]);
                    $("#libraryDescription").val(jsonObj["library_description"]);
                    $("#data_id").val(jsonObj["library_id"]);
                    $("#folderName").val(jsonObj["folder_name"]);
                    $("#save_btn").text("Update Library Upload");
                    $("#mode").val("update");

                    // if there is document folder then get files names and display
                    var folder = jsonObj["folder_name"];
                    if (folder != '') {
                          var mode = "get_document_content"; 
                          $.ajax({
                              url:"Script/library.php",  
                              method:"POST",  
                              data:{folderName:folder,mode:mode},
                              success:function(fileData){
                                $("#doc_display").html('');
                                var fileJsonObj = JSON.parse(fileData);
                                // create a top border to seperate the files already saved
                                $("#doc_display").css({"border-top":"1px solid black","padding-top":"15px","margin-top":"15px"});
                                // loop through the returned array and displaying the files
                                for (var i = 0; i < fileJsonObj.length; i++) {
                                    $("#doc_display").append(fileJsonObj[i]);
                                }
                              }
                          });

                          $("#myModal").modal("show");
                    }
                    else{
                      $("#myModal").modal("show");
                    }

                }  
            });  
        });
// deleting files in the folder 
        $('body').on('click','.file_del_btn',function(){
           if (confirm("ARE YOU SURE YOU WANT TO DELETE THIS FILE?")) {
                 var ulSelect = $(this).parents('ul');
                 var mode = "deleteFile"; 
                 var fileName = $(this).attr("id");
                 var folder = $(this).attr("name");  
                 $.ajax({  
                      url:"Script/library.php",  
                      method:"POST",  
                      data:{mode:mode,fileName:fileName,folderName:folder},  
                      success:function(data){
                         if (data == "success") {
                              ulSelect.remove();
                         }
                      }  
                     }); 

               }else{
                return false;
              }
        });

      
// for delete
  $('.del_data').click(function(){
     if (confirm("ARE YOU SURE YOU WANT TO PROCEED?")) {
         
           var mode= "delete"; 
           var data_id = $(this).attr("id");
           var folderName = $(this).attr("name");  
           $.ajax({  
                url:"Script/library.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode,folderName:folderName},  
                success:function(data){
                  // alert(data);
                    window.location.replace("admin_library.php");
                }  
               }); 

         }else{
          return false;
        }  
    });

// click to upload more files
    var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append("<div><input name='file_array[]' type='file' id='file_upload_btn' class='form-control' multiple /><br><a href='#'' class='remove_field btn btn-danger' style='color:#fff;font-weight:bold;'><span class='glyphicon glyphicon-trash btn-xs'> DELETE FILE</span></a></div><br>"); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
        $(this).find('br').remove();
    });
});  
 </script>