<?php 
include("header.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h3 class="box-title">DIVISION LIVE STREAMING VIDEO</h3>
        <div >
            <div class="row">
              	<?php
require_once('EmbedYoutubeLiveStreaming.php');

$channelId = "UCPEwhErPHxWUZ-35mHLl2Jg";
$api_key = "AIzaSyAjr7gFLyovmmS4rpE9R_IZ4GAOlRDknfU";

$YouTubeLive = new EmbedYoutubeLiveStreaming($channelId,$api_key);

if(!$YouTubeLive->isLive)
{
	echo "<b>Sorry There is no live streaming right now! Reload page</b><br><br><a href='videoStream_dashboard.php' class='btn btn-danger glyphicon glyphicon-arrow-left'> GO TO DASHBOARD</a><br><br>";
}
else
{
	echo <<<EOT

<b>Title is:</b> {$YouTubeLive->live_video_title}<br>
<br>

<b>Published at:</b> {$YouTubeLive->live_video_published_at}<br><br>

EOT;

	$YouTubeLive->setEmbedSizeByWidth(600);
	$YouTubeLive->setEmbedSizeByHeight(600);
	$YouTubeLive->embed_autoplay = true;

	echo $YouTubeLive->embedCode();
}
?>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<?php include("footer.php");?>


