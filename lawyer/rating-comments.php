<?php 
	include('lawyer-header.php');
	$query = mysql_query("select * from ra_lawyer_answer where rating !='' AND feedback != '' AND lawyer_id='".$_SESSION['lawyerID']."' order by id desc");
												
												
?>

<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<i class="fa fa-home pr-10"></i><a href="../" rel="nofollow">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="dashboard">Dashboard</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;View Ratings and Comments
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
						<div class="profile-content">
							<div class="portlet row light">
								<div class="portlet-title tabbable-line clearfix">
									<ul class="nav nav-tabs">
										<li class="active">
										  <a href="#tab_1_1" data-toggle="tab">View Ratings and Comments</a>
										</li>
										<!--li class="">
										  <a href="#tab_1_3" data-toggle="tab">Answered Question (<?=mysql_num_rows($query1)?>)</a>
										</li-->
									</ul>
								</div>
								
								<div class="portlet-body">
									<div class="tab-content">
										<div class="tab-pane active" id="tab_1_1">
											<?php $sno = 1;
												if(mysql_num_rows($query) > 0){
												while($result = mysql_fetch_assoc($query)){
													$qr = mysql_query("select full_name from ra_front_users where id='".$result['client_id']."' ");
													$uname = mysql_fetch_assoc($qr);
												
											?>
											<span><?=$sno++?></span>
											<div class="form-group">
												<label class="replyte"> Client : </label>
												<?=$uname['full_name']?>
											</div>
											<div class="form-group">
												<label class="replyte"> Rating : </label>
												<ul style="list-style:none;     padding-left: 0;">
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
				
											<?php }}?>
										
											<!--table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th>S. No.</th>
														<th>Reviewed By</th>
														<th>Feedback</th>
														<th>Rating</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php $no = 1;
												if(mysql_num_rows($query) > 0){
												while($unread = mysql_fetch_assoc($query)){
													$qr = mysql_query("select full_name from ra_front_users where id='".$unread['client_id']."' ");
													$uname = mysql_fetch_assoc($qr);
												?>
													<tr>
														<td><?=$no++?></td>
														<td><?=$uname['full_name']?></td>
														<td><?=$unread['feedback']?></td>
														<td><?=$unread['rating']?></td>
														<!--<td>
															<a href="lawyer_ajax.php?rid=<?=$unread['id']?>" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure to delete this review');"><i class="fa fa-close"></i></a>
														</td>-->
													<!--/tr>
												<?php }}else{ echo "<tr><td colspan='4'>No data found</td></tr>"; }?>
												</tbody>
											</table-->
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
<style>
.form-group ul li {
    display: inline-block;
}
</style>
<?php include('lawyer-footer.php');?>