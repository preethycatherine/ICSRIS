<?php
error_reporting(E_ALL);
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
		session_start();
		$username=$_SESSION["username"];
		$_SESSION["username"]=$username;
		if (!isset($_SESSION["username"])) 
		{
		session_destroy();
		setcookie("PHPSESSID","",time()-3600,"/");
		header('location: http://icsris.iitm.ac.in/icsris/admin/index.php');
		exit;
		}
		else
		{
			session_register("logname");
			if(isset($_GET["invoice_number"]))	$invoice_number=$_GET["invoice_number"];
			else $invoice_number=$_SESSION["invoice_number"];
			
			
			$_SESSION["invoice_number"]=$invoice_number;
			
			include("../currency_words.php");
			
			$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
			$strsql="";
			$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b where a.BillToID=b.bill_id and a.InvoiceNumber='$invoice_number'";
			$process=odbc_exec($sqlconnect,$strsql);
			if (odbc_fetch_row($process))
			{
				?>
				<form name='acctcon_inv_mod_exempted' action='acctcon_inv_mod_exempted.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
				<div align="center">
				<table style="background-color:#F6EECC" width="100%" >
				<tr>
				<th colspan=5 ><div align=right> <span style="color:#663300">Click <a href="acctcon_inv_download.php" target="_blank">here</a> to download invoice </span></div></th>
				</tr>
				<tr>
				<th colspan=5 ><div align=right><span style="color:#CC0000"><a href="invoices.php">Home - Submitted Invoices</a></span></div></th>
				</tr>
				</table>
				<table style="background-color:#F6EECC" width="100%" border="1" >
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
				<th colspan=4 align="left">
					<select name='sac'>
					<option value="<?php echo odbc_result($process,"SACNumber"); ?>"><?php echo odbc_result($process,"SACNumber");  ?></option>
					<?php  
					odbc_close_all();
					$strsql_sac="";
					$strsql_sac="Select * from GST_SAC_Details";
					$process_sac=odbc_exec($sqlconnect,$strsql_sac) or die("<br>Connection Failed");
					while(odbc_fetch_row($process_sac))
					{
						echo "<option value = '".odbc_result($process_sac,"sac_id")."'>".odbc_result($process_sac,"sac_id")." - ".substr(odbc_result($process_sac,"sac_desc"),0,75)."</option>";
					}
					 ?>
					 </select>
				 </th>
				 <tr><th colspan=5 align="center"><div align="center"> <input type="submit" name="submit" id="submit" value="Change SAC" /></div></th></tr>
				</tr>
				<?php
					if(isset($_POST['submit']) && ($_POST['submit'] == "Change SAC"))
					{	
						odbc_close_all();
						$up_sac_sql="";
						$sac=$_POST['sac'];
						if($sac!="")
						{
							$up_sac_sql="update GST_Invoice_Details set SACNumber='$sac' where InvoiceNumber='$invoice_number'";
							odbc_close_all();
							$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
							odbc_exec($sqlconnect,$up_sac_sql);
						}
					}					
					odbc_close_all();
					$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
					$process=odbc_exec($sqlconnect,$strsql);
				?>
				</table>
				<table style="background-color:#FFCCCC" width="100%" >
				<tr>
				<th colspan=5 ><div align=center> <span style="color:#663300">Billing Details </span></div></th>
				</tr>
				</table>
				<table style="background-color:#F6EECC" width="100%" border="1" >
				<tr>
					<th colspan="4" align="left"><div align="center"><span style="color:#663300">Enter GSTIN Number :&nbsp;&nbsp;</span><input type="text" name="gstin_pan" value="<?php if(isset($_POST['gstin_pan'])) echo $gstin=$_POST['gstin_pan']; else echo $gstin=odbc_result($process,"GSTIN"); ?>"   /><input type="submit" name="submit" id="submit" value="Change GSTIN" /> &nbsp;&nbsp;
					  <span class="style1"> Or</span> &nbsp;&nbsp;  <a href="#" class="style5" onclick="windowpop('add_bill_to_details.php', 450, 420)"><span class="style2">Add New</span></a>   </div></th>
				</tr>
				<?php
					if(isset($_POST['submit']) && ($_POST['submit'] == "Change GSTIN"))
					{	
						odbc_close_all();
						$strsql_gst="";
						$gstin_pan=$_POST['gstin_pan'];
						if($gstin_pan!="")
						{
							$strsql_gst="Select * from GST_BILL_TO_DETAILS where GSTIN='$gstin_pan'";
							$process_gst=odbc_exec($sqlconnect,$strsql_gst);
							
							if(odbc_fetch_row($process_gst))
							{
								$bill_no=odbc_result($process_gst,"BILL_ID");
								$up_gstin_sql="update GST_Invoice_Details set BillToID='$bill_no' where InvoiceNumber='$invoice_number'";
								odbc_close_all();
								odbc_exec($sqlconnect,$up_gstin_sql);
							}	
							else
							 {
							 ?>
								<tr>
								<th colspan="4"><div align="center"><span style="color:#FF0000">Details not found</span></div></th>
								</tr>	
							 <?php
							 } 						
						}					
					}					
					odbc_close_all();
					$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
					$process=odbc_exec($sqlconnect,$strsql);
					odbc_fetch_row($process);
				?>
				<tr>
				<th width="15%"><div align="left"><span style="color:#663300">Name</span></div></th>
				<th align="left" width="30%"><?php echo odbc_result($process,"NAME"); ?></th>
				<th width="15%"><div align="left"><span style="color:#663300">Address</span></div></th>
				<th colspan=2 align="left" width="30%"><?php echo odbc_result($process,"ADDRESS"); ?></th>
				</tr>
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
				</table>	
				
				<table style="background-color:#FFCCCC" width="100%" >
					<tr>
					<th colspan=5 ><div align=center> <span style="color:#663300">Communication Address </span></div></th>
					</tr>
					</table>
					<table style="background-color:#F6EECC" width="100%" border="1">
					<tr>
					<th colspan=5 align="left"><textarea name="comm_address" cols="100" rows="2"><?php if(isset($_POST['comm_address'])) echo $_POST['comm_address']; else echo odbc_result($process,"Communication_Address"); ?></textarea></th>
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
				<th colspan=2 align="left"><textarea name="desc_service" cols="50" rows="2"><?php if(isset($_POST['desc_service'])) echo $_POST['desc_service']; else echo odbc_result($process,"Description"); ?></textarea></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Taxable Value :</span></div></th>
				<th colspan="2" align="left"><input type="text" name="tax_value" value="<?php if(isset($_POST['tax_value'])) echo $tax_value=$_POST['tax_value']; else echo $tax_value=odbc_result($process,"TaxableValue"); ?>"   /><input type="submit" name="submit" id="submit" value="Calculate" /></th>
				</tr>
				<?php
				//echo $tax_value;
				if (isset($_POST['submit']) && ($_POST['submit'] == "Calculate") || isset($tax_value)) 
				{	
				
						$CGST=0; $SGST=0; $IGST=0; $total_value=0;
						$total_value=$tax_value;
						 ?>
							<tr>
							<th><div align="right"><span style="color:#663300">CGST (9%) :</span></div></th>
							<th colspan="2" align="left"><?php if($CGST==0) echo "N/A"; else echo IND_money_format($CGST); ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">SGST (9%) :</span></div></th>
							<th colspan="2" align="left"><?php if($SGST==0) echo "N/A"; else echo IND_money_format($SGST); ?></th>
							</tr>	
						<?php
						?>
							<tr>
							<th><div align="right"><span style="color:#663300">IGST (18%) :</span></div></th>
							<th colspan="2" align="left"><?php if($IGST==0) echo "N/A"; else echo IND_money_format($IGST); ?></th>
							</tr>	
						<?php
						?>
							<tr>
							<th><div align="right"><span style="color:#663300">Total Invoice Value (In figures) :</span></div></th>
							<th colspan="2" align="left"><?php echo IND_money_format($total_value); ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Total Invoice Value (In words) :</span></div></th>
							<th colspan="2" align="left"><?php  echo strtoupper(convert_number_to_words($total_value))." ONLY"; ?></th>
							</tr>	
							<tr>
							<th colspan="4"><div align="center"><input type="submit" name="submit" id="submit" value="Change Invoice" /></div></th>
							</tr>	
							<?php
								if (isset($_POST['submit']) && ($_POST['submit'] == "Change Invoice")) 
								{
									$up_inv_sql="update GST_Invoice_Details set Description='".$_POST['desc_service']."',TaxableValue=".$_POST['tax_value'].",CGSTAmount=$CGST,SGSTAmount=$SGST,IGSTAmount=$IGST,TotalInvoiceValue=$total_value,Communication_Address='".$_POST['comm_address']."' where InvoiceNumber='$invoice_number'";
									odbc_close_all();
									@odbc_exec($sqlconnect,$up_inv_sql);
								}
							?>
					</table>			
				</form>
			<?php 
			} 
			}
			?>
			<div align="center">
		<?php
		odbc_close_all();
		}
		?>
	</div>
	</div>
	</div>	
</body>
</html>
