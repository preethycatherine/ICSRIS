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
</head>
<body>
<?php
echo $_SESSION["username"];
if (!isset($_COOKIE["PHPSESSID"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: http://icsris.iitm.ac.in/ICSRIS/sessionout.php');
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
	header('location: http://icsris.iitm.ac.in/ICSRIS/sessionout.php');
	exit;

}
//Print_r ($_SESSION);

?>
<div id="outer">
	<div id="header">
		<h1><a href="icsrisacct.php">Centre for IC & SR</a></h1>
		<h1><a href="icsrisacct.php">Indian Institute of Technology Madras, Chennai</a></h1>
		<h2>Information System</h2>
	</div>
	<div id="menu">
	<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h2>
	</div>
	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
			<div align="center"><strong>Contacts</strong></div>
<table border="1">
<tr class="rowB">
							<td rowspan="12"><strong>Finance and Accounts:-</strong><br/> Mr. Ravi Sadagopan<br/> Chief Manager<br/> Email: cmfa-icsr@wmail.iitm.ac.in<br/> Phone Ext: 8360<br/>
							</td>

						</tr>

						<tr class="rowB">
							<td rowspan="5"><strong>Accounts Back Office:-</strong><br/> Mr. G Krishnamurthy<br/> Senior Accounts Manager<br/> Email: icsraccounts5@iitm.ac.in<br/> Phone Ext: 9701<br/>
							</td>
							<td><strong>All Receipts:-</strong><br/> Mr. Anand<br/> Email: icsraccounts5@iitm.ac.in<br/> Phone Ext: 9702<br/>
							</td>

						</tr>
						<tr class="rowB">
							<td><strong>Commitments & ICSR Projects / Negative Balance:-</strong><br/> Mr. Guru Prasad<br/> Email: icsraccounts3@iitm.ac.in<br/> Phone Ext: 9704<br/>
							</td>

						</tr>
						<tr class="rowB">
							<td><strong>All Tax matters:-</strong><br/> Ms. Rajalakshmi<br/> Email: icsraccounts4@iitm.ac.in<br/> Phone Ext: 9703<br/>
							</td>

						</tr>
						<tr class="rowB">
							<td><strong>Canara Bank Recoupments & All Cheque Payments:-</strong><br/> Mr. Madeshwaran<br/> Email: madhes@iitm.ac.in<br/> Phone Ext: 9737<br/>
							</td>

						</tr>
						<tr class="rowB">

							<td><strong>All Vendor Details:-</strong><br/> Mr. Senthil<br/> Email: icsraccounts8@iitm.ac.in<br/> Phone Ext: 9726<br/>
							</td>
						</tr>
						<tr class="rowB">

							<td rowspan="5"><strong>Accounts Front Office:-</strong><br/> Ms. Manikkarasi<br/> Senior Accounts Manager<br/> Email: icsraccounts7@iitm.ac.in<br/> Phone Ext: 9721<br/>
							</td>
						</tr>
						<tr class="rowB">

							<td><strong>Sponsored Projects:-</strong><br/> Ms. Arunadevi<br/> Email: icsraccounts9@wmail.iitm.ac.in<br/> Phone Ext: 9721<br/>
							</td>
						</tr>
						<tr class="rowB">

							<td><strong>Consultancy Project:-</strong><br/> Ms. Lakshmipriya<br/> Email: icsraccounts6@iitm.ac.in<br/> Phone Ext: 9711<br/>
							</td>
						</tr>
						<tr class="rowB">

							<td>
								<strong>Salary:-</strong><br/> Mr. Deepak Prasanth<br/> Email: icsraccounts2@iitm.ac.in<br/> Phone Ext: 9722 <br/>

							</td>
						</tr>
						<tr  class="rowB">

							<td><strong>Travel, PCF and RMF:-</strong><br/> Ms. Rajarajeshwari<br/> Email: icsraccounts1@iitm.ac.in<br/> Phone Ext: 9792<br/>
							</td>
						</tr>
						<tr  class="rowB">

							<br/><td rowspan="4"><br/><strong>PFMS:-</strong><br/> Ms. Kavitha <br/> Senior Accounts Manager<br/> Email: smacc-icsr@iitm.ac.in<br/> Phone: 9795<br/>
							<br/></td>
							<br/><td rowspan="4"><strong>PFMS:-</strong><br/> Ms. Rama<br/> Email: pfms-icsr@wmail.iitm.ac.in<br/> Phone Ext: 9795<br/>
							<br/></td>
						</tr >
</table>
 </div>

<div align="center"></div>
</div>

<?php
if (strcmp($usermode,"SUPER")==0)
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<h3>Unidentified Grant Receipts</h3>
<p><ul><li><a href="pendingreceipts.php">Unidentified Grant Receipts</a></li></ul></p>		
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
<h3>SBI Credit Details</h3>
<p><ul><li><a href="sbicreditdetails.php">Direct Credit Details</a></li></ul></p>
<h3>Cheque Details</h3>
<p><ul><li><a href="chequedetails.php">Pending Cheques Details</a></li></ul></p></div>

<!--<h3I>CPDA</h3I>
<p><ul><li><a href="../CPDA/batch.php"><DIV  style="color:#336633">CPDA</DIV></a></li></ul></p>

</div>-->

<div class="clear"></div>
</div>
<?php
}
else
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<h3>Unidentified Grant Receipts</h3>
<p><ul><li><a href="pendingreceipts.php">Unidentified Grant Receipts </a></li></ul></p>
<?php
$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$instid1=$insid;
$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
$strsql="select * from webauthReim where instid like '$instid1'";
//echo "$strsql";
$process=odbc_exec($sqlconnect,$strsql) or die("Query Execution Failed");
if(odbc_fetch_row($process))
{
?>
<h3>Bank Imprest Account</h3>
<p><ul><li><a href="acctsimprest.php">Imprest Account</a></li></ul></p>
<?php	
}
odbc_close_all();
?>
<h3>Sponsored Project</h3>
<p><ul><li><a href="acctsponon.php">Ongoing Projects</a></li><li><a href="acctsponcl.php">Closed Projects</a></li></ul></p>
<h3>Consultancy Project</h3>
<p><ul><li><a href="acctconson.php">Ongoing Projects</a></li><li><a href="acctconscl.php">Closed Projects</a></li></ul></p>

<?php

mysql_connect("eservices", "cpdaread", "Cpda@Read!1") ; 
		mysql_select_db("cpda") or die("msql connection error") ;

$q=mysql_query("select access from staff_details where StaffNo='".$insid."' and Status='Active' ");
$rowcount=mysql_num_rows($q);
//echo $insid;
//echo $rowcount;
if(($rowcount==1))
{
while($row = mysql_fetch_array($q))
{
//echo $row["access"];
if($row["access"] == 'Yes')
{
	
?>
<h3>PCF / RMF / CPDA </h3>
<p><ul><li><a href="acctpcfsum.php">PCF Account</a></li>
<li><a href="acctrmfsum.php">RMF Account</a></li>
<li><a href="CPDA/batch.php">CPDA</a></li></ul></p>
<?php
}
else
{
?>
<h3>PCF / RMF </h3>
<p><ul><li><a href="acctpcfsum.php">PCF Account</a></li>
<li><a href="acctrmfsum.php">RMF Account</a></li></ul></p>
<?PHP	
}
}
}
?>

<h3>SBI Credit Details</h3>
<p><ul><li><a href="sbicreditdetails.php">Direct Credit Details</a></li></ul></p>
<h3>Cheque Details</h3>
<p><ul><li><a href="chequedetails.php">Pending Cheque             s Details</a></li></ul></p>
<h3>IP DASHBOARD</h3>
			<ul>
					<li style="margin-right:-20px;"><a href="patent_info_R102.php">Indian Filings and Patents</a>
					</li>
					<li><a style="margin-right:-60px;" href="patent_info_R202.php">International Filings and Patents</a>
					</li>
					<li><a style="margin-right:-320px;" href="patent_info_R102A.php">Tech Transfer Accounts</a>
					</li>    
				</ul>

</div>
</div>
</div>

<div id="footer">

<?php
}
}
?>

</body>
</html>
