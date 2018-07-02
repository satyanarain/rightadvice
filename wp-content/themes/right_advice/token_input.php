<?php 
session_start();
include("config.php");


$result = mysql_query("SELECT post_title FROM ra_posts WHERE post_type='specialty' AND post_title LIKE '%".$_GET['query']."%' LIMIT 10"); 

$json = [];
while($row = mysql_fetch_assoc($result)){
    $json[] = $row['post_title'];
}

echo json_encode($json);