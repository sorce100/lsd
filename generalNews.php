<?php 
      require_once("pages/Classes/News.php");
      require_once("header.php");
?>
<br>
<div class="row">
  <div class="col-md-7">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title pull-left">GENERAL NEWS</div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <!-- content -->
            <?php 
              $objNews = new News;
              $allNews = $objNews->get_news_limit();

              foreach ($allNews as $news) {
                    $newsId=trim($news['news_id']);
                    $newsTitle=trim($news['news_title']);
                    $newsCategory=trim($news['news_category']);
                    $dateDone=trim($news['date_done']);
                    echo '<div class="row well">
                          <div class="col-md-2"><img src="plugins/images/news-icon.jpg" height="90" width="120" class="img img-circle"></div>';
                      

                   echo ' <div class="col-md-10"> <h3><b>'. $newsTitle .'</b></h3>
                          <span>'.$dateDone.'</span><br/>
                          <span class="label label-danger newscategory pull-right">'.$newsCategory.'</span><br/>

                    <div><button id="'.$newsId.'" class="btn btn-info btn-sm news_view">Read More </button></div><br />
                     </div></div><br />';
                }
             ?>
            <!-- end of content -->
        </div>
      </div>
  </div>
  <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">ADVERTISEMENT</div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <!-- content -->

            <!-- end of content -->
        </div>
    </div>
  </div>
</div>

<!-- /.row -->
<!-- displaying news items -->
 <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" id="bg">
         <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" style="color: red;font-size: 25px;" class="btn-default">&times; CLOSE</span></button>
        <h4 class="modal-title"><b id="subject">NEWS DETAILS</b></h4>
      </div>
      <div class="modal-body" >
        <div id="newsPic_carousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators"></ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner"></div>
        <!-- Controls -->
        <a class="left carousel-control" href="#newsPic_carousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#newsPic_carousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div><hr><br>
       <div><h2><b id="news_title"></b></h2></div><hr><br>
       <div id="news_content"></div>
      </div>
       <div class="well modal-footer" id="bg">
        <button data-dismiss="modal"  aria-label="Close"  class="btn btn-danger btn-block">CLOSE </button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php include("footer.php");?>

 <script>  
      $(document).ready(function(){
      
        // for reset modal when close
        $('#viewModal').on('hidden.bs.modal', function () {
            $("#subject").html("NEWS DETAILS");
            window.location.replace("generalNews.php");
          });

         // for search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#resultsDisplay tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

        // for news modal open
        $('.news_view').click(function(){
            var mode = "updateModal";
            var data_id = $(this).attr("id");
            // $('.modal-body').empty();
            $.ajax({  
                url:"pages/Script/news.php",  
                method:"POST",  
                data:{mode:mode,data_id:data_id},  
                success:function(data){

                    var jsonObj = JSON.parse(data);
                    var picsArray = JSON.parse(jsonObj[0].file_name);

                    // looping through the pictures array to display the pictures
                    for (var i = 0; i < picsArray.length; ++i) {
                        $('<div class="item well"><img src="uploads/news/'+jsonObj[0].folder_name+'/'+picsArray[i]+'" style="width:100%;height:500px;"><div class="carousel-caption"></div></div>').appendTo('.carousel-inner');
                        $('<li data-target="#newsPic_carousel" data-slide-to="'+i+'"></li>').appendTo('.carousel-indicators')
                    }
                   $('.item').first().addClass('active');
                   $('.carousel-indicators > li').first().addClass('active');
                   $('#newsPic_carousel').carousel();
                   
                   $("#news_title").html(jsonObj[0].news_title);
                   $("#news_content").html(jsonObj[0].news_content);
                   $('#viewModal').modal("show");
                }  
            });
        });
      
  });  
 </script>
