<?php include('lawyer-header.php');?>

<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<i class="fa fa-home pr-10"></i><a href="../" rel="nofollow">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="dashboard">Dashboard</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;Change Password
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
							<div class="portlet-body">
							<div class="tab-content">

							<div class="portlet row light">
											
								<div class="tab-pane" id="tab_1_3">
									<form action="" name="pass_word" id="pass_word">
										<div class="form-group">
										  <label class="control-label">Current Password </label>
										  <input type="password" id="c_pass" name="c_pass" class="form-control-solid"/>
										</div>
										<div class="form-group">
										  <label class="control-label">New Password </label>
										  <input type="password" id="n_pass" name="n_pass" class="form-control-solid"/>
										</div>
										<div class="form-group">
										  <label class="control-label">Re-type New Password </label>
										  <input type="password" id="r_pass" name="r_pass" class="form-control-solid"/>
										</div>
										<div class="margin-top-10">
										  <div class="" id="update_message_pass"></div>
										  <button type="button" onclick="update_password();"  class="btn-new btn-custom">Change Password <span class="glyphicon glyphicon-send"></span> </button>
										  
										</div>
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
	</div>
</article>
<?php include('lawyer-footer.php');?>