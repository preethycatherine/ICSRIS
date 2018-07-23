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
			  <?php   session_start();
			  if($_SESSION["usermode"]=="SUPER"){ ?>
			  <div w3-include-html="menu_super.html"></div>
			  <?php } 	
				else{ ?>
			 <!--<div w3-include-html="menu.html"></div>-->
	<div w3-include-html="menu.php"></div>
			  <?php  } ?>
			  <script>
				w3.includeHTML();
				</script>
	<!--=========== END MENU SECTION ================--> 
	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
			
				
<div align="center">
<div align="center"><h3> Sponsored Project Cheques </h3></div>

<?php
if (!isset($_COOKIE["PHPSESSID"])) 
{
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
header('location: http://icsris.iitm.ac.in/ICSRIS/sessionout.php');
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
	header('location: http://icsris.iitm.ac.in/ICSRIS/sessionout.php');
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
$strsql="SELECT PONO,CHEQ_NO,CHEQ_DATE,PARTY,AMOUNT,PURPOSE FROM CHECKDETAILS WHERE ((ASCII(SUBSTRING(UPPER(PONO),3,1))>=65) AND (ASCII(SUBSTRING(UPPER(PONO),3,1))<=90)) AND ISSUEDATE IS NULL ORDER BY PONO";
}
else
{
$strsql="SELECT PONO,CHEQ_NO,CHEQ_DATE,PARTY,AMOUNT,PURPOSE FROM CHECKDETAILS WHERE ((ASCII(SUBSTRING(UPPER(PONO),3,1))>=65) AND (ASCII(SUBSTRING(UPPER(PONO),3,1))<=90)) AND ISSUEDATE IS NULL  AND INSTID LIKE '$instid' ORDER BY PONO";
}
$count=1;
//echo "$strsql";
$process=odbc_exec($sqlconnect,$strsql);

?>
<table  border="1" width="100%">
<tr>
<!--<th ><div align="center" >Project Number </div></th>-->
<th><div align="center" >Cheque No. </div></th>
<th><div align="center" >Date </div></th>
<th><div align="left" >Party </div></th>
<th><div align="center" >Amount</div></th>
<th><div align="left" >Purpose</div></th>
</tr>
<?php
$sponaffected = odbc_num_rows($process); 
if($sponaffected<>0)
{
while(odbc_fetch_row($process))
{
$PONO=odbc_result($process,"PONO");
$CHEQNO=odbc_result($process,"CHEQ_NO");
$CHEQDT=odbc_result($process,"CHEQ_DATE");
$CHEQDATE=date('d-m-Y',strtotime($CHEQDT));
$PARTY=odbc_result($process,"PARTY");
$AMOUNT=odbc_result($process,"AMOUNT");
$AMUNT=number_format($AMOUNT,2);
$PURPOSE=odbc_result($process,"PURPOSE");
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
<!--<td><div align="center"><?php echo "$PONO" ?></div></td>-->
<td><div align="center"><?php echo "$CHEQNO" ?></div></td>
<td><div align="center"><?php echo "$CHEQDATE" ?></div></td>
<td><div align="left"><?php echo "$PARTY" ?></div></td>
<td><div align="center"><?php echo "$AMUNT" ?></div></td>
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
<td colspan="6"><div align="center"><?php echo "No Pending Cheques in Sponsor Project" ?></div></td>
</tr>

<?php
}
?>
</table>
</div>
<div align="center"><h3> Consultancy Project Cheques </h3></div>
<table  border="1" width="100%">
<tr>
<!--<th ><div align="center" >Project Number </div></th>-->
<th><div align="center" >Cheque No. </div></th>
<th><div align="center" >Date </div></th>
<th><div align="left" >Party </div></th>
<th><div align="center" >Amount</div></th>
<th><div align="left" >Purpose</div></th>
</tr>

<?PHP
$count=1;
if(strcmp($usermode,"SUPER")==0)
{
$strsql="SELECT PONO,CHEQ_NO,CHEQ_DATE,PARTY,AMOUNT,PURPOSE FROM CHECKDETAILS WHERE ((ASCII(SUBSTRING(PONO,3,1))>=48) AND (ASCII(SUBSTRING(UPPER(PONO),3,1))<=57))  AND ISSUEDATE IS NULL ORDER BY PONO";
}
else
{
$strsql="SELECT PONO,CHEQ_NO,CHEQ_DATE,PARTY,AMOUNT,PURPOSE FROM CHECKDETAILS WHERE ((ASCII(SUBSTRING(PONO,3,1))>=48) AND (ASCII(SUBSTRING(UPPER(PONO),3,1))<=57))  AND ISSUEDATE IS NULL AND INSTID LIKE '$instid' ORDER BY PONO";
}
$process1=odbc_exec($sqlconnect,$strsql);

$consaffected = odbc_num_rows($process1); 
if($consaffected<>0)
{
while(odbc_fetch_row($process1))
{
$PONO=odbc_result($process1,"PONO");
$CHEQNO=odbc_result($process1,"CHEQ_NO");
$CHEQDT=odbc_result($process1,"CHEQ_DATE");
$CHEQDATE=date('d-m-Y',strtotime($CHEQDT));
$PARTY=odbc_result($process1,"PARTY");
$AMOUNT=odbc_result($process1,"AMOUNT");
$AMUNT=number_format($AMOUNT,2);
$PURPOSE=odbc_result($process1,"PURPOSE");
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
<!--<td><div align="center"><?php echo "$PONO" ?></div></td>-->
<td><div align="center"><?php echo "$CHEQNO" ?></div></td>
<td><div align="center"><?php echo "$CHEQDATE" ?></div></td>
<td><div align="left"><?php echo "$PARTY" ?></div></td>
<td><div align="center"><?php echo "$AMUNT" ?></div></td>
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
<td colspan="6"><div align="center"><?php echo "No Pending Cheques in Sponsor Project" ?></div></td>
</tr>

<?php
}
?>
</table>
<?php
}

?>
</div>
 </div>


<?php
if (strcmp($usermode,"SUPER")==0)
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<h3>Sponsored Project</h3>
<p><ul><li><a href="acctspquery.php">Sponsor Query</a></li></ul></p>
<h3>Consultancy Project</h3>
<p><ul><li><a href="acctcpquery.php">Consultancy Query</a></li></ul></p>
<h3>PCF</h3>
<p><ul><li><a href="acctpcfquery.php">PCF Query</a></li></ul></p>
<h3>RMF</h3>
<p><ul><li><a href="acctrmfquery.php">RMF Query</a></li></ul></p>		
<h3>Cheque Details</h3>
<p><ul><li><a href="chequedetails.php">Pending Cheques Details</a></li></ul></p>		</div>
<div class="clear"></div>
</div>
<?php
}
//}
?>
<div id="footer">
<p></p>
</div>
</div>
</div>
</body>
</html>
