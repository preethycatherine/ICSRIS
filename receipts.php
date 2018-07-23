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
					<div align="center"><strong>Submitted Pay in Slips for the Invoice of <?php echo $_SESSION["invoice_number"]; ?> </strong></div><br /><br />
					<table  border="1" width="100%">
						<tr>
							<td colspan="7" align="left">
							<div align="right"><nobr><h4>Click <a  href="reports_all_receipts.php" ><span style="background-color:#F6EECC"><b>here</b></span></a> to Download All Pay in Slips in excel </h4></nobr></div>
							</td>
						</tr>
						<tr>
						<th width="10">S#</th>
						<!--<th width="15">Select</th> -->
						<th><div align="center" >Receipt Number </div></th>
						<th><div align="center" >Invoice Number </div></th>
						<th><div align="center" >Project Number </div></th>
						<th><div align="center" >Remitted Amount</div></th>
						<th><div align="center" >Receipt Date</div></th>
						<th ><div align="center" >Payment Mode</div></th>
						<?php
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
							
								
								$invoice_number=$_SESSION["invoice_number"];
								$sno=1;
								$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
								$strsql_recpt="Select * from GST_Receipt_Details where invoicenumber='$invoice_number'";
								$process_recpt=odbc_exec($sqlconnect,$strsql_recpt) or die("<br>Connection Failed");
								$flag=0;
									while(odbc_fetch_row($process_recpt))
									{
										$recpt_no=odbc_result($process_recpt,"ReceiptNumber");
										$InvoiceNumber=odbc_result($process_recpt,"InvoiceNumber");
										$ProjectNumber=odbc_result($process_recpt,"ProjectNumber");
										$Amount=odbc_result($process_recpt,"RemittedAmount");
										$ReceiptDate=odbc_result($process_recpt,"ReceiptDate");
										$ReferenceNumber=odbc_result($process_recpt,"ReferenceNumber");
										$PaymentMode=odbc_result($process_recpt,"PaymentMode");
										
										
										echo "<tr>";
										echo "<td align='center'>$sno</td>";
										echo "<td align='center'><a href='acctcon_receipt_rep.php?ReceiptNumber=$recpt_no'><b>$recpt_no</b></td>";
										echo "<td align='center'>$InvoiceNumber</td>";
										echo "<td align='center'>$ProjectNumber</td>";
										echo "<td align='center'>$Amount</td>";
										echo "<td align='center'>$ReceiptDate</td>";
										echo "<td align='center'>$PaymentMode</td>";		
										echo "</tr>";
										$sno++;							
										$flag=1;	
									}
									if($flag==0)
									{
										echo "<tr>";
										echo "<td colspan=10 align='center'<b><font color=Orange>No Submiitted Pay in Slips.</font></b></td>";
										echo "</tr>";
						}			}
						?>
						</table>
 				</div>

</div>
</body>
</html>
