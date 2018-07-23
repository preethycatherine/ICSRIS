<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<?php
//log them out
//$logout=$_GET['logout'];
//if ($logout=="yes"){ //destroy the session
//	session_start();
//	$_SESSION = array();
//	session_destroy();
//}

//force the browser to use ssl (STRONGLY RECOMMENDED!!!!!!!!)
if ($_SERVER["SERVER_PORT"]!=80){ header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); exit(); }

//you should look into using PECL filter or some form of filtering here for POST variables
$username=strtoupper($_POST["username"]); //remove case sensitivity on the username
$password=$_POST["password"];
$formage=$_POST["formage"];

//echo "<br> UserName: $username";
//echo "<br> password: $password";

if ($_POST["oldform"]){ //prevent null bind

	if ($username!=NULL && $password!=NULL)
	{

		//include the class and create a connection
		//echo "$username";
		//echo "$formage";
		$dsn="FACCTDSN";
		$dusername="sa";
		$password="IcsR@123#";
		//$Paybillno="000000";
		$sqlconnect=odbc_connect($dsn,$dusername,$password) or die("ODBC Connection Failed");
		$username=$username;
		$sqlquery="select instid from webauth where logname like 'ashok1%'";
		odbc_close_all();
		$sqlconnect=odbc_connect($dsn,$dusername,$password) or die("ODBC Connection Failed");
		
		
		//$sqlquery="select Emailid,Paybillno,Name,usermode from TestPrjLogin where Emailid like '$username' and Password like '$password1'";
		echo "$sqlquery";
		$process=odbc_exec($sqlconnect,$sqlquery) or die("Failed to get data");
		
		if(odbc_fetch_row($process))
		{
			session_start();
			$_SESSION["username"]=$username;
			$redir="Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/authenticate.php";
			header($redir);
			exit;

		}

	//}	//include the class and create a connection
		//include ("adLDAP.php");
        //try {
		 //   $adldap = new adLDAP();
        //}
        //catch (adLDAPException $e) {
        //    echo $e; exit();   
        //}
		
		//authenticate the user
		//if ($adldap -> authenticate($username,$password)){
			//establish your session and redirect
		//	session_start();
		//	$_SESSION["username"]=$username;
		//	$redir="Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/authenticate.php";
		//	header($redir);
		//	exit;
		//}
	}
	$failed=1;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-family: "Times New Roman", Times, serif;
	font-size: 14px;
	color: #995500;
	font-weight: bold;
}
.style3 {
	color: #FF0000;
	font-size: 24pt;
}
-->
</style>
</head>
<body>
<div id="outer">
	<div id="header">
		<h1><a href="login.php">Centre for IC & SR</a></h1>
		<h1><a href="login.php">Indian Institute of Technology Madras, Chennai</a></h1>
		<h2>Information System</h2>
	</div>
  <div id="menu" align="center" >
		<ul>
			<li class="first"><b></b></li>
		</ul>
	</div>
	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
				<h2>Welcome to IC & SR Project Accounts Information System</h2>
		
<blockquote>
<div align="justify"   style="font-size:13pt" >
<div align="center"><img src="images/DSCF0656.jpg" alt="icsr" width="700" height="450" /></div>
<p>Coordinators can access Project Accounts Information using their institute email_id and password.</p>
</div>
</blockquote>
		  </div>
		</div>
		<div class="InfoOne">
<form name="LoginForm" method="post" action='<?php echo $_SERVER["PHP_SELF"]; ?>'>
<input type='hidden' name='oldform' value='1'>

<input name="submitClicks" value="0" type="hidden">
<input name="browser" type="hidden">
<input name="pressedGo" type="hidden">
<input name="changetext" value="0" type="hidden">
<input name="BV_SessionID" value="@@@@1338243501.1281441299@@@@" type="hidden">
<input name="BV_EngineID" value="cccladelegkmgjecefecehidfgmdfil.0" type="hidden">
<div id="secondaryContent">
<h3>Login</h3>
<div>
<table cellspacing="0" cellpadding="3" bordercolor="#000000" border="0" align="center" width="96%" style="margin-top: 10px; border-bottom: 1px solid rgb(204, 204, 204);" class="txt1">
  <tbody><tr>
    <td width="40%" class="style1">Username</td>
    <td width="1%">:</td>
    <td width="59%"><input type="text" name="username" id="textfield" '<?php echo ($username); ?>' class="txtfld" size="12"></td>
  </tr>
  <tr>
    <td class="style1">Password</td>
    <td>:</td>
    <td><input type="password" name="password" id="textfield" class="txtfld" size="12"></td>
  </tr>
    <script>
  document.LoginForm.userName.focus()
  </script>
  <tr>
    <td align="right" colspan="3">
	<input type="submit" name="button" id="button" class="buttonSubmit" value="Login" onclick="return validate();">	
	<?php if ($failed){ echo ("<br>Login Failed!<br><br>\n"); } ?> </td>
  </tr>
  <tr><td align="left" colspan="3"><ul><li class="style1">Use Institute emailid and password</li></ul> </td></tr>
  </tbody></table></td></tr></tbody></table></div></form>
			<h3>Contact</h3>
			<div><p><ul><li class="style1">For assistance call 9742 </li><li class="style1">Mail to secicsr@iitm.ac.in</li></ul></p>
			</div>
			<h3>Quick Links</h3>
			<h5><p><ul><li class="style1"><a href="http://www.icandsr.iitm.ac.in/">ICSR External Website</a></li><li class="style1"><a href="http://www.icsr.iitm.ac.in">ICSR Internal Website</a></li><li class="style1"><a href="http://www.iitm.ac.in/">IIT Madras Home</a></li></ul></p></h5>
	  </div>
		<div class="clear"></div>
	</div>
	<div id="footer">
	</div>
</div>
<script type="text/javascript">


    function validate()
  {
if(!isEmpty(document.LoginForm.userName.value,"userName"))
		{
			document.LoginForm.userName.focus();
			return false;
		}

if(document.LoginForm.password.value.length==0)
		{
			alert("Please Enter The Password");
			document.LoginForm.password.focus();
			return false;
		}

}
function isEmpty(s,txt_fld)
{  
    if ((s == null) || (s.length == 0))
	{	
		alert("Please enter your "+txt_fld);
        return false;
	}
    for (var i=0; i<s.length; i++)
	{
        if(s.charAt(i) != " ")
		      return true;
        else{
		      alert("Please enter your "+txt_fld);
		  	  return false
		   }//end of else
		 }//end of for
		 return true;

}
document.onkeydown = CheckKeyPress ;
</script>
</body>
</html>
