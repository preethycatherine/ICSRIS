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
	<?php
	if(!isset($_COOKIE["PHPSESSID"]))
	{
		session_destroy();
		setcookie("PHPSESSID","",time()-3600,"/");
		header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
		exit;
	
	}
	else
	{
	session_start();
	$insid=$_SESSION['instid'];
	$usermode=$_SESSION['usermode'];
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$instid1="";
	$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
	//echo "<br> Flow in here";
	
	if(!isset($_SESSION['nprno']))
	{
	$nprno=$_REQUEST['nprno'];
	//echo "<br> Direct Value";
	//echo "<br> NPRNO:$nprno";
	}
	else
	{
	$nprno=$_SESSION['nprno'];
	//echo "<br>Session value";
	//unset($_SESSION['nprno']); 
	}
	}
	$_SESSION['nprno']=$nprno;
	if(isset($_COOKIE["PHPSESSID"]))
	{
	session_register("logname");
	$_SESSION["nprno"]=$nprno;
	//echo "<br>NPRNO:$nprno";
	//if((strcmp('CHY0910258',substr($nprno,0,10))==0) or (strcmp('MEE0809245',substr($nprno,0,10))==0) or (strcmp(substr($nprno,0,3),'IIT')==0))
	//{
	//$nprno=$nprno;
	//}
	//else
	//{
	//$nprno=substr($nprno,0,10)."%";
	//}
	if((strcmp('CHY0910258',substr($nprno,0,10))==0)or (strcmp('MEE0708226',substr($nprno,0,10))==0) or (strcmp('MEE0809245',substr($nprno,0,10))==0) or (strcmp('CSE0708092',substr($nprno,0,10))==0) or (strcmp('PHY0607185',substr($nprno,0,10))==0) or (strcmp('ELE0506130',substr($nprno,0,10))==0) or (strcmp('APM0102059',substr($nprno,0,10))==0) or (strcmp('CHE0304064',substr($nprno,0,10))==0) or (strcmp('CHE0304062',substr($nprno,0,10))==0) or (strcmp('ELE0304081',substr($nprno,0,10))==0) or (strcmp('PHY0708199',substr($nprno,0,10))==0) or (strcmp('MEE0809238',substr($nprno,0,10))==0) or (strcmp('CHE0304063',substr($nprno,0,10))==0) or (strcmp(substr($nprno,0,3),'IIT')==0) or (strcmp(substr($nprno,10,4),'PCFX')==0) or (strcmp(substr($nprno,10,4),'RMFX')==0))
	{
	$nprno=$nprno;
	}
	else
	{
	$nprno=substr($nprno,0,10)."%";
	}
	$strsql="SELECT NPRNO,TITLE,COOR_NAME, Start_Date,Close_Date, PRAMOUNT, SANCTNNO, SANCTDTE,INSTID,COOR_NAME1,INSTID1,datediff(d,start_date,getdate()) as tempint1,datediff(yyyy,start_date,getdate()) as tempint FROM MSTLST WHERE NPRNO LIKE '$nprno'";
	//echo "<br> $strsql";
	$process=odbc_exec($sqlconnect,$strsql) or die("Query Execution Failed");
	//echo "<br>$nprno";
	global $allamnt;
	global $rptamnt;
	global $tempint1;
	if(odbc_fetch_row($process))
	{
	$tempint1= odbc_result($process,"tempint1");
	$tempint= odbc_result($process,"tempint");
	}
	
	
	odbc_close_all();
	$strsql="";
	$strsql="select count(opt_date) as opt_date from appmmast where nprno ='$nprno' and stafcom >0 and opt_date is not null";
	//echo "<br> $strsql";
	//$sqlconnect=odbc_connect("FACCTDSN","sa","IcsR@123#");
	$process=odbc_exec($sqlconnect,$strsql) or die("<br>connection failed");
	$opt_date=odbc_result($process,"opt_date");
	//echo "<br> $opt_date   here";
	if ($tempint1 <= 366) 
	 $tempint = 1;
	else
	 $tempint = $tempint + 1;
	
	odbc_close_all();
	$strsql="";
	$strsq1="select nprno,yr1,yr2,yr3,yr4,yr5,yr6,ryr1,ryr2,ryr3,ryr4,ryr5,ryr6 from OHYRTBL WHERE nprno LIKE '$nprno'";
	$process=odbc_exec($sqlconnect,$strsq1) or die("<br>connection failed");
	//echo "<br>third query $strsq1";
	if(odbc_fetch_row($process))
	{
	$yr1=odbc_result($process,"yr1");
	$yr2=odbc_result($process,"yr2");
	$yr3=odbc_result($process,"yr3");
	$yr4=odbc_result($process,"yr4");
	$yr5=odbc_result($process,"yr5");
	$yr6=odbc_result($process,"yr6");
	$ryr1=odbc_result($process,"ryr1");
	$ryr2=odbc_result($process,"ryr2");
	$ryr3=odbc_result($process,"ryr3");
	$ryr4=odbc_result($process,"ryr4");
	$ryr5=odbc_result($process,"ryr5");
	$ryr6=odbc_result($process,"ryr6");
	
	//echo "<br>yr1=$yr1,yr2=$yr2,yr3=$yr3,yr4=$yr4,yr5=$yr5,yr6=$yr6,ryr1=$ryr1,ryr2=$ryr2,ryr3=$ryr3,ryr4=$ryr4,ryr5=$ryr5,ryr6=$ryr6";
	
	
		switch ($tempint)
		{
			case 1:
				$allamnt=$yr1;
				break;
			
			case 2:
				if ($rptamnt <= $ryr1)
					$allamnt=$yr1;
				else
					$allamnt = $yr1+$yr2;
				break;
			case 3:
				if (($rptamnt > 0) && ($rptamnt <= $ryr1)) 
					$allamnt=$yr1;
	
				if (($rptamnt > $ryr1) && ($rptamnt <= ($ryr1 + $ryr2 )))
					$allamnt = $yr1 + $yr2;
	
				if ($rptamnt > ($ryr1 + $ryr2))
					$allamnt = $yr1+$yr2+$yr3;
				break;
			case 4:
				if (($rptamnt > 0) &&  ($rptamnt <= $ryr1))
					$allamnt = $yr1;
	
				if (($rptamnt > $ryr1) && ($rptamnt <= $ryr1 + $ryr2)) 
					$allamnt = $yr1 + $yr2;
	
			
				if (($rptamnt > $ryr1 + $ryr2) && ($rptamnt <= ($ryr1 + $ryr2 + $ryr3))) 
					$allamnt = $yr1 + $yr2 + $yr;
	
				if ($rptamnt > ($ryr1 + $ryr2 + $ryr3)) 
					$allamnt = $yr1+ $yr2+ $yr3+ $ryr4;
				break;
		
			
		 case 5:
				if (($rptamnt > 0) &&  ($rptamnt <= $ryr1))
					$allamnt = $yr1;
						
				if (($rptamnt > $ryr1) && (($rptamnt <= ($ryr1 + $ryr2)))) 
					$allamnt = $yr1+ $yr2;
	
				if (($rptamnt > ($ryr1 + $ryr2)) &&  ($rptamnt <= ($ryr1 + $ryr2 + $ryr3)))
					$allamnt = $yr1 + $yr2 + $yr3;
	
				if (($rptamnt > ($ryr1 + $ryr2 + $ryr3)) &&  ($rptamnt <= ($ryr1 + $ryr2 + $ryr3 + $ryr4))) 
					$allamnt = $yr1 + $yr2 + $yr3 + $ryr4;
	
				if ($rptamnt > ($ryr1 + $ryr2 + $ryr3 + $ryr4)) 
					$allamnt = $yr1 + $yr2 + $yr3 + $ryr4 + $ryr5;
				break;
				
		  Case 6:
		
				if (($rptamnt > 0) && ($rptamnt <= $ryr1))
					$allamnt = $yr1;
			
				if (($rptamnt > $ryr1) &&  ($rptamnt <= ($ryr1 + $ryr2))) 
					$allamnt = $yr1 + $yr2;
	
				if (($rptamnt > ($ryr1 + $yr2)) &&  ($rptamnt <= ($ryr1 + $ryr2 + $ryr3))) 
					$allamnt = $yr1 + $yr2 + $yr3;
	
				if (($rptamnt > ($ryr1 + $ryr2 + $ryr3)) &&  ($rptamnt <= ($ryr1 + $ryr2 + $ryr3 + $ryr4))) 
					$allamnt = $yr1 + $yr2 + $yr3 + $ryr4;
				
				if (($rptamnt > ($ryr1 + $ryr2 + $ryr3 + $ryr4)) && ($rptamnt <= ($ryr1 + $ryr2 + $ryr3 + $ryr4 + $ryr5)) )
					$allamnt = $yr1 + $yr2 + $yr3 + $ryr4 + $ryr5;
	
				if ($rptamnt > ($ryr1 + $ryr2 + $ryr3 + $ryr4 + $ryr5)) 
					$allamnt = $yr1 + $yr2 + $yr3 + $ryr4 + $ryr5 + $ryr6;
				break;
		
		}
	
	}
	else
	{
	$tmpflag=true;
	}
	
	
	
	$ohyearcal = $allamnt;
	
	odbc_close_all();
	$strsql="";
	$strsql = "SELECT RT,OHALL,STAFALL,CONSALL,CONTALL,COMPALL,EQPTALL,TRAVALL,OTERALL,INOH,ICOH FROM TTMASTER WHERE nprno ='$nprno'";
	//$sqlconnect4=odbc_connect($dsn,$username,$password);
	$process=odbc_exec($sqlconnect,$strsql) or die("<br> Connection Failed");
	//echo "<br>fourth query $strsql";
	global $OHCALC;
	if(odbc_fetch_row($process))
	{
		$RT=odbc_result($process,"RT");
		$OHALL=odbc_result($process,"OHALL");
		$STAFALL=odbc_result($process,"STAFALL");
		$CONSALL=odbc_result($process,"CONSALL");
		$CONTALL=odbc_result($process,"CONTALL");
		$COMPALL=odbc_result($process,"COMPALL");
		$EQPTALL=odbc_result($process,"EQPTALL");
		$TRAVALL=odbc_result($process,"TRAVALL");
		$OTERALL=odbc_result($process,"OTERALL");
		$INOH=odbc_result($process,"INOH");
		$ICOH=odbc_result($process,"ICOH");
		
		
		if(odbc_result($process,"OHALL")<>0)
				$PER=($OHALL/($STAFALL+ $EQPTALL+$CONSALL+$CONTALL+$TRAVALL+$COMPALL+$OTERALL+$OHALL));
		else
				$PER = 0;
	
		$OHCALC = ($RT*$PER);
		
		if($OHCALC > $allamnt)
			$OHCALC = $allamnt;
		
		$OHCALC = $OHCALC-($INOH+$ICOH);
		 
	
		if(($OHCALC+$INOH+$ICOH) > $OHALL) 
		   $OHCALC=$OHALL-($INOH+$ICOH);
	
	//	echo "<br>ohcalc=$OHCALC";
		$c=$OHCALC;
		if ($OHCALC < 0)
		   $OHCALC = 0;
		else
		{
		$c=$OHCALC;
		$OHCALC =$c;
		}
	//	echo "<br>ohcalc=$OHCALC";
	
		if ($OHCALC < 1) 
			$OHCALC = 0;
	
	//	echo "<br>ohcalc=$OHCALC";
	}
	$OHCALC = round($OHCALC);
	
	odbc_close_all();
	$strsql="";
	$strsql="select count(*) as pcno from mstlst where nprno like '$nprno'";
	//$sqlconnect=odbc_connect($dsn,$username,$password);
	$process=odbc_exec($sqlconnect,$strsql) or die("<br>Connection Failed");
	//echo "Fifth Query : $strsql";
	if(odbc_fetch_row($process))
	{
	$pono=odbc_result($process,"pcno");
	//echo "<br>$pono";
	}
	else 
	$pono=0;
	
	//echo "<br>$pono";
	
	odbc_close_all();
	$strsql="";
	$strsql="Select nprno,title,coor_name,CONVERT(varchar,start_date,105) 'start_date',CONVERT(varchar,close_date,105) 'close_date',sanctnno,CONVERT(varchar,SANCTDTE,105) 'sanct_date' from mstlst where nprno like '$nprno'";
	//$sqlconnect6=odbc_connect($dsn,$username,$password);
	$process=odbc_exec($sqlconnect,$strsql);
	//echo "<br>Sixth Query :$strsql<br>";
	
	if (odbc_fetch_row($process) && ($pono==1))
	{
	$nprno=odbc_result($process,"nprno");
	$title=odbc_result($process,"title");
	$coor_name=odbc_result($process,"coor_name");
	$start_date=odbc_result($process,"start_date");
	$close_date=odbc_result($process,"close_date");
	$today_date=date("d/m/Y");
	$sanctno=odbc_result($process,"sanctnno");
	$sanc_date=odbc_result($process,"sanct_date");
	?>
	
	<div align="center">
	<table border="1" width="100%" >
	<tr>
	<th colspan=5 ><div align=center> Project Account Summary as on <?php echo "$today_date"; ?> </div></th>
	</tr>
	<tr>
	<th><div align="right">Project Number :</span></div></th>
	<th align="left"><?php echo "$nprno"; ?></th>
	<th><div align="right">Duration :</span></div></th>
	<th colspan=2 align="left"><?php echo "$start_date"." To "."$close_date"; ?></th>
	</tr>
	<tr>
	<th><div align="right">Sanction Number :</span></div></th>
	<th align="left"><?php echo "$sanctno"; ?></th>
	<th><div align="right">Sanction Date :</span></div></th>
	<th colspan=2 align="left"><?php echo "$sanc_date"; ?></th>
	</tr>
	<tr>
	<th colspan=4><div align=center>Coordinator Name :</span><?php echo " $coor_name"; ?></div></th>
	<th><div align="center"><h4><a href="javascript:poptastic('acctspcopiin.php?q=<?php echo "STAF"."@%@"."$nprno"."!@%"."$temp"; ?>');"><?php echo "Co_PI Details"; ?></a></h4></div></th> 
	</tr>
	<tr>
	<th colspan=5><div align=center>Title : </span><?php echo "$title";  ?></div></th>
	</tr>
	</table>
	</div>
	</div>
	<div align="center">
	<nobr><h4><a href="acctspsum.php" >AccountSum</a>  |  <a href="spreceipts.php">ReceiptDetails</a>  |  <a href="vouhead.php">ExpenditureHead</a>  |  <a href="vouyear.php">ExpenditureYear</a>|	<a  href="stafcommit.php"><strong>StaffCommit</strong></a>  |  <a href="spothercommit.php">OthersCommit</a> </h4></nobr></div>
	<div align="center">
	<table  border="2" align="center" cellpadding="2" cellspacing="2" width="100%">
	<?php
	}
	
	odbc_close_all();
	
	$strsql="select substring(nprno,11,4) as agency,nprno,stafall,staf,stafcom,eqptall,eqpt,rt,eqptcom,consall,cons,conscom,contall,cont,contcom,travall,trav,travcom,compall, comp,compcom,ohall,inoh,icoh,oterall,oter,otercom,totalall,total,totalcom,rt_balance from ttmaster  where nprno='$nprno'";
	
	//$sqlconnect7=odbc_connect($dsn,$username,$password);
	$process=odbc_exec($sqlconnect,$strsql) or die("<br>Connection Failed");
	//echo "<br>Seventh Query: $strsql";
	if(odbc_fetch_row($process))
	{
	$agency = odbc_result($process,"agency"); 
	$nprno = odbc_result($process,"nprno");
	
	$stafall = round(odbc_result($process,"stafall"),0);
	$staf = round(odbc_result($process,"staf"),0);
	$stafcom = round(odbc_result($process,"stafcom"),0);
	$stafcur=$staf+$stafcom;
	
	$eqptall = round(odbc_result($process,"eqptall"),0);
	$eqpt = round(odbc_result($process,"eqpt"),0);
	$eqptcom = round(odbc_result($process,"eqptcom"),0);
	$eqptcur=$eqpt+$eqptcom;
	
	$consall = round(odbc_result($process,"consall"),0);
	$cons = round(odbc_result($process,"cons"),0);
	$conscom = round(odbc_result($process,"conscom"),0);
	$conscur=$cons+$conscom;
	
	$contall = round(odbc_result($process,"contall"),0);
	$cont = round(odbc_result($process,"cont"),0);
	$contcom = round(odbc_result($process,"contcom"),0);
	$contcur=$cont+$contcom;
	
	$travall = round(odbc_result($process,"travall"),0);
	$trav = round(odbc_result($process,"trav"),0);
	$travcom = round(odbc_result($process,"travcom"),0);
	$travcur=$trav+$travcom;
	
	$compall = round(odbc_result($process,"compall"),0);
	$comp = round(odbc_result($process,"comp"),0);
	$compcom = round(odbc_result($process,"compcom"),0);
	$compcur=$comp+$compcom;
	
	$ohall = round(odbc_result($process,"ohall"),0);
	$inoh = round(odbc_result($process,"inoh"),0);
	$icoh = round(odbc_result($process,"icoh"),0);
	$ohcur=$inoh+$icoh;
	
	$oterall = round(odbc_result($process,"oterall"),0);
	$oter = round(odbc_result($process,"oter"),0);
	$otercom = round(odbc_result($process,"otercom"),0);
	$otercur=$oter+$otercom;
	
	$totalall = round(odbc_result($process,"totalall"),0);
	$total = round(odbc_result($process,"total"),0);
	$totalcom = round(odbc_result($process,"totalcom"),0);
	$totalcur=$total+$totalcom;
	
	$rt = round(odbc_result($process,"rt"),0);
	$rt_balance = round(odbc_result($process,"rt_balance"),0);
	$rtcur=$rt-$totalcur;
	//echo "Agency =$agency,Npron=$nprno ,Stafall=$stafall,Staf=$staf ,stafcom=$stafcom ,eqptall=$eqptall,eqpt=$eqpt,eqptcom=$eqptcom,consall=$consall,cons=$cons,conscom=$conscom,contall=$contall, cont=$cont, contcom=$contcom, travall=$travall ,trav=$trav, travcom=$travcom, compall= $compall, comp=$comp , compcom=$compcom, ohall=$ohall, inoh=$inoh, icoh=$icoh,oterall = $oterall, oter=$oter, otercom=$otercom, totalall=$totalall, total=$total, totalcom=$totalcom,rt=$rt, rt_balance=$rt_balance";
	// calculated values put in table
	
	?>
	  <tr>
		<th><div align="center">Account Head</div></th>
		<th><div align="center">Budget <br />Allocation</div></th>
		<th><div align="center">Expenditure</div></th>
		<th><div align="center">Balance <br />Commitments</div></th>
		<th><div align="center">Total<br />Exp + Com</div></th>
	  </tr>
	   <tr class="rowA">
		<td>Staff</td>
		<td><div align="right"><?PHP echo "$stafall"; ?></div></td>
		<td><div align="right"><?PHP echo "$staf"; ?></div></td>
		<td><div align="right"><?PHP echo "$stafcom"; ?></div></td>
		<td><div align="right"><?PHP echo "$stafcur"; ?></div></td>
	  </tr>
	   <tr class="rowB">
		<td>Equipment</td>
		<td><div align="right"><?PHP echo "$eqptall"; ?></div></td>
		<td><div align="right"><?PHP echo "$eqpt"; ?></div></td>
		<td><div align="right"><?PHP echo "$eqptcom"; ?></div></td>
		<td><div align="right"><?PHP echo "$eqptcur"; ?></div></td>
	  </tr>
	   <tr class="rowA">
		<td>Consumables</td>
		<td><div align="right"><?PHP echo "$consall"; ?></div></td>
		<td><div align="right"><?PHP echo "$cons"; ?></div></td>
		<td><div align="right"><?PHP echo "$conscom"; ?></div></td>
		<td><div align="right"><?PHP echo "$conscur"; ?></div></td>
	  </tr>
	   <tr class="rowB">
		<td>Contingencies</td>
		<td><div align="right"><?PHP echo "$contall"; ?></div></td>
		<td><div align="right"><?PHP echo "$cont"; ?></div></td>
		<td><div align="right"><?PHP echo "$contcom"; ?></div></td>
		<td><div align="right"><?PHP echo "$contcur"; ?></div></td>
	  </tr>
	   <tr class="rowA">
		<td>Travel</td>
		<td><div align="right"><?PHP echo "$travall"; ?></div></td>
		<td><div align="right"><?PHP echo "$trav"; ?></div></td>
		<td><div align="right"><?PHP echo "$travcom"; ?></div></td>
		<td><div align="right"><?PHP echo "$travcur"; ?></div></td>
	  </tr>
	   <tr class="rowB">
		<td>Components</td>
		<td><div align="right"><?PHP echo "$compall"; ?></div></td>
		<td><div align="right"><?PHP echo "$comp"; ?></div></td>
		<td><div align="right"><?PHP echo "$compcom"; ?></div></td>
		<td><div align="right"><?PHP echo "$compcur"; ?></div></td>
	  </tr>
	   <tr class="rowA">
		<td>Inst.Overhead</td>
		<td><div align="right"><?PHP echo "$ohall"; ?></div></td>
		<td><div align="right"><?PHP echo "$inoh"; ?></div></td>
		<td><div align="right"><?PHP echo "$icoh"; ?></div></td>
		<td><div align="right"><?PHP echo "$ohcur"; ?></div></td>
	  </tr>
	   <tr class="rowB">
		<td>Others</td>
		<td><div align="right"><?PHP echo "$oterall"; ?></div></td>
		<td><div align="right"><?PHP echo "$oter"; ?></div></td>
		<td><div align="right"><?PHP echo "$otercom"; ?></div></td>
		<td><div align="right"><?PHP echo "$otercur"; ?></div></td>
	  </tr>
	   <tr class="rowA">
		<th>Total</th>
		<th><div align="right"><?PHP echo "$totalall"; ?></div></th>
		<th><div align="right"><?PHP echo "$total"; ?></div></th>
		<th><div align="right"><?PHP echo "$totalcom"; ?></div></th>
		<th><div align="right"><?PHP echo "$totalcur"; ?></div></th>
	  </tr>
	<?php
	
	if ($agency<>"ISRO")
	{
	?>
	<tr>
	<td colspan=2  align="right">Total Grant Received :<b> <?php echo "$rt"; ?> </b></td>
	<td colspan=3  align="right">Balance After Total Expenditure + Commitments : <b><?php echo "$rtcur"; ?></b> </td>
	</tr>
	<?php 
	}
	
	}
	else
	{
	//echo "Error in Query";
	}
	
	}
	//}
	?>
	<div id="footer">
	<p></p>
	</div>
	</div>
	</div>
	</body>
	<script type="text/javascript">
	
	function poptastic(url)
	{
	var newwindow;
		newwindow=window.open(url,'name','height=400,width=1100,scrollbars=yes');
		newwindow.focus();
	<!--	if (window.focus) {newwindow.focus()} -->
	}
	</script>
	</html>
