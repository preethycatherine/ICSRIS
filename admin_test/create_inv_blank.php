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
  function windowpop1(url, width, height) 
	{
		var leftPosition, topPosition;
		//Allow for borders.
		leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
		//Allow for title and status bars.
		topPosition = (window.screen.height / 2) - ((height / 2) + 50);
		//Open the window.
		window.open(url, "Window2", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=yes,location=no,directories=no");
	}
	function reload(form)
	{
		var comp="",date="";
		invoice_type=document.create_inv_blank.invoice_type.value; //bill_id
		
		self.location='create_inv_blank.php?invoice_type=' + invoice_type;  
			// alert (val1);
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
if (!isset($_SESSION["username"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
exit;
}
else
	{
	$invoice_type="";$bill_id="";
	if(isset($_GET['invoice_type'])) $invoice_type=$_GET['invoice_type'];
	elseif(isset($_POST['invoice_type'])) $invoice_type=$_POST['invoice_type'];
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");						
	?>					
		<form name='create_inv_blank' action='create_inv_blank.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
		<div align="center">
		<table style="background-color:#F6EECC" width="100%" >
		<tr>
		<th colspan=5 ><div align=right><span style="color:#CC0000"><a href="invoices.php">Home - Submitted Invoice</a></span></div></th>
		</tr>
		<tr>
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Tax Invoice(Blanket) </span></div></th>
		</tr>
		</table>
		
		<table style="background-color:#F6EECC" width="100%" border="1" >
			<tr>
			<th width="33%"><div align="right"><span style="color:#663300">Select Invoice Type :</span></div></th>
			<th width="67%" colspan=4 align="left">
			<select name='invoice_type' onchange="reload(this.form)">
			<?php 
				if(isset($invoice_type)){ ?> <option value="<?php echo $invoice_type; ?>"><?php echo $invoice_type;  ?></option>
			<?php } else { ?><option>-Select-</option><?php }  ?>
			<option value="Registered">Registered</option>
			<option value="Un-Registered">Un-Registered</option>
			<option value="Export">Export</option>
			<option value="Exempted">Exempted</option>
			</select></th>
			</tr>
		<?php 
			if($invoice_type!=""){ 
		?>
		</table>		
		<table style="background-color:#F6EECC" width="100%" border="1" >
		<tr>
			<th><div align="right"><span style="color:#663300">Select Billing Details:</span></div></th>
			<th colspan=4 align="left">
			<select name='bill_id'>
			<?php 
				if(isset($_POST['bill_id'])){ ?> <option value="<?php echo $_POST['bill_id']; ?>"><?php echo $_POST['bill_id'];  ?></option>
			<?php } ?><option>-Select-</option><?php
				$strsql_bill="";
				if($invoice_type=="Registered" or $invoice_type=="Exempted")
				{
					$strsql_bill="Select * from GST_BILL_TO_DETAILS";
					$process_bill=odbc_exec($sqlconnect,$strsql_bill) or die("<br>Connection Failed");
					while(odbc_fetch_row($process_bill))
					{
						echo "<option value = '".odbc_result($process_bill,"bill_id")."'>".odbc_result($process_bill,"GSTIN")." - ".substr(odbc_result($process_bill,"Name"),0,35)." - ".odbc_result($process_bill,"District")."</option>";
					}
				}
				elseif($invoice_type=="Un-Registered")		
				{
					$strsql_bill="Select * from GST_BILL_TO_DETAILS_vendor";
					$process_bill=odbc_exec($sqlconnect,$strsql_bill) or die("<br>Connection Failed");
					while(odbc_fetch_row($process_bill))
					{
						echo "<option value = '".odbc_result($process_bill,"bill_id")."'>".substr(odbc_result($process_bill,"Name"),0,35)." - ".odbc_result($process_bill,"State")." - ".odbc_result($process_bill,"District")."</option>";
					}
				}
				elseif($invoice_type=="Export")		
				{
					$strsql_bill="Select * from GST_BILL_TO_DETAILS_export";
					$process_bill=odbc_exec($sqlconnect,$strsql_bill) or die("<br>Connection Failed");
					while(odbc_fetch_row($process_bill))
					{
						echo "<option value = '".odbc_result($process_bill,"bill_id")."'>".substr(odbc_result($process_bill,"Name"),0,35)." - ".odbc_result($process_bill,"Country")."</option>";
					}
				}
			 ?>
			 </select></th>
			</tr>
		</table>
		<table style="background-color:#F6EECC" width="100%" border="1" >
			<tr>
			<th><div align="right"><span style="color:#663300">SAC :</span></div></th>
			<th colspan=4 align="left">
			<select name='sac'>
			<?php 
				if(isset($_GET['sac'])){ ?> <option value="<?php echo $_GET['sac']; ?>"><?php echo $_GET['sac'];  ?></option>
				<?php } elseif(isset($_POST['sac'])){ ?> <option value="<?php echo $_POST['sac']; ?>"><?php echo $_POST['sac'];  ?></option>
			<?php } else { ?><option>-Select SAC Number-</option><?php } 
			odbc_close_all();
			$strsql_sac="";
			$strsql_sac="Select * from GST_SAC_Details";
			$process_sac=odbc_exec($sqlconnect,$strsql_sac) or die("<br>Connection Failed");
			while(odbc_fetch_row($process_sac))
			{
				echo "<option value = '".odbc_result($process_sac,"sac_id")."'>".odbc_result($process_sac,"sac_id")." - ".substr(odbc_result($process_sac,"sac_desc"),0,85)."</option>";
			}
			 ?>
			 </select></th>
			</tr>
			</table>
	
	
			<table style="background-color:#FFCCCC" width="100%" >
			<tr>
			<th colspan=5 ><div align=center> <span style="color:#663300">Project Details </span></div></th>
			</tr>
			</table>
			<table style="background-color:#F6EECC" width="100%" border="1">
			<tr>
			<th><div align="right"><span style="color:#663300">Description of Services :</span></div></th>
			<th colspan=2 align="left"><textarea name="desc_service" cols="50" rows="2"><?php if(isset($_POST['desc_service'])) echo $_POST['desc_service']; ?></textarea></th>
			</tr>
			<tr>
			<th><div align="right"><span style="color:#663300">Taxable Value :</span></div></th>
			<th colspan="2" align="left"><input type="text" name="tax_value" value="<?php if(isset($_POST['tax_value'])) echo $_POST['tax_value']; ?>"   /></th>
			</tr>
			<?php
			 include("../currency_words.php");
					 ?>
				<tr>
				<th><div align="right"><span style="color:#663300">CGST (9%) :</span></div></th>
				<th colspan="2" align="left"><input type="text" name="CGST" value="<?php if(isset($_POST['CGST'])) echo $_POST['CGST']; ?>"   /></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">SGST (9%) :</span></div></th>
				<th colspan="2" align="left"><input type="text" name="SGST" value="<?php if(isset($_POST['SGST'])) echo $_POST['SGST']; ?>"   /></th>
				</tr>	
				<tr>
				<th><div align="right"><span style="color:#663300">IGST (18%) :</span></div></th>
				<th colspan="2" align="left"><input type="text" name="IGST" value="<?php if(isset($_POST['IGST'])) echo $_POST['IGST']; ?>"   /></th>
				</tr>	
				<tr>
				<th><div align="right"><span style="color:#663300">Total Invoice Value (In figures) :</span></div></th>
				<th colspan="2" align="left"><input type="text" name="total_value" value="<?php if(isset($_POST['total_value'])) echo $_POST['total_value']; ?>"   /></th>
				</tr>
				<tr>
				<th colspan="4"><div align="center"><input type="submit" name="submit" id="submit" value="Submit Invoice" /></div></th>
				</tr>	
				<?php 
				if (isset($_POST['submit']) && ($_POST['submit'] == "Submit Invoice")) 
				{	
					
					if($_POST['desc_service']=="") 
					{
					 ?>
						<tr>
						<th colspan="4"><div align="center"><span style="color:#663300">Enter Description of Services </span></div></th>
						</tr>	
					 <?php
					 }
					elseif($_POST['tax_value']=="") 
					{
					 ?>
						<tr>
						<th colspan="4"><div align="center"><span style="color:#663300">Enter Taxable Value </span></div></th>
						</tr>	
					 <?php
					 }
					else
					{
				
					$Inst_GSTIN="33AAAAI3615G1Z6";  $curr_year=date('y'); $financial_year=$curr_year.($curr_year+1);
					$invoice_number="";
					
					odbc_close_all();
					$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
					
					$strsql_inv="Select * from GST_Invoice_Details_test order by DINP";
					$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
					if(!odbc_fetch_row($process_inv)) $invoice_number="C".$financial_year.$_SESSION['instid']."C1";
					else
					{
							$last_inv_no="";
							while(odbc_fetch_row($process_inv))
							{
								$last_inv_no=odbc_result($process_inv,"InvoiceNumber");
							}
							//$inv_id="B".(substr($last_inv_no,1)+1);
							$invoice_number="C".$financial_year."0000C".(substr(odbc_result($process_inv,"InvoiceNumber"),10)+1);
					}
						$CGST=$_POST['CGST'];
						$SGST=$_POST['SGST'];
						$IGST=$_POST['IGST'];
						$total_value=$_POST['total_value'];
						$bill_no=$_POST['bill_id'];
					
						$inv_date=date('d-m-Y');
					$ins_sql="insert into GST_Invoice_Details_test(DINP,InstGSTINNo,InvoiceNumber,InvoiceDate,SACNumber,BillToID,SNo,Description,TaxableValue,CGSTRate,CGSTAmount,SGSTRate,SGSTAmount,IGSTRate,IGSTAmount,TotalInvoiceValue,InvoiceType) values(GETDATE(),'$Inst_GSTIN','$invoice_number',GETDATE(),'".$_POST['sac']."','$bill_no',1,'".$_POST['desc_service']."',".$_POST['tax_value'].",9,".$CGST.",9,".$SGST.",18,".$IGST.",".$total_value.",'".$invoice_type."')";
				odbc_close_all();
				$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
				odbc_exec($sqlconnect,$ins_sql);
				
				require_once('../mail/mail.php');
				
				//$to="icsraccounts@iitm.ac.in";
				$to="placement.webops@iitm.ac.in";
				//$to=strtolower($_SESSION["username"])."@iitm.ac.in";
				
				$mail->Subject = "Reg. - Invoice created";
				$mail->Body = "	Dear Sir/Madam,<br><br>
				
					The Invoice was created successfully.<br><br>
					
					Please find following the invoice details.<br>
					<table border=1 width=400>
						<tr align='center' ><td>Invoice Number</td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> $invoice_number</td></tr>
						<tr align='center' ><td>Invoice Date </td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> $inv_date</td></tr>
						<tr align='center' ><td>Taxable Value</td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> ".$_POST['tax_value']."</td></tr>
						<tr align='center' ><td>CGST (9%) </td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> $CGST</td></tr>
						<tr align='center' ><td>SGST (9%) </td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td> $SGST</td></tr>
						<tr align='center' ><td>IGST (18%) </td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td>$IGST</td></tr>
						<tr align='center' ><td>Total  </td><td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><b>$total_value</b></td></tr>
					</table>
					<br><br>
				Thanks and Regards,<br>
				ICSR Accounts.							
				"; 
								
				$mail->AddAddress($to, "");
				//$mail->AddCC("icsraccounts@iitm.ac.in", "");
				//$mail->AddCC("cmit-icsr@iitm.ac.in", "");
				//$mail->AddCC("c.sathishkumarmca@gmail.com", "");
				//$mail->AddCC("skumarkiitm@gmail.com", "");
				if($mail->Send()) $errmsg="Mail Sent";
				else $errmsg="Not Sent";		
				$mail->ClearAddresses();
				 echo $errmsg;

				ob_clean();
				$_SESSION['invoice_number']=$invoice_number;
				$_SESSION['invoice_type']=$invoice_type;
				header('location: acctcon_inv_rep.php');																		
			}	
		}
	}	?>	
		</table>		
	
		</div>
		</form>
		</div>
		<div align="center">
<?php  } ?>
