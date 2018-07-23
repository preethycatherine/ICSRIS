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
<link href="default2.css" rel="stylesheet" type="text/css" />
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
<!--<div id="primaryContent">-->
				
<div align="center">
<?php
if(!isset($_COOKIE["PHPSESSID"]))
{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: sessionout.php');
	exit;

}
else
{
session_start();
$insid=$_SESSION['instid'];
$usermode=$_SESSION['usermode'];
//$bankacctno=$_SESSION['BankAcct'];

//echo "$bankacctno";
//$bankacctno='%'.$bankacctno.'%';
//$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
//echo "<br> Flow in here";


}
//$_SESSION['nprno']=$nprno;

if($_POST) 
{
//$bank=$_POST['bank'];
$fdate=$_POST["FDATE"];
$tdate=$_POST["TDATE"];
if (strcmp($usermode,"SUPER")==0)
{
$bankacctno=$_POST["BankAcct"];
}
else
{
$bankacctno=$_SESSION['BankAcct'];
}

$_SESSION["TFdate"]=$fdate;
$_SESSION["TTdate"]=$tdate;

$_SESSION['BankAcct']=$bankacctno;

//echo "Passed Value<br";
//echo "<br>$bankacctno<br>$fdate<br>$tdate";


$ledger="";
//$bankacctno='%2722101011010%';
$bankacctno='%'.$bankacctno.'%';
//echo "<br>echo in First";
//$fdate='01/04/2014';
//$tdate='31/12/2014';
}
else
{
	//echo "<br>no data";
	$fdate=$_SESSION["TFdate"];
	$tdate=$_SESSION["TTdate"];
	$bankacctno=$_SESSION['BankAcct'];
	$bankacctno='%'.$bankacctno.'%';
	//echo "Session Value<br";
//echo "<br>$bankacctno<br>$fdate<br>$tdate";
	
}

odbc_close_all();
$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$instid1="";
$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
$sql="select Name,OpeningBalance from [ICSRDBTALLY].dbo.Ledgers where name like '%$bankacctno%'";
$process1=odbc_exec($sqlconnect,$sql) or die("Query Execution Failed");
if (odbc_fetch_row($process1))
{ 
$name=odbc_result($process1,"Name");
$openbal=odbc_result($process1,"OpeningBalance"); 
}
odbc_close_all();


?>

<table style="background-color:#F6EECC"  width="80%" border="1">
<tr  class="rowB">
<th colspan=5 ><div align=center> <span style="color:#663300">Imprest Account Summary as on <?php echo date("d/m/Y");  ?>  </span></div></th>
</tr>
<tr  class="rowA">
<th><div align="center"><span style="color:#663300"><?php  echo "$name"; ?></span></div></th>
</tr>
</tr >
<tr class="rowB">
<th><div align="center"><span style="color:#663300"></span>From <?php echo "$fdate"; ?>  To <?php echo "$tdate"; ?>  </div></th>
</tr>
</table>

<table style="background-color:#F6EECC" cellpadding="2" border="2" width="70%">
<tr>
<th width="5">S#</th>
<th  width="30" ><div align="center" >Recoupment Date </div></th>
<th  width="10" ><div align="center" >Recoupment Amount</div></th>
<th  width="5" ><div align="center" >TransactionDate (Cheque Date)</div></th>
<th  width="5" ><div align="center" >Voucher Type</div></th>
<th  width="5" ><div align="center" >TransactionNo (Cheque No)</div></th>
<th  width="5" ><div align="center" >Particulars</div></th>
<th  width="5" ><div align="center" >Transaction Amount</div></th>
<th  width="5" ><div align="center" >ProjectNumber</div></th>
<th  width="5" ><div align="center" >Naration</div></th>
</tr>
 <?php
 $sqlconnect=odbc_connect($dsn,$username,$password) or die("Connection Failed");

if ($fdate!=NULL && $tdate!=NULL)
{


$fde=str_replace("/","-",$fdate);
$fd = date('Y-m-d',strtotime($fde));

$ede=str_replace("/","-",$tdate);
$ed = date('Y-m-d',strtotime($ede));

//opbal="0";
$sql="select sum(OpeningBalance) as opbal from [ICSRDBTALLY].dbo.vw_openingbalance where LedgerName like '$bankacctno' and VoucherDate < '$fd'";
//echo " Opending Balance Query: <br>$sql<br>";

$processo=odbc_exec($sqlconnect,$sql) or die("Query Execution Failed");
if (odbc_fetch_row($processo))
{
	$opbal=odbc_result($processo,"opbal");	
}
$opbalc=0;
$opbald=0;
odbc_close_all();

//echo "$fdate || $tdate , $fd || $ed";	



$sql="select Autoid,TallyMasterid,  VoucherDate,VoucherNumber ,LedgerName,VoucherType,CostCentreName,BillName,Narration,InstrumentNumber,InstrumentDate,CrDr,Amount from [ICSRDBTALLY].dbo.Vouchers where VoucherDate BETWEEN '$fd' and '$ed' and isnull (void,'N')='N' and LedgerName not like '$bankacctno'  and tallymasterid in (select tallymasterid from [ICSRDBTALLY].dbo.Vouchers where LedgerName like '$bankacctno' and VoucherDate BETWEEN '$fd' and '$ed' and isnull (void,'N')='N') order by voucherdate";
//echo "<br>Details Received Query :<br> $sql <br>";
$process=odbc_exec($sqlconnect,$sql) or die("Query Execution Failed");

$count=1;
$i="1";
$ii="2";
$totdebit=0;
$totcredit=0;
$credit=0;

while(odbc_fetch_row($process))
{
$vdate="";

$vdate=odbc_result($process,"VoucherDate");	
$date = date('d-m-Y',strtotime($vdate));
$part=odbc_result($process,"LedgerName");
$voutype=odbc_result($process,"VoucherType");
$vrno=odbc_result($process,"VoucherNumber");
$prjno=odbc_result($process,"CostCentreName");
$billname=odbc_result($process,"BillName");
$naration=odbc_result($process,"Narration");
$cqno=odbc_result($process,"InstrumentNumber");
$cqdt=odbc_result($process,"InstrumentDate");
$cdt=date('d-m-Y',strtotime($cqdt));
$vtype=odbc_result($process,"VoucherType");
$crdr=odbc_result($process,"CrDr");

//echo "$billname";
if (strcmp($crdr,'Credit')==0)
{
$credit=odbc_result($process,"Amount");
$debit=0;
}
else
{
$credit=0;
$debit=odbc_result($process,"Amount");
}
$totcredit=$totcredit+$credit;
$totdebit=$totdebit+$debit;


$iii=$i%$ii;
$count = fmod($count,2);
if($count==0)
{
?>
<tr class="rowB" >
    <td><div align="center"><?php echo "$i"; ?></div></td>
    <td ><div align="center" ><?php echo "$date"; ?></div></td>
    <td><div align="right"><?php echo round($credit); ?></div></td>
    <td><div align="center"><?php echo "$cdt"; ?></div></td>
    <td><div align="center"><?php echo "$voutype"; ?></div></td>
    <td><div align="center"><?php echo "$cqno"; ?></div></td>
    <td ><div align="center" ><?php echo "$part"; ?></div></td>
    <td><div align="right"><?php echo round($debit); ?></div></td>
 	<td><div align="center"><?php echo "$prjno"; ?></div></td>   
 	<td><div align="center"><?php echo "$naration"; ?></div></td>   



<!--    <td><div align="right"><?php echo round($credit); ?></div></td> -->
  </tr>
<?php
 }
else
{
?>
<tr class="rowA">
    <td><div align="center"><?php echo "$i"; ?></div></td>
    <td ><div align="center" ><?php echo "$date"; ?></div></td>
    <td><div align="right"><?php echo round($credit); ?></div></td>
    <td><div align="center"><?php echo "$cdt"; ?></div></td>
    <td><div align="center"><?php echo "$voutype"; ?></div></td>
    <td><div align="center"><?php echo "$cqno"; ?></div></td>
    <td ><div align="center" ><?php echo "$part"; ?></div></td>
    <td><div align="right"><?php echo round($debit); ?></div></td>
 	<td><div align="center"><?php echo "$prjno"; ?></div></td>   
 	<td><div align="center"><?php echo "$naration"; ?></div></td>   
<!--    <td><div align="right"><?php echo round($credit); ?></div></td> -->
  </tr>

<?php
}
$count = $count + 1;
$i=$i+1;
//echo "$count";
}

if ($opbal>=0) 
{
?>
<tr class="rowB">
    <td> </td>
    <td ><div align="right">Opening  Balance</div></td>
    <td ><div align="right"><?php echo "$opbal"; ?></div></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>    
    <td></td>
</tr>

<?php
}
else
{
?>
<tr class="rowB">
    <td> </td>
    <td ><div align="right">Opening  Balance</div></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td ><div align="right"><?php echo "$opbal"; ?></div></td>
    <td></td>    
    <td></td>
</tr>

<?php
	
}
?>
<tr class="rowB">
<th></th>
<th><div align="right">Current Total</div></th>
<th><div align="right"><?php echo round($totcredit); ?></div></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th><div align="right"><?php echo round($totdebit); ?></div></th>
<th></th>
<th></th>
</tr>
<?php
$clbal=$opbal-($totdebit-$totcredit);
odbc_close_all();

$sql="select sum(OpeningBalance) as clbal from [ICSRDBTALLY].dbo.vw_openingbalance where LedgerName like '$bankacctno' and VoucherDate <= '$ed'";
//echo "<br>Closing  Balance Query: <br>$sql<br>";
$processc=odbc_exec($sqlconnect,$sql) or die("Query Execution Failed");
if (odbc_fetch_row($processc))
{
	$clbal=odbc_result($processc,"clbal");	
}


if ($clbal>0) 
{
?>
<tr class="rowA">
	<td> </td>
    <td ><div align="right">Closing Balance</div></td>
    <td ><div align="right"><?php echo "$clbal"; ?></div></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>    
    <td></td>
</tr>

<?php
}
else
{
?>
<tr class="rowA">
    <td> </td>
    <td ><div align="right">Closing Balance</div></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td ><div align="right"><?php echo "$clbal"; ?></div></td>
    <td></td>    
    <td></td>
</tr>

<?php
	
}
odbc_close_all();
?>

</table>
<?php }?>
</div>
<!--</div>-->

<div align="center"></div>
</div>
</div>
<!--</div>-->
<?php
if (strcmp($usermode,"SUPER")==0)
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<?php
$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$instid1=$insid;
$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
$strsql="select * from webauthReimSuper";
//echo "$strsql";
$process=odbc_exec($sqlconnect,$strsql) or die("Query Execution Failed");
if(odbc_fetch_row($process))
{
?>
<h3>Bank Imprest Account</h3>
<p><ul><li><a href="acctReimQuery.php">Imprest Account Query</a></li></ul></p>
<?php	
}
odbc_close_all();
?>
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
?>
<h3>Sponsored Project</h3>
<p><ul><li><a href="acctsponon.php">Ongoing Projects</a></li><li><a href="acctsponcl.php">Closed Projects</a></li></ul></p>
<h3>Consultancy Project</h3>
<p><ul><li><a href="acctconson.php">Ongoing Projects</a></li><li><a href="acctconscl.php">Closed Projects</a></li></ul></p>
<h3>PCF</h3>
<p><ul><li><a href="acctpcfsum.php">PCF Account</a></li></ul></p>
<h3>RMF</h3>
<p><ul><li><a href="acctrmfsum.php">RMF Account</a></li></ul></p>
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
<!--</div>
<!--</div>-->
</div>

</body>
<script type="text/javascript">
var newwindow;
function poptastic(url)
{
	newwindow=window.open(url,'name','height=300,width=800,scrollbars=yes,toolbar=no, menubar=no');
	if (window.focus) {newwindow.focus()}
}
</script>
</html>
