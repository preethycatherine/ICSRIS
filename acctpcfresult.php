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
				
<div align="center"><h3>PCF ACCOUNTS RESULT SCREEN</h3></div>


<?php
if (!isset($_COOKIE["PHPSESSID"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
exit;
}
elseif (!isset($_POST["instid"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
exit;
}
else
{
//setcookie("PHPSESSID","",time()-3600,"/");
session_start();
//unset($_SESSION["sessid"]);
$_SESSION["sessid"]=session_id();
$usermode=$_SESSION['usermode'];

//if(($_COOKIE["PHPSESSID"])==($_SESSION["sessid"]))
//{
//$instid=$_SESSION['instid'];
//echo "ss".$_POST["instid"];
if(!isset($_SESSION["pcfresult"]))
{

//$sqlconnectacct=odbc_connect("FACCTDSN","sa","IcsR@123#");
//$aprlno=trim($_POST["aprlno"]);
//session_register("logname");
//$_SESSION["aprlno"]=$aprlno;

$sql1="";
$sql2="";
$sql3="";
$sql4="";
$count=0;
$i=1;


foreach ($_POST["opinion"] as $val)
{
$choice[$i]=$val;
if ($choice[$i]<>'') 
$count++;
//echo "<br>$choice[$i]";
$i++;
}

$instid=trim($_POST["instid"]);
$pname=trim($_POST["pname"]);
$dept=trim($_POST["dept"]);


//echo "<br> $instid | $pname | $dept ";

//echo "\n Countvalue=$count";
//echo "<br>(($choice[1]='ck1') and ($count=1)";
$sqle=" order by dept";
//select iirno,name,dept,desig from co_name order by dept
$c=1;
while($c<=$count)
{
switch($choice[$c])
{
case 'ck1':
			$sql1=" and iirno like '$instid'";
			break;
case 'ck2':
			$sql2=" and name like '$pname'";
			break;
case 'ck3':
			$sql3=" and dept like '$dept'";
			break;
case 'ck4':
			$sql4="";
			break;
}
$c++;
}



$sql="select iirno,name,dept,desig from co_nme  where (iirno <> '' or name<>'' or desig<>'')";

$sql=$sql.$sql1.$sql2.$sql3.$sql4.$sqle;
//echo "<br> $sql";
if(isset($_SESSION["consresult"]))
{
unset($_SESSION["consresult"]);
}
if(isset($_SESSION["sponresult"]))
{
unset($_SESSION["sponresult"]);
}
if(isset($_SESSION["pcfresult"]))
{
unset($_SESSION["pcfresult"]);
}
if(isset($_SESSION["rmfresult"]))
{
unset($_SESSION["rmfresult"]);
}

$_SESSION["pcfresult"]="$sql";
}
else
{
$sql=$_SESSION["pcfresult"];
}
if($_SESSION['pcfid'])
{
unset($_SESSION['pcfid']);
}

$dsn="PCFACCT";
$username="sa";
$password="IcsR@123#";
$dsn1="FACCTPCF";
//$sqlconnect=odbc_connect($dsn,$username,$password);
$sqlconnect1=odbc_connect($dsn,$username,$password);
$proces=odbc_exec($sqlconnect1,$sql);
?>

<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th><div align="center">REGNO</div></th>
    <th><div align="center">NAME </div></th>
    <th><div align="center">DEPT</div></th>
    <th><div align="center">EXPEND</div></th>
    <th><div align="center">VOUCH</div></th>
    <th><div align="center">COMMIT</div></th>
    <th><div align="center">BALANCE</div></th>
  </tr>
 <?php
 $count=1;
 $j=1;
while(odbc_fetch_row($proces))
{
$iirno=odbc_result($proces,"iirno");
$name=odbc_result($proces,"name");
$dept=odbc_result($proces,"dept");
$desig=odbc_result($proces,"desig");

$count = fmod($count,2);

if($count==0)
{
$cls="class=rowA";
}
else
{
$cls="class=rowB";
}

$strsql="select sum(pcf) as rt from corprt where iirno like '$iirno'";

$sqlconnect=odbc_connect($dsn1,$username,$password);
$process1=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at Receipt level");
if(odbc_fetch_row($process1))
{
$rt=odbc_result($process1,"rt");
}
if($rt=='')
{
$rt=0;
}
odbc_close($sqlconnect);


$strsql="";
$strsql="select sum(amount) as vouch from corpvr where iirno like '$iirno'";
$sqlconnect=odbc_connect($dsn1,$username,$password);
$process2=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at voucher level");
if(odbc_fetch_row($process2))
{
$vouch=odbc_result($process2,"vouch");
}
if($vouch=='')
{
$vouch=0;
}
odbc_close($sqlconnect);


$strsql="";
$strsql="select sum(amount) comt from CORPCOMT where iirno like '$iirno'";
$sqlconnect=odbc_connect($dsn1,$username,$password);
$process3=odbc_exec($sqlconnect,$strsql) or die("<br> Connectin failed at commitment level");
if(odbc_fetch_row($process3))
{
$comt=odbc_result($process3,"comt");
}

if($comt=='')
{
$comt=0;
}
//echo "<br>rt=$rt vouch=$vouch commitment=$comt<br>";

$bal=$rt-($vouch+$comt);

//echo "<br>rt=$rt vouch=$vouch commitment=$comt balance=$bal<br>";

odbc_close($sqlconnect);

$bal=number_format($bal,2);
$rt=number_format($rt,2);
$vouch=number_format($vouch,2);
$comt=number_format($comt,2);
?>
  <tr <?php echo "$cls"; ?> >
    <td><div align="center"><a href="acctpcfsum.php?iirno=<?php echo "$iirno"; ?>" > <?php echo "$iirno"; ?></a></div></td>
    <td><div align="center"><?php echo "$name"; ?></div></td>
    <td><div align="center"><?php echo "$dept"; ?></div></td>
    <td><div align="center"><?php echo "$rt"; ?></div></td>
    <td><div align="right"><?php echo "$vouch"; ?></div></td>
    <td><div align="right"><?php echo "$comt"; ?></div></td>
    <td><div align="right"><?php echo "$bal"; ?></div></td>
  </tr>

<?php
$count=$count+1;
}
?>
</table>
</div>
 </div>

<?php


}
?>
<div id="footer">
</div>
</div>
</div>
</body>
</html>
