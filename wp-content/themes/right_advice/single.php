<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


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
				while ( have_posts() ) : the_post();

			?>
					<article class="blogpost">
					<div class="overlay-container">
						<?=the_post_thumbnail()?>
					</div>
					<header>
						<h2><?=the_title()?></h2>
						<div class="post-info">
							<span class="post-date">
								<i class="icon-calendar"></i>
								<span class="day"><?=get_the_date('d',$post->ID)?></span>
								<span class="month"><?=get_the_date('F, Y',$post->ID)?></span>
							</span>
							<!--span class="submitted"><i class="icon-user-1"></i> by <a href="#"><?=the_author()?></a></span>
							<span class="comments"><i class="icon-chat"></i> <a href="#"><?php wp_count_comments( $post->ID); ?>  comments</a></span-->
						</div>
					</header>

					<div class="blogpost-content">
						<p><?=the_content()?></p>
					</div>
					
				</article>
				<?php 
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					endwhile; // End of the loop.
				?>

			</div>										

			<div class="col-md-3">
				<?php get_sidebar(); ?>

		</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer();
