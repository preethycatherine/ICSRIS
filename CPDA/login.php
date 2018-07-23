<?php
session_start();
 $_SESSION['StaffNo']="2707";
//header("Location: acctcpdaquery.php");
header("Location: batch.php");

/* $msg ='';
 $msg1='';
//session_register("cpdaid");


     	mysql_connect("eservices", "root", "") or die("cannot connect"); 
		mysql_select_db("cpda") or die("cannot select DB");
		
 		if (isset($_POST['submit']) && ($_POST['submit'] == "Login")) 
		{
			if($_POST['StaffNo']=="" && $_POST['DoJ']==""  )
			{						 
				$msg=" Enter a valid User Name/Password";	
				//echo $msg;				   
			}
			else
			{
				$q=mysql_query("select * from staff_details where StaffNo='".$_POST['StaffNo']."' and DoJ='".$_POST['DoJ']."' and Status='Active' ")or die(mysql_error());
				
				$rowcount=mysql_num_rows($q);
				if(($rowcount==1))
				{
				while($row = mysql_fetch_array($q))
								{
					
				
				    $_SESSION['StaffNo']="";
				    $_SESSION['StaffNo']=$_POST['StaffNo'];
				// $_SESSION['cpdaid']  = $row['StaffNo'];
					
					if($row["Usermode"] == 'Normal')
					
					{
					header("Location: batch.php");
					}
					
					else
					
					{
					header("Location: acctcpdaquery.php");
					}
				}
			     
				}
				
				 $msg1="Invalid User Name/Password ";
				//echo $msg1;
		   	}
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
		<h1>Centre for IC & SR</h1>
		<h1>Indian Institute of Technology Madras, Chennai</h1>
		<h2>Information System</h2>
	</div>
  <div id="menu"></div>
	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
				<h2>Welcome to IC & SR Project Accounts Information System</h2>
		
<blockquote>
<div align="justify"   style="font-size:13pt" >
<div align="center"><img src="" alt="icsr" width="700" height="450" /></div>
<p>Coordinators can access Project Accounts Information using their institute email_id and password.</p>
</div>
</blockquote>
		  </div>
		</div>
		<div class="InfoOne">
<form name="Login_Form" method="post" action=''>

<div id="secondaryContent">
<h3>Login</h3>
<div>
  <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" class="txt1" style="margin-top: 10px; border-bottom: 1px solid rgb(204, 204, 204);">
    <tbody>
      <tr>
        <td width="40%" class="style1">Username</td>
        <td width="2%">:</td>
        <td colspan="2"><input name="StaffNo" type="text" class="style1" id="StaffNo" value="<?php '.$fields["StaffNo"].'?>" size="12"  /></td>
      </tr>
      <tr>
        <td class="style1">Password</td>
        <td>:</td>
        <td colspan="2"><input name="DoJ" type="password" class="style1" id="DoJ" value="<?php '.$fields["DoJ"].'?>" size="12" /></td>
      </tr>
      <tr>
        <td rowspan="2" align="right">&nbsp;</td>
        <td rowspan="2" align="right">&nbsp;</td>
        <td width="42%" align="right"><?php echo $msg ?></td>
        <td width="16%" rowspan="2" align="right"><div align="center">
          <input name="submit" type="submit"  id="submit"class="buttonSubmit" value="Login"/>
        </div></td>
      </tr>
      <tr>
        <td align="right"><?php echo $msg1; ?></td>
      </tr>
      <tr>
        <td align="left" colspan="4"><ul>
          <li class="style1">Use Institute emailid and password</li>
        </ul></td>
      </tr>
    </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
</div>
</form>
			<h3>Contact</h3>
			<div><p><ul><li class="style1">For assistance call 8363 </li><li class="style1">Mail to secicsr@iitm.ac.in</li></ul></p>
			</div>
			<h3>Quick Links</h3>
			<h5><p><ul><li class="style1"><a href="http://www.icandsr.iitm.ac.in/">ICSR External Website</a></li><li class="style1"><a href="http://www.icsr.iitm.ac.in">ICSR Internal Website</a></li><li class="style1"><a href="http://www.iitm.ac.in/">IIT Madras Home</a></li></ul></p></h5>
	  </div>
		<div class="clear"></div>
	</div>
	<div id="footer">
	</div>
</div>

</body>

</html>*/
?>