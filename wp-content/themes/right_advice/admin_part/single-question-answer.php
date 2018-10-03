<?php 
include("admin_header.php");
if(isset($_GET['qid']) && $_GET['qid']!='')
{
	$_GET['qid'];
	$result = mysql_query("select ra_question.*, ra_lawyer_answer.*, ra_front_users.full_name, ra_lawyers.email, ra_lawyers.full_name as lname, ra_question.document_names as client_att, ra_lawyer_answer.document_names as lawyer_att
						  from ra_question 
						  left join ra_lawyer_answer on ra_lawyer_answer.qid=ra_question.id
						  left join ra_front_users on ra_front_users.id=ra_question.client_id
						  left join ra_lawyers on ra_lawyers.id=ra_question.lawyer_id
						  where ra_question.id='".$_GET['qid']."' ") or die(mysql_error());
	$ques = mysql_fetch_assoc($result);
	//print_r($ques);
	
	
}
?>
<article class='post-entry post-entry-type-page post-entry-6'>
	<div class="entry-content-wrapper clearfix">
		<div class="entry-content">
			<div id="profile-account2" class="bootstrap-wrapper around-separetor">
				<div class="row margin-top-10">
					<?php //include("lawyer-sidebar.php");?>
					<!-- BEGIN PROFILE CONTENT -->

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="profile-content">

						<div class="portlet row light">
							<div class="portlet-title tabbable-line clearfix">
								<div class="caption caption-md">
									<span class="caption-subject">Question And Answer</span>
								</div>
							</div>

							<div class="portlet-body">
								<div class="tab-content">

									<div class="tab-pane active" id="tab_1_1">
			<div  style="width: 100%;float: left;padding: 4px 0; background: #f3f3f3; margin-bottom: 10px;">						
			<div class="col-md-6 col-sm-6 col-xs-12" style="font-family: verdana;color: #333;font-size: 14px;">Client Name: <span style="color:#0077B5;"><?=$ques['full_name']?></span> <br> Lawyer Name: <span style="color:#0077B5;"> <?=$ques['lname']?></span></div>
				
				<div class="col-md-6 col-sm-6 col-xs-12" style="font-family: verdana;color:#333;font-size: 12px;text-align:right;
    padding-top: 4px;">Date: <?=date('d F Y | h:i A',strtotime($ques['added_date']))?> </div>
			</div>						
			
			<div  style="clear: both;"></div>
			
			<div class="form-group">
				<label style="font-size: 14px !important; font-family: verdana !important;font-weight: normal !important;    color: #0077B5 !important;"> Subject : </label>
				<?=$ques['subject']?>
			</div>
			
			<div class="form-group">
				<label style="font-size: 14px !important; font-family: verdana !important;font-weight: normal !important;    color: #0077B5 !important;"> Question : </label>
				<?=$ques['content']?>
			</div>
			
			<div class="form-group">
				<label style="font-size: 14px !important; font-family: verdana !important;font-weight: normal !important;    color: #0077B5 !important;"> Reply : </label>
				<?php if($ques['reply'] != ''){ echo $ques['reply']; }else{ ?>
				<p>No reply from lawyer</p>
				<?php } ?>
			</div>
			
			<div class="form-group">
				<?php if($ques['attachment'] != ''){ ?>
				<label style="font-size: 14px !important; font-family: verdana !important;font-weight: normal !important;    color: #0077B5 !important;"> Lawyer Attachments </label>  
				<?php 
					$att = explode('^',$ques['attachment']);
					$docnames = explode('^',$ques['lawyer_att']);
					for($i=0; $i<count($att); $i++)
					{
						echo "<a class='btn btn-info'  href='../../../../lawyer/files/".$docnames[$i]."' target='_blank'>".$att[$i]."</a> &nbsp;&nbsp;";
					}
				}?>
				
			</div>
			
			
			<?php if($ques['documents'] != ''){?>
			<div class="form-group">
				<label style="font-size: 14px !important; font-family: verdana !important;font-weight: normal !important;    color: #0077B5 !important;"> Client Attachments </label>  
				<?php 
					$att = explode('^',$ques['documents']);
					$docnames = explode('^',$ques['client_att']);
					for($i=0; $i<count($att); $i++)
					{
						echo "<a class='btn btn-info'  href='../../../../lawyer/files/".$docnames[$i]."' target='_blank'>".$att[$i]."</a> &nbsp;&nbsp;";
					}
				?>
			</div>
			<?php } ?>
			<?php if($ques['reply'] == ''){ ?>
				<a class="btn btn-primary" href="javascript:void(0)" onclick="sendReminderEmail('<?=$ques['email']?>','<?=$ques['full_name']?>','<?=$ques['subject']?>','<?=base64_encode($ques['content'])?>','<?=$ques['added_date']?>');">Send Reminder Email</a>
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
</article>
