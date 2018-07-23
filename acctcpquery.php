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
<form id="form1" name="form1" method="post" action="acctcpresult.php">
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
				
<div align="center"><h3>CONSULTANCY PROJECTS REPORT SCREEN</h3></div>
<?php
if (!isset($_COOKIE["PHPSESSID"])) 
{
echo "cookievalue:".$_COOKIE["PHPSESSID"];

}
else
{
session_start();

$instid=$_SESSION['instid'];

$dsn="FACCT1DSN";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$username,$password);
$sqlconnect1=odbc_connect("FACCTDSN",$username,$password);
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
$sqlquery="select distinct(substring(cprno,13,4)) as con_code from cmstlst";
$process=odbc_exec($sqlconnect1,$sqlquery);
}
?>
<div align="center">
<table width="100%" border="1" cellspacing="2" cellpadding="2" align="center">
  <tr class="rowA">
    <th width="40%" align="left" ><input name=opinion[] type=checkbox value=ck1> AGENCY</th>
	<td width="60%"  colspan="2"><select name=agency size=1><OPTION value=''> AGENCY   </OPTION>
<?php
while(odbc_fetch_row($process))
{
$AGEN = odbc_result($process,"con_code");
echo "<OPTION value='$AGEN'>".$AGEN ."</OPTION>";
}
?>
</select></td>
</tr>
<?php
odbc_close_all();
//$sqlquery1="select distinct(coor_name) FROM coorcod ORDER BY coor_name";
$sqlconnect1=odbc_connect("FACCTDSN",$username,$password);
$sqlquery1="select distinct(coor_name1),instid from cmstlst where instid <>'' and coor_name1<>'' ORDER BY coor_name1";
$process1=odbc_exec($sqlconnect1,$sqlquery1) or die("Query Execution failed");
?> 
  <tr class="rowB">
    <th><input type=checkbox name=opinion[] value=ck2 /> Coordinator </th>
	<td colspan="2"><select name=coordin> <option value=''>Coordinator Name</option>
<?php
while(odbc_fetch_row($process1))
{
$COOR=odbc_result($process1,"coor_name1");
$COOR1=odbc_result($process1,"instid");
echo "<option value='$COOR1'>".$COOR ."</option>";
}
?>
</select></td>
  </tr>
<?php
odbc_close_all();
$sqlconnect=odbc_connect("FACCTDSN",$username,$password) or die("odbc connection failed at dept");
$sqlquery2="select dept,dept_name from dept order by dept";
$process2=odbc_exec($sqlconnect,$sqlquery2);
?>
<tr class="rowA">
<th width="40%" align="left" ><input name=opinion[] type=checkbox value=ck3> Department </th>
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
<th width="40%" align="left" ><input name=opinion[] type=checkbox value=ck4> Project Value  </th>
<td width="60%"  colspan="2"><input type=text name=prjvalue id=prjvalue ></td>
</tr>
<tr class="rowA">
<th width="40%" align="left" ><input name=opinion[] type=checkbox value=ck10> Project Number</th>
<td width="60%"  colspan="2"><input type=text name=prjnumber id=prjnumber ></td>
</tr>
<tr class="rowB">
<th width="40%" align="left" ><input name=opinion[] type=checkbox value=ck5> On Going Projects </th>
<th width="60%" align="left" ><input name=opinion[] type=checkbox value=ck6> Industrial Consultancy </th>
</tr>
<tr class="rowA">
<th width="40%" align="left" ><input name=opinion[] type=checkbox value=ck7> Retainer Consultancy </th>
<th width="60%" align="left" ><input name=opinion[] type=checkbox value=ck8> Research Based Industrial Consultancy </th>
</tr>
<tr class="rowB">
<th colspan=2 align="center" ><input name=opinion[] type=checkbox value=ck9> All Projects </th>
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
<option> 1314 </option> <option> 1415 </option> <option> 1516 </option><option> 1617 </option> <option> 1718</option>  <option> 1819</option> 
</select>
<b>To</b><select name=TO >
</option> <option> 1819</option>  <option> 1718</option> <option> 1617 </option></option> <option> 1516 </option> <option> 1415 </option>
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
 <option> 1819</option> <option> 1718</option></option> <option> 1617 </option></option> <option> 1516 </option> <option> 1415 </option>
<option> 1314 </option> <option> 1213 </option> <option> 1112 </option>
<option>1011</option> <option>0910</option>
<option>0809</option> <option>0708</option><option>0607</option>
<option>0506</option> <option>0405</option><option>0405</option>
<option>0203</option> <option>0102</option><option>0001</option>
</select>
</div>
</td>
</tr>
<tr class="rowB">
<td colspan="3"><div align="center"><input type=submit name=submitt value=GetResult>&nbsp;&nbsp;<input type=reset name=Reset value=Reset></div>
</td>
</tr>
</table>

<?php
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
