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
						<h3> Sponsored Ongoing Projects </h3></div>
					<div align="right"><table  width="100%"><tr><td  align="right">Download in <a href="acctsponon_download.php" target="_blank">Excel</a></tr></table></div>
	<div align="center">
	<table  border="1" width="100%">
	<tr>
	<th width="10">S#</th>
	<!--<th width="15">Select</th> -->
	<th  width="170" ><div align="center" >Project Number </div></th>
	<th  width="75" ><div align="center" >Start Date </div></th>
	<th  width="75" ><div align="center" >Close Date </div></th>
	<!--<th  width="60" ><div align="center" >Project Value </div></th>-->
	<th  width="60" ><div align="center" >Grant Received</div></th>
	<th  width="60" ><div align="center" >Total Exp.+Com.</div></th>
	<th  width="60" ><div align="center" >Balance</div></th>
	<th  width="60" ><div align="center" >Utilization Certificate</div></th>
	</tr>
	
	<?php
	if (!isset($_COOKIE["PHPSESSID"])) 
	{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: index.php');
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
		header('location: index.php');
		exit;
	
	}
	//print_r($_SESSION);
	include("currency_words.php");
	include_once("common/function.php");
	$classcall=new Newconnection();
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
	$sqlconnectacct=odbc_connect("FACCT1DSN","sa","IcsR@123#") or die("ODBC CONNECTION 2 Failed");
	if(strcmp($usermode,"SUPER")==0)
	{
	//header('location: https://icsris.iitm.ac.in/AIS/varrpt.php');
	}
	else
	{
	//$sqlquery="select nprno from mstlst where instid like '$insid'";
	//$sqlquery="select nprno,start_date,close_date,pramount from mstlst where instid like '$insid' and close_date>=getdate() and (substring(nprno,4,4) in ('9899','9900','0001','0102','0203','0304','0405','0506','0607','0708','0809','0910','1011','1112','1213','1314','1415','1516')) order by close_date asc";
	$sqlquery="select nprno,start_date,close_date,pramount from mstlst where instid like '$insid' and close_date>=getdate() and ((substring(nprno,4,4) in ('9899','9900','0001','0102','0203','0304','0405','0506','0607','0708','0809','0910','1011','1112','1213','1314','1415','1516','1617','EQPT','1718','1819'))) order by close_date asc";
	}
	//or substring(nprno,11,4) in('PCFX','RMFX')
	unset($_SESSION['nprno']); 
	$sqlconnect=odbc_connect($dsn,$username,$password);
	$process=odbc_exec($sqlconnect,$sqlquery); 
	//echo "$insid | $usermode";
	$i="1";
	$ii="2";
	
	while(odbc_fetch_row($process))
	{
	$pono = odbc_result($process,"nprno");
	$star_date=odbc_result($process,"start_date");
	$start_date=date('d-m-Y',strtotime($star_date));
	$clos_date=odbc_result($process,"close_date");
	$close_date=date('d-m-Y',strtotime($clos_date));
	$pramount=odbc_result($process,"pramount");
	$iii=$i%$ii; $cls="";
	if ( $iii == 0 )
	{
	$cls="class=rowA";
	}
	else
	{
	$cls="class=rowB";
	}
	echo "<tr>";
	echo "<td>$i</td>";
	//echo "<td align=center><input name=pono type=radio value=$pono /></td>";
	echo "<td><a href=acctspsum.php?nprno=$pono>$pono</a></td>";
	echo "<td>$start_date</td>";
	echo "<td>$close_date</td>";
	//echo "<td align = right >$pramount</td>";
	
	//$aprlnoc=substr($pono,0,10)."%";
	$nprno=$pono;
	//$c=substr($nprno,10,4);
	//echo "<br>$c";
	
	if((strcmp('CHY0910258',substr($nprno,0,10))==0)or (strcmp('MEE0708226',substr($nprno,0,10))==0) or (strcmp('MEE0809245',substr($nprno,0,10))==0) or (strcmp('CSE0708092',substr($nprno,0,10))==0) or (strcmp('PHY0607185',substr($nprno,0,10))==0) or (strcmp('ELE0506130',substr($nprno,0,10))==0) or (strcmp('APM0102059',substr($nprno,0,10))==0) or (strcmp('CHE0304064',substr($nprno,0,10))==0) or (strcmp('CHE0304062',substr($nprno,0,10))==0) or (strcmp('ELE0304081',substr($nprno,0,10))==0) or (strcmp('PHY0708199',substr($nprno,0,10))==0) or (strcmp('MEE0809238',substr($nprno,0,10))==0) or (strcmp('CHE0304063',substr($nprno,0,10))==0) or (strcmp(substr($nprno,0,3),'IIT')==0) or (strcmp(substr($nprno,10,4),'PCFX')==0) or (strcmp(substr($nprno,10,4),'RMFX')==0))
	{
	$aprlnoc=$nprno;
	}
	else
	{
	$aprlnoc=substr($nprno,0,10)."%";
	}
	
	$stracct="select substring(nprno,11,4) as agency,nprno,stafall,staf,stafcom,eqptall,eqpt,rt,eqptcom,consall,cons,conscom,contall,cont,contcom,travall,trav,travcom,compall, comp,compcom,ohall,inoh,icoh,oterall,oter,otercom,totalall,total,totalcom,rt_balance from ttmaster  where nprno like '$aprlnoc'";
	//echo "$stracct";
	$processacct="";
	$processacct=odbc_exec($sqlconnectacct,$stracct) or dir("processacct Failed to get data");
	
	if(odbc_fetch_row($processacct))
	{
	$totalall = round(odbc_result($processacct,"totalall"),0);
	$total = round(odbc_result($processacct,"total"),0);
	$totalcom = round(odbc_result($processacct,"totalcom"),0);
	$totalcur=$total+$totalcom;
	
	$rt = round(odbc_result($processacct,"rt"),0);
	$rt_balance = round(odbc_result($processacct,"rt_balance"),0);
	$rtbal=$rt-$totalcur;
	}
	else
	{
	$rt="NA";
	$rtbal="NA";
	//$page = $_SERVER['PHP_SELF'];
	//$sec = "1";
	//header("Refresh: $sec; url=$page");
	}
	echo "<td align = right >".IND_money_format_no_dec($rt)."</td>";
	echo "<td align = right >".IND_money_format_no_dec($totalcur)."</td>";
	echo "<td align = right >".IND_money_format_no_dec($rtbal)."</td>";
	
	$query="SELECT * FROM tbl_uc where project_number like '$nprno'";
	$array=array();
	$uclists=$classcall->selectQuery($query,$array);
	if(!empty($uclists))
	{
		$count=0;
		echo "<td align = center >";
		foreach($uclists as $uclist)
		{
			$count++;
			if($count>1) echo "<br/><br/>";
			echo "<a href='admin/".$uclist['path']."' target='_blank'>".$uclist['financial_year']."</a>";
		}
		echo "</td>";
	}
	else echo "<td align = center >--</td>";
	echo "</tr>";
	$i++;
	}
	odbc_close_all();
	echo"<tr>";
	echo "<td colspan=8 align=center><strong>Sponsord CoCordinated Projects</strong></th>";
	echo "</tr>";
	//$sqlquery1="select nprno from projcoordinators where instid ='$insid' order by nprno";
	$sqlquery1="select nprno,title,start_date,close_date,pramount from mstlst where close_date>=getdate()and nprno in(select nprno from projcoordinators where instid ='$insid') order by close_date asc";
	//echo "$sqlquery1";
	$process1=odbc_exec($sqlconnect,$sqlquery1) or die("Connection Failed"); 
	
	while(odbc_fetch_row($process1))
	{
	$pono = odbc_result($process1,"nprno");
	$star_date=odbc_result($process1,"start_date");
	$start_date=date('d-m-Y',strtotime($star_date));
	$clos_date=odbc_result($process1,"close_date");
	$close_date=date('d-m-Y',strtotime($clos_date));
	$pramount=odbc_result($process1,"pramount");
	$iii=$i%$ii; $cls="";
	if ( $iii == 0 )
	{
	$cls="class=rowA";
	}
	else
	{
	$cls="class=rowB";
	}
	echo "<tr $cls>";
	echo "<td>$i</td>";
	//echo "<td align=center><input name=pono type=radio value=$pono /></td>";
	echo "<td><a href=acctspsum.php?nprno=$pono>$pono</a></td>";
	echo "<td>$start_date</td>";
	echo "<td>$close_date</td>";
	//echo "<td>$pramount</td>";
	
	//$aprlnoc=substr($pono,0,10)."%";
	$nprno=$pono;
	if((strcmp('CHY0910258',substr($nprno,0,10))==0)or (strcmp('MEE0708226',substr($nprno,0,10))==0) or (strcmp('MEE0809245',substr($nprno,0,10))==0) or (strcmp('CSE0708092',substr($nprno,0,10))==0) or (strcmp('PHY0607185',substr($nprno,0,10))==0) or (strcmp('ELE0506130',substr($nprno,0,10))==0) or (strcmp('APM0102059',substr($nprno,0,10))==0) or (strcmp('CHE0304064',substr($nprno,0,10))==0) or (strcmp('CHE0304062',substr($nprno,0,10))==0) or (strcmp('ELE0304081',substr($nprno,0,10))==0) or (strcmp('PHY0708199',substr($nprno,0,10))==0) or (strcmp('MEE0809238',substr($nprno,0,10))==0) or (strcmp('CHE0304063',substr($nprno,0,10))==0) or (strcmp(substr($nprno,0,3),'IIT')==0))
	{
	$aprlnoc=$nprno;
	}
	else
	{
	$aprlnoc=substr($nprno,0,10)."%";
	}
	
	$stracct="select substring(nprno,11,4) as agency,nprno,stafall,staf,stafcom,eqptall,eqpt,rt,eqptcom,consall,cons,conscom,contall,cont,contcom,travall,trav,travcom,compall, comp,compcom,ohall,inoh,icoh,oterall,oter,otercom,totalall,total,totalcom,rt_balance from ttmaster  where nprno like '$aprlnoc'";
	
	$processacct="";
	$processacct=odbc_exec($sqlconnectacct,$stracct) or dir("processacct Failed to get data");
	
	if(odbc_fetch_row($processacct))
	{
	$totalall = round(odbc_result($processacct,"totalall"),0);
	$total = round(odbc_result($processacct,"total"),0);
	$totalcom = round(odbc_result($processacct,"totalcom"),0);
	$totalcur=$total+$totalcom;
	
	$rt = round(odbc_result($processacct,"rt"),0);
	$rt_balance = round(odbc_result($processacct,"rt_balance"),0);
	$rtbal=$rt-$totalcur;
	}
	else
	{
	$rt="NA";
	$rtbal="NA";
	//$page = $_SERVER['PHP_SELF'];
	//$sec = "1";
	//header("Refresh: $sec; url=$page");
	}
	echo "<td align = right >".IND_money_format_no_dec($rt)."</td>";
	echo "<td align = right >".IND_money_format_no_dec($totalcur)."</td>";
	echo "<td align = right >".IND_money_format_no_dec($rtbal)."</td>";
	
	$query="SELECT * FROM tbl_uc where project_number like '$nprno'";
	$array=array();
	$uclists=$classcall->selectQuery($query,$array);
	if(!empty($uclists))
	{
		$count=0;
		echo "<td align = center >";
		foreach($uclists as $uclist)
		{
			$count++;
			if($count>1) echo "<br/><br/>";
			echo "<a href='admin/".$uclist['path']."' target='_blank'>".$uclist['financial_year']."</a>";
		}
		echo "</td>";
	}
	else echo "<td align = center >--</td>";
	echo "</tr>";
	$i++;
	}
	
	}
	
	?>
	</table>
	</div>
 </div>
</div>
</div>
</div>
	</body>
	</html>
