<?php
include "database/functions.php";
$db = new base_class;
?>
<?php
$series = "";
$db->Normal_Query("SELECT * FROM series ORDER BY timestamp DESC");
$row = $db->fetch_all();
foreach($row as $res):


	$serie_id = $res->uid;
	$title = $res->serie_title;
	$cover = $res->cover;
	$year = $res->year;
	$langs = $res->langs;
	$category = $res->category;
	$rating = $res->rating;

	$series .= '
		<div class="movie_container_div">
			<a class="movie_container_a" id="'.$serie_id.'" href="playserie.php?id='.$serie_id.'&s=1&c=1">
				<div class="categorie_tag"><div class="half_sqr"></div>'.ucfirst($category).'</div>
				<div class="star_div"><img class="star_img" src="assets/icons/star.svg"><p class="raiting_p">'.$rating.'</p></div>
				<div class="movie_cover" style="background-image: url(assets/series_covers/'.$cover.')"></div>
				<p class="small_info">('.$year.') '.strtoupper($langs).'</p>
				<p class="title">'.ucwords($title).'</p>
			</a>
		</div>
	';

endforeach;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" type="image/png" href="assets/icons/favicon_vird.png"/>
<title>Vird</title>
<link rel="stylesheet" type="text/css" href="series.css">
<script src="assets/js/jQuery_3.4.1.js"></script>
<script>
	$(document).ready(function(){
		
		$(".movie_container_div").hover(function(){
			$(this).find(".movie_cover").addClass("hover");
		},function(){
			$(this).find(".movie_cover").removeClass("hover");
		});

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
<script>
    /*  SEARCH BAR for MOVIES*/
	function search_movies(value){
        /*
		$.post("search_movies_ajax.php", {query:value}, function(data){
			$(".wrapper").html(data);
		});
        */
	}
</script>
</head>

<body>
	<!--side_menu-->
	<div class="side_menu" id="side_menu">
		<div class="sm_switch" id="sm_switch"><img src="assets/icons/list.png" class="sm_icon"></div>

		<div class="sm_spacer"></div>
		<a href="index.php" class="a_sm">Peliculas</a>
		<a href="series.php" class="a_sm a_sm_selected">Series</a>
		<a href="#" class="a_sm">Request a Movie</a>
	</div>
	
	<!--SLIDESHOW BANNER-->
	<div class="slideshow-container">
	
		<a href="playmovie.php?id=16179a81380287">
			<div class="mySlides fade" style="background-image: url(assets/banners/banner_01.gif);">
				<div class="numbertext">1 / 8</div>
				
				<div class="bottom_things">
					<div class="text">
					Venom (2018)
					</div>
					<div class="powered_by_div">
						<p>Powered by</p>
						<img class="bruja_icon" src="assets/icons/labruja_logo_shadowed.png" alt="la_bruja_designs">
				</div>
				</div>
			</div>
		</a>

		<a href="playmovie.php?id=160064647f1a54">
			<div class="mySlides fade" style="background-image: url(assets/banners/banner_02.jpg);">
			<div class="numbertext">2 / 8</div>
				
				<div class="bottom_things">
			<div class="text">Rogue One (2016)</div>
				<div class="powered_by_div">
						<p>Powered by</p>
						<img class="bruja_icon" src="assets/icons/labruja_logo_shadowed.png" alt="la_bruja_designs">
				</div>
				</div>
			</div>
		</a>
			
		<a href="playmovie.php?id=1600392b625f21">
			<div class="mySlides fade" style="background-image: url(assets/banners/banner_03.jpg);">
			<div class="numbertext">3 / 8</div>
				
				<div class="bottom_things">
			<div class="text">Dunkirk (2017)</div>
				<div class="powered_by_div">
						<p>Powered by</p>
						<img class="bruja_icon" src="assets/icons/labruja_logo_shadowed.png" alt="la_bruja_designs">
				</div>
				</div>
			</div>
		</a>
			
		<a href="playmovie.php?id=16008e53417333">
			<div class="mySlides fade" style="background-image: url(assets/banners/banner_04.jpg);">
			<div class="numbertext">4 / 8</div>
				<div class="bottom_things">
			<div class="text">El hobbit un viaje inesperado (2012)</div>
				<div class="powered_by_div">
						<p>Powered by</p>
						<img class="bruja_icon" src="assets/icons/labruja_logo_shadowed.png" alt="la_bruja_designs">
				</div>
			</div>
			</div>
		</a>
		
		<a href="playmovie.php?id=16008e5e48474f">
			<div class="mySlides fade" style="background-image: url(assets/banners/banner_05.jpg);">
			<div class="numbertext">5 / 8</div>
				<div class="bottom_things">
			<div class="text">Marte Misión rescate (2015)</div>
				<div class="powered_by_div">
						<p>Powered by</p>
						<img class="bruja_icon" src="assets/icons/labruja_logo_shadowed.png" alt="la_bruja_designs">
				</div>
			</div>
			</div>
		</a>
			
		<a href="playmovie.php?id=160051d65386f0">
			<div class="mySlides fade" style="background-image: url(assets/banners/banner_06.jpg);">
			<div class="numbertext">6 / 8</div>
				<div class="bottom_things">
			<div class="text">Jojo rabbit (2019)</div>
				<div class="powered_by_div">
						<p>Powered by</p>
						<img class="bruja_icon" src="assets/icons/labruja_logo_shadowed.png" alt="la_bruja_designs">
				</div>
			</div>
			</div>
		</a>
		
		<a href="playmovie.php?id=16005114187888">
			<div class="mySlides fade" style="background-image: url(assets/banners/banner_07.jpg);">
			<div class="numbertext">7 / 8</div>
				<div class="bottom_things">
			<div class="text">Guns Akimbo (2019)</div>
				<div class="powered_by_div">
						<p>Powered by</p>
						<img class="bruja_icon" src="assets/icons/labruja_logo_shadowed.png" alt="la_bruja_designs">
				</div>
			</div>
			</div>
		</a>
			
		<a href="playmovie.php?id=160038bec75204">
			<div class="mySlides fade" style="background-image: url(assets/banners/banner_08.jpg);">
			<div class="numbertext">8 / 8</div>
				<div class="bottom_things">
			<div class="text">Borat Subsequent Moviefilm (2020)</div>
				<div class="powered_by_div">
						<p>Powered by</p>
						<img class="bruja_icon" src="assets/icons/labruja_logo_shadowed.png" alt="la_bruja_designs">
				</div>
			</div>
			</div>
		</a>
	</div>

	<br>

	<div style="text-align:center">
	  <span class="dot" onclick="currentSlide('0')"></span> 
	  <span class="dot" onclick="currentSlide('1')"></span> 
	  <span class="dot" onclick="currentSlide('2')"></span> 
	  <span class="dot" onclick="currentSlide('3')"></span> 
	  <span class="dot" onclick="currentSlide('4')"></span> 
	  <span class="dot" onclick="currentSlide('5')"></span> 
	  <span class="dot" onclick="currentSlide('6')"></span> 
	  <span class="dot" onclick="currentSlide('7')"></span> 
	</div>
	
	<script>
		var slideIndex = 0;
		showSlides(slideIndex);
		
		function currentSlide(n) {
		  	slideIndex = n
			showSlides();
		}
		
		function callAgain(){
			setTimeout(showSlides, 7000);
		}

		function showSlides() {
		  var i;
		  var slides = document.getElementsByClassName("mySlides");
		  var dots = document.getElementsByClassName("dot");
		  for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";  
		  }
		  slideIndex++;
		  if (slideIndex > slides.length) {slideIndex = 1}    
		  for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		  }
		  slides[slideIndex-1].style.display = "block";  
		  dots[slideIndex-1].className += " active";
		  //setTimeout(showSlides, 7000); // Change image every 2 seconds
		  callAgain();
		}
	</script>

	<script>

		document.addEventListener('DOMContentLoaded', () => {
			readLocal();
		});

		
		function readLocal(){
			let local_read = JSON.parse(localStorage.getItem('watching'));
			let sendURL = `playserie.php?id=${local_read[0]}&s=${local_read[1]}&c=${local_read[2]}`;
			let linkToChange = document.getElementById(local_read[0]);
			linkToChange.href = sendURL;
		}

	</script>
	
	<div class="topbar">
		<div class="keep_together">
			<img src="assets/icons/vird.png" class="vird_icon">
			<p class="top_title">VIRD</p>
			<p class="top_title_series">SERIES</p>
		</div>
		<input type='text' onkeyup='search_movies(this.value)' name='q' placeholder='Busca una peli' autocomplete='off' id='search_text_input'>
	</div>
	
	
	
	<div class="wrapper" id="wrapper">
		<?php
			echo $series;
		?>
		

	</div>
</body>
</html>