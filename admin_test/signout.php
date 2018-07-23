<html>
<head>
<meta http-equiv="GENERATOR" content="Microsoft Visual Studio 6.0">
</head>
<TITLE>Sign out</title></head>
<?php
session_start();
if(isset($_SESSION['nprno']))
{
unset($_SESSION['nprno']); 
}
if(isset($_SESSION['logname']))
{
unset($_SESSION['logname']); 
}
if(isset($_SESSION['passwd1']))
{
unset($_SESSION['passwd1']); 
}
if(isset($_SESSION['instid']))
{
unset($_SESSION['instid']); 
}
if(isset($_SESSION['instid']))
{
unset($_SESSION['userid']); 
}
if(isset($_SESSION['cprno']))
{
unset($_SESSION['cprno']); 
}

session_unset(); 
session_destroy();
setcookie ("icsris", 'https://icsris.iitm.ac.in/', time()-3600*24*(2), '/', "", 0 );  
setcookie("PHPSESSID","",time()-3600,"/");

header("location: https://icsris.iitm.ac.in/ICSRIS/admin");
?>


</body>
</html>
