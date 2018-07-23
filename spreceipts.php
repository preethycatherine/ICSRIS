<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ICSR ACCOUNTS Sponsor Receipt Detais</title>
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
$con = odbc_connect("FACCTDSN","sa","IcsR@123#");
$yearval=substr($npr,3,2);
//echo "$yearval";
	if($yearval==00)
	{
		$str1=99;
	}
	else
	{
//		$str1=$yearval-1;
		$str1=$yearval;
	}
	
	//echo "the vu     " .$str1."<br>";
	if(($str1 >= 50) && ($str1 <= 99))
		{
		$year='19'.$str1;
		}
	elseif(($str1>=0) && ($str1<=9))
			{
//			$year='200'.$str1;
			$year='20'.$str1;
			//echo 'the year '.$year;
			}
		else
			{
			$year='20'.$str1;
			}
	
		
		
		//echo 'the year is '. $year;
		//echo 'Date='.date('d');
		
		if(date('d')>=3)
			{
			$d='20'.date("y");
			}
		else
			{
			$d='20'.date("y")-1;
			}
			//echo ("the date.................... is  ".$d);
			//echo ("year=".$year.";d<=".$d);
			for($i=$year;$i<=$d;$i++)
		{
			$fy=substr($i,-2);
			
			$receipt='rec'.$fy.substr($i+1,-2);
			//echo "$receipt";
		}
//echo "$fy";
//echo "$receipt";
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

<table width="100%" border="1">
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
<nobr><h4><a href="acctspsum.php" >AccountSum</a>  |  <a href="spreceipts.php"><span style="background-color:#F6EECC">ReceiptDetails</span></a>  |  <a href="vouhead.php">ExpenditureHead</a>  |  <a href="vouyear.php">ExpenditureYear</a>|	<a  href="stafcommit.php"><strong>StaffCommit</strong></a>  |  <a href="spothercommit.php"><u>OthersCommit</u></a> </h4></nobr></div> 
<div align="center">
<table  cellpadding="2" border="2" width="100%">
<tr>
<th  colspan="5"><div align="center">Receipt Details</div></th>
</tr>
  <tr>
    <th><div align="center">Receipt No.</div></th>
    <th><div align="center">Date</div></th>
    <th><div align="center">Sponsor</div></th>
    <th><div align="center">Cheque No.</div></th>
    <th><div align="center">Amount</div></th>
  </tr>


<?php


$count=0;
		$tamount=0;
		//$tamount=0;
		
		 if(date('d')>=3)
			{
			$d='20'.date("y");
			}
		else
			{
			$d='20'.date("y")-1;
			}
			//echo ("the year.................... is  ".$year);
			//echo ("the date.................... is  ".$d);
			
			for($i=$year;$i<=$d;$i++)
		{
			//echo "$i | $d";
			$fy=substr($i,-2);
			
			$receipt='rec'.$fy.substr($i+1,-2);
			//echo "the date    ".$fy."<br>";
				
			
			//echo " the date is :  ".$receipt."<br>";
						
			//$npr = substr($npr,0,10);
					//CHECK EQPT PROJECT
					$eqptcnpr=substr($npr,0,7);
					if (strcmp($eqptcnpr,'IITEQPT')==0)
					{
					$npr1 = substr($npr,0,11);
					}
					else
					{
					$npr1 = substr($npr,0,10);
					}			
					//echo "$npr1";								
$q = "SELECT RTNO,convert(varchar,[date],103) as date1,SPONS,NPRNO,CQNO,AMOUNT FROM ".$receipt." where nprno like '$npr%' and otramount = '0' order by [date]";
			//echo "<br>"."$q";
			
			/*if(is_string(!$fy))
			{
			echo gettype($fy);
			}*/
odbc_close_all();
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
//echo "$q";
$r = odbc_exec($con,$q);
//echo "<br>$q";

while(odbc_fetch_row($r))
{
$rt = odbc_result($r,"RTNO");
$dat = odbc_result($r,"date1");
$sp = odbc_result($r,"SPONS");
$cq = odbc_result($r,"CQNO");
$am = odbc_result($r,"AMOUNT");
$am1=round($am);
$count = fmod($count,2);
$tamount = $tamount + $am;

if($count==0)
{
?>
<tr class="rowA">
    <td><div align="center"><?php echo "$rt"; ?></div></td>
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="left"><?php echo "$sp"; ?></div></td>
    <td><div align="center"><?php echo "$cq"; ?></div></td>
    <td><div align="right"><?php echo "$am1"; ?></div></td>
  </tr>
<?php
 }
else
{
?>
<tr class="rowB">
    <td><div align="center"><?php echo "$rt"; ?></div></td>
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="left"><?php echo "$sp"; ?></div></td>
    <td><div align="center"><?php echo "$cq"; ?></div></td>
    <td><div align="right"><?php echo "$am1"; ?></div></td>
  </tr>
<?php
}
$count = $count + 1;
//echo "$count";
}
//}
//if(date('d')<=10)
//{
//	$monthr = sprintf("%02d%02d", date('y'),(date('y')+1));
//$rec='rec'.$monthr;
//}
//else
//{
$monthr = sprintf("%02d%02d", date('y'),date('n'));
$rec='r'.$monthr;
//}
//$monthr = sprintf("%02d%02d", date('y'),date('n'));

//echo "<br>$monthr|$rec";
$q1 = "SELECT RTNO,convert(varchar,[date],103) as date1,SPONS,NPRNO,CQNO,AMOUNT FROM ".$rec." where nprno like '$npr%' and otramount = '0' order by [date]";
//
odbc_close_all();
$count=0;
//echo "<br>$q1";
$con1 = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
//echo "<br>$q1";
$r = odbc_exec($con1,$q1) or die("Query Execution Failed");
while(odbc_fetch_row($r))
{
$rt = odbc_result($r,"RTNO");
$dat = odbc_result($r,"date1");
$sp = odbc_result($r,"SPONS");
$cq = odbc_result($r,"CQNO");
$am = odbc_result($r,"AMOUNT");
//echo "amount=$am";
$count = fmod($count,2);
$tamount = $tamount + $am;
if($count==0)
{
?>
<tr class="rowA">
    <td><div align="center"><?php echo "$rt"; ?></div></td>
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="left"><?php echo "$sp"; ?></div></td>
    <td><div align="center"><?php echo "$cq"; ?></div></td>
    <td><div align="right"><?php echo "$am"; ?></div></td>
  </tr>
<?php
 }
else
{
?>
<tr class="rowB">
    <td><div align="center"><?php echo "$rt"; ?></div></td>
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="left"><?php echo "$sp"; ?></div></td>
    <td><div align="center"><?php echo "$cq"; ?></div></td>
    <td><div align="right"><?php echo "$am"; ?></div></td>
  </tr>
</table>
<?php
}
	   
}
$count = $count + 1;

$tamount1=round($tamount);
}
?>
  <tr>
    <th colspan="4"=><div align="right">Total Amount</div></th>
    <td><div align="right"><b><?php echo "$tamount"; ?></b></div></td>
  </tr>
<?php
if($count == 0)
{
//echo "$count";
?>
  <tr>
    <th colspan="5"  ><div align="center">No Receipt Details !!</div></th>
  </tr>
 <?php
}
}
echo "</table>";

odbc_close($con);

?> 
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
