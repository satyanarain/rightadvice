<?php 
/*
* Template Name: Email Confirm Page
*/
session_start();
include("config.php");
ob_start(); 
get_header();

?>
<div class="breadcrumb-container">
	<div class="container">
		<ol class="breadcrumb">
			<?=get_breadcrumb()?>
		</ol>
	</div>
</div>
<div class="clearfix"></div>
<div class="area-sec" id="area-sec"> 
	<div class="container">
    	<div class="row">
	<?php 
		/* if(isset($_GET['tp']) && base64_decode($_GET['tp']) == 'user' && isset($_GET['eid']) && $_GET['eid'] != '' && isset($_GET['tid']) && $_GET['tid'] != '')
		{
			echo "User";
		} */
		
		if(isset($_GET['eid']) && $_GET['eid'] != '' && isset($_GET['tid']) && $_GET['tid'] != '')
		{
		
			$tid = ($_GET['tid']);
			$eid = ($_GET['eid']);
			$email = base64_decode($eid);
			
			$email_data = mysqli_query($conn,"select * from ra_front_users where email = '$email' and tid = '$tid' and eid = '$eid' and email_confirm != 1 ") or die(mysqli_error()) ;
			if(mysqli_num_rows($email_data) > 0)
			{
				$data = mysqli_fetch_assoc($email_data);
				$ttid = $data['tid'];
				$eeid = $data['eid'];
			}
			
			if($tid == $ttid && $eid == $eeid)
			{
				if(isset($_GET['tp']) && base64_decode($_GET['tp']) == 'user' )
				{
					$query = mysqli_query($conn,"update ra_front_users set email_confirm = 1, tid = '', eid = '' where email='$email' ") or die(mysqli_error());
				}
				/*
				else{
					$query = mysqli_query($conn,"update ra_lawyers set email_confirm = 1 where email='$email' ") or die(mysqli_error());
				}
				*/
				
				if($query){
					
					$to = $email;
					$subject = "Right Advice | Email Confirmed Successfully";
				
$htmlContent = '
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
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
                                                <td align="center" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://35.154.128.159:83" target="_blank"><img src="http://35.154.128.159:83/wp-content/themes/right_advice/images/logo.jpg"></a></td>
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
                                                    <h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Thank You!</h1>
                                                </td>
                                                <td width="25"></td>
                                            </tr>
                                            <tr>
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <p style="color:green;font-size:16px;font-family:HelveticaNeue-Light,arial,sans-serif; line-height:22px; font-weight:lighter; padding:0;margin:0;">Your email has been confirmed successfully!</p>
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
                                        	<tr><td colspan="2" height="30">&nbsp;</td></tr>
                                            <tr>
                                            	<td width="360" valign="top">
                                                	<div style="color:#a3a3a3;font-size:12px;font-family:HelveticaNeue-Light,arial,sans-serif;line-height:12px;padding:0;margin:0">&copy; 2017 Right Advice. All rights reserved.</div>
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
						echo "<h1 stye='text-align:center'>Email Confirmed Successfully! </h1><br><p><a href='http://35.154.128.159:83/user-login'>GO TO LOGIN PAGE</a></p>";
					
					}else{
						echo 'Email sending fail.';
					}

				
					session_unset($_SESSION['ttid']);
					session_unset($_SESSION['eeid']);
				}
				else
					echo "not update";
			}
			else
			{
				?>
					<h1 style='text-align:center'>You are not authorized to view this page </h1>
					<br><p><a href='<?=the_permalink(57)?>'>GO TO HOME PAGE</a></p>
			<?php 
			}
		} 
	?> 
	
		</div>
	</div>    
</div><!-- /.container -->


<?php get_footer();?>