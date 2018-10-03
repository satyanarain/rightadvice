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

if(isset($_POST['update_user']))
{
	
	$documents_old = $_POST['documents_old'];
	
	$j = 0;     // Variable for indexing uploaded image.
	$target_path = "files/";   // Declaring Path for uploaded images.
	$errors = '';
		
	/* for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
	{
		$target_path = time().$_FILES['file']['name'][$i] ;     // Set the target path with a new name of image.
		$doc_name = time().$_FILES['file']['name'][$i];
		$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
		
		move_uploaded_file($_FILES['file']['tmp_name'][$i], "files/".$target_path);
		
		$documents[] = $doc_name;
		$doc_name = ''; 
	}
	$docss = implode('^',$documents);
	$docs = $documents_old.'^'.$docss;
	 */
	$full_name = formateData($_POST['full_name']);
	$mobile = formateData($_POST['mobile']);
	$address = formateData($_POST['address']);
	$dob1 = formateData($_POST['dob']);
	$dob = date('Y-m-d',strtotime($dob1));
	$gender = formateData($_POST['gender']);
	$organization_name = formateData($_POST['organization_name']);
	$organization_name = addslashes($organization_name);
	$email = formateData($_POST['email']);
	$about = formateData($_POST['about']);
	$city = formateData($_POST['city']);
	$postcode = formateData($_POST['postcode']);
	
	
	$updateData = mysql_query("update ra_front_users set  	
						full_name = '$full_name',
						mobile = '$mobile',
						address = '$address',
						dob = '$dob',
						gender = '$gender',
						organization_name = '$organization_name',
						about = '$about',
						city = '$city',
						postcode = '$postcode'
						
						where email = '$email' ") or die(mysql_error());
			
	if($updateData)
	{
		$_SESSION['reg_succ'] = 'Record updated successfully';
	}
	else{
		$_SESSION['reg_error'] = 'Record not updated, please try again';
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
		$match_pass = mysql_query("select password from ra_front_users where email = '".$_SESSION['userEmail']."' ") or die(mysql_error());
		$old_pass = mysql_fetch_assoc($match_pass);
		
		if(md5($c_pass) == $old_pass['password'])
		{
			$change = mysql_query("update ra_front_users set password = '".md5($n_pass)."' where email = '".$_SESSION['userEmail']."' ") or die(mysql_error());
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
	$session_id = $_SESSION['userId']; // User session id
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
					mysql_query("UPDATE ra_front_users SET profile_image='$actual_image_name' WHERE email='".$_SESSION['userEmail']."' ");
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

if(isset($_GET['uid']) && $_GET['uid'] != '')
{
	$email = base64_decode($_GET['uid']);
	if($email != '')
	{
		session_unset($_SESSION['userEmail']);
		session_destroy();
		header("location:http://35.154.128.159:83/user-login");
	}
}

/* if(isset($_POST['action']) && $_POST['action'] == 'remove_document')
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
 */

if(isset($_POST['action']) && $_POST['action'] == 'give_feedback')
{
	 $rating = $_POST['rating'];
	 $feedback = $_POST['feedback'];
	 $qid = $_POST['qid'];
	 $lawyer_id = $_POST['lawyer_id'];
	 //print_r($_POST); die;
	 $query = mysql_query("update ra_lawyer_answer set feedback='$feedback', rating='$rating' where qid='$qid' AND client_id='$lawyer_id'") or die(mysql_error());
	
	 if($query)
		 echo "success";
	 else
		 echo "failed";
}
?>