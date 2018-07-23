<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ICSR ACCOUNTS</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css"/>
<!--<link href="css/style.css" rel="stylesheet" type="text/css" />-->

<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" type="text/css" href="css/magnific-popup.css" />
<link rel="stylesheet" type="text/css" href="css/tabstyles.css" />
<link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>   
<link href='https://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="alert/sweetalert.min.js"></script>
<head>
  <script src="alert/sweetalert.min.js"></script>
    <script>
       $(function showSwal()
				 { 
				 swal("Insurance Submitted!", "Please check your mail for confirmation !", "success")
				 } );
		setInterval(function () {
			var d = new Date();
			var seconds = d.getMinutes() * 60 + d.getSeconds();
			var fiveMin = 60 * 5;
			var timeleft = fiveMin - seconds % fiveMin; 
			var result = parseInt(timeleft / 60) + ':' + timeleft % 60; 
			//document.getElementById('test').innerHTML = result;
		 window.location.href = "Group_Travel_Insurance.php";
		}, 2000) 
    </script>
<body onload="ClearForm()">
<div id="outer">

<!--=========== BEGIN MENU SECTION ================-->
	 <script src="https://www.w3schools.com/lib/w3.js"></script>
	<div w3-include-html="menu_o.html"></div>
		<script>
		w3.includeHTML();
		</script>
	<!--=========== END MENU SECTION ================--> 


<div id="content">
<div id="primaryContentContainer">
<div id="primaryContent">

<br/><br />
<br/><br /><br/><br /><br/><br /><br/><br />
<font size="+1" color="#000066"><center>Insurance has been submitted successfully !</center></font>
<?php
$isvalid = true;
session_start();
		if( !isset( $_COOKIE[ "PHPSESSID" ] ) )
		{
			echo "<br>session destroy ";
			session_destroy();
			setcookie( "PHPSESSID", "", time() - 3600, "/" );
			header( 'location: https://icsris.iitm.ac.in/ICSRIS/index.php' );
			exit;
		}		
		else
		{				
		$dsn="FACCTDSN";
		$username="sa";
		$password="IcsR@123#";
		$instid1="";
		$sqlconnect = odbc_connect( "$dsn", "$username", "$password" )or die( "ODBC Connection Failed" );
		}
		if (isset($_POST['submit'])  && ($_POST['submit'] == "Submit"))
			{	
			$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");	
				 	$ename = $_POST['empcd'];$stdate = $_POST['stdate'];$Journey_Days = $_POST['jrny'];$Return_Date = $_POST['rtdate'];$DOB= $_POST['dob'];$First_Name=$_POST['fname'];$Surname=$_POST['snm'];$Gender=$_POST['gender'];$Nominee_Name=$_POST['nome'];			$Passport_Number=$_POST['pstno'];$Mobile=$_POST['mbno'];$emails=$_POST['mail'];$adhar_card_name=$_POST['adhar'];$disease=$_POST['disease'];$disease_details=$_POST['exp'];
					$Project_no=$_POST['mfi_4_a_ii'];
								
					$Middle_Name='';$ename = $_POST['empcd'];
					$stdate = $_POST['stdate'];
					$Journey_Days = $_POST['jrny']; $Return_Date = $_POST['rtdate'];$DOB= $_POST['dob'];$First_Name=$_POST['fname'];$Middle_Name='';$Surname=$_POST['snm'];$Gender=$_POST['gender'];$Nominee_Name=$_POST['nome'];
					$Passport_Number=$_POST['pstno'];$Mobile=$_POST['mbno'];$emails=$_POST['mail'];$adhar_card_name=$_POST['adhar'];$disease=$_POST['disease'];$disease_details=$_POST['exp'];$Project_no=$_POST['mfi_4_a_ii'];$Creation_date=date('d/m/Y');
		 			$ins_sql="insert into Travel_Insurance(Employee_Code,Start_Date,Journey_Days,Return_Date,DOB,First_Name,Middle_Name,Surname,Gender,Nominee_Name,Passport_Number,Mobile,mail,adhar_card_name,disease,disease_details,Project_no,Creation_date)
								values('$ename','$stdate','$Journey_Days','$Return_Date','$DOB','$First_Name','$Middle_Name','$Surname','$Gender','$Nominee_Name','$Passport_Number','$Mobile','$emails','$adhar_card_name','$disease','$disease_details','$Project_no','$Creation_date')";
					//echo  $ins_sql;
					 odbc_close_all();
					$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
					odbc_exec($sqlconnect,$ins_sql);		
			   }
		   else 
				{			  		
					odbc_close_all();
					$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");		
					$ename = '';
					$stdate = '';$Journey_Days='';$Return_Date='';
					$DOB='';$First_Name='';$Middle_Name='';$Surname='';$Gender='';
					$Nominee_Name='';$Passport_Number='';$Mobile='';
					$emails='';$adhar_card_name='';$disease='';$Project_no='';$Creation_date='';		
				   $disease_details='';
				}
ob_start();
require('fpdf/fpdf.php');
require_once('mail/class-phpmailer.php');
require_once('mail/class-smtp.php');
require_once('mail/mail_insurance.php');
require_once('mail/PHPMailerAutoload.php');
$nm='/insurancepdf/insurance.pdf';
$dirrec = getcwd();
echo $_SERVER['DOCUMENT_ROOT'].$nm;
$dest = $nm;
echo $dest;
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(218,8,8);
$pdf->Cell(0, 15, 'TRAVEL INSURANCE DETAILS', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$width=$pdf -> w; // Width of Current Page
$height=$pdf -> h; // Height of Current Pages
$pdf->SetFont('Arial','',16);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,20,'',0,0,'L');
$pdf->Cell(0,20,'',0,1,'L');
$pdf->Cell(0,10,'Employee Code																		  : '. $ename  ,0,1,'L');
$pdf->Cell(0,10,'Start Date																													: '.$stdate ,0,1,'L');
//$pdf->Cell(0,10,'No. of Journey Days													: '. $Journey_Days ,0,1,'L');
$pdf->Cell(0,10,'Return Date																										: '.$Return_Date ,0,1,'L');
$pdf->Cell(0,10,'Date of Birth																										: '. $DOB ,0,1,'L');
$pdf->Cell(0,10,'Given Name																											: '.$First_Name ,0,1,'L');
//$pdf->Cell(0,10,'Middle Name																										: '.$Middle_Name ,0,1,'L');
$pdf->Cell(0,10,'Last Name																														: '. $Surname ,0,1,'L');
$pdf->Cell(0,10,'Gender																																			: '.$Gender ,0,1,'L');
$pdf->Cell(0,10,'Nominee Name																						: '.$Nominee_Name,0,1,'L');
$pdf->Cell(0,10,'Passport Number																			: '.$Passport_Number ,0,1,'L');
$pdf->Cell(0,10,'Mobile Number																							: '. $Mobile ,0,1,'L');
$pdf->Cell(0,10,'Email ID																																		: '.$emails ,0,1,'L');
$pdf->Cell(0,10,'Name for Insurance policy					: '. $adhar_card_name ,0,1,'L');
$pdf->Cell(0,10,'Any pre-existing disease								: '.$disease ,0,1,'L');
$pdf->Cell(0,10,'If yes, provide details													: '. $disease_details ,0,1,'L');
$pdf->Cell(0,10,'Project Number																						: '.$Project_no ,0,1,'L');
$pdf->Cell(0,10,'Date																																							:  '. $Creation_date ,0,1,'L');
$pdf->Cell(0,20,'',0,0,'L');
$pdf->Cell(0,20,'',0,1,'L');
$edge=210; // Gap between line and border , change this value
$pdf->Line($edge, $edge,$width-$edge,$edge); // Horizontal line at top
$pdf->Cell(0, 10, 'For Office Use'."\n", 0,1,'C');
$pdf->Cell(0,10,'Policy Number 			   : ' ,0,1,'L');
$pdf->Cell(0,10,'Premium Amount	   : ' ,0,1,'L');
//$pdf->Output();
$pdf->Output(getcwd().$nm,'F');
echo 'mail stare here';
require_once('mail/mail_insurance.php');	
$to=strtolower($_SESSION["username"])."@iitm.ac.in";	
$mail->Subject = "Group Travel Insurance - Reg.";
$mail->Body = "	Dear Sir / Madam,<br/><br/> The travel insurance details has been submitted successfully.<br>
				Mr. Chidambaram, Chief Manager (Admin) [Extn-9793] or Ms. Rini Jose, Secretary to Dean (ICSR) [Extn-8062] will be processing the travel insurance shortly.
<br><br>
				Please contact them for any assistance.<br>
								Thanks and Regards,<br> 
								Chief Manager, Admin";
$mail->AddAddress($to, "");	
$mail->AddCC("cmadmin-icsr@iitm.ac.in", "");
$mail->AddCC("secicsr@iitm.ac.in", "");
//$mail->AddCC("preethycatherine@gmail.com", "");
$attachment= $pdf->Output(getcwd().$nm,'S');
$mail->addAttachment( getcwd().'/insurancepdf/insurance.pdf' , 'insurance.pdf' );
if($mail->Send())
$errmsg="Mail Sent";
else
$errmsg="Not Sent";		
//print_r($attachment);exit;
//echo $errmsg;							
$mail->ClearAddresses();
ob_end_flush(); 
?>
</div></div>
</div>  
</body>
</html>