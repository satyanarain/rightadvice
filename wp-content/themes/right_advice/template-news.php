<?php 
/*
* Template Name: News Page
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


<section class="main-container">
	<div class="container">
		<div class="row">

			<div class="main col-md-12">
				<?php 
				$args = array('post_type' => 'all_news');
				$posts = new WP_QUERY($args);
				while ($posts->have_posts()){ $posts->the_post();
				?>
				<div class="image-box style-3-b">
					<div class="row">
						<div class="col-sm-4">
							<?=the_post_thumbnail()?>
						</div>

						<div class="col-sm-8">
							<div class="body netex">
								<h3><?=the_title()?></h3>
								<p class="small mb-10"><i class="icon-calendar"></i> <?=get_the_date('d F Y',$post->ID)?></p>
								<div class="separator-2"></div>
								<p class="mb-10"><?=the_content()?></p>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
</section>


<?php get_footer(); ?>
			