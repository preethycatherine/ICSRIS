<?php
$url=$_SERVER['PHP_SELF'];
$pagename=basename($url);
//session_start();
ob_start();
?>
<header class="main-header">
	<!-- Logo -->
	<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: large;
}
-->
    </style>
	<a href="land.php" class="logo">
				<span class="logo-lg">
				<table width="100%"><tr><td align="left" width="20%" style="padding-bottom:3px"><img src="img/home.png" height="18" width="23""/></td><td align="left" width="80%" valign="bottom"><b>FAP</b>&nbsp;Portal</td></tr></table>
				</span>
	</a>
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
	<table width="100%"><tr>
		<td width="3%">
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
		</td>
		<td align="left" width="67%">	<?php //echo "<div><font color='white' size='4'><b>Calendar Year ".$_SESSION['period']."</b>"; 
		
		if(isset($_SESSION['period'])){ 
		
				if($pagename=="teaching_students.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Teaching and Guidance ] &nbsp;&raquo;&nbsp;&nbsp; [ Teaching ] &nbsp;&raquo;&nbsp;&nbsp; [ Courses Taught - Workflow ]"; }
			  elseif($pagename=="teaching_others.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Teaching and Guidance ] &nbsp;&raquo;&nbsp;&nbsp; [ Teaching ] &nbsp;&raquo;&nbsp;&nbsp; [ Courses Ohters -  NPTEL / GIAN / CEP ]"; }
			  elseif($pagename=="research_students.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Teaching and Guidance ] &nbsp;&raquo;&nbsp;&nbsp; [ Teaching ] &nbsp;&raquo;&nbsp;&nbsp; [ List Of Students - Research ]"; }
			  elseif($pagename=="ug_pg_projects.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Teaching and Guidance ] &nbsp;&raquo;&nbsp;&nbsp; [ Teaching ] &nbsp;&raquo;&nbsp;&nbsp; [ Research Projects - UG / PG ]"; }
			  elseif($pagename=="publications.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Research ] &nbsp;&raquo;&nbsp;&nbsp; [ Publications ]"; }
			  elseif($pagename=="patent.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Research ] &nbsp;&raquo;&nbsp;&nbsp; [ IPR Patents ]"; }
			  elseif($pagename=="projects_spon.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Research ] &nbsp;&raquo;&nbsp;&nbsp; [ Sponsored Projects ] "; }
			  elseif($pagename=="projects_cons.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Others ] &nbsp;&raquo;&nbsp;&nbsp; [ Consultancy Projects ] "; }
			  elseif($pagename=="award.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Others ] &nbsp;&raquo;&nbsp;&nbsp;[  Awards & Recognition ]"; }
			  elseif($pagename=="admin_duty.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Others ] &nbsp;&raquo;&nbsp;&nbsp; [ Service Roles ]"; }
			  elseif($pagename=="startup.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Others ] &nbsp;&raquo;&nbsp;&nbsp; [ StartUp ]"; }
			  elseif($pagename=="new_dev.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Others ] &nbsp;&raquo;&nbsp;&nbsp;[ Additional Activities ]"; }
			  elseif($pagename=="home.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Summary ]"; }
			  elseif($pagename=="about_fap.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ About FAP ]"; }
			  elseif($pagename=="land.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Home ]"; }
			  elseif($pagename=="goals.php"){ $page=""; $page=" &nbsp;&raquo;&nbsp;&nbsp; [ Plan for Next CY ]"; }
			  
			  
			 echo "<div>&nbsp;&nbsp;&nbsp;&nbsp;<font color='white' size='3'> [ ".strtoupper("FAP - CY ".$_SESSION['period'])." ] $page</font></div>";
		}		
		
		?> 	
		</td>
		<td width="30%">		
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
			  
			  <!-- User Account Menu -->
			  <li class="dropdown user user-menu">
				<!-- Menu Toggle Button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <!-- The user image in the navbar-->
				  <img src="img/user.png" class="user-image" alt="User Image"/>
				  <!-- hidden-xs hides the username on small devices so only the image appears. -->
				  <span class="hidden-xs"><?php echo strtoupper($_SESSION['fap_name']); ?><br /></span>
				</a>
				<ul class="dropdown-menu">
				  <!-- The user image in the menu -->
				  <li class="user-header">
					<img src="https://photos.iitm.ac.in/byid.php?id=<?php echo $_SESSION['fap_instid'] ?>" class="img-circle" alt="User Image" />
					<p>
					  <?php echo  strtoupper($_SESSION['fap_name']); ?>
					  <small>Member of Faculty</small>
					</p>
				  </li>
				  <!-- Menu Footer-->
				  <li class="user-footer">
					<div class="pull-right">
					  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
					</div>
				  </li>
				</ul>
			  </li>
			</ul>
			</div>
			</td>
		</tr>
	</table>		
		
	</nav>
	<?php
	/*if(isset($_SESSION['period'])){ 
		
		if($pagename=="teaching_students.php"){ $page=""; $page=" &raquo;&raquo; [ Teaching and Guidance ] &raquo;&raquo; [ Teaching ] &raquo;&raquo; [ Courses Taught - Workflow ]"; }
	  elseif($pagename=="teaching_others.php"){ $page=""; $page=" &raquo; [ Teaching and Guidance ] &raquo; [ Teaching ] &raquo; [ Courses Ohters -  NPTEL / GIAN / CEP ]"; }
	  elseif($pagename=="research_students.php"){ $page=""; $page=" &raquo; [ Teaching and Guidance ] &raquo; [ Teaching ] &raquo; [ List Of Students - Research ]"; }
	  elseif($pagename=="ug_pg_projects.php"){ $page=""; $page=" &raquo; [ Teaching and Guidance ] &raquo; [ Teaching ] &raquo; [ Research Projects - UG / PG ]"; }
	  elseif($pagename=="publications.php"){ $page=""; $page=" &raquo; [ Research ] &raquo; [ Publications ]"; }
	  elseif($pagename=="patent.php"){ $page=""; $page=" &raquo; [ Research ] &raquo; [ IPR Patents ]"; }
	  elseif($pagename=="projects_spon.php"){ $page=""; $page=" &raquo; [ Research ] &raquo; [ Sponsored Projects ] "; }
	  elseif($pagename=="projects_cons.php"){ $page=""; $page=" &raquo; [ Others ] &raquo; [ Consultancy Projects ] "; }
	  elseif($pagename=="award.php"){ $page=""; $page=" &raquo; [ Others ] &raquo;[  Awards & Recognition ]"; }
	  elseif($pagename=="admin_duty.php"){ $page=""; $page=" &raquo; [ Others ] &raquo; [ Service Roles ]"; }
	  elseif($pagename=="startup.php"){ $page=""; $page=" &raquo; [ Others ] &raquo; [ StartUp ]"; }
	  elseif($pagename=="new_dev.php"){ $page=""; $page=" &raquo; [ Others ] &raquo;[ Additional Activities ]"; }
	  elseif($pagename=="home.php"){ $page=""; $page=" &raquo; [ Summary ]"; }
	  elseif($pagename=="about_fap.php"){ $page=""; $page=" &raquo; [ About FAP ]"; }
	  elseif($pagename=="land.php"){ $page=""; $page=" &raquo; [ Home ]"; }
	  
	  
	 echo "<div style='padding-left:230px'> <font color='white'> [ ".strtoupper("FAP - CY ".$_SESSION['period'])." ] $page</font></div>";
	 }*/ ?>
	</header>