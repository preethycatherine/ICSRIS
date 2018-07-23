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
				
<div align="center"><h3>CONSULTANCY PROJECTS RESULT SCREEN</h3></div>


<?php
if (!isset($_COOKIE["PHPSESSID"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: http://icsris.iitm.ac.in/sessionout.php');
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
	header('location: index.php');
	exit;

}
if(!isset($_SESSION["consresult"]))
{
$sql1="";
$sql2="";
$sql3="";
$sql4="";
$sql5="";
$sql6="";
$sql7="";
$sql8="";
$sql9="";
$sql10="";

$sql11="";
$sql12="";


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

$optvalue=$_POST["radiobutton"];

$agency=trim($_POST["agency"]);
$dept=trim($_POST["dept"]);
$coordin=trim($_POST["coordin"]);
$prjvalue=$_POST["prjvalue"];
$prjnumber=$_POST["prjnumber"];
$prjno=$prjnumber.'%';


$foryr=$_POST["FORYR"];


$from=$_POST["FROM"];
$to=$_POST["TO"];

//echo "<br>From $from To $to";

//echo "<br>$agency<br>$dept<br>$coordin<br>$prjvalue<br>$prjnumber";

$sqle=" order by cprno";

$c=1;
while($c<=$count)
{
switch($choice[$c])
{
case 'ck1':
			$sql1=" and substring(CPRNO,13,4) like '$agency'";
			break;
case 'ck2':
//			$sql2=" and coor_name1 like '$coordin'";
			$sql2=" and instid like '$coordin'";
			break;
case 'ck3':
			$sql3=" and substring(cprno,7,3) like '$dept'";
			break;
case 'ck4':
			$sql4=" and c_cost >'$prjvalue'";
			$sqle=" order by c_cost desc";
			break;
case 'ck5':
			$today = date('Y/m/d');
			$sql5=" and c_date>=GETDATE()";
			$sqle=" order by s_date asc";
			break; 
case 'ck6':
			$sql6=" and substring(cprno,1,2) like 'ic'"; 
			$sqle= " order by c_date desc";
			break;

case 'ck7':
			$sql7=" and substring(cprno,1,2) like 'rc'"; 
			$sqle= " order by c_date desc";
			break;

case 'ck8':
			$sql8=" and substring(cprno,1,2) like 'rb'"; 
			$sqle= " order by c_date desc";
			break;

case 'ck9':
			$sql9=" and substring(cprno,1,2) in('rc','rb','ic','ct','tt')"; 
			$sqle= " order by cprno";
			break;

case 'ck10':
			$sql10=" and cprno like '$prjno'";
			break;
}
$c++;
}


//$sql="select aprlno,title,coor1,scom,stdate,enddate,sanvalue,coor2 from pcmaster where projrema = 'new' and substring(aprlno,3,4) in('0203','0304','0405','0506','0607','0708','0809','0910','1011') ";
$sql="select CPRNO,C_TITLE,COOR_NAME1,S_DATE,C_DATE,C_COST from cmstlst where substring(cprno,3,4) in('0203','0304','0405','0506','0607','0708','0809','0910','1011','1112','1213','1314','1415','1516','1617','1718','1819') ";


if (strcmp($optvalue,"FY")==0)
{
	$sql="select CPRNO,C_TITLE,COOR_NAME1,S_DATE,C_DATE,C_COST from cmstlst where cprno<>''";
	$sql11="and substring(cprno,3,4)='".$foryr."'";
	$sql12="";
	
}

if (strcmp($optvalue,"FT")==0)
{
$sql="select CPRNO,C_TITLE,COOR_NAME1,S_DATE,C_DATE,C_COST from cmstlst where cprno<>''";
//echo "<br>From $from To $to";
if (($from>=5051) and ($to<=5051))
{
$sql12=" and (((substring(cprno,3,4)>='$from') and (substring(cprno,3,4)<='9900')) or((substring(cprno,3,4)>='0001') and (substring(cprno,3,4)<='$to'))) ";
//echo "<br> one sql9='$sql9'";
}
elseif(($from<=5051) and ($to<=5051))
{
$sql12=" and (((substring(cprno,3,4)>='$from') and (substring(cprno,3,4)<='$to')) or((substring(cprno,3,4)>='$from') and (substring(cprno,3,4)<='$to'))) ";
//echo "<br> two sql9='$sql9'";
}
elseif(($from>=5051) and ($to>=5051))
{
$sql12=" and (((substring(cprno,3,4)>='$from') and (substring(cprno,3,4)<='$to')) or((substring(cprno,3,4)>='$from') and (substring(cprno,3,4)<='$to'))) ";
//echo "<br> three sql9='$sql9'";
}

$sql11="";
}

$sql=$sql.$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sqle;
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

$_SESSION["consresult"]="$sql";
}
else				//End of Session Result
{
$sql=$_SESSION["consresult"];
}

if($_SESSION['cprno'])
{
unset($_SESSION['cprno']);
}

$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$username,$password);
//echo "<br>$sql";
$process=odbc_exec($sqlconnect,$sql) or die("Query Execution Failed");


//    <td><div align="center">Title</div></td>
//    <td><div align="center">Sponsoring Agency</div></td>
?>

<table  border="1" width="100%">
<tr>
<th width="10">S#</th>
<!--<th width="15">Select</th> -->
<th  width="170" ><div align="center" >Project Number </div></th>
<th  width="75" ><div align="center" >Start Date </div></th>
<th  width="75" ><div align="center" >Close Date </div></th>
<th  width="60" ><div align="center" >Project Value </div></th>
<th  width="60" ><div align="center" >Grant Received</div></th>
<th  width="60" ><div align="center" >Total Exp.+Com.</div></th>
<th  width="60" ><div align="center" >Balance</div></th>
</tr>
 <?php
$count=1;
$i="1";
$ii="2";

while(odbc_fetch_row($process))
{
$pono = odbc_result($process,"CPRNO");
$star_date=odbc_result($process,"S_DATE");
$start_date=date('d-m-Y',strtotime($star_date));
$clos_date=odbc_result($process,"C_DATE");
$close_date=date('d-m-Y',strtotime($clos_date));
$pramount=odbc_result($process,"C_COST");
$iii=$i%$ii;
$count = fmod($count,2);

if ( $iii == 0 )
{
$cls="class=rowA";
}
else
{
$cls="class=rowB";
}
echo "<tr $cls>";
echo "<td>$i</td>";
//echo "<td align=center><input name=pono type=radio value=$pono /></td>";
echo "<td><a href=acctcpsum.php?cprno=$pono>$pono</a></td>";
echo "<td>$start_date</td>";
echo "<td>$close_date</td>";
echo "<td align = right >$pramount</td>";

$aprlnoc=substr($pono,0,12)."%";
//$aprlnoc=$pono;


//$stracct="select substring(nprno,11,4) as agency,nprno,stafall,staf,stafcom,eqptall,eqpt,rt,eqptcom,consall,cons,conscom,contall,cont,contcom,travall,trav,travcom,compall, comp,compcom,ohall,inoh,icoh,oterall,oter,otercom,totalall,total,totalcom,rt_balance from ttmaster  where nprno like '$aprlnoc'";

$stracct="select cprno,c_staf,c_eqpt,c_cons,c_cont,c_trav,c_comp,c_oter,c_inoh,c_icoh,c_euco,c_irdf,c_cent,c_remu,c_faci,c_sert,c_balance,C_RT,c_used,C_TOTALCOM,C_CONTCOM,C_STAFCOM,C_BALANCE from cmaster  where CPRNO LIKE '$aprlnoc'";

//echo "<br>$stracct";
//odbc_close_all();
$process1="";
$sqlconnectacct=odbc_connect("FACCT1DSN","sa","IcsR@123#") or die("ODBC CONNECTION 2 Failed");
$process1=odbc_exec($sqlconnectacct,$stracct) or dir("processacct Failed to get data");

if(odbc_fetch_row($process1))
{
$sta=odbc_result($process1,"c_staf");
$staf=round($sta,2);
$eqp=odbc_result($process1,"c_eqpt");
$eqpt=round($eqp,2);
$cons=odbc_result($process1,"c_cons");
$cons=round($cons,2);
$cont=odbc_result($process1,"c_cont");
$cont=round($cont,2);
$trav=odbc_result($process1,"c_trav");
$trav=round($trav,2);
$comp=odbc_result($process1,"c_comp");
$comp=round($comp,2);
$oter=odbc_result($process1,"c_oter");
$oter=round($oter,2);
$tota=$staf+$eqpt+$cons+$cont+$trav+$comp+$oter;
$tota=round($tota,2);
$inoh=odbc_result($process1,"c_inoh");
$inoh=round($inoh,2);
$icoh=odbc_result($process1,"c_icoh");
$icoh=round($icoh,2);
$euco=odbc_result($process1,"c_euco");
$euco=round($euco,2);
$irdf=odbc_result($process1,"c_irdf");
$irdf=round($irdf,2);
$cent=odbc_result($process1,"c_cent");
$cent=round($cent,2);
$remu=odbc_result($process1,"c_remu");
$remu=round($remu,2);
$faci=odbc_result($process1,"c_faci");
$faci=round($faci,2);
$sert=odbc_result($process1,"c_sert");
$sert=round($sert,2);
$balance=odbc_result($process1,"c_balance");
$balance=round($balance,2);
$rt=odbc_result($process1,"C_RT");
$rt=round($rt,2);
$used=odbc_result($process1,"c_used");
$used=round($used,2);
$texpb=$inoh+$icoh+$euco+$irdf+$cent+$remu+$faci+$used+$sert;
$texpb=round($texpb,2);
$totalcom=odbc_result($process1,"C_TOTALCOM");
$totalcom=round($totalcom,2);
$contcom=odbc_result($process1,"C_CONTCOM");
$contcom=round($contcom,2);
$stafcom=odbc_result($process1,"C_STAFCOM");
$stafcom=round($stafcom,2);
$cbalance=odbc_result($process1,"C_BALANCE");
$cbalance=round($cbalance,2);
$balpurcom=$totalcom-$stafcom;
$balpurcom=round($balpurcom,2);
$balance=$cbalance-$totalcom;
$exptot=$tota+$texpb+$totalcom;
$balance=round($balance,2);
}
else
{
$rt="NA";
$stafcom="NA";
$rtbal="NA";
//$page = $_SERVER['PHP_SELF'];
//$sec = "1";
//header("Refresh: $sec; url=$page");
}
echo "<td align = right >$rt</td>";
echo "<td align = right >$exptot</td>";
echo "<td align = right >$balance</td>";
echo "</tr>";
$i++;
}
//odbc_close_all();

}
?>
</table>
</div>
 </div>


<div id="footer">
<p></p>
</div>
</div>
</div>

</body>
</html>
