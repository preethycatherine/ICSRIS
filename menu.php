<?php session_start(); ?>
	<!DOCTYPE html>
	<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	.navbar {
		/*position:fixed;*/
		/*overflow: hidden;	*/
		background-color: #006699;
		font-family: Arial, Helvetica, sans-serif;
		display: flex;
		justify-content: center;	
		position: fixed;   
		top: 150;
		left: 0;
		right: 0;
	}
	
	.navbar a {
		float: right;
		font-size: 14px;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}
	
	.dropdown {
		float: left;
		overflow: hidden;
	}
	
	.dropdown .dropbtn {
		font-size: 14px;    
		border: none;
		outline: none;
		color: white;
		padding: 14px 16px;
		background-color: inherit;
		font-family: inherit;
		margin: 0;
	}
	
	.navbar a:hover, .dropdown:hover .dropbtn {
		background-color: #0099CC;
	}
	
	.dropdown-content {
		display: none;
		position: absolute;
		background-color: #f9f9f9;
		min-width: 260px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		z-index: 1;
	}
	
	.dropdown-content a {
		float: none;
		color: black;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
		text-align: left;
	}
	
	.dropdown-content a:hover {
		background-color: #ddd;
	}
	
	.dropdown:hover .dropdown-content {
		display: block;
	}
	</style>
	<style>
		/* define a fixed width for the entire menu */
		.navigation {
		  width: 230px;
		}
		
		/* reset our lists to remove bullet points and padding */
		.mainmenu, .submenu {
		  list-style: none;
		  padding: 0;
		  margin: 0;
		}
		
		/* make ALL links (main and submenu) have padding and background color */
		.mainmenu a {
		  display: block;
		  /*background-color: #000000;*/
		  font-size:14px;
		  text-decoration: inherit;
		  padding: 10px;
		  color: #000;
		}
		
		/* add hover behaviour */
		.mainmenu a:hover {
			background-color: #333333;
		}
		
		
		/* when hovering over a .mainmenu item,
		  display the submenu inside it.
		  we're changing the submenu's max-height from 0 to 200px;
		*/
		
		.mainmenu li:hover .submenu {
		  display: block;
		  max-height: 300px;
		  width: 180px;
		  display: inline-block;
		  transition-delay: .25s; 
		}
		
		/*
		  we now overwrite the background-color for .submenu links only.
		  CSS reads down the page, so code at the bottom will overwrite the code at the top.
		*/
		
		.submenu a {
		  background-color: #FFFFFF;
		}
		
		/* hover behaviour for links inside .submenu */
		.submenu a:hover {
		  background-color: #CCCCCC;
		}
		
		/* this is the initial state of all submenus.
		  we set it to max-height: 0, and hide the overflowed content.
		*/
		.submenu {
		  overflow: hidden;
		  max-height: 0;
		  -webkit-transition: all 0.5s ease-out;
		}
		
		/*********************************/
		#nav {
			list-style:none inside;
			margin:0;
			padding:0;
			text-align:center;
			}
		
		#nav li {
			display:block;
			position:relative;
			float:left;
			background: #006633; /* menu background color */
			}
		
		#nav li a {
			display:block;
			padding:0;
			text-decoration:none;
			width:200px; /* this is the width of the menu items */
			line-height:35px; /* this is the hieght of the menu items */
			color:#ffffff; /* list item font color */
			}
				
		#nav li li a {font-size:80%;} /* smaller font size for sub menu items */
			
		#nav li:hover {background:#003f20;} /* highlights current hovered list item and the parent list items when hovering over sub menues */
		
		
		
		/*--- Sublist Styles ---*/
		#nav ul {
			position:absolute;
			padding:0;
			left:0;
			display:none; /* hides sublists */
			}
		
		#nav li:hover ul ul {display:none;} /* hides sub-sublists */
		
		#nav li:hover ul {display:block;} /* shows sublist on hover */
		
		#nav li li:hover ul {
			display:block; /* shows sub-sublist on hover */
			margin-left:200px; /* this should be the same width as the parent list item */
			margin-top:-35px; /* aligns top of sub menu with top of list item */
			}
		
		</style>
	
	</head>
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
	<br><br><br><br><br><br><br>
	<div class="navbar">
		<a href="icsrisacct.php"><strong>Home</strong></a>
	  <div class="dropdown">
		<button class="dropbtn"><strong>Projects </strong>
		  <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
		  
		</div>
		<div class="dropdown-content">	
			 <div class="dropdown">
				<!--<ul id="nav">
					  	  <li><a href="#">SUB SUB LIST &raquo;</a>
							<ul>
							  <li><a href="#">Sub Sub Item 1</a>
							  <li><a href="#">Sub Sub Item 2</a>
							</ul>
					  </li>
					</ul>-->
				<nav class="navigation">
				<ul class="mainmenu">
					<li><button class="dropbtn"><strong>Sponsored Projects &nbsp;&nbsp;</strong> </button>
					  <ul class="submenu">
						<li> <a href="acctsponon.php">Ongoing Projects</a></li>
						<li> <a href="acctsponcl.php">Closed Projects</a></li>			
					  </ul>
					</li>				
				  </ul>
				</nav>
					 
				<nav class="navigation">
				<ul class="mainmenu">
					<li><button class="dropbtn"><strong>Consultancy Projects </strong></button>
					 <ul class="submenu">
						<li> <a href="acctconson.php">Ongoing Projects</a></li>
						<li> <a href="acctconscl.php">Closed Projects</a></li>			
					  </ul>
					</li>				
				  </ul>
				</nav>
					 
				<nav class="navigation">
				<ul class="mainmenu">
					<li><button class="dropbtn"><strong>PCF / RMF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></button>
					 <ul class="submenu">
						<li> <a href="acctpcfsum.php">PCF</a> </li>
						<li> <a href="acctrmfsum.php">RMF</a> </li>			
					  </ul>
					</li>				
				  </ul>
				</nav>
					
		  				
			  </div> 		  
		</div>
	  </div> 
	  
	  <div class="dropdown">
		<button class="dropbtn"><strong>Bank Accounts</strong>
		  <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
		  <a href="acctsimprest.php">Bank Imprest Account</a>
		  <!--<a href="acctpcfsum.php">PCF</a>
		  <a href="acctrmfsum.php">RMF</a>-->
		  <a href="batch.php">CPDA</a>
		</div>
	  </div> 
	  <div class="dropdown">
		<button class="dropbtn"><strong>Others </strong>
		  <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
		  <a href="chequedetails.php">Cheque Details</a>
		  <a href="sbicreditdetails.php">SBI Credit Details</a>
		  <a href="pendingreceipts.php">Unidentified Grant Receipts</a>		 
		  <a href="Group_Travel_Insurance.php">Group Travel Insurance</a>
	      <a href="Forms.php">Forms</a>
		<?php //echo '<a href="http://icsrweb25/HBS/Dashboard/Dashboard_Index?name=0032" target="_blank">Hall Booking System </a>' ?>
		  <a href="https://ioas.iitm.ac.in/HBS/Home/Index?name=<?php echo $_SESSION['instid']; ?>" target="_blank">Hall Booking System </a>
		</div>
	  </div> 
	  <div class="dropdown">
		<button class="dropbtn"><strong>IP Dashboard</strong>
		  <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
		  <a href="patent_info_R102.php">Indian Filings and Patents</a>
		  <a href="patent_info_R202.php">International Filings and Patents</a>
		  <a href="patent_info_R102A.php">Tech Transfer Accounts</a>
		   <a href="Glossary.php">Glossary</a>
		</div>
	  </div> 
	
	  <!--<div class="dropdown">
		<button class="dropbtn"><strong>Documentation</strong>
		  <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
		  <a href="uc.html">Dean's Office</a>
		  <a href="uc.html">Accounts</a>
		  <a href="uc.html">Facilities</a>
		  <a href="uc.html">Purchase</a>
		  <a href="uc.html">Recruitment</a>
		  <a href="uc.html">IP CELL</a>
		</div>
	  </div> -->
	  <div class="dropdown">
		<button class="dropbtn"><strong>FAQs </strong>
		  <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
		  <a href="faq.php?dept=Accounts">Accounts</a>
		  <a href="faq.php?dept=IPM Cell">IPM Cell</a>
		  <a href="faq.php?dept=Office">Office</a>		 
		  <a href="faq.php?dept=Purchase">Purchase</a>
		  <a href="faq.php?dept=Recruitment">Recruitment </a>
		  <a href="faq.php?dept=General">General </a>
		</div>
	  </div> 
	
		<a href="contact.php"><strong>Contact</strong></a>
		<a href="#"><strong>&nbsp;</strong></a>
		<a href="#"><strong>&nbsp;</strong></a>
		<a href="#"><strong>&nbsp;</strong></a>
		<a href="#"><strong>&nbsp;</strong></a>
		<a href="#"><strong>&nbsp;</strong></a>
		<a href="#"><strong>&nbsp;</strong></a>
		
		<a href="signout.php"><strong>Signout</strong></a>
		
	</div>
	
	<br><br>
	</body>
	</html>
