<?php
ob_start();
session_start();
include("common/function.php");
$classcall=new Newconnection();
$wrnglogin=0;
if(isset($_POST['login']))
{
	//echo $_POST['loginid']."-".$_POST['password'];
	$query="select * from tbl_admin_list where admin_user_id=? and admin_password=? and d_flg=?";
	$array=array($_POST['loginid'],$_POST['password'],0); 
	$result=$classcall->selectQuery($query,$array);
	$usercount=count($result);
	if($usercount>0)
	{
		$_SESSION['admin_user_id']=$result[0]['admin_user_id'];
		$_SESSION['admin_auto_id']=$result[0]['admin_auto_id'];
		if($result[0]['admin_auto_id']==1) 	header('Location: home.php');
		elseif($result[0]['admin_auto_id']==3) 	header('Location: uc_upload.php');
	}
	else
	{
		$wrnglogin=1;
	}
}
?>
<html>
<head>
<title> ADMINISTRATOR PANEL </title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/adminstyle.css" rel="stylesheet">

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="col-xs-12">&nbsp;</div><div class="col-xs-12">&nbsp;</div>
	<div class="body container">
		<div class="mainbody"> 
			<div class="main col-xs-12">
				<div class="login-form">
					<h1>Administrator Login</h1>
					<div class="head">
						<img src="img/faculty.png" alt=""/>
					</div>
					<form method="post" action="" >
						<input type="text" class="text" name="loginid" value="" placeholder="Login ID" required >
						<input type="password" value="" name="password" placeholder="Password" required >
						<div class="submit">
							<input type="submit" name="login" value="LOGIN" >
						</div>	
						<?php if($wrnglogin==1) { ?>
							<h5 class="text-center err">Login ID / Password is Incorrect</h5>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12">&nbsp;</div><div class="col-xs-12">&nbsp;</div><div class="col-xs-12">&nbsp;</div><div class="col-xs-12">&nbsp;</div>
</body>
</html>