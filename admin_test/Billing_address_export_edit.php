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
			if(isset($_GET["bill_id"]))	$bill_id=$_GET["bill_id"];
			else $bill_id=$_SESSION["bill_id"];			
			
			$_SESSION["bill_id"]=$bill_id;
			
			
			$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
			$strsql="";
			$strsql="Select * from GST_BILL_TO_DETAILS_export where Bill_ID='$bill_id'";
			$process=odbc_exec($sqlconnect,$strsql);
			if (odbc_fetch_row($process))
			{
				?>
				<form name='Billing_address_export_edit' action='Billing_address_export_edit.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
				<div align="center">
				<table style="background-color:#F6EECC" width="100%" >
				<tr>
				<th colspan=5 ><div align=right><span style="color:#CC0000"><a href="Billing_address_export.php">Home - Billing Details - Export</a></span></div></th>
				</tr>
				</table>
				<tr>
				<th colspan=5 ><div align=center> <span style="color:#663300">Billing Details Export</span></div></th>
				</tr>
				</table>
				<table style="background-color:#F6EECC" width="100%" border="1" >
				<tr>
				<th width="40%"><div align="left"><span style="color:#663300">Name</span></div></th>
				<th align="left" width="30%"><input type="text" name="NAME" value="<?php if(isset($_POST['NAME'])) echo $NAME=$_POST['NAME']; else echo $NAME=odbc_result($process,"NAME"); ?>"  size="70"  /></th>
				</tr>
				<tr>
				<th width="40%"><div align="left"><span style="color:#663300">Address</span></div></th>
				<th colspan=2 align="left" width="30%"><textarea name="ADDRESS" cols="60" rows="5"><?php if(isset($_POST['ADDRESS'])) echo $_POST['ADDRESS']; else echo odbc_result($process,"ADDRESS"); ?></textarea></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">District</span></div></th>
				<th align="left"><input type="text" name="COUNTRY" value="<?php if(isset($_POST['COUNTRY'])) echo $COUNTRY=$_POST['COUNTRY']; else echo $COUNTRY=odbc_result($process,"COUNTRY"); ?>"  size="70"  /></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Contact Person</span></div></th>
				<th colspan=2 align="left"><input type="text" name="CONTACTPERSON" value="<?php if(isset($_POST['CONTACTPERSON'])) echo $NAME=$_POST['CONTACTPERSON']; else echo $NAME=odbc_result($process,"CONTACTPERSON"); ?>"  size="70" /></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Email</span></div></th>
				<th align="left"><input type="text" name="EMAIL" value="<?php if(isset($_POST['EMAIL'])) echo $NAME=$_POST['EMAIL']; else echo $EMAIL=odbc_result($process,"EMAIL"); ?>" size="70"  /></th>
				</tr>
				<tr>
				<th><div align="left"><span style="color:#663300">Contact No</span></div></th>
				<th colspan=2 align="left"><input type="text" name="CONTACTNO" value="<?php if(isset($_POST['CONTACTNO'])) echo $CONTACTNO=$_POST['CONTACTNO']; else echo $CONTACTNO=odbc_result($process,"CONTACTNO"); ?>"  size="70" /></th>
				</tr>				
				<tr>
				<td colspan=6 align="center	"><div align="center">
				  <input type="submit" name="submit" id="submit" value="Change Address" />
				  </div></td>
				</tr>		
				<?php
					if (isset($_POST['submit']) && ($_POST['submit'] == "Change Address")) 
					{
						$up_bill_sql="update GST_BILL_TO_DETAILS_export set NAME='".$_POST['NAME']."',ADDRESS='".$_POST['ADDRESS']."',COUNTRY='".$_POST['COUNTRY']."',CONTACTPERSON='".$_POST['CONTACTPERSON']."',EMAIL='".$_POST['EMAIL']."',CONTACTNO='".$_POST['CONTACTNO']."' where bill_id='$bill_id'";
						odbc_close_all();
						odbc_exec($sqlconnect,$up_bill_sql);
						$msg="Successfully Changed"					
				?>
				<tr>
				<td colspan=6 align="center	"><div align="center"><?php echo $msg; ?></div></td>
				</tr>		
				<?php
					}
				?>		
				</table>	
				</form>
			<?php 
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
