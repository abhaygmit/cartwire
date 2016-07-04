<?php
	//require("english.php");
	//require("phpmailer/phpmailer.php");

function sendMail1($to, $to_name, $from, $from_name, $subject, $message, $isHTML = true)
{
	//echo "hi";die();
	$mail = new PHPMailer();
	
	$mail->IsSMTP();                                   // send via SMTP
	$mail->Host     = SMTP_SERVER; // SMTP servers
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Port 	=SMTP_PORT;
	$mail->Username = SMTP_USER;  // SMTP username
	$mail->Password = SMTP_PASSWD; // SMTP password
	//print_r($mail);exit();
	$mail->From     = $from;
	$mail->FromName = $from_name;
	$mail->AddAddress($to,$to_name); 
	//$mail->AddAddress(OPTIONAL_EMAIL);               // optional name
	$mail->AddReplyTo($from,$from_name);
	
	$mail->WordWrap = 50;                              // set word wrap
	
	$mail->IsHTML($isHTML);                               // send as HTML
	
	$mail->Subject  = $subject;
	$mail->Body     =  $message;
	
	if(!$mail->Send())
	{
	   echo $mail->ErrorInfo;
	  
	}
	
	return SUCCESS_MSG;


}

function sendMail($to, $to_name, $from, $from_name, $subject, $message, $isHTML = true, $cc)
{
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	// More headers
	$headers .= 'From: <info@cartwire.com>' . "\r\n";
	if($cc != ''){
		$headers .= 'Cc:'. $cc . "\r\n";
	}else{
		$headers .= 'Cc: atul.verma@srmtechsol.com' . "\r\n";
	}
	echo $headers; 
	if(!mail($to,$subject,$message,$headers))
	{
	   echo $mail->ErrorInfo;
	  
	}
	
	return SUCCESS_MSG;


}

function sendMailReplyTo($to, $to_name, $from, $from_name, $subject, $message, $repyname, $replyaddress, $isHTML = true)
{
	
	$mail = new PHPMailer();
	
	$mail->IsSMTP();                                   // send via SMTP
	$mail->Host     = SMTP_SERVER; // SMTP servers
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = SMTP_USER;  // SMTP username
	$mail->Password = SMTP_PASSWD; // SMTP password
	
	$mail->From     = $from;
	$mail->FromName = $from_name;
	$mail->AddAddress($to,$to_name); 
	//$mail->AddAddress(OPTIONAL_EMAIL);               // optional name
	$mail->AddReplyTo($repyname, $replyaddress);
	
	$mail->WordWrap = 50;                              // set word wrap
	
	$mail->IsHTML($isHTML);                               // send as HTML
	
	$mail->Subject  = $subject;
	$mail->Body     =  $message;
	$mail->AltBody  =  ALT_BODY;
	
	if(!$mail->Send())
	{
	   
	 ERROE_MSG . $mail->ErrorInfo;
	 
	}
	
	return SUCCESS_MSG;


}
function sendMailAttachment($to, $to_name, $from, $from_name, $subject, $message, $repyname, $replyaddress, $isHTML = true, $attachment)
{
	
	$mail = new PHPMailer();
	
	$mail->IsSMTP();                                   // send via SMTP
	$mail->Host     = SMTP_SERVER; // SMTP servers
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = SMTP_USER;  // SMTP username
	$mail->Password = SMTP_PASSWD; // SMTP password
	
	$mail->From     = $from;
	$mail->FromName = $from_name;
	$mail->AddAddress($to,$to_name); 
	//$mail->AddAddress(OPTIONAL_EMAIL);               // optional name
	$mail->AddReplyTo($repyname, $replyaddress);
	
	$mail->WordWrap = 50;                              // set word wrap
	
	$mail->IsHTML($isHTML);                               // send as HTML
	
	$mail->Subject  = $subject;
	$mail->Body     =  $message;
	$mail->AltBody  =  ALT_BODY;
	$mail->AddAttachment($attachment);
	  
	if(!$mail->Send())
	{
	   
	   return ERROE_MSG . $mail->ErrorInfo;
	  
	}
	
	return SUCCESS_MSG;


}
  
?>
