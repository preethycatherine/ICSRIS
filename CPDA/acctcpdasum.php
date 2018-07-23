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
<tr   >
<th width="25%" ><div  align="right" style="color:#2A0000"> IIRNO :</div></th>
<td width="25%"><b><div align="left" ><?php echo "00$instid1" ?></div></b></td>
<th width="20%" ><div  align="right" style="color:#2A0000">Date :</div></th>
<td><b><div align="left"><?php echo "$today_date" ?></div></b></td>
</tr>
<tr>
<th ><div  align="right" style="color:#2A0000">CoordinatorName :</div></th>
<td><b><div align="left"><?php echo "$name" ?></div></b></td>
<th ><div  align="right" style="color:#2A0000">Department :</div></th>
<td><b><div align="left"><?php echo "$dept " ?></div></b></td>
</tr>
</table>
<div>
<nobr><h4>	<?php $qs = "start=$mysqlStart&end=$mysqlEnd&amount=$given_amount";?><a href='acctcpdasum.php?<?php echo $qs;?>' ><span style="background-color:#F6EECC">AccountSum</span></a> | <a href='cpdareceipts.php?<?php echo $qs;?>'>ReceiptDetails</a>  |  <a href='cpdaexpenditure.php?<?php echo $qs;?>'>ExpenditureDetails</a>  |  <a href='cpdacommit.php?<?php echo $qs;?>'>CommitmentDetails </a> </h4></nobr></div>
</div>
<?php
//die();
mysql_close();
?>
<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

  $sqlquery1="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='530'"; 
$process1=mysql_query($sqlquery1);


while($row=mysql_fetch_array($process1))
{
$expenditure1=$row["total"];
 $sqlquery11="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='530'"; 
$process11=mysql_query($sqlquery11);
while($row=mysql_fetch_array($process11))
{
$receipt1=$row["total1"];
}
}
$net1 = $expenditure1-$receipt1;



mysql_close();
?>
<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery2="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='531'"; 
$process2=mysql_query($sqlquery2);


while($row=mysql_fetch_array($process2))
{
$expenditure2=$row["total"];
$sqlquery22="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='531'"; 
$process22=mysql_query($sqlquery22);
while($row=mysql_fetch_array($process22))
{
$receipt2=$row["total1"];
}
}
$net2 = $expenditure2-$receipt2;



mysql_close();
?>
<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery3="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='532'"; 
$process3=mysql_query($sqlquery3);


while($row=mysql_fetch_array($process3))
{
$expenditure3=$row["total"];
$sqlquery33="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='532'"; 
$process33=mysql_query($sqlquery33);
while($row=mysql_fetch_array($process33))
{
$receipt3=$row["total1"];
}
}
$net3 = $expenditure3-$receipt3;



mysql_close();
?>
<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery4="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='533'"; 
$process4=mysql_query($sqlquery4);


while($row=mysql_fetch_array($process4))
{
$expenditure4=$row["total"];
$sqlquery44="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='533'"; 
$process44=mysql_query($sqlquery44);
while($row=mysql_fetch_array($process44))
{
$receipt4=$row["total1"];
}
}
$net4 = $expenditure4-$receipt4;



mysql_close();
?>
<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery5="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='534'"; 
$process5=mysql_query($sqlquery5);


while($row=mysql_fetch_array($process5))
{
$expenditure5=$row["total"];
$sqlquery55="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='534'"; 
$process55=mysql_query($sqlquery55);
while($row=mysql_fetch_array($process55))
{
$receipt5=$row["total1"];
}
}
$net5 = $expenditure5-$receipt5;



mysql_close();
?>
<?php


mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery6="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='535'"; 
$process6=mysql_query($sqlquery6);


while($row=mysql_fetch_array($process6))
{
$expenditure6=$row["total"];
$sqlquery66="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='535'"; 
$process66=mysql_query($sqlquery66);
while($row=mysql_fetch_array($process66))
{
$receipt6=$row["total1"];
}
}
$net6 = $expenditure6-$receipt6;



mysql_close();
?>
<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery7="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='536'"; 
$process7=mysql_query($sqlquery7);


while($row=mysql_fetch_array($process7))
{
$expenditure7=$row["total"];
$sqlquery77="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='536'"; 
$process77=mysql_query($sqlquery77);
while($row=mysql_fetch_array($process77))
{
$receipt7=$row["total1"];
}
}
$net7 = $expenditure7-$receipt7;



mysql_close();
?>

<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery8="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='537'"; 
$process8=mysql_query($sqlquery8);


while($row=mysql_fetch_array($process8))
{
$expenditure8=$row["total"];
$sqlquery88="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='537'"; 
$process88=mysql_query($sqlquery88);
while($row=mysql_fetch_array($process88))
{
$receipt8=$row["total1"];
}
}$net8 = $expenditure8-$receipt8;



mysql_close();
?>
<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery9="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='540'"; 
$process9=mysql_query($sqlquery9);


while($row=mysql_fetch_array($process9))
{
$expenditure9=$row["total"];
$sqlquery99="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='540'"; 
$process99=mysql_query($sqlquery99);
while($row=mysql_fetch_array($process99))
{
$receipt9=$row["total1"];
}
}$net9 = $expenditure9-$receipt9;



mysql_close();
?>
<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery10="SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='599'"; 
$process10=mysql_query($sqlquery10);


while($row=mysql_fetch_array($process10))
{
$expenditure10=$row["total"];
$sqlquery100="SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."' AND PayCode ='599'"; 
$process100=mysql_query($sqlquery100);
while($row=mysql_fetch_array($process100))
{
$receipt10=$row["total1"];
}
}$net10 = $expenditure10-$receipt10;



mysql_close();
?>
<?php

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$sqlquery9="SELECT SUM(CommitAmount)as commit FROM expenditure_details WHERE StaffNo LIKE '".$instid1."' AND CommitDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'"; 
$process9=mysql_query($sqlquery9);


while($row=mysql_fetch_array($process9))
{
$totalcommitment=$row["commit"];
}

mysql_close();
?>
<?php


$totalexpenditure=$expenditure1+$expenditure2+$expenditure3+$expenditure4+$expenditure5+$expenditure6+$expenditure7+$expenditure8+$expenditure9+$expenditure10;
$totalreceipt=$receipt1+$receipt2+$receipt3+$receipt4+$receipt5+$receipt6+$receipt7+$receipt8+$receipt9+$receipt10;
$totalnet=$net1+$net2+$net3+$net4+$net5+$net6+$net7+$net8+$net9+$net10;

 $balance=$given_amount-$totalnet-$totalcommitment;


?>
<table width="90%" border="1" align="center">
  <tr>
    <th colspan="4"><div align="center">Total Amount : <?php echo "$given_amount" ?></div></th>
  </tr>
  <tr>
    <th width="34%"><div align="center">Code</div></th>
    <th width="23%"><div align="center">Expenditure</div></th>
    <th width="23%"><div align="center">Receipts</div></th>
    <th width="23%"><div align="center">Balance</div></th>
  </tr>
  <tr class="rowA"  >
    <th><div align="left">530 (TA/DA-International Conference) </div></th>
    <td><div align="right"><?php echo "$expenditure1"; ?></div></td>
    <td><div align="right"><?php echo "$receipt1"; ?></div></td>
    <td><div align="right"><?php echo "$net1"; ?></div></td>
  </tr>
  <tr class="rowB"  >
    <th><div align="left">531 (TA/DA- Conference Regn Fee) </div></th>
    <td><div align="right"><?php echo "$expenditure2"; ?></div></td>
    <td><div align="right"><?php echo "$receipt2"; ?></div></td>
    <td><div align="right"><?php echo "$net2"; ?></div></td>
  </tr>
  <tr class="rowA"  >
    <th><div align="left">532 (TA/DA-National Conference )</div></th>
    <td><div align="right"><?php echo "$expenditure3"; ?></div></td>
    <td><div align="right"><?php echo "$receipt3"; ?></div></td>
    <td><div align="right"><?php echo "$net3"; ?></div></td>
  </tr>
  <tr class="rowB"  >
    <th><div align="left">533 (TA/DA-  Conference Regn Fee) </div></th>
    <td><div align="right"><?php echo "$expenditure4"; ?></div></td>
    <td><div align="right"><?php echo "$receipt4"; ?></div></td>
    <td><div align="right"><?php echo "$net4"; ?></div></td>
  </tr>
  <tr class="rowA"  >
    <th><div align="left">534 (Books Reimbrusment Fees) </div></th>
    <td><div align="right"><?php echo "$expenditure5"; ?></div></td>
    <td><div align="right"><?php echo "$receipt5"; ?></div></td>
    <td><div align="right"><?php echo "$net5"; ?></div></td>
  </tr>
  <tr class="rowB"  >
    <th><div align="left">535 (Membership Fees) </div></th>
    <td><div align="right"><?php echo "$expenditure6"; ?></div></td>
    <td><div align="right"><?php echo "$receipt6"; ?></div></td>
    <td><div align="right"><?php echo "$net6"; ?></div></td>
  </tr>
  <tr class="rowA"  >
    <th><div align="left">536 (Contingency) </div></th>
    <td><div align="right"><?php echo "$expenditure7"; ?></div></td>
    <td><div align="right"><?php echo "$receipt7"; ?></div></td>
    <td><div align="right"><?php echo "$net7"; ?></div></td>
  </tr>
  <tr class="rowB"  >
    <th><div align="left">537 (Others) </div></th>
    <td><div align="right"><?php echo "$expenditure8"; ?></div></td>
    <td><div align="right"><?php echo "$receipt8"; ?></div></td>
    <td><div align="right"><?php echo "$net8"; ?></div></td>
  </tr>
  <tr class="rowA"  >
    <th><div align="left">540 (Others) </div></th>
    <td><div align="right"><?php echo "$expenditure9"; ?></div></td>
    <td><div align="right"><?php echo "$receipt9"; ?></div></td>
    <td><div align="right"><?php echo "$net9"; ?></div></td>
  </tr>
  <tr class="rowB"  >
    <th><div align="left">599 (Others) </div></th>
    <td><div align="right"><?php echo "$expenditure10"; ?></div></td>
    <td><div align="right"><?php echo "$receipt10"; ?></div></td>
    <td><div align="right"><?php echo "$net10"; ?></div></td>
  </tr>
  <tr class="rowA"  >
    <th><div align="left">Others </div></th>
    <td><div align="right"><?php echo "$expenditure11"; ?></div></td>
    <td><div align="right"><?php echo "$receipt11"; ?></div></td>
    <td><div align="right"><?php echo "$net11"; ?></div></td>
  </tr>
  <tr class="rowA"  >
    <th><div align="left">Total</div></th>
    <td><div align="right"><?php echo "$totalexpenditure"; ?></div></td>
    <td><div align="right"><?php echo "$totalreceipt"; ?></div></td>
    <td><div align="right"><?php echo "$totalnet"; ?></div></td>
  </tr>
  <tr class="rowB"  >
    <th colspan="3"><div align="right">Total Commitment </div>
        <div align="right"></div>
      <div align="right"></div></th>
    <td><div align="right"><?php echo "$totalcommitment"; ?></div></td>
  </tr>
  <tr>
    <th colspan="3" ><div align="right">Balance after Total Expenditure + Commitments :</div></th>
    <th ><div align="right"><?php echo "$balance" ?></div></th>
  </tr>
</table>
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