<?php 
include("header.php");
include("Classes/Events.php");
?>
<br>
<div class="row">
    <!-- <div class="col-sm-12"> -->
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- for search -->
            <div class="col-lg-4 col-md-4 " style="border:1px solid black;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 col-md-9 text-right">
                                <div class="huge">
                                    <?php require_once("Classes/Members.php");
                                          $objMembers = new Members();
                                          echo '<a href="members_list.php">'.$objMembers->members_count().'</a>';
                                     ?>
                                </div>
                                <div><h3><b><a href="members_list.php">TOTAL MEMBERS</a></b></h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4" style="border:1px solid black;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-newspaper-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php require_once("Classes/News.php");
                                          $objNews = new News;
                                          echo '<a href="news.php">'.$objNews->news_count().'</a>';
                                     ?>
                                </div>
                                <div><h3><b><a href="news.php">TOTAL NEWS</a></b></h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4" style="border:1px solid black;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-video-camera fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php require_once("Classes/LiveStream.php");
                                          $objLiveStream = new LiveStream;
                                          echo '<a href="videoStream_dashboard.php">'.$objLiveStream->month_liveStream_count().'</a>';
                                     ?>
                                </div>
                                <div><h3><b><a href="videoStream_dashboard.php">LIVE STREAMS </a></b></h3></div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- end of content -->
        </div>
    </div>
</div>
<!--  -->
<!-- FOR news and upcoming events summary -->
<div class="row">
  <!-- first cold -->
  <div class="col-md-7">
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">NEWS SUMMARY</div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
          <!-- content -->
          <div class="col-md-12">
              <?php require_once("Classes/News.php");
                  $objNews = new News;
                  $allNews = $objNews->get_news_limit_5();

                  foreach ($allNews as $news) {
                        $newsId=trim($news['news_id']);
                        $newsTitle=trim($news['news_title']);
                        $newsCategory=trim($news['news_category']);
                        $dateDone=trim($news['date_done']);

                       echo ' <h3><b><a href="news.php" id="'.$newsId.'">'. $newsTitle .'</a></b></h3>
                        <span class="label label-danger newscategory pull-right">'.$newsCategory.'</span>

                        <div>'.$objNews->string_shorten($newsTitle, 180).'<a href="news.php" class="btn-info" id="'.$newsId.'"><b> Read More >>></b></a></div><hr/>';
                  }
             ?>
          </div>
          <!-- end of content -->
        </div>
    </div>
  </div>
  <!-- second col -->
  <div class="col-md-5">
    <div class="panel panel-default">
        <div class="panel-heading">
             <div class="panel-title pull-left">UPCOMING EVENTS </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
          <!-- content -->
          <div class="col-md-12">
            <?php
                $objEvents = new Events;
                $events = $objEvents->get_events_limit5(); 
                foreach ($events as $event) {
                        echo "<div class='well'><a href='event_register.php'><b>".$event["events_theme"]."</b></a></div>";
                    }
            ?>
          </div>
          <!-- end of content -->
        </div>
    </div>
  </div>
</div>


<!-- /.ROW-->
<?php include("footer.php");?>