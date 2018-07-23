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
			<form name='acctcon_ntds' action='acctcon_ntds.php' method='POST'  onSubmit="return validate()" enctype="multipart/form-data">
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
							$strsql="select * from FoxOffice..PCMASTER a, FoxOffice..DepartmentMaster b where a.APRLNO like '".$_POST['pn_pi']."%' and a.DEP_NAME=b.DepartmentCode";
							//$sqlconnect6=odbc_connect($dsn,$username,$password);
							$process=odbc_exec($sqlconnect,$strsql);
							//echo "<br>Sixth Query :$strsql<br>";
							
							if (odbc_fetch_row($process))
							{
								$cprno=odbc_result($process,"APRLNO");
								$coor_name=odbc_result($process,"coor1");
								$depart=odbc_result($process,"DepartmentName");
								$today_date=date("d/m/Y");
								$inst_id=odbc_result($process,"instid");	
								$_SESSION['cprno']=$cprno;					
								$_SESSION['instid']=$inst_id;					
								
					?>
							<tr>
							<th><div align="right"><span style="color:#663300">Project Number :</span></div></th>
							<th colspan="4"><div align="left"><?php echo "$cprno"; ?></div></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">PI Name :</span></div></th>
							<th align="left"><?php echo $coor_name; ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Department Name :</span></div></th>
							<th colspan=2 align="left"><?php echo $depart; ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Co PI Name :</span></div></th>
							<th align="left">
								<?php 
									if(odbc_result($process,"coor2")!="") echo odbc_result($process,"coor2"); 
									if(odbc_result($process,"coor3")!="") echo  ",".odbc_result($process,"coor3");
									if(odbc_result($process,"coor4")!="") echo  ",".odbc_result($process,"coor4");
									if(odbc_result($process,"coor5")!="") echo  ",".odbc_result($process,"coor5");
									else echo "--";
								?>
							</th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Title of the Project :</span></div></th>
							<th align="left"><?php echo odbc_result($process,"title"); ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Start Date :</span></div></th>
							<th align="left"><?php echo $sdate=date('d-m-Y', strtotime(odbc_result($process,"stdate"))); ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Closure Date :</span></div></th>
							<th align="left"><?php echo $cdate=date('d-m-Y', strtotime(odbc_result($process,"enddate"))); ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Project Cost :</span></div></th>
							<th align="left"><?php echo odbc_result($process,"sanvalue"); ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Agency Name :</span></div></th>
							<th align="left"><?php 	echo odbc_result($process,"SCOM");			?>
							</th></tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Agency Registered Address :</span></div></th>
							<th align="left">
							<?php //echo "ss".odbc_result($process,"ADD2");
								if(trim(odbc_result($process,"ADD1"))!="") echo odbc_result($process,"ADD1");
								if(trim(odbc_result($process,"ADD2"))!="") echo ",<br>".odbc_result($process,"ADD2");
								if(trim(odbc_result($process,"ADD3"))!="") echo ",<br>".odbc_result($process,"ADD3"); 
								else echo "--";
							?>
							</th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">GSTIN :</span></div></th>
							<th align="left"><?php echo odbc_result($process,"SGSTINNUMBER"); ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">PAN :</span></div></th>
							<th align="left"><?php echo odbc_result($process,"SPANNUMBER"); ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">TAN :</span></div></th>
							<th align="left"><?php echo odbc_result($process,"STANNUMBER"); ?></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Contact Name :</span></div></th>
							<th align="left"><input type="text" name="contact_name" id="contact_name" ></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Email :</span></div></th>
							<th align="left"><input type="text" name="contact_email" id="contact_email" ></th>
							</tr>
							<tr>
							<th><div align="right"><span style="color:#663300">Contact No :</span></div></th>
							<th align="left"><input type="text" name="contact_no" id="contact_no" ></th>
							</tr>
						</table>
			<?php	} ?>
						<table  border="1"  width="100%">
       						<tr>
								<th><div align="center"><span style="color:#663300">Apply NIL TDS Certificate</span></div></th>
								<th><div align="center"><span style="color:#663300">Applied Amount</span></div></th>
								<th><div align="center"><span style="color:#663300">Received Amount</span></div></th>
								<th><div align="center"><span style="color:#663300">Certificate soft copy</span></div></th>
							</tr>
			<?php	
						foreach(calcFY($sdate,$cdate) as $value){ ?>
        						<tr align="center">
									<th><div align="center"><span style="color:#663300"><?php echo $value; ?></span></div></th>
									<th><div align="center"><input type="text" name="<?php echo $value; ?>" id="<?php echo $value; ?>" ></div></th>
									<th><div align="center"><?php echo $value; ?></div></th>
									<th><div align="center"><input type="file" name="soft_copy" /></div></th>
								</tr>
			<?php							
								}
					}
				}
				
				function calcFY($startDate,$endDate) {

					$prefix = '20';
				
					$ts1 = strtotime($startDate);
					$ts2 = strtotime($endDate);
				
					$year1 = date('Y', $ts1);
					$year2 = date('Y', $ts2);
				
					$month1 = date('m', $ts1);
					$month2 = date('m', $ts2);
				
					//get months
					$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
				
					/**
					 * if end month is greater than april, consider the next FY
					 * else dont consider the next FY
					 */
					$total_years = ($month2 > 4)?ceil($diff/12):floor($diff/12);
				
					$fy = array();
				
					while($total_years >= 0) {
				
						$prevyear = $year1 - 1;
				
						//We dont need 20 of 20** (like 2014)
						$fy[] = $prefix.substr($prevyear,-2).'-'.substr($year1,-2);
				
						$year1 += 1;
				
						$total_years--;
					}
					/**
					 * If start month is greater than or equal to april, 
					 * remove the first element
					 */
					if($month1 >= 4) {
						unset($fy[0]);
					}
					/* Concatenate the array with ',' */
					return $fy;
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
