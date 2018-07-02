<?php 
session_start();
include("config.php");
function formateData($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(isset($_POST['lawyer_registration']))
{
	//print_r($_POST);
	
	$full_name = formateData($_POST['full_name']);
	$email = formateData($_POST['email']);
	$mobile = formateData($_POST['mobile']);
	$dob = formateData($_POST['dob']);
	$gender = formateData($_POST['gender']);
	$organization_name = formateData($_POST['organization_name']);
	$user_password = formateData($_POST['user_password']);
	$confirm_password = formateData($_POST['confirm_password']);
	//$address = formateData($_POST['address']);
	$city = formateData($_POST['city']);
	if($city == 'Other')
	{
		$_SESSION['city'] = $city;
		$_SESSION['other'] = formateData($_POST['other']);
		$city = formateData($_POST['other']);
	}else {
		$_SESSION['city'] = $city;
		$_SESSION['other'] = '';
	}
	$country = formateData($_POST['country']);
	$_SESSION['country'] = $country;
	$added_date = date('d-m-Y H:i:s');
	
	$_SESSION['full_name'] = $full_name;
	$_SESSION['email'] = $email;
	$_SESSION['mobile'] = $mobile;
	$_SESSION['dob'] = $dob;
	$_SESSION['gender'] = $gender;
	$_SESSION['organization_name'] = $organization_name;
	//$_SESSION['address'] = $address;
	
	
	if($full_name == ''){
		$errors = 'Full Name is required';
	}
	else if(preg_match("/[^A-Za-z'-]/", $First)){
		$errors = 'Only alphanumeric and blank spaces allowed in Full Name.'; 
	}
	else if($email == ''){
		$errors = 'Email is required.';
	}
	else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {	
		$errors = 'Invalid email format.';
	}
	else if($mobile == ''){
		$errors = 'Mobile Number is required.';
	}
	else if(!is_numeric($mobile)){
		$errors = 'Invalid Mobile Number.';
	}
	else if($gender == ''){
		$errors = 'Please select your Gender.';
	}
	else if($user_password == ''){
		$errors = 'Please enter your Password.';
	}
	else if($confirm_password == ''){
		$errors = 'Please confirm your Password.';
	}
	else if($user_password != $confirm_password){
		$errors = 'Passwords do not match.';
	}
	else	
	{
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
			$valid_formats = array("jpg", "png", "pdf", "docx", "doc", "doc", "txt", "rtf");
			$max_file_size = 1024*5000; //1000 kb
			//$path = "../../../files/"; // Upload directory
			//$path = "files/"; // Upload directory
			$path = "../../../lawyer/files/";
			$count = 0;
			
			if(isset($_FILES['documents']) && $_FILES['documents']['name'] != '')
			{
				$dnames = '';
				foreach ($_FILES['documents']['name'] as $f => $name)
				{     
					if ($_FILES['documents']['error'][$f] == 4) {
						continue; // Skip file if any error found
					}	       
					if ($_FILES['documents']['error'][$f] == 0) {	           
						if ($_FILES['documents']['size'][$f] > $max_file_size) {
							$errors = "$name is too large! File size should be below 5 MB.";
							continue; // Skip large files
						}
						if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
							$errors = "$name is not a valid format. Please upload only jpg, png, pdf, docx, doc, docs, txt or rtf extension files.";
							continue; // Skip invalid file formats
						}
						else{ // No error found! Move uploaded files 
							$randno = mt_rand(10,9999);
							if(move_uploaded_file($_FILES["documents"]["tmp_name"][$f], $path.$randno."-".$name))
								$count++; // Number of successfully uploaded file
							$docs[] = $_FILES['documents']['name'][$f];
							if (strlen($dnames) == 0)
							{
								$dnames = $randno."-".$name;
							}
							else
							{
								$dnames = $dnames."^".$randno."-".$name;
							}
						}
					}
				}
			}
			if($docs)
				$docs = implode('^',$docs); 
			else 
				$docs = '';
			
			
			if($errors == '')
			{
				
				//$address_new = addslashes($address);
				$insertData = mysql_query("insert into ra_lawyers(full_name, email, mobile, s_city, s_country, dob, gender, organization_name, documents, password, status, added_date, mobile_confirm, email_confirm, document_names) values('$full_name', '$email', '$mobile', '$city', '$country', '$dob', '$gender', '$organization_name', '$docs', '".md5($user_password)."', '0', now(), '0', '1', '$dnames')") or die(mysql_error());
				
				if($insertData)
				{
				/*	$eid = base64_encode($email);
					$tid = base64_encode(mt_rand(10,1000));
					$_SESSION['eeid'] = $eid;
					$_SESSION['ttid'] = $tid;
					
					$token = "http://curedincurable.com/rightadvice/email-confirm?eid=".$eid."&tid=".$tid;
					
					$to = $email;
					$subject = "Right Advice - Email Confirmation Link";
				
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
                                            	<td width="30">&nbsp;</td>
                                                <td align="center" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://curedincurable.com/rightadvice" target="_blank"><img src="http://curedincurable.com/rightadvice/wp-content/themes/right_advice/images/logo.jpg"></a></td>
                                                <td width="30">&nbsp;</td>
                                            </tr>
                                       	</tbody>
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
                                            <tr>
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <p style="color:#404040;font-size:16px; line-height:22px; font-weight:lighter; padding:0;margin:0">Click on the below link to confirm your email address.</p>
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
                                        <tr><td colspan="3" height="30">&nbsp;</td></tr>
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
						$succ_msg = 'Your data submitted successfully. Please wait for approval from Right Advice Team. Please confirm your email. We have sent a confirmation link at your registered email address.';
					}else{
						$errors = 'Email sending fail.';
					}
*/
				$_SESSION['full_name'] = '';
				$_SESSION['email'] = '';
				$_SESSION['mobile'] = '';
				$_SESSION['dob'] = '';
				$_SESSION['gender'] = '';
				$_SESSION['organization_name'] = '';
				$_SESSION['city'] = '';
				$_SESSION['other'] = '';
				$_SESSION['country'] = '';
	
				$succ_msg = 'Your data submitted successfully. Please wait for approval from Right Advice Team.';
				}	
				
			}
			
		}
	}
	if(!empty($errors)){
		$_SESSION['reg_error'] = $errors;
	}else if(!empty($succ_msg)){
		$_SESSION['reg_succ'] = $succ_msg;
	}
	$url = "http://curedincurable.com/rightadvice/lawyer-registration";
	header("location:$url");
}


if(isset($_POST['lawyer_login']))
{
	$email = formateData($_POST['email']);
	$user_password = formateData($_POST['user_password']);
	
	if($email == ''){
		$errors = 'Please enter your email.';
	}
	else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {	
		$errors = 'Invalid email format.';
	}
	else if($user_password == ''){
		$errors = 'Please enter your password.';
	}
	else	
	{
		
		$loginData = mysql_query("select * from ra_lawyers where email = '$email' and password = '".md5($user_password)."' ") or die(mysql_error());
		
		if(mysql_num_rows($loginData) > 0)
		{
			$data = mysql_fetch_assoc($loginData);
			$url = "http://curedincurable.com/rightadvice/lawyer-login";
				
			/* if($data['email_confirm'] == 0)
			{
				$_SESSION['reg_error'] = 'You have not confirmed your email. Please check your email and confirm your email address.';
				header("location:$url");
			}
			else  */ 
			if($data['status'] == 0)
			{
				$_SESSION['reg_error'] = 'Your account is not activated by Right Advice Team, please wait till approval.';
				header("location:$url");
			} 
			else
			{
				$_SESSION['lawyerID'] = $data['id'];
				$_SESSION['lawyerName'] = $data['full_name'];
				$_SESSION['lawyerEmail'] = $data['email'];
				$url = "http://curedincurable.com/rightadvice/lawyer/dashboard";
				header("location:$url");
			}
		}
		else{
			$_SESSION['reg_error'] = 'Invalid email or password, please try again.';
			$url = "http://curedincurable.com/rightadvice/lawyer-login";
			header("location:$url");
		}
	
	}
	
	
}


if(isset($_POST['user_registration']))
{
	$full_name = formateData($_POST['full_name']);
	$email = formateData($_POST['email']);
	$mobile = formateData($_POST['mobile']);
	$dob = formateData($_POST['dob']);
	$gender = formateData($_POST['gender']);
	$organization_name = formateData($_POST['organization_name']);
	$user_password = formateData($_POST['user_password']);
	$confirm_password = formateData($_POST['confirm_password']);
	//$address = formateData($_POST['address']);
	$city = formateData($_POST['city']);
	if($city == 'Other')
	{
		$_SESSION['city'] = $city;
		$_SESSION['other'] = formateData($_POST['other']);
		$city = formateData($_POST['other']);
	}else {
		$_SESSION['city'] = $city;
		$_SESSION['other'] = '';
	}
	$country = formateData($_POST['country']);
	$_SESSION['country'] = $country;
	$added_date = date('d-m-Y H:i:s');
	
	
	$_SESSION['cfull_name'] = $full_name;
	$_SESSION['cemail'] = $email;
	$_SESSION['cmobile'] = $mobile;
	$_SESSION['cdob'] = $dob;
	$_SESSION['cgender'] = $gender;
	$_SESSION['corganization_name'] = $organization_name;
	//$_SESSION['caddress'] = $address;
	
	
	if($full_name == ''){
		$errors = 'Full Name is required.';
	}
	else if(preg_match("/[^A-Za-z'-]/", $First)){
		$errors = 'Only alphanumeric and blank spaces allowed in Full Name.'; 
	}
	else if($email == ''){
		$errors = 'Email is required.';
	}
	else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {	
		$errors = 'Invalid email format.';
	}
	else if($mobile == ''){
		$errors = 'Mobile Number is required.';
	}
	else if(!is_numeric($mobile)){
		$errors = 'Invalid Mobile Number.';
	}
	else if($gender == ''){
		$errors = 'Please select your Gender.';
	}
	else if($user_password == ''){
		$errors = 'Please enter your Password.';
	}
	else if($confirm_password == ''){
		$errors = 'Please confirm your Password.';
	}
	else if($user_password != $confirm_password){
		$errors = 'Passwords do not match.';
	}
	else	
	{
		$is_exists = mysql_query("select * from ra_front_users where email = '$email' ");
		$iss_exists = mysql_query("select * from ra_lawyers where email = '$email' ");
		if(mysql_num_rows($is_exists) > 0)
		{
			$errors = 'Client Email already exists.';
		}
		else if(mysql_num_rows($iss_exists) > 0)
		{
			$errors = 'Lawyer Email already exists.';
		}
		else
		{

			$eid = base64_encode($email);
			$tid = base64_encode(mt_rand(10,1000));
			
			$organization_name = addslashes($organization_name);

			$insertData = mysql_query("insert into ra_front_users (full_name, email, mobile, s_city, s_country, dob, gender, organization_name, password, status, added_date, mobile_confirm, eid, tid) values('$full_name', '$email', '$mobile', '$city', '$country', '$dob', '$gender', '$organization_name', '".md5($user_password)."', '0', now(), '0', '$eid', '$tid')") or die(mysql_error());
			
			if($insertData)
			{
				$type =  base64_encode('user');
				//$_SESSION['eeid'] = $eid;
				//$_SESSION['ttid'] = $tid;
				
				$token = "http://curedincurable.com/rightadvice/email-confirm?eid=".$eid."&tid=".$tid."&tp=".$type;
				
				$to = $email;
				$subject = "Right Advice | Email Confirmation Link";
				
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
                                            	<td width="30">&nbsp;</td>
                                                <td align="center" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://curedincurable.com/rightadvice" target="_blank"><img src="http://curedincurable.com/rightadvice/wp-content/themes/right_advice/images/logo.jpg"></a></td>
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
                                            	<td colspan="3" height="60"></td></tr><tr><td width="25"></td>
                                                <td align="center">
                                                    <h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Welcome to Right Advice</h1>
                                                </td>
                                                <td width="25"></td>
                                            </tr>
                                            <tr>
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <p style="color:#404040;font-size:16px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0">Click on the below link to confirm your email address.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                            <td colspan="4">
                                                <div style="width:100%;text-align:center;margin:30px 0">
                                                    <table align="center" cellpadding="0" cellspacing="0" style="font-family:HelveticaNeue-Light,Arial,sans-serif; margin:0 auto; padding:0">
                                                    <tbody>
                                                    	<tr>
                                                            <td align="center" style="margin:0;text-align:center"><a href="'.$token.'" style="font-size:21px; font-family:HelveticaNeue-Light,arial,sans-serif; line-height:22px; text-decoration:none; color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank">Confirm Email</a></td>
                                                      	</tr>
                                                   	</tbody>
                                                    </table>
                                               	</div>
                                           	</td>
                                       	</tr>
                                        <tr><td colspan="3" height="30">&nbsp;</td></tr>
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
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: Right Advice <'.$from.'>'."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 

				// Send email
				if(mail($to,$subject,$htmlContent,$headers)){
					$succ_msg = 'Your registration is successful. We have sent a confirmation link in your registered email address. Please validate your email address.';
				
					$_SESSION['cfull_name'] = '';
					$_SESSION['cemail'] = '';
					$_SESSION['cmobile'] = '';
					$_SESSION['cdob'] = '';
					$_SESSION['cgender'] = '';
					$_SESSION['corganization_name'] = '';
					$_SESSION['city'] = '';
					$_SESSION['other'] = '';
					$_SESSION['country'] = '';

				}else{
					$errors = 'Email sending failed.';
				}
				
				
			}
			else{
				$errors = 'Data not submitted, please try again!';
			}
		}
	}
	//echo $errors;
	if(!empty($errors)){
		$_SESSION['reg_error'] = $errors;
	}else if(!empty($succ_msg)){
		$_SESSION['reg_succ'] = $succ_msg;
	}
	
	$url = "http://curedincurable.com/rightadvice/user-registration";
	header("location:$url");
}


if(isset($_POST['user_login']))
{
	$email = formateData($_POST['email']);
	$user_password = formateData($_POST['user_password']);
	if(isset($_POST['llid'])){
		$llid = $_POST['llid'];
	}else{
		$llid = '';
	}
	
	if($email == ''){
		$errors = 'Please enter your email.';
	}
	else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {	
		$errors = 'Invalid email format';
	}
	else if($user_password == ''){
		$errors = 'Please enter your password.';
	}
	else	
	{
		
		$loginData = mysql_query("select * from ra_front_users where email = '$email' and password = '".md5($user_password)."' ") or die(mysql_error());
		
		if(mysql_num_rows($loginData) > 0)
		{
			$data = mysql_fetch_assoc($loginData);
			
			if($data['email_confirm'] != 0)
			{
				$_SESSION['userID'] = $data['id'];
				$_SESSION['userName'] = $data['full_name'];
				$_SESSION['userEmail'] = $data['email'];
				
				if($llid != '')
					$url = "http://curedincurable.com/rightadvice/lawyer-profile?lid=".base64_encode($llid);
				else
					$url = "http://curedincurable.com/rightadvice/user/dashboard";
				header("location:$url");
			}
			else{
				$_SESSION['reg_error'] = 'You have not confirmed your email. Please check your email and confirm your email address.';
				$url = "http://curedincurable.com/rightadvice/user-login/";
				header("location:$url");
			}
		}
		else{
			$_SESSION['reg_error'] = 'Invalid email or password, please try again.';
			$url = "http://curedincurable.com/rightadvice/user-login/";
			header("location:$url");
		}
	
	}
	
	
}

if(isset($_POST['action']) && $_POST['action'] == 'ajax_filter')
{
	//print_r($_POST);
	$tokenfield = $_POST['tokenfield'];
	$tokenfield = str_replace(', ','^',$tokenfield);
	$tt = explode('^',$tokenfield);
	$location = $_POST['location'];
	$language = $_POST['language'];
	$nationality = $_POST['nationality'];
	$lawyername = $_POST['lawyername'];
	//$specialty = str_replace(', ','^',$tokenfield); die;
	
	$query = 'select * from ra_lawyers where status =1 AND email_confirm=1 ';
	if(count($tt) > 0 ){
		//$specialty = str_replace(', ','^',$tokenfield);
		for($i=0; $i<count($tt); $i++)
		{
			$query .= ' AND Specialities_arr like "%'.$tt[$i].'%"';
		}
		
	}
	if($location != ''){
		$query .= ' AND location like "%'.$location.'%"';
	}
	if($language != ''){
		$query .= ' AND languages like "%'.$language.'%"';
	}
	if($nationality != ''){
		$query .= ' AND nationality like "%'.$nationality.'%"';
	}
	if($lawyername != ''){
		$query .= ' AND full_name like "%'.$lawyername.'%"';
	}
	
	//echo $query; die;
	$sql = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($sql) > 0)
	{ ?>
		<h4 class="layhd"> (<?php echo mysql_num_rows($sql); ?>) Lawyers Found</h4>
	<?php 	
		while($lawyer = mysql_fetch_assoc($sql))
		{ 
?>
			<div class="listing-item bordered light-gray-bg mb-20">
				<div class="row grid-space-0">
					<div class="col-sm-4 col-md-3 col-lg-3 prof1">
					
						<a href="lawyer-profile?lid=<?=base64_encode($lawyer['id'])?>">
							<?php if($lawyer['profile_image']){?>
								<img src="http://curedincurable.com/rightadvice/lawyer/profile_pics/<?=$lawyer['profile_image']?>" alt="<?=$lawyer['full_name']?>">
							<?php }else {?>
								<img src="http://curedincurable.com/rightadvice/wp-content/themes/right_advice/images/no-image.jpg" alt="<?=$lawyer['full_name']?>">
							<?php }?>
						</a>
						<div class="clear"></div>
					</div>

					<div class="col-sm-8 col-md-9 col-lg-9">
						<div class="body">
							<h3 class="margin-clear"> <a href="lawyer-profile?lid=<?=base64_encode($lawyer['id'])?>"><?=$lawyer['full_name']?> </a></h3>
							
				<?php

					
						$rat = mysql_query("select rating from ra_lawyer_answer where lawyer_id ='".$lawyer['id']."'")  or die(mysql_error());
						$rating = '0';
						$rats = '0';
						$total = mysql_num_rows($rat);
						if($total > 0)
						{
							
							while($ratings = mysql_fetch_assoc($rat))
							{
								$rating = $rating + $ratings['rating'];
							}
							
							
						}	
						$rats = $rating / $total;
					

				?>							
							
							
							<p>
										<?php for($i=0; $i<round($rats); $i++){?>
										<i class="fa fa-star text-default"></i>
										<?php }for($j=0; $j<5-round($rats); $j++){?>
										<i class="fa fa-star"></i>
										<?php } ?>

							</p>

							<p class="small"><span><i class="fa fa-map-marker"></i></span> <?=$lawyer['s_city'].', '.$lawyer['s_country']?></p>
						</div>
					</div>

					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="ltag">
							<?php 
								if($lawyer['Specialities_arr'] != ''){
									$specialty = explode('^',$lawyer['Specialities_arr']);
									for($i=0; $i<count($specialty); $i++){
								?>
									<a href="javascript:void(0)"><?=$specialty[$i]?></a> 
								<?php }}?>
						</div>

						<div class="elements-list clearfix">	
							<a href="lawyer-profile?lid=<?=base64_encode($lawyer['id'])?>" class="pull-right btn btn-sm btn-default-transparent btn-animated">View Profile <i class="fa fa-user"></i></a>
						</div>
					</div>
				</div>
			</div>
			
									
<?php   }
	}else{
		echo "<h4 class='layhd'>No record founds</h4>";
	}
}


if(isset($_POST['add_question']))
{
	//print_r($_POST); die;
	$errors = '';
	
	$valid_formats = array("jpg", "png", "pdf", "docx", "doc", "doc", "txt", "rtf");
	$max_file_size = 1024*2000; //1000 kb
	$path = "../../../lawyer/files/"; // Upload directory
	$count = 0;

	
	/* $total = count($_FILES['upload']['name']);
	$path = "../../../lawyer/files/";
	for($i=0; $i<$total; $i++) 
	{
		$tmpFilePath = $_FILES['upload']['tmp_name'][$i];

		if($tmpFilePath != "")
		{
			$newFilePath =  $path.$_FILES['upload']['name'][$i];

			if(move_uploaded_file($tmpFilePath, $newFilePath)) 
			{
				$docs[] = $_FILES['upload']['name'][$i];
			}
		}
	} */
	
	$subjects = $_POST['subject'];
	$content = $_POST['editor1']; 
	$client_email = $_POST['client_email']; 
	$client_id = $_POST['client_id']; 
	$lawyer_id =  $_POST['lawyer_id'];
	$added_date = date('Y-m-d H:i:s');
	
	if($subjects == '')
	{
		$errors = 'Subject is required';
	}
	else if($content == '')
	{
		$errors = 'Please enter your query';
	}
	else
	{
		$dnames = '';
		if(isset($_FILES['upload']) && $_FILES['upload']['name'] != '')
		{
			foreach ($_FILES['upload']['name'] as $f => $name)
			{     
				if ($_FILES['upload']['error'][$f] == 4) {
					continue; // Skip file if any error found
				}	       
				if ($_FILES['upload']['error'][$f] == 0) {	           
					if ($_FILES['upload']['size'][$f] > $max_file_size) {
						$errors = "$name is too large!. File size must be below 2 MB.";
						continue; // Skip large files
					}
					elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
						$errors = "$name is not a valid format. Please upload only jpg, png, pdf, docx, doc, docs, txt or rtf extension files.";
						continue; // Skip invalid file formats
					}
					else{ // No error found! Move uploaded files 
						$randno = mt_rand(10,9999);
						if(move_uploaded_file($_FILES["upload"]["tmp_name"][$f], $path.$randno."-".$name))
						$count++; // Number of successfully uploaded file
						$docs[] = $_FILES['upload']['name'][$f];
						if (strlen($dnames) == 0)
							{
								$dnames = $randno."-".$name;
							}
							else
							{
								$dnames = $dnames."^".$randno."-".$name;
							}
					}
				}
			}
		}
		
		//echo $errors; die;
		if($errors == '')
		{
			if($docs)
				$docs = implode('^',$docs); 
			else 
				$docs = '';
			$qr = mysql_query("select id, email, full_name, admin_email from ra_lawyers where email='".$lawyer_id."' ") or die(mysql_error());
			$lawyer_email = mysql_fetch_assoc($qr);

			$query = mysql_query("insert into ra_question(lawyer_id, subject, content, documents, added_date, client_id, client_email, document_names) value('".$lawyer_email['id']."', '".$subjects."', '".$content."', '".$docs."', '".$added_date."', '".$client_id."', '".$client_email."', '".$dnames."')") or die(mysql_error());
			
			if($query)
			{ 
				
				$qr1 = mysql_query("select full_name from ra_front_users where id='".$client_id."' ") or die(mysql_error());
				$user_name = mysql_fetch_assoc($qr1);
			
				$to = $lawyer_email['email'];
				$lawyername = $lawyer_email['full_name'];
				$clientname = $user_name['full_name'];
				$subject = "Right Advice | New Question Asked ";
				
				/*
				$htmlContent = '<h1>Dear  '.$lawyer_email['full_name'].',</h1>
							<p>You have new query from '.$user_name['full_name'].'. Details are :-</p>
							<table>
								<tr><td>Client Name : </td><td>'.$user_name['full_name'].'</td></tr>
								<tr><td>Subject : </td><td>'.$subjects.'</td></tr>
								<tr><td>Query : </td><td>'.$content.'</td></tr>
							</table>';
				*/
				
				$htmlContent = '<html>
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
                                                <td align="center" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://curedincurable.com/rightadvice" target="_blank"><img src="http://curedincurable.com/rightadvice/wp-content/themes/right_advice/images/logo.jpg"></a></td>
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
					<td align="center" height="60"><h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Ask A Question Details</h1></td>				
				</tr>
				<tr>
					<td height="60"><p style="color:#404040;font-size:12px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b><i>Please login to dashboard to reply.</i></b></p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Client Name : </b>'.$clientname.'</p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Subject : </b>'.$subjects.'</p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Question : </b>'.$content.'</p></td>
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
				$cc = $lawyer_email['admin_email'];
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Right Advice <'.$from.'>'."\r\n".
					'Reply-To: '.$from."\r\n" .
					'CC: '.$cc."\r\n".
					'X-Mailer: PHP/' . phpversion();
			 

				if(mail($to,$subject,$htmlContent,$headers))
				{
					
					$to1 = $client_email;
					$from = 'info@curedincurable.com';
					$subject1 = "RightAdvice | Question submitted successfully";
					/*
					$message = '<h3>Dear '.$user_name['full_name'].',</h3>
								<p>Thank you for asking question. We will contact you soon.</p>';
					*/
					
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
                                                <td align="center" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://curedincurable.com/rightadvice" target="_blank"><img src="http://curedincurable.com/rightadvice/wp-content/themes/right_advice/images/logo.jpg"></a></td>
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
					<td align="center" height="60"><h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Ask A Question Details</h1></td>				
				</tr>
				<tr>
					<td height="60"><p style="color:#404040;font-size:12px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b><i>Thank you for asking question. It will be responded soon.</i></b></p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Lawyer Name : </b>'.$lawyername.'</p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Subject : </b>'.$subjects.'</p></td>
				</tr>
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Question : </b>'.$content.'</p></td>
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
					
					
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: RightAdvice <'.$from.'>'."\r\n".
						'Reply-To: '.$from."\r\n" .
						'X-Mailer: PHP/' . phpversion();
					
					if(mail($to1,$subject1,$message,$headers)){
						$succ_msg = 'Your question submitted successfully. Please wait for response from lawyer.';
					}else{
						$errors = 'Client Email sending fail.';
					}
				}else{
					$errors = 'Lawyer Email sending fail.';
				}
				
			}
			else
			{
				$errors = 'Your question not submitted, please try again';
			} 
		}
	}
	
	if($succ_msg != '')
		$_SESSION['reg_succ'] = $succ_msg;
	else
		$_SESSION['reg_error'] = $errors;
	
	$id = base64_encode($lawyer_id);
	$url = "http://curedincurable.com/rightadvice/question?qid=".$id;
	header("location:$url");
}


if(isset($_POST['forgot_password']))
{
	$email = $_POST['email'];
	
	$query = mysql_query("select full_name,email from ra_front_users where email='$email' AND email_confirm='1' ") or die(mysql_error());
	if(mysql_num_rows($query) > 0)
	{
		$data = mysql_fetch_assoc($query);
		$send_email = $data['email'];
		
	}
	else 
	{
		$query = mysql_query("select full_name,email from ra_lawyers where email='$email' AND status='1'  AND email_confirm='1' ") or die(mysql_error());
		if(mysql_num_rows($query) > 0)
		{
			$data = mysql_fetch_assoc($query);
			$send_email = $data['email'];	
			
		}
		else
		{
			$errors = "Sorry, this email is not registered";
		}
	}	
	if(mysql_num_rows($query) > 0)
	{
		$to = $send_email;
		$subject = "Right Advice | Reset Password";
		
		$eid = base64_encode($send_email);
		$token = base64_encode("R@#".mt_rand(10,99999));
		$_SESSION['tid'] = $token;
		$_SESSION['eid'] = $eid;
		
		$forgot_link = "http://curedincurable.com/rightadvice/change-password?tid=".$token."&eid=".$eid;
		
		$htmlContent = '<html>
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
                                                <td align="center" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://curedincurable.com/rightadvice" target="_blank"><img src="http://curedincurable.com/rightadvice/wp-content/themes/right_advice/images/logo.jpg"></a></td>
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
					<td align="center" height="60"><p style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:16px;color:#404040;line-height:22px;font-weight:bold;margin:0;padding:0">You have requested to reset password. Please click on the below link to reset your password.</p><br/></td>				
				</tr>
				
				<tr>
					<td align="center" style="margin:0;text-align:center"><a href="'.$forgot_link.'" style="font-size:21px; font-family:HelveticaNeue-Light,arial,sans-serif; line-height:22px; text-decoration:none; color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank">Reset Password</a></td>
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
				//$cc = $lawyer_email['admin_email'];
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Right Advice <'.$from.'>'."\r\n".
					'Reply-To: '.$from."\r\n" .
					'X-Mailer: PHP/' . phpversion();
			 

				if(mail($to,$subject,$htmlContent,$headers))
				{
					$succ_msg = "Link to reset password has been sent on your registered email address";
				}
				else{
					$errors = "Email not send. Please try again";
				}
	}

	if($succ_msg != '')
		$_SESSION['reg_succ'] = $succ_msg;
	else
		$_SESSION['reg_error'] = $errors;
	
	$url = "http://curedincurable.com/rightadvice/forgot-password";
	header("location:$url");	
	
}

if(isset($_POST['action']) && $_POST['action'] == 'change_forgot_password') 
{
	//print_r($_POST);
	$email = $_POST['email'];
	$password = $_POST['password'];
	$query = mysql_query("update ra_front_users set password = '".md5($password)."' where email = '".$email."' ");
	if($query)
	{
		$errors = "Password Changed Successfully";
		unset($_SESSION['tid']);
		unset($_SESSION['eid']);
	}
	else
	{
		$query1 = mysql_query("update ra_lawyers set password = '".md5($password)."' where email = '".$email."' ");
		if($query1){
			$errors = "Password Changed Successfully";
			unset($_SESSION['tid']);
			unset($_SESSION['eid']);
		}else{
			$errors = "Password not changed, there may be some problem please try again";
		}
	}
	
	
	echo $errors;
}
?>