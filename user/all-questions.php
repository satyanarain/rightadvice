<?php 
	include('user-header.php');
		
	$query = mysql_query("select * from ra_question where client_id='".$_SESSION['userID']."' ");
	//$query = mysql_query("select * from ra_question where status='1' AND client_id='".$_SESSION['userID']."' ");
	$query1 = mysql_query("select * from ra_question where status='0' AND client_id='".$_SESSION['userID']."' ");
																							
?>

<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<i class="fa fa-home pr-10"></i><a href="../" rel="nofollow">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="dashboard">Dashboard</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;View Questions and Answers
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
										  <a href="#tab_1_1" data-toggle="tab">Answered Question (<?=mysql_num_rows($query)?>) </a>
										</li>
										<li class="">
										  <a href="#tab_1_3" data-toggle="tab">Unanswered Question (<?=mysql_num_rows($query1)?>)</a>
										</li>
									</ul>
								</div-->
								
								<div class="portlet-body">
									<div class="tab-content">
										<div class="tab-pane active" id="tab_1_1">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th>S. No.</th>
														<th>Lawyer Name</th>
														<th>Subject</th>
														<th>Date</th>
														<th>Status</th>
														<th>View</th>
													</tr>
												</thead>
												<tbody>
												<?php $no = 1;
												if(mysql_num_rows($query) > 0){
												while($unread = mysql_fetch_assoc($query)){
													$qr = mysql_query("select full_name from ra_lawyers where id='".$unread['lawyer_id']."' ");
													$uname = mysql_fetch_assoc($qr);
												?>
													<tr>
														<td><?=$no++?></td>
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
														<td><a href="view-answer?qid=<?=$unread['id']?>" class="btn btn-info"> <i class="fa fa-eye"></i></td>
													</tr>
												<?php }}else{ echo "<tr><td colspan='6'>No data found</td></tr>"; }?>
												</tbody>
											</table>
										</div>
										
										<!--div class="tab-pane" id="tab_1_3">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th>S. No.</th>
														<th>Lawyer Name</th>
														<th>Subject</th>
														<th>Date/Time</th>
														<th>View</th>
													</tr>
												</thead>
												<tbody>
												<?php $no = 1;
												if(mysql_num_rows($query1) > 0){
												while($unread = mysql_fetch_assoc($query1)){
													$qr = mysql_query("select full_name from ra_lawyers where id='".$unread['lawyer_id']."' ");
													$uname = mysql_fetch_assoc($qr);
												?>
													<tr>
														<td><?=$no++?></td>
														<td><?=$uname['full_name']?></td>
														<td><?=$unread['subject']?></td>
														<td><?=date('d F Y',strtotime($unread['added_date']))?></td>
														<td><a href="view-answer?qid=<?=$unread['id']?>" class="btn btn-info"> <i class="fa fa-eye"></i></td>
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
<?php include('user-footer.php');?>