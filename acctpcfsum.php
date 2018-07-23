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
				
				<div align="center"><h3> PCF Account Statement </h3></div>
<div align="center">
<?php

if(!isset($_COOKIE["PHPSESSID"]))
{
	//echo "<br>session destroy ";
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
	exit;

}
else
{
session_start();
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
	header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
	exit;

}
$dsn="PCFACCT";
$username="sa";
$password="IcsR@123#";
$instid1="";
$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");


if(!isset($_SESSION['pcfid']))
{
$pcfid=$_REQUEST['iirno'];
$instid1=$pcfid;
//echo "<br>Direct Value";
session_register("pcfid");
$_SESSION['pcfid']=$pcfid;
//echo "$pcfid";
} 
else
{
$instid1=$_SESSION['pcfid'];
$usermode=$_SESSION['usermode'];
//echo "<br>Session value:$instid1";
}


$strsq1="SELECT NAME,DEPT FROM CO_NME WHERE IIRNO LIKE '$instid1'";

//echo "<br>$strsq1";
$process=odbc_exec($sqlconnect,$strsq1) or die("<br>connection failed");

$name="";
$dept="";
if(odbc_fetch_row($process))
{
$name=odbc_result($process,"NAME");
$dept=odbc_result($process,"DEPT");
}
$today_date=date("d/m/Y");
?>
<table width="100%" border="1">
<tr   >
<th width="25%" ><div  align="right" style="color:#2A0000"> IIRNO :</div></th>
<td width="25%"><b><div align="left" ><?php echo "$instid1" ?></div></b></td>
<th width="20%" ><div  align="right" style="color:#2A0000">Date :</div></th>
<td><b><div align="left"><?php echo "$today_date" ?></div></b></td>
</tr>
<tr>
<th ><div  align="right" style="color:#2A0000">CoordinatorName :</div></th>
<td><b><div align="left"><?php echo "$name" ?></div></b></td>
<th ><div  align="right" style="color:#2A0000">Department :</div></th>
<td><b><div align="left"><?php echo "$dept" ?></div></b></td>
</tr>
</table>
<div>
<nobr><h4>	<a href="acctpcfsum.php" ><span style="background-color:#F6EECC">AccountSum</span></a> | <a href="pcfreceipts.php">ReceiptDetails</a>  |  <a href="pcfvoucher.php">ExpenditureDetails</a>  |  <a href="pcfstafcommit.php"><u>StafCommitmentDetails</u></a> |  <a href="pcfcommit.php"><u>OthersCommitmentDetails</u></a> </h4></nobr>
</div>
<?php
//die();
odbc_close_all();
$strsql="";
$strsql="select sum(pcf) as rt from corprt where iirno like '$instid1'";

$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at Receipt level");
if(odbc_fetch_row($process1))
{
$rt=odbc_result($process1,"rt");
}
else
{
$rt="0.0";
$rt=number_format($rt,2);
}
odbc_close_all();
//SELECT sum(amount) FROM CORPVR where [check] like 'u' and head like 'cons' and iirno like '0104'
$strsql="";
$strsql="SELECT sum(amount) as vstaf FROM CORPVR where [check] like 'u' and head like 'staf' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at cons voucher level");
if(odbc_fetch_row($process1))
{
$vstaf=odbc_result($process1,"vstaf");
}
if($vstaf==0) 
{
$vstaf=0.0;
}
odbc_close_all();

$strsql="";
$strsql="SELECT sum(amount) as vcons FROM CORPVR where [check] like 'u' and head like 'cons' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at cons voucher level");
if(odbc_fetch_row($process1))
{
$vcons=odbc_result($process1,"vcons");
}
if($vcons==0) 
{
$vcons=0.0;
}
odbc_close_all();

$strsql="";
$strsql="SELECT sum(amount) as vcont FROM CORPVR where [check] like 'u' and head like 'CONT' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at cont voucher level");
if(odbc_fetch_row($process1))
{
$vcont=odbc_result($process1,"vcont");
}
if($vcont==0) 
{
$vcont=0;

}
odbc_close_all();

$strsql="";
$strsql="SELECT sum(amount) as veqpt FROM CORPVR where [check] like 'u' and head like 'EQPT' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at eqpt voucher level");
if(odbc_fetch_row($process1))
{
$veqpt=odbc_result($process1,"veqpt");
}
if($veqpt==0) 
{
$veqpt=0;
}
odbc_close_all();

$strsql="";
$strsql="SELECT sum(amount) as vfrtr FROM CORPVR where [check] like 'u' and head like 'FRTR' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at frtr voucher level");
if(odbc_fetch_row($process1))
{
$vfrtr=odbc_result($process1,"vfrtr");
}
if($vfrtr==0) 
{
$vfrtr=0;
}
odbc_close_all();

$strsql="";
$strsql="SELECT sum(amount) as vintr FROM CORPVR where [check] like 'u' and head like 'INTR' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at intr voucher level");
if(odbc_fetch_row($process1))
{
$vintr=odbc_result($process1,"vintr");
}
if($vintr==0) 
{
$vintr=0;
}
odbc_close_all();

$strsql="";
$strsql="SELECT sum(amount) as vothr FROM CORPVR where [check] like 'u' and head like 'OTHR' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at othr voucher level");
if(odbc_fetch_row($process1))
{
$vothr=odbc_result($process1,"vothr");
}
if($vothr==0) 
{
$vothr=0;
}
odbc_close_all();

$vtotal=$vstaf+$vcons+$vcont+$veqpt+$vfrtr+$vintr+$vothr;


$strsql="";
$strsql="select sum(amount) as cstaf from corpcomt where head like 'STAF' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at cons commit level");
if(odbc_fetch_row($process1))
{
$cstaf=odbc_result($process1,"cstaf");
}
if($cstaf==0) 
{
$cstaf=0;
}
odbc_close_all();

$strsql="";
$strsql="select sum(amount) as ccons from corpcomt where head like 'CONS' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at cons commit level");
if(odbc_fetch_row($process1))
{
$ccons=odbc_result($process1,"ccons");
}
if($ccons==0) 
{
$ccons=0;
}
odbc_close_all();

$strsql="";
$strsql="select sum(amount) as ccont from corpcomt where head like 'CONT' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at cont commit level");
if(odbc_fetch_row($process1))
{
$ccont=odbc_result($process1,"ccont");
}
if($ccont==0) 
{
$ccont=0;
}
odbc_close_all();

$strsql="";
$strsql="select sum(amount) as ceqpt from corpcomt where head like 'EQPT' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at eqpt commit level");
if(odbc_fetch_row($process1))
{
$ceqpt=odbc_result($process1,"ceqpt");
}
if($ceqpt==0) 
{
$ceqpt=0;
}
odbc_close_all();

$strsql="";
$strsql="select sum(amount) as cfrtr from corpcomt where head like 'FRTR' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at frtr commit level");
if(odbc_fetch_row($process1))
{
$cfrtr=odbc_result($process1,"cfrtr");
}
if($cfrtr==0) 
{
$cfrtr=0;
}
odbc_close_all();

$strsql="";
$strsql="select sum(amount) as cintr from corpcomt where head like 'INTR' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at intr comit level");
if(odbc_fetch_row($process1))
{
$cintr=odbc_result($process1,"cintr");
}
if($vintr==0) 
{
$cintr=0;
}
odbc_close_all();

$strsql="";
$strsql="select sum(amount) as cothr  from corpcomt where head like 'OTHR' and iirno like '$instid1'";
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at othr voucher level");
if(odbc_fetch_row($process1))
{
$cothr=odbc_result($process1,"cothr");
}
if($cothr==0) 
{
$cothr=0;
}
odbc_close_all();
$ctotal=$cstaf+$ccons+$ccont+$ceqpt+$cfrtr+$cintr+$cothr;
$staf=$cstaf+$vstaf;
$cons=$ccons+$vcons;
$cont=$ccont+$vcont;
$eqpt=$ceqpt+$veqpt;
$frtr=$cfrtr+$vfrtr;
$intr=$cintr+$vintr;
$othr=$cothr+$vothr;



$staf=number_format($staf,2);
$cstaf=number_format($cstaf,2);
$vstaf=number_format($vstaf,2);

$cons=number_format($cons,2);
$ccons=number_format($ccons,2);
$vcons=number_format($vcons,2);
$cont=number_format($cont,2);
$ccont=number_format($ccont,2);
$vcont=number_format($vcont,2);

$eqpt=number_format($eqpt,2);
$ceqpt=number_format($ceqpt,2);
$veqpt=number_format($veqpt,2);

$frtr=number_format($frtr,2);
$cfrtr=number_format($cfrtr,2);
$vfrtr=number_format($vfrtr,2);

$intr=number_format($intr,2);
$cintr=number_format($cintr,2);
$vintr=number_format($vintr,2);

$othr=number_format($othr,2);
$cothr=number_format($cothr,2);
$vothr=number_format($vothr,2);



$total=$vtotal+$ctotal;
$balance=$rt-$total;


$ctotal=number_format($ctotal,2);
$vtotal=number_format($vtotal,2);
$balance=number_format($balance,2);
$total=number_format($total,2);
$rt=number_format($rt,2);
?>
<table border="1" width="100%">
<tr>
<th colspan="4"><div align="center">Total Receipt : <?php echo "$rt" ?></div></th>

</tr>
<tr>
<th width="25%"><div align="center">Account Head</div></th>
<th width="25%"><div align="center">Expenditure</div></th>
<th width="25%"><div align="center">Balance Commitments</div></th>
<th width="25%"><div align="center">Total Exp+Com</div></th>
</tr>
<tr class="rowA"  >
<th><div align="left">Staf</div></th>
<td><div align="right"><?php echo "$vstaf"; ?></div></td>
<td><div align="right"><?php echo "$cstaf"; ?></div></td>
<td><div align="right"><?php echo "$staf"; ?></div></td>
</tr>
<tr class="rowB"  >
<th><div align="left">Consumables</div></th>
<td><div align="right"><?php echo "$vcons"; ?></div></td>
<td><div align="right"><?php echo "$ccons"; ?></div></td>
<td><div align="right"><?php echo "$cons"; ?></div></td>
</tr>
<tr class="rowA"  >
<th><div align="left">Contingency</div></th>
<td><div align="right"><?php echo "$vcont"; ?></div></td>
<td><div align="right"><?php echo "$ccont"; ?></div></td>
<td><div align="right"><?php echo "$cont"; ?></div></td>
</tr>
<tr class="rowB"  >
<th><div align="left">Equipment</div></th>
<td><div align="right"><?php echo "$veqpt"; ?></div></td>
<td><div align="right"><?php echo "$ceqpt"; ?></div></td>
<td><div align="right"><?php echo "$eqpt"; ?></div></td>
</tr>
<tr class="rowA"  >
<th><div align="left">Foreign Travel </div></th>
<td><div align="right"><?php echo "$vfrtr"; ?></div></td>
<td><div align="right"><?php echo "$cfrtr"; ?></div></td>
<td><div align="right"><?php echo "$frtr"; ?></div></td>
</tr>
<tr class="rowB"  >
<th><div align="left">Internal Travel</div></th>
<td><div align="right"><?php echo "$vintr"; ?></div></td>
<td><div align="right"><?php echo "$cintr"; ?></div></td>
<td><div align="right"><?php echo "$intr"; ?></div></td>
</tr>
<tr class="rowA"  >
<th><div align="left">Others </div></th>
<td><div align="right"><?php echo "$vothr"; ?></div></td>
<td><div align="right"><?php echo "$cothr"; ?></div></td>
<td><div align="right"><?php echo "$othr"; ?></div></td>
</tr>
<tr class="rowB"  >
<th><div align="left">Total</div></th>
<td><div align="right"><?php echo "$vtotal"; ?></div></td>
<td><div align="right"><?php echo "$ctotal"; ?></div></td>
<td><div align="right"><?php echo "$total"; ?></div></td>
</tr>
<tr>
<th colspan="3" ><div align="right">Balance after Total Expenditure + Commitments :</div></th>
<th ><div align="right"><?php echo "$balance" ?></div></th>
</tr>
</table>
<?php
}
?>
</div>
 </div>
</div>
<?php

?>
<div id="footer">
<p></p>
</div>
</div>
</body>
</html>
