<?php 

$servername = "localhost";
$database = "curedvtv_rightadvice_new";
$username = "root";
$password = "root@1234";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}


?>