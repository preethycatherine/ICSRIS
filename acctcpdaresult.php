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
  <h3>CPDA ACCOUNTS RESULT SCREEN</h3>
</div>


<?php
session_start();

{
/*if(isset($_POST['submitt']))
{
$_SESSION = $_POST;
$_POST['submitt'] = '';
}else{
$_POST = $_SESSION;
$_SESSION['submitt'] = '';
}*/

if(!isset($_SESSION["cpdaresult"]))
{
$sql1="";
$sql2="";
$sql3="";
$sql4="";
$count=0;
$i=1;

foreach($_POST["opinion"] as $val)
{
$choice[$i]=$val;
if ($choice[$i]<>'') 
$count++;
//echo "<br>$choice[$i]";
$i++;
}

$instid=trim($_POST["instid"]);
$pname=trim($_POST["pname"]);
$dept=trim($_POST["dept"]);


//echo "<br> $instid | $pname | $dept ";

//echo "\n Countvalue=$count";
//echo "<br>(($choice[1]='ck1') and ($count=1)";
$sqle=" order by Department";
//select iirno,name,dept,desig from co_name order by dept
$c=1;
while($c<=$count)
{
switch($choice[$c])
{
case 'ck1':
			$sql1=" and StaffNo like '$instid'";
			break;
case 'ck2':
			$sql2=" and StaffName like '$pname'";
			break;
case 'ck3':
			$sql3=" and Department like '$dept'";
			break;
case 'ck4':
			$sql4="";
			break;
}
$c++;
}








//if(isset($instid)  && empty($ck1))
//$sql1=" and StaffNo like '$instid'";
// if(isset($pname)  && empty($ck2))
//$sql2=" and StaffName like '$pname'";

 //if(isset($dept)  && empty($ck3))
//$sql3=" and Department like '$dept'";
// if(empty($ck4))
//$sql4="";

$sql="select StaffNo,StaffName,Department,Designation,DoJ from staff_details  where (StaffNo <> '' or StaffName<>'' or Department<>'') && Status='Active'";

 $sql=$sql.$sql1.$sql2.$sql3.$sql4.$sqle;
//echo "<br> $sql";
$_SESSION["cpdaresult"]=$sql;
}
else
{
$sql=$_SESSION["cpdaresult"];
}

$dsn="eservices";
$username="cpdaread";
$password="Cpda@Read!1";
//$sqlconnect=odbc_connect($dsn,$username,$password);
mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");

$proces=mysql_query($sql);
?>

<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th><div align="center">REGNO</div></th>
    <th><div align="center">NAME </div></th>
    <th><div align="center">DEPT</div></th>
  
  </tr>
 <?php
 $count=1;
while($row=mysql_fetch_array($proces))
{
$iirno=$row["StaffNo"];
$name=$row["StaffName"];
$dept=$row["Department"];



?>
<td><div align="center"><a href="batch1.php?StaffNo=<?php echo "$iirno"; ?>" ><?php echo "00$iirno"; ?></a></div></td>
    <td><div align="center"><?php echo "$name"; ?></div></td>
    <td><div align="center"><?php echo "$dept"; ?></div></td>
   
  </tr>

<?php
$count=$count+1;
}
}
?>
</table>
</div>
 </div>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="../signout.php"><strong>Signout</strong></a></div>
<h3>CPDA ACCOUNT</h3>
<p><ul><li><a href="../icsrisacct.php">ICSR HOME PAGE</a></li></ul></p>
<p><ul><li><a href="acctcpdaquery.php">CPDA QUERY PAGE</a></li></ul></p>

<div id="footer">
</div>
</div>
</div>
</body>
</html>