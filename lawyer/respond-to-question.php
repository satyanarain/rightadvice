<?php 
	include('lawyer-header.php');
	$query = mysql_query("select * from ra_question where lawyer_id='".$_SESSION['lawyerID']."' order by id desc");
	//$query = mysql_query("select * from ra_question where status='0' AND lawyer_id='".$_SESSION['lawyerID']."' order by id desc");
	//$query1 = mysql_query("select * from ra_question where status='1' AND lawyer_id='".$_SESSION['lawyerID']."' order by id desc");
												
												
?>

<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<i class="fa fa-home pr-10"></i><a href="../" rel="nofollow">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="dashboard">Dashboard</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;Respond to Questions
		</ol>
	</div>
</div>


<article class='page-wrapper padt'>
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
								<!--div class="portlet-title tabbable-line clearfix">
									<ul class="nav nav-tabs">
										<li class="active">
										  <a href="#tab_1_1" data-toggle="tab">Unanswered Question (<?=mysql_num_rows($query)?>)</a>
										</li>
										<li class="">
										  <a href="#tab_1_3" data-toggle="tab">Answered Question (<?=mysql_num_rows($query1)?>)</a>
										</li>
									</ul>
								</div-->
								
								<div class="portlet-body">
									<div class="tab-content">
										<div class="tab-pane active" id="tab_1_1">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th><strong>S. No.</strong></th>
														<th><strong>Asked By</strong></th>
														<th><strong>Subject</strong></th>
														<th><strong>Date</strong></th>
														<th><strong>Status</strong></th>
														<th><strong>Action</strong></th>
													</tr>
												</thead>
												<tbody>
												<?php $no = 1;
												if(mysql_num_rows($query) > 0){
												while($unread = mysql_fetch_assoc($query)){
													$qr = mysql_query("select full_name from ra_front_users where email='".$unread['client_email']."' ");
													$uname = mysql_fetch_assoc($qr);
												?>
													<tr>
														<td align="center"><?=$no++?>.</td>
														<td><?=$uname['full_name']?></td>
														<td><?=$unread['subject']?></td>
														<td><?=date('d F Y',strtotime($unread['added_date']))?></td>
														<td>
															<?php if($unread['status'] == 1){ ?>
															<p class="label label-success">Answered</p>
															<?php }if($unread['status'] == 0){ ?>
															<p class="label label-danger">Unanswered</p>
															<?php } ?>
														</td>
														<td>
															<?php if($unread['status'] == 1){ ?>
															<a title="View" href="reply-answer?qid=<?=$unread['id']?>" class="btn btn-info"> <i class="fa fa-eye"></i></a>
															<?php }if($unread['status'] == 0){ ?>
															<a title="Reply" href="reply-answer?qid=<?=$unread['id']?>" class="btn btn-info"> <i class="fa fa-reply"></i></a>
															<?php } ?>
														</td>
													</tr>
												<?php }}else{ echo "<tr><td colspan='5'>No data found</td></tr>"; }?>
												</tbody>
											</table>
										</div>
										
										<!--div class="tab-pane" id="tab_1_3">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th><strong>S. No.</strong></th>
														<th><strong>Asked By</strong></th>
														<th><strong>Subject</strong></th>
														<th><strong>Date</strong></th>
														<th><strong>View</strong></th>
													</tr>
												</thead>
												<tbody>
												<?php $no = 1;
												if(mysql_num_rows($query1) > 0){
												while($unread = mysql_fetch_assoc($query1)){
													$qr = mysql_query("select full_name from ra_front_users where email='".$unread['client_email']."' ");
													$uname = mysql_fetch_assoc($qr);
												?>
													<tr>
														<td align="center"><?=$no++?>.</td>
														<td><?=$uname['full_name']?></td>
														<td><?=$unread['subject']?></td>
														<td><?=date('d F Y',strtotime($unread['added_date']))?></td>
														<td><a href="reply-answer?qid=<?=$unread['id']?>" class="btn btn-info"> <i class="fa fa-eye"></i></td>
													</tr>
												<?php }}else{ echo "<tr><td colspan='5'>No data found</td></tr>"; }?>
												</tbody>
											</table>
										</div-->

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