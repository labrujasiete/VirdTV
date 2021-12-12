<?php
include "database/functions.php";
$db = new base_class;
?>
<?php

if(isset($_POST['submit'])){
	$title = $db->security($_POST['title']);
	$file = $db->security($_POST['file']);
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
	
	$db->Normal_Query("SELECT file FROM movies WHERE file = ?", [$file]);
	if($db->count_rows() == 0){
		$db->Normal_Query("INSERT INTO movies (uid, title, file, year, rating, description, director, cast, langs, category, cover) VALUES (?,?,?,?,?,?,?,?,?,?,?)", [$movie_id, $title, $file, $year, $raiting, $info, $director, $cast_values, $lang, $cat, $cover]);
		$_SESSION['response'] = "submitted";
	}else{
		$_SESSION['response'] = "error_file_exist";
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit</title>
<style>
	
	@font-face{
		font-family: 'monoton';
		src: url("assets/fonts/Monoton-Regular.ttf");
	}
	
	@font-face{
		font-family: 'roboto_li';
		src: url("assets/fonts/roboto/Roboto-Light.ttf");
	}
	
	body{
		margin: 0;
		height: 100vh;
		background-size: cover;
		background-image: linear-gradient(rgba(0,34,60,1) 0%, rgba(0,16,35,1) 100%);
		background-image: url("assets/bg_gradient.jpg");
		background-repeat: no-repeat;
		background-attachment: fixed;
	}
	
	input:focus{
		outline: none;
	}
	
	.topbar{
		color: white;
		display: flex;
		align-items: center;
	}
	
	.top_title{
		font-family: 'monoton';
		color: #ffffffbd;
		font-size: 5rem;
		font-weight: 100;
		margin: 0;
		text-shadow: -4px 4px 2px rgb(0 0 0 / 40%);
	}
	
	.vird_icon{
		height: 85px;
		margin-left: 10px;
	}
	
	.subtitle{
		margin: 0;
		margin-top: 17px;
		font-family: 'roboto_li';
		font-size: 1.3rem;
		margin-left: 15px;
		color: #e8bf00;
		border: 1px solid #e8bf00;
		box-sizing: border-box;
		padding: 8px;
		padding-left: 25px;
		padding-right: 25px;
		border-radius: 5px;
	}
	
	.theform{
		display: flex;
		flex-direction: column;
		width: 500px;
	}
	
	.wrapper{
		box-sizing: border-box;
    	padding: 40px;
	}
	
	.cast_div{
		display: flex;
		flex-direction: row;
	}
	
	.inp_cast{
		width: 100%;
	}
	
	.text_inp{
		background-color: transparent;
		box-sizing: border-box;
		padding: 10px;
		border: 2px solid #ffffff87;
		border-radius: 10px;
		margin-bottom: 20px;
		color: white;
		padding-left: 17px;
		font-size: 1.1rem;
		height: 100px;
		resize: none;
		transition: .3s;
	}
	
	.text_inp:hover{
		background-color: #00000047;
	}
	
	.text_inp:focus{
		border: 2px solid #e8bf00cc;
		background-color: #00000047;
		outline: none;
	}
	
	.s_inp{
		background-color: transparent;
		box-sizing: border-box;
		padding: 10px;
		border: 2px solid #ffffff87;
		border-radius: 50px;
		margin-bottom: 20px;
		color: white;
		padding-left: 17px;
		font-size: 1.1rem;
		transition: .3s;
	}
	
	.s_inp:hover{
		background-color: #00000047;
	}
	
	.s_inp:focus{
		border: 2px solid #e8bf00cc;
		background-color: #00000047;
	}
	
	#plus{
		border: 2px solid #ffffff87;
		border-radius: 50%;
		display: block;
		width: 48px;
		height: 41px;
		font-size: 3rem;
		text-align: center;
		display: flex;
		justify-content: center;
		align-items: center;
		color: #ffffff8a;
		margin-left: 10px;
		transition: .3s;
	}
	
	#plus:hover{
		background-color: #e8bf00;
    	color: white;
		cursor: pointer;
	}
	
	#result{
		color: white;
    	margin-bottom: 20px;
	}
	
	.submit_btn{
		box-sizing: border-box;
		padding: 10px;
		font-size: 1.2rem;
		background-color: #2d9ccc;
		border: none;
		color: white;
		border-radius: 50px;
		transition: .3s;
	}
	
	.submit_btn:hover{
		cursor: pointer;
		background-color: #e8bf00;
	}
	
	.screen{
		background-color: #000000ad;
		width: 100%;
		height: 104%;
		position: fixed;
		top: 0;
	}
	
	.message{
		width: 400px;
		height: 100px;
		background-color: white;
		position: absolute;
		margin-left: auto;
		margin-right: auto;
		left: 0;
		right: 0;
		top: 125px;
		box-sizing: border-box;
		padding: 20px;
		text-align: center;
		font-size: 1.2rem;
		font-family: 'roboto_li';
		src: url("assets/fonts/roboto/Roboto-Light.ttf");
	}
	
	.btn_ok{
		border: 2px solid #0182b4;
		background-color: #0182b4;
		color: white;
		border-radius: 5px;
		width: 85px;
		margin-left: auto;
		margin-right: auto;
		margin-top: 12px;
		transition: .3s;
	}
	
	.btn_ok:hover{
		background-color: white;
		color: black;
		cursor: pointer;
	}
	
</style>
<script src="assets/js/jQuery_3.4.1.js"></script>

<script>
	
	var castArray = [];
	
	$(document).ready(function(){
		
		$("#plus").click(function(){
			var cast = $("#cast_inp").val();
			if(cast != ""){
				castArray.push(cast);
				$("#cast_values").val(JSON.stringify(castArray));
				$("#result").html(JSON.stringify(castArray));
			}
			$("#cast_inp").val("");
		});
		
		$("#screen").click(function(){
			$("#screen").fadeOut("fast");
		});
		
		$("#btn_ok").click(function(){
			$("#screen").fadeOut("fast");
		});
		
	});
</script>
</head>

<body>
	<div class="topbar">
		<img src="assets/icons/vird.png" class="vird_icon">
		<p class="top_title">VIRD</p><p class="subtitle">Submit a Movie to DataBase (admin only)</p>
	</div>
	
	<div class="wrapper">
		<form action="" method="post" class="theform">
			<input type="text" name="title" placeholder="Movie Title" class="s_inp" required>
			<input type="text" name="file" placeholder="File Name" class="s_inp" required>
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
			<input type="submit" name="submit" class="submit_btn" value="SUBMIT MOVIE">
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
			session_unset($_SESSION['response']);
		}
		
		
	
		
	?>
	
	
</body>
</html>




























