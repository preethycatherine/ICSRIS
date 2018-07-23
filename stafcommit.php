<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ICSR ACCOUNTS Sponsor Expenditure Year wise  Detais</title>
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
				
<?php
if(!isset($_COOKIE["PHPSESSID"]))
{
	//echo "<br>session destroy ";
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: index.php');
	exit;

}
else
{
session_start();
//$npr = "BIO0708059DBTXDKAR";
$npr=$_SESSION['nprno'];
$usermode=$_SESSION['usermode'];
//echo "$npr";
$nprno = $npr;
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
//$yearval=substr($npr,3,2);
$yr = substr($npr,3,2);
//echo "$yr";
$strsql="";
$strsql="Select nprno,title,coor_name,CONVERT(varchar,start_date,105) 'start_date',CONVERT(varchar,close_date,105) 'close_date' from mstlst where nprno like '$npr'";
//$sqlconnect6=odbc_connect($dsn,$username,$password);
//$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
$process=odbc_exec($con,$strsql) or die("odbc connection failed");
//echo "$strsql<br>";

if (odbc_fetch_row($process))
{
$nprno=odbc_result($process,"nprno");
$title=odbc_result($process,"title");
$coor_name=odbc_result($process,"coor_name");
$start_date=odbc_result($process,"start_date");
$close_date=odbc_result($process,"close_date");
$today_date=date("d/m/Y");
}


?> 
<div align="center">
<table width="100%" border="1"  >
<tr>
<th colspan=5 ><div align=center> Project Account Summary as on <?php echo "$today_date"; ?> </span></div></th>
</tr>
<tr>
<th><div align="right">Project Number :</span></div></th>
<th align="left"><?php echo "$nprno"; ?></th>
<th><div align="right">Duration :</span></div></th>
<th colspan=2 align="left"><?php echo "$start_date"." To "."$close_date"; ?></th>
</tr>
<tr>
<th colspan=5><div align=center>Coordinator Name :</span><?php echo " $coor_name"; ?></div></th>
</tr>
<tr>
<th colspan=5><div align=center>Title : </span><?php echo "$title";  ?></div></th>
</tr>
</table>
</div>
<div align="center">
<nobr><h4><a href="acctspsum.php" >AccountSum</a>  |  <a href="spreceipts.php">ReceiptDetails</a>  |  <a href="vouhead.php">ExpenditureHead</a>  |  <a href="vouyear.php">ExpenditureYear</a>|	<a  href="stafcommit.php"><strong><span style="background-color:#F6EECC">StaffCommit</span></strong></a>  |  <a href="spothercommit.php"><u>OthersCommit</u></a> </h4></nobr></div>
<div align="center">
<?php
$npr=$_SESSION['nprno'];
$conn = odbc_connect("FACCTDSN","sa","IcsR@123#");
$qr1 = "select count(opt_date) from appmmast where nprno= '$npr' AND stafcom > 0 AND OPT_DATE IS NOT NULL";
$r1 = odbc_exec($conn,$qr1);
if($qr1 >= 1)
{
$c=1;
}
else
{
$c=0;
}
odbc_close($conn);
$cn = odbc_connect("FACCTDSN","sa","IcsR@123#");
$qr2 = "select nprno,ename,desig,convert(varchar(15),dtapp,103) as 'date1',convert(varchar(15),dtrlf,103) as 'date2',stafcom,convert(varchar(15),opt_date,103) as 'date3' from appmmast where nprno = '$npr' and stafcom >0 order by stafcom desc";
$r2 = odbc_exec($cn,$qr2);
if(odbc_fetch_row($r2)==true)
{
$x="Y";
}
odbc_close_all(); 
$cn1 = odbc_connect("FACCTDSN","sa","IcsR@123#");
?>
<table  cellpadding="2" border="2" width="100%">
<tr>
<th  colspan="9"><div align="center">PROJECT STAFF COMMITMENT DETAILS</div></th>
</tr>
  <tr>
    <th><div align="center">Employee Name</div></th>
    <th><div align="center">Designation</div></th>
    <th><div align="center">Date of Appointment</div></th>
    <th><div align="center">Date of Relief</div></th>
    <th><div align="center">Staff Commitment</div></th>
    
  </tr>
<?php
if($x=="Y")
{
//$qr3 = "select nprno,ename,desig,convert(varchar(15),dtapp,103) as 'date1',convert(varchar(15),dtrlf,103) as 'date2',stafcom,convert(varchar(15),opt_date,103) as 'date3' from appmmast where nprno = '$npr' and stafcom >0" ;
$qr3="select nprno,ename,desig,convert(varchar(15),dtapp,103) as 'date1',convert(varchar(15),dtrlf,103) as 'date2',stafcom from appmmast where nprno = '$npr' and stafcom >0 union all select nprno,ename,desig,convert(varchar(15),dtapp,103) as 'date1',convert(varchar(15),dtrlf,103) as 'date2',stafcom from appmmast_tm where nprno = '$npr' and stafcom >0";
}
else
{
?>
<tr class="rowA">
<th  colspan="6"><div align="center"> No Staff Details For This Project</div></th>
</tr>
</table> 
<?php
}
$r3 = odbc_exec($cn,$qr3);
$count=1;
$totstaf=0;
while(odbc_fetch_row($r3))
{
$e = odbc_result($r3,"ename");
$de = odbc_result($r3,"desig");
$d1 = odbc_result($r3,"date1");
$d2 = odbc_result($r3,"date2");
$stf = odbc_result($r3,"stafcom");
//$d3 = odbc_result($r3,"date3");
$count=fmod($count,2);
$totstaf=$totstaf+$stf;

if($count==0)
{
?>
<tr class="rowA">
    <td><div align="center"><?php echo "$e"; ?></div></td>
    <td><div align="center"><?php echo "$de"; ?></div></td>
    <td><div align="center"><?php echo "$d1"; ?></div></td>
    <td><div align="center"><?php echo "$d2"; ?></div></td>
    <td><div align="right"><?php echo round("$stf"); ?></div></td>
    
</tr>
<?php
 }
else
{
?>
<tr class="rowA">
    <td><div align="center"><?php echo "$e"; ?></div></td>
    <td><div align="center"><?php echo "$de"; ?></div></td>
    <td><div align="center"><?php echo "$d1"; ?></div></td>
    <td><div align="center"><?php echo "$d2"; ?></div></td>
    <td><div align="right"><?php echo round("$stf"); ?></div></td>
    
</tr>
<?php
}
$count=$count+1;
}
if(c==1)
{
 echo("<center><b><font color=blue>Note:** indicates that commitment is restricted upto the option date only<font></b></center>");
}
else
{
 echo("");
}
}
odbc_close_all();
?>
<tr class="rowB">
    <td colspan="4"><div align="right"><b>Total</b></div></td>
    <td><div align="right"><?php echo "$totstaf"; ?></div></td>
    
</tr>



</table>
</div>

<div align="center"></div>
</div>
</div>
<?php

?>
<div id="footer">
<p></p>
</div>
</div>
</div>
</body>
</html>
