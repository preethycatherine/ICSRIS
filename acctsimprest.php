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
if(!isset($_COOKIE["PHPSESSID"]))
{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: https://icsris.iitm.ac.in/ICSRIS/sessionout.php');
	exit;

}
else
{
session_start();
$insid=$_SESSION['instid'];
$usermode=$_SESSION['usermode'];


//$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
//echo "<br> Flow in here";


}
//$_SESSION['nprno']=$nprno;
odbc_close_all();
$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$instid1="";
$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
$strsql="select Name,BankAcctNo  from webauthReim where instid='$insid'";
//echo "$strsql";
$process=odbc_exec($sqlconnect,$strsql) or die("Query Execution Failed");
if(odbc_fetch_row($process))
{
$corname=odbc_result($process,"Name");
$bankacctno=odbc_result($process,"BankAcctNo");
$_SESSION['BankAcct']=$bankacctno;
$_SESSION['name']=$corname;
//echo "<br>coorname $corname<br>$bankacctno";
}

odbc_close_all();
?>
<form name="AcctBankFrom" method="post" action='acctimpdetails.php'>
<table  width="100%" border="1">
<tr>
<th colspan=5 ><div align=center> <span style="color:#006699">Imprest Bank Account Details </span></div></th>
</tr>
<tr>
<th><div align="center">CoordinatorName: <?php  echo "$corname"; ?> Account Number: <?php  echo "$bankacctno"; ?>  </div></th>
</tr>
</tr>
<tr>
<th><div align="center"><span style="color:#663300"></span>From<input name=FDATE type="text"  value="01/04/2012"/> To <input name=TDATE type="text"  value="<?php echo date("d/m/Y"); ?>" /> 
</tr>
<tr>
<th><div align="center" > <input name=submit type=submit value=GetResult /><input type=reset name=Reset value=Reset /> </div> </div></th>
</tr>
<tr>
</table>
</form>
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
else
{
?>
<p><ul><li><a href="acctcpquery.php">Consultancy Query</a></li></ul></p>
<?php
}
?>
<h3>PCF</h3>
<?php
if(isset($_SESSION["pcfresult"]))
{
?>
<p><ul><li><a href="acctpcfquery.php">PCF Query</a></li>
<li><a href="acctpcfresult.php">PCF Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctpcfquery.php">PCF Query</a></li></ul></p>
<?php
}
?>
<h3>RMF</h3>
<?php
if(isset($_SESSION["rmfresult"]))
{
?>
<p><ul><li><a href="acctrmfquery.php">RMF Query</a></li>
<li><a href="acctrmfresult.php">RMF Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctrmfquery.php">RMF Query</a></li></ul></p>
<?php
}
?>
<h3>Cheque Details</h3>
<p><ul><li><a href="chequedetails.php">Pending Cheques Details</a></li></ul></p></div>
<div class="clear"></div>
</div>
<?php

}
//}
?>
<div id="footer">
<p></p>
</div>
</div>
</div>
</body>
</html>
