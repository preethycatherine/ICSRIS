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
<link href="default.css" rel="stylesheet" type="text/css" />
<!--<link href="css/style.css" rel="stylesheet" type="text/css" />-->

<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" type="text/css" href="css/tabstyles.css" />
<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>   
<link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

<link rel="stylesheet" href="layout/styles/jquery-ui.css" />

<link rel="stylesheet" href="layout/styles/style.css" type="text/css" />




<style type="text/css">
<!--
.style1 {
	color: #FF6600;
	font-style: italic;
	font-weight: bold;
}
-->

 /* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #FFFFFF;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
} 
.style2 {
	font-weight: bold;
	color: #FF6600;
	font-size: 12;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: medium;
}
.footer {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
	height:20%;
    background-color: #006699;
    color: white;
    text-align: center;
}
.footer_bottom {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
	height:3%;
    background-color: #003300;
    color: white;
    text-align: center;
}
a {
    color: #FFFFFF;
}

a:hover 
{
     color:#00A0C6; 
     text-decoration:none; 
     cursor:pointer;  
}
.style4 {
	font-style: italic;
	font-size: 16px;
	font-weight: bold;
}
.style5 {font-weight: bold; font-size: 16px;}
.style6 {font-size: 16px}
.style7 {color: #003300}
</style>
<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>   
<script src="https://www.w3schools.com/lib/w3.js"></script>
	
	<link href="default.css" rel="stylesheet" type="text/css"/>
<!--	<link href="css/dashboard.css.css" rel="stylesheet" type="text/css"/>-->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
echo $_SESSION["username"];
	if (!isset($_COOKIE["PHPSESSID"])) 
	{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: index.php');
	exit;
	}
	else
	{
		session_start();
		if($_SESSION['instid'])
		{
			$insid=$_SESSION['instid'];
			$usermode=$_SESSION['usermode'];
			//echo "<br>instid:$insid<br>usermode:$usermode";
			if(strcmp($usermode,"NORMAL")==0)
			{
			$_SESSION['pcfid']=$insid;
			$_SESSION['rmfid']=$insid;
			}
		} 
		else
		{
			//echo "<br>session destroy ";
			session_destroy();
			setcookie("PHPSESSID","",time()-3600,"/");
			header('location: index.php');
			exit;
		
		}
//Print_r ($_SESSION);
?>
<div id="outer">
  <!--<div id="menu">-->
  <!--<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h4>
	</div>-->
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
  <h2>Forms</h2>
  <table width="80%" border =1 ">
  <tr style="background-color: #006699;" >
  <td width="10%" style="color:white; text-align: center; font-size:14px; font-weight:bold;" >S.No</td>
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;width:450px;">Functions</td>
  </tr>
  <tr>
  <td  style="text-align:center;">1</td>
  <td><a href="#accounts">Accounts</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">2</td>
  <td><a href="#CONSULTANCY">Consultancy</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">3</td>
  <td><a href="#halls">Halls</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">4</td>
  <td> <a href="#ipr"> IPR</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">5</td>
  <td><a href="#purchase">Project Purchase</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">6</td>
  <td><a href="#recruitment">Recruitment</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">7</td>
  <td><a href="#sponrsh">Sponsored Research</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">8</td>
  <td><a href="#SOCIAL">Corporate Social Responsibility (CSR)</a></td>
  </tr>
  </table>
    <h2 id="accounts">Accounts</h2>
 <table  width="80%" border =1 >
  <tr style="background-color: #006699;">
  <td  width="10%" style="color:white; text-align: center; font-size:14px; font-weight:bold;width:80px;" >Form No</td>
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;;">Accounts</td>
  </tr>
  <tr>
  <td  style="text-align:center;">A1</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428904542.pdf" target="_blank" >Application for Part-Time employment of students in Consultancy/Sponsored and Other projects</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">A2</td>
  <td> <a href="/ICSRIS/new/admin/uploads/forms/1428904666.pdf" target="_blank" >Format for payment of remuneration to institute staff for extra work in Sponsored projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A3</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428904702.pdf" target="_blank" >Man-day payments</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A6</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428904840.pdf" target="_blank" >Proforma for sanction of TA/DA/Registration Fee from Project Funds</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A7</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428904880.pdf" target="_blank" >TA/DA final settlement form</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A8</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428904923.pdf" target="_blank" >Proforma for reimbursement of Tel.Charge from Sponsored Projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A9</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428904954.pdf" target="_blank" >Proforma for reimbursement of Tel.Charge from Consultacny Projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A10</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428904985.pdf" target="_blank" >Format for Reimbursement Expenses from P.C.F</a></td>
  </tr>
  
    <td  style="text-align:center;">A11</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428905021.pdf" target="_blank" >Temporary Advance Requistion Form</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A12</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428905068.pdf" target="_blank" >Income Tax Exemption Certificate</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A13</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1502952057.pdf" target="_blank" >GST - Certificate of Provisional Registration</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A14(a)</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1528794549.pdf" target="_blank" >Consultancy Bank Account</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A15</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428924269.pdf" target="_blank" >Format for receiving e-payments</a></td>
  </tr>
      <td  style="text-align:center;">A16</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428924314.pdf" target="_blank" >Purchase Bills Payment/Reimbursement of Expenses</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A17</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428924343.pdf" target="_blank" >Foreign Bank A/c Details for Transfer of Funds from Abroad</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A18</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/Form-18.pdf" target="_blank" >TA/DA Eligibility For Project Coordinator / Project Staff On Project Visit</a></td>
  </tr>
  <tr>
    <td  style="text-align:center;">A19</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/Form-19.pdf" target="_blank" >Entitlements for travel by air / rail / road</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A20</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428924589.pdf" target="_blank" >Statement of Account for Sponsored Project</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A21</td>
  <td>	<a href="/ICSRIS/new/admin/uploads/forms/1428924619.pdf" target="_blank" >Statement of Account for Consultancy Project</a></td>
  </tr> 
  
   <tr>
    <td  style="text-align:center;">A22</td>
  <td>	<a href="/ICSRIS/new/admin/uploads/forms/1428924641.pdf" target="_blank" >Financial Assistance to Research Scholars from RMF</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A14(b)</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1528794561.pdf" target="_blank" >PFMS Bank Account</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">A14(c)</td>
  <td>	<a href="/ICSRIS/new/admin/uploads/forms/1528794571.pdf" target="_blank" >Non - PFMS Bank Account</a></td>
  </tr>
  </table>

  
 <h2 id="CONSULTANCY">CONSULTANCY</h2>
  <table  width="80%" border =1 >
  <tr style="background-color: #006699;">
  <td   width="10%" style="color:white; text-align: center; font-size:14px; font-weight:bold;width:80px;" >Form No</td>
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;;">Consultancy</td>
  </tr>
  <tr>
  <td  style="text-align:center;">C1</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1530792882.pdf" target="_blank" >Consultancy Project Agreement</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">C2</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428921615.pdf" target="_blank" >Common Code Consultancy Registration Form</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">C3</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428921638.pdf" target="_blank" >Testing Registration Form</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">C4</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428921663.pdf" target="_blank" >Testing For External Projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">C5</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428921687.pdf" target="_blank" >Testing For Internal Projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">C6</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428921718.pdf" target="_blank" >Proforma for reimbursement of Tel.Charges from Consultancy Projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">C7</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428921762.pdf" target="_blank" >Proforma for Furnishing review status of Projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">C8</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428921785.pdf" target="_blank" >Proposal for Distribution of IC/RB/RC project amounts</a></td>
  </tr>
  
    <td  style="text-align:center;">C9</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428924619.pdf" target="_blank" >Details of Consultancy Assignment</a></td>
  </tr>
   <tr>
  
  </table>
  
  
   <h2 id="halls">HALLS</h2>
  <table  width="80%" id="halls" border =1>
  <tr  width="10%" style="background-color: #006699;">
  <td  style="color:white; text-align: center; font-size:14px; font-weight:bold;width:80px;" >Form No</td>
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;;">Halls</td>
  </tr>
  <tr>
  <td  style="text-align:center;">H1</td>
  <td>	<a href="/ICSRIS/new/admin/uploads/forms/1428921979.pdf" target="_blank" >Request for use of Conference Hall Facilities in Ground floor of IC&SR building[INTERNAL]</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">H2</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428922011.pdf" target="_blank" >Request for use of Conference Hall Facilities in Ground floor of IC & SR building[EXTERNAL]</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">H3</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1452666816.pdf" target="_blank" >Request for use of Conference Hall Facilities in Ground floor of IC & SR building - USAGE WITHOUT CHARGES</a></td>
  </tr>
  </table>
  
  
   <h2 id="ipr">IPR</h2>
  <table  width="80%" id="ipr" border =1 >
  <tr  width="10%" style="background-color: #006699;">
  <td  style="color:white; text-align: center; font-size:14px; font-weight:bold;width:80px;" >Form No</td>
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;;">IPR</td>
  </tr>
  <tr>
  <td  style="text-align:center;">I1</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428922113.doc" target="_self" >Invention Disclosure Form</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">I2</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428922150.pdf" target="_blank" >IPR Policy</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">I3</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428922177.pdf" target="_blank" >List of Patents filed pending award</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">I4</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1459506098.doc" target="_self" >Joint Development Agreement</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">I5</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1459506139.doc" target="_self" >Mutual Non Disclosure Agreement</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">I6</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1491979366.doc" target="_blank" >Details of the programme -World IP Day (26April 2017)</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">I7</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1491979649.doc" target="_blank" >Write up format</a></td>
  </tr>
  </table>
  
  <h2 id="purchase">PROJECT PURCHASE</h2>
  <table  width="80%" id="purchase" border =1>
  <tr  width="10%"style="background-color: #006699;">
  <td  style="color:white; text-align: center; font-size:14px; font-weight:bold;width:80px;" >Form No</td>
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;;">Project Purchase</td>
  </tr>
  <tr>
  <td  style="text-align:center;">P2</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428922809.pdf" target="_blank" >	Purchase Schedule</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">P3</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428922865.pdf" target="_blank" >	Assets Register</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P1-A</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080091.pdf" target="_blank" >Declaration Form</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P1-B</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080127.pdf" target="_blank" >Purchase Order</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P1-C</td>
  <td>	<a href="/ICSRIS/new/admin/uploads/forms/1429080153.pdf" target="_blank" >Requisition for Custom Duty Exemption Certificate</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P2-A</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080174.pdf" target="_blank" >Declaration Form</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">P2-B</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080196.pdf" target="_blank" >	Purchase Order</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P2-C</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080216.pdf" target="_blank" >Requisition for Custom Duty Exemption Certificate</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P3-A</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080245.pdf" target="_blank" >Enquiries made by PC(List of Vendor and their Postal/Email Address)</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P3-B</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080290.pdf" target="_blank" >List of Quotation received (Name of the Vendors) In case of receipt of less than 8 Quotations</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P3-C</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080319.pdf" target="_blank" >Technical Bid Comparitive Statement</a></td>
  </tr>

   <tr>
  <td  style="text-align:center;">P3-A</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080245.pdf" target="_blank" >Enquiries made by PC(List of Vendor and their Postal/Email Address)</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P3-B</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080290.pdf" target="_blank" >List of Quotation received (Name of the Vendors) In case of receipt of less than 8 Quotations</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P3-D</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080342.pdf" target="_blank" >Proforma for Purchase of item on Single Basis Quotation</a></td>
  </tr>
     <tr>
  <td  style="text-align:center;">P4-A</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080367.pdf" target="_blank" >	Request of PC to Constitute on Exclusive Purchase Committee</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P4-B</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080390.pdf" target="_blank" >Submission of Quotation under LImited Tender (Cover-1 Technical/Bid)/Open Tender</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P4-C</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080411.pdf" target="_blank" >Justification In case of Single Tender Basis</a></td>
  </tr>
  
    <tr>
  <td  style="text-align:center;">P5</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1429080436.pdf" target="_blank" >Procurement of goods and services through Repeated Order</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">P1</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1499429353.pdf" target="_blank" >Purchase Note</a></td>
  </tr>
  </table>
  
  <h2 id="recruitment">RECRUITMENT</h2>
  <table  width="80%" id="Recruitment" border =1 >
  <tr  width="10%" style="background-color: #006699;">
  <td  style="color:white; text-align: center; font-size:14px; font-weight:bold;width:80px;" >Form No</td>
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;;"> Recruitment</td>
  </tr>
  <tr>
  <td  style="text-align:center;">R1</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1504079209.pdf" target="_blank" >Designation, Minimum Qualification, Experience & Salary Range for Projects & Outsourcing</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">R2</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1470726473.pdf" target="_blank" >	Format for Appointment On Short-Term Engagement</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">R3</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923106.pdf" target="_blank" >	Format For Engagement As Project Advisor / Senior Project</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">R4</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923141.pdf" target="_blank" >Format for Student Assistantship</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">R5</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923167.pdf" target="_blank" >Project Recruitment - No Due Form</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">R6</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1487068427.pdf" target="_blank" >	Application for Outsourcing</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">R7</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1487068523.pdf" target="_blank" >Joining Report for Outsourcing</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">R8</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1487068574.pdf" target="_blank" >Joining Report for Short-Term Engagement</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">R9</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1527238089.pdf" target="_blank" >Pay norms for Project staff under outsourcing</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">R10</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1527238308.pdf" target="_blank" >Fellowship norms for Research Staff</a></td>
  </tr> 
  </table>


 <h2 id="sponrsh">SPONSORED RESEARCH</h2>
 <table  width="80%" id="Sponsored"  border =1 >
  <tr  width="10%" style="background-color: #006699;">
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;width:80px;" >Form No</td>
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;;">Sponsored Research</td>
  </tr>
  <tr>
  <td  style="text-align:center;">S1</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923249.pdf" target="_blank" >List of Funding Agencies for Sponsored Research Projects</a></td>
  </tr>
  <tr>
  <td  style="text-align:center;">S2</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923274.pdf" target="_blank" >Infrastructural facilities required from IIT Madras for Sponsored Research Projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S3</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923302.pdf" target="_blank" >Termination of Projects</td>
  </tr>
   <tr>
  <td  style="text-align:center;">S4</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923339.pdf" target="_blank" >Format for submitting proposal for Research Projects under ISRO-IIT(M)STC</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S5</td>
  <td>	<a href="/ICSRIS/new/admin/uploads/forms/1428923380.pdf" target="_blank" >Format for Progress Report of Projects under ISRO-IIT(M)STC</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S6</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923435.pdf" target="_blank" >Format for Closure Report of Projects under ISRO-IIT(M)STC</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S7</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923482.pdf" target="_blank" >Format for submission of Project Proposal to IGCAR-IITM CELL</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S8</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923518.pdf" target="_blank" >Format for Progress / Completion Report to IGCAR-IITM CELL</a></td>
  </tr>
  
    <td  style="text-align:center;">S9</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923548.pdf" target="_blank" >Proforma for reimbursement of telephone charges</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S10</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923586.pdf" target="_blank" >Format for Application for GRANT-IN-AID for New Research Project(Atomic Energy Regulatory Board)</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S11</td>
  <td>	<a href="/ICSRIS/new/admin/uploads/forms/1428923641.doc" target="_self" >New Faculty Seed Grant Questionnaire</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S12</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923696.pdf" target="_blank" >Students project under ISRO-IITM CELL</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S13</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428924589.pdf" target="_blank" >Details of Sponsored Project</a></td>
  </tr>
      <td  style="text-align:center;">S14</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923774.doc" target="_self" >Innovative Student Projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S15</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923836.doc" target="_parent" >Abstract on Completed Sponsored Projects</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S16</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923883.doc" target="_self" >NIOT-Ocean Technology cell</a></td>
  </tr>
  <tr>
    <td  style="text-align:center;">S17</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428923922.doc" target="_self" >Format for NISSAN Research Support Program</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S18</td>
  <td>	<a href="/ICSRIS/new/admin/uploads/forms/1428923984.pdf" target="_blank" >Fax Details</a></td>
  </tr>
   <tr>
  <td  style="text-align:center;">S19</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1428924027.pdf" target="_blank" >	Format for Short Report on Projects under ISRO-IIT(M)STC</a></td>
  </tr> 
     <tr>
    <td  style="text-align:center;">S20</td>
  <td>	<a href="/ICSRIS/new/admin/uploads/forms/1428924056.pdf" target="_blank" >Format for Completion Report of Projects under ISRO-IIT(M)STC</a></td>
  </tr> 
  </table>
 <h2 id="SOCIAL">CORPORATE SOCIAL RESPONSIBILITY (CSR)</h2>
 <table  width="80%" border=1>
  <tr  width="10%" style="background-color: #006699;">
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;width:80px;" >Form No</td>
  <td style="color:white; text-align: center; font-size:14px; font-weight:bold;;">Corporate Social Responsibility (CSR)</td>
  </tr>
  <tr>
  <td  style="text-align:center;">CSR-1</td>
  <td><a href="/ICSRIS/new/admin/uploads/forms/1487682404.pdf" target="_blank">Application for Corporate Social Responsibility (CSR)</a></td>
  </tr>
  </div>
  </div>
</div>

<?php
}
?>
<p id="back-top" style="margin-left:1200px;">
	<a href="#top"><span></span>Back to Top</a>
</p>
</body>
</html>
