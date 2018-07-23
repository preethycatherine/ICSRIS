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
<body  >
<div id="content">
<div id="primaryContentContainer">
<div id="primaryContent">
<?php
session_start();
$q=$_REQUEST['q'];
//echo "$q";
$head=substr($q,0,4);
$nprno=substr($q,7,18);
$year=substr($q,28,7);
$prjtype=substr($q,14,4);
$iitprj=substr($q,7,3);
//echo "<br>prjtype=$prjtype";
if (strcmp($prjtype,'DEVP')==0 )
{
$nprno=substr($q,7,15);
$year=substr($q,25,7);
}

if (strcmp($iitprj,'IIT')==0)
{
$nprno=substr($q,7,14);
$year=substr($q,24,7);
}

//$year=$_REQUEST['year'];
//echo "<br>nprno=$nprno<br>head=$head<br>year=$year";
//echo "<br>Success POP UP Page";
//VRNO,DATE,NPRNO,PART,DISC,AMOUNT

$count=1;
$x = substr($nprno,0,13);
odbc_close_all();
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
if (strcmp($head,'TRAV')==0)
{
$sq="SELECT VRNO,CONVERT(varchar,date,105) 'DATE',NPRNO,PART,DISC,AMOUNT,HEAD,PONO FROM ".$year." where substring(nprno,1,13) like '$x' and (head in ('trav','intr','frtr')) order by convert(datetime,date,103) desc";
}
else
{
$sq="SELECT VRNO,CONVERT(varchar,date,105) 'DATE',NPRNO,PART,DISC,AMOUNT,HEAD,PONO FROM ".$year." where substring(nprno,1,13) like '$x' and head like '$head' order by convert(datetime,date,103) desc";
}
//$sq = "SELECT vrno,convert(varchar,date,103) as date,amount,part,head,cqno FROM ".$temp." where substring(nprno,1,13) like '$x' order by [date] asc";
//echo "$sq<br>";
$yearvalue=substr($year,3,4);

if(strcmp($yearvalue,"1011")==0)
{
?>

<h4><div align="center">Project Number:<?php echo " $nprno"; ?> &nbsp;&nbsp;&nbsp;&nbsp;Financial Year :<?php echo substr($year,3,4); ?> </div></h4>
<div  align="center">
<table  cellpadding="1" border="1" width="60%">
<tr>
<th  colspan="7"><div align="center">EXPENDITURE DETAILS</div></th>
</tr>
  <tr>
    <th><div align="center">VOUCHER NO</div></th>
    <th><div align="center">DATE</div></th>
    <th><div align="center">PARTY</div></th>
    <th><div align="center">DESC</div></th>
    <th><div align="center">AMOUNT</div></th>
    <th><div align="center">HEAD</div></th>
    <th><div align="center">PONO</div></th>
  </tr>
<?php
$e = odbc_exec($con,$sq) or die("Query Execution Failed");
while(odbc_fetch_row($e))
{
$v = odbc_result($e,"VRNO");
$dat = odbc_result($e,"DATE");
$po = odbc_result($e,"NPRNO");
$pt = odbc_result($e,"PART");
$de = odbc_result($e,"DISC");
$amnt = odbc_result($e,"AMOUNT");
$hd = odbc_result($e,"HEAD");
$pono = odbc_result($e,"PONO");
$count=fmod($count,2);
//echo "<br>$count";
//<a href="javascript:if (winwin) winwin.close();">
//href="javascript:if (newwindow) { newwindow.close(); }

if($count==0)
{
?>
<tr  class="rowB">
    <td><div align="center"><?php echo "$v"; ?></div></td>
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="center"><?php echo "$pt"; ?></div></td>
    <td><div align="center"><?php echo "$de"; ?></div></td>
    <td><div align="right"><?php echo round("$amnt"); ?></div></td>
    <td><div align="right"><?php echo "$hd"; ?></div></td>
   	<td><div align="center"><?php echo "$pono"; ?></div></td>   
</tr>
<?php
 }
else
{
//<td><div align="right"><a onclick="Lvl_P2P('http://icsris.iitm.ac.in/icsris/acctfpono.php?pono=<?php echo "$pono"; ',true,0500)" href="javascript:;"> <?php echo //"$pono"; </a></div></td> 
?>
<tr class="rowB">
    <td><div align="center"><?php echo "$v"; ?></div></td>
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="center"><?php echo "$pt"; ?></div></td>
    <td><div align="center"><?php echo "$de"; ?></div></td>
    <td><div align="right"><?php echo round("$amnt"); ?></div></td>
    <td><div align="right"><?php echo "$hd"; ?></div></td>
	<td><div align="center"><?php echo "$pono"; ?></div></td>   
 </tr>
<?php
}
$count=$count+1;
}
odbc_close_all();
}
else
{
?>
<h4><div align="center">Project Number:<?php echo " $nprno"; ?> &nbsp;&nbsp;&nbsp;&nbsp;Financial Year :<?php echo substr($year,3,4); ?> </div></h4>
<div  align="center">
<table  cellpadding="1" border="1" width="100%">
<tr>
<th  colspan="7"><div align="center">EXPENDITURE DETAILS</div></th>
</tr>
  <tr>
    <th><div align="center">VOUCHER NO</div></th>
    <th><div align="center">DATE</div></th>
    <th><div align="center">PARTY</div></th>
    <th><div align="center">DESC</div></th>
    <th><div align="center">AMOUNT</div></th>
    <th><div align="center">HEAD</div></th>
	<th><div align="center">PONO</div></th>
  </tr>
<?PHP
$e = odbc_exec($con,$sq) or die("Query Execution Failed");
while(odbc_fetch_row($e))
{
$v = odbc_result($e,"VRNO");
$dat = odbc_result($e,"DATE");
$po = odbc_result($e,"NPRNO");
$pt = odbc_result($e,"PART");
$de = odbc_result($e,"DISC");
$amnt = odbc_result($e,"AMOUNT");
$hd = odbc_result($e,"HEAD");
$pono = odbc_result($e,"PONO");
$count=fmod($count,2);
//echo "<br>$count";
if($count==0)
{
?>
<tr  class="rowB">
    <td><div align="center"><?php echo "$v"; ?></div></td>
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="center"><?php echo "$pt"; ?></div></td>
    <td><div align="center"><?php echo "$de"; ?></div></td>
    <td><div align="right"><?php echo round("$amnt"); ?></div></td>
    <td><div align="right"><?php echo "$hd"; ?></div></td>
	<td><div align="center"><?php echo "$pono"; ?></div></td> 
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
	<td><div align="center"><?php echo "$pono"; ?></div></td> 
 </tr>
<?php
}
$count=$count+1;
}
}
odbc_close_all();
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
if(strcmp($head,'TRAV')==0) 
{
$q = "SELECT SUM(AMOUNT) as amt FROM ".$year." where substring(nprno,1,13) like '$x' and (head in ('trav','intr','frtr')) ";
}
else
{
$q = "SELECT SUM(AMOUNT) as amt FROM ".$year." where substring(nprno,1,13) like '$x' and head like '$head' ";
}
//echo "$q";
$e = odbc_exec($con,$q) or die("Query Execution failed");
while(odbc_fetch_row($e))
{
$amnt = odbc_result($e,"amt");
if($amnt!=0)
{
?>
<tr >
    <th colspan="4"><div align="center"><?php echo "TOTAL VOUCHER AMOUNT FOR THE FINANCIAL YEAR:$year"; ?></div></th>
    <th><div align="right"><?php echo "$amnt"; ?></div></th>
	<th></th>
	<th></th>
<?php
if(strcmp($yearvalue,"1011")==0)
{
echo "<th></th>";
}
?>
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
<script language="JavaScript">
<!--
function Lvl_P2P(url,closeIt,delay){ //ver1.0 4LevelWebs
    opener.location.href = url;
	if (closeIt == true)setTimeout('self.close()',delay);
}
//-->
</script>
<script>
function redirect(linkid)
{

location.href=linkid;
newwindow.close();

}
</script>
</html>
