<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ICSR ACCOUNTS Sponsor Expenditure Head wise  Detais</title>
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
unset($_SESSION['cprno']);
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
}
?> 
<div align="center">
<table width="100%" border="1" >
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
<nobr><h4><a href="acctspsum.php" >AccountSum</a>  |  <a href="spreceipts.php">ReceiptDetails</a>  |  <a href="vouhead.php"><span style="background-color:#F6EECC">ExpenditureHead</span></a>  |  <a href="vouyear.php">ExpenditureYear</a>|	<a  href="stafcommit.php"><strong>StaffCommit</strong></a>  |  <a href="spothercommit.php"><u>OthersCommit</u></a> </h4></nobr></div> 
<div align="center">
<table  cellpadding="2" border="2" width="100%">
<tr>
<th  colspan="9"><div align="center">HEAD WISE DETAILS OF EXPENDITURE</div></th>
</tr>
  <tr>
    <th><div align="center">YEAR</div></th>
    <th><div align="center">STAF</div></th>
    <th><div align="center">EQPT</div></th>
    <th><div align="center">CONS</div></th>
    <th><div align="center">CONT</div></th>
    <th><div align="center">TRAV</div></th>
    <th><div align="center">COMP</div></th>
    <th><div align="center">OVERHEAD</div></th>
    <th><div align="center">OTER</div></th>
  </tr>


<?php

$serttot = 0;
$otertot = 0;
$staftot = 0;
$comptot = 0;
$travtot = 0;
$eqpttot = 0;
$icohtot = 0;
$constot = 0;
$inohtot = 0;
$conttot = 0;
$count=0;
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
	elseif(($str1>=00) && ($str1<=10))
			{
			$year='20'.$str1;
			//echo 'the year '.$year;
			}
		else
			{
			$year='20'.$str1;
			}
	
		
		
//		echo 'the year is '. $year;
//		echo 'Date is '.date("d/m/yy");
		
		if(date('d')>=1) //3
			{
			$d='20'.date("y");
			}
		else
			{
			$d='20'.date("y")-1;
			}
			//echo ("<br>the date.................... is  ".$d);
			//echo ("<br>year.................... is  ".$year);
			//echo ("<br>i.................... is  ".$i);
//echo "<br>$d";
			for($i=$year;$i<=$d;$i++)
		{
			$fy=substr($i,-2);
			
			$yrs=$fy.substr($i+1,-2);
			$temp = 'VOU'."$yrs";
			//echo "$temp<br>";

$c = substr($nprno,0,13);
odbc_close_all();
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$q = "SELECT sum(amount) as amt,head FROM  ".$temp."  where substring(nprno,1,13) like '$c' group by head";
//echo "$q";
$rs = odbc_exec($con,$q);

//echo "$q<br>";
//$q = "";

//$count= 0;
$sert = 0;
$oter = 0;
$staf = 0;
$comp = 0;
$cont = 0;
$trav = 0;
$eqpt = 0;
$icoh = 0;
$cons = 0;
$inoh = 0;
$oh   = 0;
$intr = 0;
$frtr = 0;

while(odbc_fetch_row($rs))
{
$am = odbc_result($rs,"amt");
$hd = odbc_result($rs,"head");
//echo "$count-->$hd=$am<br>";
if(strtolower($hd) == "sert")
{
$sert = $am;
$serttot = $serttot + $am; 
}
else if(strtolower($hd) == "oter")
{
 $oter= $am;
 $otertot = $otertot + $am;
}
else if(strtolower($hd) == "staf")
{
$staf = $am;
$staftot = $staftot + $am;
}
elseif (strtolower($hd) == "comp") 
  { 
    $comp = $am;
    $comptot = $comptot + $am;
}
 elseif (strtolower($hd) == "cont")
 {  
    $cont = $am;
    $conttot = $conttot + $am;
}
 elseif ((strtolower($hd) == "trav"))
 {  
	$trav = $am;
}
 elseif ((strtolower($hd) == "intr"))
 {  
	$intr = $am;
}
 elseif ((strtolower($hd) == "frtr"))
 {  
	$frtr = $am;
}
 elseif (strtolower($hd) =="eqpt")
   {
    $eqpt = $am;
   $eqpttot = $eqpttot + $am;
   }
   
 elseif (strtolower($hd) == "icoh")
   {
    $icoh = $am;
	$icohtot = $icohtot + $am;
}
 elseif (strtolower($hd) == "cons") 
 {  
    $cons = $am;
   $constot = $constot + $am;
}
 elseif (strtolower($hd) == "inoh") 
 {
     $inoh = $am;
	 //echo "$temp"+":$am<br>";
     $inohtot = $inohtot + $am;
}
$trav=$trav+$intr+$frtr;

}
$travtot=$travtot+$trav;
$ovrhead = $icoh + $inoh;
//echo "$temp : cont=$cont | eqpt=$eqpt| sert=$sert| stfstaf!=0 | $cons!=0 | $trav!=0 | $comp!=0 | $ovrhead!=0 | $oter!=0)";
if($cont!=0 || $eqpt!=0 || $sert!=0 || $staf!=0 || $cons!=0 || $trav!=0 || $comp!=0 || $ovrhead!=0 || $oter!=0)
{
$count=fmod($count,2);
if($count==0)
{
//<a href="javascript:poptastic('/examples/poppedexample.html');">» Pop it</a>
?>
<tr class="rowA">
    <th><div align="center"><?php echo "$yrs"; ?></div></th>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "STAF"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$staf"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "EQPT"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$eqpt"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "CONS"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$cons"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "CONT"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$cont"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "TRAV"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$trav"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "COMP"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$comp"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "INOH"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$ovrhead"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "OTER"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$oter"; ?></a></div></td>
  </tr>
<?php
 }
else
{
?>
<tr class="rowB">
    <th><div align="center"><?php echo "$yrs"; ?></div></th>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "STAF"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$staf"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "EQPT"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$eqpt"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "CONS"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$cons"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "CONT"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$cont"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "TRAV"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$trav"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "COMP"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$comp"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "INOH"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$ovrhead"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctspvouin.php?q=<?php echo "OTER"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "$oter"; ?></a></div></td>
  </tr>
<?php
}
}
$count=$count+1;
//}
//echo "<br>$yrs";
$temp1 = substr($yrs, 0, 2);
$temp2 = substr($yrs, 2, 2);
//$temp1 = $temp1 + 1;
//$temp2 = $temp2 + 1;

$temp1=$temp1;
$temp2=$temp2;

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
//echo "<br>$tempstr";
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
//echo "<br>$mnt";
}
$temp = "$tempstr"."$mnt";
//echo "<br>$temp";

}
$ovrheadtot = $inohtot + $icohtot;
?>
<tr >
    <th><div align="center">TOTAL</div></th>
    <th><div align="right"><?php echo round("$staftot"); ?></div></th>
    <th><div align="right"><?php echo round("$eqpttot"); ?></div></th>
    <th><div align="right"><?php echo round("$constot"); ?></div></th>
    <th><div align="right"><?php echo round("$conttot"); ?></div></th>
    <th><div align="right"><?php echo round("$travtot"); ?></div></th>
    <th><div align="right"><?php echo round("$comptot"); ?></div></th>
    <th><div align="right"><?php echo round("$ovrheadtot"); ?></div></th>
    <th><div align="right"><?php echo round("$otertot"); ?></div></th>
</tr>
</table>
<?php
odbc_close($con);
?>
</div>

<div align="center"></div>
</div>
</div>
<?php

//}
?>
<div id="footer">
<p></p>
</div>
</div>
</div>
</body>
<script type="text/javascript">

function poptastic(url)
{
var newwindow;
	newwindow=window.open(url,'name','height=300,width=1200,scrollbars=yes');
	newwindow.focus();
<!--	if (window.focus) {newwindow.focus()} -->
}
</script>
</html>
