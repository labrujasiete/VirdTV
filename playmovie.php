<?php
include "database/functions.php";
$db = new base_class;
?>
<?php
$id = $db->security($_GET['id']);
$db->Normal_Query("SELECT * FROM movies WHERE uid = ?", [$id]);
$res = $db->Single_Result();

	$movie_id = $res->uid;
	$title = $res->title;
	$cover = $res->cover;
	$year = $res->year;
	$langs = $res->langs;
	$category = $res->category;
	$rating = $res->rating;
	$description = $res->description;
	$file_name = $res->file;

	$director = $res->director;
	$castRes = $res->cast;
	$castArray = json_decode($castRes);

	$cast = "";

	if($castArray != ""){
		for($i = 0; count($castArray) > $i; $i++){
			$cast .= $castArray[$i].", ";
		}
	}

	
	
	

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" type="image/png" href="assets/icons/favicon_vird.png"/>
<title><?php echo ucfirst($title);?></title>
<link rel="stylesheet" type="text/css" href="playmovie.css">
<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
<script src="assets/js/jQuery_3.4.1.js"></script>
<script>
	$(document).ready(function(){

		/*Side MENU Switch*/
		$("#sm_switch").click(function(){

			var sm_sts = $("#side_menu").css("left");

			if(sm_sts == "0px"){
				$("#side_menu").css('left', function(){ return $(this).offset().left; }).animate({"left":"-315px"}, "fast");
			}else if(sm_sts == "-315px"){
				$("#side_menu").css('left', function(){ return $(this).offset().left; }).animate({"left":"0px"}, "fast");
			} 
		});
	});
</script>
</head>

<body>

	<!--side_menu-->
	<div class="side_menu" id="side_menu">
		<div class="sm_switch" id="sm_switch"><img src="assets/icons/list.png" class="sm_icon"></div>

		<div class="sm_spacer"></div>
		<a href="index.php" class="a_sm">Peliculas</a>
		<a href="series.php" class="a_sm">Series</a>
		<a href="#" class="a_sm">Request a Movie</a>
	</div>

	<div class="player">

		<img src="assets/covers/<?php echo $cover;?>" alt="" class="movie_cover">

		<video-js
			id="my-video"
			class="video-js"
			controls
				width="800"
				height="450"
			preload="auto"
			poster="MY_VIDEO_POSTER.jpg"
			data-setup="{}"
			>
			<source src="peliculas/<?php echo $file_name;?>" type="video/mp4" />
			<p class="vjs-no-js">
				To view this video please enable JavaScript, and consider upgrading to a
				web browser that
				<a href="https://videojs.com/html5-video-support/" target="_blank"
				>supports HTML5 video</a
				>
			</p>
		</video-js>

	</div>
	
	<div class="top_info">
		<p class="movie_title"><?php echo ucfirst($title)." (".$year.")"; ?></p>
		<div class="extra_info_div">
			<p class="extra_info">Category: <?php echo ucfirst($category);?></p>
			<img class="star" src="assets/icons/star.svg">
			<p class="raiting"><?php echo $rating;?></p>
		</div>
	</div>
	
	<div class="cast_div">
		<br>
		<p class="cast_p"><scpan class="cast_title">DIRECTOR: </scpan><?php echo ucwords($director);?></p>
		<br>
		<p class="cast_p"><span class="cast_title">CAST: </span><?php echo $cast;?></p>
		<br>
		<p class="cast_p"><span class="cast_title">SYNOPSIS: </span><?php echo $description;?></p>
	</div>
	
	
	
	
<script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
<script>

	var player = videojs('my-video');

</script>
<div class="footer"></div>
</body>
</html>













