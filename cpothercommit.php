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
<div align="center"><nobr><h4><a  href="acctcpsum.php" >AccountSum</a>  |  <a  href="cpreceipts.php">ReceiptDetails</a>  |  <a  href="cvouhead.php">ExpenditureHead</a>  |  <a href="cvouyear.php">ExpenditureYear</a>  |  <a href="cstafcommit.php">StaffCommit</a>  |  <a  href="cpothercommit.php"><span style="background-color:#F6EECC">OthersCommit</span></a></h4></nobr></div> 
<table  cellpadding="2" border="2" width="100%">
<tr>
<th  colspan="5"><div align="center">Others Commitment Details</div></th>
</tr>
  <tr>
    <th><div align="center">Purchase Order number</div></th>
    <th><div align="center">Date</div></th>
    <th><div align="center">Nature of Expenditure</div></th>
    <th><div align="center">Commitment Head</div></th>
    <th><div align="center">Amount</div></th>
  </tr>
<?php
odbc_close_all();

$nprno=$_SESSION['cprno'] or die("no session value");

$sqlquery="SELECT cprno,convert(varchar,date,105)'date',c_head,c_comno,c_item,c_pono,c_amount from ccommit  WHERE cprno = '$nprno' and c_amount >0 order by c_head";
//echo "$sqlquery";
$process1=odbc_exec($sqlconnect, $sqlquery);
$count=0;
//if(odbc_fetch_row($process1)==false)
//{
//	$records="Y";
//}
while(odbc_fetch_row($process1))
{   
//echo odbc_result($process1,"c_comno");
$two = odbc_result($process1,"c_pono");
$two3 = odbc_result($process1,"date");
$two1= odbc_result($process1,"c_item");
$two2 = odbc_result($process1,"c_head");
$two11 = odbc_result($process1,"c_amount");
$count=fmod($count,2);
if($count==0)
{
?>
<tr class="rowA">
    <td><div align="center"><?php echo "$two"; ?></div></td>
    <td><div align="center"><?php echo "$two3"; ?></div></td>
    <td><div align="center"><?php echo "$two1"; ?></div></td>
    <td><div align="center"><?php echo "$two2"; ?></div></td>
    <td><div align="right"><?php echo round("$two11"); ?></div></td>
</tr>
<?php
 }
else
{
?>
<tr class="rowB">
    <td><div align="center"><?php echo "$two"; ?></div></td>
    <td><div align="center"><?php echo "$two3"; ?></div></td>
    <td><div align="center"><?php echo "$two1"; ?></div></td>
    <td><div align="center"><?php echo "$two2"; ?></div></td>
    <td><div align="right"><?php echo round("$two11"); ?></div></td>
</tr>
<?php
}
$count=$count+1;
}
//echo "records:$records";
if(strcmp($records,"Y")==0)
{
?>
<tr class="rowA">
<th  colspan="5"><div align="center">No Other Commitment in This Project</div></th>
</tr>
<?php
}
?>
</table>

</div>
<div align="center"></div>
</div>
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
</html>

