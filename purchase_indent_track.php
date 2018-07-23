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
	<!--<div id="menu">-->
	<!--<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h2>
	</div>-->
	<!--=========== BEGIN MENU SECTION ================-->
		 <script src="https://www.w3schools.com/lib/w3.js"></script>
		 <?php   session_start();
			  if($_SESSION["usermode"]=="SUPER"){ ?>
			  <div w3-include-html="menu_super.html"></div>
			  <?php } 	
				else{ ?>
			<!--<div w3-include-html="menu.html"></div>-->
	<div w3-include-html="menu.php"></div>
			  <?php  } ?>
			<script>
			w3.includeHTML();
			</script>
		<!--=========== END MENU SECTION ================--> 
	
		<div id="content">
			<div id="primaryContentContainer">
			  <div id="primaryContent">
					
	
	<div align="center">
	<?php
	if(!isset($_COOKIE["PHPSESSID"]))
	{
		session_destroy();
		setcookie("PHPSESSID","",time()-3600,"/");
		header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
		exit;
	
	}
	else
	{
	session_start();
	$insid=$_SESSION['instid'];
	$usermode=$_SESSION['usermode'];
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$instid1="";
	$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
	
	//echo "<br> Flow in here";
	
	if(!isset($_SESSION['cprno']))
	{
	$cprno=$_REQUEST['cprno'];
	//echo "<br> Direct Value";
	//echo "<br> CPRNO:$cprno";
	}
	else
	{
	$cprno=$_SESSION['cprno'];
	//echo "<br>Session value";
	unset($_SESSION['cprno']); 
	}
	}
	$_SESSION['cprno']=$cprno;
	if(isset($_COOKIE["PHPSESSID"]))
	{
	session_register("logname");
	$_SESSION["cprno"]=$cprno;
	//echo "<br>CPRNO:$cprno";
	
	//$cprno=substr($cprno,0,12)."%";
	
	if((strcmp('TT1213PHY076',substr($cprno,0,12))==0))
	{
	$cprno=$cprno;
	}
	else
	{
	$cprno=substr($cprno,0,12)."%";
	}
	$strsql="Select cprno,agency,coor_name1,s_date,c_date,c_cost,C_TITLE from cmstlst where cprno like '$cprno'";
	$process=odbc_exec($sqlconnect,$strsql) or die("Query Execution Failed");
	if (odbc_fetch_row($process))
	{
	$cprno=odbc_result($process,"cprno");
	$title=odbc_result($process,"C_TITLE");
	$sponsor=odbc_result($process,"agency");
	$coor_name=odbc_result($process,"coor_name1");
	$star_date=odbc_result($process,"s_date");
	$start_date=date('d-m-Y',strtotime($star_date));
	$clos_date=odbc_result($process,"c_date");
	$close_date=date('d-m-Y',strtotime($clos_date));
	$cost=odbc_result($process,"c_cost");
	$today_date=date("d/m/Y");
	}
	//echo "$today_date";
	?>
	<div align="center">
	<table  width="100%" border="1">
	<tr>
	<th colspan=5 ><div align=center> Consultancy Project Accounts Statement as on <?php echo " $today_date"; ?></span></div></th>
	</tr>
	<tr>
	<th colspan="2" align="left">Project Number : </span><?php echo "$cprno"; ?></th>
	<th>Duration :</span><?php echo " $start_date"." To "."$close_date"; ?></th>
	</tr>
	<tr>
	<th colspan="2" align="left">Sponsor : </span><?php echo "$sponsor"; ?></th>
	<th>Value :</span><?php echo " $cost"; ?></th>
	</tr>
	<tr>
	<th colspan="5" ><div align=center>Coordinator Name : </span><?php echo "$coor_name"; ?></div></th>
	</tr>
	<tr>
	<th colspan=5><div align=center>Title : </span><?php echo "$title";  ?></div></th>
	</tr>
	</table>
	</div>
	<div align="center"><nobr><h4><a  href="acctcpsum.php" >AccountSum</a>  |  <a  href="cpreceipts.php">ReceiptDetails</a>  |  <a  href="cvouhead.php">ExpenditureHead</a>  |  <a href="cvouyear.php">ExpenditureYear</a>  |  <a href="cstafcommit.php"><strong>StaffCommit</strong></a>  |  <a  href="cpothercommit.php">OthersCommit</a>  |  <a  href="purchase_indent_track.php"><span style="background-color:#F6EECC">Purchase Indent Tracking</span></a></h4></nobr></div> 
	
	<?php
	odbc_close_all();
	
	$nprno=$_SESSION['cprno'] or die("no session value");
	
	//$npr=substr($nprno,0,12);
	if((strcmp('TT1213PHY076',substr($nprno,0,12))==0))
	{
	$npr=$nprno;
	}
	else
	{
	$npr=substr($nprno,0,12);
	}
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$sqlconnect=odbc_connect($dsn,$username,$password);
	
	if (date(m)>3)
	{
	$curfinyr = date("Y") . "-" . (date("Y")+1) ;
	}
	else 
	{
	$curfinyr = (date("Y")-1) . "-" . (date("Y"));
	}
	
	$curfinyr = substr($curfinyr,3,2)."". substr($curfinyr,8,2) ;
	
	$tempStr = "";
	$yrfile = substr($nprno, 3, 4);
	
		require_once 'excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CPa25a');
		$flag=0;$avail=0;
		$data->read("admin/uploads/purchase_indent_track.xls");			
		
		for ($j = 1; $j <= $data->sheets[0]['numRows']-1; $j++)
		{
		 if(trim($data->sheets[0]['cells'][$j+1][2])!="")
		 {
	?>
	<table  cellpadding="2" border="2" width="100%">
	<tr><th  colspan="9"><div align="center">PURCHASE INDENT TRACKING</div></th></tr>
	<tr><th  colspan="9"><div align="LEFT">INDENT DETAILS</div></th></tr>
	<tr>
	<th><div align="left"><span style="color:#663300">Indent Number</span></div></th>
	<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][5]); ?></div></th>
	<th><div align="left"><span style="color:#663300">Indent Received</span></div></th>
	<th colspan="3"><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][5]); ?></div></th>
	</tr>
	</table>
	<table  cellpadding="2" border="2" width="100%">
	<tr>
	<td width="33%">
	<table cellpadding="2">
		<tr><th><div align="left">COMMITMENT DETAILS</div></th></tr>
		<tr><th><hr /></th></tr>
		<tr>
			<th><div align="left"><span style="color:#663300">COMMITMENT/OUT </span></div></th>
			<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][6]); ?></div></th>
		</tr><tr>
			<th><div align="left"><span style="color:#663300">COMMITMENT/IN</span></div></th>
			<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][7]); ?></div></th>
		</tr><tr>
			<th><div align="left"><span style="color:#663300">DAYS</span></div></th>
			<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][8]); ?></div></th>
		</tr>
	</table>
	</td>
	<td width="33%">
	<table cellpadding="2">
		<tr><th><div align="left">AUDIT DETAILS</div></th></tr>
		<tr><th><hr /></th></tr>
		<tr>
			<th><div align="left"><span style="color:#663300">AUDIT/OUT </span></div></th>
			<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][9]); ?></div></th>
		</tr><tr>
			<th><div align="left"><span style="color:#663300">AUDIT/IN</span></div></th>
			<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][10]); ?></div></th>
		</tr><tr>
			<th><div align="left"><span style="color:#663300">DAYS</span></div></th>
			<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][11]); ?></div></th>
		</tr>
	</table>
	</td>
	<td width="33%" valign="top">
	<table cellpadding="2">
		<tr valign="top"><th><div align="left">APPROVAL DETAILS</div></th></tr>
		<tr><th><hr /></th></tr>
		<tr valign="top">
			<th><div align="left"><span style="color:#663300">DIR/DEAN APPROVAL/OUT </span></div></th>
			<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][12]); ?></div></th>
		</tr><tr>
			<th><div align="left"><span style="color:#663300">DIR/DEAN APPROVAL/IN</span></div></th>
			<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][13]); ?></div></th>
		</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td width="33%">
	<table cellpadding="2">
		<tr><th><div align="left">CPC DETAILS</div></th></tr>
		<tr><th><hr /></th></tr>
		<th><div align="left"><span style="color:#663300">CPC CHAIRMAN SEND DATE</span></div></th>
		<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][14]); ?></div></th>
		</tr><tr>
		<th><div align="left"><span style="color:#663300">CPC CHAIRMAN RETURN DATE</span></div></th>
		<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][15]); ?></div></th>
		</tr><tr>
		<th><div align="left"><span style="color:#663300">Days</span></div></th>
		<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][16]); ?></div></th>
		</tr>
	</table>
	</td>
	<td width="33%" valign="top">
	<table cellpadding="2">
		<tr><th><div align="left">PO DETAILS</div></th></tr>
		<tr><th><hr /></th></tr>
		<th><div align="left"><span style="color:#663300">PO ISSUED</span></div></th>
		<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][17]); ?></div></th>
		</tr><tr>
		<th><div align="left"><span style="color:#663300">Total Days</span></div></th>
		<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][18]); ?></div></th>
		</tr>
	</table>
	</td>
	<td width="33%" valign="top">
	<table cellpadding="2">
		<tr><th><div align="left">ACCOUNTS BALMER DETAILS</div></th></tr>
		<tr><th><hr /></th></tr>
		<th><div align="left"><span style="color:#663300">Account/Balmer/out</span></div></th>
		<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][19]); ?></div></th>
		</tr><tr>
		<th><div align="left"><span style="color:#663300">Accounts/Balmer/in</span></div></th>
		<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][20]); ?></div></th>
		</tr><tr>
		<th><div align="left"><span style="color:#663300">Days</span></div></th>
		<th><div align="left"><?php echo trim($data->sheets[0]['cells'][$j+1][21]); ?></div></th>
		</tr>
	</table>
	</td>
	</tr>
	</table>
  <?php } }?>
	</div>
	</div>
	<div align="center"></div>
	</div>
	<?php
	}
	?>
	<div id="footer">
	<p></p>
	</div>
	</div>
	</div>
	</body>
	<script type="text/javascript">
	var newwindow;
	function poptastic(url)
	{
		newwindow=window.open(url,'name','height=300,width=800,scrollbars=yes');
		if (window.focus) {newwindow.focus()}
	}
	</script>
	</html>
