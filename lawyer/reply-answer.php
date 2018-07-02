<?php include('lawyer-header.php');?>
<?php 
if(isset($_GET['qid']))
{
	$qid = $_GET['qid'];
	$query = mysql_query("select * from ra_question where lawyer_id='".$_SESSION['lawyerID']."' and id='".$qid."'") or die(mysql_error());
	
	if($query)
	{
		$result = mysql_fetch_assoc($query);
		$qr = mysql_query("select full_name from ra_front_users where id='".$result['client_id']."'" ) or die(mysql_error()); 
		$client = mysql_fetch_assoc($qr);
		
		$ans = mysql_query("select * from ra_lawyer_answer where qid = '$qid' AND lawyer_id = '".$_SESSION['lawyerID']."' ");
		if($ans)
		{
			$answer = mysql_fetch_assoc($ans);
		}
	}	
}
?>

<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<i class="fa fa-home pr-10"></i><a href="../" rel="nofollow">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="dashboard">Dashboard</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="respond-to-question">Respond to Question</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;View / Reply
		</ol>
	</div>
</div>

<article class="page-wrapper padt">
	<div class="entry-content-wrapper clearfix">
		<div class="entry-content"  itemprop="text" >
			<div id="profile-account2" class="bootstrap-wrapper around-separetor">
				<div class="row margin-top-10">
					<?php include("lawyer-sidebar.php");?>
					<!-- BEGIN PROFILE CONTENT -->

					<div class="col-md-9 col-sm-9 col-xs-12">
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
					<div class="profile-content">
						<div class="portlet row light">
							<div class="portlet-body">
								<div class="tab-content">

									<div class="tab-pane active" id="tab_1_1">
		
		<form method="post" action="lawyer_ajax.php" enctype="multipart/form-data" style="margin-top:0;">
			<input name="qid" type="hidden" value="<?=$result['id']?>"/>			
			<input name="lawyer_id" type="hidden" value="<?=$_SESSION['lawyerID']?>"/>			
			<input name="client_id" type="hidden" value="<?=$result['client_id']?>"/>			
			<div class="feddra1">

				<div class="col-md-6 col-sm-6 col-xs-12 revname"><?=$client['full_name']?></div>
				<div class="col-md-6 col-sm-6 col-xs-12 replydate"><?=date('d F Y | h:i A',strtotime($result['added_date']))?> </div>
			</div>
<div  style="clear: both;"></div>
			
			<div class="form-group">
				<label class="replyte"> Subject : </label>
				<?=$result['subject']?>
			</div>
			
			<div class="form-group">
				<label class="replyte"> Question : </label>
				<?=$result['content']?>
			</div>
			
			<div class="form-group">
				<label class="replyte"> Reply : </label>
				<?php if($answer['reply'] != ''){ echo $answer['reply']; }else{ ?>
				<textarea required cols="100" id="editor1" name="reply" rows="10" placeholder="Enter your reply here"></textarea>
				<?php } ?>
			</div>
			
			<div class="form-group">
				<?php if($answer['attachment'] != ''){ ?>
				<label class="replyte"> My Attachments </label>  
				<?php 
					$att = explode('^',$answer['attachment']);
					$dnames = explode('^',$answer['document_names']);
					for($i=0; $i<count($att); $i++)
					{
						echo "<a class='btn btn-info'  href='files/".$dnames[$i]."' target='_blank'>".$att[$i]."</a> &nbsp;&nbsp;";
					}
				}else if($answer['reply'] == ''){
				?>
				<label class="replyte"> Upload Files : </label>
				<input name="upload[]" type="file" class="form-control" multiple="multiple" />
				<div><p>To upload multiple documents, Choose documents with ctrl button</p></div>
				<?php } ?>
				
			</div>
			
			
			<?php if($result['documents'] != ''){?>
			<div class="form-group">
				<label class="replyte"> Client Attachments </label>  
				<?php 
					$att = explode('^',$result['documents']);
					$docnames = explode('^',$result['document_names']);
					for($i=0; $i<count($att); $i++)
					{
						echo "<a class='btn btn-info'  href='files/".$docnames[$i]."' target='_blank'>".$att[$i]."</a> &nbsp;&nbsp;";
					}
				?>
			</div>
			<?php } ?>
			<?php if($answer['reply'] == ''){?>
				
			<div class="margiv-top-10">
				<button type="submit" name="lawyer_reply" class="btn-new btn-custom">Submit <span class="glyphicon glyphicon-send"></span></button>
			</div>
			<?php }?>
		
		</form>
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

<?php include('lawyer-footer.php');?>

											