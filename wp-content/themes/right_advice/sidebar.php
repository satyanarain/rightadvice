<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="upsell mah1"> <img src="<?php bloginfo('template_directory')?>/images/right-banner.jpg"/> </div>
	
	<div class="upsell mah1" style="display:none;">
		<h4>Latest Legal Blogs</h4>
		<?php 
		$args = array('post_type' => 'post', 'category' => '1');
		$posts = new WP_QUERY($args);
		while ($posts->have_posts()){ $posts->the_post();
		?>
		<div class="row">
			<a href="<?=the_permalink()?>">
				<div class="col-sm-1 p-0"></div>
				<div class="col-sm-11 newsb">
					<span><i class="fa fa-comments-o" aria-hidden="true"></i></span>
					<?=the_title()?>
				</div>
			</a>
		</div>
		<?php  }?>
		<div>
			<a href="<?=the_permalink(82)?>">
				<button class="btnall">View All Blogs</button>
			</a>
		</div>            
		<div class="clear"></div>
	</div>

	<div class="upsell mah1" style="display:none;">
		<h4>Latest Legal News</h4>
		<?php 
		$args = array('post_type' => 'all_news');
		$posts = new WP_QUERY($args);
		while ($posts->have_posts()){ $posts->the_post();
		?>
		<div class="row">
			<a href="<?=the_permalink(80)?>">
				<div class="col-sm-12 newsb">
					<span><i class="fa fa-flash" aria-hidden="true"></i></span>
					<?=the_title()?>
				</div>
			</a>
		</div>
		<?php } ?>
			
		<div><a href="<?=the_permalink(80)?>"><button class="btnall">View More</button></a></div>
		<div class="clear"></div>
	</div>
			