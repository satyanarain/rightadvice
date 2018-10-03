<?php 
/* 
define('DB_NAME', 'curedvtv_rightadvice_newcuredvtv_rightadvice_new');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root@1234');
define('DB_HOST', 'localhost');
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);
$db = mysqli_select_db(DB_NAME,$conn);
if(!$db)
        echo "Database connection error";
*/
$con = mysqli_connect("localhost","root","root@1234","curedvtv_rightadvice_new");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>