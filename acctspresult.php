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
				
<div align="center"><h3>SPONSORED PROJECTS RESULT SCREEN</h3></div>


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
	header('location: http://icsris.iitm.ac.in/sessionout.php');
	exit;

}
$dsn="FACCT1DSN";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection1 Failed");
$sqlconnectacct=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("sql connection failed");
if(!isset($_SESSION["sponresult"]))
{


$sql1="";
$sql2="";
$sql3="";
$sql4="";
$sql5="";
$sql6="";
$sql7="";
$sql8="";
$sql9="";
$count=0;
$i=1;


foreach ($_POST["opinion"] as $val)
{
$choice[$i]=$val;
if ($choice[$i]<>'') 
$count++;
//echo "<br>$choice[$i]";
$i++;
}

$optvalue=$_POST["radiobutton"];

$sponsor=trim($_POST["sponsor"]);
$dept=trim($_POST["dept"]);
$coordin=trim($_POST["coordin"]);
$prjvalue=$_POST["prjvalue"];
$prjnumber=$_POST["prjnumber"];
$prjnumber="%".$prjnumber."%";

//echo "Project Number : $prjnumber";

$foryr=$_POST["FORYR"];


$from=$_POST["FROM"];
$to=$_POST["TO"];

//echo "<br>From $from To $to";


//echo "<br> $sponsor | $dept | $coordin | $prjvalue";

//echo "\n Countvalue=$count";
//echo "<br>(($choice[1]='ck1') and ($count=1)";
$sqle=" order by close_date desc";

$c=1;
while($c<=$count)
{
switch($choice[$c])
{
case 'ck1':
			$sql1=" and substring(nprno,11,4) like '$sponsor'";
			break;
case 'ck2':
			$sql2=" and coor_name like '$coordin'";
			break;
case 'ck3':
			$sql3=" and substring(nprno,1,3) like '$dept'";
			break;
case 'ck4':
			$sql4=" and pramount >'$prjvalue'";
			$sqle=" order by pramount desc";
			break;
case 'ck5':
			$today = date('Y/m/d');
			$sql5=" and close_date>=GETDATE()";
			//$sqle=" order by start_date desc";
			$sqle=" order by close_date desc";
			break; 
case 'ck6':
			$sql6=" and close_date<GETDATE()";
			//$sql6=" and close_date between GETDATE() and GETDATE()+30"; 
			//$sqle= " order by close_date desc";
			$sqle=" order by close_date desc";
			break;
case 'ck7':
			$sql7=" and nprno like '$prjnumber'";
			break;
}
$c++;
}



//$sql= "select aprlno,title,coor_name,spon_agen,convert(varchar,start_date,105) start_date ,convert(varchar,close_date,105) close_date,round(sanvalue,0) as sanvalue from pmaster where proj_rem = 'new' ";


//$sql= "select aprlno,title,coor_name,spon_agen,start_date,close_date,round(sanvalue,0) as sanvalue from pmaster where proj_rem = 'new' ";




//$sql="select aprlno,title,coor_name,spon_agen,start_date,close_date,round(sanvalue,0) as sanvalue from pmaster 
//where proj_rem = 'new' and ((substring(aprlno,4,4) in ('9899','9900','0001','0102','0203','0304','0405','0506','0607','0708','0809','0910'))or aprlno like '%isro%' or //aprlno like '%icsr%' or aprlno like '%htsl%' or aprlno like '%ddf%')";

$sql="select nprno as aprlno,title,coor_name,substring(nprno,11,4) as spon_agen,start_date,close_date,round(pramount,0) as sanvalue from mstlst
where  ((substring(nprno,4,4) in ('9899','9900','0001','0102','0203','0304','0405','0506','0607','0708','0809','0910','1011','1112','1213','1314','1415','1516','1617','1718','1819'))or 
nprno like '%isro%' or nprno like '%icsr%' or nprno like '%htsl%' or nprno like '%ddf%' or nprno like '%devp%' or nprno like '%ics%' or nprno like '%iit%')";

if (strcmp($optvalue,"FY")==0)
{
$sql="select nprno as aprlno,title,coor_name,substring(nprno,11,4) as spon_agen,start_date,close_date,round(pramount,0) as sanvalue from mstlst where nprno <> ''  ";
$sql8="and substring(nprno,4,4)='".$foryr."'";
$sql9="";
}

if (strcmp($optvalue,"FT")==0)
{
$sql="select nprno as aprlno,title,coor_name,substring(nprno,11,4) as spon_agen,start_date,close_date,round(pramount,0) as sanvalue from mstlst where nprno <>'' ";
//echo "<br>From $from To $to";
if (($from>=5051) and ($to<=5051))
{
$sql9=" and (((substring(nprno,4,4)>='$from') and (substring(nprno,4,4)<='9900')) or((substring(nprno,4,4)>='0001') and (substring(nprno,4,4)<='$to'))) ";
//echo "<br> one sql9='$sql9'";
}
elseif(($from<=5051) and ($to<=5051))
{
$sql9=" and (((substring(nprno,4,4)>='$from') and (substring(nprno,4,4)<='$to')) or((substring(nprno,4,4)>='$from') and (substring(nprno,4,4)<='$to'))) ";
//echo "<br> two sql9='$sql9'";
}
elseif(($from>=5051) and ($to>=5051))
{
$sql9=" and (((substring(nprno,4,4)>='$from') and (substring(nprno,4,4)<='$to')) or((substring(nprno,4,4)>='$from') and (substring(nprno,4,4)<='$to'))) ";
//echo "<br> three sql9='$sql9'";
}

$sql8="";
}

$sql=$sql.$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sqle;
//echo "<br> $sql";
if(isset($_SESSION["consresult"]))
{
unset($_SESSION["consresult"]);
}
if(isset($_SESSION["sponresult"]))
{
unset($_SESSION["sponresult"]);
}
if(isset($_SESSION["pcfresult"]))
{
unset($_SESSION["pcfresult"]);
}
if(isset($_SESSION["rmfresult"]))
{
unset($_SESSION["rmfresult"]);
}
$_SESSION["sponresult"]="$sql";
//odbc_close($sqlconnect);
}
else				//End of Session Result
{
//$sqlconnectacct=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("sql connection failed");
//$dsn="FACCT1DSN";
//$username="sa";
//$password="IcsR@123#";
//$sqlconnect=odbc_connect($dsn,$username,$password) or die("Connection Failed");
$sql=$_SESSION["sponresult"];
}
if(isset($_SESSION["nprno"]))
{
unset($_SESSION["nprno"]);
}
//echo "<br>$sql";
$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection1 Failed");
$process=odbc_exec($sqlconnect,$sql) or die("Query Execution Failed");

//    <td><div align="center">Title</div></td>
//    <td><div align="center">Sponsoring Agency</div></td>
?>

<table width="100%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th><div align="center">Project Number</div></th>
    <th><div align="center">Start Date </div></th>
    <th><div align="center">Close Date</div></th>
    <th><div align="center">Project Value</div></th>
    <th><div align="center">Grant Received</div></th>
    <th><div align="center">Total Exp.+Com. </div></th>
    <th><div align="center">Balance</div></th>
  </tr>
 <?php
$count=1;
while(odbc_fetch_row($process))
{
$aprlno=odbc_result($process,"aprlno");
$title=odbc_result($process,"title");
$coor_name=odbc_result($process,"coor_name");
$spon_agen=odbc_result($process,"spon_agen");
$star_date=odbc_result($process,"start_date");
$start_date=date('d-m-Y',strtotime($star_date));
$clos_date=odbc_result($process,"close_date");
$close_date=date('d-m-Y',strtotime($clos_date));
$pramount=odbc_result($process,"sanvalue");
$count = fmod($count,2);

if($count==0)
{
$cls="class=rowA";
}
else
{
$cls="class=rowB";
}
//echo substr($aprlno,0,7);
if((strcmp('CHY0910258',substr($aprlno,0,10))==0) or (strcmp('MEE0809238',substr($aprlno,0,10))==0) or (strcmp('CHE0304062',substr($aprlno,0,10))==0) or (strcmp('CHE0304063',substr($aprlno,0,10))==0) or (strcmp('CHE0304064',substr($aprlno,0,10))==0) or (strcmp('ELE0506130',substr($aprlno,0,10))==0) or (strcmp('MEE0708226',substr($aprlno,0,10))==0) or (strcmp('MEE0809245',substr($aprlno,0,10))==0) or (strcmp('PHY0607185',substr($aprlno,0,10))==0) or (strcmp('PHY0708199',substr($aprlno,0,10))==0))
{
$aprlnoc=$aprlno;
}
elseif((strcmp('IITEQPT',substr($aprlno,0,7))==0))
{
$aprlnoc=$aprlno;
//echo "iiteqpt";
}
else
{
$aprlnoc=substr($aprlno,0,10)."%";
//echo "notmal";
}

//echo "<br>Project Number: $aprlnoc ";
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
//echo "RTBalance:$rtbal";
}
else
{
$rt="NA";
$rtbal="NA";
$page = $_SERVER['PHP_SELF'];
$sec = "1";
header("Refresh: $sec; url=$page");
}


 ?>
  <tr <?php echo "$cls"; ?> >
    <td><div align="center"><a href="acctspsum.php?nprno=<?php echo "$aprlno"; ?>" > <?php echo "$aprlno"; ?></a></div></td>
<!--    <td><div align="center"><?php echo "$coor_name"; ?></div></td> -->
    <td><div align="center"><?php echo "$start_date"; ?></div></td>
    <td><div align="center"><?php echo "$close_date"; ?></div></td>
    <td><div align="right"><?php echo "$pramount"; ?></div></td>
    <td><div align="right"><?php echo "$rt"; ?></div></td>
    <td><div align="right"><?php echo "$totalcur"; ?></div></td>
    <td><div align="right"><?php echo "$rtbal"; ?></div></td>
  </tr>

<?php
$count=$count+1;
}
}
?>
</table>
</div>
 </div>

<div id="footer">
<p></p>
 </div>
</div>
</div>

</body>
</html>
