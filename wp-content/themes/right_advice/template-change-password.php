<?php 
/*
* Template Name: Change Password Page
*/
session_start();
ob_start(); 
 get_header();

if(isset($_SESSION['userEmail']) && $_SESSION['userEmail'] != '')
{
	$url = "http://curedincurable.com/rightadvice/user/dashboard";
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
	<?php 
	
	if(isset($_GET['eid']) && isset($_GET['tid']))
	{
		$email = base64_decode($_GET['eid']);
		$token = base64_decode($_GET['tid']);
		$eid = base64_decode($_SESSION['eid']);
		$tid = base64_decode($_SESSION['tid']); 
		
		if($email == $eid && $token == $tid)
		{
	?>
    <form class="well form-horizontal" action="" method="post"  id="lawyer_registration" enctype="multipart/form-data">
		
		<!-- Form Name -->
		<center><h2><b>Change Password</b></h2></center><br>
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
		  <label class="col-md-4 control-label">New Password</label>  
			<div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				<input name="password" id="password" placeholder="Your New Password" class="form-control"  type="password">
			</div>
		  </div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 control-label" >Confirm Password</label> 
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input name="con_password" id="con_password"  placeholder="Your Confirm Password" class="form-control"  type="password">
				</div>
			</div>
		</div>
		<input type="hidden" id="email" value="<?php echo $email;?>" />
		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label"></label>
		  <div class="col-md-4"><br>
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="button" name="change_password"onclick="changePassword()" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; Change <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
		  </div>
		</div>

		
	</form>
	
	<?php 		
		}else{
			echo "You are not authorised to access this page";
		}
	}
	else
	{
		echo "<center><h2>You are not authorised to access this page</h2></center>";
	}

	?>
</div>
</div><!-- /.container -->
</div>

<script>
function changePassword()
{
	var password = jQuery('#password').val();
	var con_password = jQuery('#con_password').val();
	var email = jQuery('#email').val();
	
	if(password == '')
	{
		alert('Please enter your password');
		document.getElementById('password').focus();
		return false;
	}
	else if(con_password == '')
	{
		alert('Please confirm your password');
		document.getElementById('con_password').focus();
		return false;
	}
	else if(password != con_password)
	{
		alert('Your confirm password does not matched');
		document.getElementById('con_password').focus();
		return false;
	}
	else
	{
		jQuery.ajax({
			url:'<?php bloginfo('template_url')?>/ajax.php',
			type:'post',
			data:{
				password:password,
				email:email,
				action:'change_forgot_password'
			},
			success:function(response){
				alert(response);
				window.location.href = 'http://curedincurable.com/rightadvice';
			}
		});
		
	}
		
	
}

</script>
<?php get_footer();?>