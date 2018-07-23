<?php
if(!isset($_COOKIE["PHPSESSID"]))
{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: index.php');
	exit;

}
	session_start();
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	if (isset($_POST['submit']) && ($_POST['submit'] == "Add")) 
	{
		$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
		$strsql_bill="Select * from GST_BILL_TO_DETAILS_EXPORT order by DINP";
		$process_bill=odbc_exec($sqlconnect,$strsql_bill) or die("<br>Connection Failed");
		
		$c_date=date('Y-m-d');
		$last_bill_no="";
		while(odbc_fetch_row($process_bill))
		{
			$last_bill_no=odbc_result($process_bill,"bill_id");
		}
		$bill_id="EB".(substr($last_bill_no,2)+1);
		//$bill_id="B".$bill_id;
			
		if($_POST['bill_name']=="")	$msg="**Enter Name**";
		elseif($_POST['bill_address']=="")	$msg="**Enter Address**";
		elseif($_POST['bill_country']=="")	$msg="**Enter Country**";
		else
		{
			odbc_close_all();
			$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
			
			$strsql="";
			echo $strsql="Select * from GST_BILL_TO_DETAILS_EXPORT where name='".$_POST['bill_name']."' and country='".$_POST['bill_country']."'";
			$process=odbc_exec($sqlconnect,$strsql) or die("<br>Connection Failed 1");
			if (odbc_fetch_row($process))	$msg="**Already in the existing list!!";
			else 
			{
				$ins_sql="insert into GST_BILL_TO_DETAILS_EXPORT values(CURRENT_TIMESTAMP,'$bill_id','".$_POST['bill_name']."','".str_replace("'", "", $_POST['bill_address'])."','".$_POST['bill_country']."','".$_POST['bill_contact_person']."','".$_POST['bill_contact']."','".$_POST['bill_email']."','".$_SESSION["username"]."')";
				odbc_close_all();
				$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
				odbc_exec($sqlconnect,$ins_sql);
				echo "<SCRIPT language=JavaScript> window.opener.location.reload(true); window.close(); </script>";    
			}	
		}
	}
	
	?>
	<form name='add_bill_to_details_export' action='add_bill_to_details_export.php' method='POST'  onSubmit="return validate()">
		<p align="right"><b><span style="color: #FF0000; font-weight: bold">*</span> <font color="#006600">Mandatory Fields</b></font></p>
		<font color="#FF0000"><b><?php echo $msg;?></b></font>
		<table style="background-color:#CCCC99" width="100%" border="1" >				
				<tr>
				<th><div align="right"><span style="color:#663300">Name :<span style="color: #FF0000; font-weight: bold">*</span></span></div></th>
				<th align="left"><input type="text" name="bill_name" size="32" value="<?php if(isset($_POST['bill_name'])) echo $_POST['bill_name']; ?>"  /></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Address :<span style="color: #FF0000; font-weight: bold">*</span> </span></div></th>
				<th colspan=2 align="left"><textarea name="bill_address" cols="25" rows="2"><?php if(isset($_POST['bill_address'])) echo $_POST['bill_address']; ?></textarea></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Country :</span><span style="color:#663300"><span style="color: #FF0000; font-weight: bold">*</span></span></div></th>
				<th align="left"><input type="text" name="bill_country" value="<?php if(isset($_POST['bill_country'])) echo $_POST['bill_country']; ?>"   /></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Contact Person :</span></div></th>
				<th colspan=2 align="left"><input type="text" name="bill_contact_person" value="<?php if(isset($_POST['bill_contact_person'])) echo $_POST['bill_contact_person']; ?>"   /></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Contact No :</span></div></th>
				<th colspan=2 align="left"><input type="text" name="bill_contact" value="<?php if(isset($_POST['bill_contact'])) echo $_POST['bill_contact']; ?>"   /></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Email :</span></div></th>
				<th colspan=3 align="left"><input type="text" name="bill_email"  size="25" value="<?php if(isset($_POST['bill_email'])) echo $_POST['bill_email']; ?>"  /></th>
				</tr>				
				<tr>
				<th colspan="4"><div align="center"><input type="submit" name="submit" id="submit" value="Add" /></div></th>
				</tr>				
		</table>
	</form>
