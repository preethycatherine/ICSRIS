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
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<?php
echo $_SESSION["username"];
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
			//echo "<br>instid:$insid<br>usermode:$usermode";
			if(strcmp($usermode,"NORMAL")==0)
			{
			$_SESSION['pcfid']=$insid;
			$_SESSION['rmfid']=$insid;
			}
		} 
		else
		{
			//echo "<br>session destroy ";
			session_destroy();
			setcookie("PHPSESSID","",time()-3600,"/");
			header('location: index.php');
			exit;
		
		}
//Print_r ($_SESSION);

?>
<div id="outer">
	<!--<div id="menu">-->
	<!--<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h4>
	</div>-->
	<!--=========== BEGIN MENU SECTION ================-->
			 <script src="https://www.w3schools.com/lib/w3.js"></script>
			  <?php  if($_SESSION["usermode"]=="SUPER"){ ?>
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
						ini_set('display_errors', 1);
						ini_set('display_startup_errors', 1);
						error_reporting(E_ALL);
					
							$cdate=""; $ddate="";
							$cdate=date("Y-m-d",time());
							
							
						include_once("common/function.php");
						$classcall=new Newconnection();
						$query="SELECT * FROM tbl_faqs where Department='".$_GET['dept']."' ORDER BY DINP DESC";
						$array=array();
						$faqslists=$classcall->selectQuery($query,$array);
						?>
						<table width="100%" align="center">
						<tr><td><h3><font color="#003399" style="font-family:Verdana, Arial, Helvetica, sans-serif;"><b>FAQs : <?php echo $_GET['dept']; ?></b></font></h3> </td></tr>
						</table>
					<?php
						foreach($faqslists as $faqlists)
						{ ?>
						<table width="100%" align="center" border="1" bordercolordark="#000000">
						<tr bgcolor="#C8EFF2"><td><h4><font color="#003399"><b>Q : <?php echo $faqlists['Question']; ?></b></font></h4> </td></tr>
						<tr><td><h4><font color="#003399"><b>A : <?php	
						
						/*function make_links_clickable($text){
								return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $text);
							}
						echo make_links_clickable($faqlists['Answer']); */
						
						$text = $faqlists['Answer'];
						$reg_exUrl = "/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3})([\s.,;\?\!]|$)/";
						
						if (preg_match_all($reg_exUrl, $text, $matches)) $text=preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', $text);
						
						echo $text;
						?></b></font></h4> </td></tr>
						
					</table>
					<?php } ?>
					
			
			</div>
		</div>
	</div>
</div>
<?php
}
?>
</body>
</html>
