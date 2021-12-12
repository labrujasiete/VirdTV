<?php
include "database/functions.php";
$db = new base_class;
?>
<?php

if(isset($_POST['change_image'])){

    $cover = $db->security($_POST['filename']);
    $uid = $db->security($_POST['mov_uid']);

    $db->Normal_Query("UPDATE movies SET cover = ? WHERE uid = ?", [$cover, $uid]);

}

/* 

UPDATE table_name
SET column1=value, column2=value2,...
WHERE some_column=some_value  

$db->Normal_Query("INSERT INTO movies (uid, title, file, year, rating, description, director, cast, langs, category, cover) VALUES (?,?,?,?,?,?,?,?,?,?,?)", [$movie_id, $title, $file, $year, $raiting, $info, $director, $cast_values, $lang, $cat, $cover]);
		$_SESSION['response'] = "submitted";
        
        */
?>
<html>
    <head></head>

    <body>

    <!--Change Movie Cover Image Filename-->
    <form action="" method="post">
        <p>Change Image File name</p>
        <input type="text" name="filename" placeholder="Filename">
        <input type="text" name="mov_uid" placeholder="Movie UID">
        <input type="submit" name="submit" value="make change">
    </form>

    </body>
</html>