<?php 
session_start();
ob_start(); 

include("config.php");

get_header();

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

    	<div class="row">   <form class="well form-horizontal" action="<?=bloginfo('template_url')?>/ajax.php" method="post"  id="lawyer_registration" enctype="multipart/form-data">
		
		<!-- Form Name -->
		<center><h2><b>Client Registration Form</b></h2></center><br>
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
			<label class="col-md-4 control-label">Full Name</label>  
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input name="full_name" id="full_name" required placeholder="Full Name" class="form-control" type="text" value="<?php if(isset($_SESSION['cfull_name'])){ echo $_SESSION['cfull_name']; }?>">
				</div>
			</div>
		</div>
		
		<div class="form-group">
		  <label class="col-md-4 control-label">Email Address</label>  
			<div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				<input name="email" id="email"  required placeholder="E-Mail Address" class="form-control"  type="email" value="<?php if(isset($_SESSION['cemail'])){ echo $_SESSION['cemail']; }?>">
			</div>
		  </div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 control-label">Mobile Number</label>  
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
					<input name="mobile" id="mobile"  required placeholder="124567890" class="form-control" type="text" value="<?php if(isset($_SESSION['cmobile'])){ echo $_SESSION['cmobile']; }?>">
				</div>
			</div>
		</div>
		
		<!--<div class="form-group">
			<label class="col-md-4 control-label">Country of Residence and City</label>  
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-glob" aria-hidden="true"></i></span>
					<textarea name="address" id="address" required placeholder="Residential Address" class="form-control"><?php if(isset($_SESSION['caddress'])){ echo $_SESSION['caddress']; }?></textarea>
				</div>
			</div>
		</div>-->
		
		
		<div class="form-group">
			<label class="col-md-4 control-label">City</label>
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-address-card" requiredaria-hidden="true"></i></span>
					<select name="city" id="city" required class="form-control"><?php if(isset($_SESSION['city'])){ echo $_SESSION['city']; }?>
					  <option value="" selected>Select City</option>
					  <option value="Dubai" <?php if(isset($_SESSION['city']) && $_SESSION['city'] == 'Dubai') echo 'selected';?>>Dubai</option>
					  <option value="Abu Dhabi" <?php if(isset($_SESSION['city']) && $_SESSION['city'] == 'Abu Dhabi') echo 'selected';?>>Abu Dhabi</option>
					  <option value="Sharjah" <?php if(isset($_SESSION['city']) && $_SESSION['city'] == 'Sharjah') echo 'selected';?>>Sharjah</option>
					  <option value="Al Ain" <?php if(isset($_SESSION['city']) && $_SESSION['city'] == 'Al Ain') echo 'selected';?>>Al Ain</option>
					  <option value="Ajman" <?php if(isset($_SESSION['city']) && $_SESSION['city'] == 'Ajman') echo 'selected';?>>Ajman</option>
					  <option value="Ras Al Khaimah" <?php if(isset($_SESSION['city']) && $_SESSION['city'] == 'Ras Al Khaimah') echo 'selected';?>>Ras Al Khaimah</option>
					  <option value="Fujairah" <?php if(isset($_SESSION['city']) && $_SESSION['city'] == 'Fujairah') echo 'selected';?>>Fujairah</option>
					  <option value="Umm al-Quwain" <?php if(isset($_SESSION['city']) && $_SESSION['city'] == 'Umm al-Quwain') echo 'selected';?>>Umm al-Quwain</option>
					  <option value="Other" <?php if(isset($_SESSION['city']) && $_SESSION['city'] == 'Other') echo 'selected';?>>Other</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="form-group" id="specify_other" style="display:none;">
			<label class="col-md-4 control-label">Specify Other</label>  
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-gearphone"></i></span>
					<input name="other" id="other" placeholder="Specify Other" required class="form-control" type="text" value="<?php if(isset($_SESSION['other'])){ echo $_SESSION['other']; }?>">
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 control-label">Country</label>
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<?php
					 //  $sql = mysql_query("SELECT * FROM apps_countries") or die(mysql_error());
                                            $sql = 'SELECT * FROM apps_countries';
        $result = mysqli_query($conn, $sql);
                                           
                                           
                                           
					?>
					<span class="input-group-addon"><i class="fa fa-address-card" requiredaria-hidden="true"></i></span>
					<select name="country" id="country" required class="form-control"><?php if(isset($_SESSION['country'])){ echo $_SESSION['country']; }?>
					    <option value="" selected>Select Country</option>
					    <?php
					    while($country = mysqli_fetch_assoc($result)) 
					{ ?>
						<option value="<?php echo $country['country_name']; ?>" <?php if(isset($_SESSION['country']) && $_SESSION['country'] == $country['country_name']) echo 'selected';?>><?php echo $country['country_name']; ?></option>
					<?php } ?>
					   
					</select>
				</div>
			</div>
		</div>
		
		
		<!--
		<div class="form-group">
			<label class="col-md-4 control-label">Date Of Birth</label>  
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
					<input name="dob" id="dob" placeholder="MM/DD/YYYY" required class="form-control" type="date" value="<?php if(isset($_SESSION['cdob'])){ echo $_SESSION['cdob']; }?>">
				</div>
			</div>
		</div>
		-->
		
		<div class="form-group">
			<label class="col-md-4 control-label">Gender</label>  
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
<div class="form-control">
					<input name="gender" type="radio" id="gender"  value="Male" <?php if(isset($_SESSION['cgender']) && $_SESSION['cgender'] == 'Male'){ echo 'checked'; }?>> Male
					<input name="gender" type="radio" id="gender"  value="Female" <?php if(isset($_SESSION['cgender']) && $_SESSION['cgender'] == 'Female'){ echo 'checked'; }?>> Female
				</div>
</div>
			</div>
		</div>
		
		<!--
		<div class="form-group">
			<label class="col-md-4 control-label">Organization Name</label>  
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-compass" aria-hidden="true"></i></span>
					<input name="organization_name" id="organization_name" placeholder="" class="form-control" type="text" value="<?php if(isset($_SESSION['corganization_name'])){ echo $_SESSION['corganization_name']; }?>">
				</div>
			</div>
		</div>
		-->
		
		<!--div class="form-group">
			<label class="col-md-4 control-label">Documents Upload (Certificates, Diplomas etc.)</label>  
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
					<input name="documents" id="documents" class="form-control" type="file">
				</div>
			</div>
		</div-->
		
		<div class="form-group">
			<label class="col-md-4 control-label" >Password</label> 
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
					<input name="user_password" id="user_password" required  placeholder="Password" class="form-control" type="password">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" >Confirm Password</label> 
			<div class="col-md-4 inputGroupContainer">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
					<input name="confirm_password" required id="confirm_password" placeholder="Confirm Password" class="form-control" type="password">
				</div>
			</div>
		</div>

		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label"></label>
		  <div class="col-md-4"><button type="submit" name="user_registration" class="btn btn-warning" >SUBMIT <span class="glyphicon glyphicon-send"></span></button>
		  </div>
		</div>

		
	</form>
</div>
</div>
</div>


<?php get_footer();?>




<script>
$(document).ready(function(){
	var city = $('#city').val();
	if(city == 'Other')
	{
		$('#specify_other').show();
	}else {
		$('#specify_other').hide();
	}
	$(document).on('change', '#city', function(){
		var city = $(this).val();
		//alert(city);
		if(city == 'Other')
		{
			$('#specify_other').show();
			$('#country').val('');
		}else {
			$('#specify_other').hide();
			$('#other').val('');
			$('#country').val('United Arab Emirates');
		}
	});	
});
</script>






