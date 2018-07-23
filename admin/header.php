<?php
$url=$_SERVER['PHP_SELF'];
$pagename=basename($url);
?>
<header class="main-header">
	<!-- Logo -->
	<a href="#" class="logo">
		<span class="logo-mini" style="padding-top:10px;"><center>Faculty</center></span>
		<span class="logo-lg"><b>&nbsp;DEAN ICSR</b></span>
	</a>

	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		
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
			  <span class="hidden-xs">DEAN ICSR</span>
			</a>
			<ul class="dropdown-menu">
			  <!-- The user image in the menu -->
			  <li class="user-header">
				<img src="img/user.png" class="img-circle" alt="User Image" />
				<p>
				  Admin
				  <!--<small>Member of Faculty</small>-->
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
	</nav>
</header>