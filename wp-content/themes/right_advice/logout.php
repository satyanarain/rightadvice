<?php 

session_start();
ob_start(); 
 //get_header();

$uid = base64_decode($_GET['uid']);
session_unset($uid);
session_destroy();

header("location:http://35.154.128.159:83");

/* if(isset($_GET['uid']))
{
	$uid = base64_decode($_GET['uid']);
	if($uid == $_SESSION['userEmail'])
	{
		session_unset($uid);
		session_destroy();
		header("location:http://35.154.128.159:83");
	}
}


if(isset($_GET['lid']))
{
	$lid = base64_decode($_GET['lid']);
	if($lid == $_SESSION['lawyerEmail'])
	{
		session_unset($lid);
		session_destroy();
		header("location:http://35.154.128.159:83");
	}
} */
//get_footer();
?>