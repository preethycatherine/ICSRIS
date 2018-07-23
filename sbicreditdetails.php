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
<div align="center"><h3> SBI Direct Credit Details </h3></div>

<?php
if (!isset($_COOKIE["PHPSESSID"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: https://icsris.iitm.ac.in/ICSRIS/sessionout.php');
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
	header('location: https://icsris.iitm.ac.in/ICSRIS/sessionout.php');
	exit;

}
$usermode=$_SESSION["usermode"];
$instid=$_SESSION['instid'];
$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";

$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
if(strcmp($usermode,"SUPER")==0)
{
$strsql="SELECT DCTRBNO,DCTRNO,CRDATE,VAMOUNT,CBANKACCTNO,NPRNO,NARATION1 FROM DCTRDETAILS WHERE DCTRBNO IS NOT NULL ORDER BY DCTRNO DESC";
}
else
{
$strsql="SELECT DCTRBNO,DCTRNO,CRDATE,VAMOUNT,CBANKACCTNO,NPRNO,NARATION1 FROM DCTRDETAILS WHERE DCTRBNO IS NOT NULL AND INSTID LIKE '$instid' ORDER BY DCTRNO DESC";
}
$count=1;
//echo "$strsql";
$process=odbc_exec($sqlconnect,$strsql);

?>
<table  border="1" width="100%">
<tr>
<!--<th ><div align="center" >Project Number </div></th>-->
<th><div align="center" >BatchNo </div></th>
<th><div align="center" >Tran.No. </div></th>
<th><div align="center" >Credit Date </div></th>
<th><div align="right" >Amount</div></th>
<th><div align="center" >ProjetNumber</div></th>
<th><div align="center" >Purpose</div></th>
</tr>
<?php
$sponaffected = odbc_num_rows($process); 
if($sponaffected<>0)
{
while(odbc_fetch_row($process))
{
$BNO=odbc_result($process,"DCTRBNO");
$TNO=odbc_result($process,"DCTRNO");
$CHEQDT=odbc_result($process,"CRDATE");
$CDATE=date('d-m-Y',strtotime($CHEQDT));
$AMOUNT=odbc_result($process,"VAMOUNT");
$AMUNT=number_format($AMOUNT,2);
$PRJNO=odbc_result($process,"NPRNO");
$PURPOSE=odbc_result($process,"NARATION1");
$c=$count%2;
if ( $c == 0 )
{
$cls="class=rowA";
}
else
{
$cls="class=rowB";
}

?>

<tr <?php echo "$cls"; ?>>
<td><div align="center"><?php echo "$BNO" ?></div></td>
<td><div align="center"><?php echo "$TNO" ?></div></td>
<td><div align="center"><?php echo "$CDATE" ?></div></td>
<td><div align="center"><?php echo "$AMUNT" ?></div></td>
<td><div align="left"><?php echo "$PRJNO" ?></div></td>
<td><div align="left"><?php echo " $PURPOSE" ?></div></td>
</tr>

<?php
$count=$count+1;
}
}
else
{
?>
<tr>
<td colspan="6"><div align="center"><?php echo "No SBI Direct Credit Exists " ?></div></td>
</tr>

<?php
}
?>
</table>
</div>



<?php
}

?>
</div>
 </div>
<div id="footer">
<p></p>
</div>
</div>
</div>
</body>
</html>
