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

//echo $_SERVER["SERVER_PORT"];
//force the browser to use ssl (STRONGLY RECOMMENDED!!!!!!!!)

if ($_SERVER["SERVER_PORT"]!=443){ header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); exit(); }

//you should look into using PECL filter or some form of filtering here for POST variables
$username=$_POST["username"]; //remove case sensitivity on the username
$password=$_POST["password"];
$formage=$_POST["formage"];

//echo "<br> UserName: $username";
//echo "<br> password: $password";

if ($_POST["oldform"]){ //prevent null bind

	if ($username!="" && $password!=""){
		//include the class and create a connection
		
		if ($username=="admin" && $password=="accountsmgr"){
			session_start();
			$_SESSION["username"]=$username;
			$redir="Location: https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/invoices.php";
			header($redir);
			exit;
		}
		elseif ($username=="icsraccounts" && $password=="icsraccountsmgr"){
			session_start();
			$_SESSION["username"]=$username;
			$redir="Location: https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/invoices.php";
			header($redir);
			exit;
		}
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
	.style4 {font-family: "Times New Roman", Times, serif; font-size: 14px; color: #0066CC; font-weight: bold; }
	.style7 {color: #0066CC}
	.style9 {color: #0066D5}
	.style10 {color: #0066DB}
	.style11 {color: #006699}
	.style12 {
		color: #006699;
		font-weight: bold;
		font-style: italic;
	}
	-->
	</style>
	</head>
	<body>
	<div id="outer">
		<div id="header">
		 <table height="75" align="center">			
		 <tr>
		   <td><img src="images/logo.png" width="90" height="90" /></td><td>&nbsp;&nbsp;&nbsp;</td>
		   <td>	
			<h1><a href="icsrisacct.php">Centre for IC & SR</a></h1>
			<h1><a href="icsrisacct.php">Indian Institute of Technology Madras, Chennai</a></h1>
			<h2>IC&SR Project Information System</h2>
		   </td>
		  </tr>
		 </table>
		</div>
	  <div id="menu" align="center" >
			<ul>
				<li class="first"><b></b></li>
			</ul>
		</div>
		<div id="content">
			<div id="primaryContentContainer">
				<div id="primaryContentindex">
					<h2 class="style12">Welcome to IC & SR Project Information System</h2>		
						<blockquote>
						<div align="justify"   style="font-size:13pt" >
						<div align="center"><img src="images/DSCF0656.jpg" alt="icsr" width="700" height="450" /></div>
						<p class="style11">Coordinators can access Project Information using their institute email_id and password.</p>
						</div>
						</blockquote>
			  </div>
			</div>
	<div class="InfoOne">
	<form name="LoginForm" method="post" action='index.php'>
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
	<table cellspacing="0" cellpadding="3" bordercolor="#000000" border="0" align="center" width="75%" style="margin-top: 10px; border-bottom: 1px solid rgb(204, 204, 204);" class="txt1">
	  <tbody><tr>
		<td width="40%" class="style4">Username</td>
		<td width="1%">:</td>
		<td width="59%"><input type="text" name="username" id="textfield" '<?php echo ($username); ?>' class="txtfld" size="12"></td>
	  </tr>
	  <tr>
		<td class="style4">Password</td>
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
	   </tbody></table></div></form>
				
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
