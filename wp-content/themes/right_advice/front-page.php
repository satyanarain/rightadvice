<?php 
/*
* Template Name: Home Page
*/
get_header();
?>

<!-- banner start -->
<!-- ================ -->
<div class="banner clearfix"> 
	<!-- slideshow start -->
	<!-- ================ -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
		</ol>
		<!-- Wrapper for slides -->
		
		<div class="carousel-inner" role="listbox">
			<?php 
			  $args = array(
				'post_type'=> 'slider',
				'order'    => 'DESC'
				);              

				$the_query = new WP_Query( $args );
				if($the_query->have_posts() ) { $i = 1;
					while ( $the_query->have_posts() ) {
						$the_query->the_post(); ?> 
						<div class="item <?php if($i == 1){ echo 'active'; } ?>">
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" width="100%"/>
						</div>
			<?php 		$i++;
					} wp_reset_postdata();
				}
			?>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<!-- slideshow end -->
</div>
<!-- banner end -->

<div class="clearfix"></div>
<!-- section start -->
<div class="why-sec"> 
	<div class="container"> 
		<div class="row">
			<h2>Why Use Right Advice</h2>
			
			<?php
			if( have_rows('why_use_right_advice') ):
				while ( have_rows('why_use_right_advice') ) : the_row(); ?>

					<div class="col-md-4 col-sm-4 col-xs-12 why">
						<img src="<?=the_sub_field('icon');?>">
						<h2><?php the_sub_field('title'); ?></h2>
						<p><?php the_sub_field('content'); ?></p>
					</div>

			<?php endwhile;
			else :
			endif;
			?>
		</div>
	</div>
</div>
<!-- section end -->

<div class="counting-sec"> 
	
	<?php
	if( have_rows('counter') ): $bg = 1;
		while ( have_rows('counter') ) : the_row(); ?>

			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-sm counting ctg-bg<?php if($bg > 1){echo $bg;}?>">
				<h2><span class="count"><?php the_sub_field('number'); ?></span></h2>
				<p><?php the_sub_field('title'); ?></p>
			</div>

	<?php $bg++; endwhile;
	else :
	endif;
	?>

</div>

<!-- section start -->
<div class="latest-sec"> 
	<div class="latest-pic"><img src="<?=bloginfo('template_url')?>/images/hospital.jpg"> </div>

<div class="legal-sec" style="text-align: center;">
<h2 style="margin-top: 136px; color:#fff;"> Lawyers Directory </h2>
<p style="margin-bottom:20px; color:#fff;"> SEARCH FOR LAW FIRM AND LAWYERS ON WORLD WIDE BASIS </p>
<a style="color:#000; background:#fff; border:2px solid #ccc; padding:6px 10px; border-radius:4px; text-decoration:none;" href="http://curedincurable.com/rightadvice/lawyers/"> FIND A LAWYER </a>
</div>


	<div class="legal-sec" style="display:none;">
		<div class="legal-hd">LATEST LEGAL BLOGS</div>
		<?php 
		$args = array('post_type' => 'post', 'category' => '1', 'order' => 'DESC', 'posts_per_page'=> '5',);
		$posts = new WP_QUERY($args);
		while ($posts->have_posts()){ $posts->the_post();
		?>
		<div class="legal">
			<img src="<?=bloginfo('template_url')?>/images/question_icon.png"> 
			<h2><?=the_title()?></h2>
			<span><a href="<?=the_permalink()?>">Read More</a></span>
		</div>

		<?php }?>
	</div>
</div>

<div class="why-sec"> 
	<div class="container">
    	<div class="row">
			<h2>Find Lawyers by Legal Areas</h2>
			
			<?php 
			  $args = array(
				'post_type'=> 'specialty',
				'posts_per_page'=> '12',
				'order'    => 'DESC'
				);              

				$the_query = new WP_Query( $args );
				if($the_query->have_posts() ) { $i = 1;
					while ( $the_query->have_posts() ) {
						$the_query->the_post(); ?> 
						<div class="col-md-4">
							<div class="area">
								<a href="lawyers?cid=<?=base64_encode(get_the_title())?>"><?=the_title()?></a>
							</div>
						</div>
			<?php 		$i++;
					} wp_reset_postdata();
				}
			?>
		</div>

		<div class="row text-center">
			<a href="http://curedincurable.com/rightadvice/lawyers/" class="lawerbtn">View All Lawyers</a>
		</div>
    </div>
</div>

<div class="why-sec" style="display:none;"> 
	<div class="container"> 
    	<div class="row">
            <h2>Latest News</h2>
            <?php 
			$args = array('post_type' => 'all_news', 'posts_per_page'=> '12', 'order'    => 'DESC');
			$posts = new WP_QUERY($args);
			while ($posts->have_posts()){ $posts->the_post();
			?>
			<div class="col-md-4 why tal">
            	<a href="<?=the_permalink()?>"><?=the_post_thumbnail()?>
            	<h2><?=the_title()?></h2></a>
                <h4><?=get_the_date('d F, Y',$post->ID)?></h4>
                <p><?=the_excerpt(10)?></p>
            </div>
			<?php }?>
           
        </div>
    </div>
</div>
 


<?php get_footer();?>
<script>
		
$('.count').each(function () {
	$(this).prop('Counter',0).animate({
		Counter: $(this).text()
	}, {
		duration: 4000,
		easing: 'swing',
		step: function (now) {
			$(this).text(Math.ceil(now));
		}
	});
});

</script> 