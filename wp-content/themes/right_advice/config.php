<?php 
define('DB_NAME', 'curedvtv_rightadvice_new');
define('DB_USER', 'curedvtv_right');
define('DB_PASSWORD', '59T(I,*M0%)S');
define('DB_HOST', 'localhost');

$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
$db = mysql_select_db(DB_NAME,$conn);
if(!$db)
	echo "Database connection error";


?>