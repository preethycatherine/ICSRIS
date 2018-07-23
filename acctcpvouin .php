<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ICSR ACCOUNTS Expenditure Details</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="content">
<div id="primaryContentContainer">
<div id="primaryContent">
<?php
session_start();
$q=$_REQUEST['q'];
//echo "$q";
$head1="";
$head=substr($q,0,4);
$cprno=substr($q,8,12);
$year=substr($q,23,7);
//$head1=substr($q,38,4);
//$year=$_REQUEST['year'];
//echo "<br>nprno=$cprno<br>head=$head<br>year=$year<br>head1=$head1";
//echo "<br>Success POP UP Page";
//VRNO,DATE,NPRNO,PART,DISC,AMOUNT
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$sq="SELECT VRNO,ICCNO FROM ".$year." where substring(iccno,1,12) like '$cprno' and head like '$head' order by [date] asc";
//echo "$sq<br>";
$e = odbc_exec($con,$sq) or die("Query Execution Failed");
if(odbc_fetch_row($e))
{
$v = odbc_result($e,"VRNO");
$po = odbc_result($e,"ICCNO");
}

?>
<h4><div align="center">Project Number:<?php echo " $po"; ?> &nbsp;&nbsp;&nbsp;&nbsp;Financial Year :<?php echo substr($year,3,4); ?> </div></h4>
<div  align="center">
<table  cellpadding="1" border="1" width="100%">
<tr>
<th  colspan="9"><div align="center">EXPENDITURE DETAILS</div></th>
</tr>
  <tr>
    <th><div align="center">VOUCHER NO</div></th>
    <th><div align="center">DATE</div></th>
    <th><div align="center">PARTY</div></th>
    <th><div align="center">DISC</div></th>
    <th><div align="center">AMOUNT</div></th>
    <th><div align="center">HEAD</div></th>
    <th><div align="center">PONO</div></th>
  </tr>

<?PHP
$count=1;
$x = substr($cprno,0,12);
odbc_close_all();
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$sq="SELECT VRNO,CONVERT(varchar,date,105) 'DATE',ICCNO,PART,DISC,AMOUNT,HEAD,PONO FROM ".$year." where substring(iccno,1,12) like '$x' and head like '$head' order by [date] asc";
//echo "$sq<br>";
$e = odbc_exec($con,$sq) or die("Query Execution Failed");
while(odbc_fetch_row($e))
{
$v = odbc_result($e,"VRNO");
$dat = odbc_result($e,"DATE");
$po = odbc_result($e,"ICCNO");
$pt = odbc_result($e,"PART");
$de = odbc_result($e,"DISC");
$amnt = odbc_result($e,"AMOUNT");
$hd = odbc_result($e,"HEAD");
$pono= odbc_result($e,"PONO");
$count=fmod($count,2);
//echo "<br>$count";
if($count==0)
{
?>
<tr  class="rowA">
    <td><div align="center"><?php echo "$v"; ?></div></td>
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="center"><?php echo "$pt"; ?></div></td>
    <td><div align="center"><?php echo "$de"; ?></div></td>
    <td><div align="right"><?php echo round("$amnt"); ?></div></td>
    <td><div align="right"><?php echo "$hd"; ?></div></td>
    <td><div align="right"><?php echo "$pono"; ?></div></td>
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
    <td><div align="center"><?php echo "$de"; ?></div></td>
    <td><div align="right"><?php echo round("$amnt"); ?></div></td>
    <td><div align="right"><?php echo "$hd"; ?></div></td>
    <td><div align="right"><?php echo "$pono"; ?></div></td>
 </tr>
<?php
}
$count=$count+1;
}
odbc_close_all();
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$q = "SELECT SUM(AMOUNT) as amt FROM ".$year." where substring(ICCNO,1,12) like '$x' and head like '$head' ";
//echo "$q";
$e = odbc_exec($con,$q) or die("Query Execution failed");
while(odbc_fetch_row($e))
{
$amnt = odbc_result($e,"amt");
if($amnt!=0)
{
?>
<tr >
    <th colspan="5"><div align="center"><?php echo "TOTAL VOUCHER AMOUNT FOR THE FINANCIAL YEAR:".substr($year,3,4); ?></div></th>
    <th><div align="right"><?php echo "$amnt"; ?></div></th>
    <td></td>
</tr>
<?php
}
}
//echo "amount=$amnt";
?>
</table>
</div>
</div>
</div>
</div>
</body>
</html>
