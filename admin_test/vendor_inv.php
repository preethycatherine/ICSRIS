<?php
    error_reporting( E_ALL );
	 $bill_id="";
	if($_GET['bill_id']!="") $bill_id=$_GET['bill_id'];
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
			<form name='vendor_inv' action='vendor_inv.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
			<table  border="1"  width="100%">			
		<?php
		 if($bill_id!="")
		 {
		 	$dsn="FACCTDSN";
			$username="sa";
			$password="IcsR@123#";
			$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
			
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
							
							odbc_close_all();
							$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
							$strsql="";
							
								$sno=1;
								$strsql_inv="Select * from GST_Invoice_Details where billtoid='$bill_id' order by DINP";
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
