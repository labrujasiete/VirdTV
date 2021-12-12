<?php
include "database/functions.php";
$db = new base_class;
?>
<?php

$query = $_POST['query'];//<----input value
//$names = explode(" ", $query);




if($query != ""){
	
	$db->Normal_Query("SELECT * FROM movies WHERE title LIKE ? LIMIT 8", ["%$query%"]);
    $row = $db->fetch_all();
    
    
    foreach($row as $res):

	$movie_id = $res->uid;
	$title = $res->title;
	$cover = $res->cover;
	$year = $res->year;
	$langs = $res->langs;
	$category = $res->category;
	$rating = $res->rating;
	
	

	echo '
		<div class="movie_container_div">
			<a class="movie_container_a" href="playmovie.php?id='.$movie_id.'">
				<div class="categorie_tag"><div class="half_sqr"></div>'.ucfirst($category).'</div>
				<div class="star_div"><img class="star_img" src="assets/icons/star.svg"><p class="raiting_p">'.$rating.'</p></div>
				<div class="movie_cover" style="background-image: url(assets/covers/'.$cover.')"></div>
				<p class="small_info">('.$year.') '.strtoupper($langs).'</p>
				<p class="title">'.ucwords($title).'</p>
			</a>
		</div>
	';

endforeach;
    
}else{
	$db->Normal_Query("SELECT * FROM movies ORDER BY timestamp DESC");
	$row = $db->fetch_all();
	foreach($row as $res):

	$movie_id = $res->uid;
	$title = $res->title;
	$cover = $res->cover;
	$year = $res->year;
	$langs = $res->langs;
	$category = $res->category;
	$rating = $res->rating;

	echo '
		<div class="movie_container_div">
			<a class="movie_container_a" href="playmovie.php?id='.$movie_id.'">
				<div class="categorie_tag"><div class="half_sqr"></div>'.ucfirst($category).'</div>
				<div class="star_div"><img class="star_img" src="assets/icons/star.svg"><p class="raiting_p">'.$rating.'</p></div>
				<div class="movie_cover" style="background-image: url(assets/covers/'.$cover.')"></div>
				<p class="small_info">('.$year.') '.strtoupper($langs).'</p>
				<p class="title">'.ucwords($title).'</p>
			</a>
		</div>
	';

	endforeach;
}












?>