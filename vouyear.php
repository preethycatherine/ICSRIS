<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ICSR ACCOUNTS Sponsor Expenditure Year wise  Detais</title>
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
				 
<?php
if(!isset($_COOKIE["PHPSESSID"]))
{
	//echo "<br>session destroy ";
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: index.php');
	exit;

}
else
{
session_start();
//$npr = "BIO0708059DBTXDKAR";
$npr=$_SESSION['nprno'];
$usermode=$_SESSION['usermode'];
//echo "$npr";
$nprno = $npr;
$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
//$yearval=substr($npr,3,2);
$yr = substr($npr,3,2);
//echo "$yr";
$strsql="";
$strsql="Select nprno,title,coor_name,CONVERT(varchar,start_date,105) 'start_date',CONVERT(varchar,close_date,105) 'close_date' from mstlst where nprno like '$npr'";
//$sqlconnect6=odbc_connect($dsn,$username,$password);
//$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
$process=odbc_exec($con,$strsql) or die("odbc connection failed");
//echo "$strsql<br>";

if (odbc_fetch_row($process))
{
$nprno=odbc_result($process,"nprno");
$title=odbc_result($process,"title");
$coor_name=odbc_result($process,"coor_name");
$start_date=odbc_result($process,"start_date");
$close_date=odbc_result($process,"close_date");
$today_date=date("d/m/Y");
}
}

?> 
<div align="center">
<table width="100%" border="1" >
<tr>
<th colspan=5 ><div align=center> Project Account Summary as on <?php echo "$today_date"; ?> </span></div></th>
</tr>
<tr>
<th><div align="right">Project Number :</span></div></th>
<th align="left"><?php echo "$nprno"; ?></th>
<th><div align="right">Duration :</span></div></th>
<th colspan=2 align="left"><?php echo "$start_date"." To "."$close_date"; ?></th>
</tr>
<tr>
<th colspan=5><div align=center>Coordinator Name :</span><?php echo " $coor_name"; ?></div></th>
</tr>
<tr>
<th colspan=5><div align=center>Title : </span><?php echo "$title";  ?></div></th>
</tr>
</table>
</div>
<div align="center">
<nobr><h4><a href="acctspsum.php" >AccountSum</a>  |  <a href="spreceipts.php">ReceiptDetails</a>  |  <a href="vouhead.php">ExpenditureHead</a>  |  <a href="vouyear.php"><span style="background-color:#F6EECC">ExpenditureYear</span></a>|	<a  href="stafcommit.php"><strong>StaffCommit</strong></a>  |  <a href="spothercommit.php"><u>OthersCommit</u></a> </h4></nobr></div>
<div align="center">
<table  cellpadding="1" border="1" width="100%">
<tr>
<th  colspan="9"><div align="center">EXPENDITURE(YEAR WISE) DETAILS</div></th>
</tr>
  <tr>
    <th><div align="center" style="font-size:12px">VOUCHER NO</div></th>
    <th><div align="center" style="font-size:12px">DATE</div></th>
    <th><div align="center" style="font-size:12px">PARTY</div></th>
    <th><div align="center" style="font-size:12px">DESC</div></th>
    <th><div align="center" style="font-size:12px">CHEQ NO</div></th>
    <th><div align="center" style="font-size:12px">AMOUNT</div></th>
    <th><div align="center" style="font-size:12px">HEAD</div></th>
  </tr>




<?php

if($yr==00)
	{
		$str1=99;
	}
	else
	{
		$str1=$yr;
	}
//echo "<br>$strl";
	//echo "the vu     " .$str1."<br>";
	if(($str1 >= 50) && ($str1 <= 99))
		{
		$year='19'.$str1;
		}//                       09  
	elseif(($str1>=00) && ($str1<=10))
			{
			$year='20'.$str1;
//			echo 'the year '.$year;
			}
		else
			{
			$year='20'.$str1;
			}
	
		
		
		//echo 'the year is '. $year;
		//echo '<br> the date is'.date('d');
		
		if(date('d')>=1)
			{
			$d='20'.date("y");
			}
		else
			{
			$d='20'.date("y")-1;
			}
			//echo ("the date.................... is  ".$d);
			for($i=$year;$i<=$d;$i++)
		{
			$fy=substr($i,-2);
			$yrs=$fy.substr($i+1,-2);
			$temp = 'VOU'."$yrs";
					//echo "$temp<br>";
					$count=1;
					$x = substr($nprno,0,13);
					odbc_close_all();
					$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
					$sq = "SELECT vrno,convert(varchar,date,103) as date,amount,part,disc,head,cqno FROM ".$temp." where substring(nprno,1,13) like '$x' order by convert(datetime,date,103) desc";
					$e = odbc_exec($con,$sq);
					//echo "$sq<br>";
						while(odbc_fetch_row($e))
						{
						$v = odbc_result($e,"vrno");
						$dat = odbc_result($e,"date");
						$amnt = odbc_result($e,"amount");
						$pt = odbc_result($e,"part");
						$disc = odbc_result($e,"disc");
						$hd = odbc_result($e,"head");
						$cq = odbc_result($e,"cqno");
						$count=fmod($count,2);
						//echo "<br>$count";
							if($count==0)
							{
							?>
							<tr class="rowA">
								<td><div align="center" style="font-size:14px"><?php echo "$v"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$dat"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$pt"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$disc"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$cq"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo round("$amnt"); ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$hd"; ?></div></td>
							</tr>
							<?php
							 }
							else
							{
							?>
							<tr class="rowB">
								<td><div align="center" style="font-size:14px"><?php echo "$v"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$dat"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$pt"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$disc"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$cq"; ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo round("$amnt"); ?></div></td>
								<td><div align="center" style="font-size:14px"><?php echo "$hd"; ?></div></td>
							 </tr>
							<?php
							}
						$count=$count+1;
						}
					odbc_close_all();
					$con = odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
					$q = "select sum(amount) as amt from ".$temp." where substring(nprno,1,13) like '$x'";
					$e = odbc_exec($con,$q);
						while(odbc_fetch_row($e))
						{
						$amnt = odbc_result($e,"amt");
						if($amnt!=0)
						{
						?>
						<tr >
							<th colspan="5"><div align="center" style="font-size:14px"><?php echo "TOTAL VOUCHER AMOUNT FOR THE FINANCIAL YEAR:$yrs"; ?></div></th>
							<th><div align="right"><?php echo "$amnt"; ?></div></th>
							<td></td>
						</tr>
						<?php
						}
						//echo "<br> Year End";
						}
					$temp1 = substr($yrs, 0, 2);
					$temp2 = substr($yrs, 2, 2);
					$temp1 = $temp1 + 1;
					$temp2 = $temp2 + 1;
					//echo "$templ";
					if($temp1<=9)
					{
					$tempstr = trim(0). "$temp1";
					}
					else if($temp1==100)
					{
					$tempstr = trim("00");
					}
					else
					{
					$tempstr = "$temp1";
					}
					//echo "<br>$tempstr";
					if($temp2<=9)
					{
					$mnt = trim(0). "$temp2";
					}
					elseif($temp2==100)
					{
					$mnt = trim("00");
					}
					else
					{
					$mnt = "$temp2";
					//echo "$mnt";
					}
					$temp = "$tempstr"."$mnt";
					//echo "<br>$temp";
					//}
					//}
					
}
odbc_close($con);
?>
</table>
</div>

<div align="center"></div>
</div>
</div>
<?php

//}
?>
<div id="footer">
<p></p>
</div>
</div>
</div>
</body>
</html>
