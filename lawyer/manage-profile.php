<?php include('lawyer-header.php');?>

<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<i class="fa fa-home pr-10"></i><a href="../" rel="nofollow">Home</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;<a href="dashboard">Dashboard</a>&nbsp;&nbsp;&#187;&nbsp;&nbsp;Manage Profile
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
						<div class="caption caption-md">
							<span class="caption-subject">Profile </span>
						</div>
						<ul class="nav nav-tabs">
							<li class="active">
							  <a href="#tab_1_1" data-toggle="tab">Personal Info </a>
							</li>
							<li class="">
							  <a href="#tab_1_3" data-toggle="tab">Change Password </a>
							</li>
							<li>
							  <a href="#tab_1_5" data-toggle="tab">Social </a>
							</li>
							<li>
							  <a href="#tab_1_4" data-toggle="tab">Privacy Settings </a>
							</li>
						</ul>
					</div-->
					<div class="portlet-body">
						<div class="tab-content">

						<div class="tab-pane active" id="tab_1_1">
							
							<form role="form" method="post" action="lawyer_ajax.php" enctype="multipart/form-data">
								
								<div class="form-group">
								  <label class="control-label">Full Name</label>
								  <input type="text" placeholder="Enter Full Name" name="full_name" id="full_name"  class="form-control" value="<?=$lawyer['full_name']?>"/>
								</div>

								
								<div class="form-group">
								  <label class="control-label">About Me</label>
								  <textarea rows="5" placeholder="Enter About You" name="about" id="about"  class="form-control"><?=$lawyer['about']?></textarea>
								</div>

								
								<div class="clearfix"></div>
								
								<!--div class=" row form-group">
									<label for="text" class=" col-md-12 control-label">Category</label>									
									<div class=" col-md-12 "> 	
										<select name="categories[]" class="form-control" multiple="multiple" size="8">
											<option value="">Choose a category</option>	
											<?php 
												$cat = explode('^',$lawyer['categories']); 
												$args = array('post_type' => 'lawyer_category', 'posts_per_page' => -1);
												$posts = new WP_Query($args);
												while ($posts->have_posts()){
													$posts->the_post();
													
													$title = get_the_title();
											?>
											<option  value="<?php echo $title; ?>" <?php if(in_array($title,$cat)){ echo "selected"; } ?>><strong><?php echo $title; ?><strong></option>	
											<?php
												}
												wp_reset_postdata();
											?>	
												
										
										</select>		
									</div>
								</div>
								<div class="clearfix"></div-->
								
								<div class="form-group" id="refresh_this">
									<?php 
									//echo $lawyer['documents'];
									$extaintions = array('png','jpg','gif','jpeg');
									if($lawyer['documents'] != ''){ ?>
									<label for="text" class=" control-label">Uploaded Documents</label>
									<?php 
										$docs = explode('^',$lawyer['documents']);
										$doc_names = explode('^',$lawyer['document_names']);
										for($i=0; $i < count($docs); $i++)
										{
											/* $ext = explode('.',$docs[$i]);
											if(in_array($ext[1],$extaintions))
											{ ?>
												<div class="col-md-3">
													<img src="files/<?=$docs[$i]?>" height="200" class="thumbnail">
													<span class="img_close" onclick="remove_image('<?=$docs[$i]?>')">
														<img src="x.png" class="remove_img">
													</span>
												</div>
											<?php }else{ ?>
												<div class="col-md-3">
													<a href="files/<?=$docs[$i]?>" target="_blanck"><img src="doc_img.png" width="100px"/></a>
													<span class="img_close" onclick="remove_image('<?=$docs[$i]?>')">
														<img src="x.png" class="remove_img">
													</span>
												</div>
										<?php	} */
										?>
										<a href="files/<?=$doc_names[$i]?>" target="_blank" class="btn btn-info"><?=$docs[$i]?></a>&nbsp;&nbsp;
									<?php }
									}?>
									<!--input type="hidden" id="documents_old" name="documents_old" value="<?=$lawyer['documents']?>" />
									<br>
									<div class="col-md-12">
									<div id="filediv"><input name="file[]" type="file" id="file"/></div><br>
									<input type="button" id="add_more" class="upload" value="Add More Files"/>
									</div-->
								</div>
								

								<div class="clearfix"></div>
								<div class="form-group">
									<label for="text" class=" control-label">Location</label>							
									<div class=" "> 
										<input type="text" class="form-control" name="location" id="location" value="<?=$lawyer['location']?>" placeholder="Enter location Here which will be use to search your profile">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class=" control-label">Address</label>							
									<div class=" "> 
										<input type="text" class="form-control" name="address" id="address" value="<?=stripslashes($lawyer['address'])?>" placeholder="Enter address Here">
									</div>
								</div>
								<div class="form-group">
									<label for="text" class=" control-label">City</label>							
									<div class=" "> 
										<input type="text" class="form-control" name="city" id="city" value="<?=$lawyer['city']?>" placeholder="Enter city ">
									</div>
								</div>
								<div class="form-group">
									<div class=" form-group">
										<label for="text" class=" control-label">Zipcode</label>							
										<input type="text" class="form-control" name="postcode" id="postcode" value="<?=$lawyer['postcode']?>" placeholder="Enter Zipcode ">
									</div>
								</div>

								<div class="clearfix"></div>	
						
								<div class="panel panel-default">
									<div class="panel-heading">
									  <h4 class="panel-title col-lg-10">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
										  Skillsets	</a>
									  </h4>
										<h4 class="panel-title" style="text-align:right;color:blue;font-size:12px;">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
										  [ Edit ] 
										</a>
									  </h4>
									</div>
									<div id="collapseEight" class="panel-collapse collapse">
									  <div class="panel-body">
										<div class=" form-group">
										<?php 
											$specialty = explode('^',$lawyer['Specialities_arr']); 
											
											$args = array('post_type' => 'specialty', 'posts_per_page' => -1);
											$posts = new WP_Query($args);
											while ($posts->have_posts()){
												$posts->the_post();
												$specs = get_the_title();
										?>
											<div class="col-md-4">
												<label class="form-group"> 
												<input type="checkbox" <?php if(in_array($specs,$specialty)){ echo "checked";}?>   name="Specialities_arr[]" id="Specialities_arr[]" value="<?php echo $specs;?>"> <?php echo $specs;?> </label>  
											</div>
										<?php
											}
											wp_reset_postdata();
										?>	
											
										
										</div>								
									  </div>
									</div>
								</div>
					
								<div class="clearfix"></div>	
								<div class="panel panel-default">
									<div class="panel-heading">
									  <h4 class="panel-title col-lg-10">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
										  Contact Info									</a>
									  </h4>
										<h4 class="panel-title" style="text-align:right;color:blue;font-size:12px;">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
										  [ Edit ] 
										</a>
									  </h4>
									</div>
									<div id="collapseFour" class="panel-collapse collapse">
									  <div class="panel-body">											
										<div class=" form-group">
											<label for="text" class=" control-label">Mobile</label>						
											<div class="  "> 
												<input type="text" class="form-control" name="mobile" id="mobile" value="<?=$lawyer['mobile']?>" placeholder="Enter Mobile Number">
											</div>																
										</div>
										<div class=" form-group">
											<label for="text" class=" control-label">Fax</label>
											
											<div class="  "> 
												<input type="text" class="form-control" name="fax" id="fax" value="<?=$lawyer['fax']?>" placeholder="Enter Fax Number">
											</div>																
										</div>	
										<div class=" form-group">
											<label for="text" class=" control-label">Email Address <small>(You can&#8216;t change your email address, please contact Right Advice Team)</small></label>
											
											<div class="  "> 
												<input type="text" class="form-control" name="email" id="email" value="<?=$lawyer['email']?>" readonly >
											</div>																
										</div>
										<div class=" form-group">
											<label for="text" class=" control-label">Website</label>
											
											<div class="  "> 
												<input type="text" class="form-control" name="website" id="website" value="<?=$lawyer['website']?>" placeholder="Enter Web Site">
											</div>																
										</div>
										
										
									  </div>
									</div>
								</div>
					
								<div class="clearfix"></div>	
						
				
								<div class="clearfix"></div>	
								<div class="panel panel-default">
									<div class="panel-heading">
									  <h4 class="panel-title col-lg-10">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
										  Videos									</a>
									  </h4>
										<h4 class="panel-title" style="text-align:right;color:blue;font-size:12px;">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
										   [ Edit ] 
										</a>
									  </h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
									  <div class="panel-body">	
																				
											<div class=" form-group">
											
											<label for="text" class=" control-label">Youtube</label>
											
											<div class="  "> 
												<input type="text" class="form-control" name="youtube" id="youtube" value="<?=$lawyer['youtube']?>" placeholder="Enter Youtube video ID, e.g : bU1QPtOZQZU ">
											</div>																
										</div>
										<div class=" form-group">
											<label for="text" class=" control-label">Vimeo</label>
											
											<div class="  "> 
												<input type="text" class="form-control" name="vimeo" id="vimeo" value="<?=$lawyer['vimeo']?>" placeholder="Enter vimeo ID, e.g : 134173961">
											</div>																
										</div>
																				
									  </div>
									</div>
								</div>
								
								<div class="clearfix"></div>	
								<div class="panel panel-default">
									<div class="panel-heading">
									  <h4 class="panel-title col-lg-10">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
										  Social Profiles</a>
									  </h4>
										<h4 class="panel-title" style="text-align:right;color:blue;font-size:12px;">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
										   [ Edit ] 
										</a>
									  </h4>
									</div>
									<div id="collapseFive" class="panel-collapse collapse">
									  <div class="panel-body">											
										
										<div class="form-group">
											<label class="control-label">FaceBook</label>
											<input type="text" name="facebook" id="facebook" value="<?=$lawyer['facebook']?>" class="form-control"/>
										  </div>
										  <div class="form-group">
											<label class="control-label">Linkedin</label>
											<input type="text" name="linkedin" id="linkedin" value="<?=$lawyer['linkedin']?>" class="form-control"/>
										  </div>
										  <div class="form-group">
											<label class="control-label">Twitter</label>
											<input type="text" name="twitter" id="twitter" value="<?=$lawyer['twitter']?>" class="form-control"/>
										  </div>
										  <div class="form-group">
											<label class="control-label">Google+ </label>
											<input type="text" name="gplus" id="gplus" value="<?=$lawyer['gplus']?>"  class="form-control"/>
										  </div>
										  
										  <div class="form-group">
											<label class="control-label">Pinterest</label>
											<input type="text" name="pinterest" id="pinterest" value="<?=$lawyer['pinterest']?>"  class="form-control"/>
										  </div>
										  <div class="form-group">
											<label class="control-label">Instagram </label>
											<input type="text" name="instagram" id="instagram" value="<?=$lawyer['instagram']?>"  class="form-control"/>
										  </div>
						  									
										
										</div>
									</div>
								</div>
					
					
								<div class="clearfix"></div>	
								<div class="panel panel-default">
									<div class="panel-heading">
									  <h4 class="panel-title col-lg-10">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
										  Additional Info									</a>
									  </h4>
										<h4 class="panel-title" style="text-align:right;color:blue;font-size:12px;">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
										 [ Edit ] 
										</a>
									  </h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">											
											
											 <div class="form-group">
												<label class="control-label">Date Of Birth</label>
												<input type="date" placeholder="Enter Birth Date" name="dob" id="dob"  class="form-control" value="<?=$lawyer['dob']?>"/>
											  </div>
											  
								  
									  
											  <div class="form-group">
												<label class="control-label">Gender</label>
												
												
												<!--select name="gender" id="gender" class="form-control">
													<option <?php $lawyer['gender'] == 'Male'? 'selected' : '';?> value="Male">Male</option>
													<option value="Female" <?php $lawyer['gender'] == 'Female'? 'selected' : '';?>>Female</option>
													<option value="Other" <?php $lawyer['gender'] == 'Other'? 'selected' : '';?>>Other</option>
												</select-->
												<?//=$lawyer['gender']?>
		<input type="radio" name="gender" id="gender" <?php if(strcasecmp($lawyer['gender'], 'Male') == 0){ echo 'checked';}else{ echo '';}?> value="Male" /> Male
											  
		<input type="radio" name="gender" id="gender"  <?php if(strcasecmp($lawyer['gender'], 'Female') == 0){ echo 'checked';}else{ echo '';}?>  value="Female" /> Female
											  </div>
											  
											  <div class="form-group">
												<label class="control-label">Organization Name</label>
												<input type="text" placeholder="Enter Gender" name="organization_name" id="organization_name"  class="form-control" value="<?=$lawyer['organization_name']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Law Office Affiliations</label>
												<input type="text" placeholder="Enter Law Office Affiliations" name="lawfirmAffiliations" id="lawfirmAffiliations"  class="form-control" value="<?=$lawyer['lawfirmAffiliations']?>"/>
											  </div>
									
<!--	
											 <div class="form-group">
												<label class="control-label">Experience</label>
												<input type="text" placeholder="Enter Experience" name="ExperienceTranining" id="ExperienceTranining"  class="form-control" value="<?=$lawyer['ExperienceTranining']?>"/>
											  </div>
-->

									
<!--											 <div class="form-group">
												<label class="control-label">Education</label>
												<input type="text" placeholder="Enter Education" name="education" id="education"  class="form-control" value="<?=$lawyer['education']?>"/>
											  </div>
-->
			<div class="form-group">
				<label class="control-label">Education</label>
				
				<textarea name="education" id="education" rows="5" class="form-control" placeholder="Enter your Education"><?=$lawyer['education']?></textarea>
				
			</div>
									

			<div class="form-group">
				<label class="control-label">Experience</label>
				
				<textarea name="ExperienceTranining" id="ExperienceTranining" rows="5" class="form-control" placeholder="Enter your Experience"><?=$lawyer['ExperienceTranining']?></textarea>
				
			</div>

										
											 <div class="form-group">
												<label class="control-label">Apprenticeships</label>
												<input type="text" placeholder="Enter Apprenticeships" name="apprenticeships" id="apprenticeships"  class="form-control" value="<?=$lawyer['apprenticeships']?>"/>
											  </div>
											
											<div class="form-group">
												<label class="control-label">Whether Lawyer can represent in Court?</label>
												<select name="courts" id="courts" class="form-control">
													<option value="">-Select-</option>
													<option <?php if($lawyer['courts'] == 'Yes'){ echo 'selected';}?> value="Yes">Yes</option>
													<option value="No" <?php if($lawyer['courts'] == 'No'){ echo 'selected'; }?>>No</option>
												</select>
											</div>
											
											 <!--div class="form-group">
												<label class="control-label">Residency</label>
												<input type="text" placeholder="Enter Residency" name="residency" id="residency"  class="form-control" value="<?=$lawyer['residency']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Practice Area</label>
												<input type="text" placeholder="Enter Practice Area" name="practiseArea" id="practiseArea"  class="form-control" value="<?=$lawyer['practiseArea']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Certifications</label>
												<input type="text" placeholder="Enter Certifications" name="certifications" id="certifications"  class="form-control" value="<?=$lawyer['certifications']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Pre-Law</label>
												<input type="text" placeholder="Enter Pre-Law" name="prelaw" id="prelaw"  class="form-control" value="<?=$lawyer['prelaw']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Law School</label>
												<input type="text" placeholder="Enter Law School" name="law_school" id="law_school"  class="form-control" value="<?=$lawyer['law_school']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Law Degree</label>
												<input type="text" placeholder="Enter Law Degree" name="law_degree" id="law_degree"  class="form-control" value="<?=$lawyer['law_degree']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Bar Exam</label>
												<input type="text" placeholder="Enter Bar Exam" name="bar_exam" id="bar_exam"  class="form-control" value="<?=$lawyer['bar_exam']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Practice Course</label>
												<input type="text" placeholder="Enter Practice Course" name="practice_course" id="practice_course"  class="form-control" value="<?=$lawyer['practice_course']?>"/>
											  </div-->
									
										
											<div class="form-group">
												<label class="control-label">Nationality</label>
												
												<select name="nationality" id="nationality" class="form-control">
													<option value="">Select Nationality</option>
													<?php 
													$args = array('post_type' => 'nationality', 'posts_per_page' => -1);
													$posts = new WP_Query($args);
													while ($posts->have_posts()){
														$posts->the_post();
														$nationality = get_the_title();
													?>
													<option <?php if($lawyer['nationality'] == $nationality){ echo 'selected';}?> value="<?=$nationality?>"><?=$nationality?></option>
													<?php } ?>
												</select>
											</div>
											
											<div class="form-group">
											<label class="control-label">Language</label>
											<?php 
												$language = explode('^',$lawyer['languages']); 
												
												$args = array('post_type' => 'lawyer_languages', 'posts_per_page' => -1, 'order_by' => 'post_title', 'order' => 'ASC');
												$posts = new WP_Query($args);
												while ($posts->have_posts()){
													$posts->the_post();
													$lang = get_the_title();
											?>
												<div class="col-md-3">
													<label class="form-group"> 
													<input type="checkbox" <?php if(in_array($lang,$language)){ echo "checked";}?>   name="language[]" id="language[]" value="<?php echo $lang;?>"> <?php echo $lang;?> </label>  
												</div>
											<?php
												}
												wp_reset_postdata();
											?>	
											</div>
											<!--div class="form-group">
												<label class="control-label">Courts</label>
												<input type="text" placeholder="Enter Courts Name comma(,) Seprated" name="courts" id="courts"  class="form-control" value="<?=$lawyer['courts']?>"/>
											</div-->
										</div>
									</div>
								</div>
					
						
								<div class="margiv-top-10">
								<button type="submit" name="update_lawyer" class="btn-new btn-custom">Save Changes <span class="glyphicon glyphicon-send"></span> </button>
								</div>
							</form>
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

<?php include('lawyer-footer.php');?>
