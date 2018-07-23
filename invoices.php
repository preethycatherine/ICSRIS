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
				
				<div align="center"><h3> Invoice Details for <font color="#003300"><b><?php echo $_GET['projectnumber']; ?></b></font> Project </h3></div>
<div align="center">
<table  border="1" width="100%">
<?php
session_start();

if (!isset($_COOKIE["PHPSESSID"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
exit;
}
else
{
if($_SESSION['instid'])
{
$insid=$_SESSION['instid'];
$usermode=$_SESSION['usermode'];
} 
else
{
	//echo "<br>session destroy ";
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
	exit;

}
include("currency_words.php");
$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
if(strcmp($usermode,"SUPER")==0)
{
//header('location: https://icsris.iitm.ac.in/AIS/varrpt.php');
}
else
{
	?>
	<tr>
		<td colspan="7" align="left">
		<div align="right"><nobr><h4>Click <a  href="reports_all_invoices.php?projectnumber=<?php echo $_GET['projectnumber']; ?>" ><span style="background-color:#F6EECC"><b>here</b></span></a> to Download All Invoices in excel </h4></nobr></div>
		</td>
	</tr>
	<tr>
		<th width="10">S#</th>
		<th><div align="center" >Invoice Date</div></th>
		<th><div align="center" >Invoice Number </div></th>
		<th><div align="center" >Project Number </div></th>
		<th><div align="center" >Taxable Value.</div></th>
		<th ><div align="center" >Total Invoice Value</div></th>
	</tr>			
	<?php 	
		odbc_close_all();
		$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
		$strsql="";
		$sno=1;		
		$strsql_inv="Select * from GST_Invoice_Details where projectnumber like '".$_GET['projectnumber']."%' order by DINP";
		$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
		while(odbc_fetch_row($process_inv))
		{
			$inv_date=odbc_result($process_inv,"InvoiceDate");
			$inv_date=date("d-m-Y", strtotime($inv_date));
			$inv_no=odbc_result($process_inv,"InvoiceNumber");
			$inv_type=odbc_result($process_inv,"InvoiceType");
			$ProjectNumber=odbc_result($process_inv,"ProjectNumber");
			$PIName=odbc_result($process_inv,"PIName");
			$TaxableValue=odbc_result($process_inv,"TaxableValue");
			$TotalInvoiceValue=odbc_result($process_inv,"TotalInvoiceValue");
			echo "<tr>";
			echo "<td align='center'>$sno</td>";
			echo "<td><b>$inv_date</b></td>";
			echo "<td align='center'><a href='acctcon_inv_rep.php?invoice_number=$inv_no&invoice_type=$inv_type'><b>$inv_no</b></td>";
			echo "<td align='center'>$ProjectNumber</td>";
			echo "<td align='center'>$TaxableValue</td>";
			echo "<td align='center'>$TotalInvoiceValue</td>";		
			echo "</tr>";
			$sno++;							
		}
  }

}

?>
</table>
</div>
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
</body>
</html>
