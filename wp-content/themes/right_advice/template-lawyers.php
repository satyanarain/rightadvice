<?php 
/*
* Template Name: Lawyers Page
*/
get_header();

function formatData($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?> 
<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<?=get_breadcrumb()?>
		</ol>
	</div>
</div>

  <!-- Css Files-->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"> 
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">

  <!-- JS Files -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

<style>
.pagination > li:first-child > a, .pagination > li:first-child > span {
    margin-left: 0;
    border-top-left-radius: 40px;
    border-bottom-left-radius: 40px;
    border-top-right-radius: 40px;
    border-bottom-right-radius: 40px;
}
.pagination > li:last-child > a, .pagination > li:last-child > span {
    border-top-left-radius: 40px;
    border-bottom-left-radius: 40px;
    border-top-right-radius: 40px;
    border-bottom-right-radius: 40px;
}
.pagination > li > a, .pagination > li > span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 26px;
    color: #fff;
    text-decoration: none;
    background-color: #09afdf;
    border: 1px solid #ddd;
    border-radius: 50%;
    height: 40px;
    width: 40px;
    text-align: center;
    
}
</style> 	

<div class="banner border-clear tebg">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ">
				<?php $post = get_post(89); echo $post->post_content; ?>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>
 

 
<div class="page-wrapper padt"> 
	<div class="container">
    	<div class="row">
			<div class="col-md-3">
				<div class="upsell">
					<form class="form-group" method="post" action="" style="margin-top:0;">
						<h4><center>Find A Lawyer</center></h4>
						
						<label class="m-t-10">Expertise Area</label>
						<div style="clear: both;"></div>
						<input type="text" class="form-control" id="tokenfield" width="100%" />

						<label class="m-t-10">Lawyer Name</label>		
			                        <input type="text" name="lawyername" id="lawyername" class="form-control court-law"/>

						<label class="m-t-10 m-b-10">Language</label>
						<select name="language" class="form-control court-law" id="language"> 
                            				<option value="">--Select--</option>
							<?php 
								$args = array('post_type' => 'lawyer_languages', 'posts_per_page' => -1);
								$posts = new WP_QUERY($args);
								while ($posts->have_posts()){ $posts->the_post();
							?>
							<option value="<?=get_the_title()?>"><?=get_the_title()?></option>
							<?php }?>
						</select>

						<label class="m-t-10">Location</label>
                        <input type="text" name="location" id="location" class="form-control court-law"/>

						
						<!--
						<label class="m-t-10">Nationality</label>
                        
						
						<select name="nationality" id="nationality" class="form-control">
							<option value="">Select Nationality</option>
							<?php 
							$args = array('post_type' => 'nationality', 'posts_per_page' => -1);
							$posts = new WP_Query($args);
							while ($posts->have_posts()){
								$posts->the_post();
								$nationality = get_the_title();
							?>
							<option value="<?=$nationality?>"><?=$nationality?></option>
							<?php } ?>
						</select>
						
						-->
						
						<br>
						<button type="button" class="btnall" onclick="applyFilter()">Apply Filter</button>

                    </form> 

				</div>
			</div>

			<div class="col-md-6">
				<div class="col-md-12 masonry-grid-item" style="padding:0;">
				<?php 
					global $wpdb;
					global $queryflag;
					if(isset($_GET['cid']) && $_GET['cid'] != '')
					{
						$cid = base64_decode($_GET['cid']);
						$post = $wpdb->get_results("select * from ra_lawyers where Specialities_arr like '%$cid%' AND status='1'  AND email_confirm='1' order by id DESC"); 
						//echo("Query: " . "select * from ra_lawyers where Specialities_arr like '%$cid%' AND status='1'");
						$queryflag = 1;
					}
					else
					{
						$post = $wpdb->get_results("select * from ra_lawyers where status ='1' AND email_confirm='1' order by id DESC");
						$queryflag = 0;
					}
					$total_lawyer = count($post);
				?>
				<div style="display:none;margin: 0 40%;" id="loader"><img src="<?bloginfo('template_url')?>/images/loading.gif" height="100px" /></div>
				<div id="prev">
					
					<?php if(isset($_GET['cid']) && $_GET['cid'] != ''){?>
					<h4 class="layhd"> (<?=$total_lawyer?>) Lawyers found in <?=base64_decode($_GET['cid'])?> </h4>
					<?php }else{?>
					<h4 class="layhd"> Lawyers (<?=$total_lawyer?>) </h4>
					<?php }?>
					<?php 
						/*=======================================Pagination Start======================================*/
							
							$tbl_name="ra_lawyers";	
							$adjacents = 3;
							$query = "SELECT COUNT(*) as num FROM $tbl_name where status='1' ";
							$total_pages = mysql_fetch_array(mysql_query($query));
							$total_pages = $total_pages[num];
							
							$pref = "SELECT * FROM $tbl_name where status='1' AND prefered='1' ";
							$pref_pages = mysql_num_rows(mysql_query($query));
							//echo $pref_pages = $pref_pages[num];
							
							if($pref_pages > 50)
							{
								$total_pages = $total_pages/2;
							}
							
							$targetpage = get_the_permalink(89); 
							$limit = 50; 
							
							$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
							$page = substr($url, strrpos($url, '/') + 1);
							
							if($page != '' && is_numeric($page))
								$start = ($page - 1) * $limit; 			
							else
								$start = 0;								
							
							if ($page == 0) $page = 1;					
							$prev = $page - 1;							
							$next = $page + 1;							
							$lastpage = ceil($total_pages/$limit);		
							$lpm1 = $lastpage - 1;						
							
							$pagination = "";
							if($lastpage > 1)
							{	
								$pagination .= "<nav class='text-center naviga1'><ul class='pagination'>";
								//previous button
								if ($page > 1) 
									$pagination.= "<li class=''><a aria-label='Previous' href='".$targetpage."?page=".$prev."'><i class='fa fa-angle-left'></i></a></li>";
								else
									$pagination.= '<li><span class="disabled"><i class="fa fa-angle-left"></i></span></li>';	
								
								//pages	
								if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
								{	
									for ($counter = 1; $counter <= $lastpage; $counter++)
									{
										if ($counter == $page)
											$pagination.= '<li><span class="current">'.$counter.'</span></li>';
										else
											$pagination.= '<li><a href="'.$targetpage.'?page='.$counter.'">'.$counter.'</a></li>';					
									}
								}
								elseif($lastpage > 5 + ($adjacents * 2))	
								{
									if($page < 1 + ($adjacents * 2))		
									{
										for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
										{
											if ($counter == $page)
												$pagination.= '<li><span class="current">'.$counter.'</span></li>';
											else
												$pagination.= '<li><a href="'.$targetpage.'?page='.$counter.'">'.$counter.'</a></li>';					
										}
										$pagination.= "...";
										$pagination.= '<li><a href="'.$targetpage.'?page='.$lpm1.'">'.$lpm1.'</a></li>';
										$pagination.= '<li><a href="'.$targetpage.'?page='.$lastpage.'">'.$lastpage.'</a></li>';		
									}
									elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
									{
										$pagination.= '<li><a href="'.$targetpage.'?page=1">1</a></li>';
										$pagination.= '<li><a href="'.$targetpage.'?page=2">2</a></li>';
										$pagination.= "...";
										for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
										{
											if ($counter == $page)
												$pagination.= '<li><span class="current">'.$counter.'</span></li>';
											else
												$pagination.= '<li><a href="'.$targetpage.'?page='.$counter.'">'.$counter.'</a></li>';					
										}
										$pagination.= "...";
										$pagination.= '<li><a href="'.$targetpage.'?page='.$lpm1.'">'.$lpm1.'</a></li>';
										$pagination.= '<li><a href="'.$targetpage.'?page='.$lastpage.'">'.$lastpage.'</a></li>';		
									}
									else
									{
										$pagination.= '<li><a href="'.$targetpage.'?page=1">1</a></li>';
										$pagination.= '<li><a href="'.$targetpage.'?page=2">2</a></li>';
										$pagination.= "...";
										for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
										{
											if ($counter == $page)
												$pagination.= '<li><span class="current">'.$counter.'</span>';
											else
												$pagination.= '<li><a href="'.$targetpage.'?page='.$counter.'">'.$counter.'</a></li>';					
										}
									}
								}
								
								//next button
								if ($page < $counter - 1) 
									$pagination.= '<li><a href="'.$targetpage.'?page='.$next.'" aria-label="Next"><i class="fa fa-angle-right"></i></a></li>';
								else
									$pagination.= '<li><span class="disabled"><i class="fa fa-angle-right"></i></span></li>';
								$pagination.= "</ul></nav>\n";		
							}
							
				/*=======================================Pagination End======================================*/
				
					
					
						if($post)
						{
						if ($queryflag == 1)
						{
							$preferred = $wpdb->get_results("select * from ra_lawyers where Specialities_arr like '%$cid%' AND status='1'  AND email_confirm='1' AND preferred='1' order by full_name ASC");
							//echo("Query 2: " . "select * from ra_lawyers where Specialities_arr like '%$cid%' AND status='1'  AND email_confirm='1' AND preferred='1' order by full_name ASC LIMIT $start, $limit");
						}
						else {
							$preferred = $wpdb->get_results("select * from ra_lawyers where status ='1' AND email_confirm='1' AND preferred='1' order by full_name ASC LIMIT $start, $limit");
							}
							
							foreach($preferred as $top)
							{
								$rat = $wpdb->get_results("select rating from ra_lawyer_answer where lawyer_id ='".$top->id."'");
								$rating = '0';
								foreach($rat as $ratings){
									$rating = $rating + $ratings->rating;
								}	
								$rats = $rating / count($rat);
								
								
					?>
								<div class="listing-item bordered light-gray-bg mb-20">
									<div class="row grid-space-0">
										<div class="col-sm-4 col-md-3 col-lg-3 prof1">
											<?php if($top->profile_image != ''){?>
											<a href="lawyer-profile?lid=<?=base64_encode($top->id)?>"><img src="http://35.154.128.159:83/lawyer/profile_pics/<?=$top->profile_image?>" alt="<?=$top->full_name?>"></a>
											<?php }else{?>
											<a href="lawyer-profile?lid=<?=base64_encode($top->id)?>"><img src="<?=bloginfo('template_url')?>/images/no-image.jpg" alt="<?=$top->full_name?>"></a>
											<?php }?>
											<div class="clear"></div>
											
										</div>

										<div class="col-sm-8 col-md-9 col-lg-9">
											<div class="body">
												<h3 class="margin-clear"> <a href="lawyer-profile?lid=<?=base64_encode($top->id)?>"><?=$top->full_name?> </a> </h3>
												<p>
													<?php for($i=0; $i<round($rats); $i++){?>
													<i class="fa fa-star text-default"></i>
													<?php }for($j=0; $j<5-round($rats); $j++){?>
													<i class="fa fa-star"></i>
													<?php } ?>
												</p>

												<p class="small"><span><i class="fa fa-map-marker"></i></span> 
													 <?=$lawyer->s_city.', '.$lawyer->s_country?>
												</p>
												<?php if ($top->preferred == 1) { ?>
												<p style="position: absolute;top: -6px;right: 0;"> <img src="<?php bloginfo('template_directory')?>/images/prefered.png"> </p>
												<?php } ?>
													
											</div>
										</div>

										<div class="col-sm-12 col-md-12 col-lg-12">
											<div class="ltag">
											<?php 
											if($top->Specialities_arr != ''){
												$specialty = explode('^',$top->Specialities_arr);
												for($i=0; $i<count($specialty); $i++){
											?>
												<a style="text-decoration:none;"><?=$specialty[$i]?></a> 
											<?php }}?>
											</div>
											
											<div class="elements-list clearfix">	
												<a href="lawyer-profile?lid=<?=base64_encode($top->id)?>" class="pull-right btn btn-sm btn-default-transparent btn-animated">
													View Profile <i class="fa fa-user"></i></a>
											</div>
										</div>
									</div>
								</div>
					
					<?php 	}
							
							if ($queryflag == 1)
						{
							$post = $wpdb->get_results("select * from ra_lawyers where Specialities_arr like '%$cid%' AND status='1'  AND email_confirm='1' AND preferred='0' order by full_name ASC");
							//echo("Query 3 : " . "select * from ra_lawyers where Specialities_arr like '%$cid%' AND status='1'  AND email_confirm='1' AND preferred='0' order by full_name ASC LIMIT $start, $limit");
						}
						else {
							$post = $wpdb->get_results("select * from ra_lawyers where status ='1' AND email_confirm='1' AND preferred='0' order by full_name ASC LIMIT $start, $limit");
						}
						
							foreach($post as $lawyer){
							$rat = $wpdb->get_results("select rating from ra_lawyer_answer where lawyer_id ='".$lawyer->id."'");
							$rating = '0';
							foreach($rat as $ratings){
								$rating = $rating + $ratings->rating;
							}	
							$rats = $rating / count($rat);
							
					?>
					<div class="listing-item bordered light-gray-bg mb-20">
						<div class="row grid-space-0">
							<div class="col-sm-4 col-md-3 col-lg-3 prof1">
								<?php if($lawyer->profile_image != ''){?>
								<a href="lawyer-profile?lid=<?=base64_encode($lawyer->id)?>"><img src="http://35.154.128.159:83/lawyer/profile_pics/<?=$lawyer->profile_image?>" alt="<?=$lawyer->full_name?>"></a>
								<?php }else{?>
								<a href="lawyer-profile?lid=<?=base64_encode($lawyer->id)?>"><img src="<?=bloginfo('template_url')?>/images/no-image.jpg" alt="<?=$lawyer->full_name?>"></a>
								<?php }?>
								<div class="clear"></div>
								
							</div>

							<div class="col-sm-8 col-md-9 col-lg-9">
								<div class="body">
									<h3 class="margin-clear"> <a href="lawyer-profile?lid=<?=base64_encode($lawyer->id)?>"><?=$lawyer->full_name?> </a></h3>
									<p>
										<?php for($i=0; $i<round($rats); $i++){?>
										<i class="fa fa-star text-default"></i>
										<?php }for($j=0; $j<5-round($rats); $j++){?>
										<i class="fa fa-star"></i>
										<?php } ?>
									</p>

									<p class="small"><span><i class="fa fa-map-marker"></i></span> 
										 <?=$lawyer->s_city.', '.$lawyer->s_country?>
									</p>
								</div>
							</div>

							<div class="col-sm-12 col-md-12 col-lg-12">
								<div class="ltag">
								<?php 
								if($lawyer->Specialities_arr != ''){
									$specialty = explode('^',$lawyer->Specialities_arr);
									for($i=0; $i<count($specialty); $i++){
								?>
									<a style="text-decoration:none;"><?=$specialty[$i]?></a> 
								<?php }}?>
								</div>
								
								<div class="elements-list clearfix">	
									<a href="lawyer-profile?lid=<?=base64_encode($lawyer->id)?>" class="pull-right btn btn-sm btn-default-transparent btn-animated">
										View Profile <i class="fa fa-user"></i></a>
								</div>
							</div>
						</div>
					</div>
					<?php }}?>
				</div>
				<div id="latest"></div>
				</div>
				
				<?=$pagination?>
				<!--nav class="text-center">
					<ul class="pagination">
						<li><a href="#" aria-label="Previous"><i class="fa fa-angle-left"></i></a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#" aria-label="Next"><i class="fa fa-angle-right"></i></a></li>
					</ul>
				</nav-->
			</div>


			<div class="col-md-3">
				<?=get_sidebar()?>
			</div>
		</div>
	</div>
<script type="text/javascript">
  $('#tokenfield').tokenfield({
    autocomplete: {
      source: function (request, response) {
          jQuery.get("<?=bloginfo('template_url')?>/token_input.php", {
              query: request.term
          }, function (data) {
              data = $.parseJSON(data);
              response(data);
          });
      },
      delay: 100
    },
    showAutocompleteOnFocus: true
  });
</script>
<script>
function applyFilter(){
	var tokenfield = $('#tokenfield').val();
	var location = $('#location').val();
	var language = $('#language').val();
	var nationality = $('#nationality').val();
	var lawyername = $('#lawyername').val();
	//alert(tokenfield+" "+location+" "+language+" "+nationality);
	jQuery('#loader').show();
	jQuery.ajax({
		url:'<?=bloginfo('template_url')?>/ajax.php',
		type:'post',
		data:{
			tokenfield:tokenfield,
			location:location,
			language:language,
			nationality:nationality,
			lawyername:lawyername,
			action:'ajax_filter'
		},
		success:function(response){
			//alert(response);
			jQuery('#loader').hide();
			jQuery('#prev').hide();
			jQuery('#latest').html(response);
			jQuery('#latest').show();
			
		}
	});
}
</script>
<?php get_footer(); ?>
