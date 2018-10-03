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
<style>
    
 .shadow {
    position:absolute;
    max-width:45%;
    max-height:45%;
    top:50%;
    left:50%;
    overflow:visible;
}
img.logo {
    position:relative;
    max-width:100%;
    max-height:100%;
    margin-top:-50%;
    margin-left:-50%;
} 
    
</style>

<section class="shadow">
	<img src="<?=get_the_post_thumbnail_url()?>" class="logo" >
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