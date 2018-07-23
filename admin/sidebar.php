<?php
ob_start();
session_start();
$current_url = $_SERVER['REQUEST_URI'];
?>
<!-- Left side column, Contains the logo and sidebar -->
<style type="text/css">
<!--
.style1 {color: #CCCCCC}
-->
</style>

<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="img/user.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>DEAN ICSR</p>
				<a href="home.php"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
			
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li <?php if($current_url == "/deanadmin/admin/home.php") { ?> class="active" <?php } ?> ><a href="home.php"><i class="fa fa-line-chart"></i> <span>Home</span></a></li>
<?php   if($_SESSION['admin_auto_id']==1){ ?>
			<li class="header style1"><strong>Add</strong></li>
			<li <?php if($current_url == "/deanadmin/admin/proposals.php") { ?> class="active" <?php } ?> ><a href="proposals.php"><i class="fa fa-line-chart"></i> <span>Proposals</span></a></li>
			<li <?php if($current_url == "/deanadmin/admin/collaboration.php") { ?> class="active" <?php } ?> ><a href="collaboration.php"><i class="fa fa-line-chart"></i> <span>Collaboration</span></a></li>			
			<li <?php if($current_url == "/deanadmin/admin/web_link.php") { ?> class="active" <?php } ?> ><a href="web_link.php"><i class="fa fa-line-chart"></i> <span>Quick Links</span></a></li>			
			<li <?php if($current_url == "/deanadmin/admin/faq.php") { ?> class="active" <?php } ?> ><a href="faq.php"><i class="fa fa-line-chart"></i> <span>FAQs</span></a></li>			
<?php } elseif($_SESSION['admin_auto_id']==2){?>
			<li <?php if($current_url == "/deanadmin/admin/purchase.php") { ?> class="active" <?php } ?> ><a href="purchase.php"><i class="fa fa-line-chart"></i> <span>Upload Indent Tracking</span></a></li>
<?php } elseif($_SESSION['admin_auto_id']==3){?>
			<li <?php if($current_url == "/deanadmin/admin/uc_upload.php") { ?> class="active" <?php } ?> ><a href="uc_upload.php"><i class="fa fa-line-chart"></i> <span>Upload UC</span></a></li>
<?php } ?>
		</ul>
	</section>
</aside>