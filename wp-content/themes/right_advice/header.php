<?php

/**

 * The header for our theme

 *

 * This is the template that displays all of the <head> section and everything up until <div id="content">

 *

 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials

 *

 * @package WordPress

 * @subpackage Twenty_Seventeen

 * @since 1.0

 * @version 1.0

 */

if(session_id() == '')

     session_start(); 

 

?><!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js no-svg">

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

<!--link rel="shortcut icon" href="<?bloginfo('template_url')?>/images/feb.png"-->



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

	<!--link href="<?=bloginfo('template_url')?>/css/style.css" rel="stylesheet" -->

	<link href="<?=bloginfo('template_url')?>/css/typography-default.css" rel="stylesheet" >

	<!-- Custom css --> 

	<link href="<?=bloginfo('template_url')?>/css/custom.css" rel="stylesheet">



<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css">

<!--link rel="stylesheet" href="<?=bloginfo('template_url')?>/css/custom.css"-->

<style>
.switcher .option{
    position: absolute !important;
    top: 100%;
    left: 0px;
    z-index: 1000 !important;
    float: left;
    min-width: 160px;
    padding: 5px 0px;
    margin: 2px 0px 0px;
    font-size: 14px;
    text-align: left;
    display: block;

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
						<!--

						<span class="num1"> 	<i class="fa fa-phone"></i> &nbsp; <?=the_field('mobile_number',57)?> </span> 
						-->





						</div>

						<div class="col-xs-10 col-sm-7">

							<!-- header-top-second start -->

							<!-- ================ -->

							<div class="dropdown pull-right">

								<?php

								if(isset($_SESSION['userEmail']) || isset($_SESSION['lawyerEmail']))

								{ 

									if(isset($_SESSION['userEmail']))

										$uid = base64_encode($_SESSION['userEmail']);

									else if(isset($_SESSION['lawyerEmail']))

										$lid = base64_encode($_SESSION['lawyerEmail']);

									

								

									if(isset($uid) && $uid != '')

									{

								?>

									<button class="dropbtn"> <i class="fa fa-user pr-5"></i> client account</button>

									<div class="dropdown-content">

										<a href="http://curedincurable.com/rightadvice/user/dashboard"> dashboard</a>

										<a href="<?=bloginfo('template_url')?>/logout?uid=<?=$uid?>">logout</a>

									</div>	

								<?php }else if(isset($lid) && $lid != ''){?>

									<button class="dropbtn"> <i class="fa fa-user pr-5"></i> lawyer account</button>

									<div class="dropdown-content">

										<a href="http://curedincurable.com/rightadvice/lawyer/dashboard"> dashboard</a>

										<a href="<?=bloginfo('template_url')?>/logout?uid=<?=$uid?>">logout</a>

									</div>

								<?php }

								}else{?>

									<button class="dropbtn"> <i class="fa fa-sign-in pr-5"></i> login</button>

									<div class="dropdown-content">

										<a href="<?=the_permalink(8)?>"> lawyer Login</a>

										<a href="<?=the_permalink(12)?>">client Login</a>

									</div>

								<?php }?>

							</div>

							<?php if(empty($_SESSION['lawyerEmail']) && empty($_SESSION['userEmail'])){ ?>

							<div class="dropdown pull-right">

							  <button class="dropbtn"> <i class="fa fa-user-plus"></i> signup</button>

							  <div class="dropdown-content">

								<a href="<?=the_permalink(4)?>">lawyer signup</a>

								<a href="<?=the_permalink(10)?>">client signup</a>

							  </div>

							</div>

							
							

							<?php }?>

							<!-- header-top-second end -->

							<div class="dropdown pull-right" style="margin-right: 16px; padding-top: 3px;">

								<?php echo do_shortcode('[gtranslate]'); ?>

							</div>
					
	

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

									<a href="<?=the_permalink(57)?>"><img id="logo_img" src="<?=bloginfo('template_url')?>/images/logo.jpg" alt="The Project"></a>

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

													<!--li class="active"><a href="<?=the_permalink(57)?>">Home</a></li>

													<li><a href="<?=the_permalink(74)?>">About</a></li>

													<li><a href="<?=the_permalink(76)?>">FInd A Lawyer</a></li>

													<li><a href="<?=the_permalink(78)?>">Ask A Question </a></li>

													<li><a href="<?=the_permalink(80)?>">News</a></li>

													<li><a href="<?=the_permalink(82)?>">Blog</a></li>

													<li><a href="<?=the_permalink(84)?>">Contact</a></li-->

													<?php 

													$my_menu = array( 

													  'menu' => 'primary-menu',

													  'container' => '',

													  'items_wrap' => '%3$s' 

													  );



													wp_nav_menu( $my_menu );

													?>

												</ul>

												<!-- main-menu end -->

												

												

												<!-- header dropdown buttons -->

												<div class="btn-group dropdown pull-right" style="display:none">

													<button type="button" class="btn dropdown-toggle scolr" data-toggle="dropdown"><i class="icon-search"></i> Search</button>

													<ul class="dropdown-menu dropdown-menu-right dropdown-animation" style="width: 200px; padding-left:5px;">

														<li>

															<form role="search" class="search-box margin-clear">

																<div class="form-group has-feedback">

																	<!--input type="text" class="form-control" placeholder="Search">

																	<i class="icon-search form-control-feedback"></i-->

																	<?php get_search_form(); ?>

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

