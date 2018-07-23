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
						$fname="download/Receipts.xls";
						$excel=new ExcelWriter($fname);
						if($excel==false)	echo $excel->error;	
						
						$myArr=array("<b>S.No</b>","<b>Credit Note Number</b>","<b>Invoice Number</b>","<b>Project Number</b>","<b>Invoice Amount</b>","<b>Credit Note Amount</b>","<b>Credit Note Date</b>","<b>Narration</b>");
						$excel->writeLine($myArr);
					?>
					<div align="center"><strong>Submitted Credit Notes</strong></div>
					<table  border="1">
					<tr><td height="27" colspan="8" align="right">Click <a href="<?php echo $fname; ?>" ><b>here</a></b> to Download Excel </td></tr>
						<tr>
						<th width="10">S#</th>
						<!--<th width="15">Select</th> -->
						<th><div align="center" >Credit Note Number </div></th>
						<th><div align="center" >Invoice Number </div></th>
						<th><div align="center" >Project Number </div></th>
						<th><div align="center" >Credit Note Amount</div></th>
						<th><div align="center" >Credit Note Date</div></th>
						<th ><div align="center" >Narration</div></th>
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
								$strsql_recpt="Select * from GST_Credit_Note_Details a, GST_Invoice_Details b where a.Invoicenumber=b.Invoicenumber order by a.DINP";
								$process_recpt=odbc_exec($sqlconnect,$strsql_recpt) or die("<br>Connection Failed");
								while(odbc_fetch_row($process_recpt))
								{
									$CreditNoteNumber=odbc_result($process_recpt,"CreditNoteNumber");
									$InvoiceNumber=odbc_result($process_recpt,"InvoiceNumber");
									$invoice_type=odbc_result($process_recpt,"invoiceType");
									$invoice_amount=odbc_result($process_recpt,"TotalInvoiceValue");
									$ProjectNumber=odbc_result($process_recpt,"ProjectNumber");
									$CreditNoteAmount=odbc_result($process_recpt,"CreditNoteAmount");
									$CreditNoteDate=odbc_result($process_recpt,"CreditNoteDate");
									$Narration=odbc_result($process_recpt,"Narration");
									
									
									echo "<tr>";
									echo "<td align='center'>$sno</td>";
									echo "<td align='center'><a href='acctcon_creditnote_rep.php?CreditNoteNumber=$CreditNoteNumber&invoice_type=$invoice_type'><b>$CreditNoteNumber</b></td>";
									echo "<td align='center'>$InvoiceNumber</td>";
									echo "<td align='center'>$ProjectNumber</td>";
									echo "<td align='center'>$CreditNoteAmount</td>";
									echo "<td align='center'>$CreditNoteDate</td>";
									echo "<td align='center'>".substr($Narration,0,35)."..</td>";		
									echo "</tr>";
									
									$myArr=array($sno,$CreditNoteNumber,$InvoiceNumber,$ProjectNumber,$invoice_amount,$CreditNoteAmount,$CreditNoteDate,$Narration);
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
