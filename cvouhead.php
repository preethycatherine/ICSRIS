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

unset($_SESSION['nprno']);

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
<table  width="100%" border="1" >
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
<div align="center"><nobr><h4><a  href="acctcpsum.php" >AccountSum</a>  |  <a  href="cpreceipts.php">ReceiptDetails</a>  |  <a  href="cvouhead.php"><span style="background-color:#F6EECC">ExpenditureHead</span></a>  |  <a href="cvouyear.php">ExpenditureYear</a>  |  <a href="cstafcommit.php"><strong>StaffCommit</strong></a>  |  <a  href="cpothercommit.php">OthersCommit</a></h4></nobr></div> 
<?php
odbc_close_all();
$nprno=$_SESSION['cprno'] or die("no session value");
//$npr=substr($nprno,0,12);
if((strcmp('TT1213PHY076',substr($cprno,0,12))==0))
{
$cprno=$cprno;
}
else
{
$cprno=substr($cprno,0,12)."%";
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
<div align="center">
<table  cellpadding="2" border="2" width="100%">
<tr>
<th  colspan="10"><div align="center">HEAD WISE DETAILS OF EXPENDITURE</div></th>
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
    <th><div align="center">SERT</div></th>
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
$count=1;
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
	elseif(($str1>=00) && ($str1<=09))
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
			$d='20'.date("y")-1;
			}
			//echo ("the date.................... is  ".$d);
			for($i=$year;$i<=$d;$i++)
		{
			$fy=substr($i,-2);
			$yrs=$fy.substr($i+1,-2);
			$temp = 'VOU'."$yrs";
//echo "$temp<br>";

$c = substr($nprno,0,12);

$q = "SELECT sum(amount) as amt,head FROM  ".$temp."  where substring(iccno,1,12) like '$c' group by head";
$rs = odbc_exec($sqlconnect,$q);

//echo $q;
$q = " ";

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
while(odbc_fetch_row($rs))
{

$am = odbc_result($rs,"amt");
$hd = odbc_result($rs,"head");
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
 elseif (strtolower($hd) == "trav")
 {  
    $trav = $am;
    $travtot = $travtot + $am;
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
     $inohtot = $inohtot + $am;
}
$count=$count+1;
}
$ovrhead = $icoh + $inoh;

if($cont!=0 || $eqpt!=0 || $sert!=0 || $staf!=0 || $cons!=0 || $trav!=0 || $comp!=0 || $overhead!=0 || $oter!=0)
{
$count=fmod($count,2);
//echo "<br>count=$count";
$nprno1=substr($nprno,0,12);
if($count==0)
{
?>
<tr class="rowA">
    <th><div align="center"><?php echo "$yrs"; ?></a></div></th>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "STAF"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$staf"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "EQPT"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$eqpt"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "CONS"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$cons"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "CONT"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$cont"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "TRAV"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$trav"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "COMP"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$comp"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "ICOH"."?~!@"."$nprno"."%@!"."$temp"."INOH" ?>');"><?php echo "$ovrhead"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "SERT"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$sert"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "OTER"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$oter"; ?></a></div></td>
  </tr>
<?php
 }
else
{
?>
<tr class="rowB">
    <th><div align="center"><?php echo "$yrs"; ?></a></div></th>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "STAF"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$staf"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "EQPT"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$eqpt"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "CONS"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$cons"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "CONT"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$cont"; ?></a></div></td>
    <td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "TRAV"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$trav"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "COMP"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$comp"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "ICOH"."?~!@"."$nprno"."%@!"."$temp"."INOH" ?>');"><?php echo "$ovrhead"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "SERT"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$sert"; ?></a></div></td>
	<td><div align="right"><a href="javascript:poptastic('acctcpvouinn.php?q=<?php echo "OTER"."?~!@"."$nprno"."%@!"."$temp"; ?>');"><?php echo "$oter"; ?></a></div></td>
  </tr>
<?php
}
}

//echo "$count";
$temp1 = substr($yrs, 0, 2);
$temp2 = substr($yrs, 2, 2);
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
	<th><div align="right"><?php echo round("$serttot"); ?></div></th>
    <th><div align="right"><?php echo round("$otertot"); ?></div></th>
</tr>
</table>
</div>
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
</body>
<script type="text/javascript">
var newwindow;
function poptastic(url)
{
	newwindow=window.open(url,'name','height=300,width=1200,scrollbars=yes,toolbar=no, menubar=no');
	if (window.focus) {newwindow.focus()}
}
</script>
</html>
