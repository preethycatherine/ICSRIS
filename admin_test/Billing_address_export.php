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
	
function OpenPopup2 (c) {
		window.open(c,' ','width=550,height=200,scrollbars=yes');		
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
						$fname="download/Bill_Address_Export.xls";
						$excel=new ExcelWriter($fname);
						if($excel==false)	echo $excel->error;	
						
						$myArr=array("<b>S.No</b>","<b>Vendor Name</b>","<b>ADDRESS</b>","<b>Country</b>","<b>Contact Person</b>","<b>Email</b>","<b>Contact No</b>","<b>CREATEDBY</b>");
						$excel->writeLine($myArr);
					?>
					<table style="background-color:#F6EECC" width="100%" >
					<tr>
					<th colspan=5 >
					<div align="center"><nobr><h4><a  href="Billing_address_gstin.php" ><span style="background-color:#F6EECC">Billing Address (With GSTIN) / Exempted </span></a>  |  <a  href="Billing_address_gstin_ur.php">Billing Address Un-Registered (Without GSTIN)</a>  <br /><br />  <a  href="Billing_address_export.php">Billing Address for Export</a>  </h4></nobr></div> 
					</th></tr>
					</table>
				<div align="center"><strong>Billing Address - Export</strong></div>
					<table  border="1">
					<tr><td height="27" colspan="7" align="right">Click <a href="<?php echo $fname; ?>" ><b>here</a></b> to Download Excel </td></tr>
						<tr>
						<th width="10">S#</th>
						<!--<th width="15">Select</th> -->
						<th width="30%"><div align="center" >Vendor Name</div></th>
						<th><div align="center" >State</div></th>
						<th><div align="center" >District </div></th>
						<th><div align="center" >Contact Person </div></th>
						<th><div align="center" >Contact No </div></th>
						<th><div align="center" >Remove </div></th>
						<?php
						session_start();
						$_SESSION["username"];
						if (!isset($_SESSION["username"])) 
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
							$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
							
								
								$_SESSION['invoice_type']="Registered";
								$sno=1;
								$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
								$strsql_inv="Select * from GST_BILL_TO_DETAILS_export order by DINP";
								$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
								while(odbc_fetch_row($process_inv))
								{
									$bill_id=odbc_result($process_inv,"bill_id");
									$vendor_name=odbc_result($process_inv,"NAME");
									$address=odbc_result($process_inv,"ADDRESS");
									$country=odbc_result($process_inv,"COUNTRY");
									$contact_person=odbc_result($process_inv,"CONTACTPERSON");
									$contact_no=odbc_result($process_inv,"CONTACTNO");

									echo "<tr>";
									echo "<td align='center'>$sno</td>";
									echo "<td align='left'><a href=http://icsris.iitm.ac.in/ICSRIS/admin/Billing_address_export_edit.php?bill_id=$bill_id><b>$vendor_name</b></td>";
									//echo "<td><b>$vendor_name</b></td>";
									echo "<td align='center'>$address</td>";
									echo "<td align='center'>$country</td>";
									echo "<td align='center'>$contact_person</td>";
									echo "<td align='center'>$contact_no</td>";
									echo "<td><a href='remove_vendor.php?bill_id=$bill_id&type=E' onClick='OpenPopup2(this.href); return false' style='text-decoration:underline'><font color='orange'><b>Remove</b></font></a></td>";
									echo "</tr>";
									
									$myArr=array($sno,$vendor_name,odbc_result($process_inv,"ADDRESS"),odbc_result($process_inv,"COUNTRY"),odbc_result($process_inv,"CONTACTPERSON"),odbc_result($process_inv,"EMAIL"),odbc_result($process_inv,"CONTACTNO"),odbc_result($process_inv,"CREATEDBY"));
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
