
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
<!--<link href="css/style.css" rel="stylesheet" type="text/css" />-->

<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" type="text/css" href="css/tabstyles.css" />
<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>   
<link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
<style type="text/css">
<!--
.style1 {
	color: #FF6600;
	font-style: italic;
	font-weight: bold;
}
-->

 /* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #006666;
}

/* Style the buttons that are used to open the tab content */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #FFFFFF;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
} 
.style2 {
	font-weight: bold;
	color: #FF6600;
	font-size: 12;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: medium;
}
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
	height:20%;
    background-color: #006699;
    color: white;
    text-align: center;
}
.footer_bottom {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
	height:3%;
    background-color: #003300;
    color: white;
    text-align: center;
}
a {
    color: #FFFFFF;
}

a:hover 
{
     color:#00A0C6; 
     text-decoration:none; 
     cursor:pointer;  
}
.style4 {
	color: #003366;
	font-weight: bold;
}
</style>
<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>   
<script src="https://www.w3schools.com/lib/w3.js"></script>
	
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
<!--  <div w3-include-html="menu.html"></div>-->
<div w3-include-html="menu_test.php"></div>
  <?php  } ?>
  <script>
				w3.includeHTML();
				</script>
  <!--=========== END MENU SECTION ================-->




  <div id="content">
    <div id="primaryContentContainer">
    <div id="primaryContent">
    <table>
      <tr>
        <td width="40%">
			<table>
				  <tr>
					<td><img src="images/dean.jpg" height="90" width="90" /> </td>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td align="left"><br />
					  <h2>Dean's Message</h2>
					  - <span class="style1">Prof.  Ravindra Gettu </span></td>
				  </tr>
			</table>
			<table width="100%">
				  <tr>
					<td valign="top"><p align="justify" class="style3"> Dear colleague: The IC&SR site gives the regulations, forms and links to the accounts of your projects, as well as the imprest account and IP dashboard. We also give the names and contact details of the heads of different sections, which handle relevant matters. </p></td>
				</tr>
			</table>
		</td>
			
		<td valign="top" width="60%">
			<table width="100%">
				  <tr>
					<td valign="top"><br /><br /><br />
						<!-- Tab links --><?php //echo date('Y', mktime(0, 0, 0, 6+date('m'))); ?>
							<div class="tab">
							  <button class="tablinks style2" onclick="openCity(event, 'Calls')" id="defaultOpen">Calls for Proposals</button>
							  <button class="tablinks style2" onclick="openCity(event, 'Events')">Interest for Collaboration</button>
							  <button class="tablinks style2" onclick="openCity(event, 'Quick Links')">Quick Links</button>
							</div>
							
							<!-- Tab content -->
							<div id="Calls" class="tabcontent">
							  <h3>Calls for Proposals</h3>
							 
							 <?php
								ini_set('display_errors', 1);
								ini_set('display_startup_errors', 1);
								error_reporting(E_ALL);
							
									$cdate=""; $ddate="";
									$cdate=date("Y-m-d",time());
									
									
								include_once("common/function.php");
								$classcall=new Newconnection();
								$query="SELECT * FROM tbl_proposals where date>='".$cdate."' ORDER BY date ASC";
								$array=array();
								$proposalslists=$classcall->selectQuery($query,$array);
								if(count($proposalslists)>3)
								{
								?>
								<marquee id="scrolls" behavior="scroll" direction="up" style="height:150px;" onMouseOver="document.getElementById('scrolls').stop();" onMouseOut="document.getElementById('scrolls').start();" scrolldelay="200">
								<?php
								}
								foreach($proposalslists as $proposallists)
								{ 
								?>
									<p><img src="img/news.jpg" alt="img" width="25" height="25">&nbsp;&nbsp; <a href="<?php echo $proposallists['Link']; ?>" target="_blank"><?php echo $proposallists['Title']; ?> <span class="style4">Due Date: <?php echo date("M d 'Y",strtotime($proposallists['date'])); ?> </span></a></p>
							<?php }	 ?>
							  </marquee>
							</div>
							
							<div id="Events" class="tabcontent">
							  <h3>Interest for Collaboration</h3>
							  <?php
							 	$query="SELECT * FROM tbl_collaborations ORDER BY DINP DESC";
								$array=array();
								$collaborationslists=$classcall->selectQuery($query,$array);
								if(count($collaborationslists)>3)
								{
								?>
								<marquee id="scrollscolla" behavior="scroll" direction="up" style="height:150px;" onMouseOver="document.getElementById('scrollscolla').stop();" onMouseOut="document.getElementById('scrollscolla').start();" scrolldelay="200">
								<?php
								}
								foreach($collaborationslists as $collaborationlists)
								{ 
								?>
									<p><img src="img/news.jpg" alt="img" width="25" height="25">&nbsp;&nbsp; <a href="<?php echo $collaborationlists['Link']; ?>" target="_blank"><?php echo $collaborationlists['Title']; ?>  </span></a></p>
							<?php }	 ?>
							  </marquee>
							</div>
							
							<div id="Announcements" class="tabcontent">
							  <h3>Announcements</h3>
							  <p><img src="img/announce.jpg" alt="img" width="25" height="25">&nbsp;&nbsp; <a href="https://icsr.iitm.ac.in/file/pdf/Draft PCSL Coordinator.pdf" target="_blank">Position for temporary posts of  Coordinator for the "PCSL" project on Carbon Zero Challenge in the Department of Civil Engineering</a></p>
							 <p><img src="img/announce.jpg" alt="img" width="25" height="25">&nbsp;&nbsp; <a href="https://icsr.iitm.ac.in/file/pdf/Draft PCSL Senior Manager.pdf" target="_blank">Position for temporary posts of Senior Manager for the "PCSL" project on Carbon Zero Challenge in the Department of Civil Engineering</a></p>
							</div> 		
							
							<div id="Quick Links" class="tabcontent">
							  <h3>Quick Links</h3>
							  <?php
							 	$query="SELECT * FROM tbl_links ORDER BY DINP";
								$array=array();
								$linkslists=$classcall->selectQuery($query,$array);
								if(count($linkslists)>3)
								{
								?>
								<marquee id="scrollslink" behavior="scroll" direction="up" style="height:150px;" onMouseOver="document.getElementById('scrollslink').stop();" onMouseOut="document.getElementById('scrollslink').start();" scrolldelay="200">
								<?php
								}
								foreach($linkslists as $linklists)
								{ 
								?>
									<p><img src="img/news.jpg" alt="img" width="25" height="25">&nbsp;&nbsp; <a href="<?php echo $linklists['Link']; ?>" target="_blank"><?php echo $linklists['Title']; ?></a></p>
							<?php }	 ?>
							  </marquee>
							</div> 	
							
							<script>
								function openCity(evt, cityName) {
									var i, tabcontent, tablinks;
									tabcontent = document.getElementsByClassName("tabcontent");
									for (i = 0; i < tabcontent.length; i++) {
										tabcontent[i].style.display = "none";
									}
									tablinks = document.getElementsByClassName("tablinks");
									for (i = 0; i < tablinks.length; i++) {
										tablinks[i].className = tablinks[i].className.replace(" active", "");
									}
									document.getElementById(cityName).style.display = "block";
									evt.currentTarget.className += " active";
								}
								
								// Get the element with id="defaultOpen" and click on it
								document.getElementById("defaultOpen").click();
							</script>
				   </td>      
				  </tr>
				</table>
	   </td>      
	  </tr>
	</table>
  </div>
</div>
</div>
<!--<div class="footer">
  <table width="100%">
  <tr><td width="20%">&nbsp;</td>
  <td width="33%" align="center">
	  
		<h3 align="left" class="style7"><span class="style8">Reach Us</span></h3>
			<p align="left"><span class="style5">Centre for Industrial Consultancy and Sponsored Research <br>
		    </span><span class="style6">Indian Institute of Technology Madras<br>
		    Chennai - 600 036</span><span class="style4"><br>
	        <img src="images/contact-icon.png" width="20" height="15" /> <font color="white">044 2257 8061(62)</font>&nbsp;<img src="images/mail-us.png" width="30" height="25" /> <font color="white">deanicsr@iitm.ac.in</font> </span>	      </p>
	   </td>
   <td width="67%" align="center" valign="top">  
		   <h3 class="style7"><span class="style8">Connect with Us</span></h3>
		   <br />
            <p align="center">    
                 <a data-toggle="tooltip" data-placement="top" title="Facebook" href="https://www.facebook.com/ReachIITM/" target="_blank" style="text-decoration:none"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a data-toggle="tooltip" data-placement="top" title="Twitter"  href="https://twitter.com/reachIITM" target="_blank"><i class="fa fa-twitter"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a data-toggle="tooltip" data-placement="top" title="Google+"  href="https://plus.google.com/+iitmadras" target="_blank"><i class="fa fa-google-plus"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a data-toggle="tooltip" data-placement="top" title="Linkedin"  href="#"><i class="fa fa-linkedin"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a data-toggle="tooltip" data-placement="top" title="Youtube"  href="#"><i class="fa fa-youtube"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</p>
    </td>
  </tr>
 </table>           
</div>
<div class="footer_bottom">
  <table width="100%">
  <tr>
  <td width="50%" align="center"><p align="left"><strong> Copyright &copy;  IC&amp;SR 2018 All Rights Reserved </strong></p></td>
   <td width="50%" align="right" valign="top"> <p align="right"><strong>Designed by  ICSR - IT , IIT Madras</strong></span></p>  </td>
  </tr>
 </table>           
</div>
-->
</div>
<?php
}
?>
</body>
</html>
