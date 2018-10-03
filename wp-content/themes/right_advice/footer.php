<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>
	<div class="terms-sec">
		<div class="container">  
			<div class="row"> 
				<div class="col-md-6 col-md-6 col-xs-12">
					<a href="<?=the_permalink(108)?>">Terms of Use</a> /<a href="<?=the_permalink(110)?>">Privacy Policy</a> 
				</div>			

				<div class="col-md-6 col-md-6 col-xs-12 copyr">  
					Copyright 2017 Right Advice
				</div>
			</div>
		</div>
	</div>

	<div class="terms-sec bg-black tec">
		<div class="container"> 
			<div class="row"> 
				<p><?php the_field('footer_description',57); ?></p> 
			</div>
		</div>
	</div>
</div>
	<!-- Jquery and Bootstap core js files -->
	<script type="text/javascript" src="<?=bloginfo('template_url')?>/plugins/jquery.min.js"></script>
	<script type="text/javascript" src="<?=bloginfo('template_url')?>/bootstrap/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script> 
	
	<!-- Magnific Popup javascript -->
	<script type="text/javascript" src="<?=bloginfo('template_url')?>/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

	<!-- Owl carousel javascript -->
	<script type="text/javascript" src="<?=bloginfo('template_url')?>/plugins/owlcarousel2/owl.carousel.min.js"></script>

	<!-- Pace javascript -->
	<script type="text/javascript" src="<?=bloginfo('template_url')?>/plugins/pace/pace.min.js"></script>

	<!-- SmoothScroll javascript -->
	<script type="text/javascript" src="<?=bloginfo('template_url')?>/plugins/jquery.browser.js"></script>
	<script type="text/javascript" src="<?=bloginfo('template_url')?>/plugins/SmoothScroll.js"></script>
	<script type="text/javascript" src="<?=bloginfo('template_url')?>/js/ckeditor/ckeditor.js"></script>
	
	<!-- Initialization of Plugins -->
	<!--script type="text/javascript" src="<?=bloginfo('template_url')?>/js/template.js"></script-->
	<!-- Custom Scripts -->
	<script type="text/javascript" src="<?=bloginfo('template_url')?>/js/custom.js"></script>
	<script src="<?=bloginfo('template_url')?>/js/global.js"></script>
	<script>
		CKEDITOR.replace( 'editor1' );
	</script>
</body>
</html>
