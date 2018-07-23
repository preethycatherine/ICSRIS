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
			  <div w3-include-html="menu.html"></div>
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
	<div align="center"><nobr><h4><a  href="acctcpsum.php" >AccountSum</a>  |  <a  href="cpreceipts.php">ReceiptDetails</a>  |  <a  href="cvouhead.php">ExpenditureHead</a>  |  <a href="cvouyear.php"><span style="background-color:#F6EECC">ExpenditureYear</span></a>  |  <a href="cstafcommit.php"><strong>StaffCommit</strong></a>  |  <a  href="cpothercommit.php">OthersCommit</a></h4></nobr></div> 
	
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
	?>
	<table  cellpadding="2" border="2" width="100%">
	<tr>
	<th  colspan="9"><div align="center">EXPENDITURE(YEAR WISE) DETAILS</div></th>
	</tr>
	  <tr>
		<th><div align="center">VOUCHER NO</div></th>
		<th><div align="center">DATE</div></th>
		<th><div align="center">PARTY</div></th>
		<th><div align="center">DESC</div></th>
		<th><div align="center">CHEQ NO</div></th>
		<th><div align="center">AMOUNT</div></th>
		<th><div align="center">HEAD</div></th>
	  </tr>
	<?php
	
	if($yr==00)
		{
			$str1=99;
		}
		else
		{
			$str1=$yr;
		}
		
		//echo "the vu     " .$str1."<br>";
		if(($str1 >= 50) && ($str1 <= 99))
			{
			$year='19'.$str1;
			}
		elseif(($str1>=00) && ($str1<=99))
				{
				$year='20'.$str1;
				echo 'the year '.$year;
				}
			else
				{
				$year='20'.$str1;
				}
		
			
			
			//echo 'the year is '. $year;
			
			if(date('d')>3)
				{
				$d='20'.date("y");
				}
			else
				{
				$d='20'.date("y");
				}
				//echo ("the date.................... is  ".$d);
				for($i=$year;$i<=$d;$i++)
			{
				$fy=substr($i,-2);
				$yrs=$fy.substr($i+1,-2);
				$temp = 'VOU'."$yrs";
	//echo "$temp";
	
	$x = substr($nprno,0,13);
	$sq = "SELECT vrno,convert(varchar,date,105) as date1,amount,part,disc,head,cqno FROM ".$temp." where substring(iccno,1,13) like '$x' order by [date] asc";
	$e = odbc_exec($sqlconnect,$sq);
	//echo "$sq";
	while(odbc_fetch_row($e))
	{
	$v = odbc_result($e,"vrno");
	$dat = odbc_result($e,"date1");
	$amnt = odbc_result($e,"amount");
	$pt = odbc_result($e,"part");
	$disc = odbc_result($e,"disc");
	$hd = odbc_result($e,"head");
	$cq = odbc_result($e,"cqno");
	$count=fmod($count,2);
	if($count==0)
	{
	?>
	<tr class="rowA">
		<td><div align="center"><?php echo "$v"; ?></div></td>
		<td><div align="center"><?php echo "$dat"; ?></div></td>
		<td><div align="center"><?php echo "$pt"; ?></div></td>
		<td><div align="center"><?php echo "$disc"; ?></div></td>
		<td><div align="center"><?php echo "$cq"; ?></div></td>
		<td><div align="right"><?php echo round("$amnt"); ?></div></td>
		<td><div align="right"><?php echo "$hd"; ?></div></td>
	</tr>
	<?php
	 }
	else
	{
	?>
	<tr class="rowB">
		<td><div align="center"><?php echo "$v"; ?></div></td>
		<td><div align="center"><?php echo "$dat"; ?></div></td>
		<td><div align="center"><?php echo "$pt"; ?></div></td>
		<td><div align="center"><?php echo "$disc"; ?></div></td>
		<td><div align="center"><?php echo "$cq"; ?></div></td>
		<td><div align="right"><?php echo round("$amnt"); ?></div></td>
		<td><div align="right"><?php echo "$hd"; ?></div></td>
	 </tr>
	<?php
	}
	$count=$count+1;
	}
	
	$q = "select sum(amount) as amt from ".$temp." where substring(iccno,1,13) like '$x'";
	$e = odbc_exec($sqlconnect,$q);
	while(odbc_fetch_row($e))
	{
	$amnt = odbc_result($e,"amt");
	if($amnt!=0)
	{
	?>
	<tr >
		<th colspan="5"><div align="center"><?php echo "TOTAL VOUCHER AMOUNT FOR THE FINANCIAL YEAR:$yrs"; ?></div></th>
		<th><div align="right"><?php echo "$amnt"; ?></div></th>
		<td></td>
	</tr>
	<?PHP
	}
	
	$temp1 = substr($yrs, 1, 2);
	$temp2 = substr($yrs, 3, 2);
	$temp1 = $temp1 + 1;
	$temp2 = $temp2 + 1;
	if($temp1<=9)
	{
	$tempstr = trim(0). "$temp1";
	}
	else if($temp1==100)
	{
	$tempstr = trim("00");
	}
	else
	{
	$tempstr = "$temp1";
	}
	//echo "$tempstr";
	if($temp2<=9)
	{
	$mnt = trim(0). "$temp2";
	}
	elseif($temp2==100)
	{
	$mnt = trim("00");
	}
	else
	{
	$mnt = "$temp2";
	//echo "$mnt";
	}
	$temp = "$tempstr"."$mnt";
	//echo "$temp";
	}
	}
	odbc_close($sqlconnect);
	?>
	</table>
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
