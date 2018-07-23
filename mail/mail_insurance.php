<?php
		date_default_timezone_set('Asia/Calcutta');
		require_once('class-phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsHTML(true);
		$mail->IsSMTP();
		$mail->SMTPAuth = true; // enable SMTP authentication
		$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
		$mail->Host = "10.24.1.48"; // sets GMAIL as the SMTP server
		$mail->Port = 465; // set the SMTP port for the GMAIL server
		$mail->Username = "icsrg1"; // EMAIL username
		$mail->Password = "Guest1@icsr"; // EMAIL password
		$mail->From = "cmadmin-icsr@iitm.ac.in"; // "name@yourdomain.com";
		$mail->FromName = "CM Admin - ICSR";  // set from Name	
		//$mail->From = "secicsr@iitm.ac.in"; // "name@yourdomain.com";
		//$mail->FromName = "Secretary to Dean ICSR";  // set from Name	
			
?>