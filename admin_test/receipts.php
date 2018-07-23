<?php
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
					<?php
						include("excel/excelwriter.inc.php");	
						$fname="download/Pay_In_Slips.xls";
						$excel=new ExcelWriter($fname);
						if($excel==false)	echo $excel->error;	
						
						$myArr=array("<b>S.No</b>","<b>Entry Date</b>","<b>Pay In Slip Number</b>","<b>Invoice Number</b>","<b>Project Number</b>","<b>Remitted Amount</b>","<b>TDS Amount</b>","<b>TDS Percentage</b>","<b>Pay In Slip Date</b>","<b>Reference Number</b>","<b>Payment Mode</b>");
						$excel->writeLine($myArr);
					?>
					<div align="center"><strong>Submitted Pay in Slips</strong></div>
					<table  border="1">
					<tr><td height="27" colspan="8" align="right">Click <a href="<?php echo $fname; ?>" ><b>here</a></b> to Download Excel </td></tr>
						<tr>
						<th width="10">S#</th>
						<!--<th width="15">Select</th> -->
						<th><div align="center" >Entry Date </div></th>
						<th><div align="center" >Pay In Slip Number </div></th>
						<th><div align="center" >Invoice Number </div></th>
						<th><div align="center" >Project Number </div></th>
						<th><div align="center" >Remitted Amount</div></th>
						<th><div align="center" >Pay In Slip Date</div></th>
						<th ><div align="center" >Payment Mode</div></th>
						<?php
						session_start();
						$_SESSION["username"];
						if (!isset($_SESSION["username"])) 
						{
						session_destroy();
						setcookie("PHPSESSID","",time()-3600,"/");
						header('location: http://icsris.iitm.ac.in/ICSRIS/admin');
						exit;
						}
						else
						{
						
							$dsn="FACCTDSN";
							$username="sa";
							$password="IcsR@123#";
							$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
							
								
								$_SESSION['invoice_type']="Registered";
								$sno=1;
								$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
								$strsql_recpt="Select * from GST_Receipt_Details a, GST_Invoice_Details b where a.Invoicenumber=b.Invoicenumber order by a.DINP";
								$process_recpt=odbc_exec($sqlconnect,$strsql_recpt) or die("<br>Connection Failed");
								while(odbc_fetch_row($process_recpt))
								{
									$DINP=date('d-m-Y', strtotime(odbc_result($process_recpt,"DINP")));
									$recpt_no=odbc_result($process_recpt,"ReceiptNumber");
									$InvoiceNumber=odbc_result($process_recpt,"InvoiceNumber");
									$invoice_type=odbc_result($process_recpt,"invoiceType");
									$ProjectNumber=odbc_result($process_recpt,"ProjectNumber");
									$Amount=odbc_result($process_recpt,"RemittedAmount");
									$TDSAmount=odbc_result($process_recpt,"TDSAmount");
									$TDSPercent=odbc_result($process_recpt,"TDSPercentage");
									$ReceiptDate=odbc_result($process_recpt,"ReceiptDate");
									$ReferenceNumber=odbc_result($process_recpt,"ReferenceNumber");
									$PaymentMode=odbc_result($process_recpt,"PaymentMode");
									
									
									echo "<tr>";
									echo "<td align='center'>$sno</td>";
									echo "<td align='center'>$DINP</td>";
									echo "<td align='center'><a href='acctcon_receipt_rep.php?ReceiptNumber=$recpt_no&invoice_type=$invoice_type'><b>$recpt_no</b></td>";
									echo "<td align='center'>$InvoiceNumber</td>";
									echo "<td align='center'>$ProjectNumber</td>";
									echo "<td align='center'>$Amount</td>";
									echo "<td align='center'>$ReceiptDate</td>";
									echo "<td align='center'>$PaymentMode</td>";		
									echo "</tr>";
									
									$myArr=array($sno,$DINP,$recpt_no,$InvoiceNumber,$ProjectNumber,$Amount,$TDSAmount,$TDSPercent,$ReceiptDate,$ReferenceNumber,$PaymentMode);
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
