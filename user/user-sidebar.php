<div class="col-md-3 col-sm-3 col-xs-12">
    <!-- BEGIN PROFILE SIDEBAR -->

	<div class="profile-sidebar">
        <!-- PORTLET MAIN -->
		<div class="portlet portlet0 light profile-sidebar-portlet">
			<!-- SIDEBAR USERPIC -->
			<div class="profile-userpic text-center" id="preview">
				<?php if($user['profile_image'] != ''){ ?>
				<img src="profile_pics/<?=$user['profile_image']?>">
				<?php }else{ ?>
				<img src="http://35.154.128.159:83/lawyer/lawyer-dummy-image.png">
				<?php }?>
			</div>
			<div>
				<form id="imageform" method="post" enctype="multipart/form-data" action='user_ajax.php'>
					<input type="file" name="photoimg" id="photoimg" style="display:none" />
				</form>
			</div>
			<div class="profile-userbuttons">
				<label for="photoimg" class="btn-new btn-change btn-circle">Change </label>
			</div>
			
			<!-- END SIDEBAR USERPIC -->
			<!-- SIDEBAR USER TITLE -->
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?=$_SESSION['userName']?></div>
				<div class="profile-usertitle-job"></div>
			</div>
			<!-- END SIDEBAR USER TITLE -->
			
			<!-- SIDEBAR MENU -->
			<div class="profile-usermenu">
				<ul class="nav">
				<?php 
					$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					$url = explode('/',$url);
					$uri = $url[0];
					$uri1 = $url[1];
					$uri2 = $url[2];
					$uri3 = $url[3];
				?>

					<li class="<?php if($uri3 == 'dashboard'){ echo "active";}?>">
						<a href="dashboard">
							<i class="fa fa-dashboard"></i> Dashboard
						</a>
					</li>
					
					<li class="<?php if(($uri3 == 'all-questions') || (strpos($uri3, 'view-answer') !== false)){ echo "active";}?>">
						<a href="all-questions">
							<i class="fa fa-star"></i> View Questions & Answers
						</a>
					</li>

					<li class="<?php if($uri3 == 'manage-profile'){ echo "active";}?>">
						<a href="manage-profile">
							<i class="fa fa-user"></i> Manage Profile
						</a>
					</li>
					
					<li class="<?php if($uri3 == 'change-password'){ echo "active";}?>">
						<a href="change-password">
							<i class="fa fa-key"></i> Change Password
						</a>
					</li>
					
					<li class=" ">
						<a href="user_ajax?uid=<?=base64_encode($_SESSION['userEmail'])?>"><i class="fa fa-sign-out"></i>  Sign Out</a>
					</li>
				</ul>
			</div>
  
			<!-- END MENU -->
			<!--div class="about-profile-owner">
				<div class="margin-top-20 profile-desc-link">
				   <a href="http://"><span></span><i class="fa fa-globe"></i></a>
				</div>
				<div class="margin-top-20 profile-desc-link">
					<a href="http://www.twitter.com//"><span></span><i class="fa fa-twitter-square"></i></a>
				</div>
				<div class="margin-top-20 profile-desc-link">
					<a href="http://www.facebook.com//"><span></span><i class="fa fa-facebook-square"></i></a>
				</div>
			</div-->
		</div>
		<!-- END PORTLET MAIN -->
		
	</div>
</div>
<!-- END BEGIN PROFILE SIDEBAR -->