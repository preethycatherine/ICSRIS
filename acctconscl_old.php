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
	<div id="header">
		<h1><a href="icsrisacct.php">Centre for IC & SR</a></h1>
		<h1><a href="icsrisacct.php">Indian Institute of Technology Madras, Chennai</a></h1>
		<h2>Information System</h2>
	</div>
	<div id="menu">
	<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h2>
	</div>

	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
				
				<div align="center"><h3> Consultancy Closed Projects </h3></div>
<div align="center">
<table  border="1">
<tr>
<th width="10">S#</th>
<!--<th width="15">Select</th> -->
<th  width="170" ><div align="center" >Project Number </div></th>
<th  width="75" ><div align="center" >Start Date </div></th>
<th  width="75" ><div align="center" >Close Date </div></th>
<!--<th  width="60" ><div align="center" >Project Value </div></th>-->
<th  width="60" ><div align="center" >Grant Received</div></th>
<th  width="60" ><div align="center" >Total Exp.+Com.</div></th>
<th  width="60" ><div align="center" >Balance</div></th>
</tr>

<?php
if (!isset($_COOKIE["PHPSESSID"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: index.php');
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
$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
if(strcmp($usermode,"SUPER")==0)
{
//header('location: https://icsris.iitm.ac.in/AIS/varrpt.php');
}
else
{
//$sqlquery="select nprno from mstlst where instid like '$insid'";
$sqlquery="select cprno,s_date,c_date,c_cost from cmstlst where instid like '$insid' and c_date<CAST(CAST(GETDATE() AS DATE) AS DATETIME) and (substring(cprno,3,4) in ('0203','0304','0405','0506','0607','0708','0809','0910','1011','1112','1213','1314','1415','1516','1617','1718')) order by c_date desc";
}
unset($_SESSION['cprno']); 
$usermode=$_SESSION['usermode'];
$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
$process=odbc_exec($sqlconnect,$sqlquery) or die("ODBC Query Execution Failed"); 
//echo "$insid | $usermode | $sqlquery<br>";
$i="1";
$ii="2";

while(odbc_fetch_row($process))
{
$pono = odbc_result($process,"cprno");
$star_date=odbc_result($process,"s_date");
$start_date=date('d-m-Y',strtotime($star_date));
$clos_date=odbc_result($process,"c_date");
$close_date=date('d-m-Y',strtotime($clos_date));
$pramount=odbc_result($process,"c_cost");
$iii=$i%$ii;
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
echo "<td><a href=http://icsris.iitm.ac.in/ICSRIS/acctcpsum.php?cprno=$pono>$pono</a></td>";
echo "<td>$start_date</td>";
echo "<td>$close_date</td>";
//echo "<td align = right >$pramount</td>";

//$aprlnoc=substr($pono,0,10)."%";
$aprlnoc=$pono;


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
echo"<tr>";
echo "<td colspan=8 align=center><strong>Consultancy CoCordinated Projects</strong></th>";
echo "</tr>";
//$sqlquery1="select nprno from projcoordinators where instid ='$insid' order by nprno";
//$sqlquery1="select nprno,title,start_date,close_date,pramount from mstlst where close_date>=getdate()and nprno in(select nprno from projcoordinators where instid ='$insid') order by start_date desc";

$sqlquery1="select cprno,s_date,c_date,c_cost from cmstlst where c_date<getdate() and cprno in (select cprno from conscocoordinators where instid ='$insid') order by c_date asc";
//echo "$sqlquery1";
//odbc_close_all();
$sqlconnect=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$process2=odbc_exec($sqlconnect,$sqlquery1) or die("Connection Failed"); 

while(odbc_fetch_row($process2))
{
$pono = odbc_result($process2,"cprno");
$star_date=odbc_result($process2,"s_date");
$start_date=date('d-m-Y',strtotime($star_date));
$clos_date=odbc_result($process2,"c_date");
$close_date=date('d-m-Y',strtotime($clos_date));
$pramount=odbc_result($process2,"c_cost");
$iii=$i%$ii;
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
echo "<td><a href=http://icsris.iitm.ac.in/ICSRIS/acctcpsum.php?cprno=$pono>$pono</a></td>";
echo "<td>$start_date</td>";
echo "<td>$close_date</td>";
//echo "<td>$pramount</td>";

//$aprlnoc=substr($pono,0,10)."%";
$aprlnoc=$pono;


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
//echo "$contcom";
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

}

?>
</table>
</div>
 </div>
</div>
<?php
if (strcmp($usermode,"SUPER")==0)
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<h3>Sponsored Project</h3>
<?php
if(isset($_SESSION["sponresult"]))
{
?>
<p><ul><li><a href="acctspquery.php">Sponsor Query</a></li>
<li><a href="acctspresult.php">Sponsor Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctspquery.php">Sponsor Query</a></li></ul></p>
<?php
}
?>
<h3>Consultancy Project</h3>
<?php
if(isset($_SESSION["consresult"]))
{
?>
<p><ul><li><a href="acctcpquery.php">Consultancy Query</a></li>
<li><a href="acctcpresult.php">Consultancy Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctcpquery.php">Consultancy Query</a></li></ul></p>
<?php
}
?>
<h3>PCF</h3>
<?php
if(isset($_SESSION["pcfresult"]))
{
?>
<p><ul><li><a href="acctpcfquery.php">PCF Query</a></li>
<li><a href="acctpcfresult.php">PCF Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctpcfquery.php">PCF Query</a></li></ul></p>
<?php
}
?>
<h3>RMF</h3>
<?php
if(isset($_SESSION["rmfresult"]))
{
?>
<p><ul><li><a href="acctrmfquery.php">RMF Query</a></li>
<li><a href="acctrmfresult.php">RMF Result</a></li></ul>
</p>
<?php
}
else
{
?>
<p><ul><li><a href="acctrmfquery.php">RMF Query</a></li></ul></p>
<?php
}
?>
<h3>Cheque Details</h3>
<p><ul><li><a href="chequedetails.php">Pending Cheques Details</a></li></ul></p></div>
<div class="clear"></div>
</div>
<?php
}
else
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<h3>Unidentified Grant Receipts</h3>
<p><ul><li><a href="pendingreceipts.php">Unidentified Grant Receipts </a></li></ul></p>
<?php
$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$instid1=$insid;
$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
$strsql="select * from webauthReim where instid like '$instid1'";
//echo "$strsql";
$process=odbc_exec($sqlconnect,$strsql) or die("Query Execution Failed");
if(odbc_fetch_row($process))
{
?>
<h3>Bank Imprest Account</h3>
<p><ul><li><a href="acctsimprest.php">Imprest Account</a></li></ul></p>
<?php	
}
odbc_close_all();
?>
<h3>Sponsored Project</h3>
<p><ul><li><a href="acctsponon.php">Ongoing Projects</a></li><li><a href="acctsponcl.php">Closed Projects</a></li></ul></p>
<h3>Consultancy Project</h3>
<p><ul><li><a href="acctconson.php">Ongoing Projects</a></li><li><a href="acctconscl.php">Closed Projects</a></li></ul></p>
<?php

mysql_connect("eservices", "cpdaread", "Cpda@Read!1") ; 
		mysql_select_db("cpda") or die("msql connection error") ;

$q=mysql_query("select access from staff_details where StaffNo='".$insid."' and Status='Active' ");
$rowcount=mysql_num_rows($q);
//echo $insid;
//echo $rowcount;
if(($rowcount==1))
{
while($row = mysql_fetch_array($q))
{
//echo $row["access"];
if($row["access"] == 'Yes')
{
	
?>
<h3>PCF / RMF / CPDA </h3>
<p><ul><li><a href="acctpcfsum.php">PCF Account</a></li>
<li><a href="acctrmfsum.php">RMF Account</a></li>
<li><a href="CPDA/batch.php">CPDA</a></li></ul></p>
<?php
}
else
{
?>
<h3>PCF / RMF </h3>
<p><ul><li><a href="acctpcfsum.php">PCF Account</a></li>
<li><a href="acctrmfsum.php">RMF Account</a></li></ul></p>
<?PHP	
}
}
}
?>
<h3>SBI Credit Details</h3>
<p><ul><li><a href="sbicreditdetails.php">Direct Credit Details</a></li></ul></p>
<h3>Cheque Details</h3>
<p><ul><li><a href="chequedetails.php">Pending Cheques Details</a></li></ul></p></div>
<div class="clear"></div>
<!--</div>-->
<?php
}
//}
?>
<div id="footer">
<p></p>
</div>
</div>
</body>
</html>
