<?php
		date_default_timezone_set('Asia/Calcutta');
		require_once('class-phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsHTML(true);
		$mail->IsSMTP();
		$mail->SMTPAuth = true; // enable SMTP authentication
		$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
		//$mail->Host = "smtp2.iitm.ac.in"; // sets GMAIL as the SMTP server
		$mail->Host = "10.24.1.48";
		$mail->Port = 465; // set the SMTP port for the GMAIL server
		$mail->Username = "icsrg1"; // EMAIL username
		$mail->Password = "Guest1@icsr"; // EMAIL password
		$mail->From = "icsraccounts@iitm.ac.in"; // "name@yourdomain.com";
		$mail->FromName = "ICSR Accounts";  // set from Name		
?>