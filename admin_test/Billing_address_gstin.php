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
	
function OpenPopup2 (c) {
		window.open(c,' ','width=550,height=200,scrollbars=yes');		
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
						$fname="download/Bill_Address_Reg-Exempted.xls";
						$excel=new ExcelWriter($fname);
						if($excel==false)	echo $excel->error;	
						
						$myArr=array("<b>S.No</b>","<b>GSTIN Code</b>","<b>Vendor Name</b>","<b>ADDRESS</b>","<b>District </b>","<b>State</b>","<b>STATECODE</b>","<b>PINCODE</b>","<b>PANNO</b>","<b>TANNO</b>","<b>Contact Person</b>","<b>Email</b>","<b>Contact No</b>","<b>CREATEDBY</b>");
						$excel->writeLine($myArr);
					?>
					<table style="background-color:#F6EECC" width="100%" >
					<tr>
					<th colspan=5 >
					<div align="center"><nobr><h4><a  href="Billing_address_gstin.php" ><span style="background-color:#F6EECC">Billing Address (With GSTIN) / Exempted </span></a>  |  <a  href="Billing_address_gstin_ur.php">Billing Address Un-Registered (Without GSTIN)</a>  <br /><br />  <a  href="Billing_address_export.php">Billing Address for Export</a>  </h4></nobr></div> 
					</th></tr>
					</table>
				<div align="center"><strong>Billing Address - Registered / Exempted</strong></div>
					<table  border="1">
					<tr><td height="27" colspan="7" align="right">Click <a href="<?php echo $fname; ?>" ><b>here</a></b> to Download Excel </td></tr>
						<tr>
						<th width="10">S#</th>
						<!--<th width="15">Select</th> -->
						<th><div align="center" >GSTIN Code</div></th>
						<th><div align="center" >Vendor Name</div></th>
						<th><div align="center" >State</div></th>
						<th><div align="center" >District </div></th>
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
								$strsql_inv="Select * from GST_BILL_TO_DETAILS order by DINP";
								$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
								while(odbc_fetch_row($process_inv))
								{
									$bill_id=odbc_result($process_inv,"bill_id");
									$gstin_code=odbc_result($process_inv,"GSTIN");
									$vendor_name=odbc_result($process_inv,"NAME");
									$state=odbc_result($process_inv,"STATE");
									$district=odbc_result($process_inv,"DISTRICT");

									echo "<tr>";
									echo "<td align='center'>$sno</td>";
									echo "<td align='center'><a href=http://icsris.iitm.ac.in/ICSRIS/admin/Billing_address_gstin_edit.php?bill_id=$bill_id><b>$gstin_code</b></td>";
									echo "<td><b>$vendor_name</b></td>";
									echo "<td align='center'>$state</td>";
									echo "<td align='center'>$district</td>";
									echo "<td><a href='remove_vendor.php?bill_id=$bill_id&type=R' onClick='OpenPopup2(this.href); return false' style='text-decoration:underline'><font color='orange'><b>Remove</b></font></a></td>";
									echo "</tr>";
				
									
									$myArr=array($sno,$gstin_code,$vendor_name,odbc_result($process_inv,"ADDRESS"),odbc_result($process_inv,"DISTRICT"),odbc_result($process_inv,"STATE"),odbc_result($process_inv,"STATECODE"),odbc_result($process_inv,"PINCODE"),odbc_result($process_inv,"PANNO"),odbc_result($process_inv,"TANNO"),odbc_result($process_inv,"CONTACTPERSON"),odbc_result($process_inv,"EMAIL"),odbc_result($process_inv,"CONTACTNO"),odbc_result($process_inv,"CREATEDBY"));
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
