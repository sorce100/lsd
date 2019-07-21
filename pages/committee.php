<?php 
      include("header.php");
      require_once("Classes/Committee.php");
      require_once("Classes/Members.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">MEMBER COMMITTEES</h3>
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
    </div>
</div>
<!-- /.row -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="myFunction()"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title mainCommittee"></h4>
      </div>
      <div class="modal-body" id="bg">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a data-toggle="tab" href="#info"><i class="fa fa-info"></i> Info</a></li>
          <li><a data-toggle="tab" href="#pages"><b><i class="fa fa-document"></i> Pages</b></a></li>
          <li><a data-toggle="tab" href="#notes"><b><i class="fa fa-pencil"></i> Notes</b></a></li>
          <li><a data-toggle="tab" href="#library"><b><i class="fa fa-book"></i> Library</b></a></li>
        </ul>

        <div class="tab-content">
          <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <div id="info" class="tab-pane fade in active">
            <div class="row">
              <div class="col-md-6 table-responsive panel">
                  <h3>Committee Information</h3>
                  <table class="table table-hover">
                     <tr>
                      <td><b>Name</b></td>
                      <td id="committeeName"></td>
                    </tr>
                    <tr>
                      <td><b>Opened</b></td>
                      <td id="committeeOpen"></td>
                    </tr>
                    <tr>
                      <td><b>Status</b></td>
                      <td id="committeeStatus"></td>
                    </tr>
                    <tr>
                      <td><b>Members Total</b></td>
                      <td id="committeeTotal"></td>
                    </tr>
                  </table>
              </div>
              <div class="col-md-6 panel" style="border-left: 1px solid #f4f4f4;">
                  <h3>Committee Members</h3>
                  <div id="committeeMemDiv"></div>
              </div>
            </div>
          </div>
          <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <div id="pages" class="tab-pane fade">
            <div class="row">
              <!-- display content of completed notes -->
              <div class="col-md-12">
                <table  id="commPagesDiv">
                  
                </table>
              </div>
            </div>
          </div>
          <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <div id="notes" class="tab-pane fade">
            <div class="row">
              <div class="col-md-12">
                <button id="addNoteBtn" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> ADD NEW NOTE</button>
              </div>
              <!-- display content of completed notes -->
              <div class="col-md-12" id="commNotesDiv"></div>
            </div>
          </div>
          <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <div id="library" class="tab-pane fade">
             <div class="row">
                <div class="col-md-offset-4">
                  <button id="addLibraryBtn" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> UPLOAD NEW DOCUMENTS</button>
                </div>
                <!-- display content of completed notes -->
                <div class="col-md-7 table-responsive" style="border-right: 1px solid #f4f4f4;">
                  <table class="table" >
                    <thead>
                      <th><b>Library Subject</b></th>
                      <th><b>Last Updated</b></th>
                      <th></th>
                    </thead>
                    <tbody id="commLibraryDiv"></tbody>
                  </table>
                </div>
                <div class="col-md-5 table-responsive">
                  <table id="libraryContentDisplay" class="table table-condensed"></table>
                </div>
              </div>
            </div>
          </div>
          <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
         
        </div>
    </div>
  </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- /////////////////////////////Add Note Modal//////////////////////////////////// -->
 <div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title">ADD COMMITTEE NOTE</h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="addNote_form" method="POST"> 
        <div class="row">
          <div class="form-group">
            <div class="col-md-2"><label for="title">Title</label></div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="commNoteTitle" name="commNoteTitle" placeholder="Title of Note &hellip;" autocomplete="off" required>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="form-group">
            <div class="col-md-2"><label for="title">Message</label></div>
            <div class="col-md-10">
              <textarea type="text" class="form-control" id="commNoteMessage" name="commNoteMessage" rows="10" autocomplete="off" placeholder="Content of Message &hellip;" required></textarea>
            </div>
          </div>
        </div>
        <br>
         <!-- for inserting the page id -->
        <input type="hidden" name="data_id" id="note_comm_id" value="">
         <!-- for insert query -->
        <input type="hidden" name="mode" id="note_mode" value="insert">
        <div class="modal-footer" id="bg">
            <input type="submit" id="addNoteSubmit" class="btn btn-danger btn-block" name="addNoteSubmit" value="SAVE" />
        </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- /////////////////////////////Add Documents Modal//////////////////////////////////// -->
 <div class="modal fade" id="addDocModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title">UPLOAD DOCUMENTS</h4>
      </div>
      <div class="modal-body" id="bg">
     <form id="addDoc_form" method="POST" enctype="multipart/form-data"> 
        <div class="row">
          <div class="form-group">
            <div class="col-md-2"><label for="title">Subject</label></div>
            <div class="col-md-10">
              <input type="text" class="form-control" id="commLibrarySubject" name="commLibrarySubject" placeholder="Subject of Upload &hellip;" autocomplete="off" required>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="form-group">
            <div class="col-md-2"><label for="title">Add Documents</span></label></div>
            <div class="col-md-10">
                <div class="input_fields_wrap">
                    <div class="input-group" style="margin-top:7px;"><input type="file" class="form-control" id="file_upload_btn" name="file_array[]" multiple><span class="input-group-addon add_field_button" style="background-color:#DE8280;color:#fff;"><i class="fa fa-plus"></i></span></div>
                </div>
            </div>
          </div>
        </div>
        <br>
        <!-- for committee folder name -->
        <input type="hidden" name="comm_folderName" id="comm_folderName" value="">
         <!-- for inserting the page id -->
        <input type="hidden" name="data_id" id="doc_comm_id" value="">
         <!-- for insert query -->
        <input type="hidden" name="mode" id="doc_mode" value="insert">
        <div class="modal-footer" id="bg">
            <input type="submit" id="addDocSubmit" class="btn btn-danger btn-block" name="addDocSubmit" value="Upload" />
        </div>        
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php include("footer.php");?>
 <script>  
      $(document).ready(function(){
        // for reset modal when close
        $('#myModal').on('hidden.bs.modal', function () {
            $("#addNote_form")[0].reset();
            $("#addDoc_form")[0].reset();

          })

        // for committee members search
        $("#commMemSearch").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#comMemDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
/*///////////////////////////////////////////// add note  button /////////////////////////////////////////////////////*/
         $(document).on("click","#addNoteBtn", function(e){ //user click on remove text
             $('#addNoteModal').modal('show');
          });

         //for inserting 
          $("#addNote_form").on("submit",function(e){
                e.preventDefault();
                $.ajax({
                url:"Script/committeeNote.php",
                method:"POST",
                data:$("#addNote_form").serialize(),
                beforeSend:function(){  
                    $('#addNoteSubmit').val("Please wait ...");  
                },
                success:function(data){  
                  console.log(data);
                     $("#addNoteModal").modal("hide");
                     $("#addNote_form")[0].reset();
                     if (data == "success") {
                      get_comm_Notes($('#note_comm_id').val());
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });
          // get all notes when saved successfull
          function get_comm_Notes(committeeId){
            $('#commNotesDiv').html('');
            let mode = "get_notes";
            $.ajax({  
              url:"Script/committeeNote.php",  
              method:"POST",  
              data:{mode:mode,data_id:committeeId},  
              success:function(results){
                // console.log(results);
                var jsonObj = JSON.parse(results);
                for (var i = 0; i < jsonObj.length; i++) {
                    $('#commNotesDiv').append('<div style="background-color:#f4f4f4;" class="well">'+
                      '<h4><b>'+jsonObj[i].committee_note_title+'</b></h4>'+
                      '<h4><i>'+jsonObj[i].committee_note_message+'</i></h4>'+
                      '<small>posted on:'+jsonObj[i].date_done+'</small>'+
                      '</div>');
                }
              }  
            }); 
          }


/*///////////////////////////////////////////// add Document  button /////////////////////////////////////////////////////*/
         $(document).on("click","#addLibraryBtn", function(e){ //user click on remove text
             $('#addDocModal').modal('show');
          });

            // click to upload more files
              var max_fields      = 10; //maximum input boxes allowed
              var wrapper         = $(".input_fields_wrap"); //Fields wrapper
              var add_button      = $(".add_field_button"); //Add button ID
              
              var x = 1; //initlal text box count
              
              $(add_button).click(function(e){ //on add input button click
                  e.preventDefault();
                  if(x < max_fields){ //max input box allowed
                      x++; //text box increment
                      $(wrapper).append('<div class="input-group" style="margin-top:7px;"><input type="file" class="form-control" id="file_upload_btn" name="file_array[]" multiple><span class="input-group-addon remove_field" style="background-color:#DE8280;color:#fff;"><i class="fa fa-trash"></i></span></div>'); //add input box
                  }
              });
              
              $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                  e.preventDefault(); $(this).parent('div').remove(); x--;;
              });


         //for inserting 
          $("#addDoc_form").on("submit",function(e){
                e.preventDefault();
                $.ajax({
                url:"Script/committeeLibrary.php",
                method:"POST",
                enctype: 'multipart/form-data',
                data:new FormData(this),  
                contentType:false,  
                processData:false,
                beforeSend:function(){  
                  $('#addDocSubmit').prop('disabled','disabled').val('Loading...');  
                },
                success:function(data){  
                  console.log(data);
                     $("#addDocModal").modal("hide");
                     $("#addDoc_form")[0].reset();
                     if (data == "success") {
                      get_comm_Library($('#doc_comm_id').val());
                     }
                     else if(data == "error"){
                      
                     }
                } 

                });  
            });


          // get all notes when saved successfull
          function get_comm_Library(committeeId){
            $('#commLibraryDiv').html('');
            let mode = "getAll";
            $.ajax({  
              url:"Script/committeeLibrary.php",  
              method:"POST",  
              data:{mode:mode,committeeId:committeeId},  
              success:function(results){
                // console.log(results);
                var jsonObj = JSON.parse(results);
                for (var i = 0; i < jsonObj.length; i++) {
                    $("#commLibraryDiv").append("<tr>"+
                      "<td>"+jsonObj[i].committee_library_subject+"</td>"+
                      "<td>"+jsonObj[i].date_done+"</td>"+
                      "<td><button type='button' id='"+jsonObj[i].committee_library_folderName+"' class='btn btn-info viewContent' value='"+jsonObj[i].committee_library_files+"'>View Content <i class='fa fa-eye'></i></button></td>"+
                      "</tr>");
                }
              }  
            }); 
          }

        // get content of the folder when opened
        $('body').on('click','.viewContent',function(){
          $('#libraryContentDisplay').html('');
            $('#libraryContentDisplay').html('<h4><b>Upload Content</b></h4>');
            var folderFiles = $(this).prop("value");
            var jsonfolderFiles = JSON.parse(folderFiles);
            // console.log(folderFiles);
            for (var i = 0; i < jsonfolderFiles.length; i++) {
              $('#libraryContentDisplay').append('<tr>'+
                  '<td>'+jsonfolderFiles[i]+'</td><td><button type="button" class="btn-default">Download <i class="fa fa-download"></i></button></td>'+
                  '<td><button type="button" class="btn-success">Read <i class="fa fa-eye"></i></button></td>'+
                '</tr>');
            }    
        }); 

////////////////////////////////////////end add docs///////////////////////////////////////////////////


        // for getting general committee information
        $('.get_committee_info').click(function(){ 
             let mode= "getInfo"; 
             let data_id = $(this).prop("id");
             let folderName = $(this).prop("value");
             // insert committee id into note and document and folderName upload modal 
             $('#note_comm_id').val(data_id);
             $('#doc_comm_id').val(data_id);
             $("#comm_folderName").val(folderName);
             $('#commPagesDiv').html(''); 
              // updates notes when committee is clickes
              get_comm_Notes(data_id);
              // update  library contents
              get_comm_Library(data_id);

             $.ajax({  
              url:"Script/committee.php",  
              method:"POST",  
              data:{data_id:data_id,mode:mode},  
              success:function(data){
                // passing data from server for particular id selected
               let jsonObj = JSON.parse(data);

                $(".addNoteModal").html("<b>"+jsonObj[0].committee_name+"</b>");
                $("#committeeName").html(jsonObj[0].committee_name);
                $("#committeeOpen").html(jsonObj[0].date_done);
                // for account hide or not
                  if (jsonObj[0].record_hide=="NO") {
                       $("#committeeStatus").html("ACTIVE");
                  }
                  else if (jsonObj[0].record_hide=="YES"){

                      $("#committeeStatus").html("INACTIVE");
                  }
                  // for getting members details
                let membersArray = JSON.parse(jsonObj[0].committee_members);
                $("#committeeTotal").html(membersArray.length);
                  // loop through members and add details to the form
                  for (var i = 0; i < membersArray.length; i++) {
                    // call function to display members details
                    get_members_details(membersArray[i]);
                  }

                  // for pages list
                  if (jsonObj[0].committee_pages != '') {
                    let pagesArray = JSON.parse(jsonObj[0].committee_pages);
                    if ($.isArray(pagesArray)) {
                        for (var i = 0; i < pagesArray.length; i++) {
                          // call function to display members details
                          get_pages_details(pagesArray[i]);
                        }
                    }
                  }
                  
                  


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
// get members name and details for 
    function get_members_details(memberId){
       $('#committeeMemDiv').html('');
      let mode = "updateModal";
      $.ajax({  
        url:"Script/members.php",  
        method:"POST",  
        data:{mode:mode,data_id:memberId},  
        success:function(results){
          let jsonObj = JSON.parse(results);
          let fullname = jsonObj[0].first_name+' '+jsonObj[0].other_name+' '+jsonObj[0].last_name;
          let ProfNum = jsonObj[0].professional_number;
          let contact = jsonObj[0].personal_contact;
          let surveyor_type = jsonObj[0].surveyor_type;
          let designation = jsonObj[0].designation;
          let region = jsonObj[0].region; 
          // search for case contact and insert value
          $('#committeeMemDiv').append(
            '<table>'+
              '<tr><td><b>Name: </b></td><td>'+fullname+'</td><td><b> Diploma NO: </b></td><td>'+ProfNum+'</td></tr>'+
              '<tr><td><b>Type: </b></td><td>'+surveyor_type+'</td><td><b> Designation: </b></td><td>'+designation+'</td></tr>'+
              '<tr><td><b>Contact: </b></td><td>'+contact+'</td><td><b> Region: </b></td><td>'+region+'</td></tr>'+
            '</table><hr>');
        }  
      }); 
    }


  ////////////////////////////////////////////
  // get pages details
  function get_pages_details(pagesId){
      
      let mode = "updateModal";
      $.ajax({  
        url:"Script/pages.php",  
        method:"POST",  
        data:{mode:mode,data_id:pagesId},  
        success:function(results){
          let jsonObj = JSON.parse(results);
          console.log(jsonObj);
          // search for case contact and insert value
          $('#commPagesDiv').append(
            '<tr><td>'+jsonObj[0].pages_url+'</td></tr><br>');
        }  
      }); 
    }

}); 
 </script>