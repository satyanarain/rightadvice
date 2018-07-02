<?php include('user-header.php');?>
<?php 
if(isset($_GET['qid']))
{
	$qid = $_GET['qid'];
	$query = mysql_query("select ra_lawyer_answer.*, ra_question.*, ra_lawyers.full_name, ra_lawyer_answer.document_names as ans_docs, ra_question.document_names as ques_docs, ra_question.added_date as ques_date
						from ra_lawyer_answer
						join ra_question on ra_question.id = ra_lawyer_answer.qid
						join ra_lawyers on ra_lawyers.id = ra_lawyer_answer.lawyer_id
						where ra_lawyer_answer.client_id='".$_SESSION['userID']."' and qid='".$qid."'") or die(mysql_error());
	if(mysql_num_rows($query) > 0){
		$result = mysql_fetch_assoc($query);
	}
	else{
		$qr = mysql_query("select *, ra_question.added_date as question_date from ra_question where id='".$qid."'" ) or die(mysql_error()); 
		$lawyer = mysql_fetch_assoc($qr); 
		//print_r($lawyer);
	}
}
?>

<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<i class="fa fa-home pr-10"></i><a href="../" rel="nofollow">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="dashboard">Dashboard</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="all-questions">View Questions and Answers</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;View Details
		</ol>
	</div>
</div>


<article class='page-wrapper padt'>
	<div class="entry-content-wrapper clearfix">
		<div class="entry-content"  itemprop="text" >
			<div id="profile-account2" class="bootstrap-wrapper around-separetor">
				<div class="row margin-top-10">
					<?php include("user-sidebar.php");?>
					<!-- BEGIN PROFILE CONTENT -->

					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="profile-content">
							<div class="portlet row light">
					
								<div class="portlet-body">
									<div class="tab-content">
										<div class="tab-pane active" id="tab_1_1">
									
			<div class="feddra1">
				<div class="col-md-6 col-sm-6 col-xs-12 revname"><?=$result['full_name']?></div> 
				<?
				$questdate1 = $result['ques_date'];
				$questdate2 = $lawyer['question_date'];
				if (strlen($questdate1) > 0)
					$questdate = $questdate1;
				else
					$questdate = $questdate2;
				?>
				<div class="col-md-6 col-sm-6 col-xs-12 replydate"><?=date('d F Y | h:i A',strtotime($questdate))?></div> 
			</div>
			<div style="clear: both;"></div>

		<?php if(mysql_num_rows($query) > 0){ ?>
			<div class="form-group">
				<label class="replyte"> Subject :  </label>
				<?=$result['subject']?>
			</div>
			
			<div class="form-group">
				<label class="replyte"> Question :  </label>
				<?=$result['content']?>
			</div>
			
			<div class="form-group">
				<label class="replyte"> Reply : </label>
				<?=$result['reply']?>
			</div>
		<?php }else { ?>	
			<div class="form-group">
				<label class="replyte"> Subject :  </label>
				<?=$lawyer['subject']?>
			</div>
			
			<div class="form-group">
				<label class="replyte"> Question :  </label>
				<?=$lawyer['content']?>
			</div>
			
			<div class="form-group">
				<label class="replyte"> Reply : </label>
				<p><i>Awaiting reply from Lawyer.</i></p>
			</div>
			<?php if($lawyer['documents'] != ''){?>
			
		<?php }} ?>
			
			<?php if($lawyer['documents'] != ''){?>
			<div class="form-group">
				<label class="replyte">My Attachments</label>  
				<?php 
					$att = explode('^',$lawyer['documents']);
					$docnames = explode('^',$lawyer['document_names']);					
					for($i=0; $i<count($att); $i++)
					{
						echo "<a class='btn btn-info'  href='../lawyer/files/".$docnames[$i]."' target='_blank'>".$att[$i]."</a> &nbsp;&nbsp;";
					}
				?>
			</div>
			<?php } if($result['attachment'] != ''){?>
			<div class="form-group">
				<label class="replyte">Lawyer Attachments</label>  
				<?php 
					$att = explode('^',$result['attachment']);
					$docnames = explode('^',$result['ans_docs']);
					for($i=0; $i<count($att); $i++)
					{
						echo "<a class='btn btn-info'  href='../lawyer/files/".$docnames[$i]."' target='_blanck'>".$att[$i]."</a> &nbsp;&nbsp;";
					}
				?>
			</div>
			<?php } ?>
			
			
			<?php if(mysql_num_rows($query) > 0){ ?>
		
			<form action="" method="post" enctype="multipart/form-data">
				<?php if($result['feedback'] != ''){?>	
				<div class="feddra1"> <h4 style="margin:0; text-align:center;"> Your Feedback </h4> </div>
				<?php }else{ ?>
				<div class="feddra1"> <h4 style="margin:0; text-align:center;"> Please Give Your Feedback </h4> </div>
				
				<?php } ?>
				
				<?php if($result['feedback'] != ''){?>	
				<div style="clear: both;"></div>
				<div class="form-group">
					<label class="replyte"> Rating : </label>
					<ul style="list-style:none;">
						<?php for($i=0; $i<$result['rating']; $i++){?>
						<li><img src="yellow-star.png"  style="height: 25px;" /></i>
						<?php }for($j=0; $j< 5-$result['rating']; $j++){?>
						<li><img src="blanck-star.png" style="height: 20px;margin: 3px 0px;" /><li>
						<?php }?>
					</ul>
				</div>
				<div class="form-group">
					<label class="replyte"> Feedback : </label>
					<?=$result['feedback']?>
				</div>
				
				
				<?php }else{?>
				<div class="form-group">
					<div class="cont" style="">
					
						<label class="replyte"> Rating : </label>
						<input id="qid" type="hidden" name="qid" value="<?=$qid?>"/>
						<input id="lawyer_id" type="hidden" name="lawyer_id" value="<?=$_SESSION['userID']?>"/>
						
						<input class="star star-5" id="star1" type="radio" name="star" value="5" />
						<label class="star star-5" for="star1"></label>
						<input class="star star-4" id="star2" type="radio" name="star" value="4"/>
						<label class="star star-4" for="star2"></label>
						<input class="star star-3" id="star3" type="radio" name="star" value="3"/>
						<label class="star star-3" for="star3"></label>
						<input class="star star-2" id="star4" type="radio" name="star" value="2"/>
						<label class="star star-2" for="star4"></label>
						<input class="star star-1" id="star5" type="radio" name="star" value="1"/>
						<label class="star star-1" for="star5"></label>
					</div>
				</div>
				<div class="form-group">
					<label class="replyte"> Feedback : </label>
					<textarea required cols="100" id="feedback" name="feedback" rows="10" placeholder="Enter your Feedback here"><?=$result['feedback']?></textarea>
				</div>
				
				<div class="margiv-top-10">
					<button type="button" name="submit_feedback" onclick="submitFeedback()" id="submit_feedback" class="btn-new btn-custom">Submit <span class="glyphicon glyphicon-send"></span></button>
				</div>
				<?php } ?>
			</form>
			<div class="alert alert-success col-md-12" style="display:none;" id="succ_msg"></div>
			<div class="alert alert-danger col-md-12" style="display:none;" id="err_msg"></div>
			<?php } ?>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</article><!--end post-entry-->
<script type="text/javascript" src="http://curedincurable.com/rightadvice/wp-content/themes/right_advice/js/ckeditor/ckeditor.js"></script>
	
<script>
	CKEDITOR.replace( 'feedback' );
</script>

<style>
@import url(http://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);

* {
  margin: 0;
  padding: 0;
  font-family: roboto;
}


.cont {
  width: 100%;
  overflow: hidden;
}


div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: left;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}

.form-group ul li {
    display: inline-block;
}
</style>
<?php include('user-footer.php');?>

											