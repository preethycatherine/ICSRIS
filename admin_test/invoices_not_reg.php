<?php
  session_start();
  error_reporting( E_ALL );
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
					<table style="background-color:#F6EECC" width="100%" >
					<th colspan=5 >
					<div align="center"><nobr><?php echo $_SESSION['monthName']; ?></nobr></div> 
					</th></tr>
					</table>
					<?php
						include("excel/excelwriter.inc.php");	
						$fname="download/invoices_registered.xls";
						$excel=new ExcelWriter($fname);
						if($excel==false)	echo $excel->error;	
						
						$myArr=array("<b>S.No</b>","<b>Invoice Date</b>","<b>Invoice Number</b>","<b>Project Number</b>","<b>PI Name</b>","<b>DeptName</b>","<b>Description of Services</b>","<b>Taxable Value</b>","<b>CGST (9%)</b>","<b>SGST (9%)</b>","<b>IGST (18%)</b>","<b>Total Invoice Value</b>","<b>SACNumber</b>","<b>Biller Name</b>","<b>Address</b>","<b>District</b>","<b>Pin Code</b>","<b>State</b>","<b>Contact Person</b>","<b>Email</b>","<b>Contact No</b>");
						$excel->writeLine($myArr);
					?>
			
					<table style="background-color:#F6EECC" width="100%" >
					<tr>
					<th colspan=5 >
					<div align="center"><nobr><h4><a  href="invoices.php" ><span style="background-color:#F6EECC">Invoice for Registered (With GSTIN)</span></a>  |  <a  href="invoices_not_reg.php">Invoice for Un-Registered (Without GSTIN)</a>  <br /><br />  <a  href="invoices_export.php">Invoice for Export</a>  |  <a  href="invoices_exempted.php">Invoice for Exempted</a>  </h4></nobr></div> 
					</th></tr>
					<tr><td height="27" colspan="3" align="left">
					<div align="center"><nobr><h4><a  href="reports_all_invoices.php" ><span style="background-color:#F6EECC"><b>Download All Invoices</b></span></a> </h4></nobr></div>
					</td><td height="27" colspan="4" align="right">
					<div align="center"><nobr><h4><a  href="reports_all_outstanding.php" ><span style="background-color:#F6EECC"><b>Download Outstanding Reports</b></span></a> </h4></nobr></div>
					</td></tr>
					</table>
					<div align="center"><strong>Submitted Invoices - Un-Registered</strong></div>
					<table  border="1">
					<tr><td height="27" colspan="7" align="right">Click <a href="<?php echo $fname; ?>" ><b>here</a></b> to Download Excel </td></tr>
						<tr>
						<th width="10">S#</th>
						<!--<th width="15">Select</th> -->
						<th><div align="center" >Invoice Date</div></th>
						<th><div align="center" >Invoice Number </div></th>
						<th><div align="center" >Project Number </div></th>
						<th><div align="center" >PI Name</div></th>
						<th><div align="center" >Taxable Value.</div></th>
						<th ><div align="center" >Total Invoice Value</div></th>
						<?php
						$_SESSION["username"];
						if (!isset($_SESSION["username"])) 
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
							$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
							
								$_SESSION['invoice_type']="Un-Registered";
								$sno=1;
								$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
								$strsql_inv="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_VENDOR b where a.BillToID=b.bill_id and a.InvoiceType='Un-Registered' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
								//$strsql_inv="Select * from GST_Invoice_Details where InvoiceType='Un-Registered' order by DINP";
								$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
								while(odbc_fetch_row($process_inv))
								{
									$inv_date=odbc_result($process_inv,"InvoiceDate");
									$inv_date=date("d-m-Y", strtotime($inv_date));
									$inv_no=odbc_result($process_inv,"InvoiceNumber");
									$ProjectNumber=odbc_result($process_inv,"ProjectNumber");
									$PIName=odbc_result($process_inv,"PIName");
									$TaxableValue=odbc_result($process_inv,"TaxableValue");
									$TotalInvoiceValue=odbc_result($process_inv,"TotalInvoiceValue");
									echo "<tr>";
									echo "<td align='center'>$sno</td>";
									echo "<td><b>$inv_date</b></td>";
									echo "<td align='center'><a href=http://icsris.iitm.ac.in/ICSRIS/admin/acctcon_inv_rep.php?invoice_number=$inv_no><b>$inv_no</b></td>";
									echo "<td align='center'>$ProjectNumber</td>";
									echo "<td align='center'>$PIName</td>";
									echo "<td align='center'>$TaxableValue</td>";
									echo "<td align='center'>$TotalInvoiceValue</td>";		
									echo "</tr>";

									$myArr=array($sno,$inv_date,$inv_no,$ProjectNumber,$PIName,odbc_result($process_inv,"DeptName"),odbc_result($process_inv,"Description"),odbc_result($process_inv,"TaxableValue"),odbc_result($process_inv,"CGSTAmount"),odbc_result($process_inv,"SGSTAmount"),odbc_result($process_inv,"IGSTAmount"),odbc_result($process_inv,"TotalInvoiceValue"),odbc_result($process_inv,"SACNumber"),odbc_result($process_inv,"NAME"),odbc_result($process_inv,"ADDRESS"),odbc_result($process_inv,"DISTRICT"),odbc_result($process_inv,"PINCODE"),odbc_result($process_inv,"STATE"),odbc_result($process_inv,"CONTACTPERSON"),odbc_result($process_inv,"EMAIL"),odbc_result($process_inv,"CONTACTNO"));
									$excel->writeLine($myArr);

									$sno++;							
								}
							
						}
						?>
						</table>
 				</div>

</div>


<div id="secondaryContent">
	<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
	<?php
		include("side_menu.php");
		session_start(); 
		$username=$_SESSION["username"];
		$_SESSION["username"]=$username;
	?>
	<div id="footer">
		<p><p>Developed by : ICSR, IITMadras</p></p>
	</div>
</div>
</body>
</html>
