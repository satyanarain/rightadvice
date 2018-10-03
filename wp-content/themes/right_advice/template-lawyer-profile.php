<?php 
	/*
	* Template Name: Lawyer Profile Page
	*/
	session_start();
	ob_start(); 
	 get_header();

	?>
	<?php 
	//echo $_GET['lid'];
	if(isset($_GET['lid']) && $_GET['lid'] != '')
	{
		$lid = base64_decode($_GET['lid']);
		global $wpdb; 
		$post = $wpdb->get_results("select ra_lawyers.*, ra_lawyer_answer.*, ra_front_users.email as user_email
									from ra_lawyers 
									left join ra_lawyer_answer on ra_lawyer_answer.lawyer_id = ra_lawyers.id
									left join ra_front_users on ra_front_users.id = ra_lawyer_answer.client_id
									where ra_lawyers.id='$lid' AND ra_lawyers.status='1' AND ra_lawyers.email_confirm='1' group by ra_lawyers.id ") or die (mysql_error()); 
		//print_r($post);
		$rating = '0';
			
		foreach($post as $lawyer){} 
		
		if($lawyer->rating != '' || $lawyer->rating != 0)
		{
			$rat_qr =  $wpdb->get_results("select ra_lawyer_answer.*,ra_front_users.full_name from ra_lawyer_answer left join ra_front_users on ra_front_users.id = ra_lawyer_answer.client_id where lawyer_id='$lid' ") or die(mysql_error());
			//print_r($rat_qr);  
			if(count($rat_qr) > 0){
				foreach($rat_qr as $rat){ 
					$rating = $rating + $rat->rating;
				}
				$rating = $rating / count($rat_qr); 
			}
		}
	}


	?>
	<div class="breadcrumb-container">
		<div class="container">
			<ol class="breadcrumb">
				<i class="fa fa-home pr-10"></i><a href="<?php the_permalink(57)?>">Home</a>
				<li>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="<?php the_permalink(89)?>">Lawyers</a></li>
				<li>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<?=$lawyer->full_name?></li>
			</ol>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="page-wrapper padt"> 
		<div class="container">
			<div class="row">

				<div class="col-md-9 col-md-push-3 ">				
					<div class="content">
						<div class="title-content">
							<div class="cposttype-title titlh5"><h5><?=$lawyer->full_name?></h5></div>

								
								<?php if ($lawyer->preferred == 1) { ?>
						<p class="pref"> <img src="<?php bloginfo('template_directory')?>/images/prefered.png"> </p>
								<?php } ?>

							<span class="askques">
								<?php if(isset($_SESSION['userEmail']) && $_SESSION['userEmail'] != ''){ ?>
								<a href="question?qid=<?=base64_encode($lawyer->email)?>" class="btn btn-primary askbtn">Ask A Question </a>
								<?php }else{ ?>
								<a href="user-login?lid=<?=base64_encode($lawyer->email)?>" class="btn btn-primary askbtn">Ask A Question </a>
								<?php } ?>
								 
								
							</span>
							
						</div>

						<div class="conten-desc">
							<div class="cbp-l-project-desc-text">
							<p><?php if($lawyer->profile_image != ''){ ?>
								<img src="http://35.154.128.159:83/lawyer/profile_pics/<?=$lawyer->profile_image?>" alt="" class="proimg">
							<?php } else{ ?>
								<img src="<?=bloginfo('template_url')?>/images/no-image.jpg" alt="" class="proimg">
							<?php } ?><?=nl2br($lawyer->about)?></p>
							</div>
						</div>
					</div>

                                          <!-- End About US-->

                                              <div class="content">
						<div class="title-content"><div class="cposttype-title"><h5> About Me </h5></div>
					         </div>

					       <div class="conten-desc">
						  
                          <ul class="about-list">
     <li>Organization Name : <span ><?=$lawyer->organization_name?>  </span></li>
     <li>Address : <span><?=$lawyer->s_city.', '.$lawyer->s_country?></span></li>
     <li>Languages : <span><?php echo str_replace('^',', ',$lawyer->languages); ?></span></li>
     <li>Nationality : <span><?=$lawyer->nationality?></span></li>
     <li>Can represent in Court? : <span><?=$lawyer->courts?></span></li>
     <li>Gender : <span> <?=$lawyer->gender?> </span></li>
     <li>DOB : <span> <?=date('d F Y',strtotime($lawyer->dob))?> </span></li>
                                    

</ul>
</div>
</div>

					<div class="content Specialitiess-list">
						<div class="title-content"><div class="cposttype-title"><h5>Expertise Area</h5></div>
					</div>

					<div class="conten-desc specialist-list">
						<ul class="cbp-l-project-details-list">
							<?php 
							$speciality = explode('^',$lawyer->Specialities_arr);
							for($i=0; $i<count($speciality); $i++){
							?>
							<li><?=$speciality[$i]?><span style="float: right;"></span></li>
							<?php }?>
						</ul>
					</div>
				</div>


 <div class="content">
<div class="title-content"><div class="cposttype-title"><h5> Experience and Education </h5></div>
					         </div>

					       <div class="conten-desc">
						  
                          <ul class="about-list">
     <li>Education : <span class="plist"><div><?=nl2br($lawyer->education)?></div></span></li>
     <li>Experience  : <span class="plist"><div><?=nl2br($lawyer->ExperienceTranining)?></div></span></li>
     <li>Law Office Affiliations : <span class="plist"><?=$lawyer->lawfirmAffiliations?> </span></li>
                            
	
                                    

</ul>
</div>
</div>



				
				<!--div class="content ">
					<div class="title-content"><div class="cposttype-title"><h5>Categories</h5></div></div>
					
					<div class="conten-desc tag-list">
						<ul class="tags">
							<?php 
							$categories = explode('^',$lawyer->categories);
							for($i=0; $i<count($categories); $i++){
							?>
							<li><a href="javascript:void(0)"><?=$categories[$i]?></a></li>
							<?php }?>
						</ul>
					</div>
				</div>-->


<div class="content Specialitiess-list">
<div class="title-content">
<div class="cposttype-title"><h5>Video</h5></div>
<div style="clear:both;"></div>


	</div>


<div class="conten-desc">
								
								<?php if($lawyer->youtube != ''){ ?>
								<iframe width="100%" height="315" src="https://www.youtube.com/embed/<?=$lawyer->youtube?>" frameborder="0" allowfullscreen></iframe>
								<?php }else if($lawyer->vimeo != ''){ ?>
								<iframe src="https://player.vimeo.com/video/<?=$lawyer->vimeo?>?portrait=0&badge=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
								<?php } ?>
							</div>

</div>

	

				
				
				<div class="content Specialitiess-list">
					<div class="title-content">
	<div class="cposttype-title">
	<h5>Reviews</h5>
	</div>

	</div>

				<div class="conten-desc specialist-list">

					<?php $i = 1; foreach($rat_qr as $rat){ if($i++ > 5){ exit; } ?>
	<div class="feddrate">
	<div class="feddra1">
	<div class="col-md-6 col-sm-6 col-xs-12 revname"> <?=$rat->full_name?> </div>
	<div class="col-md-6 col-sm-6 col-xs-12 revtate"> 
	<ul style="list-style:none;">
							<?php for($i=0; $i < $rat->rating; $i++){?>
							<li><img src="<?=bloginfo('template_url')?>/images/yellow-star.png"  style="height: 25px;" /></i>
							<?php }for($j=0; $j< 5-$rat->rating; $j++){?>
							<li><img src="<?=bloginfo('template_url')?>/images/blanck-star.png" style="height: 17px !important;margin: 1px 0px !important;" /><li>
							<?php }?>
						</ul>
	</div>
	 </div>					

						<?=htmlentities($rat->feedback)?>
	</div>
					<?php } ?>


				</div>
			</div>
		</div>
			<div class="col-md-3 col-md-pull-9">
				<div class="medicaldirectory-sidebar">
                                <div class="title-content" style="padding: 12px 25px;"> Rating  <a class="ratp" title="Rating">
								<span><?=$rating?>&nbsp;<i class="fa fa-star"></i> &nbsp; </span>
								</a> </div>

					<div class="sidebar-content">
						<div class="cbp-l-project-details-title "><span>Contact Info</span></div>
						<ul class="cbp-l-project-details-list">
							<li><strong>Location</strong>
								<div class="tooltipsingle"><?=$lawyer->s_city.', '.$lawyer->s_country?></div>
							</li>
							
							<!--
							
							<li><strong>Phone</strong>
								<a style="text-decoration: none;" href="tel: <?=$lawyer->mobile?>"> <?=$lawyer->mobile?> </a>
							</li>
							
							<?php if($lawyer->fax != ''){?>
							<li><strong>Fax</strong><?=$lawyer->fax?>&nbsp;</li>
							<?php }?>
							
							<li><strong>Email</strong><?=$lawyer->email?><?php if($lawyer->admin_email == 'XX'){ echo ',<br>'.$lawyer->admin_email;}?></li>
							
							<?php if($lawyer->website != ''){?>
							<li><strong>Web Site</strong><a style="text-decoration: none;" href="<?=$lawyer->website?>" target="_blank"> <?=$lawyer->website?> </a></li>
							<?php } ?>
							<li><strong>Social Profile</strong>
								<?php if($lawyer->facebook != ''){?>
								 <a data-toggle="tooltip" data-placement="bottom" class="icon-blue" title="Facebook Profile" href="<?=$lawyer->facebook?>" target="_blank">
								 <i class="fa fa-facebook-square fa-2x"></i></a>
								
								<?php }if($lawyer->twitter != ''){?>
								 <a data-toggle="tooltip" data-placement="bottom" class="icon-blue" title="Twitter Profile" href="<?=$lawyer->twitter?>" target="_blank">
								 <i class="fa fa-twitter fa-2x"></i></a>
								
								<?php }if($lawyer->linkedin != ''){?>
								 <a data-toggle="tooltip" data-placement="bottom" class="icon-blue" title="linkedin Profile" href="<?=$lawyer->linkedin?>" target="_blank">
								 <i class="fa fa-linkedin-square fa-2x"></i></a>
								
								<?php }if($lawyer->gplus != ''){?>
								 <a data-toggle="tooltip" data-placement="bottom" class="icon-blue" title="linkedin Profile" href="<?=$lawyer->gplus?>" target="_blank">
								 <i class="fa fa-google-plus-square fa-2x"></i></a>
								
								<?php }if($lawyer->pinterest != ''){?>
								 <a data-toggle="tooltip" data-placement="bottom" class="icon-blue" title="linkedin Profile" href="<?=$lawyer->pinterest?>" target="_blank">
								 <i class="fa fa-pinterest-square fa-2x"></i></a>
								 
								 <?php }if($lawyer->instagram != ''){?>
								 <a data-toggle="tooltip" data-placement="bottom" class="icon-blue" title="linkedin Profile" href="<?=$lawyer->instagram?>" target="_blank">
								 <i class="fa fa-instagram fa-2x"></i></a>
								<?php }?>
							 </li>

-->

						</ul>
					</div>
		
				</div>
			</div>
		</div>
	</div>
	<style>
	.form-group ul li {
		display: inline-block;
	}
	</style>
	<script>

	function show_login_btn()
	{
		//jQuery('hello').show();
		//alert('hello');
	}
	</script>
	<?php get_footer();?>
