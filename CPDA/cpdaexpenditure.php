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
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>
<body>
<div id="outer">
	<div id="header">
		<h1>CPDA Accounts </h1>
		<h1>Indian Institute of Technology Madras, Chennai</h1>
		<h2>Information System</h2>
	</div>
	<div id="menu">
	<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">CPDA Accounts Information System</div></h2>
	</div>

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

<table width="90%"  style="background-color:#F6EECC">
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
<nobr><h4>	<?php $qs = "start=$mysqlStart&end=$mysqlEnd&amount=$given_amount";?><a href='acctcpdasum.php?<?php echo $qs;?>' >AccountSum</a> | <a href='cpdareceipts.php?<?php echo $qs;?>'>ReceiptDetails</a>  |  <a href='cpdaexpenditure.php?<?php echo $qs;?>'><span style="background-color:#F6EECC">ExpenditureDetails</span></a>  |  <a href='cpdacommit.php?<?php echo $qs;?>'> CommitmentDetails </a> </h4></nobr></div>
<table  border="1" width="90%" align="center">
  <tr>
    <th  colspan="8" ><div align="center" >Expenditure Details</div></th>
  </tr>
  <tr>
    <th><div align="center">Cheque Date</div></th>
    <th><div align="center">ChequeNo</div></th>
    <th><div align="center">ChequeName</div></th>
    <th><div align="center">VoucherNo </div></th>
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
  $sqlquery1="SELECT ChequeDate,ChequeNo,ChequeName,VoucherNo,PoSanction,Remarks,PayCode,PayAmount FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate BETWEEN '".$mysqlStart."' AND '".$mysqlEnd."'  order by BrDate "; 
$process1=mysql_query($sqlquery1);

while($row=mysql_fetch_array($process1))
{
$date=$row["ChequeDate"];
$ChequeNo=$row["ChequeNo"];
$ChequeName=$row["ChequeName"];
$VoucherNo =$row["VoucherNo"];
$purpose=$row["PoSanction"];
$Remarks=$row["Remarks"];
$code=$row["PayCode"];
$amount=$row["PayAmount"];

$cmsum=$cmsum+$amount;
$amount=number_format($amount,2);
$count = fmod($count,2);



if($count==0)
{
?>
  <tr class="rowA">
    <td><div align="center"><?php echo "$date"; ?></div></td>
    <td><div align="center"><?php echo "$ChequeNo"; ?></div></td>
    <td><div align="center"><?php echo "$ChequeName"; ?></div></td>
    <td><div align="center"><?php echo "$VoucherNo"; ?></div></td>
    <td><div align="right"><?php echo "$purpose"; ?></div></td>
    <td><div align="right"><?php echo "$Remarks"; ?></div></td>
    <td><div align="center"><?php echo "$code"; ?></div></td>
    <td><div align="center"><?php echo "$amount"; ?></div></td>
  </tr>
  <?php
 }
else
{
?>
  <tr class="rowB">
    <td><div align="center"><?php echo "$date"; ?></div></td>
    <td><div align="center"><?php echo "$ChequeNo"; ?></div></td>
    <td><div align="center"><?php echo "$ChequeName"; ?></div></td>
    <td><div align="center"><?php echo "$VoucherNo"; ?></div></td>
    <td><div align="right"><?php echo "$purpose"; ?></div></td>
    <td><div align="right"><?php echo "$Remarks"; ?></div></td>
    <td><div align="center"><?php echo "$code"; ?></div></td>
    <td><div align="center"><?php echo "$amount"; ?></div></td>
  </tr>
  <?php
}
$count = $count + 1;
//echo "$count";
}
mysql_close();

?>
  <tr>
    <th colspan="7" ><div align="right">Total :</div></th>
    <th ><div align="center"><?php echo number_format("$cmsum",2) ?></div></th>
  </tr>
</table>
</div>
 </div>
 </div>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="../signout.php"><strong>Signout</strong></a></div>
<h3>CPDA ACCOUNT</h3>
<p><ul><li><a href="../icsrisacct.php">ICSR HOME PAGE</a></li></ul></p>
<p><ul>
  <li><a href="batch.php">CPDA HOME PAGE</a></li>
</ul></p>
<div id="footer">
</div>
</div>
</div>
</body>
</html>