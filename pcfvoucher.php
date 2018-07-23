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
$dsn="PCFACCT";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
$instid=$_SESSION["pcfid"];
$usermode=$_SESSION['usermode'];
$instid1=$instid;


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
<tr>
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
</tr></table><div>
<nobr><h4>	<a href="acctpcfsum.php" >AccountSum</a> | <a href="pcfreceipts.php">ReceiptDetails</a>  |  <a href="pcfvoucher.php"><span style="background-color:#F6EECC">ExpenditureDetails</span></a>  |  <a href="pcfstafcommit.php"><u>StafCommitmentDetails</u></a> |  <a href="pcfcommit.php"><u>OthersCommitmentDetails</u></a> </h4></nobr></div>
<table  border="1" width="100%">
<tr>
<th  colspan="6"><div align="center">Expenditure Details</div></th>
</tr>
  <tr>
    <th><div align="center">Date</div></th>
    <th><div align="center">VRNO</div></th>
    <th><div align="center">Party Name</div></th>
    <th><div align="center">Purpose</div></th>
    <th><div align="center">HEAD</div></th>
    <th><div align="center">Amount</div></th>
  </tr>
<?php
//die();
odbc_close_all();
$count=1;
$sqlconnect=odbc_connect("PCFACCT","sa","IcsR@123#") or die("ODBC Connection Failed");
$strsq1="select CONVERT(varchar,vrdate,105) 'DATE',vrno,partyname,purpose,head,amount from corpvr where iirno like '$instid' and [check]='U' order by vrdate Desc";
$process1=odbc_exec($sqlconnect,$strsq1) or die("<br>Query Execution failed");

while(odbc_fetch_row($process1))
{
$dat = odbc_result($process1,"DATE");
$vrno = odbc_result($process1,"vrno");
$ptname = odbc_result($process1,"partyname");
$purpose = odbc_result($process1,"purpose");
$head = odbc_result($process1,"head");
$amount = odbc_result($process1,"amount");
$vrsum=$vrsum+$amount;
$amount=number_format($amount,2);
$count = fmod($count,2);

if($count==0)
{
?>
<tr class="rowA">
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="center"><?php echo "$vrno"; ?></div></td>
    <td><div align="center"><?php echo "$ptname"; ?></div></td>
    <td><div align="center"><?php echo "$purpose"; ?></div></td>
    <td><div align="center"><?php echo "$head"; ?></div></td>
    <td><div align="right"><?php echo "$amount"; ?></div></td>
  </tr>
<?php
 }
else
{
?>
<tr class="rowB">
    <td><div align="center"><?php echo "$dat"; ?></div></td>
    <td><div align="center"><?php echo "$vrno"; ?></div></td>
    <td><div align="center"><?php echo "$ptname"; ?></div></td>
    <td><div align="center"><?php echo "$purpose"; ?></div></td>
    <td><div align="center"><?php echo "$head"; ?></div></td>
    <td><div align="right"><?php echo "$amount"; ?></div></td>
  </tr>
<?php
}
$count = $count + 1;
//echo "$count";
}

?>
<tr>
<th colspan="5" ><div align="right">Total :</div></th>
<th ><div align="right"><?php echo number_format("$vrsum",2) ?></div></th>
</tr>
</table>
<?php
}
?>
</div>
 </div>
</div>

<?php

//}
?>
<div id="footer">
<p></p>
</div>

</body>
</html>
