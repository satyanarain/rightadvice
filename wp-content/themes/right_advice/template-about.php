<?php 
/*
* Template Name: About Us Page
*/
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
<?php 
//$post = get_post(74);
?>
<section class="aboutf center">
	<img src="<?=get_the_post_thumbnail_url()?>">
</section>

<section class="main-container padding-bottom-clear">
	<div class="container">
		<div class="row">
			<div class="main col-md-12">
				<?=$post->post_content?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>