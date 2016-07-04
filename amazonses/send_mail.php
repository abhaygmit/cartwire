<?php

//include phpmailer
require_once('class.phpmailer.php');

function sendSESMail($to, $to_name, $from, $from_name, $sub, $msg, $flag='' )
{
	//echo "$to, $to_name, $from, $from_name, $sub, $msg";exit;
	//SMTP Settings
	$from = 'info@cartwire.co';
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth   = true; 
	if($_SERVER['HTTP_HOST']=='https://app.cartwire.co/')
	{
	$mail->SMTPSecure = "tls"; 
	$mail->Host       = "email-smtp.us-east-1.amazonaws.com";
	$mail->Username   = "AKIAJUFJJSBTBJS34HYQ";
	$mail->Password   = "AsPU6U5YUI8MPoo6m8QE7Q7t535YbpV8zkDPz3qJkXzA";
	}
else
	{
		define('SMTP_SERVER', 'ssl://smtp.gmail.com');
		define('SMTP_USER', 'qastpl010@gmail.com');
		define('SMTP_PASSWD', 'Welcome!1');
		define('SMTP_PORT', '465');
		define('OPTIONAL_EMAIL', 'Sanjay1.singh@srmtechsol.com');
		
		
		$mail->Host     = SMTP_SERVER; // SMTP servers
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Port 	=SMTP_PORT;
		$mail->Username = SMTP_USER;  // SMTP username
		$mail->Password = SMTP_PASSWD; // SMTP password
	}
	//

	$mail->SetFrom($from, $from_name); //from (verified email address)
	$mail->Subject = $sub; //subject

	//message
	$body = $msg;
	$body = eregi_replace("[\]",'',$body);
	$mail->MsgHTML($body);
	//

	//recipient
	$mail->AddAddress($to, $to_name); 
	if($_SERVER['HTTP_HOST']=='https://app.cartwire.co/')
	{
		if($flag=='false')
		{
		  $mail->AddAddress('Matthew.J.Smith@unilever.com', 'Smith, Matthew J'); 
	
		}
		$mail->AddBCC('Ashar.Khan@srmtechsol.com', 'Ashar Khan'); 
	}
	else
	{
		if($flag=='false')
		{
		  $mail->AddAddress('Sanjay1.singh@srmtechsol.com', 'Sanjay Singh'); 
	
		}
		$mail->AddBCC('Sanjay1.singh@srmtechsol.com', 'Sanjay Singh'); 
	}
	//print_r($mail); exit;
	//Success
	if ($mail->Send()) { 
		//echo "Message sent!"; die; 
	}


	//Error
	//if(!$mail->Send()) { 
		//echo "Mailer Error: " . $mail->ErrorInfo; 
	//} 


}

//sendSESMail('amardeep.verma@srmtechsol.com',  'Amardeep', 'info@cartwire.co', 'Cartwire SES', 'Amazon SES Test' , 'Amazon SES Test');

?>
