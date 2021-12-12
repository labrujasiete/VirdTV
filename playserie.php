<?php
include "database/functions.php";
$db = new base_class;
?>
<?php
$id = $db->security($_GET['id']);
$db->Normal_Query("SELECT * FROM series WHERE uid = ?", [$id]);
$res = $db->Single_Result();

    $current_s = $db->security($_GET['s']);
    $current_c = $db->security($_GET['c']);

	$movie_id = $res->uid;
	$title = $res->serie_title;
	$folder = strval($res->folder);

    $seasons = $res->seasons;

	$cover = $res->cover;
	$year = $res->year;
	$langs = $res->langs;
	$category = $res->category;
	$rating = $res->rating;
	$description = $res->description;
	//$file_name = $res->file;

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
<link rel="stylesheet" type="text/css" href="playserie.css">
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

    //seasons & chapters variables from GET
    let season_obj = <?php echo $seasons;?>; 
    let current_s = <?php echo $current_s;?>; 
    let current_c = <?php echo $current_c;?>;

</script>
</head>

<body>

	<!--UID Hidden Input-->
    <input type="hidden" id="hidden_uid" value="<?php echo $movie_id;?>">
    <input type="hidden" id="hidden_folder" value="<?php echo $folder;?>">
	<!--side_menu-->
	<div class="side_menu" id="side_menu">
		<div class="sm_switch" id="sm_switch"><img src="assets/icons/list.png" class="sm_icon"></div>

		<div class="sm_spacer"></div>
		<a href="index.php" class="a_sm">Peliculas</a>
		<a href="series.php" class="a_sm">Series</a>
		<a href="#" class="a_sm">Request a Movie</a>
	</div>

	<div class="player">

		<img src="" alt="" class="movie_cover" id="movie_cover">

		<video-js
			id="my-video"
			class="video-js"
			controls
			width="800"
			height="400"
            autoplay
			preload="auto"
			data-setup="{}"
			>
			<source src="series/" type="video/mp4" id="vdo_file_src" /><!--MOVIE FILE GOES HERE-->
			<p class="vjs-no-js">
				To view this video please enable JavaScript, and consider upgrading to a
				web browser that
				<a href="https://videojs.com/html5-video-support/" target="_blank"
				>supports HTML5 video</a
				>
			</p>
		</video-js>
        

	</div>
	
    <div class="bottom_wrapper">
        <div class="bottom_left">
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
        </div>
        
        <div class="bottom_right">
            <div class="seasons_list_wrap" id="seasons_list_wrap">
                
                <div class="ui-controls">
                    <a href="#" class="l-arrow"><<&nbsp;&nbsp;&nbsp;Anterior</a>
                    <div class="spacer-controls"></div>
                    <a href="#" class="r-arrow">Siguiente&nbsp;&nbsp;&nbsp;>></a>
                </div>



                <!--div class="each_season">
                    <div class="season_title">Season 1</div>
                    <div class="season_list_wrap close">
                        <a class="season_list">capitulo 1</a>
                        <div class="season_list">capitulo 2</div>
                        <div class="season_list">capitulo 3</div>
                        <div class="season_list">capitulo 4</div>
                        <div class="season_list">capitulo 5</div>
                    </div>
                </div-->
            </div>
        </div>
	</div>
	
<script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>

<script>

    let player;

    

    //Assign video file to Player
    
    let dir_folder = document.querySelector('#hidden_folder').value;
    let vdo_src = document.querySelector('#vdo_file_src');
    vdo_src.src = `series/${dir_folder}/`+season_obj[current_s-1].c_filename[current_c-1];//<-----------------------------
    console.log(vdo_src.src);
    



    //abrir y cerrar tempradas y capitulos
    const seasons_wrap = document.getElementById('seasons_list_wrap');
    
    
    seasons_wrap.addEventListener('click', e => {

        let clicked = e.target.parentElement;
        if(clicked.classList.contains('each_season')){
            
            var wrap_div = clicked.querySelector('.season_list_wrap');
            
            if(wrap_div.classList.contains('close')){
                wrap_div.classList.remove('close');
                wrap_div.classList.add('open');
            }else if(wrap_div.classList.contains('open')){
                wrap_div.classList.remove('open');
                wrap_div.classList.add('close');
            }
        }
    });

    createSeasons();
    function createSeasons(){


        let seasons_wrap = document.querySelector('#seasons_list_wrap');
        let hidden_uid = document.querySelector('#hidden_uid').value;
        setCChapterLocal(hidden_uid);
        

        season_obj.forEach( (season, s_index) => {


            let each_season_div = document.createElement('div');
            each_season_div.classList.add('each_season');

            let season_title_div = document.createElement('div');
            season_title_div.classList.add('season_title');
            season_title_div.textContent = `${s_index+1} - ${season.s_title}`;

            let season_list_wrap_div = document.createElement('div');
            season_list_wrap_div.classList.add('season_list_wrap');
            season_list_wrap_div.classList.add('close');


            seasons_wrap.appendChild(each_season_div);
            each_season_div.appendChild(season_title_div);
            each_season_div.appendChild(season_list_wrap_div);

            let chapter = season.c_title;

            chapter.forEach((cap, c_index) => {
                let chapter_link = document.createElement('a');
                chapter_link.classList.add('season_list');
                chapter_link.classList.add(`s${s_index+1}c${c_index+1}`);
                chapter_link.textContent = `${c_index+1} - ${cap}`;
                chapter_link.href = `playserie.php?id=${hidden_uid}&s=${s_index+1}&c=${c_index+1}`;

                season_list_wrap_div.appendChild(chapter_link);
            });
        });

        setLinksSrc(hidden_uid);

    }


    highlightCurrentChapter();
    function highlightCurrentChapter(){
        let current_link = document.querySelector(`.s${current_s}c${current_c}`);
        current_link.classList.add('selected');
        let selected_link = current_link.parentElement.parentElement.querySelector('.season_list_wrap');
        selected_link.classList.remove('close');
        selected_link.classList.add('open');
    }

    function setLinksSrc(h_uid){
        let left_arrow = document.querySelector('.l-arrow');
        let right_arrow = document.querySelector('.r-arrow');

        let max_chapters = season_obj[current_s-1].c_filename.length

        left_arrow.href = `playserie.php?id=${h_uid}&s=${current_s}&c=${current_c-1}`;
        left_arrow.classList.remove('no_action');
        right_arrow.href = `playserie.php?id=${h_uid}&s=${current_s}&c=${current_c+1}`;
        right_arrow.classList.remove('no_action');

        if(current_c <= 1){
            left_arrow.removeAttribute('href');
            left_arrow.classList.add('no_action');
        }
        if(current_c >= max_chapters){
            right_arrow.removeAttribute('href');
            right_arrow.classList.add('no_action');
        }

        //  Tell player to play next chapter
        player = videojs('my-video');
        player.on('ended', function() {
            window.location.href = `playserie.php?id=${h_uid}&s=${current_s}&c=${current_c+1}`;
        });
        

        //`series/${dir_folder}/`+season_obj[current_s-1].c_filename[current_c-1];
        

    }
    
    function setCChapterLocal(h_uid){
        let current_url = [h_uid, current_s, current_c];
        localStorage.setItem('watching', JSON.stringify(current_url));
    }

    setSeasonImage();
    function setSeasonImage(){
        let imf_file = season_obj[current_s-1].s_img_file;
        document.querySelector("#movie_cover").src = `assets/series_covers/${imf_file}`;
    };

    
</script>
<div class="footer"></div>
</body>
</html>













