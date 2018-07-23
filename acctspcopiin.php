<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ICSR ACCOUNTS SPONSOR CO PI DETAILS</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body  >
<div id="content">
<div id="primaryContentContainer">
<div id="primaryContent">
<?php
session_start();
$q=$_REQUEST['q'];
//echo "$q";
$head=substr($q,0,4);
$nprno=substr($q,7,18);
$year=substr($q,28,7);
$prjtype=substr($q,14,4);
$iitprj=substr($q,7,3);
//echo "<br>prjtype=$prjtype";
if (strcmp($prjtype,'DEVP')==0 )
{
$nprno=substr($q,7,15);
$year=substr($q,25,7);
}

if (strcmp($iitprj,'IIT')==0)
{
$nprno=substr($q,7,14);
$year=substr($q,24,7);
}

//$year=$_REQUEST['year'];
//echo "<br>nprno=$nprno<br>head=$head<br>year=$year";
//echo "<br>Success POP UP Page";
//VRNO,DATE,NPRNO,PART,DISC,AMOUNT

$count=1;
$x = substr($nprno,0,13);
odbc_close_all();
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");

$sq="select INSTID,COORNAME from PROJCOORDINATORS WHERE substring(nprno,1,13) like '$x'";
//echo "$sq";

?>

<h4><div align="center">Project Number:<?php echo " $nprno"; ?>  </div></h4>
<div  align="center">
<table  cellpadding="1" border="1" width="60%">
<tr>
<th  colspan="2"><div align="center">CO-COORDINATOR DETAILS</div></th>
</tr>
  <tr>
    <th><div align="center">INSTITUTEID</div></th>
    <th><div align="center">CO-COORDINATOR NAME</div></th>
  </tr>
<?php
$e = odbc_exec($con,$sq) or die("Query Execution Failed");
while(odbc_fetch_row($e))
{
$inid = odbc_result($e,"INSTID");
$copiname = odbc_result($e,"COORNAME");

if($count==0)
{
?>
<tr  class="rowA">
    <td><div align="center"><?php echo "$inid"; ?></div></td>
    <td><div align="center"><?php echo "$copiname"; ?></div></td>
</tr>
<?php
 }
else
{
//<td><div align="right"><a onclick="Lvl_P2P('http://icsris.iitm.ac.in/icsris/acctfpono.php?pono=<?php echo "$pono"; ',true,0500)" href="javascript:;"> <?php echo //"$pono"; </a></div></td> 
?>
<tr class="rowB">
    <td><div align="center"><?php echo "$inid"; ?></div></td>
    <td><div align="center"><?php echo "$copiname"; ?></div></td>
 </tr>
<?php
}

$count=$count+1;
}
odbc_close_all();



//echo "amount=$amnt";
?>
</table>
</div>
</div>
</div>
</div>
</body>
<script language="JavaScript">
<!--
function Lvl_P2P(url,closeIt,delay){ //ver1.0 4LevelWebs
    opener.location.href = url;
	if (closeIt == true)setTimeout('self.close()',delay);
}
//-->
</script>
<script>
function redirect(linkid)
{

location.href=linkid;
newwindow.close();

}
</script>
</html>
