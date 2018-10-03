<?php 
/*
* Template Name: Blog Page
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


<div class="page-wrapper padt"> 
	<div class="container">
		<div class="row">

			<div class="col-md-9">
			<?php 
			$args = array('post_type' => 'post', 'category' => '1');
			$posts = new WP_QUERY($args);
			while ($posts->have_posts()){ $posts->the_post();
			?>
					
				<article class="blogpost">
					<div class="overlay-container">
						<a href="<?=the_permalink()?>"><?=the_post_thumbnail()?></a>
					</div>
					<header>
						<h2><a href="<?=the_permalink()?>"><?=the_title()?></a></h2>
						<div class="post-info">
							<span class="post-date">
								<i class="icon-calendar"></i>
								<span class="day"><?=get_the_date('d',$post->ID)?></span>
								<span class="month"><?=get_the_date('F, Y',$post->ID)?></span>
							</span>
							<span class="submitted"><i class="icon-user-1"></i> by <a href="#"><?=the_author_nickname()?></a></span>
							<span class="comments"><i class="icon-chat"></i> <a href="#"><?php wp_count_comments( $post->ID); ?>  comments</a></span>
						</div>
					</header>

					<div class="blogpost-content">
						<p><?=the_excerpt(50)?></p>
					</div>
					<footer class="clearfix">
						<div class="link pull-right"><i class="icon-link"></i><a href="<?=the_permalink()?>">Read More</a></div>
					</footer>
				</article>
			<?php } ?>
	
			</div>										

			<div class="col-md-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

