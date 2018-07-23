<?php
    error_reporting( E_ALL );
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
			<form name='create_inv' action='create_inv.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
			<table  border="1"  width="100%">
			<tr>
				<th colspan="10" align="left"><div align="center"><span style="color:#663300">Enter Project Number :&nbsp;&nbsp;</span><input type="text" name="pn_pi" value="<?php echo $_POST['pn_pi']; ?>" size="30"  /><input type="submit" name="submit" id="submit" value="Get" /> 
				
			</th>
			</tr>
			<?php
				if(isset($_POST['submit']) && ($_POST['submit'] == "Get"))
				{

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
						
							$strsql="";
							$strsql="Select * from cmstlst a, DEPARTMENTMASTER b where a.dept=b.code and a.cprno like '".$_POST['pn_pi']."%'";
							//$sqlconnect6=odbc_connect($dsn,$username,$password);
							$process=odbc_exec($sqlconnect,$strsql);
							//echo "<br>Sixth Query :$strsql<br>";
							
							if (odbc_fetch_row($process))
							{
								$cprno=odbc_result($process,"cprno");
								$coor_name=odbc_result($process,"coor_name1");
								$depart=odbc_result($process,"name");
								$today_date=date("d/m/Y");
								$inst_id=odbc_result($process,"instid");	
								$_SESSION['cprno']=$cprno;					
								$_SESSION['instid']=$inst_id;					
								
					?>
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
					<table style="background-color:#F6EECC" width="100%" >
					<tr>
					<th colspan=5 >
					<div align="center"><nobr><h4>
					<a  href="acctcon_inv_reg.php" ><span style="background-color:#F6EECC">Invoice for Registered Client with GSTIN</span></a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;   
					<a  href="acctcon_inv_not_reg.php">Invoice for Clients without GSTIN</a>  <br /><br />  
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a  href="acctcon_inv_export.php">Invoice for Foreign Clients</a> 
					&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp; 
					<a  href="acctcon_inv_exempted.php">Invoice for Clients Exempted from GSTIN</a>  </h4></nobr></div> 
					</th></tr>
			<?php			 } 
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
