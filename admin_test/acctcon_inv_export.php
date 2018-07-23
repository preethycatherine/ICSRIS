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
	function reload(form)
	{
		var comp="",date="";
		v_name=document.acctcon_inv_export.v_name.value;
		v_country=document.acctcon_inv_export.v_country.value;
		
		self.location='acctcon_inv_export.php?v_name=' + v_name +'&v_country=' + v_country;  
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

ob_start();
session_start();
//echo $_SESSION["instid"];
if (!isset($_SESSION["username"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
exit;
}
else
	{
	session_register("logname");
	$cprno=$_SESSION["cprno"];
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
	
	$strsql="";
	$strsql="select count(*) as pcno from cmstlst where cprno like '$cprno%'";
	$process=odbc_exec($sqlconnect,$strsql) or die("<br>Connection Failed");
	if(odbc_fetch_row($process))
	{
	$pono=odbc_result($process,"pcno");
	}
	else 
	$pono=0;

	odbc_close_all();
	$strsql="";
	$strsql="Select * from cmstlst a, DEPARTMENTMASTER b where a.dept=b.code and a.cprno like '$cprno%'";
	//$sqlconnect6=odbc_connect($dsn,$username,$password);
	$process=odbc_exec($sqlconnect,$strsql);
	//echo "<br>Sixth Query :$strsql<br>";
	
	if (odbc_fetch_row($process) && ($pono==1))
	{
		$cprno=odbc_result($process,"cprno");
		$coor_name=odbc_result($process,"coor_name1");
		$depart=odbc_result($process,"name");
		$today_date=date("d/m/Y");
		$inst_id=odbc_result($process,"instid");
		$agency_code=odbc_result($process,"agenc_code");
		$sac_no="";
		?>
		<form name='acctcon_inv_export' action='acctcon_inv_export.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
		<div align="center">
		<table style="background-color:#F6EECC" width="100%" >
		<tr>
		<th colspan=5 ><div align=right><span style="color:#CC0000"><a href="create_inv.php">Home - Create Invoice</a></span></div></th>
		</tr>
		<tr>
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Tax Invoice(Export) for Project of <?php echo "$cprno"; ?> </span></div></th>
		</tr>
		</table>
		<table style="background-color:#F6EECC" width="100%" border="1" >
		<!--<tr>
		<th><div align="right"><span style="color:#663300">Invoice No :</span></div></th>
		<th align="left"><?php echo $inv_no="C1718".$inst_id."S1"; ?></th>
		<th><div align="right"><span style="color:#663300">Invoice Date :</span></div></th>
		<th colspan=2 align="left"><?php echo $inv_date="$today_date"; ?></th>
		</tr>-->
		<tr>
		<th><div align="right"><span style="color:#663300">Project Number :</span></div></th>
		<th colspan="4"><div align="center"><?php echo "$cprno"; ?></div></th>
		</tr>
		<tr>
		<th><div align="right"><span style="color:#663300">Department Name :</span></div></th>
		<th colspan=2 align="left"><?php echo $depart; ?></th>
		<th><div align="right"><span style="color:#663300">PI Name :</span></div></th>
		<th align="left"><?php echo $coor_name; ?></th>
		</tr>
		</table>
		
		
		<table style="background-color:#FFCCCC" width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">Billing Details </span></div></th>
		</tr>
		</table>
		<table style="background-color:#F6EECC" width="100%" border="1" >
		
		<tr>
		<th colspan="2" align="left"><div align="center"><span style="color:#663300">Choose Vendor Name:&nbsp;&nbsp;</span></div></th>
		<th colspan="2" align="left">			
			<select name='v_name' onchange="reload(this.form)">
			<?php 
				if(isset($_GET['v_name'])){ ?> <option value="<?php echo $_GET['v_name']; ?>"><?php echo $_GET['v_name'];  ?></option>
			<?php } elseif(isset($_POST['v_name'])){ ?> <option value="<?php echo $_POST['v_name']; ?>"><?php echo $_POST['v_name'];  ?></option>
			<?php } else { ?><option>-Select Vendor Name-</option><?php } 
			odbc_close_all();
			$strsql_v_name="";
			$strsql_v_name="Select distinct name from GST_BILL_TO_DETAILS_EXPORT order by name";
			$process_v_name=odbc_exec($sqlconnect,$strsql_v_name) or die("<br>Connection Failed");
			while(odbc_fetch_row($process_v_name))
			{
				echo "<option value = '".odbc_result($process_v_name,"NAME")."'>".substr(odbc_result($process_v_name,"NAME"),0,85)."</option>";
			}
			 ?>
			 </select></th>
		</tr>
		
		
		<tr>
		<th colspan="2" align="left"><div align="center"><span style="color:#663300">Choose Vendor Country:&nbsp;&nbsp;</span></div></th>
		<th colspan="2" align="left">			
			<select name='v_country' onchange="reload(this.form)">
			<?php 
				if(isset($_GET['v_country'])){ ?> <option value="<?php echo $_GET['v_country']; ?>"><?php echo $_GET['v_country'];  ?></option>
			<?php } elseif(isset($_POST['v_country'])){ ?> <option value="<?php echo $_POST['v_country']; ?>"><?php echo $_POST['v_country'];  ?></option>
			<?php } else { ?><option>-Select Vendor Name-</option><?php } 
			odbc_close_all();
			$strsql_v_country="";
			$strsql_v_country="Select * from GST_BILL_TO_DETAILS_EXPORT where name='".$_GET['v_name']."' order by country";
			$process_v_country=odbc_exec($sqlconnect,$strsql_v_country) or die("<br>Connection Failed");
			while(odbc_fetch_row($process_v_country))
			{
				echo "<option value = '".odbc_result($process_v_country,"COUNTRY")."'>".substr(odbc_result($process_v_country,"COUNTRY"),0,85)."</option>";
			}
			 ?>
			 </select></th>
		</tr>
		
		
		
		<tr>
		<th colspan="4" align="left"><div align="center">
		 <input type="submit" name="submit" id="submit" value="Get Details" /> &nbsp;&nbsp;
		<span class="style1"> Or</span> &nbsp;&nbsp;  <a href="#" class="style5" onclick="windowpop('add_bill_to_details_export.php', 450, 320)"><span class="style2">Add New</span></a>   </div></th>
		</tr>
		<?php
		$_SESSION['BILL_ID']=$_POST['v_district'];
		if ((isset($_POST['submit']) && ($_POST['submit'] == "Get Details")) || isset($_POST['v_name']) || isset($_SESSION['v_name'])) 
		{	
			odbc_close_all();
			$strsql_vendor="";
			$v_name=$_POST['v_name'];
			$v_country=$_POST['v_country'];
			
			if($v_country!="")
			{
				$strsql_v_details="Select * from GST_BILL_TO_DETAILS_EXPORT where name='$v_name' and country='$v_country'";
				//$sqlconnect6=odbc_connect($dsn,$username,$password);
				$process_v_details=odbc_exec($sqlconnect,$strsql_v_details);
				//echo "<br>Sixth Query :$strsql<br>";
				if(odbc_fetch_row($process_v_details))
				{
					$bill_no=odbc_result($process_v_details,"BILL_ID");
			?>
					<tr>
					<th width="20%"><div align="right"><span style="color:#663300">Name :</span></div></th>
					<th align="left" width="30%"><?php echo odbc_result($process_v_details,"NAME"); ?></th>
					<th width="20%"><div align="right"><span style="color:#663300">Address</span></div></th>
					<th colspan=2 align="left" width="30%"><?php echo nl2br(odbc_result($process_v_details,"ADDRESS")); ?></th>
					</tr>
					<tr>
					<th><div align="right"><span style="color:#663300">Country :</span></div></th>
					<th align="left"><?php echo odbc_result($process_v_details,"COUNTRY"); ?></th>
					<th><div align="right"><span style="color:#663300">Contact Person :</span></div></th>
					<th colspan=2 align="left"><?php echo odbc_result($process_v_details,"CONTACTPERSON"); ?></th>
					</tr>
					<tr>
					<th><div align="right"><span style="color:#663300">Email :</span></div></th>
					<th align="left"><?php echo odbc_result($process_v_details,"EMAIL"); ?></th>
					<th><div align="right"><span style="color:#663300">Contact No :</span></div></th>
					<th colspan=2 align="left"><?php echo odbc_result($process_v_details,"CONTACTNO"); ?></th>
					</tr>
					<tr>
					<th colspan=5 ><div align=center> <span style="color:#663300">If change contact details, </span></div></th>
					</tr>
					<tr>
					<th><div align="right"><span style="color:#663300">Contact Person :</span></div></th>
					<th align="left"><input type="text" name="Comm_CONTACTPERSON" value="<?php if(isset($_POST['Comm_CONTACTPERSON'])) echo $_POST['Comm_CONTACTPERSON']; ?>"  size="30"   /></th>
					<th><div align="right"><span style="color:#663300">Contact No :</span></div></th>
					<th align="left"><input type="text" name="Comm_CONTACTNO" value="<?php if(isset($_POST['Comm_CONTACTNO'])) echo $_POST['Comm_CONTACTNO']; ?>"   /></th>
					</tr>
					<tr>
					<th><div align="right"><span style="color:#663300">Email :</span></div></th>
					<th align="left" colspan="3"><input type="text" name="Comm_EMAIL" value="<?php if(isset($_POST['Comm_EMAIL'])) echo $_POST['Comm_EMAIL']; ?>" size="60"   /></th>
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
					<th colspan=5 ><div align=center> <span style="color:#663300">Cummunication Address </span></div></th>
					</tr>
					</table>
					<table style="background-color:#F6EECC" width="100%" border="1">
					<tr>
					<th colspan=5 align="left"><textarea name="comm_address" cols="95" rows="2"><?php if(isset($_POST['comm_address'])) echo $_POST['comm_address']; ?></textarea></th>
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
					<th colspan="2" align="left">
						<select name='curr_type'>
						<?php 
							if(isset($_GET['curr_type'])){ ?> <option value="<?php echo $_GET['curr_type']; ?>"><?php echo $_GET['curr_type'];  ?></option>
						<?php } elseif(isset($_POST['curr_type'])){ ?> <option value="<?php echo $_POST['curr_type']; ?>"><?php echo $_POST['curr_type'];  ?></option>
						<?php } else { ?><option>-Select Currency Type-</option>
										<option value="EUR">EUR</option> 
										<option value="USD">USD</option> 
										<option value="GBP">GBP</option> 
										<option value="JPY">JPY</option> 
										<option value="NOK">NOK</option> 
										<option value="KD">KD</option> 
										<option value="YEN">YEN</option> 
										<option value="SGD">SGD</option> 
										<option value="SEK">SEK</option> 
										<option value="AED">AED</option> 
						<?php }  ?>
						 </select>
						<input type="text" name="tax_value" value="<?php if(isset($_POST['tax_value'])) echo $_POST['tax_value']; ?>"   />
						<input type="submit" name="submit" id="submit" value="Calculate" /></th>
					</tr>
					<?php
					if (isset($_POST['submit']) && ($_POST['submit'] == "Calculate") || isset($_POST['tax_value'])) 
					{	
					//echo substr($_POST['bill_gstin'],0,2);
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
							$CGST=0; $SGST=0; $IGST=0; $total_value=0;
							include("../currency_words.php");
							$total_value=$_POST['tax_value'];
							 ?>
								<tr>
								<th><div align="right"><span style="color:#663300">CGST (9%) :</span></div></th>
								<th colspan="2" align="left"><?php echo IND_money_format($CGST); ?></th>
								</tr>
								<tr>
								<th><div align="right"><span style="color:#663300">SGST (9%) :</span></div></th>
								<th colspan="2" align="left"><?php echo IND_money_format($SGST); ?></th>
								</tr>	
								<tr>
								<th><div align="right"><span style="color:#663300">IGST (18%) :</span></div></th>
								<th colspan="2" align="left"><?php echo IND_money_format($IGST); ?></th>
								</tr>	
								<tr>
								<th><div align="right"><span style="color:#663300">Total Invoice Value (In figures) :</span></div></th>
								<th colspan="2" align="left"><?php echo IND_money_format($total_value); ?></th>
								</tr>
								<tr>
								<th><div align="right"><span style="color:#663300">Total Invoice Value (In words) :</span></div></th>
								<th colspan="2" align="left"><?php  echo ucwords(convert_number_to_words($total_value))." Only"; ?></th>
								</tr>	
								
								<tr>
								<th colspan="4"><div align="center"><input type="submit" name="submit" id="submit" value="Submit Invoice" /></div></th>
								</tr>	
							 <?php
								if (isset($_POST['submit']) && ($_POST['submit'] == "Submit Invoice")) 
								{	
									$Inst_GSTIN="33AAAAI3615G1Z6";  $curr_year=date('y'); $financial_year="1718";//$curr_year.($curr_year+1);
									$invoice_number="";
									
									odbc_close_all();
									$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
									
									$strsql_inv="Select * from GST_Invoice_Details order by DINP";
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
											$invoice_number="C".$financial_year.$_SESSION['instid']."C".(substr(odbc_result($process_inv,"InvoiceNumber"),10)+1);
									}
										$inv_date=date('d-m-Y');
										$ins_sql="insert into GST_Invoice_Details(DINP,InstGSTINNo,InvoiceNumber,InvoiceDate,ProjectType,ProjectNumber,DeptName,PIName,PlaceOfSupply,SACNumber,BillToID,SNo,Description,TaxableValue,CGSTRate,CGSTAmount,SGSTRate,SGSTAmount,IGSTRate,IGSTAmount,TotalInvoiceValue,InvoiceType,Currency_Type,Communication_Address,Communication_CONTACTPERSON,Communication_CONTACTNO,Communication_EMAIL) values(GETDATE(),'$Inst_GSTIN','$invoice_number',GETDATE(),'CONS','$cprno','$depart','$coor_name','".$_POST['bill_state']."','".$_POST['sac']."','$bill_no',1,'".$_POST['desc_service']."',".$_POST['tax_value'].",9,".$CGST.",9,".$SGST.",18,".$IGST.",".$total_value.",'Export','".$_POST['curr_type']."','".$_POST['comm_address']."','".$_POST['Comm_CONTACTPERSON']."','".$_POST['Comm_CONTACTNO']."','".$_POST['Comm_EMAIL']."')";
								odbc_close_all();
								$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
								odbc_exec($sqlconnect,$ins_sql);
								//echo $q;
								
								require_once('../mail/mail.php');
								
								//$to="placement.webops@iitm.ac.in";
								//$to=strtolower($_SESSION["username"])."@iitm.ac.in";
								$to="icsraccounts@iitm.ac.in";
								
								$mail->Subject = "Reg. - Invoice created for the project of $cprno";
								$mail->Body = "	Dear Sir/Madam,<br><br>
								
									The Invoice for the project of <b>$cprno</b> was created successfully.<br><br>
									
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
								$mail->AddCC("icsraccounts@iitm.ac.in", "");
								//$mail->AddCC("cmit-icsr@iitm.ac.in", "");
								//$mail->AddCC("c.sathishkumarmca@gmail.com", "");
								//$mail->AddCC("skumarkiitm@gmail.com", "");
								if($mail->Send()) $errmsg="Mail Sent";
								else $errmsg="Not Sent";		
								$mail->ClearAddresses();
								 echo $errmsg;
	
								ob_clean();
								$_SESSION['invoice_number']=$invoice_number;
								$_SESSION['invoice_type']="Export";
								header('location: acctcon_inv_rep.php');																		
							}	
						}								 	
					}
				 }
				 else
				 {
				 ?>
					<tr>
					<th colspan="4"><div align="center"><span style="color:#663300">Details not found</span></div></th>
					</tr>	
				 <?php
				 }
			  }	
			  else
				 {
				 ?>
					<tr>
					<th colspan="4"><div align="center"><span style="color:#663300">Choose all fields to get details</span></div></th>
					</tr>	
				 <?php
				 }
		   }
		?>
		</table>
		</div>
		</form>
		</div>
		<div align="center">
<?php
}
odbc_close_all();
}
?>
