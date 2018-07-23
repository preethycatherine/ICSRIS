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
<form id="form1" name="form1" method="post" action="acctrmfresult.php">
<?php
if (!isset($_COOKIE["PHPSESSID"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
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
	header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
	exit;

}
?>
<div id="outer">
	<!--<div id="menu">-->
	<!--<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h2>
	</div>-->
	<!--=========== BEGIN MENU SECTION ================-->
			 <script src="https://www.w3schools.com/lib/w3.js"></script>
			<div w3-include-html="menu_super.html"></div>
				<script>
				w3.includeHTML();
				</script>
		    <!--=========== END MENU SECTION ================--> 

	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
				
<div align="center"><h3>RMF ACCOUNTS REPORT SCREEN</h3></div>
<?php
if (!isset($_COOKIE["PHPSESSID"])) 
{
echo "cookievalue:".$_COOKIE["PHPSESSID"];

}
else
{

//session_start();

$instid=$_SESSION['instid'];

$dsn="RMFACCT";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
if(isset($_SESSION["sponresult"]))
{
unset($_SESSION["sponresult"]);
}
if(isset($_SESSION["consresult"]))
{
unset($_SESSION["consresult"]);
}
if(isset($_SESSION["pcfresult"]))
{
unset($_SESSION["pcfresult"]);
}
if(isset($_SESSION["rmfresult"]))
{
unset($_SESSION["rmfresult"]);
}
unset($_SESSION['rmfid']);
//$insid=$_SESSION['instid'];
$sqlquery="select distinct(irno) as irno from coor_details order by irno";
$process=odbc_exec($sqlconnect,$sqlquery);
?>
<div align="center">
<table width="75%" border="1" cellspacing="2" cellpadding="2" align="center">
  <tr class="rowA">
    <td width="40%" align="left" ><input name=opinion[] type=checkbox value=ck1> INSTID</td>
    <td width="60%"  colspan="2"><select name=instid size=1><OPTION value=''> INSTID   </OPTION>
<?php
while(odbc_fetch_row($process))
{
$INSTID = odbc_result($process,"irno");
echo "<OPTION value='$INSTID'>".$INSTID ."</OPTION>";
}
?>
</select></td>
</tr>
<?php
odbc_close_all();
$sqlquery1="select distinct(name) as pname from coor_details where name <> '' order by name";
$process1=odbc_exec($sqlconnect,$sqlquery1);
?> 
  <tr class="rowB">
    <td><input type=checkbox name=opinion[] value=ck2 /> Coordinator </td>
	<td colspan="2"><select name=pname> <option value=''>Coordinator Name</option>
<?php
while(odbc_fetch_row($process1))
{
$PNAME=odbc_result($process1,"pname");
echo "<option value='$PNAME'>".$PNAME ."</option>";
}
?>
</select></td>
  </tr>
<?php
odbc_close_all();

$sqlquery2="select distinct(dept) as dept from coor_details where dept <> '' order by dept";
$process2=odbc_exec($sqlconnect,$sqlquery2)
?>
<tr class="rowA">
<td width="40%" align="left" ><input name=opinion[] type=checkbox value=ck3> Department </td>
<td width="60%"  colspan="2"><select name=dept size=1><OPTION value=''> DEPARTMENT NAME   </OPTION>
<?php
while(odbc_fetch_row($process2))
{
$dept=odbc_result($process2,"dept");
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
<td  colspan="3" align="left" ><input name=opinion[] type=checkbox value=ck4> All Account  </td>
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
<?php
}
}
?>


<div id="footer">
<p></p>
</div>
</div>
</form>
</body>
</html>