<?php
error_reporting(E_ALL);
?>
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
<script type="text/javascript">
if (top !=self) {
   top.location=self.location;
}
</script>
<script type="text/javascript">
  function windowpop(url, width, height) 
	{
		var leftPosition, topPosition;
		//Allow for borders.
		leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
		//Allow for title and status bars.
		topPosition = (window.screen.height / 2) - ((height / 2) + 50);
		//Open the window.
		window.open(url, "Window2", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
	}
	</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	color: #003300;
	font-style: italic;
}
-->
</style>
</head>
<body>

<div id="outer">
<!--<div id="menu">-->
<!--<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h2>
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
				
<div align="center">
<?php

ob_start();
if(!isset($_COOKIE["PHPSESSID"]))
{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
	exit;

}
else
{
	session_start();
	$insid=$_SESSION['instid'];
	$usermode=$_SESSION['usermode'];
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$instid1="";
	$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
	//echo "<br> Flow in here";
	
	if(!isset($_SESSION['cprno']))
	{
	$cprno=$_REQUEST['cprno'];
	//echo "<br> Direct Value";
	//echo "<br> cprno:$cprno";
	}
	else
	{
	$cprno=$_SESSION['cprno'];
	//echo "<br>Session value";
	//unset($_SESSION['cprno']); 
	}
}

$_SESSION['cprno']=$cprno;
if(isset($_COOKIE["PHPSESSID"]))
{
	session_register("logname");
	$_SESSION["cprno"]=$cprno;

	$strsql="";
	$strsql="select count(*) as pcno from cmstlst where cprno like '$cprno%'";
	$process=odbc_exec($sqlconnect,$strsql) or die("<br>Connection Failed");
	if(odbc_fetch_row($process))
	{
	$pono=odbc_result($process,"pcno");
	}
	else 
	$pono=0;

	odbc_close_all();
	$strsql="";
	$strsql="Select * from cmstlst a, DEPARTMENTMASTER b where a.dept=b.code and a.cprno like '$cprno%'";
	//$sqlconnect6=odbc_connect($dsn,$username,$password);
	$process=odbc_exec($sqlconnect,$strsql);
	//echo "<br>Sixth Query :$strsql<br>";
	
	if (odbc_fetch_row($process) && ($pono==1))
	{
		$cprno=odbc_result($process,"cprno");
		$coor_name=odbc_result($process,"coor_name1");
		$depart=odbc_result($process,"name");
		$today_date=date("d/m/Y");
		$inst_id=odbc_result($process,"instid");
		$sac_no="";
		?>
		<form name='acctcon_inv_select' action='acctcon_inv_select.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
		<div align="center">
		<table width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Tax Invoice for Project of <?php echo "$cprno"; ?> </span></div></th>
		</tr>
		</table>
		<table width="100%" border="1" >
		<!--<tr>
		<th><div align="right"><span style="color:#663300">Invoice No :</span></div></th>
		<th align="left"><?php echo $inv_no="C1718".$inst_id."S1"; ?></th>
		<th><div align="right"><span style="color:#663300">Invoice Date :</span></div></th>
		<th colspan=2 align="left"><?php echo $inv_date="$today_date"; ?></th>
		</tr>-->
		<tr>
		<th><div align="right"><span style="color:#663300">Project Number :</span></div></th>
		<th colspan="4"><div align="center"><?php echo "$cprno"; ?></div></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">Department Name :</span></div></th>
		<th colspan=2 align="left"><?php echo $depart; ?></th>
		<th><div align="right"><span style="color:#663300">PI Name :</span></div></th>
		<th align="left"><?php echo $coor_name; ?></th>
		</tr>
		</table>
		<table width="100%" >
		<tr>
		<th colspan=5 >
		<div align="center"><nobr><h4>
			<a  href="acctcon_inv.php" >Invoice for Registered Clienst with GSTIN</span></a> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;   
			<a  href="acctcon_inv_not_reg.php">Invoice for Clients without GSTIN</a>  
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;   
			<a  href="acctcon_inv_export.php">Invoice for Foreign Clients</a> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp; 
			<a  href="acctcon_inv_exempted.php">Invoice for Clients Exempted from GSTIN</a>  </h4></nobr></div> 

<!--<div align="center"><nobr><h4><a  href="acctcon_inv.php" ><span style="background-color:#F6EECC">Invoice for Registered (With GSTIN)</span></a>   |  <a  href="acctcon_inv_exempted.php">Invoice for Exempted</a>  </h4></nobr></div> -->
</th>
</table>
		</div>
		</form>
		</div>
		<div align="center">
<?php
}
odbc_close_all();
}
else
{
session_destroy();
header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
exit;
}
?>

</table>
</div>

<div align="center"></div>
</div>
</div>
<?php
if (strcmp($usermode,"SUPER")==0)
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<h3>Sponsored Project</h3>
<?php
if(isset($_SESSION["sponresult"]))
{
?>
<p><ul><li><a href="acctspquery.php">Sponsor Query</a></li>
<li><a href="acctspresult.php">Sponsor Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctspquery.php">Sponsor Query</a></li></ul></p>
<?php
}
?>
<h3>Consultancy Project</h3>
<?php
if(isset($_SESSION["consresult"]))
{
?>
<p><ul><li><a href="acctcpquery.php">Consultancy Query</a></li>
<li><a href="acctcpresult.php">Consultancy Result</a></li></ul>
</p>
<?php
}
}
//}
?>
<div id="footer">
<p></p>
</div>
</div>
</div>
</body>
<script type="text/javascript">

function poptastic(url)
{
var newwindow;
	newwindow=window.open(url,'name','height=300,width=800,scrollbars=yes');
	newwindow.focus();
<!--	if (window.focus) {newwindow.focus()} -->
}
</script>
</html>
