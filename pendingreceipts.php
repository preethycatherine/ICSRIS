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
<div align="center"><h3> Sponsored Projects Funds from Govt. Agencies Pending Assignment to Projects </h3></div>

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
$strsql="SELECT CONVERT(varchar,GrantReceivedDate,105) as GRDATE, AmountReceivedFrom, AmountReceived, ProjectTtpe, SanctionNumber FROM PendingGrantDetails  where ProjectTtpe like 'Sponsored' order by GrantReceivedDate desc";
//CONVERT(varchar,close_date,105)
}
else
{
$strsql="SELECT CONVERT(varchar,GrantReceivedDate,105) as GRDATE, AmountReceivedFrom, AmountReceived, ProjectTtpe, SanctionNumber FROM PendingGrantDetails  where ProjectTtpe like 'Sponsored' order by GrantReceivedDate desc";
}
$count=1;
//echo "$strsql";
$process=odbc_exec($sqlconnect,$strsql);

?>
<table  border="1" width="100%" align="center">
<tr>
<th><div align="center" >Grant Received Date </div></th>
<th><div align="center" >Grant Received From </div></th>
<th><div align="center" >Bank A/C Number </div></th>
<th><div align="left" >Received Amount </div></th>
</tr>
<?php
$sponaffected = odbc_num_rows($process); 
if($sponaffected<>0)
{
while(odbc_fetch_row($process))
{
$RDATE=odbc_result($process,"GRDATE");
$AGENCY=odbc_result($process,"AmountReceivedFrom");
$ACCNUMBER=odbc_result($process,"SanctionNumber");
$AMOUNT=odbc_result($process,"AmountReceived");
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
<td><div align="center"><?php echo "$RDATE" ?></div></td>
<td><div align="left"><?php echo "$AGENCY" ?></div></td>
<td><div align="left"><?php echo "$ACCNUMBER" ?></div></td>
<td><div align="right"><?php echo "$AMOUNT" ?></div></td>
</tr>

<?php
$count=$count+1;
}
}
else
{
?>
<tr>
<td colspan="6"><div align="center"><?php echo "No Pending Grant in Sponsor Project" ?></div></td>
</tr>

<?php
}
?>
</table>

<?php
$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
if(strcmp($usermode,"SUPER")==0)
{
$strsql="SELECT CONVERT(varchar,GrantReceivedDate,105) as GRDATE, AmountReceivedFrom, AmountReceived, ProjectTtpe, SanctionNumber FROM PendingGrantDetails  where ProjectTtpe not like 'Sponsored' order by GrantReceivedDate desc";
}
else
{
$strsql="SELECT CONVERT(varchar,GrantReceivedDate,105) as GRDATE, AmountReceivedFrom, AmountReceived, ProjectTtpe, SanctionNumber FROM PendingGrantDetails  where ProjectTtpe not like 'Sponsored' order by GrantReceivedDate desc";
}
$count=1;
//echo "$strsql";
$process=odbc_exec($sqlconnect,$strsql);

?>
<div align="center"><h3>  Consultancy Projects / Other Funds Pending Assignment to Projects </h3> </div>
<table  border="1" width="100%" align="center">
<tr>
<th><div align="center" >Grant Received Date </div></th>
<th><div align="center" >Grant Received From </div></th>
<th><div align="center" >Bank A/C Number </div></th>
<th><div align="left" >Received Amount </div></th>
</tr>
<?php
$sponaffected = odbc_num_rows($process); 
if($sponaffected<>0)
{
while(odbc_fetch_row($process))
{
$RDATE=odbc_result($process,"GRDATE");
$AGENCY=odbc_result($process,"AmountReceivedFrom");
$ACCNUMBER=odbc_result($process,"SanctionNumber");
$AMOUNT=odbc_result($process,"AmountReceived");
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
<td><div align="center"><?php echo "$RDATE" ?></div></td>
<td><div align="left"><?php echo "$AGENCY" ?></div></td>
<td><div align="left"><?php echo "$ACCNUMBER" ?></div></td>
<td><div align="right"><?php echo "$AMOUNT" ?></div></td>
</tr>

<?php
$count=$count+1;
}
}
else
{
?>
<tr>
<td colspan="6"><div align="center"><?php echo "No Pending Grant in Consultancy Project" ?></div></td>
</tr>

<?php
}
?>
</table>
</div>
</div>
<?php
}

?>
</div>
<!-- </div>-->


<?php
if (strcmp($usermode,"SUPER")==0)
{
?>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a></div>
<h3>Unidentified Grant Receipts</h3>
<p><ul><li><a href="pendingreceipts.php">Unidentified Grant Receipts</a></li></ul></p>		
<h3>Sponsored Project</h3>
<p><ul><li><a href="acctspquery.php">Sponsor Query</a></li></ul></p>
<h3>Consultancy Project</h3>
<p><ul><li><a href="acctcpquery.php">Consultancy Query</a></li></ul></p>
<h3>PCF</h3>
<p><ul><li><a href="acctpcfquery.php">PCF Query</a></li></ul></p>
<h3>RMF</h3>
<p><ul><li><a href="acctrmfquery.php">RMF Query</a></li></ul></p>		
<h3>Cheque Details</h3>
<p><ul><li><a href="chequedetails.php">Pending Cheques Details</a>a</li></ul></p>		</div>

<div class="clear"></div>
</div>
<?php
}
//}
?>
<div id="footer">
<p>Developed by : ICSR, IITMadras</p>
</div>
</div>
</div>
</body>
</html>
