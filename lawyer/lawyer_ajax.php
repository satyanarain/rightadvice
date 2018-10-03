<?php 
session_start();
include("../wp-config.php");
function formateData($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(isset($_POST['update_lawyer']))
{
	
	$documents_old = $_POST['documents_old'];
	
	/*$j = 0;     // Variable for indexing uploaded image.
	$target_path = "files/";   // Declaring Path for uploaded images.
	$errors = '';
		
	for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
	{
		$target_path = time().$_FILES['file']['name'][$i] ;     // Set the target path with a new name of image.
		$doc_name = time().$_FILES['file']['name'][$i];
		$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
		
		move_uploaded_file($_FILES['file']['tmp_name'][$i], "files/".$target_path);
		
		$documents[] = $doc_name;
		$doc_name = ''; 
	}
	$docss = implode('^',$documents);
	if(!is_numeric($docss)){
		$docs = $documents_old.'^'.$docss;
	}else{
		$docs = $documents_old;
	}*/
	
	$docs = $documents_old;
	$full_name = formateData($_POST['full_name']);
	$mobile = formateData($_POST['mobile']);
	//$address = formateData($_POST['address']);
	$address = addslashes($_POST['address']);
	$dob = formateData($_POST['dob']);
	$gender = formateData($_POST['gender']);
	$organization_name = formateData($_POST['organization_name']);
	$email = formateData($_POST['email']);
	
	//$about = formateData($_POST['about']);
	$about = $_POST['about'];
	
	$categories[] = $_POST['categories'];
	
	$result = array_reduce($categories, 'array_merge', array());
	$categories = implode('^',$result);
	
	$city = formateData($_POST['city']);
	$postcode = formateData($_POST['postcode']);
	
	$Specialities_arr = implode('^',$_POST['Specialities_arr']);
	$languages = implode('^',$_POST['language']);
	
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
	//$ExperienceTranining = formateData($_POST['ExperienceTranining']);
	$ExperienceTranining = $_POST['ExperienceTranining'];
	//$education = formateData($_POST['education']);
	$education = $_POST['education'];
	$apprenticeships = formateData($_POST['apprenticeships']);
	$residency = formateData($_POST['residency']);
	$practiseArea = formateData($_POST['practiseArea']);
	$certifications = formateData($_POST['certifications']);
	$prelaw = formateData($_POST['prelaw']);
	$law_school = formateData($_POST['law_school']);
	$law_degree = formateData($_POST['law_degree']);
	$bar_exam = formateData($_POST['bar_exam']);
	$practice_course = formateData($_POST['practice_course']);
	$nationality = formateData($_POST['nationality']);
	$courts = formateData($_POST['courts']);
	$location = formateData($_POST['location']);
	
	
	$updateData = mysql_query("update ra_lawyers set  	
						full_name = '$full_name',
						mobile = '$mobile',
						address = '$address',
						dob = '$dob',
						gender = '$gender',
						organization_name = '$organization_name',
						documents = '$docs',
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
						nationality = '$nationality',
						courts = '$courts',
						location = '$location'
						
						where email = '$email' ") or die(mysql_error());
			
	if($updateData)
	{
		$_SESSION['reg_succ'] = 'Information updated successfully';
	}
	else{
		$_SESSION['reg_error'] = 'Information not updated, please try again';
	}

	header("location:manage-profile");
}

if(isset($_POST['action']) && $_POST['action'] == 'change_password')
{
	$c_pass = $_POST['c_pass'];
	$n_pass = $_POST['n_pass'];
	$r_pass = $_POST['r_pass'];
	$error = '';
	
	//print_r($_POST); die;
	if($c_pass == ''){
		$error = 'Please enter your current password';
	}
	else if($n_pass == ''){
		$error = 'Please enter your new password';
	}
	else if($r_pass == ''){
		$error = 'Please confirm your new password';
	}
	else if($n_pass != $r_pass){
		$error = 'Your confirm passwords do not matched';
	}
	else
	{
		$match_pass = mysql_query("select password from ra_lawyers where email = '".$_SESSION['lawyerEmail']."' ") or die(mysql_error());
		$old_pass = mysql_fetch_assoc($match_pass);
		
		if(md5($c_pass) == $old_pass['password'])
		{
			$change = mysql_query("update ra_lawyers set password = '".md5($n_pass)."' where email = '".$_SESSION['lawyerEmail']."' ") or die(mysql_error());
			if($change)
				$error = "Password changed successfully";
			else
				$error = "Password not changed, please try again";
		}
		else{
			$error = "You are entering wrong current password";
		}
			
	}
	echo $error;
	
}

if(isset($_FILES['photoimg']) && $_FILES['photoimg'] != '')
{
	$session_id = $_SESSION['lawyerId']; // User session id
	$path = "profile_pics/";
	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");

	$name = $_FILES['photoimg']['name'];
	$size = $_FILES['photoimg']['size'];
	
	if(strlen($name))
	{
		list($txt, $ext) = explode(".", $name);
		if(in_array($ext,$valid_formats))
		{
			if($size<(1024*1024)) // Image size max 1 MB
			{
				$actual_image_name = time().$session_id.".".$ext;
				$tmp = $_FILES['photoimg']['tmp_name'];
				if(move_uploaded_file($tmp, $path.$actual_image_name))
				{
					mysql_query("UPDATE ra_lawyers SET profile_image='$actual_image_name' WHERE email='".$_SESSION['lawyerEmail']."' ");
					echo "<img src='profile_pics/".$actual_image_name."' class='preview'>";
				}
				else
					echo "failed";
			}
			else
				echo "Image file size max 1 MB"; 
		}
		else
			echo "Invalid file format.."; 
	}
	else
		echo "Please select image..!";
	exit;
}

if(isset($_GET['lid']) && $_GET['lid'] != '')
{
	$email = base64_decode($_GET['lid']);
	if($email != '')
	{
		session_unset($_SESSION['lawyerEmail']);
		session_destroy();
		header("location:http://35.154.128.159:83/lawyer-login");
	}
}

if(isset($_POST['action']) && $_POST['action'] = 'remove_document')
{
	$doc = $_POST['img'];
	$query = mysql_query("select documents from ra_lawyers where email = '".$_SESSION['lawyerEmail']."' ");
	if(mysql_num_rows($query) > 0)
	{
		$documents = mysql_fetch_assoc($query);
		$docu = explode('^',$documents['documents']);
		
		$new_doc = array();
		foreach($docu as $value)
		{
			if($value == $doc)
			{
				continue;
			}
			else
			{
				$new_doc[] = $value;
			}     
		}
		$docss = implode('^',$new_doc); 
		
		$qr = mysql_query("update ra_lawyers set documents = '$docss' where email = '".$_SESSION['lawyerEmail']."' ") or die(mysql_error());
		if($qr)
			echo "success";
		else
			echo "faliled";
	}
}

if(isset($_POST['lawyer_reply']))
{
	$error = '';
	$valid_formats = array("jpg", "png", "pdf", "docx", "doc", "doc", "txt", "rtf");
	$max_file_size = 1024*5000; //1000 kb
	$path = "files/"; // Upload directory
	$count = 0;

	/* $total = count($_FILES['upload']['name']); 
	for($i=0; $i<$total; $i++) 
	{
		$tmpFilePath = $_FILES['upload']['tmp_name'][$i];

		if ($tmpFilePath != "")
		{
			$newFilePath = "files/" . $_FILES['upload']['name'][$i];

			if(move_uploaded_file($tmpFilePath, $newFilePath)) 
			{ 
				$docs[] = $_FILES['upload']['name'][$i];
			}
		}
	} */
	
	$qid = $_POST['qid'];
	$lawyer_id = $_POST['lawyer_id'];
	$client_id = $_POST['client_id'];
	$reply = $_POST['reply'];
	$reply_date = date('Y-m-d H:i:s');
	
	if($reply == '')
	{
		$error = "Please enter your reply";
	}
	else
	{
		if(isset($_FILES['upload']) && $_FILES['upload']['name'] != '')
		{
			$dnames = '';
			foreach ($_FILES['upload']['name'] as $f => $name)
			{     
				if ($_FILES['upload']['error'][$f] == 4) {
					continue; // Skip file if any error found
				}	       
				if ($_FILES['upload']['error'][$f] == 0) {	           
					if ($_FILES['upload']['size'][$f] > $max_file_size) {
						$error = "$name is too large!. File size must be below 5 MB.";
						continue; // Skip large files
					}
					elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
						$error = "$name is not a valid format. Please upload only jpg, png, pdf, docx, doc, docs, txt or rtf extantion file.";
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
		if($docs)
			$docs = implode('^',$docs); 
		else 
			$docs = '';
		
		$query = mysql_query("insert into ra_lawyer_answer(qid, lawyer_id, client_id, reply, reply_date, attachment, document_names) values('$qid', '$lawyer_id', '$client_id', '$reply', '$reply_date', '$docs', '$dnames')") or die(mysql_error());
		
		if($query){
			$update_question = mysql_query("update ra_question set status ='1' where id='$qid' ") or die(mysql_error());
			
			$qr1 = mysql_query("select full_name,email from ra_front_users where id='".$client_id."' ") or die(mysql_error());
			$user_name = mysql_fetch_assoc($qr1);
			
			$qr2 = mysql_query("SELECT full_name FROM ra_lawyers where id='".$lawyer_id."' ") or die(mysql_error());
			$lawyer_name = mysql_fetch_assoc($qr2);
			$lawyername = $lawyer_name['full_name'];
			
			$qr3 = mysql_query("SELECT * FROM ra_question where id='".$qid."' ") or die(mysql_error());
			$question_details = mysql_fetch_assoc($qr3);
			$subjects = $question_details['subject'];
			$content = $question_details['content'];
		
			$to1 = $user_name['email'];
			
			$from = 'info@curedincurable.com';
			$subject1 = "Right Advice | Answer to your Question";

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
					<td align="center" height="60"><h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Ask A Question Response</h1></td>				
				</tr>
				<tr>
					<td height="60"><p style="color:#404040;font-size:12px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b><i>Lawyer has responded to your question.</i></b></p></td>
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
				<tr>
					<td><p style="color:#404040;font-size:14px; line-height:22px; font-family:HelveticaNeue-Light,arial,sans-serif; font-weight:lighter; padding:0;margin:0"><b>Reply : </b>'.$reply.'</p></td>
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
			$headers .= 'From: Right Advice <'.$from.'>'."\r\n".
				'Reply-To: '.$from."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			
			if(mail($to1,$subject1,$message,$headers)){
				$succ_msg = "Your reply is submitted successfully.";
			}else{
				$errors = 'Email sending fail.';
			}
		
		}
		else{
			$error = "Your reply not submitted, please try again.";
		}
	}
	if($error != '')
		$_SESSION['reg_error'] = $error;
	else
		$_SESSION['reg_succ'] = $succ_msg;
	
	header("location:reply-answer?qid=".$qid);
}

if(isset($_GET['rid']) && $_GET['rid'] != '')
{
	$query = mysql_query("update ra_lawyer_answer set feedback = '', rating = '' where id = '".$_GET['rid']."' ") or die(mysql_error());
	
	header("location:rating-comments");
}
?>