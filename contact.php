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
			 <table width="90%" align="center" bordercolordark="#000000">
					<tr bgcolor="#C8EFF2"><td width="35%"><h4><font color="#003399"><b>Dean (IC & SR) </b></font></h4> </td><td width="35%"><h4><font color="#003399"><b>Senior Techno Economic Officer </b></font></h4> </td><td width="20%"><h4><font color="#003399"><b> Deputy Registrar (IC & SR) </b></font></h4> </td></tr>
					<tr>
					<td height="23">
							<font color="#FF6600"><b>Prof. Ravindra Gettu</b></font><br/>	<br/>				
							deanicsr@iitm.ac.in<br/>
							<br/>
							Ext:  8060 | Secretary:  8061</span>
						</td>
						<td>						
							<font color="#FF6600"><b>Dr. V.Suresh </b></font><br/><br/>
							sureshv@iitm.ac.in<br/>
							<br/>
					 		Ext:  8353</span> </td>
					  <td>
							<font color="#FF6600"><b>Mr. S. Sundaravinayagam</b></font><br/><br/>				
							dricsr@iitm.ac.in<br/>
							<br/>
							Ext:  8350 </span></td>
					</tr>
					

					<tr bgcolor="#C8EFF2"><td><h4><font color="#003399"><b>Chief Manager – Admin</b></font></h4> </td><td><h4><font color="#003399"><b> Chief Manager – IT </b></font></h4> </td><td><h4><font color="#003399"><b>Chief Manager – Accounts </b></font></h4> </td></tr>
					<tr>
						<td>						
							<font color="#FF6600"><b>K. Chidhambaram </b></font><br/><br/>
							cmadmin-icsr@iitm.ac.in<br/>
							<br/>
					 Ext:  9793</span> </td>
					  <td>
							<font color="#FF6600"><b>E. Ilayaraja </b></font><br/><br/>				
							cmit-icsr@iitm.ac.in<br/>
							<br/>
							Ext:  9794 </span></td>
						<td height="23">
							<font color="#FF6600"><b>Ravi Sadagopan</b></font><br/>	<br/>				
							cmfa-icsr@wmail.iitm.ac.in<br/>
							<br/>
							Ext:  8360 </span>
						</td>
						
					</tr>
					

					<tr bgcolor="#C8EFF2"><td><h4><font color="#003399"><b>Superintendent– Office</b></font></h4> </td><td><h4><font color="#003399"><b> Senior Manager – Purchase</b></font></h4> </td><td><h4><font color="#003399"><b>Senior Manager – Recruitment </b></font></h4> </td></tr>
					<tr>
						<td>						
							<font color="#FF6600"><b>Rajendran K</b></font><br/><br/>
							icsroffice@iitm.ac.in<br/>
							<br/>
					 Ext:  9791</span> </td>
					  <td>
							<font color="#FF6600"><b>Sathya Narayanan </b></font><br/><br/>				
							smpur-icsr@iitm.ac.in<br/>
							<br/>
							Ext:  9798 </span></td>
						<td height="23">
							<font color="#FF6600"><b>Jelani Mohamed</b></font><br/>	<br/>				
							smhr-icsr@iitm.ac.in<br/>
							<br/>
							Ext:  8357 </span>
						</td>
						
					</tr>
					

					<tr bgcolor="#C8EFF2"><td><h4><font color="#003399"><b>Sr. Assistant – Facility</b></font></h4> </td><td><h4><font color="#003399"><b>Senior Manager – PFMS</b></font></h4> </td><td><h4><font color="#003399"><b>&nbsp;</b></font></h4> </td></tr>
					<tr>
						<td>						
							<font color="#FF6600"><b>Hemalatha</b></font><br/><br/>
							icsrfaciclity@iitm.ac.in<br/>
							<br/>
					 Ext:  9791</span> </td>
					<td height="23">
							<font color="#FF6600"><b>Ms. Kavitha</b></font><br/>	<br/>				
							smacc-icsr@iitm.ac.in<br/>
							<br/>
							Ext:  9795 </span>
						</td>	
					</tr>
					<tr><td colspan="3"><br /></td></tr>

					
					<tr align="center" bgcolor="#4E87A3"><td colspan="3"><span class="style1">Accounts – Back Office</span></td>
					</tr>
					
					<tr bgcolor="#C8EFF2"><td><h4><font color="#003399"><b>Senior Manager – Back Office </b></font></h4> </td><td><h4><font color="#003399"><b>Commitments & ICSR Projects / Negative Balance</b></font></h4> </td><td><h4><font color="#003399"><b> All Tax Matters</b></font></h4> </td></tr>
					<tr>
					<td height="23">
							<font color="#FF6600"><b>Mr. Krishnamurthy</b></font><br/>	<br/>				
							icsraccounts5@iitm.ac.in<br/>
							<br/>
							Ext:  9701 </span>
						</td>
						<td>						
							<font color="#FF6600"><b>Mr. Guru Prasad</b></font><br/><br/>
							icsraccounts3@iitm.ac.in<br/>
							<br/>
					 Ext:  9704</span> </td>
					  <td>
						  <font color="#FF6600"><b>Ms. Rajalakshmi</b></font><br/>	<br/>				
							icsraccounts4@iitm.ac.in<br/>
							<br/>
							Ext:  9703 </span>
					  </td>							
					</tr>
					<tr><td colspan="3"><br /></td></tr>
					
					<tr align="center" bgcolor="#4E87A3"><td colspan="3"><span class="style1">Accounts – Front Office</span></td>
					</tr>
					
					<tr bgcolor="#C8EFF2"><td><h4><font color="#003399"><b>Senior Manager – Front Office</b></font></h4> </td><td><h4><font color="#003399"><b>Sponsored Projects</b></font></h4> </td><td><h4><font color="#003399"><b> Consultancy Project</b></font></h4> </td></tr>
					<tr>
					<td height="23">
							<font color="#FF6600"><b>Ms. Manikkarasi</b></font><br/>	<br/>				
							icsraccounts7@iitm.ac.in<br/>
							<br/>
							Ext:  9721 </span>
						</td>
						<td>						
							<font color="#FF6600"><b>Ms. Arunadevi</b></font><br/><br/>
							icsraccounts9@iitm.ac.in<br/>
							<br/>
					 Ext:  9721</span> </td>
					  <td>
						  <font color="#FF6600"><b>Ms. Lakshmipriya</b></font><br/>	<br/>				
							icsraccounts6@iitm.ac.in<br/>
							<br/>
							Ext:  9711 </span>
					  </td>							
					</tr>
					
					<tr bgcolor="#C8EFF2"><td><h4><font color="#003399"><b>Travel, PCF and RMF </b></font></h4> </td><td><h4><font color="#003399"><b>Salary</b></font></h4> </td><td><h4><font color="#003399"><b> &nbsp;</b></font></h4> </td></tr>
					<tr>
					<td height="23">
							<font color="#FF6600"><b>Ms. Rajarajeshwari</b></font><br/>	<br/>				
							icsraccounts1@iitm.ac.in<br/>
							<br/>
							Ext:  9792 </span>
						</td>
						<td>						
							<font color="#FF6600"><b>Mr. Deepak Prasanth</b></font><br/><br/>
							icsraccounts2@iitm.ac.in<br/>
							<br/>
					 Ext:  9722</span> </td>
					  <td>&nbsp;</td>
					</tr>
					
					<tr><td colspan="3"><br /></td></tr>
					
					<tr align="center" bgcolor="#4E87A3"><td colspan="3"><span class="style1">IP CELL</span></td>
					</tr>
					<tr bgcolor="#C8EFF2"><td><h4><font color="#003399"><b>Sr. Project Advisor</b></font></h4> </td><td><h4><font color="#003399"><b> Jr . Superintendent</b></font></h4> </td><td><h4><font color="#003399"><b>Manager – Sales & Marketing </b></font></h4> </td></tr>
					<tr>
						<td>						
							<font color="#FF6600"><b>Mr. GMK Raju</b></font><br/><br/>
							ipcell@iitm.ac.in<br/>
							<br/>
							 Ext:  9751</span> </td>
					  <td>
							<font color="#FF6600"><b>Mr. Chandrajith</b></font><br/><br/>				
							ipoffice@iitm.ac.in<br/>
							<br/>
							Ext:  9756 </span></td>
						<td height="23">
							<font color="#FF6600"><b>Mr. Ateet</b></font><br/>	<br/>				
							ipmarketing@iitm.ac.in<br/>
							<br/>
							Ext:  9735 </span>
						</td>
						
					</tr>
					
					<tr><td colspan="3"><br /></td></tr>
					
					<tr align="center" bgcolor="#4E87A3"><td colspan="3"><span class="style1">Advisors</span></td>
					</tr>
					<tr bgcolor="#C8EFF2"><td><h4><font color="#003399"><b>Sr. Project Advisor – IRO</b></font></h4> </td><td><h4><font color="#003399"><b> Advisor – R&D</b></font></h4> </td><td><h4><font color="#003399"><b> </b></font></h4> </td></tr>
					<tr>
						<td>						
							<font color="#FF6600"><b>Mr. MS Srinivasan</b></font><br/><br/>
							iro@wmail.iitm.ac.in<br/>
							<br/>
							 Ext:  9747</span> </td>
					  <td>
							<font color="#FF6600"><b>Mr. Brakaspathy</b></font><br/><br/>				
							rndadvisor_icsr@wmail.iitm.ac.in<br/>
							<br/>
							Ext:  9800 </span></td>
						<td height="23">&nbsp;
						</td>
						
					</tr>
				
					
			</table>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
</body>
</html>
