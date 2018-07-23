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
<form id="form1" name="form1" method="post" action="acctspresult.php">
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
	header('location: http://icsris.iitm.ac.in/sessionout.php');
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
				
<div align="center"><h3>SPONSORED PROJECTS REPORT SCREEN</h3></div>
<?php
if (!isset($_COOKIE["PHPSESSID"])) 
{
echo "cookievalue:".$_COOKIE["PHPSESSID"];

}
else
{
session_start();

$instid=$_SESSION['instid'];

$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$username,$password) or die("Connection Failed");
//$insid=$_SESSION['instid'];
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
$sqlquery="select distinct(agen_code),agen_name FROM agen where agen_code<>'' ORDER BY agen_code";
$process=odbc_exec($sqlconnect,$sqlquery);
}
?>
<div align="center">
<table width="100%" border="1" cellspacing="2" cellpadding="2" align="center">
  <tr class="rowA">
    <td width="60%" align="left" ><input name=opinion[] type=checkbox value=ck1><b> Sponsor</b></td>
    <td width="40%"  colspan="2"><select name=sponsor size=1><OPTION value=''> SPONSOR   </OPTION>
<?php
while(odbc_fetch_row($process))
{
$AGEN = odbc_result($process,"agen_code");
echo "<OPTION value='$AGEN'>".$AGEN ."</OPTION>";
}
?>
</select></td>
</tr>
<?php
odbc_close_all();
$sqlacct=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC connection Accts failed");
$sqlquery1="select distinct(coor_name) FROM mstlst  where coor_name <>'' ORDER BY coor_name";
$process1=odbc_exec($sqlacct,$sqlquery1) or die ("Query Exection Coor_name Failed");
?> 
  <tr class="rowB">
    <td><input type=checkbox name=opinion[] value=ck2 /><b> Coordinator </b></td>
	<td colspan="2"><select name=coordin> <option value=''>Coordinator Name</option>
<?php
while(odbc_fetch_row($process1))
{
$COOR=odbc_result($process1,"coor_name");
echo "<option value='$COOR'>".$COOR ."</option>";
}
?>
</select></td>
  </tr>
<?php
odbc_close_all();
$sqlacct=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC connection Accts failed");
//$sqlconnect=odbc_connect($dsn,$username,$password);
$sqlquery2="select dept,dept_name from dept order by dept";
//echo "$sqlquery2";
$process2=odbc_exec($sqlacct,$sqlquery2) or die ("Query Exection Deptname Failed");
?>
<tr class="rowA">
<td width="40%" align="left" ><input name=opinion[] type=checkbox value=ck3><b> Department </b></td>
<td width="60%"  colspan="2"><select name=dept size=1><OPTION value=''> DEPARTMENT NAME   </OPTION>
<?php
while(odbc_fetch_row($process2))
{
$DPTC=odbc_result($process2,"dept");
$DPT=odbc_result($process2,"dept_name");
{
echo "<option value='$DPTC'>".$DPTC."-->".$DPT."</option><p>\n";
}
}
?>
</select></td>
</tr>
<tr class="rowB">
<td width="40%" align="left" ><input name=opinion[] type=checkbox value=ck4><b> Project Value </b></td>
<td width="60%"  colspan="2"><input type=text name=prjvalue id=prjvalue ></td>
</tr>
<tr class="rowA">
<td width="40%" align="left" ><input name=opinion[] type=checkbox value=ck7><b> Project Number</b></td>
<td width="60%"  colspan="2"><input type=text name=prjnumber id=prjnumber ></td>
</tr>
<tr class="rowB">
<td width="40%" align="left" ><input name=opinion[] type=checkbox value=ck5><b> On Going Projects </b></td>
<td width="40%" align="left" ><input name=opinion[] type=checkbox value=ck6><b> Closed Projects </b></td>
<td width="40%" align="left" ><input name=opinion[] type=checkbox value=ck8><b> All Projects </b></td>
</tr>
<tr class="rowA">
<td colspan="3">
<div align="center">
<input name=radiobutton type=radio value=FT /><b> From</b>
 <select name=FROM>
<option> 0001 </option> <option> 0102 </option><option> 0203 </option>
<option> 0304 </option> <option> 0405 </option><option> 0506 </option>
<option> 0607 </option> <option> 0708 </option><option> 0809 </option>
<option> 0910 </option> <option> 1011 </option> <option> 1112 </option> <option> 1213 </option>
<option> 1314 </option> <option> 1415 </option> <option> 1516 </option><option> 1617 </option><option> 1718</option> <option> 1819</option> 
</select>
<b>To</b><select name=TO >
</option> <option> 1819</option> <option> 1617 </option></option> <option> 1516 </option> <option> 1415 </option>
<option> 1314 </option><option> 1213 </option> <option> 1112 </option>
<option>1011</option> <option>0910</option> 
<option>0809</option> <option>0708</option><option>0607</option>
<option>0506</option> <option>0405</option><option>0405</option>
<option>0203</option> <option>0102</option><option>0001</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name=radiobutton type=radio value=FY />
<b>For the Year </b>
<select name=FORYR size=1  >
<option> 1819</option><option> 1718</option></option> <option> 1617 </option></option> <option> 1516 </option> <option> 1415 </option>
<option> 1314 </option> <option> 1213 </option> <option> 1112 </option>
<option>1011</option> <option>0910</option>
<option>0809</option> <option>0708</option><option>0607</option>
<option>0506</option> <option>0405</option><option>0405</option>
<option>0203</option> <option>0102</option><option>0001</option>
</select>
</div>
</td>
</tr>
<tr class="rowA">
<td colspan="3"><div align="center"><input type=submit name=submitt value=GetResult>&nbsp;&nbsp;<input type=reset name=Reset value=Reset></div>
</td>
</tr>
</table>

</table>
<?PHP
}
?>
</div>

 </div>
</div>



<div id="footer">
<p></p>
</div>
</div>
</form>
</body>
</html>
