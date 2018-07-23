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
		
		if(document.acctcon_creditnote_creation.mode.value == "Cheque"){
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
		<form name='acctcon_debitnote_creation' action='acctcon_debitnote_creation.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
		<div align="center">
		<table style="background-color:#F6EECC" width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Submit Debit Note for Invoice of <?php echo "$invoice_number"; ?> </span></div></th>
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
		<th colspan=5 ><div align=center> <span style="color:#663300">Debit Note Details </span></div></th>
		</tr>
		</table>
		
		<table width="100%" border="1" >
		<tr>
		<th colspan=3 ><div align=left> <span style="color:#663300">Total Invoice Amount : <?php $tot_inv_amt=odbc_result($process,"TotalInvoiceValue"); echo IND_money_format($tot_inv_amt); ?> </span></div></th>
		<th colspan=2 ><div align=right> <span style="color:#663300">Total Debit Note Amounts Submitted: 
		<?php 
				$avail_amt=0;
				odbc_close_all();
				$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
				$dn_tot=0;
			    $strsql_dn_tot="Select * from GST_Debit_Note_Details where InvoiceNumber='$invoice_number'";
				$process_dn_tot=odbc_exec($sqlconnect,$strsql_dn_tot);
				while(odbc_fetch_row($process_dn_tot))
				{
					$dn_tot=$dn_tot+odbc_result($process_dn_tot,"DebitNoteAmount");
				}
			   echo IND_money_format($dn_tot); 
			?> 
		</span></div></th>
		</tr>
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Balance Debit Note Amount to be Submitted: <?php $avail_amt=$tot_inv_amt-$dn_tot; echo IND_money_format($avail_amt); ?> </span></div></th>
		</tr>
		</table>
		
		<table style="background-color:#FFCCCC" width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Debit Note Details </span></div></th>
		</tr>
		</table>
		
		<table style="background-color:#F6EECC" width="100%" border="1">
		<tr>
		<th><div align="right"><span style="color:#663300">Debit Note Amount :</span><span style="color: #FF0000; font-weight: bold">*</span></div></th>
		<th colspan="2" align="left"><input type="text" name="amount" value="<?php if(isset($_POST['amount'])) echo $_POST['amount']; ?>"   /></th>
		</tr>
		
		<tr>
		<th><div align="right"><span style="color:#663300">Narration : </span></div></th>
		<th colspan=2 align="left"><textarea name="narration" cols="45" rows="3"><?php if(isset($_POST['narration'])) echo $_POST['narration']; ?></textarea></th>
		</tr>
		<tr>
		<th colspan="4"><div align="center"><input type="submit" name="submit" id="submit" value="Submit DebitNote" /></div></th>
		</tr>
					<?php
					if (isset($_POST['submit']) && ($_POST['submit'] == "Submit DebitNote")) 
					{	
						
						if($_POST['amount']=="" or $_POST['narration']=="") 
						{
						 ?>
							<tr>
							<th colspan="4"><div align="center"><span style="color:#FF6600">Enter all Mandatory fields	 </span></div></th>
							</tr>
						 <?php
						 }
						elseif($_POST['amount']>$avail_amt) 
						{
						 ?>
							<tr>
							<th colspan="4"><div align="center"><span style="color:#FF6600">Debit Note Amount not exceeds of available Debit amount.	 </span></div></th>
							</tr>
						 <?php
						 }
						else
						{
								$Inst_GSTIN="33AAAAI3615G1Z6";  $curr_year=date('y'); $financial_year="1718";//$curr_year.($curr_year+1);
								$DebitNote_number="";
								
								odbc_close_all();
								$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
								
								$strsql_recp="Select * from GST_Debit_note_Details order by DINP";
								$process_recp=odbc_exec($sqlconnect,$strsql_recp) or die("<br>Connection Failed");
								if(!odbc_fetch_row($process_recp)) $DebitNote_number="DN".$financial_year."1";
								else
								{
										$last_inv_no="";
										while(odbc_fetch_row($process_recp))
										{
											$last_dn_no=odbc_result($process_recp,"DebitNoteNumber");
										}

										$last_dn_no=substr(odbc_result($process_recp,"DebitNoteNumber"),6) + 1;		
										$DebitNote_number="DN".$financial_year.$last_dn_no;
								}
									$ins_sql="insert into GST_Debit_note_Details(DINP,DebitNoteNumber,InvoiceNumber,ProjectNumber,DebitNoteAmount,DebitNoteDate,narration) values(GETDATE(),'$DebitNote_number','$invoice_number','$ProjectNumber',".$_POST['amount'].",'".date('d/m/Y')."','".$_POST['narration']."')";
									
									odbc_close_all();
									$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
									odbc_exec($sqlconnect,$ins_sql);
									
									$_SESSION['DebitNoteNumber']=$DebitNote_number;
									header('location: acctcon_debitnote_rep.php');		
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