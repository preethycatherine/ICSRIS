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
 <!--<div w3-include-html="menu.html"></div>-->
	<div w3-include-html="menu.php"></div>
  <script>
				w3.includeHTML();
				</script>
  <!--=========== END MENU SECTION ================-->
  <div id="content">
    <div id="primaryContentContainer">
    <div id="primaryContent">
  <h2>Glossary</h2>
			<table>
				  <tr>
								  
					<tr><td>
<strong>Development Status:</strong> <br/>
TRL - Technology readiness levels (as per IDF)<br/>
TRL1 - Basic principles observed<br/>
TRL2- Technology concept formulated <br/>
TRL3- Experimental proof of concept<br/>
TRL4 -Technology validated in lab<br/>
TRL5 - Technology validated in relevant environment (Industrially relevant environment in the case of key enabling technologies) <br/>
TRL6 - Technology demonstrated in relevant environment (Industrially relevant enabling technologies)<br/>
TRL7 - System prototype demonstrated in operational environment<br/>
TRL8 - System complete and qualified<br/>
TRL9 - Actual system proven in operational environment (competitive manufacturing in the case of key enabling technologies)<br/>
<strong>Note: </strong>Above not applicable for Pharma, Biotech<br/>
</td>
<td><strong>Status:</strong> <br/>
Pending Internal – Yet to be allotted to Attorney or Service Provider<br/>
Pending External – Allotted to Attorney or Service Provider<br/>
Closed Internal – Closed before refereeing to attorney <br/>
Closed External – Closed based on external search reportt<br/>
Granted – Patent granted<br/>
Direct International – Application directly filed in a jurisdiction outside India<br/>
Registered – Design / Trademark / Copyright registered<br/>
Pending Partner – Filing responsibility with other applicant / 3rd Party<br/>
</td>
</tr>
<tr>
<td><strong>Patent Search:</strong> <br/>
TSI1 - Technical Search - Internal 1<br/>
TSI2 - Technical Search – Internal 2<br/>
TSI3 – Technical Search – Internal 3<br/>
TCE- Techno Commercial Evaluation<br/>
TCEK0 – KPMG Phase 0<br/>
TCEK1 – KPMG Phase 1<br/>
TCEK2 – KPMG Phase 2<br/>
TCEK3 – KPMG Phase 3<br/>
TCEKP – KPMG TCE Pre-PCT<br/>
TCEBL - BCIL TCE<br/>
TCEND - NRDC TCE<br/>
TCEIP – IP-Metric TCE<br/>
TSAP – Technical Search – Attorney (Provisional)<br/>
TSAC – Technical Search – Attorney (Complete)<br/>
</td>
<td>
<strong>Commercial Status:</strong>  <br/> 
Self- Commercialization taken care of the Inventor<br/>
NA- Not Applicable<br/>
Not Yet- Not Initiated<br/>
Stage I- Initial discussion and letters sent to the prospects<br/>
Stage II-Response to letters sent / Interest evinced by a party<br/>
Stage III- Interested party would like proposal<br/>
Stage IV- IP and Monetization concluded<br/>
Surrender-IP Closed<br/>
</td>
</tr>
<tr>
<td><strong>Country:</strong>  <br/>
PCT – Patent Co-operative Treaty <br/>
http://www.wipo.int<br/>
USA, CANADA, KOREA, SOUTH AFRICA, CHINA etc….<br/>
</td>
<td>
<strong>Partner Ref No.:</strong> <br/>
Other Applicant or 3rd Party reference number
</td>
</tr>
<tr style="text-align:center"><td colspan=2><strong>IPC Code:</strong>  <br/> 
Can be access from the following link,<br/>
<a href="http://www.wipo.int/classifications/ipc/" target="_blank">http://www.wipo.int/classifications/ipc/</a> <br/></td></tr>
</table>
<br/>
<br/>
<?php
}
?>

</body>
</html>
