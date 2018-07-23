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
<form id="form1" name="form1" method="post" action="acctcpdaresult.php">

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
  <h3>CPDA ACCOUNTS REPORT SCREEN</h3>
</div>
<?php

session_start();

$dsn="eservices";
$username="cpdaread";
$password="Cpda@Read!1";
if(isset($_SESSION["cpdaresult"]))
{
unset($_SESSION["cpdaresult"]);
}

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");
$sqlquery="select distinct(StaffNo) as iirno from staff_details where Status='Active' order by StaffNo";
$process=mysql_query($sqlquery);
?>
<div align="center">
<table width="75%" border="1" cellspacing="2" cellpadding="2" align="center">
  <tr class="rowA">
    <td width="40%" align="left" ><input name=opinion[] type=checkbox value="ck1"> INSTID</td>
    <td width="60%"  colspan="2"><select name=instid size=1><OPTION value=''> INSTID   </OPTION>
<?php
while($row=mysql_fetch_array($process))
{
$INSTID = $row["iirno"];
$INSTID1 ="00$INSTID";
echo "<OPTION value='$INSTID'>".$INSTID1 ."</OPTION>";
}
?>
</select></td>
</tr>
<?php
mysql_close();
$dsn="eservices";
$username="cpdaread";
$password="Cpda@Read!1";
mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");
$sqlquery1="select distinct(StaffName) as pname from staff_details where StaffName <> '' && Status='Active'  order by StaffName";
$process1=mysql_query($sqlquery1);
?> 
  <tr class="rowB">
    <td width="40%" align="left"><input type=checkbox name=opinion[] value="ck2" /> Coordinator </td>
	<td width="60%" colspan="2"><select name=pname> <option value=''>Coordinator Name</option>
<?php
while($row=mysql_fetch_array($process1))
{

$PNAME=$row["pname"];
echo "<option value='$PNAME'>".$PNAME ."</option>";
}
?>
</select></td>
  </tr>
<?php
mysql_close();
$dsn="eservices";
$username="cpdaread";
$password="Cpda@Read!1";
mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");
$sqlquery2="select distinct(Department) as dept from staff_details  where Department <> '' && Status='Active' order by Department";
$process2=mysql_query($sqlquery2);
?>
<tr class="rowA">
<td width="40%" align="left" ><input name=opinion[] type=checkbox value="ck3"> Department </td>
<td width="60%"  colspan="2"><select name=dept size=1><OPTION value=''> DEPARTMENT NAME   </OPTION>
<?php
while($row=mysql_fetch_array($process2))
{
$dept=$row["dept"];
{
echo "<option value='$dept'>".$dept."</option><p>\n";
}
}
?>
</select></td>
<?php

?>
</tr>
<tr class="rowB">
<td  colspan="3" align="left" ><input name=opinion[] type=checkbox value="ck4"> All Account  </td>
</tr>
<tr class="rowA">
<td colspan="3"><div align="center"><input type=submit name=submitt value=GetResult>&nbsp;&nbsp;<input type=reset name=Reset value=Reset></div>
</td>
</tr>
</table>
 
</table>
</div>

 </div>
</div>
<div id="footer">
<p></p>
</div>
</div>
</form>


<div id="secondaryContent">
<div align="right" class="rowA"><a href="../signout.php"><strong>Signout</strong></a></div>
<h3>CPDA ACCOUNT</h3>
<p><ul><li><a href="../icsrisacct.php">ICSR HOME PAGE</a></li></ul></p>

<div id="footer">
</div>
</div>
</body>
</html>

