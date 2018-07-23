
<?php
session_start(); 
$dsn="FACCTDSN";
$dusername="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$dusername,$password) or die("ODBC Connection Failed");
if(isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$sqlquery="select userid,instid,logname,usermode,name from webauth where logname='$username'";
//$sqlquery="select userid,instid,passwd1,logname from webauth where logname='$username'";
echo "sqlquery";
$process=odbc_exec($sqlconnect,$sqlquery) or die("Failed to get data");
//session_register("logname"); 
//session_register("passwd1");
//session_register("instid");
//session_register("userid");
$logname="";
$passwd1="";

while(odbc_fetch_row($process)) {
$userid=odbc_result($process,"userid");
$instid=odbc_result($process,"instid");
$usermode=odbc_result($process,"usermode");
$name=odbc_result($process,"name");
$logname=odbc_result($process,"logname");
 }
$_SESSION["logname"]=trim($logname);
//$_SESSION["passwd1"]=trim($passwd1);
$_SESSION["userid"]=trim($userid);
$_SESSION["instid"]=trim($instid);
$_SESSION["usermode"]=trim($usermode);
$_SESSION["sessid"]=$_SESSION["PHPSESSID"];
$date=date('Y/m/d');
$time=date('H:i:s');
$sql="insert into logindetailsnew(ldate,ltime,instid,name,usermode) values('$date','$time','$instid','$name','$usermode')";
$process=odbc_exec($sqlconnect,$sql) or die("Failed to get user information");

	echo "You are = ". $_SESSION['username']; //retrieve data
	echo "User:$instid";
	echo "<br>Instid:$instid";
echo "<br>userid:$userid<br>instid:$instid";
//header("http://icsris.iitm.ac.in/AIS/split.php");
	$redir="Location: https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/icsrisacct.php";
//	$redir="Location: https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/icsrismain.php";
	echo "$redir";
	header($redir);
	//unset($_SESSION['username']);
	//session_destroy();
}
else
{
	//$redir="Location: https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/authenticate.php";
	//header($redir);
}
?>
