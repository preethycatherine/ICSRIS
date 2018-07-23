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
				
				<div align="center"><h3> Consultancy Submitted Projects </h3></div>
<div align="center">
<table border="1">
<tr>
<th>S#</th>
<!--<th width="15">Select</th> -->
<th><div align="center" >Project Number </div></th>
<th><div align="center" >Start Date</div></th> 
<th><div align="center" >Close Date </div></th>
<th><div align="center" >Project Value </div></th>
</tr>

<?php
session_start();
if (!isset($_COOKIE["PHPSESSID"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: http://icsris.iitm.ac.in/ICSRIS/');
exit;
}
else
{
	if($_SESSION['instid'])
	{
	$insid=$_SESSION['instid'];
	$usermode=$_SESSION['usermode'];
	} 
	else
	{
		//echo "<br>session destroy ";
		session_destroy();
		setcookie("PHPSESSID","",time()-3600,"/");
		header('location: http://icsris.iitm.ac.in/ICSRIS/');
		exit;
	
	}
	include("currency_words.php");
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
	if(strcmp($usermode,"SUPER")==0)
	{
	//header('location: https://icsris.iitm.ac.in/AIS/varrpt.php');
	}
	else
	{
	$cocode=='';
	$sqlqueryc="select distinct coor_code from cmstlst where instid like '$insid'";
	$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
	$processc=odbc_exec($sqlconnect,$sqlqueryc) or die("ODBC Query Execution Failed"); 
		if(odbc_fetch_row($processc))
		{
		$cocode=odbc_result($processc,"coor_code");
		}
		odbc_close_all();
		
		 $sqlquery="select * from FoxOffice..pcmaster where SUBSTRING(APRLNO,0,12) not in (select SUBSTRING(CPRNO,0,12) from CMSTLST) and instid=$insid and (enddate>=getdate() OR (enddate IS NULL AND SUBSTRING(APRLNO,1,2) LIKE 'TT')) and (substring(APRLNO,3,4) in ('0203','0304','0405','0506','0607','0708','0809','0910','1011','1112','1213','1314','1415','1516','1617','1718'))";
	
	}
	unset($_SESSION['cprno']); 
	$usermode=$_SESSION['usermode'];
	$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
	$process=odbc_exec($sqlconnect,$sqlquery) or die("ODBC Query Execution Failed"); 
	//echo "$insid | $usermode | $sqlquery<br>";
	$i="1";
	$ii="2";
	$flag=0;
	
	while(odbc_fetch_row($process))
	{
		$pono = odbc_result($process,"APRLNO");
		$star_date=odbc_result($process,"stdate");
		$start_date=date('d-m-Y',strtotime($star_date));
		
		$clos_date=odbc_result($process,"enddate");
		if($clos_date!='')
		{ 
		$close_date=date('d-m-Y',strtotime($clos_date));
		}
		else
		{
		$close_date='';
		}		
		$pramount=odbc_result($process,"sanvalue");
		$iii=$i%$ii;
		if ($iii == 0) $cls="class=rowA";
		else $cls="class=rowB";
		echo "<tr $cls>";
		echo "<td>$i</td>";
		echo "<td>$pono</td>";
		echo "<td align='center'>$start_date</td>";
		echo "<td align='center'>$close_date</td>";
		echo "<td align = right >".IND_money_format_no_dec($pramount)."</td>";	
		echo "</tr>";
		$i++;
			$flag=1;
	}
	if($flag==0) echo "<tr align=center><td colspan=7><font color=orange><b>No Records.</b></font></td></tr>";
//odbc_close_all();
}

?>
</table>
</div>
 </div>
</div>
<?php
if (strcmp($usermode,"SUPER")==0)
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<h3>Sponsored Project</h3>
<?php
if(isset($_SESSION["sponresult"]))
{
?>
<p><ul><li><a href="acctspquery.php">Sponsor Query</a></li>
<li><a href="acctspresult.php">Sponsor Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctspquery.php">Sponsor Query</a></li></ul></p>
<?php
}
?>
<h3>Consultancy Project</h3>
<?php
if(isset($_SESSION["consresult"]))
{
?>
<p><ul><li><a href="acctcpquery.php">Consultancy Query</a></li>
<li><a href="acctcpresult.php">Consultancy Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctcpquery.php">Consultancy Query</a></li></ul></p>
<?php
}
?>
<h3>PCF</h3>
<?php
if(isset($_SESSION["pcfresult"]))
{
?>
<p><ul><li><a href="acctpcfquery.php">PCF Query</a></li>
<li><a href="acctpcfresult.php">PCF Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctpcfquery.php">PCF Query</a></li></ul></p>
<?php
}
?>
<h3>RMF</h3>
<?php
if(isset($_SESSION["rmfresult"]))
{
?>
<p><ul><li><a href="acctrmfquery.php">RMF Query</a></li>
<li><a href="acctrmfresult.php">RMF Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctrmfquery.php">RMF Query</a></li></ul></p>
<?php
}
?>
<h3>Cheque Details</h3>
<p><ul><li><a href="chequedetails.php">Pending Cheques Details</a></li></ul></p></div>
<div class="clear"></div>
</div>
<?php
}
else
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<h3>Sponsored Project</h3>
<p><ul><li><a href="acctsponon.php">Ongoing Projects</a></li><li><a href="acctsponcl.php">Closed Projects</a></li></ul></p>
<h3>Consultancy Project</h3>
<p><ul><li><a href="acctconson.php">Ongoing Projects</a></li><li><a href="acctconscl.php">Closed Projects</a></li></ul></p>
<h3>PCF</h3>
<p><ul><li><a href="acctpcfsum.php">PCF Account</a></li></ul></p>
<h3>RMF</h3>
<p><ul><li><a href="acctrmfsum.php">RMF Account</a></li></ul></p>
<h3>Cheque Details</h3>
<p><ul><li><a href="chequedetails.php">Pending Cheques Details</a></li></ul></p></div>
<div class="clear"></div>
<!--</div>-->
<?php
}
//}
?>
<div id="footer">
<p></p>
</div>
</div>
</body>
</html>
