<?php
    error_reporting( E_ALL );
	 $type="";
	if($_GET['type']!="") $type=$_GET['type'];
	else $type=$_POST['type'];
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
function reload(form)
{
	type=document.search_inv.type.value;
	
	self.location='search_inv.php?type=' + type;  
		// alert (val1);
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
			<form name='search_inv' action='search_inv.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
			<table  border="1"  width="100%">
			<tr>
			<th width="39%" colspan="3"><div align="right"><span style="color:#663300">Select Search Type :</span></div></th>
			<th width="38%" align="left" colspan="4">
			<select name='type' onchange="reload(this.form)">
				<?php if($type!=""){ ?> <option value="<?php  echo $type; ?>"><?php echo $type; ?></option>
				<?php } else { ?><option>-Select-</option><?php } ?>
				<option value="Project Number">Project Number</option> 
				<option value="PI Name">PI Name</option> 
				<option value="Department Name">Department Name</option> 
				<option value="Vendor Name">Vendor Name</option> 
				<option value="Invoice Number">Invoice Number</option> 
			</select></th>
			</tr>
			<tr>
		<?php
		 if($type!="")
		 {
		 	$dsn="FACCTDSN";
			$username="sa";
			$password="IcsR@123#";
			$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
						
		 	if($type!="Department Name")
			{
			?>
			<tr>
			<th colspan="3" align="right"><div align="right"><span style="color:#663300">Enter <?php echo $type; ?> :&nbsp;&nbsp;</span></th>
			<th colspan=4 align="left"><input type="text" name="pn_pi" value="<?php echo $_POST['pn_pi']; ?>"  size="50"  /><input type="submit" name="submit" id="submit" value="Get" /> </div>				
			</th>
			</tr>
			<?php
			}
			else{ ?>
					<tr>
					<th colspan="3"><div align="right"><span style="color:#663300">Select Department:</span></div></th>
					<th colspan=4 align="left">
					<select name='depart'>
					<?php 
					if(isset($_POST['depart'])){ ?> <option value="<?php echo $_POST['depart']; ?>"><?php echo $_POST['depart'];  ?></option>
					<?php } else { ?><option>-Select Department-</option><?php } 
					
					$strsql_depart="";
					$strsql_depart="Select distinct DeptName from GST_Invoice_Details";
					$process_depart=odbc_exec($sqlconnect,$strsql_depart) or die("<br>Connection Failed");
					while(odbc_fetch_row($process_depart))
					{
						echo "<option value = '".odbc_result($process_depart,"DeptName")."'>".odbc_result($process_depart,"DeptName")."</option>";
					}	 ?>
					 </select><input type="submit" name="submit" id="submit" value="Get" />
					 </th>
					</tr>
			<?php } ?>
			
			<?php 
				if(isset($_POST['submit']) && ($_POST['submit'] == "Get"))
				{

					session_start();
					$_SESSION["username"];
					if (!isset($_SESSION["username"])) 
					{
					session_destroy();
					setcookie("PHPSESSID","",time()-3600,"/");
					header('location: http://icsris.iitm.ac.in/ICSRIS/admin/index.php');
					exit;
					}
					else
					{
						if($type=="Vendor Name")
						{
						?>
						<tr align="center">
							<th width="2%">S#</th>
							<th colspan="2" align="center"><div>Vendor Name</div></th>
							<th colspan="4" align="center"><div>Address</div></th>
						</tr>			
						<?php 	
						}
						else
						{
						?>
						<tr>
							<th width="10">S#</th>
							<th><div align="center" >Invoice Date</div></th>
							<th><div align="center" >Invoice Number </div></th>
							<th><div align="center" >Project Number </div></th>
							<th width="15%"><div>PI Name</div></th>
							<th><div align="center" >Taxable Value.</div></th>
							<th ><div align="center" >Total Invoice Value</div></th>
						</tr>			
						<?php 	
						}	
							odbc_close_all();
							$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
							$strsql="";
							
								$sno=1;
								if($type=="Vendor Name")
								{
										$strsql_vend="select name,bill_id,ADDRESS  from GST_BILL_TO_DETAILS where name like '%".$_POST['pn_pi']."%' union all select name,bill_id,ADDRESS  from GST_BILL_TO_DETAILS_EXPORT where name like '%".$_POST['pn_pi']."%' union all select name,bill_id,ADDRESS  from GST_BILL_TO_DETAILS_VENDOR where name like '%".$_POST['pn_pi']."%'";
										$process_vend=odbc_exec($sqlconnect,$strsql_vend) or die("<br>Connection Failed");
										while(odbc_fetch_row($process_vend))
										{
										echo "<tr>";
										echo "<td align='center'>$sno</td>";
										echo "<td colspan=2><a href='http://icsris.iitm.ac.in/ICSRIS/admin/vendor_inv.php?bill_id=".odbc_result($process_vend,"bill_id")."' target='_blank'><b>".odbc_result($process_vend,"name")."</b></td>";
										echo "<td colspan=4 >".odbc_result($process_vend,"ADDRESS")."</td>";
										echo "</tr>";
										$sno++;
										}
								}
								else
								{
									if($_POST['pn_pi']!="")
									{
										if($type=="Invoice Number") $strsql_inv="Select * from GST_Invoice_Details where InvoiceNumber like '%".$_POST['pn_pi']."%'";
										else $strsql_inv="Select * from GST_Invoice_Details where (projectnumber like '%".$_POST['pn_pi']."%' or piname like '%".$_POST['pn_pi']."%') order by DINP";
									}
									elseif($_POST['depart']!="")	$strsql_inv="Select * from GST_Invoice_Details where deptname like '%".$_POST['depart']."%' order by DINP";
									
									$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
									while(odbc_fetch_row($process_inv))
									{
										$inv_date=odbc_result($process_inv,"InvoiceDate");
										$inv_date=date("d-m-Y", strtotime($inv_date));
										$inv_no=odbc_result($process_inv,"InvoiceNumber");
										$inv_type=odbc_result($process_inv,"InvoiceType");
										$ProjectNumber=odbc_result($process_inv,"ProjectNumber");
										$PIName=odbc_result($process_inv,"PIName");
										$TaxableValue=odbc_result($process_inv,"TaxableValue");
										$TotalInvoiceValue=odbc_result($process_inv,"TotalInvoiceValue");
										echo "<tr>";
										echo "<td align='center'>$sno</td>";
										echo "<td><b>$inv_date</b></td>";
										echo "<td align='center'><a href='http://icsris.iitm.ac.in/ICSRIS/admin/acctcon_inv_rep.php?invoice_number=$inv_no&inv_type=$inv_type' target='_blank'><b>$inv_no</b></td>";
										echo "<td align='center'>$ProjectNumber</td>";
										echo "<td>$PIName</td>";
										echo "<td align='center'>$TaxableValue</td>";
										echo "<td align='center'>$TotalInvoiceValue</td>";		
										echo "</tr>";
										//
										//$myArr=array($sno,$inv_date,$inv_no,$ProjectNumber,$PIName,odbc_result($process_inv,"DeptName"),odbc_result($process_inv,"Description"),odbc_result($process_inv,"TaxableValue"),odbc_result($process_inv,"CGSTAmount"),odbc_result($process_inv,"SGSTAmount"),odbc_result($process_inv,"IGSTAmount"),odbc_result($process_inv,"TotalInvoiceValue"),odbc_result($process_inv,"SACNumber"),odbc_result($process_inv,"NAME"),odbc_result($process_inv,"ADDRESS"),odbc_result($process_inv,"DISTRICT"),odbc_result($process_inv,"PINCODE"),odbc_result($process_inv,"STATE"),odbc_result($process_inv,"STATECODE"),odbc_result($process_inv,"GSTIN"),odbc_result($process_inv,"PANNO"),odbc_result($process_inv,"TANNO"),odbc_result($process_inv,"CONTACTPERSON"),odbc_result($process_inv,"EMAIL"),odbc_result($process_inv,"CONTACTNO"));
										//$excel->writeLine($myArr);
				
				
										$sno++;							
									}
							}
					}
				}
			}
			?>
					</table>
				</form>
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
