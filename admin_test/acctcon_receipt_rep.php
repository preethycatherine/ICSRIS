<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
				
<div align="center">
<?php
if(!isset($_COOKIE["PHPSESSID"]))
{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
	exit;

}
else
{
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$instid1="";
	$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
	
}

if(isset($_COOKIE["PHPSESSID"]))
{
	if(isset($_GET["ReceiptNumber"]))	$ReceiptNumber=$_GET["ReceiptNumber"];
	else $ReceiptNumber=$_SESSION["ReceiptNumber"];
	if(isset($_GET["invoice_type"]))	$invoice_type=$_GET["invoice_type"];
	else $invoice_type=$_SESSION["invoice_type"];
	
	$_SESSION["ReceiptNumber"]=$ReceiptNumber;
	$_SESSION["invoice_type"]=$invoice_type;
	
	$strsql="";
	if($_SESSION['invoice_type']=="Un-Registered")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_VENDOR b, GST_Receipt_Details c where a.BillToID=b.bill_id and c.ReceiptNumber='$ReceiptNumber' and a.InvoiceNumber=c.InvoiceNumber";
	elseif($_SESSION['invoice_type']=="Export")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_EXPORT b, GST_Receipt_Details c where a.BillToID=b.bill_id and c.ReceiptNumber='$ReceiptNumber' and a.InvoiceNumber=c.InvoiceNumber";
	else
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b, GST_Receipt_Details c where a.BillToID=b.bill_id and c.ReceiptNumber='$ReceiptNumber' and a.InvoiceNumber=c.InvoiceNumber";
	//echo $strsql;
	include("../currency_words.php");
	$process=odbc_exec($sqlconnect,$strsql);
	
	if (odbc_fetch_row($process))
	{
		?>
		<div align="center">
		<?php if(!isset($_GET["ReceiptNumber"])){	?>
			<table style="background-color:#F6EECC" width="100%" >
			<tr>
			<th colspan=5 ><div align=center><span style="color:#CC0000">Pay in Slip submitted Successfully </span></div></th>
			</tr>
			</table>
		<?php } ?>
		<table style="background-color:#F6EECC" width="100%" >
		<tr>
		<th colspan=5 ><div align=right> <span style="color:#663300">Click <a href="acctcon_receipt_download.php" target="_blank">here</a> to download pay in slip </span></div></th>
		</tr>
		</table>
		<table style="background-color:#F6EECC" width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Pay in Slip Number : <?php echo $ReceiptNumber ?> </span></div></th>
		</tr>
		</table>
		<table style="background-color:#F6EECC" width="100%" border="1" >
		<tr>
		<th><div align="left"><span style="color:#663300">Project Number</span></div></th>
		<th colspan="4"><div align="left"><?php echo $ProjectNumber=odbc_result($process,"ProjectNumber"); ?></div></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">PI Name</span></div></th>
		<th align="left"><?php echo odbc_result($process,"PIName"); ?></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">Invoice No</span></div></th>
		<th colspan=2 align="left"><?php echo odbc_result($process,"InvoiceNumber"); ?></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">Invoice Date</span></div></th>
		<th colspan=2 align="left"><?php echo date('d-M-Y', strtotime(odbc_result($process,"InvoiceDate"))); //odbc_result($process,"InvoiceDate"); ?></th>
		</tr>
		<tr>
		<th width="15%"><div align="left"><span style="color:#663300">Name of Client</span></div></th>
		<th align="left" width="30%"><?php echo odbc_result($process,"NAME"); ?></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Address of Client</span></div></th>
		<th colspan="4" align="left"><?php echo odbc_result($process,"ADDRESS"); ?></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> District</span></div></th>
		<th colspan="4" align="left"><?php echo odbc_result($process,"DISTRICT"); ?></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> State</span></div></th>
		<th colspan="4" align="left"><?php echo odbc_result($process,"STATE"); ?></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">GSTIN of Client</span></div></th>
		<th align="left"><?php if($_SESSION['invoice_type']!="Un-Registered") echo odbc_result($process,"GSTIN"); else echo "--"; ?></th>
		</tr>
		</table>		
			
		<table style="background-color:#FFCCCC" width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Invoice Details </span></div></th>
		</tr>
		</table>
		
		<table style="background-color:#F6EECC" width="100%" border="1">
		<tr>
		<th width="35%"><div align="right"><span style="color:#663300">Taxable Value :</span></div></th>
		<th colspan="2" align="left"><?php echo IND_money_format(odbc_result($process,"TaxableValue")); ?></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">CGST (9%) :</span></div></th>
		<th colspan=3 align="left">
		<?php echo odbc_result($process,"CGSTAmount"); ?></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">SGST (9%) :</span></div></th>
		<th colspan=3 align="left">
		<?php echo odbc_result($process,"SGSTAmount"); ?></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">IGST (18%) :</span></div></th>
		<th colspan=3 align="left">
		<?php echo odbc_result($process,"IGSTAmount"); ?></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">Total Invoice Value : </span></div></th>
		<th colspan=2 align="left"><?php echo odbc_result($process,"TotalInvoiceValue"); ?></th>
		</tr>
		</table>
	
		<table style="background-color:#FFCCCC" width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Pay in Slip Details </span></div></th>
		</tr>
		</table>
		
		<table style="background-color:#F6EECC" width="100%" border="1">
		<tr>
		<th width="35%"><div align="right"><span style="color:#663300">Amount Received :</span></div></th>
		<th colspan="2" align="left"><?php echo IND_money_format(odbc_result($process,"RemittedAmount")); ?></th>
		</tr>
		<tr>
		<tr>
		<th width="35%"><div align="right"><span style="color:#663300">TDS Receivable :</span></div></th>
		<th colspan="2" align="left"><?php echo IND_money_format(odbc_result($process,"TDSAmount")); ?></th>
		</tr>
		<tr>
		<th width="35%"><div align="right"><span style="color:#663300">TDS Percentage (%) :</span></div></th>
		<th colspan="2" align="left"><?php echo IND_money_format(odbc_result($process,"TDSPercentage")); ?></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">Mode of Payment :</span></div></th>
		<th colspan=3 align="left">
		<?php echo odbc_result($process,"PaymentMode"); ?></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">Reference Number :</span></div></th>
		 <th> <?php echo odbc_result($process,"ReferenceNumber"); ?></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">Instruments Date :</span></div></th>
		<th colspan="2" align="left"><?php echo odbc_result($process,"ReceiptDate"); ?></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">Remarks : </span></div></th>
		<th colspan=2 align="left"><?php echo odbc_result($process,"Remarks"); ?></th>
		</tr>
		<?php 
			$avail_amt=0;
			$TotalInvoiceValue=odbc_result($process,"TotalInvoiceValue");
			$invoice_number=odbc_result($process,"InvoiceNumber");
			
			odbc_close_all();
			$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
			$rec_tot=0;
			$strsql_rec_tot="Select * from GST_Receipt_Details where InvoiceNumber='$invoice_number'";
			$process_rec_tot=odbc_exec($sqlconnect,$strsql_rec_tot);
			while(odbc_fetch_row($process_rec_tot))
			{
				$rec_tot=$rec_tot+odbc_result($process_rec_tot,"RemittedAmount")+odbc_result($process_rec_tot,"TDSAmount");
			}
		   //echo IND_money_format($rec_tot); 
		?> 
		<tr>
		<th><div align="right"><span style="color:#663300">Outstanding : </span></div></th>
		<th colspan=2 align="left"><?php echo $TotalInvoiceValue-$rec_tot; ?></th>
		</tr>
		</table>
		</div>		
		</div>
	<?php } ?>
	<div align="center">
<?php
odbc_close_all();
}
?>
		</div>
	</div>
	
</div>
	
<div id="secondaryContent">
	<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
	<?php
		include("side_menu.php");
		//session_start(); 
		$username=$_SESSION["username"];
		$_SESSION["username"]=$username;
	?>
	<div id="footer">
		<p><p>Developed by : ICSR, IITMadras</p></p>
	</div>
</div>	
</body>
</html>