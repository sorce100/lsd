<!-- modal for reading pdfs -->
<div class="modal fade" id="pdfReaderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close readerClose" aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
      </div>
      <div class="modal-body" id="bg" style="margin-top: 0;padding: 0;">
        <div class="top_bar" >
          <button class="btn btnReader" id="prev_page">
            <i class="fa fa-arrow-circle-left"> </i>Prev Page
          </button>
          <!-- page number here -->
            <span class="page-info">
              Page <span id="page_num"> </span> of <span id="page_count"> </span>
            </span>
          <button class="btn btnReader" id="next_page">
              Next Page <i class="fa fa-arrow-circle-right"></i>
            </button>
        </div>
        <canvas id="pdf_render"></canvas>
        <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  // click to read file
  $('body').on('click','.readFile',function(){
    let folderName = $(this).attr('name');
    let fileName = $(this).attr('id');
        DEFAULT_VIEW_HISTORY_CACHE_SIZE = 9000;
        localStorage.clear();

    const url = './../uploads/library/'+folderName+'/'+fileName;
    let pdfDoc = null,
        pageNum =1,
        pageIsRendering = false,
        pageNumIsPending = null;

    const scale = 1.5,
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
        canvas.width = canvas.width;

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
</script>