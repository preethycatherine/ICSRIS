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
	if(isset($_GET["CreditNoteNumber"]))	$creditnoteNumber=$_GET["CreditNoteNumber"];
	else $creditnoteNumber=$_SESSION["CreditNoteNumber"];
	if(isset($_GET["invoice_type"]))	$invoice_type=$_GET["invoice_type"];
	else $invoice_type=$_SESSION["invoice_type"];
	
	$_SESSION["CreditNoteNumber"]=$creditnoteNumber;
	$_SESSION["invoice_type"]=$invoice_type;
	
	$strsql="";
	if($_SESSION['invoice_type']=="Un-Registered")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_VENDOR b, GST_Credit_Note_Details c where a.BillToID=b.bill_id and c.creditnoteNumber='$creditnoteNumber' and a.InvoiceNumber=c.InvoiceNumber";
	elseif($_SESSION['invoice_type']=="Export")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_EXPORT b, GST_Credit_Note_Details c where a.BillToID=b.bill_id and c.creditnoteNumber='$creditnoteNumber' and a.InvoiceNumber=c.InvoiceNumber";
	else
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b, GST_Credit_Note_Details c where a.BillToID=b.bill_id and c.creditnoteNumber='$creditnoteNumber' and a.InvoiceNumber=c.InvoiceNumber";
	//echo $strsql;
	include("../currency_words.php");
	$process=odbc_exec($sqlconnect,$strsql);
	
	if (odbc_fetch_row($process))
	{
		?>
		<div align="center">
		<?php if(!isset($_GET["CreditNoteNumber"])){	?>
			<table style="background-color:#F6EECC" width="100%" >
			<tr>
			<th colspan=5 ><div align=center><span style="color:#CC0000">Credit Note submitted Successfully </span></div></th>
			</tr>
			</table>
		<?php } ?>
		<table style="background-color:#F6EECC" width="100%" >
		<tr>
		<th colspan=5 ><div align=right> <span style="color:#663300">Click <a href="acctcon_creditnote_download.php" target="_blank">here</a> to download Credit Note </span></div></th>
		</tr>
		</table>
		<table style="background-color:#F6EECC" width="100%" border="1" >
			<tr>
			<th><div align="left"><span style="color:#663300">Credit Note No No</span></div></th>
			<th colspan=2 align="left"><?php echo $creditnoteNumber; ?></th>
			<th><div align="left"><span style="color:#663300">Credit Note Date</span></div></th>
			<th colspan=2 align="left"><?php echo odbc_result($process,"CreditNoteDate"); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">Invoice No</span></div></th>
			<th colspan=2 align="left"><?php echo odbc_result($process,"InvoiceNumber"); ?></th>
			<th><div align="left"><span style="color:#663300">Invoice Date</span></div></th>
			<th colspan=2 align="left"><?php echo odbc_result($process,"InvoiceDate"); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">Project Number</span></div></th>
			<th colspan="4"><div align="left"><?php echo odbc_result($process,"ProjectNumber"); ?></div></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">Department Name</span></div></th>
			<th colspan=2 align="left"><?php echo odbc_result($process,"DeptName"); ?></th>
			<th><div align="left"><span style="color:#663300">PI Name</span></div></th>
			<th align="left"><?php echo odbc_result($process,"PIName"); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">SAC Number</span></div></th>
			<th colspan=2 align="left"><?php echo odbc_result($process,"SACNumber"); ?></th>
			<th><div align="left"><span style="color:#663300">IITM - GSTIN</span></div></th>
			<th align="left"><?php echo odbc_result($process,"InstGSTINNo"); ?></th>
			</tr>
		</table>	
		<table style="background-color:#FFCCCC" width="100%" >
				<tr>
				<th colspan=5 ><div align=center> <span style="color:#663300">Billing Details </span></div></th>
				</tr>
				</table>
				<table style="background-color:#F6EECC" width="100%" border="1" >
				<tr>
				<th width="15%"><div align="left"><span style="color:#663300">Name</span></div></th>
				<th align="left" width="30%"><?php echo odbc_result($process,"NAME"); ?></th>
				<th width="15%"><div align="left"><span style="color:#663300">Address</span></div></th>
				<th colspan=2 align="left" width="30%"><?php echo odbc_result($process,"ADDRESS"); ?></th>
				</tr>
				<?php
				if($_SESSION['invoice_type']=="Un-Registered")
					{ 
				?>
				<tr>
				<th><div align="left"><span style="color:#663300">District</span></div></th>
					<th align="left"><?php echo odbc_result($process,"DISTRICT"); ?></th>
				<th><div align="left"><span style="color:#663300">Pin Code</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"PINCODE"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">State</span></div></th>
				<th align="left"><?php echo odbc_result($process,"STATE"); ?></th>
				<th><div align="left"><span style="color:#663300">Contact Person</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"CONTACTPERSON"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Email</span></div></th>
				<th align="left"><?php echo odbc_result($process,"EMAIL"); ?></th>
				<th><div align="left"><span style="color:#663300">Contact No</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"CONTACTNO"); ?></th>
				</tr>
				
				<?php
					}
				elseif($_SESSION['invoice_type']=="Export")
					{ 
				?>
				<tr>
				<th><div align="left"><span style="color:#663300">Country</span></div></th>
				<th align="left"><?php echo odbc_result($process,"COUNTRY"); ?></th>
				<th><div align="left"><span style="color:#663300">Contact Person</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"CONTACTPERSON"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Email</span></div></th>
				<th align="left"><?php echo odbc_result($process,"EMAIL"); ?></th>
				<th><div align="left"><span style="color:#663300">Contact No</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"CONTACTNO"); ?></th>
				</tr>
				
				<?php
					}
				else
					{
				?>
				<tr>
				<th><div align="left"><span style="color:#663300">District</span></div></th>
					<th align="left"><?php echo odbc_result($process,"DISTRICT"); ?></th>
				<th><div align="left"><span style="color:#663300">Pin Code</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"PINCODE"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">State</span></div></th>
				<th align="left"><?php echo odbc_result($process,"STATE"); ?></th>
				<th><div align="left"><span style="color:#663300">State Code</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"STATECODE"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">GSTIN</span></div></th>
				<th align="left"><?php echo odbc_result($process,"GSTIN"); ?></th>
				<th><div align="left"><span style="color:#663300">PAN No</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"PANNO"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">TAN No</span></div></th>
				<th align="left"><?php echo odbc_result($process,"TANNO"); ?></th>
				<th><div align="left"><span style="color:#663300">Contact Person</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"CONTACTPERSON"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Email</span></div></th>
				<th align="left"><?php echo odbc_result($process,"EMAIL"); ?></th>
				<th><div align="left"><span style="color:#663300">Contact No</span></div></th>
				<th colspan=2 align="left"><?php echo odbc_result($process,"CONTACTNO"); ?></th>
				</tr>
				<?php
					}
				?>
		</table>	
		<table style="background-color:#FFCCCC" width="100%" >
				<tr>
				<th colspan=5 ><div align=center> <span style="color:#663300">Communication Address </span></div></th>
				</tr>
				</table>
				<table style="background-color:#F6EECC" width="100%" border="1">
				<tr>
				<th colspan=5 align="left"><?php if(odbc_result($process,"Communication_Address")!="") echo odbc_result($process,"Communication_Address"); else  echo "--"; ?> </th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Description of Services</span></div></th>
				<th colspan=2 align="left" width="60%"><?php echo odbc_result($process,"Description"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Credit Note Amount</span></div></th>
				<th colspan="2" align="left"><?php echo odbc_result($process,"CreditNoteAmount"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">CGST (9%)</span></div></th>
				<th colspan="2" align="left"><?php echo odbc_result($process,"CN_CGSTAmount"); ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">SGST (9%)</span></div></th>
				<th colspan="2" align="left"><?php echo odbc_result($process,"CN_SGSTAmount"); ?></th>
				</tr>	
				<tr>
				<th><div align="left"><span style="color:#663300">IGST (18%)</span></div></th>
				<th colspan="2" align="left"><?php echo odbc_result($process,"CN_IGSTAmount"); ?></th>
				</tr>	
				<tr>
				<th><div align="left"><span style="color:#663300">Total Invoice Value (In figures)</span></div></th>
				<th colspan="2" align="left"><?php $total_value=odbc_result($process,"CN_TotalValue"); echo $total_value; ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Total Invoice Value (In words)</span></div></th>
				<th colspan="2" align="left"><?php  echo odbc_result($process,"Currency_Type")."".ucwords(@convert_number_to_words($total_value))." Only"; ?></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Reason for Issuing document</span></div></th>
				<th colspan="2" align="left"><?php  echo odbc_result($process,"Reason_Document"); ?></th>
				</tr>
		</table>	
		<table style="background-color:#FFCCCC" width="100%" >
				<tr>
				<th><div align="left"><span style="color:#663300">Narration : </span></div></th>
				<th colspan=2 align="left" width="70%"><?php echo odbc_result($process,"narration"); ?></th>
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