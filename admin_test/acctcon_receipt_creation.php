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
  		function others(){
		document.getElementById("Cheque_lable").style.visibility = "hidden";
		
		if(document.acctcon_receipt_creation.mode.value == "Cheque"){
			document.getElementById("Cheque_lable").style.visibility = "visible";
			}
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
	
	if(isset($_GET["invoice_number"]))	$invoice_number=$_GET["invoice_number"];
	else $invoice_number=$_SESSION["invoice_number"];
	if(isset($_GET["invoice_number"]))	$invoice_type=$_GET["invoice_type"];
	else $invoice_type=$_SESSION["invoice_type"];
	
	$_SESSION["invoice_number"]=$invoice_number;
	$_SESSION["invoice_type"]=$invoice_type;
	include("../currency_words.php");
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
		<form name='acctcon_receipt_creation' action='acctcon_receipt_creation.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
		<div align="center">
		<table style="background-color:#F6EECC" width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Submit Pay in Slip for Invoice of <?php echo "$invoice_number"; ?> </span></div></th>
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
		<th colspan=2 align="left"><?php echo $InvoiceNumber=odbc_result($process,"InvoiceNumber"); ?></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">Invoice Date</span></div></th>
		<th colspan=2 align="left"><?php echo odbc_result($process,"InvoiceDate"); ?></th>
		</tr>
		<tr>
		<th width="15%"><div align="left"><span style="color:#663300">Name of Client</span></div></th>
		<th align="left" width="30%"><?php echo odbc_result($process,"NAME"); ?></th>
		</tr>
		<?php 
		if($_SESSION['invoice_type']!="Export")
		{
		?>
		<tr>
		<th><div align="left"><span style="color:#663300">GSTIN</span></div></th>
		<th align="left"><?php if($_SESSION['invoice_type']!="Un-Registered") echo odbc_result($process,"GSTIN"); else echo "--"; ?></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">State</span></div></th>
		<th align="left"><?php echo odbc_result($process,"STATE"); ?></th>
		</tr>
		<?php } 
		else{
		?>
		<tr>
		<th><div align="left"><span style="color:#663300">Address</span></div></th>
		<th align="left"><?php echo odbc_result($process,"ADDRESS"); ?></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">Country</span></div></th>
		<th align="left"><?php echo odbc_result($process,"COUNTRY"); ?></th>
		</tr>
		<?php } 	?>
		</table>		
			
		<table style="background-color:#FFCCCC" width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Pay in Slip Details </span></div></th>
		</tr>
		</table>
		
		<table width="100%" border="1" >
		<tr>
		<th colspan=3 ><div align=left> <span style="color:#663300">Total Invoice Amount : <?php $tax_amt=odbc_result($process,"TaxableValue"); $tot_inv_amt=odbc_result($process,"TotalInvoiceValue"); echo IND_money_format($tot_inv_amt); ?> </span></div></th>
		<th colspan=2 ><div align=right> <span style="color:#663300">Total Pay in Slip Amounts Submitted: 
		<?php 
				$avail_amt=0;
				odbc_close_all();
				$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
				$rec_tot=0;
			    $strsql_rec_tot="Select * from GST_Receipt_Details where InvoiceNumber='$invoice_number'";
				$process_rec_tot=odbc_exec($sqlconnect,$strsql_rec_tot);
				while(odbc_fetch_row($process_rec_tot))
				{
					$rec_tot=$rec_tot+odbc_result($process_rec_tot,"RemittedAmount")+odbc_result($process_rec_tot,"TDSAmount");
				}
			   echo IND_money_format($rec_tot); 
			?> 
		</span></div></th>
		</tr>
		<?php
				odbc_close_all();
				$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
				$cn_tot=0;
			    $strsql_cn_tot="Select * from GST_Credit_Note_Details where InvoiceNumber='$invoice_number'";
				$process_cn_tot=odbc_exec($sqlconnect,$strsql_cn_tot);
				while(odbc_fetch_row($process_cn_tot))
				{
					$cn_tot=$cn_tot+odbc_result($process_cn_tot,"CN_TotalValue");
				}
		
		?>
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Balance Pay in Slip Amount to be Submitted: <?php $avail_amt=$tot_inv_amt-$rec_tot-$cn_tot; echo IND_money_format($avail_amt); ?> </span></div></th>
		</tr>
		</table>
<?php
if($avail_amt>0)
{
?>		
		<table style="background-color:#FFCCCC" width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Pay in Slip Details </span></div></th>
		</tr>
		</table>
		
		<table style="background-color:#F6EECC" width="100%" border="1">
		<tr>
		<th><div align="right"><span style="color:#663300">Amount Received :</span><span style="color: #FF0000; font-weight: bold">*</span></div></th>
		<th colspan="2" align="left"><input type="text" name="amount" value="<?php if(isset($_POST['amount'])) echo $_POST['amount']; else echo "0"; ?>"   /></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">TDS Receivable :</span><span style="color: #FF0000; font-weight: bold">*</span></div></th>
		<th colspan="2" align="left"><input type="text" name="TDS" value="<?php if(isset($_POST['TDS'])) echo $_POST['TDS']; else echo "0"; ?>"   /><input type="submit" name="submit" id="submit" value="Calculate" /></th>
		</tr>
		<?php
		if (isset($_POST['submit']) && ($_POST['submit'] == "Calculate") || isset($_POST['amount'])) 
		{				
			$TDSPercentage=0;
			$sub_amount=$_POST['amount']+$_POST['TDS'];
			//echo $sub_amount."-".$avail_amt;
			if($sub_amount=="0") 
			{
			 ?>
				<tr>
				<th colspan="4"><div align="center"><span style="color:#FF6600">Enter Amount Received or  TDS Receivable Amount.	 </span></div></th>
				</tr>
			 <?php
			 }
			 elseif($sub_amount>$avail_amt) 
			 {
			 ?>
				<tr>
				<th colspan="4"><div align="center"><span style="color:#FF6600">Total Amount of Received Amount and TDS Receivable Amount not exceeds of available receipt amount.	 </span></div></th>
				</tr>
			 <?php
			 }
			 else
			 {
			 ?>	
			 	<tr>
				<th><div align="right"><span style="color:#663300">TDS (%) :</span><span style="color: #FF0000; font-weight: bold">*</span></div></th>
				<th colspan="2" align="left"><?php  if(isset($_POST['TDS'])) echo $TDSPercentage=round(($_POST['TDS']/$tax_amt)*100,2); ?></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Mode of Payment :</span><span style="color: #FF0000; font-weight: bold">*</span></div></th>
				<th colspan=3 align="left">
				<select name='mode'>
				<?php 
					if(isset($_POST['mode'])){ ?> <option value="<?php echo $_POST['mode']; ?>"><?php echo $_POST['mode'];  ?></option>
				<?php } else { ?>
				<option>-Select Mode of Payment -</option>
				<?php } ?>
				<option value="Draft">Draft</option>
				<option value="Cheque">Cheque</option>
				<option value="NEFT&RTGS">NEFT&RTGS </option>
				 </select></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Reference Number :</span><span style="color: #FF0000; font-weight: bold">*</span></div></th>
				 <td> <input type="text" name="ref_no" value="<?php if(isset($_POST['ref_no'])) echo $_POST['ref_no']; ?>"   /> <br />[Enter Draft / Cheque / NEFT-RTGS Ref. No]</td>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Instruments Date :</span><span style="color: #FF0000; font-weight: bold">*</span></div></th>
				<th colspan="2" align="left">
				<input name="date_receipt" type="text" id="date_receipt" size="8" value="<?php if(isset($_POST['date_receipt'])) echo $_POST['date_receipt']; ?>" readonly />
			  <IMG id="img1"  style="CURSOR: hand" src="Calendar.gif" align="middle" name="date" Value="Calendar" onClick='javascript:window.open("calendar1.php?form=acctcon_receipt_creation&field=date_receipt","","top=360,left=700,width=175,height=140,menubar=no,toolbar=no,,resizable=no,status=no"); return false;'>
				<!--<input type="text" name="date_receipt" value="<?php if(isset($_POST['date_receipt'])) echo $_POST['date_receipt']; ?>"   />-->
				<br />[Select Draft / Cheque / NEFT-RTGS Date]
				</th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Remarks : </span></div></th>
				<th colspan=2 align="left"><textarea name="remarks" cols="45" rows="3"><?php if(isset($_POST['remarks'])) echo $_POST['remarks']; ?></textarea></th>
				</tr>
				<tr>
				<th colspan="4"><div align="center"><input type="submit" name="submit" id="submit" value="Submit Pay in Slip" /></div></th>
				</tr>
					<?php
					if (isset($_POST['submit']) && ($_POST['submit'] == "Submit Pay in Slip")) 
					{	
						
						if($_POST['amount']=="" or $_POST['mode']=="" or $_POST['ref_no']=="" or $_POST['date_receipt']=="") 
						{
						 ?>
							<tr>
							<th colspan="4"><div align="center"><span style="color:#FF6600">Enter all Mandatory fields	 </span></div></th>
							</tr>
						 <?php
						 }
						 else
						 {
								$Inst_GSTIN="33AAAAI3615G1Z6";  $curr_year=date('y');  $financial_year="1718";//$curr_year.($curr_year+1);
								$Receipt_number="";
								
								odbc_close_all();
								$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
								
								$strsql_recp="Select * from GST_Receipt_Details order by DINP";
								$process_recp=odbc_exec($sqlconnect,$strsql_recp) or die("<br>Connection Failed");
								if(!odbc_fetch_row($process_recp)) $Receipt_number="C".$financial_year.substr($invoice_number,9)."P1";
								else
								{
										$last_inv_no="";
										while(odbc_fetch_row($process_recp))
										{
											$last_rec_no=odbc_result($process_recp,"ReceiptNumber");
										}

										$last_rec_no=substr(odbc_result($process_recp,"ReceiptNumber"), strpos(odbc_result($process_recp,"ReceiptNumber"), "P") + 1) + 1;		
										$Receipt_number="C".$financial_year.substr($invoice_number,9)."P".$last_rec_no;
								}
									$ins_sql="insert into GST_Receipt_Details(DINP,ReceiptNumber,InvoiceNumber,ProjectNumber,RemittedAmount,TDSAmount,TDSPercentage,PaymentMode,ReferenceNumber,ReceiptDate,Remarks) values(GETDATE(),'$Receipt_number','$invoice_number','$ProjectNumber',".$_POST['amount'].",'".$_POST['TDS']."','$TDSPercentage','".$_POST['mode']."','".$_POST['ref_no']."','".$_POST['date_receipt']."','".$_POST['remarks']."')";
									
									odbc_close_all();
									$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
									odbc_exec($sqlconnect,$ins_sql);
									
									require_once('../mail/mail.php');
										
										//$to="placement.webops@iitm.ac.in";
										$to=strtolower($_SESSION["username"])."@iitm.ac.in";
										
										$mail->Subject = "Reg. - Pay in Slip Submitted for the Invoice of $invoice_number";
										$mail->Body = "	Dear Sir/Madam,<br><br>
										
											The Pay in Slip for the Invoice of $invoice_number was submitted successfully.<br><br>
											
											Please find following the Pay in Slip details.<br>
											<table border=1 width=400>
												<tr align='center' ><td>Pay in Slip Number</td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> $Receipt_number</td></tr>
												<tr align='center' ><td>Pay in Slip Date </td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> ".$_POST['date_receipt']."</td></tr>
												<tr align='center' ><td>Pay in Slip Amount</td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> ".$_POST['amount']."</td></tr>
												<tr align='center' ><td>Invoice Number </td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> $invoice_number</td></tr>
												<tr align='center' ><td>Project Number </td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> $ProjectNumber</td></tr>
											</table>
											<br><br>
										Thanks and Regards,<br>
										ICSR Accounts.							
										"; 
														
										$mail->AddAddress($to, "");
										$mail->AddCC("icsraccounts5@iitm.ac.in", "");
										//$mail->AddCC("cmit-icsr@iitm.ac.in", "");
										//$mail->AddCC("c.sathishkumarmca@gmail.com", "");
										//$mail->AddCC("skumarkiitm@gmail.com", "");
										if($mail->Send()) $errmsg="Mail Sent";
										else $errmsg="Not Sent";		
										$mail->ClearAddresses();
										// echo $errmsg;
										// 
										$_SESSION['ReceiptNumber']=$Receipt_number;
										header('location: acctcon_receipt_rep.php');		
							}
					}
				}
			}	
		}
		?>
		</table>	
		</div>		
		</div>
		</form>
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