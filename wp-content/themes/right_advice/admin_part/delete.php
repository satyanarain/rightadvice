<?php 
session_start();
include("../config.php");
if(isset($_GET['lid']) && $_GET['lid'] != ''){
	$del = mysql_query("delete from ra_lawyers where id='".$_GET['lid']."'") or die(mysql_error());
	if($del){
		$_SESSION['reg_succ'] = "Record deleted successfully";
		header("all-lawyer");
	}else{
		$_SESSION['reg_error'] = "Record not deleted, please try again";
		//header("location:http://curedincurable.com/rightadvice/wp-admin/admin.php?page=all_lawyer");
		header("all-lawyer");
	}
}
?>