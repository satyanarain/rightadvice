<?php 
session_start();
include('../wp-config.php');

ob_start();

if(!isset($_SESSION['lawyerEmail']))
{
	header('location:http://curedincurable.com/rightadvice/lawyer-login');
}
//echo $_SESSION['lawyerEmail']."Hello sandy";
?>
<?php 

$result = mysql_query("select * from ra_lawyers where email = '".$_SESSION['lawyerEmail']."'") or die(mysql_error());
$lawyer = mysql_fetch_assoc($result);
?>

<!DOCTYPE html>
<html class="no-js no-svg">
<head>
	<meta charset="utf-8">
	<title>Right Advice - Lawyer Dashboard</title>
	<meta name="description" content="Right Advice">
	<meta name="author" content="Right Advice">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?=bloginfo('template_url')?>/images/feb.png">

<!-- Bootstrap core CSS -->
	<link href="<?=bloginfo('template_url')?>/bootstrap/css/bootstrap.css" rel="stylesheet">
	<!-- Font Awesome CSS -->
	<link href="<?=bloginfo('template_url')?>/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
	<!-- Fontello CSS -->
	<link href="<?=bloginfo('template_url')?>/fonts/fontello/css/fontello.css" rel="stylesheet">
	<!-- Plugins -->
	<link href="<?=bloginfo('template_url')?>/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
	<link href="<?=bloginfo('template_url')?>/plugins/rs-plugin-5/css/settings.css" rel="stylesheet">
	<link href="<?=bloginfo('template_url')?>/plugins/rs-plugin-5/css/layers.css" rel="stylesheet">
	<link href="<?=bloginfo('template_url')?>/plugins/rs-plugin-5/css/navigation.css" rel="stylesheet">
	<link href="<?=bloginfo('template_url')?>/css/animations.css" rel="stylesheet">
	<link href="<?=bloginfo('template_url')?>/plugins/owlcarousel2/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="<?=bloginfo('template_url')?>/plugins/owlcarousel2/assets/owl.theme.default.min.css" rel="stylesheet">
	<link href="<?=bloginfo('template_url')?>/plugins/hover/hover-min.css" rel="stylesheet">		
	<link href="<?=bloginfo('template_url')?>/style.css" rel="stylesheet">
	<link href="<?=bloginfo('template_url')?>/css/typography-default.css" rel="stylesheet" >
	<!-- Custom css --> 
	<link href="<?=bloginfo('template_url')?>/css/custom.css" rel="stylesheet">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css">

<style>
.btn-change{
    background-color: #0099fe !important;
    width: 44% !important;
    margin: 0% 27% !important;
}
</style>
</head>
<body class="no-trans front-page"> 
	<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
	<div class="page-wrapper">
		<!-- header-container start -->
		<div class="header-container">
			<!-- ================ -->
			<div class="header-top  colored">
				<div class="container">
					<div class="row">
						<div class="col-xs-2 col-sm-5 hidden-xs">
						<!--<span class="num1"> 	<i class="fa fa-phone"></i> &nbsp; 011-332-22-666 </span> -->
						</div>
						<div class="col-xs-10 col-sm-7">
							<!-- header-top-second start -->
							<!-- ================ -->
							<div class="dropdown pull-right">
								
								<?php
									if(isset($_SESSION['lawyerEmail'])){
										$uid = base64_encode($_SESSION['lawyerEmail']);
									
								?>
								<button class="dropbtn"> <i class="fa fa-user pr-5"></i> lawyer account</button>
								<div class="dropdown-content">
									<a href="http://curedincurable.com/rightadvice/lawyer/dashboard"> dashboard</a>
									<a href="lawyer_ajax?lid=<?=base64_encode($_SESSION['lawyerEmail'])?>">logout</a>
								</div>	
								<?php }else{?>
								<button class="dropbtn"> <i class="fa fa-sign-in pr-5"></i> login</button>
								<div class="dropdown-content">
									<a href="http://curedincurable.com/rightadvice/lawyer-login/">lawyer login</a>
									<a href="http://curedincurable.com/rightadvice/user-login/">user login</a>
								</div>
								<?php }?>
								
								
							</div>
							<div class="dropdown pull-right">

								<?php echo do_shortcode('[gtranslate]'); ?>

							</div>

							<!--div class="dropdown pull-right">
							  <button class="dropbtn"> <i class="fa fa-user-plus"></i> SIGNUP</button>
							  <div class="dropdown-content">
								<a href="http://curedincurable.com/rightadvice/lawyer-registration/">LAWYER SIGNUP</a>
								<a href="http://curedincurable.com/rightadvice/user-registration/">USER SIGNUP</a>
							  </div>
							</div-->
							<!-- header-top-second end -->
						</div>
					</div>
				</div>
			</div>
			<!-- header-top end -->

			<!-- header start -->
			<header >
				<div class="container">
					<div class="row">
						<div class="col-md-3 ">
							<!-- header-first start -->
							<!-- ================ -->
							<div class="header-first clearfix">
								<!-- logo -->
								<div id="logo" class="logo">
									<a href="http://curedincurable.com/rightadvice/"><img id="logo_img" src="http://curedincurable.com/rightadvice/wp-content/themes/right_advice/images/logo.jpg" alt="Right Advice"></a>
								</div>
								<!-- name-and-slogan -->
							</div>
							<!-- header-first end -->
						</div>

						<div class="col-md-9">
							<!-- header-second start -->
							<!-- ================ -->
							<div class="header-second clearfix">
								<!-- ================ -->
								<div class="main-navigation  animated with-dropdown-buttons">
									<!-- navbar start -->
									<!-- ================ -->
									<nav class="navbar navbar-default" role="navigation">
										<div class="container-fluid">
											<!-- Toggle get grouped for better mobile display -->
											<div class="navbar-header">
												<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
											</div>
											<!-- Collect the nav links, forms, and other content for toggling -->
											<div class="collapse navbar-collapse" id="navbar-collapse-1">
												<!-- main-menu -->
												<ul class="nav navbar-nav ">
													<!-- mega-menu start -->
													<li class=" active" style="">
														<a href="http://curedincurable.com/rightadvice/" class="dropdown-toggle">Home</a>
													</li>
													<!-- mega-menu end -->
													<!-- mega-menu start -->
													<li><a  href="http://curedincurable.com/rightadvice/about-us/">About</a></li>
													<li><a  href="http://curedincurable.com/rightadvice/lawyers/">Find A Lawyer</a></li>
													<li ><a href="http://curedincurable.com/rightadvice/ask-a-question/">Ask A Question </a></li>
													<li ><a href="http://curedincurable.com/rightadvice/news/">News</a></li>
													<li ><a href="http://curedincurable.com/rightadvice/blog/">Blog</a></li>
													<li ><a href="http://curedincurable.com/rightadvice/contact/">Contact</a></li>
												</ul>
												<!-- main-menu end -->
												<!-- header dropdown buttons -->
												<div class="btn-group dropdown pull-right" style="display:none">
													<button type="button" class="btn dropdown-toggle scolr" data-toggle="dropdown"><i class="icon-search"></i> Search</button>
													<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
														<li>
														<form role="search" class="search-box margin-clear">
															<div class="form-group has-feedback">
																<input type="text" class="form-control" placeholder="Search">
																<i class="icon-search form-control-feedback"></i>
															</div>
														</form>
														</li>
													</ul>
												</div>
												<!-- header dropdown buttons end-->
											</div>
										</div>
									</nav>
									<!-- navbar end -->
								</div>
								<!-- main-navigation end -->
							</div>
							<!-- header-second end -->
						</div>
					</div>
				</div>
			</header>
			<!-- header end -->
		</div>
		<!-- header-container end -->
<div class="clearfix"></div>