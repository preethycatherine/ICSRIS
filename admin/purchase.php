<?php
ob_start();
session_start();
include_once("common/function.php");
$classcall=new Newconnection();
//echo $_SESSION['admin_user_id'];
if($_SESSION['admin_user_id']=="")
{
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ICSR</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<?php include_once "include_styles.php"; ?>
    <style type="text/css">
<!--
.style24 {
	color: #FF3300;
	font-weight: bold;
	font-style: italic;
}
.style27 {font-size: 18px}
.style28 {color: #FF3300; font-weight: bold; font-style: italic; font-size: 18px; }
.style30 {font-weight: bold; color: #FFFFFF; font-size: large;}
.style33 {
	font-size: 18px;
	color: #333333;
	font-weight: bold;
}
.style38 {font-size: small}
-->
    </style>
	<script type="text/javascript">
	function reload(form)
	{
	var comp="",date="";
	season=document.home.season.value;
	
	self.location='home.php?season=' + season;  
	//self.location='not_visited.php?month=' + month+ '&date=' + date+ '&year=' + year + '&start=' + session + '&comp=' + comp +'&comp_prof=' + prof;  
		// alert (val1);
	}	
	</script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<form name='home' method='POST' enctype="multipart/form-data">
	<div class="wrapper">
		<!-- Main Header -->
		<?php include_once "header.php"; ?>
		
		<?php include_once "sidebar.php"; ?>

		<!-- Content Wrapper -->
		<div class="content-wrapper">
			<!-- Content Header -->
			<!-- Main content -->
		 <br><br>
			<section class="content">			
				<div class="row">
					<div class="col-lg-12 col-xs-12">
					
					  <!-- small box -->
					    <table width="60%">							
							<tr>
					  		  <td width="43%" align="right"><div align="right" class="style33">Upload Indent Tracking</div></td>
								<td width="0%" align="center"><strong>&nbsp;</strong></td>
								<td width="26%" align="center">
										<b>Please Select the File:</b> <input type="file" name="file" id="file" />										
							  </td>
								<td width="19%" align="left">
										<input type="submit" name="submit" id="submit" value="Upload" />
							  </td>
						  </tr>
					  </table>				
					<br><br>			
				  </div>
				<?php if (isset($_POST['submit']) && ($_POST['submit'] == "Upload"))
					  {	
							$flag=0;
							
							$cfile=".xls";
							if($_FILES['file']['name']=="")	
							{ 
								echo "<table><tr><td height=29 colspan=3 align=center><b><font color=#FF0000>Please browse the upload file</font></b></td></tr></table>";	
							}
							else
							{	
								$ext = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.'));
								
								$rname="uploads/purchase_indent_track".$ext;
								move_uploaded_file($_FILES["file"]["tmp_name"], $rname);  
								
								$flag=1;	
							}
							if($flag==1)
							{
								?>							 
								<table width="100%" align="center" >
								  <tr bgcolor="#666666"><td align="center" style="padding-left:10px;"><div align="center"class="style30">Uploaded Successfully. </div></td>
								  <!--<td align="right"><strong><a href="ExcelGen_Teaching.php" target="_blank" class="style16" >Download Excel</a></strong></td>-->
								  </tr>
							  </table>
								<?php 
							} 
					}
						
				?>
						</div>
						</div>
					</div>				
					
					<!--******************************************************END TEACHING ******************************************************************** -->
					
										
				<div class="row">
					<div class="col-lg-12 col-xs-12">
					  <!-- small box -->
					  <div class="small-box">
						  <table width="100%" align="center">
						  <tr>
							<td width="47%" align="center"><div align="center" class="style24 style27">&nbsp;</div></td><td align="center" colspan="4"><div align="center" class="style28">&nbsp;</div></td>
						   </tr>
						</table>
					  </div>
				  </div>
			  </div>
			
			</section>
	
		</div>
	</div>
		

	<!-- Javascript Files -->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/app.min.js"></script>
	

</form>
</body>
</html>
