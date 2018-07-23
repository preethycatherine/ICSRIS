<?php
  session_start();
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
</head>
<body>
<div id="outer">
<!--<div id="menu">-->
<!--<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h2>
</div>-->
<!--=========== BEGIN MENU SECTION ================-->
	 <script src="https://www.w3schools.com/lib/w3.js"></script>
	<div w3-include-html="menu.php"></div>
		<script>
		w3.includeHTML();
		</script>
	<!--=========== END MENU SECTION ================--> 


	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
			<table style="background-color:#F6EECC" width="100%" >
			<th colspan=5 >
			<div align="center"><nobr><?php echo $_SESSION['monthName']; ?></nobr></div> 
			</th></tr>
			</table>
			<form name='icsrisacct.php' action='icsrisacct.php' method='POST'>
			<table style="background-color:#F6EECC" width="100%" >
			<tr>
			  <td width="286" height="36" align="right"><b> Please select month and year </b></font></td>
              <td width="27"><b>&nbsp; &nbsp;:&nbsp;&nbsp;</b></td>
              <td width="616">
			  		<select name='month' onchange="reload(this.form)">
						<?php if(isset($_GET['month']) or isset($_POST['month'])){ ?> <option value="<?php  if($_GET['month']) echo $_GET['month']; else echo $_POST['month']; ?>">
															<?php   if($_GET['month']=="01" or $_POST['month']=="01")echo "January</option>"; 
																	else if($_GET['month']=="02" or $_POST['month']=="02")echo "February</option>"; 
																	else if($_GET['month']=="03" or $_POST['month']=="03")echo "March</option>"; 
																	else if($_GET['month']=="04" or $_POST['month']=="04")echo "April</option>"; 
																	else if($_GET['month']=="05" or $_POST['month']=="05")echo "May</option>"; 
																	else if($_GET['month']=="06" or $_POST['month']=="06")echo "June</option>"; 
																	else if($_GET['month']=="07" or $_POST['month']=="07")echo "July</option>"; 
																	else if($_GET['month']=="08" or $_POST['month']=="08")echo "August</option>"; 
																	else if($_GET['month']=="09" or $_POST['month']=="09")echo "September</option>"; 
																	else if($_GET['month']=="10" or $_POST['month']=="10")echo "October</option>"; 
																	else if($_GET['month']=="11" or $_POST['month']=="11")echo "November</option>"; 
																	else if($_GET['month']=="12" or $_POST['month']=="12")echo "December</option>"; 																	
							 } else { ?><option>-Select-</option><?php } ?>
						<option value="01">January</option>
						<option value="02">February</option> 
						<option value="03">March</option> 
						<option value="04">April</option> 
						<option value="05">May</option> 
						<option value="06">June</option> 
						<option value="07">July</option> 
						<option value="08">August</option> 
						<option value="09">September</option> 
						<option value="10">October</option> 
						<option value="11">November</option> 
						<option value="12">December</option> 
						
					</select>
					<select name='year' onchange="reload(this.form)">
						<?php if(isset($_GET['year']) or isset($_POST['year'])){ ?> <option value="<?php echo $_POST['year']; ?>"><?php echo $_POST['year']; ?></option>
						<?php } else { ?><option>-Select-</option><?php } $year=date("Y");	?>
						<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
						<option value="<?php echo $year-1; ?>"><?php echo $year-1; ?></option>
					</select>
              </td>
			  </tr>	
			  <tr>
			  <tr> <td width="1031" colspan="3" align="center">
				  <input type="submit" name="submit" id="submit" value="Go" />
		  	</td></tr>	
			 </table>	
 				</div>
 <?php if (isset($_POST['submit']) && ($_POST['submit'] == "Go"))  { 
 		
		session_start();
		$username=$_SESSION["username"];
		$_SESSION['month']=$_POST['year']."-".$_POST['month'];
		$_SESSION['monthName'] = date('F', mktime(0, 0, 0, $_POST['month'], 10))." - ".$_POST['year'];
		$redir="Location: https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/invoices.php";
		header($redir);
	
 }
 ?>
 
 </form>
 
</div>


<div id="secondaryContent">
	<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
	<?php
		include("side_menu.php");
	//	session_start(); 
		$username=$_SESSION["username"];
		$_SESSION["username"]=$username;
	?>
	<div id="footer">
		<p><p>Developed by : ICSR, IITMadras</p></p>
	</div>
</div>
</body>
</html>
