<?php 
session_start();
include("../config.php");
function formateData($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(isset($_POST['action']) && $_POST['action'] == 'add_data')
{
	//print_r($_POST); die;
	/* if(isset($_FILES['documents']))
	{
		$errors = '';
		$file_name = $_FILES['documents']['name'];
		$file_size =$_FILES['documents']['size'];
		$file_tmp =$_FILES['documents']['tmp_name'];
		$file_type=$_FILES['documents']['type'];
		$file_ext=strtolower(end(explode('.',$_FILES['documents']['name'])));

		$expensions= array("jpeg","jpg","doc","pdf","docs","text","txt");

		if(in_array($file_ext,$expensions)=== false){
			$errors = "extension not allowed, please choose a JPEG,PDF or DOC file.";
		}

		if($file_size > 2097152){
			$errors = 'File size must be not be more than 2 MB';
		}

		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"files/".$file_name);
		}
	} */
	$error = '';
	$full_name = formateData($_POST['full_name']);
	$lawyer_id = formateData($_POST['lawyer_id']);
	$mobile = formateData($_POST['mobile']);
	$address = formateData($_POST['address']);
	$dob = formateData($_POST['dob']);
	$gender = formateData($_POST['gender']);
	$organization_name = formateData($_POST['organization_name']);
	$email = formateData($_POST['email']);
	$about = formateData($_POST['about']);
	$categories = implode('^',$_POST['categories']);
	$city = formateData($_POST['city']);
	$postcode = formateData($_POST['postcode']);
	$Specialities_arr = implode('^',$_POST['Specialities_arr']);
	$fax = formateData($_POST['fax']);
	$website = formateData($_POST['website']);
	$youtube = formateData($_POST['youtube']);
	$vimeo = formateData($_POST['vimeo']);
	$facebook = formateData($_POST['facebook']);
	$linkedin = formateData($_POST['linkedin']);
	$twitter = formateData($_POST['twitter']);
	$gplus = formateData($_POST['gplus']);
	$pinterest = formateData($_POST['pinterest']);
	$instagram = formateData($_POST['instagram']);
	$lawfirmAffiliations = formateData($_POST['lawfirmAffiliations']);
	$ExperienceTranining = formateData($_POST['ExperienceTranining']);
	$education = formateData($_POST['education']);
	$apprenticeships = formateData($_POST['apprenticeships']);
	$residency = formateData($_POST['residency']);
	$practiseArea = formateData($_POST['practiseArea']);
	$certifications = formateData($_POST['certifications']);
	$prelaw = formateData($_POST['prelaw']);
	$law_school = formateData($_POST['law_school']);
	$law_degree = formateData($_POST['law_degree']);
	$bar_exam = formateData($_POST['bar_exam']);
	$practice_course = formateData($_POST['practice_course']);
	
	$preferred = $_POST['preferred'];
	
	$admin_email = formateData($_POST['admin_email']);
	$languages = implode('^',$_POST['language']);
	
	$added_date = date('d-m-Y H:i:s');
	$password = "R#@".mt_rand(10,1000);
	if($full_name == ''){
		$error = 'Full name is required';
	}
	else if(preg_match("/[^A-Za-z'-]/", $First)){
		$error = 'Only alphanumeric and blanck spaces allow in full name'; 
	}
	else if($email == ''){
		$error = 'Email is required';
	}
	else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {	
		$error = 'Invalid email format';
	}
	else if($mobile == ''){
		$error = 'Mobile number is required';
	}
	else if(!is_numeric($mobile)){
		$error = 'Invalid mobile number';
	}
	else if($_POST['actionType'] == 'editLawyer')	
	{
		$updateData = mysql_query("update ra_lawyers set  	
						full_name = '$full_name',
						mobile = '$mobile',
						address = '$address',
						email = '$email',
						dob = '$dob',
						organization_name = '$organization_name',
						about = '$about',
						categories = '$categories',
						city = '$city',
						postcode = '$postcode',
						Specialities_arr = '$Specialities_arr',
						fax = '$fax',
						website = '$website',
						youtube = '$youtube',
						vimeo = '$vimeo',
						facebook = '$facebook',
						linkedin = '$linkedin',
						twitter = '$twitter',
						gplus = '$gplus',
						pinterest = '$pinterest',
						instagram = '$instagram',
						lawfirmAffiliations = '$lawfirmAffiliations',
						ExperienceTranining = '$ExperienceTranining',
						education = '$education',
						apprenticeships = '$apprenticeships',
						residency = '$residency',
						practiseArea = '$practiseArea',
						certifications = '$certifications',
						prelaw = '$prelaw',
						law_school = '$law_school',
						law_degree = '$law_degree',
						bar_exam = '$bar_exam',
						practice_course = '$practice_course',
						languages = '$languages',
						admin_email = '$admin_email',
						preferred = '$preferred'
					
						where id = '".$_POST['lawyer_id']."' ") or die(mysql_error());
			
		if($updateData)
		{
			$error = 'Record updated successfully';
		}
		else{
			$error = 'Record not updated, please try again';
		}
	}
	else if($_POST['actionType'] == 'addLawyer')
	{
		/*		
		$is_exists = mysql_query("select email from ra_lawyers where email='$email' ");
		if(mysql_num_rows($is_exists) > 0)
		{
			$error = "Some one already registered using this email. Please try another";
		}
		*/
		
		$iss_exists = mysql_query("select * from ra_front_users where email = '$email' ");
		$is_exists = mysql_query("select * from ra_lawyers where email = '$email' ");
		if(mysql_num_rows($is_exists) > 0)
		{
			$errors = 'Lawyer Email already exists';
		}
		else if(mysql_num_rows($iss_exists) > 0){
			$errors = 'Client Email already exists';
		}
		
		else
		{
			$addData = mysql_query("insert into ra_lawyers(full_name, email, password, mobile, address, dob, organization_name, about, categories, city, postcode, Specialities_arr, fax, website, youtube, vimeo, facebook, linkedin, twitter, gplus, pinterest, instagram, lawfirmAffiliations, ExperienceTranining, education, apprenticeships, residency, practiseArea, certifications, prelaw, law_school, law_degree, bar_exam, practice_course, languages, added_date,admin_email,preferred) values('$full_name', '$email', '".md5($password)."', '$mobile', '$address', '$dob', '$organization_name', '$about', '$categories', '$city', '$postcode', '$Specialities_arr', '$fax', '$website', '$youtube', '$vimeo', '$facebook', '$linkedin', '$twitter', '$gplus', '$pinterest', '$instagram', '$lawfirmAffiliations', '$ExperienceTranining', '$education', '$apprenticeships', '$residency', '$practiseArea', '$certifications', '$prelaw', '$law_school', '$law_degree', '$bar_exam', '$practice_course', '$languages', now(), '$admin_email', '$preferred') ") or die(mysql_error());

			if($addData)
			{
				$eid = base64_encode($email);
				$tid = base64_encode(mt_rand(10,1000));
				$_SESSION['eeid'] = $eid;
				$_SESSION['ttid'] = $tid;
				
				$token = "http://35.154.128.159:83/email-confirm?eid=".$eid."&tid=".$tid;
				
				$to = $email;
				$subject = "RightAdvice - Email Confirmation And Account Login Detail";
				
				
$htmlContent = '
<html>
    <head>
        <title>Welcome to Right Advice</title>
    </head>
    <body>
		<table align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:100%!important">
                <tbody>
                	<tr>
                    	<td>
                			<table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                            <tbody>
                            	<tr>
                                    <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0">
                                        <table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        	<tr>
                                            	<td width="30"></td>
                                                <td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://35.154.128.159:83" target="_blank"><img src="http://35.154.128.159:83/wp-content/themes/right_advice/images/logo.png" /></a></td>
                                                <td width="30"></td>
                                            </tr>
                                       	</tbody>
                                        </table>
                                  	</td>
                    			</tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        	<tr>
                                            	<td colspan="3" height="60"></td></tr><tr><td width="25"></td>
                                                <td align="center">
                                                    <h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Welcome to Right Advice</h1>
                                                </td>
                                                <td width="25"></td>
                                            </tr>
											<tr style="float:left;">
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <p style="color:#404040;font-size:16px; line-height:22px; font-weight:lighter; padding:0;margin:0">Right Advice team added you as a lawyer in his organization. Please find your login details :-</p>
                                                </td>
                                            </tr>
											
											<tr style="float:left;">
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <strong>Username/Email = '.$email.'</strong>
                                                </td>
												<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <strong>Password = '.$password.'</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <p style="color:#404040;font-size:16px; line-height:22px; font-weight:lighter; padding:0;margin:0">Please confirm your email, click on the below link.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                            <td colspan="4">
                                                <div style="width:100%;text-align:center;margin:30px 0">
                                                    <table align="center" cellpadding="0" cellspacing="0" style="font-family:HelveticaNeue-Light,Arial,sans-serif; margin:0 auto; padding:0">
                                                    <tbody>
                                                    	<tr>
                                                            <td align="center" style="margin:0;text-align:center"><a href="'.$token.'" style="font-size:21px; line-height:22px; text-decoration:none; color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank">Confirm Email</a></td>
                                                      	</tr>
                                                   	</tbody>
                                                    </table>
                                               	</div>
                                           	</td>
                                       	</tr>
                                        <tr><td colspan="3" height="30"></td></tr>
                                 	</tbody>
                                    </table>
                             	</td>
                   			</tr>
                            
                          	</tbody>
                            </table>
                  			<table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
                            <tbody>
                            	<tr>
                                	<td>
                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                                        <tbody>
                                        	<tr><td colspan="2" height="30"></td></tr>
                                            <tr>
                                            	<td width="360" valign="top">
                                                	<div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">© 2017 Right Advice. All rights reserved.</div>
                                                	<div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                        		</td>
                                              	<td align="right" valign="top">
                                              	</td>
                                            </tr>
                                            <tr><td colspan="2" height="5"></td></tr>
                                           
                                      	</tbody>
                                        </table>
                                   	</td>
                  				</tr>
                          	</tbody>
                            </table>
                  		</td>
                	</tr>
              	</tbody>
			</table>
    
</body>
</html>';

$from = 'info@curedincurable.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: RightAdvice <'.$from.'>'."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 

				// Send email
				if(mail($to,$subject,$htmlContent,$headers)){
					$error = 'Record submitted successfully and email send to entered email id.';
				}else{
					$error = 'Email sending fail.';
				}
			}
			else{
				$error = 'Record not added, please try again';
			}
		}
	}
	echo $error;
}


if(isset($_POST['action']) && $_POST['action'] == 'delete_record'){
	if($_POST['type'] == 'lawyer')
	{
		$del = mysql_query("delete from ra_lawyers where id='".$_POST['lid']."'") or die(mysql_error());
	}
	else if($_POST['type'] == 'user')
	{
		$del = mysql_query("delete from ra_front_users where id='".$_POST['lid']."'") or die(mysql_error());
	}
	if($del){
		$error = "Record deleted successfully";
	}else{
		$error = "Record not deleted, please try again";
		
	}
	echo $error ;
}

if(isset($_POST['action']) && $_POST['action'] == 'delete_question'){
	
	if($_POST['type'] == 'Unanswered')
	{
		$del = mysql_query("delete from ra_question where id='".$_POST['qid']."'") or die(mysql_error());
	}
	else if($_POST['type'] == 'Answered')
	{
		$del = mysql_query("delete from ra_question where id='".$_POST['qid']."'") or die(mysql_error());
		$del_ans = mysql_query("delete from ra_lawyer_answer where qid='".$_POST['qid']."'") or die(mysql_error());
	}
	if($del){
		$error = "Record deleted successfully";
	}else{
		$error = "Record not deleted, please try again";
		
	}
	echo $error ;
}

if(isset($_POST['action']) && $_POST['action'] == 'change_lawyer_status')
{
	
	$update = mysql_query("update ra_lawyers set status = '".$_POST['status_val']."' where id='".$_POST['lid']."'") or die(mysql_error());
	if($update)
	{
		$to = $_POST['email'];
		if($_POST['status_val'] == '1')
			$subject = "Right Advice | Account Approved";
		else
			$subject = "Right Advice | Account Unapproved";
		
				
$htmlContent = '
<html>
    <head>
        <title>Welcome to Right Advice</title>
    </head>
    <body>
		<table align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:100%!important">
                <tbody>
                	<tr>
                    	<td>
                			<table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                            <tbody>
                            	<tr>
                                    <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0">
                                        <table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        	<tr>
                                            	<td width="30"></td>
                                                <td align="center" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://35.154.128.159:83" target="_blank"><img src="http://35.154.128.159:83/wp-content/themes/right_advice/images/logo.png" /></a></td>
                                                <td width="30"></td>
                                            </tr>
                                       	</tbody>
                                        </table>
                                  	</td>
                    			</tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        	<tr>
                                            	<td colspan="3" height="60"></td></tr><tr><td width="25"></td>
                                                <td align="center">
                                                    <h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Right Advice Notification</h1>
                                                </td>
                                                <td width="25"></td>
                                            </tr>';
										
										if($_POST['status_val'] == '1')
										{
											
							$htmlContent .= '<tr style="float:left;">
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <p style="color:#00ff00;font-size:16px;font-family:HelveticaNeue-Light,arial,sans-serif; line-height:22px; font-weight:lighter; padding:0;margin:0">Right Advice Team has approved your account, now you can use our services.</p>
                                                </td>
                                            </tr>
											
											<tr>
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <p style="color:#404040;font-size:16px;font-family:HelveticaNeue-Light,arial,sans-serif; line-height:22px; font-weight:lighter; padding:0;margin:0">Click on the below button to login in your dashboard.</p>
                                                </td>
                                            </tr>
                                            <tr>
												<td colspan="4">
													<div style="width:100%;text-align:center;margin:30px 0">
														<table align="center" cellpadding="0" cellspacing="0" style="font-family:HelveticaNeue-Light,Arial,sans-serif; margin:0 auto; padding:0">
														<tbody>
															<tr>
																<td align="center" style="margin:0;text-align:center"><a href="http://35.154.128.159:83/lawyer-login" style="font-size:21px; line-height:22px; text-decoration:none; color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank">Login</a></td>
															</tr>
														</tbody>
														</table>
													</div>
												</td>
											</tr>';
										}
										else
										{
							$htmlContent .= '<tr style="float:left;">
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <p style="color:#ff0000;font-size:16px; font-family:HelveticaNeue-Light,arial,sans-serif;line-height:22px; font-weight:lighter; padding:0;margin:0">Your account is Unapprove from Right Advice Team due to undisclosed reasons.</p>
                                                </td>
                                            </tr>';
										}
							$htmlContent .= '<tr><td colspan="3" height="30"></td></tr>
										</tbody>
                                    </table>
                             	</td>
                   			</tr>
                            
                          	</tbody>
                            </table>
                  			<table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
                            <tbody>
                            	<tr>
                                	<td>
                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                                        <tbody>
                                        	<tr><td colspan="2" height="30">&nbsp;</td></tr>
                                            <tr>
                                            	<td width="360" valign="top">
                                                	<div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">&copy; 2017 Right Advice. All rights reserved.</div>
                                                	<div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                        		</td>
                                              	<td align="right" valign="top">
                                                	&nbsp;
                                              	</td>
                                            </tr>
                                            <tr><td colspan="2" height="5">&nbsp;</td></tr>
                                           
                                      	</tbody>
                                        </table>
                                   	</td>
                  				</tr>
                          	</tbody>
                            </table>
                  		</td>
                	</tr>
              	</tbody>
			</table>
		</body>
	</html>';

		$from = 'info@curedincurable.com'; 
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: Right Advice <'.$from.'>'."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
		 

		// Send email
		if(mail($to,$subject,$htmlContent,$headers)){
			$error = "success";
		}else{
			$error = "Mail sending failed";
		}
		
	}
	else{
		$error = "Status not changed, try again";
	}
	echo $error ;
}


if(isset($_POST['action']) && $_POST['action'] == 'send_reminder_email')
{
	$lawyer_email = $_POST['lawyer_email'];
	$client_name = $_POST['client_name'];
	$subjects = $_POST['subject'];
	$question = base64_decode($_POST['question']);
	$date = $_POST['date'];
	
	$query = mysql_query("select full_name, admin_email from ra_lawyers where email='".$lawyer_email."'") or die(mysql_error());
	$lawyer_name = mysql_fetch_assoc($query);
	
	$to = $lawyer_email;
	$subject = "Right Advice | Reminder";
	$message = '<h3>Dear '.$lawyer_name['full_name'].',</h3>
				<p>'.$client_name.' is still wating for you response, please give reply of his question. Here are details:-</p>
				<table>
					<tr><td><strong>Subject</strong> : '.$subjects.'</td></tr>
					<tr><td><strong>Question</strong> : '.$question.'</td></tr>
					<tr><td><strong>Question Date</strong>: '.date('d F, Y',strtotime($date)).'</td></tr>
				</table>';
	
	$message = '<html>
    <head>
        <title>Right Advice</title>
    </head>
    <body>
	
			<table align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:100%!important">
                <tbody>
                	<tr>
                    	<td>
                			<table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                            <tbody>
                            	<tr>
                                    <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0">
                                        <table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        	<tr>
                                            	<td width="30">&nbsp;</td>
                                                <td align="center" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://35.154.128.159:83" target="_blank"><img src="http://35.154.128.159:83/wp-content/themes/right_advice/images/logo.jpg"></a></td>
                                                <td width="30">&nbsp;</td>
                                            </tr>
                                       	</tbody>
                                        </table>
                                  	</td>
                    			</tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
					<td align="center" height="60"><h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Ask A Question Reminder</h1></td>				
				</tr>
				<tr>
					<td height="60"><p style="color:#404040;font-size:12px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b><i>Client is awaiting response to Question. Please respond at the earliest.</i></b></p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Client Name : </b>'.$client_name.'</p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Subject : </b>'.$subjects.'</p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Question : </b>'.$question.'</p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Date : </b>'.date('d F, Y',strtotime($date)).'</p></td>
				</tr>
			</tbody>
										</table>
                  			<table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
                            <tbody>
                            	<tr>
                                	<td>
                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                                        <tbody>
                                        	<tr><td colspan="2" height="30">&nbsp;</td></tr>
                                            <tr>
                                            	<td width="360" valign="top">
                                                	<div style="color:#a3a3a3;font-family:HelveticaNeue-Light,arial,sans-serif; font-size:12px;line-height:12px;padding:0;margin:0">&copy; 2017 Right Advice. All rights reserved.</div>
                                        		</td>
                                              	<td align="right" valign="top">
                                                	&nbsp;
                                              	</td>
                                            </tr>
                                            <tr><td colspan="2" height="5">&nbsp;</td></tr>
                                           
                                      	</tbody>
                                        </table>
                                   	</td>
                  				</tr>
                          	</tbody>
                            </table>
                  		</td>
                	</tr>
              	</tbody>
			</table>
    
</body>
</html>';
	
	
	$from = 'info@curedincurable.com'; 
		 
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Right Advice <'.$from.'>'."\r\n".
		'Reply-To: '.$from."\r\n" .
		'CC: ' .$lawyer_name['admin_email']. "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	 

	// Send email
	if(mail($to,$subject,$message,$headers)){
		$error = "Reminder mail sent successfully";
	}else{
		$error = "Mail not sent, please try again";
	}
	echo $error;
}

if(isset($_POST['action']) && $_POST['action'] == 'delete_comment'){
	
	$del = mysql_query("update ra_lawyer_answer set feedback='', rating='' where id='".$_POST['cid']."'") or die(mysql_error());
	
	if($del){
		$error = "Comment deleted successfully";
	}else{
		$error = "Comment not deleted, please try again";
		
	}
	echo $error ;
}


?>