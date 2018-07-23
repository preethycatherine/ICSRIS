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
	<!--<div w3-include-html="menu.html"></div>-->
	<div w3-include-html="menu.php"></div>
		<script>
		w3.includeHTML();
		</script>
	<!--=========== END MENU SECTION ================--> 

	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
				
				<div align="center">
				  <h3> CPDA Account Statement </h3>
				</div>
<div align="center">
<?php
session_start();


$dsn="eservices";
$username="cpdaread";
$password="Cpda@Read!1";

 $instid1= $_SESSION['instid'];
  $mysqlStart= $_GET['start'];
  $mysqlEnd= $_GET['end'];
   $given_amount= $_GET['amount'];
 

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");


$sqlquery="select StaffName,Department  from staff_details where StaffNo LIKE '".$instid1."' and Status='Active'";
$process=mysql_query($sqlquery);
//$strsq1="SELECT NAME,DEPT FROM CO_NME WHERE IIRNO LIKE '$instid1'";


//$process=odbc_exec($sqlconnect,$strsq1) or die("<br>connection failed");

$name="";
$dept="";

while($row=mysql_fetch_array($process))
{
$name=$row["StaffName"];
$dept=$row["Department"];
}
$today_date=date("Y/m/d");
?>
<table width="100%" border="1">
<tr>
<th width="25%" ><div  align="right" style="color:#2A0000"> IIRNO :</div></th>
<td width="25%"><b><div align="left" ><?php echo "00$instid1" ?></div></b></td>
<th width="20%" ><div  align="right" style="color:#2A0000">Date :</div></th>
<td><b><div align="left"><?php echo "$today_date" ?></div></b></td>
</tr>
<tr>
<th ><div  align="right" style="color:#2A0000">CoordinatorName :</div></th>
<td><b><div align="left"><?php echo "$name" ?></div></b></td>
<th ><div  align="right" style="color:#2A0000">Department :</div></th>
<td><b><div align="left"><?php echo "$dept" ?></div></b></td>
</tr></table><div>
<nobr><h4>	<?php $qs = "start=$mysqlStart&end=$mysqlEnd&amount=$given_amount";?><a href='acctcpdasum.php?<?php echo $qs;?>' >AccountSum</a> | <a href='cpdareceipts.php?<?php echo $qs;?>'>ReceiptDetails</a>  |  <a href='cpdaexpenditure.php?<?php echo $qs;?>'>ExpenditureDetails</a>  |  <a href='cpdacommit.php?<?php echo $qs;?>'><span style="background-color:#F6EECC"> CommitmentDetails </span></a> </h4></nobr></div>
<table  border="1" width="100%" align="center">
  <tr>
    <th  colspan="6" bgcolor=""><div align="center" >Commitment Details</div></th>
  </tr>
  <tr>
    <th><div align="center">Date</div></th>
    <th><div align="center">Posanction</div></th>
    <th><div align="center">Remarks</div></th>
    <th><div align="center">Code</div></th>
    <th><div align="center">Amount</div></th>
  </tr>
  <?php
$dsn="eservices";
$username="cpdaread";
$password="Cpda@Read!1";
mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");
$count=1;
$cmsum=0;
$cmsum=number_format($cmsum,2);
  $sqlquery1="SELECT PayCode,PoSanction,CommitAmount as amount,CommitDate,Remarks FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND CommitDate   BETWEEN '".$mysqlStart."' AND '".$mysqlEnd."' AND CommitAmount>0 order by CommitDate "; 
$process1=mysql_query($sqlquery1);


while($row=mysql_fetch_array($process1))
{
$date=$row["CommitDate"];
$code=$row["PayCode"];
$amount=$row["amount"];
$purpose=$row["PoSanction"];
$remarks=$row["Remarks"];


$cmsum=$cmsum+$amount;
$amount=number_format($amount,2);
$count = fmod($count,2);

if($count==0)
{
?>
  <tr class="rowA">
    <td><div align="center"><?php echo "$date"; ?></div></td>
    &lt;
    <td><div align="center"><?php echo "$purpose"; ?></div></td>
    <td><div align="center"><?php echo "$remarks"; ?></div></td>
    <td><div align="center"><?php echo "$code"; ?></div></td>
    <td><div align="right"><?php echo "$amount"; ?></div></td>
  </tr>
  <?php
 }
else
{
?>
  <tr class="rowB">
    <td><div align="center"><?php echo "$date"; ?></div></td>
    <td><div align="center"><?php echo "$purpose"; ?></div></td>
    <td><div align="center"><?php echo "$remarks"; ?></div></td>
    <td><div align="center"><?php echo "$code"; ?></div></td>
    <td><div align="right"><?php echo "$amount"; ?></div></td>
  </tr>
  <?php
}
$count = $count + 1;
mysql_close();
}
?>
  <tr>
    <th colspan="4" ><div align="right">Total :</div></th>
    <th ><div align="right"><?php echo number_format("$cmsum",2) ?></div></th>
  </tr>
</table>
</div>
</div>
 </div>
<div id="secondaryContent">
<div id="footer">
</div>
</div>
</div>
</body>
</html>
