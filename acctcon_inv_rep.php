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
	if(!isset($_COOKIE["PHPSESSID"]))
	{
		session_destroy();
		setcookie("PHPSESSID","",time()-3600,"/");
		header('location: index.php');
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
		
	}
	
	if(isset($_COOKIE["PHPSESSID"]))
	{
		session_register("logname");
		if(isset($_GET["invoice_number"]))	$invoice_number=$_GET["invoice_number"];
		else $invoice_number=$_SESSION["invoice_number"];
		if(isset($_GET["invoice_number"]))	$invoice_type=$_GET["invoice_type"];
		else $invoice_type=$_SESSION["invoice_type"];
		
		$_SESSION["invoice_number"]=$invoice_number;
		$_SESSION["invoice_type"]=$invoice_type;
		
		include("currency_words.php");
		$strsql="";
		if($_SESSION['invoice_type']=="Un-Registered")
			$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_VENDOR b where a.BillToID=b.bill_id and a.InvoiceNumber='$invoice_number'";
		elseif($_SESSION['invoice_type']=="Export")
			$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_EXPORT b where a.BillToID=b.bill_id and a.InvoiceNumber='$invoice_number'";
		else
			$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b where a.BillToID=b.bill_id and a.InvoiceNumber='$invoice_number'";
		//echo $strsql;
		$process=odbc_exec($sqlconnect,$strsql);
		
		if (odbc_fetch_row($process))
		{
			?>
			<div align="center">
			<?php if(!isset($_GET["invoice_number"])){	?>
				<table width="100%" >
				<tr>
				<th colspan=5 ><div align=center><span style="color:#CC0000">Invoice submitted Successfully </span></div></th>
				</tr>
				</table>
			<?php } ?>
			<table width="100%" >
			<tr><th>&nbsp;</th>
			<th><div align=right> <span style="color:#663300">Click <a href="acctcon_inv_download.php" target="_blank">here</a> to download invoice </span></div></th>
			</tr>
			<tr>
			<th colspan="3"><div align=left><span style="color:#CC0000"><a href="receipts.php">Previous Pay in Slip Details</a></span></div></th>
			<th colspan="2"><div align=right><span style="color:#CC0000"><a href="acctcon_receipt_creation.php">Create Pay in Slip</a></span></div></th>
			</tr>		
			</table>
			<table width="100%" border="1" >
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
			<table style="background-color:#4E87A3" width="100%" >
			<tr>
			<th colspan=5 ><div align=center> <span style="color:#663300">Billing Details </span></div></th>
			</tr>
			</table>
			<table width="100%" border="1" >
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
			<th colspan=2 align="left"><?php if(odbc_result($process,"Communication_CONTACTPERSON")!="") echo odbc_result($process,"Communication_CONTACTPERSON"); else echo odbc_result($process,"CONTACTPERSON"); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">Email</span></div></th>
			<th align="left"><?php if(odbc_result($process,"Communication_EMAIL")!="") echo odbc_result($process,"Communication_EMAIL"); else echo odbc_result($process,"EMAIL"); ?></th>
			<th><div align="left"><span style="color:#663300">Contact No</span></div></th>
			<th colspan=2 align="left"><?php if(odbc_result($process,"Communication_CONTACTNO")!="") echo odbc_result($process,"Communication_CONTACTNO"); else echo odbc_result($process,"CONTACTNO"); ?></th>
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
			<th colspan=2 align="left"><?php if(odbc_result($process,"Communication_CONTACTPERSON")!="") echo odbc_result($process,"Communication_CONTACTPERSON"); else echo odbc_result($process,"CONTACTPERSON"); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">Email</span></div></th>
			<th align="left"><?php if(odbc_result($process,"Communication_EMAIL")!="") echo odbc_result($process,"Communication_EMAIL"); else echo odbc_result($process,"EMAIL"); ?></th>
			<th><div align="left"><span style="color:#663300">Contact No</span></div></th>
			<th colspan=2 align="left"><?php if(odbc_result($process,"Communication_CONTACTNO")!="") echo odbc_result($process,"Communication_CONTACTNO"); else echo odbc_result($process,"CONTACTNO"); ?></th>
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
			<th colspan=2 align="left"><?php if(odbc_result($process,"Communication_CONTACTPERSON")!="") echo odbc_result($process,"Communication_CONTACTPERSON"); else echo odbc_result($process,"CONTACTPERSON"); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">Email</span></div></th>
			<th align="left"><?php if(odbc_result($process,"Communication_EMAIL")!="") echo odbc_result($process,"Communication_EMAIL"); else echo odbc_result($process,"EMAIL"); ?></th>
			<th><div align="left"><span style="color:#663300">Contact No</span></div></th>
			<th colspan=2 align="left"><?php if(odbc_result($process,"Communication_CONTACTNO")!="") echo odbc_result($process,"Communication_CONTACTNO"); else echo odbc_result($process,"CONTACTNO"); ?></th>
			</tr>
			<?php
				}
			?>
			</table>			
				
			<table style="background-color:#4E87A3" width="100%" >
			<tr>
			<th ><div align=center> <span style="color:#663300">Communication Address </span></div></th>
			</tr>
			</table>
			<table width="100%" border="1">
			<tr>
			<th align="left"><?php if(odbc_result($process,"Communication_Address")!="") echo odbc_result($process,"Communication_Address"); else  echo "--"; ?> </th>
			</tr>
			</table>	
				
			<table style="background-color:#4E87A3" width="100%" >
			<tr>
			<th colspan=5 ><div align=center> <span style="color:#663300">Project Details </span></div></th>
			</tr>
			</table>
			<table width="100%" border="1">
			<tr>
			<th><div align="left"><span style="color:#663300">Description of Services</span></div></th>
			<th colspan=2 align="left" width="60%"><?php echo odbc_result($process,"Description"); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">Taxable Value</span></div></th>
			<th colspan="2" align="left"><?php echo IND_money_format(odbc_result($process,"TaxableValue")); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">CGST (<?php echo odbc_result($process,"CGSTRate"); ?>%)</span></div></th>
			<th colspan="2" align="left"><?php if(odbc_result($process,"CGSTAmount")==0) echo "N/A"; else echo IND_money_format(odbc_result($process,"CGSTAmount")); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">SGST (<?php echo odbc_result($process,"SGSTRate"); ?>%)</span></div></th>
			<th colspan="2" align="left"><?php if(odbc_result($process,"SGSTAmount")==0) echo "N/A"; else echo IND_money_format(odbc_result($process,"SGSTAmount")); ?></th>
			</tr>	
			<tr>
			<th><div align="left"><span style="color:#663300">IGST (<?php echo odbc_result($process,"IGSTRate"); ?>%)</span></div></th>
			<th colspan="2" align="left"><?php if(odbc_result($process,"IGSTAmount")==0) echo "N/A"; else echo IND_money_format(odbc_result($process,"IGSTAmount")); ?></th>
			</tr>	
			<?php if(is_null(odbc_result($process,"Currency_Type"))){  ?>
			<tr>
			<th><div align="left"><span style="color:#663300">Total Invoice Value (In figures)</span></div></th>
			<th colspan="2" align="left"><?php $total_value=odbc_result($process,"TotalInvoiceValue"); echo '<img src="images/sym.jpg" height="10" width="10" />'." ".IND_money_format($total_value); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">Total Invoice Value (In words)</span></div></th>
			<th colspan="2" align="left"><?php  echo ucwords(convert_number_to_words($total_value))."Rupees Only"; ?></th>
			</tr>	
			<?php } 
			else {  ?>
			<tr>
			<th><div align="left"><span style="color:#663300">Total Invoice Value (In figures)</span></div></th>
			<th colspan="2" align="left"><?php $total_value=odbc_result($process,"TotalInvoiceValue"); echo trim(odbc_result($process,"Currency_Type"))." ".IND_money_format($total_value); ?></th>
			</tr>
			<tr>
			<th><div align="left"><span style="color:#663300">Total Invoice Value (In words)</span></div></th>
			<th colspan="2" align="left"><?php  echo odbc_result($process,"Currency_Type")."".ucwords(convert_number_to_words($total_value))." Only"; ?></th>
			</tr>	
			<?php } ?>
			</table>
			</div>		
			</div>
		<?php } ?>
		<div align="center">
	<?php
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
