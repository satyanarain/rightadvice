<?php 
include("admin_header.php");
if(isset($_GET['lid']) && $_GET['lid']!='')
{
	$result = mysql_query("select * from ra_lawyers where id='".$_GET['lid']."' ") or die(mysql_error());
	$lawyer = mysql_fetch_assoc($result);
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
					<div class="portlet-title tabbable-line clearfix">
						<div class="caption caption-md">
							<span class="caption-subject"><?php if(isset($_GET['lid']) && $_GET['lid']!=''){ echo "Edit Lawyer";}else{echo "Add Lawyer";}?> </span>
						</div>
					</div>

					<div class="portlet-body">
						<div class="tab-content">

							<div class="tab-pane active" id="tab_1_1">
								
								<form role="form" method="post" action="">
									<input type="hidden" name="lawyer_id" id="lawyer_id" value="<?=$lawyer['id']?>"/>
									
									<div class="form-group">
										<label class="control-label">Make Lawyer Preferred</label>
										<select class="form-control" name="preferred" id="preferred">
											<option value="0" <?php if($lawyer['preferred'] == 0){ echo "selected"; }?>>No</option>
											<option value="1" <?php if($lawyer['preferred'] == 1){ echo "selected"; }?>>Yes</option>
										</select>
										
										<!--input type="checkbox" name="preferred" id="preferred" <?php if($lawyer['preferred'] == 1){ echo "checked"; }?>/--> 
									 
									</div>
									
									<div class="form-group">
									  <label class="control-label">Lawyer Admin Email</label>
									  <input type="text" placeholder="Enter Email" name="admin_email" id="admin_email"  class="form-control" value="<?=$lawyer['admin_email']?>"/>
									</div>
									
									<div class="form-group">
									  <label class="control-label">Full Name</label>
									  <input type="text" placeholder="Enter Full Name" name="full_name" id="full_name"  class="form-control" value="<?=$lawyer['full_name']?>"/>
									</div>

									
									<div class="form-group">
									  <label class="control-label">About Me</label>
									  <textarea rows="5" placeholder="Enter About You" name="about" id="about"  class="form-control"><?=$lawyer['about']?></textarea>
									</div>

									<div class="clearfix"></div>
									
									<!--div class="row form-group">
										<label for="text" class=" col-md-12 control-label">Category</label>									
										<div class="col-md-12"> 	
											<select name="categories[]" id="categories" class="form-control"  multiple="multiple" size="8">
												<option value="">Choose a category</option>	
												<?php 
													$cat = explode('^',$lawyer['categories']); 
													$result = mysql_query("select post_title from ra_posts where post_type = 'lawyer_category'");

													while ($row = mysql_fetch_assoc($result)){
												?>
												<option  value="<?php echo $row['post_title']; ?>" <?php if(in_array($row['post_title'],$cat)){ echo "selected"; } ?>><strong><?php echo $row['post_title']; ?><strong></option>	
												<?php } ?>	
													
											
											</select>		
										</div>
									</div-->
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
											<input type="text" class="form-control" name="address" id="address" value="<?=$lawyer['address']?>" placeholder="Enter address Here">
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
									
									<div class="form-group">
										<div class=" form-group">
											<label for="text" class=" control-label">Documents</label>							
											<?php 
											$extaintions = array('png','jpg','gif','jpeg');
											if($lawyer['documents'] != ''){
											$docs = explode('^',$lawyer['documents']);
											$dnames = explode('^',$lawyer['document_names']);
											for($i=0; $i < count($docs); $i++){?>
												<a href="../../../../lawyer/files/<?=$dnames[$i]?>" class="btn btn-info" target="_blank"><?=$docs[$i]?></a> &nbsp;&nbsp;
											<?php }	}?>
										</div>
									</div>
									
									<div id="accordion"> 
										<h3 class="tab_head">Skillsets</h3>
										<div class="acco" id="t1">
											<div class="form-group">
											<?php 
												$specialty = explode('^',$lawyer['Specialities_arr']);
												
												$result = mysql_query("select post_title from ra_posts where post_type = 'specialty'");

												while($specs = mysql_fetch_assoc($result)){
													
											?>
												<div class="col-md-4">
													<label class="form-group"> 
													<input type="checkbox" <?php if(in_array($specs['post_title'],$specialty)){ echo "checked";}?>   name="Specialities_arr[]" id="Specialities_arr" value="<?php echo $specs['post_title'];?>"> <?php echo $specs['post_title'];?> </label>  
												</div>
											<?php }?>	
											</div>								
										</div>								
										
										<h3 class="tab_head">Contact Info</h3>
										<div class="acco" id="t2">
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
												<label for="text" class=" control-label">Email Address</label>
												
												<div class="  "> 
													<input type="text" class="form-control" name="email" id="email" value="<?=$lawyer['email']?>" placeholder="Enter Email Address">
												</div>																
											</div>
											<div class=" form-group">
												<label for="text" class=" control-label">Web Site</label>
												
												<div class="  "> 
													<input type="text" class="form-control" name="website" id="website" value="<?=$lawyer['website']?>" placeholder="Enter Web Site">
												</div>																
											</div>
											
										</div>
										
										<h3 class="tab_head">Videos</h3>
										<div class="acco" id="t3">
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
									
										<h3 class="tab_head">Social Profiles</h3>
										<div class="acco" id="t4">
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
									
										<h3 class="tab_head">Additional Info</h3>
										<div class="acco" id="t5">
											<div class="form-group">
												<label class="control-label">Date Of Birth</label>
												<input type="date" placeholder="Enter Birth Date" name="dob" id="dob"  class="form-control" value="<?=$lawyer['dob']?>"/>
											  </div>
												  
											  <div class="form-group">
												<label class="control-label">Gender</label>
												<input type="text" placeholder="Enter Gender" name="gender" id="gender"  class="form-control" value="<?=$lawyer['gender']?>"/>
											  </div>
											  
											  <div class="form-group">
												<label class="control-label">Organization Name</label>
												<input type="text" placeholder="Enter Gender" name="organization_name" id="organization_name"  class="form-control" value="<?=$lawyer['organization_name']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Law Office Affiliations</label>
												<input type="text" placeholder="Enter Law Office Affiliations" name="lawfirmAffiliations" id="lawfirmAffiliations"  class="form-control" value="<?=$lawyer['lawfirmAffiliations']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Experience</label>
												<input type="text" placeholder="Enter Experience / Tranining" name="ExperienceTranining" id="ExperienceTranining"  class="form-control" value="<?=$lawyer['ExperienceTranining']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Education</label>
												<input type="text" placeholder="Enter Education" name="education" id="education"  class="form-control" value="<?=$lawyer['education']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Apprenticeships</label>
												<input type="text" placeholder="Enter Apprenticeships" name="apprenticeships" id="apprenticeships"  class="form-control" value="<?=$lawyer['apprenticeships']?>"/>
											  </div>
											
											<div class="form-group">
												<label class="control-label">Whether Lawyer can represent in Court?</label>
												<select name="courts" id="courts" class="form-control">
													<option <?php if($lawyer['courts'] == 'Yes'){ echo 'selected';}?> value="Yes">Yes</option>
													<option value="No" <?php if($lawyer['courts'] == 'No'){ echo 'selected'; }?>>No</option>
												</select>
											</div>
											
											<div class="form-group">
												<label class="control-label">Nationality</label>
												
												<select name="nationality" id="nationality" class="form-control">
													<option value="">Select Nationality</option>
													<?php 
													$result = mysql_query("select post_title from ra_posts where post_type = 'nationality'");
													$nationality = mysql_fetch_assoc($result);
													//print_r($nationality);
													while($nationality = mysql_fetch_assoc($result)){
													?>
													<option <?php if($lawyer['nationality'] == $nationality['post_title']){ echo 'selected';}?> value="<?=$nationality['post_title']?>"><?=$nationality['post_title']?></option>
													<?php } ?>
												</select>
											</div>
											
											 <!--div class="form-group">
												<label class="control-label">Residency</label>
												<input type="text" placeholder="Enter Residency" name="residency" id="residency"  class="form-control" value="<?=$lawyer['residency']?>"/>
											  </div>
									
										
											 <div class="form-group">
												<label class="control-label">Practise Area</label>
												<input type="text" placeholder="Enter Practise Area" name="practiseArea" id="practiseArea"  class="form-control" value="<?=$lawyer['practiseArea']?>"/>
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
												<label class="control-label">Languages</label>
												<?php 
													$language = explode('^',$lawyer['languages']); 
													
													$result = mysql_query("select post_title from ra_posts where post_type = 'lawyer_languages'");
													while($lang = mysql_fetch_assoc($result)){
												?>
													<div class="col-md-3">
														<label class="form-group"> 
														<input type="checkbox" <?php if(in_array($lang['post_title'],$language)){ echo "checked";}?>   name="language" id="language" value="<?php echo $lang['post_title'];?>"> <?php echo $lang['post_title'];?> </label>  
													</div>
												<?php }	?>	
											  </div>
										</div>
									
									</div>	
									
									<div class="margiv-top-10">
										<div class="" id="update_message"></div>
										<?php if(isset($_GET['lid']) && $_GET['lid']!=''){?>
										<button type="button" onclick="add_function('<?=$_GET['lid']?>')" name="update_lawyer" class="btn-new btn-custom">Save Changes</button>
										<?php }else{?>
										<button type="button" onclick="add_function()" name="add_lawyer" class="btn-new btn-custom">Submit</button>
										<?php }?>
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
	</div>
</article><!--end post-entry-->

