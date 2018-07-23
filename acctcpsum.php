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
	header('location: index.php');
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
if($clos_date!='')
{ 
$close_date=date('d-m-Y',strtotime($clos_date));
}
else
{
$close_date='...';
}
//$close_date=date('d-m-Y',strtotime($clos_date));
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
<th colspan="2" ><div align=center>CO-Coordinator Name : </span><?php echo "$coor_name"; ?></div></th>
<th><div align="center"><h4><a href="javascript:poptastic('acctcpcopiin.php?q=<?php echo "STAF"."@%@"."$cprno"."!@%"."$temp"; ?>');"><?php echo "Co_PI Details"; ?></a></h4></div></th> 
</tr>
<tr>
<th colspan=5><div align=center>Title : </span><?php echo "$title";  ?></div></th>
</tr>
</table>
</div>
<div align="center"><nobr><h4><a  href="acctcpsum.php" ><span style="background-color:#F6EECC">AccountSum</span></a>  |  <a  href="cpreceipts.php">ReceiptDetails</a>  |  <a  href="cvouhead.php">ExpenditureHead</a>  |  <a href="cvouyear.php">ExpenditureYear</a>  |  <a href="cstafcommit.php"><strong>StaffCommit</strong></a>  |  <a  href="cpothercommit.php">OthersCommit</a></h4></nobr></div> 
<?php
odbc_close_all();
$strsql="";
$strsql="select cprno,c_staf,c_eqpt,c_cons,c_cont,c_trav,c_comp,c_oter,c_inoh,c_icoh,c_euco,c_irdf,c_cent,c_remu,c_faci,c_sert,c_balance,C_RT,c_used,C_TOTALCOM,C_CONTCOM,C_STAFCOM,C_BALANCE from cmaster  where CPRNO LIKE '$cprno'";
$sqlconnect=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
$process=odbc_exec($sqlconnect,$strsql);
if(odbc_fetch_row($process))
{
$sta=odbc_result($process,"c_staf");
$staf=round($sta,2);
$eqp=odbc_result($process,"c_eqpt");
$eqpt=round($eqp,2);
$cons=odbc_result($process,"c_cons");
$cons=round($cons,2);
$cont=odbc_result($process,"c_cont");
$cont=round($cont,2);
$trav=odbc_result($process,"c_trav");
$trav=round($trav,2);
$comp=odbc_result($process,"c_comp");
$comp=round($comp,2);
$oter=odbc_result($process,"c_oter");
$oter=round($oter,2);
$tota=$staf+$eqpt+$cons+$cont+$trav+$comp+$oter;
$tota=round($tota,2);
$inoh=odbc_result($process,"c_inoh");
$inoh=round($inoh,2);
$icoh=odbc_result($process,"c_icoh");
$icoh=round($icoh,2);
$euco=odbc_result($process,"c_euco");
$euco=round($euco,2);
$irdf=odbc_result($process,"c_irdf");
$irdf=round($irdf,2);
$cent=odbc_result($process,"c_cent");
$cent=round($cent,2);
$remu=odbc_result($process,"c_remu");
$remu=round($remu,2);
$faci=odbc_result($process,"c_faci");
$faci=round($faci,2);
$sert=odbc_result($process,"c_sert");
$sert=round($sert,2);
$balance=odbc_result($process,"c_balance");
$balance=round($balance,2);
$rt=odbc_result($process,"C_RT");
$rt=round($rt,2);
$used=odbc_result($process,"c_used");
$used=round($used,2);
$texpb=$inoh+$icoh+$euco+$irdf+$cent+$remu+$faci+$used+$sert;
$texpb=round($texpb,2);
$totalcom=odbc_result($process,"C_TOTALCOM");
$totalcom=round($totalcom,2);
$contcom=odbc_result($process,"C_CONTCOM");
$contcom=round($contcom,2);
$stafcom=odbc_result($process,"C_STAFCOM");
$stafcom=round($stafcom,2);
$cbalance=odbc_result($process,"C_BALANCE");
$cbalance=round($cbalance,2);
$balpurcom=$totalcom-$stafcom;
$balpurcom=round($balpurcom,2);
$balance=$cbalance-$totalcom;
$balance=round($balance,2);
$totab=$tota+$texpb;
}

?>


<div align="center">
<table  border="2" align="center" cellpadding="2" cellspacing="2" width="100%">
  <tr class="rowA">
    <th><div align="center">Nature of Expenditure</div></th>
    <th><div align="center">Amount</th>
    <th><div align="center">Nature of Expenditure</div></th>
    <th><div align="center">Amount</div></th>
  </tr>
  <tr class="rowB">
    <th><div align="left">STAFF</div></th>
    <th><div align="right"><?php echo" $staf";?></th>
    <th><div align="left">INSTITUTE OVERHEAD </div></th>
    <th><div align="right"><?php echo" $inoh";?></div></th>
  </tr>
  <tr class="rowA">
    <th><div align="left">EQUIPMENT</div></th>
    <th><div align="right"><?php echo" $eqpt";?></th>
    <th><div align="left">ICSR OVERHEAD </div></th>
    <th><div align="right"><?php echo" $icoh";?></div></th>
  </tr>
   <tr class="rowB">
    <th ><div align="left">CONSUMABLES</div></th>
    <th><div align="right"><?php echo" $cons";?></th>
    <th><div align="left">EQPT. UTILISATION COST </div></th>
    <th><div align="right"><?php echo" $euco";?></div></th>
  </tr>
   <tr class="rowA">
    <th ><div align="left">CONTINGENCY</div></th>
    <th><div align="right"><?php echo" $cont";?></th>
    <th><div align="left">CONTRIBUTION TO IRDF </div></th>
    <th><div align="right"><?php echo" $irdf";?></div></th>
  </tr>
   <tr class="rowB">
    <th ><div align="left">TRAVEL</div></th>
    <th><div align="right"><?php echo" $trav";?></th>
    <th><div align="left">CONTRIBUTION TO ADMIN </div></th>
    <th><div align="right"><?php echo" $cent";?></div></th>
  </tr>
   <tr class="rowA">
    <th ><div align="left">COMPONENTS</div></th>
    <th><div align="right"><?php echo" $comp";?></th>
    <th><div align="left">DISTBN/REMUNERATION </div></th>
    <th><div align="right"><?php echo" $remu";?></div></th>
  </tr>
   <tr class="rowB">
    <th ><div align="left">OTHER EXPENESES</div></th>
    <th><div align="right"><?php echo" $oter";?></th>
    <th><div align="left">CENTRAL FACILITIES </div></th>
    <th><div align="right"><?php echo" $faci";?></div></th>
  </tr>
   <tr class="rowA">
    <th ><div align="left"></div></th>
    <th><div align="right"></th>
    <th><div align="left">MATERIALS USED </div></th>
    <th><div align="right"><?php echo" $used";?></div></th>
  </tr>
   <tr class="rowB">
    <th ><div align="left"></div></th>
    <th><div align="right"></th>
    <th><div align="left">SERVICE TAX </div></th>
    <th><div align="right"><?php echo" $sert";?></div></th>
  </tr>
   <tr class="rowA">
    <th ><div align="left">TOTAL EXPENDITURE(A)</div></th>
    <th><div align="right"><?php echo" $tota";?></th>
    <th><div align="left">TOTAL EXPENDITURE(B) </div></th>
    <th><div align="right"><?php echo" $texpb";?></div></th>
  </tr>
  <tr class="rowB">
    <th colspan="2"><div align="right">RECEIPTS FOR THE PROJECT : </div></th>
    <th colspan="2"><div align="left"><?php echo " $rt"; ?></div></th>
 </tr>
   <tr class="rowA">
    <th colspan="2"><div align="right">TOTAL EXPENDITURE(A + B) : </div></th>
    <th colspan="2"><div align="left"><?php echo " $totab"; ?></div></th>
 </tr>
  <tr class="rowB">
    <th colspan="2"><div align="right">BALANCE PURCHASE COMMITMENT : </div></th>
	<th colspan="2"><div align="left"><?php echo" $balpurcom";?> </div></th>
  </tr>
  <tr class="rowA">
    <th colspan="2"><div align="right">STAFF COMMITMENT :</div></th>
    <th colspan="2"><div align="left"><?php echo" $stafcom";?> </div></th>
  </tr>
  <tr class="rowB">
    <th colspan="2"><div align="right">BALANCE AVAILABLE : </div></th>
    <th colspan="2"><div align="left"><?php echo" $balance";?> </div></th>
  </tr>
<?php
odbc_close_all();

//select fmonth,c_nprno,c_icoh,c_inoh,c_euco,comp,c_used,c_faci,mat_pur,c_irdf,c_cent,c_remu,c_dept,c_pcf,c_corp from rca  where c_nprno like '$cprno'and ck='n'
$strsql="";
$strsql="select fmonth,c_nprno,c_icoh,c_inoh,c_euco,comp,c_used,c_faci,mat_pur,c_irdf,c_cent,c_remu,c_dept,c_pcf,c_corp from rca  where c_nprno like '$cprno'and ck='n'";
$process=odbc_exec($sqlconnect,$strsql);
if(odbc_fetch_row($process))
{
$fmonth=odbc_result($process,"fmonth");
$nprno=odbc_result($process,"c_nprno");
$icoh=odbc_result($process,"c_icoh");
$inoh=odbc_result($process,"c_inoh");
$euco=odbc_result($process,"c_euco");
$comp=odbc_result($process,"comp");
$used=odbc_result($process,"c_used");
$faci=odbc_result($process,"c_faci");
$mpur=odbc_result($process,"mat_pur");
$irdf=odbc_result($process,"c_irdf");
$cent=odbc_result($process,"c_cent");
$remu=odbc_result($process,"c_remu");
$dept=odbc_result($process,"c_dept");
$pcf=odbc_result($process,"c_pcf");
$corp=odbc_result($process,"c_corp");

$ctot=$icoh+$inoh+$euco+$comp+$used+$faci+$mpur+$irdf+$cent+$remu+$dept+$pcf+$corp;

$ctot=round($ctot,2);
$balad= $balance-$ctot;
?>
  <tr class="rowA">
    <th colspan="4"><div align="left">DISTRIBUTION <?php echo" $ctot";?></div></th>
  </tr>
    <tr class="rowA">
<!--    <th colspan="2"><div align="right">DISTRIBUTION : </div></th>
    <th colspan="2"><div align="left">  </div></th>
  </tr>
    <tr class="rowB">
    <th colspan="2"><div align="right">BALANCE AFTER DISTRIBUTION  : </div></th>
    <th colspan="2"><div align="left"> </div></th>
  </tr> -->
<?php
}

}
else
{
session_destroy();
header('location: index.php');
exit;
}
?>

</table>
</div>
</div>
<div align="center"></div>
</div>
</div>

</div>
</body>
<script type="text/javascript">

function poptastic(url)
{
var newwindow;
	newwindow=window.open(url,'name','height=300,width=1100,scrollbars=yes');
	newwindow.focus();
<!--	if (window.focus) {newwindow.focus()} -->
}
</script>
</html>
