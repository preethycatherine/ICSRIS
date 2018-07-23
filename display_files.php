
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
    background-color: #006666;
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
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
	height:20%;
    background-color: #006699;
    color: white;
    text-align: center;
}
.footer_bottom {
    position: fixed;
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
	color: #003366;
	font-weight: bold;
}
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
  <?php  if($_SESSION["usermode"]=="SUPER"){ ?>
  <div w3-include-html="menu_super.html"></div>
  <?php } 	
  	else{ ?>
 <!--<div w3-include-html="menu.html"></div>-->
	<div w3-include-html="menu.php"></div>
  <?php  } ?>
  <script>
				w3.includeHTML();
				</script>
  <!--=========== END MENU SECTION ================-->





  <div id="content">
    <div id="primaryContentContainer">
    <div id="primaryContent">
<?php
session_start(); 
$directory = "certificates/";
 
//get all image files with a .jpg extension.
$pdfs = glob($directory . "*.pdf");
 
//print each file name
$i=1;
echo "<table border=1><tr><td><b>Sl.No</b></td><td><b>TAN Number</b></td><td><b>Company Name</b></td><td><b>Certifiactes</b></td></tr>";
foreach($pdfs as $pdf)
{
echo "<tr><td>$i. </td><td>".substr($pdf,13,10)."</td><td>".trim(str_replace(".pdf","",substr($pdf,24)))."</td><td><a href='$pdf' target-'_blank'>download</a></td></tr>";
$i++;
}
?>

  </div>
</div>
</div>
<!--<div class="footer">
  <table width="100%">
  <tr><td width="20%">&nbsp;</td>
  <td width="33%" align="center">
	  
		<h3 align="left" class="style7"><span class="style8">Reach Us</span></h3>
			<p align="left"><span class="style5">Centre for Industrial Consultancy and Sponsored Research <br>
		    </span><span class="style6">Indian Institute of Technology Madras<br>
		    Chennai - 600 036</span><span class="style4"><br>
	        <img src="images/contact-icon.png" width="20" height="15" /> <font color="white">044 2257 8061(62)</font>&nbsp;<img src="images/mail-us.png" width="30" height="25" /> <font color="white">deanicsr@iitm.ac.in</font> </span>	      </p>
	   </td>
   <td width="67%" align="center" valign="top">  
		   <h3 class="style7"><span class="style8">Connect with Us</span></h3>
		   <br />
            <p align="center">    
                 <a data-toggle="tooltip" data-placement="top" title="Facebook" href="https://www.facebook.com/ReachIITM/" target="_blank" style="text-decoration:none"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a data-toggle="tooltip" data-placement="top" title="Twitter"  href="https://twitter.com/reachIITM" target="_blank"><i class="fa fa-twitter"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a data-toggle="tooltip" data-placement="top" title="Google+"  href="https://plus.google.com/+iitmadras" target="_blank"><i class="fa fa-google-plus"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a data-toggle="tooltip" data-placement="top" title="Linkedin"  href="#"><i class="fa fa-linkedin"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a data-toggle="tooltip" data-placement="top" title="Youtube"  href="#"><i class="fa fa-youtube"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</p>
    </td>
  </tr>
 </table>           
</div>
<div class="footer_bottom">
  <table width="100%">
  <tr>
  <td width="50%" align="center"><p align="left"><strong> Copyright &copy;  IC&amp;SR 2018 All Rights Reserved </strong></p></td>
   <td width="50%" align="right" valign="top"> <p align="right"><strong>Designed by  ICSR - IT , IIT Madras</strong></span></p>  </td>
  </tr>
 </table>           
</div>
-->
</div>
<?php
}
?>
</body>
</html>
