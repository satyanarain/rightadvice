<?php 
/*
* Template Name: Lawyer Login Page
*/
session_start();
ob_start(); 
 get_header();

if(isset($_SESSION['lawyerEmail']) && $_SESSION['lawyerEmail'] != '')
{
	$url = "http://35.154.128.159:83/lawyer/dashboard";
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
    <form class="well form-horizontal" action="<?=bloginfo('template_url')?>/ajax.php" method="post"  id="lawyer_registration" enctype="multipart/form-data">
		
		<!-- Form Name -->
		<center><h2><b>Lawyer Login</b></h2></center><br>
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
		
		
		<div class="form-group">
		  <label class="col-md-4 control-label">E-Mail Address</label>  
			<div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				<input name="email" id="email" placeholder="E-Mail Address" class="form-control"  type="email">
			</div>
		  </div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 control-label" >Password</label> 
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input name="user_password" id="user_password"  placeholder="Password" class="form-control"  type="password">
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 control-label" ></label> 
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<a href="<?=the_permalink(254)?>">Forgot Password? Click here to reset</a>
				</div>
			</div>
		</div>
		
		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label"></label>
		  <div class="col-md-4">
			<button type="submit" name="lawyer_login" class="btn btn-warning" >Login <span class="glyphicon glyphicon-send"></span></button>
		  </div>
		</div>

	</form>
</div>
</div>
</div>


<?php get_footer();?>