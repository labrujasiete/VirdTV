<?php
include "database/functions.php";
$db = new base_class;
?>
<?php

if(isset($_POST['submit'])){

	$title = $db->security($_POST['serie_title']);
	$folder = $db->security($_POST['folder']);

	//SPECIAL SERIES INFO (incoming from scripts)
	$seasons_array = $_POST['seasons_array'];

	$year = $db->security($_POST['year']);
	$raiting = $db->security($_POST['raiting']);
	$director = $db->security($_POST['director']);
	$lang = $db->security($_POST['lang']);
	$cat = $db->security($_POST['cat']);
	$cover = $db->security($_POST['cover']);
	$cast_values = $db->security($_POST['cast_values']);
	$info = $db->security($_POST['info']);
	$movie_id = uniqid(true);
	
	//echo $title.$file.$year.$raiting.$director.$lang.$cat.$cover.$cast_values.$info;
	
	$db->Normal_Query("INSERT INTO series (uid, serie_title, folder, seasons, year, rating, description, director, cast, langs, category, cover) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", [$movie_id, $title, $folder, $seasons_array, $year, $raiting, $info, $director, $cast_values, $lang, $cat, $cover]);
	$_SESSION['response'] = "submitted";
	header('location: /submit_serie.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit</title>
<link rel="stylesheet" type="text/css" href="submit_serie.css">
<script src="assets/js/jQuery_3.4.1.js"></script>

<script>
	
	var castArray = [];
	let ch_title_Array = [];
	let ch_filename_Array = [];
	let seasons_array = [];

	
	
	$(document).ready(function(){

		
        /* agregar cast */
		$("#plus").click(function(){
			var cast = $("#cast_inp").val();
			if(cast != ""){
				castArray.push(cast);
				$("#cast_values").val(JSON.stringify(castArray));/*<-----HIDDEN INPUT*/
				$("#result").html(JSON.stringify(castArray));
			}
			$("#cast_inp").val("");
			$("#cast_inp").focus();
		});
		
		$("#screen").click(function(){
			$("#screen").fadeOut("fast");
		});
		
		$("#btn_ok").click(function(){
			$("#screen").fadeOut("fast");
		});


		
		
        /* Agregar CAPITULO */
		$("#add_chap_btn").click(function(){
			
			let arrCount = 1;
			
            
			$('.draw_line').show();
            $(".fold").show();

			let ch_filename = $("#chapter_inp").val();
			let ch_title = $("#chapter_title").val();

			if(ch_filename != ""){
				if(ch_title != ""){

					ch_filename_Array.push(ch_filename);
					ch_title_Array.push(ch_title);
					
					//$("#chapters_title_array").val(JSON.stringify(ch_title_Array));
					//$("#chapters_filename_array").val(JSON.stringify(ch_filename_Array));
					$("#results_chapters").html("");
					ch_title_Array.forEach(function(movie_file_name) {
						$("#results_chapters").append("<div class='file_name_container'>"+arrCount+"- "+JSON.stringify(movie_file_name)+"</div>");
						arrCount++;
					});
					
					//$("#results_chapters").html(JSON.stringify(chaptersArray));
				}
			}
			$("#chapter_inp").val("");
			$("#chapter_title").val("");
			$("#chapter_title").focus();
		});




		/* FOLD */
		$("#fold").click(function(){

			var fold_status = $("#results_chapters").css("width");

			if(fold_status == "300px"){
				$("#results_chapters").animate({width:'0px'});
				$("#fold").animate({left:'540px'});
			}else if(fold_status == "0px"){
				$("#fold").animate({left:'843px'}, function(){
					$("#results_chapters").animate({width:'300px'});
				});
			}
		});
	});

	
	
	/* Season Button */
	function add_season(){

		var season_title = $("#season_title_inp").val();
		var season_img_file = $("#season_img_file").val();
		var season_count = 01;
		
		if(season_title != "" && season_img_file != ""){

			const season_obj = {
			s_title : '',
			s_img_file : "",
			c_title : [],
			c_filename : []
			};

			//asignar los inputs al objeto global "serie"
			season_obj.s_title = season_title;
			season_obj.s_img_file = season_img_file;
			season_obj.c_title = ch_title_Array;
			season_obj.c_filename = ch_filename_Array;

			seasons_array = [ ...seasons_array, season_obj ];

			$('#seasons_array').val(JSON.stringify(seasons_array));
			
			//season_obj.s_title = '';
			//season_obj.c_title = [];
			//season_obj.c_filename = [];

			//$("#seasons_array").val(JSON.stringify(season_obj));
			$("#season_list_wrap").html("");

			//$("#test_div").append(season_obj);
			
			seasons_array.forEach( function(attrib) {
				$("#season_list_wrap").append('<div class="each_season">'+season_count+'-'+attrib.s_title+' / '+attrib.c_filename.length+' Chapters</div>');
				season_count++;
			});

			
			//cleaning
			$("#season_title_inp").val("");
			$('.draw_line').hide();
			$(".fold").hide();
			$("#results_chapters").html("");
			$("#season_img_file").val("");
			
			ch_title_Array = [];
			ch_filename_Array = [];

			console.log(seasons_array);
		}
	}
</script>
</head>

<body>
	<div id="test_div"></div>
	<div class="topbar">
		<img src="assets/icons/vird.png" class="vird_icon">
		<p class="top_title">VIRD</p><p class="subtitle">Submit a Serie to DataBase (admin only)</p>
	</div>
	
	<div class="wrapper">
        <!--  FORM  -->
		<form action="" method="post" class="theform">
			<input type="text" name="serie_title" placeholder="Serie Title" class="s_inp" required>
			<input type="text" name="folder" placeholder="Containing Folder" class="s_inp" required>

            

			<!-- CREATE SEASON -->
			<div id="dinamic_wrapper_season">

				<p class="season_title">Create each season by Order</p>
				<input type="text" name="season_title" placeholder="Season Title" class="season_title_inp" id="season_title_inp">
				<input type="text" name="season_img" placeholder="Season Image File" class="season_title_inp" id="season_img_file">
				<div class="wrap_chap_inp">
					
					<input type="text" name="chapter_title" placeholder="Chapter title" class="chapter_title_inp" id="chapter_title">
					<input type="text" name="chapter_filename" placeholder="Chapter file name" class="chapter_inp" id="chapter_inp">
					<div class="add_chap_btn" id="add_chap_btn">+</div>
					
					
					
					
					<div class="ui_chapters_wrap">
					<div class="draw_line"></div>
					<div class="results_chapters" id="results_chapters"></div>
					<img src="assets/icons/origami.png" class="fold" id="fold"></div>
					

					
				</div>
				<!--  ADD SEASONS AND CHAPTERS  -->
				<div class="add_season" id="add_season" onclick="add_season()">Create this season</div>
			</div>

			<!-- SEASON LIST -->
			<div class="season_list_wrap" id="season_list_wrap">
				

			</div>


			<input type="text" name="year" placeholder="Year" class="s_inp" required>
			<input type="text" name="raiting" placeholder="Raiting" class="s_inp" required>
			<input type="text" name="director" placeholder="Director" class="s_inp" required>
			<input type="text" name="lang" placeholder="Language Ex. esp-eng" class="s_inp" required>
			<input type="text" name="cat" placeholder="Category" class="s_inp" required>
			<input type="text" name="cover" placeholder="Cover.png" class="s_inp" required>
			<div class="cast_div">
				<input type="text" placeholder="Cast" class="inp_cast s_inp" id="cast_inp">
				<span id="plus">+</span>
				<input type="hidden" name="cast_values" value="" id="cast_values">
			</div>
			<div id="result"></div>
			<textarea placeholder="Movie Description..." name="info" class="text_inp" required></textarea>
			<input type="hidden" name="seasons_array" id="seasons_array" value="">
			<input type="submit" name="submit" class="submit_btn" value="SUBMIT SERIE">
		</form>
	</div>
	
	<?php
		
		$display = "";
	
		
		
		if(isset($_SESSION['response']) && $_SESSION['response'] == "submitted"){
			$display = "Movie Submitted successfully";
			echo '
				<div class="screen" id="screen">
					<div class="message">
					'.$display.'
					<div class="btn_ok" id="btn_ok">Ok</div>
					</div>
				</div>
			';
			$_SESSION['response'] = "";
		}else if(isset($_SESSION['response']) && $_SESSION['response'] == "error_file_exist"){
			$display =  "File already exist";
			echo '
				<div class="screen" id="screen">
					<div class="message">
					'.$display.'
					<div class="btn_ok" id="btn_ok">Ok</div>
					</div>
				</div>
			';
		}

		
		
		if(isset($_SESSION['response'])){
			$_SESSION['response'] = "";
			session_unset();
		}
		
		
	
		
	?>
	
	
</body>
</html>

