<?php include('user-header.php');?>


<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<i class="fa fa-home pr-10"></i><a href="../" rel="nofollow">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="dashboard">Dashboard</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;Manage Profile
		</ol>
	</div>
</div>


<article class='page-wrapper padt'>
	<div class="entry-content-wrapper clearfix">
		<div class="entry-content"  itemprop="text" >
			<div id="profile-account2" class="bootstrap-wrapper around-separetor">
				<div class="row margin-top-10">
					<?php include("user-sidebar.php");?>
					<!-- BEGIN PROFILE CONTENT -->

					<div class="col-md-9 col-sm-9 col-xs-12">
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
						<div class="profile-content">

						  <div class="portlet row light">
					
					<div class="portlet-body">
						<div class="tab-content">

						<div class="tab-pane active" id="tab_1_1">
							
							<form role="form" method="post" action="user_ajax.php" enctype="multipart/form-data">
								
								<div class="form-group">
								  <label class="control-label">Full Name</label>
								  <input type="text" placeholder="Enter Full Name" name="full_name" id="full_name"  class="form-control" value="<?=$user['full_name']?>"/>
								</div>

								<div class="form-group">
								  <label class="control-label">Email <small>(You can&#8216;t change your email address, please contact Right Advice Team)</small></label>
								  <input type="email" name="email" id="email"  class="form-control" value="<?=$user['email']?>" readonly/>
								</div>
								
								<div class="form-group">
								  <label class="control-label">About Me</label>
								  <textarea rows="5" placeholder="Enter About You" name="about" id="about"  class="form-control"><?=$user['about']?></textarea>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">Organization Name</label>							
									<div class=" "> 
										<input type="text" class="form-control" name="organization_name" id="organization_name" value="<?=$user['organization_name']?>" placeholder="Enter Organization Name">
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">Mobile Number</label>							
									<div class=" "> 
										<input type="text" class="form-control" name="mobile" id="mobile" value="<?=$user['mobile']?>" placeholder="Enter Mobile ">
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">Gender</label>							
									<div class=" "> 
										<!--input type="text" class="form-control" name="gender" id="gender" value="<?=$user['gender']?>" placeholder="Enter Your Gender"-->
										<input type="radio" name="gender" id="gender" <?php if($user['gender'] == 'Male'){ echo 'checked';}else{ echo '';}?> value="Male" /> Male
											  
										<input type="radio" name="gender" id="gender"  <?php if($user['gender'] == 'Female'){ echo 'checked';}else{ echo '';}?>  value="Female" /> Female
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">Date Of Birth</label>							
									<div class=" "> 
										<input type="date" class="form-control" name="dob" id="dob" value="<?=$user['dob']?>" placeholder="DD-MM-YYYY">
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">Address</label>							
									<div class=" "> 
										<input type="text" class="form-control" name="address" id="address" value="<?=stripslashes($user['address'])?>" placeholder="Enter address ">
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">City</label>							
									<div class=" "> 
										<input type="text" class="form-control" name="city" id="city" value="<?=$user['city']?>" placeholder="Enter city ">
									</div>
								</div>
								
								<div class="form-group">
									<div class=" form-group">
										<label for="text" class=" control-label">Zipcode</label>							
										<input type="text" class="form-control" name="postcode" id="postcode" value="<?=$user['postcode']?>" placeholder="Enter Zipcode ">
									</div>
								</div>
								
								<div class="margiv-top-10">
								<button type="submit" name="update_user" class="btn-new btn-custom">Save Changes <span class="glyphicon glyphicon-send"></span> </button>
								</div>
							</form>
						</div>

						</div>
					  </div>
					</div>
				  </div>
				  <!-- END PROFILE CONTENT -->
				 


				</div>
			</div>
		</div>
	</div>

</article><!--end post-entry-->

<?php include('user-footer.php');?>
