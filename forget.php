<?php
session_start();

//masukkan semua include yang penting disini terutama connection kepada database
include "include/db.php";
include "include/setting.php";
include "include/clean.php";
include "include/main_function.php";


$forget=mysqli_query($con,"SELECT * from tbl_user where email='$_POST[email]'") or die (mysqli_error($con));	
$bil_rekod_forget=mysqli_num_rows($forget);
$papar_rekod_forget=mysqli_fetch_array($forget);


if ($bil_rekod_forget==0)
{$status=0;}
else
{$status=1;

//generate random password


$newPWD=getPwd(8);
echo $newPWD."<br>";
$newPWD=md5($newPWD);
echo $newPWD;
mysqli_query($con,"UPDATE tbl_user set pwd='$newPWD' where userid='$papar_rekod_forget[userid]'") or die (mysqli_error($con));



//sent email using PHPMailer

$tarikh=date("d-m-Y");
$ipdia=$_SERVER['REMOTE_ADDR'];

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = $smtp_host;                    // Specify main and backup SMTP servers
$mail->SMTPAuth = $smtp_auth;                            // Enable SMTP authentication
$mail->Username = $smtp_user;          // SMTP username
$mail->Password = $smtp_pwd; // SMTP password
$mail->SMTPSecure = $smtp_mode;                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = $smtp_port;                                 // TCP port to connect to

$mail->setFrom($smtp_email, $smtp_name);
$mail->addReplyTo($smtp_email, $smtp_name);
$mail->addAddress($papar_rekod_forget['email'],$papar_rekod_forget['name']);   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>Account Details</h1>';
$bodyContent .= "	<html>
			<head>
			<title>Account Details</title>
			</head>
			<body>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<table width='600'>
			<tr>
			  <th colspan='2'>&nbsp;</th>
			  <th align='right'>$logo</th>
			</tr>
			<tr>
			  <th colspan='3' align='left'>User Account</th>
			  </tr>
			<tr>
			<th colspan='2'>&nbsp;</th>
			<th width='190'>&nbsp;</th>
			</tr>
			<tr>
			  <th colspan='2' align='left'>Dear user,</th>
			  <th>&nbsp;</th>
			</tr>
			<tr>
			  <td colspan='2' align='left'><p align='justify'>
			  
			  
An application your user account has been made through the $web_title. If you do not request this information, please notify the system administrator. The following information is provided as requested:
			  
			  
			  
			  
			  </p></td>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <th colspan='2'>&nbsp;</th>
			  <th>&nbsp;</th>
			</tr>
			<tr>
			  <th width='300' align='left'>Name: </th>
			  <td width='500' align='left'>$papar_rekod_forget[name]</td>
			  <th>&nbsp;</th>
			</tr>
			
			
			<tr>
			  <th width='300' align='left'>Username </th>
			  <td width='500' align='left'>$papar_rekod_forget[username]</td>
			  <th>&nbsp;</th>
			</tr>
			
			<tr>
			  <th width='300' align='left'>Pasword: </th>
			  <td width='500' align='left'>$papar_rekod_forget[pwd]</td>
			  <th>&nbsp;</th>
			</tr>
			
			<tr>
			  <th align='left'>Date</th>
			  <td align='left'><strong>$tarikh</strong></td>
			  <th>&nbsp;</th>
			</tr>
			
			
			<tr>
			  <th align='left'>IP Address</th>
			  <td align='left'><strong>$ipdia</strong></td>
			  <th>&nbsp;</th>
			</tr>
			
		
			
			
			<tr>
			  <th colspan='2'>&nbsp;</th>
			  <th>&nbsp;</th>
			</tr>
			<tr>
			<td colspan='2'>Thank you.</td>
			<td>&nbsp;</td>
			</tr>
			</table>
			</body>
			</html>";

$mail->Subject = $web_title2.' User Account';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo '';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '';
}	






















}




?>


					<div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Status</h4>
                                  Successfully executed. If you have an account with us, the copy of your account details will be emailed to your registered email address.
                              
		                      </div>




                                
		                    
                        
		      