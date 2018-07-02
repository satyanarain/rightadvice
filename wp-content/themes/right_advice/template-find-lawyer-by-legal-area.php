<?php 
/*
* Template Name: Find Lawyers By Legal Areas Page
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

<div class="area-sec"> 
	<div class="container">
    	<div class="row">
    	<h2>Find Lawyers by Legal Areas</h2>
        <?php 
		$args = array('post_type' => 'specialty', 'posts_per_page' => -1);
		$posts = new WP_Query($args);
		while ($posts->have_posts()){ $posts->the_post();
		?>
		<div class="col-md-4">
        	<div class="area">
        		<a href="lawyers?cid=<?=base64_encode(get_the_title())?>"><?=the_title()?></a>
            </div>
		</div>
		<?php }?>
		</div>
    </div>
</div>
<?php get_footer(); ?>