
<!-- modal  -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">ADD NEWS</b></h4>
      </div>
      <div class="modal-body" id="bg">
      <form method="POST" id="insert_form" enctype="multipart/form-data"> 
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="newsTitle">NEWS TITLE <span class="asterick">*</span></label>
              </div>
            </div>
            <div class="col-md-10">
              <div class="form-group"> 
                <textarea rows="4" class="form-control" id="newsTitle" placeholder="Enter title of news &hellip;" name="newsTitle" autocomplete="off" required></textarea>
              </div>
            </div>
          </div>
          <div class="row">
             <div class="col-md-2">
                <label for="roles">NEWS CATEGORY</label>
            </div>
            <div class="col-md-10">
              <div class="form-group">
                <select name="newscategory" id="newscategory" class="form-control">
                 <option value="general">General</option>
                </select>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
             <div class="col-md-2">
                <label for="title">UPLOAD IMAGE</label>
            </div>
            <div class="col-md-5" style="border-right:1px solid black; ">
              <div class="form-group">
                <div>
                    <button class="add_field_button btn-block btn-info" style="padding: 2px;"> ADD IMAGES <span class="glyphicon glyphicon-plus"></span> </button><br>
                    <!-- for document input forms -->
                    <div class="input_fields_wrap"></div>
                </div>
                 <!-- <input type="file" class="form-control" id="file" name="files[]" multiple> -->
              </div>
            </div>
            <div class="col-md-5">
              <!-- to list content of news images uploads -->
              <div id="newsImgDiv"></div>

            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <textarea name="editor" id="editor"></textarea>
                  <input type="hidden" name="newsContent" id="newsContent" value="">
                </div>
            </div>
            <!-- foldername -->
            <input type="hidden" name="foldername" id="foldername" value="">
            <!-- filesuploaded -->
            <input type="hidden" name="imgsUploaded" id="imgsUploaded" value="">
            <!-- news id -->
            <input type="hidden" name="data_id" id="data_id" value="">
            <!-- mode for submit -->
            <input type="hidden" name="mode" id="mode" value="insert">
            <!-- for made by -->
            <input type="hidden" name="madeBy" id="madeBy" value="<?php echo $_SESSION['user_id'];?>">
          </div>

          <div class="row">
            <div class="col-md-12">
              <!--for progress modal  -->
              <div class="progress">
                <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"> 0% </div>
              </div>
            </div>
          </div>
          <div class="well">
            <div class="well modal-footer" id="bg">
             <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
             <button type="submit" class="btn btn-info" id="save_btn">Add News <i class="fa fa-save"></i></button>
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
      // reset progress bar
        $('#progressBar').prop('aria-valuemax',0).css('width',0 + '%').text(0 + '%');
       //for ckeditor
      CKEDITOR.replace('editor');
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // click to upload more files
      let max_fields      = 8; //maximum input boxes allowed
      let wrapper         = $(".input_fields_wrap"); //Fields wrapper
      let add_button      = $(".add_field_button"); //Add button ID
      
      let x = 1; //initlal text box count
      
      $(add_button).click(function(e){ //on add input button click
          e.preventDefault();
          if(x < max_fields){ //max input box allowed
              x++; //text box increment
              $(wrapper).append('<div class="input-group" style="margin-top:7px;"><input type="file" class="form-control" id="file" name="files[]" required><span class="input-group-addon remove_field" style="background-color:#DE8280;color:#fff;"><i class="fa fa-trash"></i></span></div>'); //add input box
          }
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
          e.preventDefault(); $(this).parent('div').remove(); x--;;
      });
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      // for reset modal when close
      $('#myModal').on('hidden.bs.modal', function () {
          $("#subject").html("ADD NEWS");
          // to reset rest of the form
          $("#insert_form")[0].reset();
          // to reset ckeditor
          CKEDITOR.instances['editor'].setData(" ");
          // empty clean images
           $("#newsImgDiv").html('');
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
                // getting content from the ckeditor and hide it in an input form to send
                let ckeditorContent = CKEDITOR.instances['editor'].getData();
                $("#newsContent").val(ckeditorContent);
               
                $.ajax({
                 // for progress bar
                xhr:function(){
                  let xhr = new XMLHttpRequest();
                  xhr.upload.addEventListener('progress',function(e){
                    // check if upload length is true or false
                    if (e.lengthComputable) {
                      let uploadPercent = Math.round((e.loaded/e.total)*100);
                      // updating progress bar pecentage
                      $('#progressBar').prop('aria-valuemax',uploadPercent).css('width',uploadPercent + '%').text(uploadPercent + '%');
                    }
                  });
                  return xhr;
                },
                url:"Script/news.php",
                method:"POST",
                enctype: 'multipart/form-data',
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                beforeSend:function(){  
                    $('#save_btn').text("Please wait ...");  
               },
                success:function(data){  
                  // console.log(data);
                     $("#myModal").modal("hide");
                     $("#insert_form")[0].reset();
                     if (data == "success") {
                      location.reload();
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });
// for update
        $('.update_data').click(function(){ 
           let jsonObjNewsImgs;
           let mode= "updateModal"; 
           let data_id = $(this).attr("id");  
           $.ajax({  
                url:"Script/news.php",  
                method:"POST",  
                data:{data_id:data_id,mode:mode},  
                success:function(data){
                    let jsonObj = JSON.parse(data);  
                     // changing modal title
                    $("#subject").html("UPDATE NEWS DETAILS");
                    // console.log(option);
                    $("#newsTitle").val(jsonObj[0].news_title);
                    $("#newsCategory").val(jsonObj[0].news_category);
                    if (jsonObj[0].file_name !="") {
                        jsonObjNewsImgs = JSON.parse(jsonObj[0].file_name);
                        for (let i = 0; i < jsonObjNewsImgs.length; i++) {
                          $("#newsImgDiv").append('<div class="input-group" style="margin-top:7px;"><input type="text" value="'+jsonObjNewsImgs[i]+'" class="form-control" id="file" name="files[]" readonly><span class="input-group-addon remove_field" style="background-color:#DE8280;color:#fff;"><i class="fa fa-trash"></i></span></div>');
                        }
                    }
                    
                    CKEDITOR.instances['editor'].setData(jsonObj[0].news_content);
                    $("#foldername").val(jsonObj[0].folder_name);
                    $("#imgsUploaded").val(jsonObj[0].file_name);
                    $("#data_id").val(jsonObj[0].news_id);
                    $("#save_btn").text("Update News");
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
                      url:"Script/news.php",  
                      method:"POST",  
                      data:{data_id:data_id,mode:mode},  
                      success:function(data){
                        location.reload();
                      }  
                     }); 

               }else{
                return false;
              }  
          });
    });
  </script>