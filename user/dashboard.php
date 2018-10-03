<?php include('user-header.php');?>


<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<i class="fa fa-home pr-10"></i><a href="../" rel="nofollow">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;Dashboard
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

<div class="title-content">
<a href="http://35.154.128.159:83/lawyers" class="btn btn-primary askbtn" style="float:right;">Find A Lawyer </a>

							
						</div>

							<div class="portlet row light">
								
								
					<div class="portlet-body">
						<div class="tab-content">

							<div class="tab-pane active" id="tab_1_1">
								<h3>Latest Unanswered Questions</h3>
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
									$query = mysql_query("select * from ra_question where status='0' AND client_id='".$_SESSION['userID']."' ");
	
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


<div class="conten-desc">
						  
                          <ul class="about-list">
     <li>Name : <span><?=$user['full_name']?> </span></li>

     <li>Organization Name : <span><?=$user['organization_name']?></span></li>

     <li>Mobile : <span><?=$user['mobile']?></span></li>

     <li>Nationality : <span><?=$user['gender']?></span></li>

     <li>Date Of Birth : <span> <?=date('d F Y',strtotime($user['dob']))?> </span></li>

     <li>Address : <span> <?=$user['address']?> </span></li>

     <li>DOB : <span> 01 January 1990 </span></li>
  

                               

</ul>

 <?php if($user['about'] != ''){?>
   <strong>About Me :</strong>	<?=$user['about']?><br>		
							<?php } ?>    
</div>
								

								
								
								
								<!--div class="form-group">
								  <label class="control-label">Full Name</label>
								  <input readonly type="text" placeholder="Enter Full Name" name="full_name" id="full_name"  class="form-control" value="<?=$user['full_name']?>"/>
								</div>

								<div class="form-group">
								  <label class="control-label">Email</label>
								  <input readonly type="email" name="email" id="email"  class="form-control" value="<?=$user['email']?>" />
								</div>
								<?php if($user['about'] != ''){?>
								<div class="form-group">
								  <label class="control-label">About You</label>
								  <textarea readonly rows="5" placeholder="Enter About You" name="about" id="about"  class="form-control"><?=$user['about']?></textarea>
								</div>
								<?php } ?>
								<div class="form-group">
									<label for="text" class=" control-label">Organization Name</label>							
									<div class=" "> 
										<input readonly type="text" class="form-control" name="organization_name" id="organization_name" value="<?=$user['organization_name']?>" placeholder="Enter Organization Name">
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">Mobile Number</label>							
									<div class=" "> 
										<input readonly type="text" class="form-control" name="mobile" id="mobile" value="<?=$user['mobile']?>" placeholder="Enter Mobile ">
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">Gender</label>							
									<div class=" "> 
										<input readonly type="text" class="form-control" name="gender" id="gender" value="<?=$user['gender']?>" placeholder="Enter Your Gender">
										
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">Date Of Birth</label>							
									<div class=" "> 
										<input readonly type="date" class="form-control" name="dob" id="dob" value="<?=$user['dob']?>" placeholder="DD-MM-YYYY">
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">Address</label>							
									<div class=" "> 
										<input readonly type="text" class="form-control" name="address" id="address" value="<?=$user['address']?>" placeholder="Enter city ">
									</div>
								</div>
								
								<div class="form-group">
									<label for="text" class=" control-label">City</label>							
									<div class=" "> 
										<input readonly type="text" class="form-control" name="city" id="city" value="<?=$user['city']?>" placeholder="Enter city ">
									</div>
								</div>
								
								<div class="form-group">
									<div class=" form-group">
										<label for="text" class=" control-label">Zipcode</label>							
										<input readonly type="text" class="form-control" name="postcode" id="postcode" value="<?=$user['postcode']?>" placeholder="Enter Zipcode ">
									</div>
								</div-->
								
							
							</div>

						</div>
					</div>
				</div>
			</div>
			<!-- END PROFILE CONTENT -->
				 


				</div>
			</div>
		</div>
	</div>

</article><!--end post-entry-->

<?php include('user-footer.php');?>
