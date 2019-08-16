<?php 
include("header.php");
require_once("Classes/Division.php");
?>
<br>
<!--  -->
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">
                    <select class="form-control" name="divisonSelect" id="divisonSelect" required style="border: 1px solid red;">
                      <option  disabled selected>SELECT DIVISION</option>
                      <?php 
                          $objDivision = new Division;
                          $divisions = $objDivision->get_divison_alias();
                          foreach ($divisions as $division) {
                            echo '<option value="'.$division["division_id"].'">'.$division["division_alias"].'</option>';
                          }
                       ?>
                    </select>

             </div>
            <div class="panel-title pull-right">LIBRARY ARCHIVES </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">

          <!-- tabs for nvaigation -->
            <div class="col-md-12 ">
              <div class="panel panelTabs" >
                <ul class="nav nav-tabs nav-justified">
                  <li class="active"><a data-toggle="tab" href="#cpd">CPD <i class="fa fa-file"></i></a></li>
                  <li><a data-toggle="tab" href="#monthmeeting">Monthly Meetings<i class="fa fa-file"></i></a></li>
                  <li><a data-toggle="tab" href="#seminar">Seminar <i class="fa fa-file"></i></a></li>
                  <li><a data-toggle="tab" href="#ysn">Young Surveyors  <i class="fa fa-file"></i></a></li>
                  <li><a data-toggle="tab" href="#library">Library <i class="fa fa-file"></i></a></li>
                  <li><a data-toggle="tab" href="#publication">Publications <i class="fa fa-file"></i></a></li>
                  <li><a data-toggle="tab" href="#conference">Conference <i class="fa fa-file"></i></a></li>
                  <li><a data-toggle="tab" href="#committee">Committee <i class="fa fa-file"></i></a></li>
                </ul>
              </div>
            </div>

            <hr>
          <!-- tabs for nvaigation -->
            <!-- for search -->
            <div class="col-md-12">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Search &hellip;" id="searchInput" autocomplete="off">
                  <span class="input-group-btn"><button type="button" class="btn btn-info">Go</button></span>
                </div>
            </div>
            <!-- content -->
            <div class="col-md-12">
                <div class="tab-content">
                  <div id="cpd" class="tab-pane fade in active">
                    <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARCHIVE SUBJECT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cpdDisplay">
                                  
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div id="monthmeeting" class="tab-pane fade">
                    <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARCHIVE SUBJECT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="monthmeetingDisplay">
                                  
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div id="seminar" class="tab-pane fade">
                    <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARCHIVE SUBJECT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="seminarDisplay">
                                  
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div id="ysn" class="tab-pane fade">
                   <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARCHIVE SUBJECT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="ysnDisplay">
                                  
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div id="library" class="tab-pane fade">
                   <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARCHIVE SUBJECT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="libraryDisplay">
                                  
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div id="publication" class="tab-pane fade">
                    <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARCHIVE SUBJECT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="publicationDisplay">
                                  
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div id="conference" class="tab-pane fade">
                    <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARCHIVE SUBJECT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="conferenceDisplay">
                                  
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div id="committee" class="tab-pane fade">
                    <div class="table-responsive"><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ARCHIVE SUBJECT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="committeeDisplay">
                                  
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
            <!-- end of content -->
        </div>
    </div>
</div>
<!--  -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">LIBRARY CONTENT</b></h4>
      </div>
      <div class="modal-body" id="bg">
        <div id="doc_display"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal for reading pdfs -->
<div class="modal fade" id="pdfReaderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close readerClose" aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
      </div>
      <div class="modal-body mainContent" id="bg" style="margin-top: 0;padding: 0;">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- /.row -->
<?php include("footer.php");?>
<!-- includes for pdf js -->
<script src="js/pdf.js"></script>
<script>
    PDFJS.workerSrc = "./js/pdf.worker.js";
</script>

<!-- <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script> -->

<script>  
  $(document).ready(function(){
    // pagerender modal
    $('.readerClose').on('click', function(){
        $('#page_num').val("");
        $('#page_count').val("");
        DEFAULT_VIEW_HISTORY_CACHE_SIZE = 9000;
        localStorage.clear();
        $('#pdfReaderModal').modal('hide');
    });

    // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#cpdDisplay,#monthmeetingDisplay,#seminarDisplay,#ysnDisplay,#libraryDisplay,#publicationDisplay,#conferenceDisplay,#committeeDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

        
      $("#divisonSelect").change(function(){
          var mode = "get_library_archive";
          var divison_id = $(this).val();
          $.ajax({
                url:"Script/library.php",
                method:"POST",
                data:{divison_id:divison_id,mode:mode},
                beforeSend:function(){  
                  $('#cpdDisplay,#monthmeetingDisplay,#seminarDisplay,#ysnDisplay,#libraryDisplay,#publicationDisplay,#conferenceDisplay,#committeeDisplay').html("Please wait ... Fetching data");  
                },
                success:function(data){
                  // alert(data);
                  $('#cpdDisplay,#monthmeetingDisplay,#seminarDisplay,#ysnDisplay,#libraryDisplay,#publicationDisplay,#conferenceDisplay,#committeeDisplay').html('');
                  var jsonObj = JSON.parse(data);  
                    for (var i = 0; i < jsonObj.length; i++) {     
                      switch(jsonObj[i].library_category) {
                      case 'CPD':
                          var count = i+1;
                          $('#cpdDisplay').append("<tr><td>"+count+"</td><td>"+jsonObj[i].library_subject+"</td><td><input type ='button' name='view' value='View Content' id='"+jsonObj[i].folder_name+"' class='btn btn-info btn-xs viewContent'/></td></tr>");
                        break;
                      case 'Monthy Meetings':
                          var count = i+1;
                          $('#monthmeetingDisplay').append("<tr><td>"+count+"</td><td>"+jsonObj[i].library_subject+"</td><td><input type ='button' name='view' value='View Content' id='"+jsonObj[i].folder_name+"' class='btn btn-info btn-xs viewContent'/></td></tr>");
                        break;
                        case 'Seminar':
                          var count = i+1;
                          $('#seminarDisplay').append("<tr><td>"+count+"</td><td>"+jsonObj[i].library_subject+"</td><td><input type ='button' name='view' value='View Content' id='"+jsonObj[i].folder_name+"' class='btn btn-info btn-xs viewContent'/></td></tr>");
                        break;
                        case 'Young Surveyors Network':
                          var count = i+1;
                          $('#ysnDisplay').append("<tr><td>"+count+"</td><td>"+jsonObj[i].library_subject+"</td><td><input type ='button' name='view' value='View Content' id='"+jsonObj[i].folder_name+"' class='btn btn-info btn-xs viewContent'/></td></tr>");
                        break;
                        case 'Libray':
                          var count = i+1;
                          $('#libraryDisplay').append("<tr><td>"+count+"</td><td>"+jsonObj[i].library_subject+"</td><td><input type ='button' name='view' value='View Content' id='"+jsonObj[i].folder_name+"' class='btn btn-info btn-xs viewContent'/></td></tr>");
                        break;
                        case 'Publications':
                          var count = i+1;
                          $('#publicationDisplay').append("<tr><td>"+count+"</td><td>"+jsonObj[i].library_subject+"</td><td><input type ='button' name='view' value='View Content' id='"+jsonObj[i].folder_name+"' class='btn btn-info btn-xs viewContent'/></td></tr>");
                        break;
                        case 'Conferences':
                          var count = i+1;
                          $('#conferenceDisplay').append("<tr><td>"+count+"</td><td>"+jsonObj[i].library_subject+"</td><td><input type ='button' name='view' value='View Content' id='"+jsonObj[i].folder_name+"' class='btn btn-info btn-xs viewContent'/></td></tr>");
                        break;
                        case 'Committee':
                          var count = i+1;
                          $('#committeeDisplay').append("<tr><td>"+count+"</td><td>"+jsonObj[i].library_subject+"</td><td><input type ='button' name='view' value='View Content' id='"+jsonObj[i].folder_name+"' class='btn btn-info btn-xs viewContent'/></td></tr>");
                        break;

                      default:
                        $('#cpdDisplay,#monthmeetingDisplay,#seminarDisplay,#ysnDisplay,#libraryDisplay,#publicationDisplay,#conferenceDisplay,#committeeDisplay').html('');
                    }
                      
                  }
                     // $("#myModal").modal("hide");
                } 

          });  
      });

  // click to view content from the content
    $('body').on('click','.viewContent',function(){
      var folderName = $(this).attr("id");

          if (folderName != '') {
                var mode = "get_folder_content_display"; 
                $.ajax({
                    url:"Script/library.php",  
                    method:"POST",  
                    data:{folderName:folderName,mode:mode},
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
            // display error if there is nothing in the folder
            $("#myModal").modal("show");
          }

  }); 

// click to read file
  $('body').on('click','.readFile',function(){

    $('.mainContent').html('<div class="top_bar "><button class="btn btnReader" id="prev_page"><i class="fa fa-arrow-circle-left"> </i> Prev Page</button><span class="page-info">Page <span id="page_num"> </span> of <span id="page_count"> </span><button class="btn btnReader" id="next_page">Next Page <i class="fa fa-arrow-circle-right"></i></button></div><div style="overflow:auto;"><canvas id="pdf_render"></canvas></div>');

    let folderName = $(this).attr('name');
    let fileName = $(this).attr('id');

    const url = '../uploads/library/'+folderName+'/'+fileName;
    let pdfDoc = null,
        pageNum =1,
        pageIsRendering = false,
        pageNumIsPending = null;

    const scale = 1.3,
          canvas = document.querySelector('#pdf_render'),
          ctx = canvas.getContext('2d');

    // Render the page
    const renderPage = num =>{
      pageIsRendering = true;
      // get the page
      pdfDoc.getPage(num).then(page => {
        // set scale
        const viewport = page.getViewport({scale});
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderCtx = {
          canvasContext: ctx,
          viewport
        }

        page.render(renderCtx).promise.then(() => {
          pageIsRendering = false;

          if(pageNumIsPending !== null){
            renderPage(pageNumIsPending);
            pageNumIsPending = null;
          }
        });
        // output current page
        document.querySelector('#page_num').textContent = num;
      });
    };

    // check for pages rendering
    const queueRenderPage = num =>{
      if(pageIsRendering){
        pageNumIsPending = num;
      }else{
        renderPage(num);
      }
    }

    // show Prev Page
    const showPrevPage = () => {
      if(pageNum <= 1){
        return;
      }
      pageNum--;
      queueRenderPage(pageNum);
    }

    // show Next Page
    const showNextPage = () => {
      if(pageNum >= pdfDoc.numPages){
        return;
      }
      pageNum++;
      queueRenderPage(pageNum);
    }

    // Get Document
    pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
      pdfDoc = pdfDoc_;


      document.querySelector('#page_count').textContent = pdfDoc.numPages;

      renderPage(pageNum);
    })

    // for displaying error when there is no file to render
    .catch(err => {
      // display error
      const div = document.createElement('div');
      div.className = 'error';
      div.appendChild(document.createTextNode(err.message));
      document.querySelector('body').insertBefore(div, canvas);

      // remove top bar
      document.querySelector('.top_bar').style.display = 'none';
    });

    // button events
    document.querySelector('#prev_page').addEventListener('click',showPrevPage);
    document.querySelector('#next_page').addEventListener('click',showNextPage);

    $("#pdfReaderModal").modal("show");
  });

}); 
</script>