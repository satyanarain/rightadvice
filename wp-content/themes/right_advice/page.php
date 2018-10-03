<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
<section class="center">
	<?=the_post_thumbnail()?>
</section>

<section class="main-container padding-bottom-clear">
	<div class="container">
		<div class="row">
			<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile; // End of the loop.
			?>
		
		</div>
	</div><!-- #primary -->
</section><!-- .wrap -->

<?php get_footer();
