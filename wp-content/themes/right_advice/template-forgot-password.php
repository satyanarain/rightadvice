<?php 
/*
* Template Name: Forgot Password Page
*/
session_start();
ob_start(); 
 get_header();

if(isset($_SESSION['userEmail']) && $_SESSION['userEmail'] != '')
{
	$url = "http://35.154.128.159:83/user/dashboard";
	header("location:$url");
}

?>
<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<?=get_breadcrumb()?>
		</ol>
	</div>
</div>
<div class="clearfix"></div>
<div class="area-sec"> 

	<div class="container">

    	<div class="row">
	
    <form class="well form-horizontal" action="<?php bloginfo('template_url')?>/ajax.php" method="post"  id="lawyer_registration" enctype="multipart/form-data">
		
		<!-- Form Name -->
		<center>
			<h2><b>Forgot Password</b></h2>
			<p>Please enter your registred email, we will send the link to reset password on your registred email </p>
		</center><br>
		<?php if(isset($_SESSION['reg_error']) && $_SESSION['reg_error'] != ''){?>
		<div class="alert alert-danger col-md-12 data-dismisable"> 
			<i class="fa fa-info"></i>
			<?=$_SESSION['reg_error']?> 
			<?php unset($_SESSION['reg_error']);?>
		</div>
		<?php } else if(isset($_SESSION['reg_succ']) && $_SESSION['reg_succ'] != ''){?>
		<div class="alert alert-success col-md-12 data-dismisable"> 
			<i class="glyphicon glyphicon-thumbs-up"></i>
			<?=$_SESSION['reg_succ']?> 
			<?php unset($_SESSION['reg_succ']);?>
		</div>
		<?php } ?>
		
		<input type="hidden" name="llid" value="<?php if(isset($_GET['lid'])){ echo $llid; }?>" />
		<div class="form-group">
		  <label class="col-md-4 control-label">Email Address</label>  
			<div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				<input name="email" id="email" placeholder="E-Mail Address" class="form-control"  type="email">
			</div>
		  </div>
		</div>
		
		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label"></label>
		  <div class="col-md-4"><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="forgot_password" class="btn btn-warning" > Submit <span class="glyphicon glyphicon-send"></span></button>
		  </div>
		</div>

		
	</form>
</div>
</div><!-- /.container -->
</div>


<?php get_footer();?>	