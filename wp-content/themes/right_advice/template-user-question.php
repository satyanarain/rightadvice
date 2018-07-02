<?php 
/*
* Template Name: ASK A Question Page
*/
session_start();
ob_start(); 
 get_header();
if(isset($_GET['qid']) )
{
	$lawyer_id = base64_decode($_GET['qid']);
}
?>

<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<?=get_breadcrumb()?>
		</ol>
	</div>
</div>

<div class="clearfix"></div>

<article class='page-wrapper padt'>
	<div class="entry-content-wrapper clearfix">
		<div class="entry-content"  itemprop="text" >
			<div id="profile-account2" class="bootstrap-wrapper around-separetor">
				<div class="row margin-top-10">
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="content">
							<div class="title-content">
								<div class="cposttype-title titlh5">
								<h5 style="font-weight: 700;font-size: 16px;color: #333; margin: 0;"> Ask A Question </h5>
								</div>
							</div>

							<div class="conten-desc" style="padding-top: 0;">
							<form style="margin: 0;" action="<?=bloginfo('template_url')?>/ajax.php" method="post" enctype="multipart/form-data">

								<?php if(isset($_SESSION['reg_error']) && $_SESSION['reg_error'] != ''){?>
								<div class="alert alert-danger col-md-12 data-dismisable"> 
									<i class="fa fa-info"></i>
									<?=$_SESSION['reg_error']?> 
									<?php unset($_SESSION['reg_error']);?>
								</div>
								<?php } else if(isset($_SESSION['reg_succ']) && $_SESSION['reg_succ'] != ''){?>
								<div class="alert alert-success col-md-12 data-dismisable"> 
									<i class="glyphicon glyphicon-thumbs-up"></i>
									<?=$_SESSION['reg_succ']?> 
									<?php unset($_SESSION['reg_succ']);?>
								</div>
								<?php } ?>
										
								<input type="hidden" name="lawyer_id" value="<?=$lawyer_id?>" />
								<input type="hidden" name="client_email" value="<?=$_SESSION['userEmail']?>" />
								<input type="hidden" name="client_id" value="<?=$_SESSION['userID']?>" />
								<div class="form-group">
									<span class="stitl"> Subject </span>
									<div class="col-md-12 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input name="subject" id="subject" placeholder="Your Subject" class="form-control" type="text" required>
										</div>
									</div>
								</div>
										
										
								<div class="form-group">
									<span class="stitl"> Question </span>
									<div class="col-md-12 inputGroupContainer">
										<textarea cols="100" id="editor1" name="editor1" rows="10" placeholder="Enter your query here" required></textarea> 
									</div>
								</div>
										
								<div class="form-group">
										<span class="stitl"> Documents Upload </span> 
									<div class="col-md-12 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
											<input name="upload[]" type="file" class="form-control" multiple="multiple" />
										</div>
										<div><p>To upload multiple documents, Choose documents with ctrl button</p></div>
									</div>
								</div>
								
								<div class="form-group">
								  <div class="col-md-12 text-center">
									<button type="submit" name="add_question" class="btn-new btn-custom" > SUBMIT <span class="glyphicon glyphicon-send"></span></button>
								  </div>
								</div>
							</form>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<?=get_sidebar()?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>



<?php get_footer();?>