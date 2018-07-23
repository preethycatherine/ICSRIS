<?php
if(!isset($_COOKIE["PHPSESSID"]))
{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
	exit;

}
	session_start();
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	if (isset($_POST['submit']) && ($_POST['submit'] == "Add")) 
	{
		$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
		$strsql_bill="Select * from GST_BILL_TO_DETAILS_VENDOR order by DINP";
		$process_bill=odbc_exec($sqlconnect,$strsql_bill) or die("<br>Connection Failed");
		
		$c_date=date('Y-m-d');
		$last_bill_no="";
		while(odbc_fetch_row($process_bill))
		{
			$last_bill_no=odbc_result($process_bill,"bill_id");
		}
		$bill_id="VB".(substr($last_bill_no,2)+1);
		//$bill_id="B".$bill_id;
			
		if($_POST['bill_name']=="")	$msg="**Enter Name**";
		elseif($_POST['bill_address']=="")	$msg="**Enter Address**";
		elseif($_POST['bill_district']=="")	$msg="**Enter District**";
		elseif($_POST['bill_pin']=="")	$msg="**Enter Pin Code**";
		elseif($_POST['bill_state']=="")	$msg="**Enter State**";
		else
		{
			odbc_close_all();
			$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
			
			$strsql="";
			$strsql="Select * from GST_BILL_TO_DETAILS_VENDOR where name='".$_POST['bill_name']."' and state='".$_POST['bill_state']."' and district='".$_POST['bill_district']."'";
			$process=odbc_exec($sqlconnect,$strsql) or die("<br>Connection Failed 1");
			if (odbc_fetch_row($process))	$msg="**Already in the existing list!!";
			else 
			{
				$ins_sql="insert into GST_BILL_TO_DETAILS_VENDOR values(CURRENT_TIMESTAMP,'$bill_id','".$_POST['bill_name']."','".str_replace("'", "", $_POST['bill_address'])."','".$_POST['bill_district']."','".$_POST['bill_pin']."','".$_POST['bill_state']."','".$_POST['bill_contact_person']."','".$_POST['bill_contact']."','".$_POST['bill_email']."','".$_SESSION["username"]."')";
				odbc_close_all();
				$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
				odbc_exec($sqlconnect,$ins_sql);
				echo "<SCRIPT language=JavaScript> window.opener.location.reload(true); window.close(); </script>";    
			}	
		}
	}
	
	?>
	<form name='add_bill_to_details_vendor' action='add_bill_to_details_vendor.php' method='POST'  onSubmit="return validate()">
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
				<th><div align="right"><span style="color:#663300">District :</span><span style="color:#663300"><span style="color: #FF0000; font-weight: bold">*</span></span></div></th>
				<th align="left"><input type="text" name="bill_district" value="<?php if(isset($_POST['bill_district'])) echo $_POST['bill_district']; ?>"   /></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">Pin Code :<span style="color: #FF0000; font-weight: bold">*</span></span></div></th>
				<th align="left"><input type="text" name="bill_pin" value="<?php if(isset($_POST['bill_pin'])) echo $_POST['bill_pin']; ?>"   /></th>
				</tr>
				<tr>
				<th><div align="right"><span style="color:#663300">State :<span style="color: #FF0000; font-weight: bold">*</span></span></div></th>
				<th align="left">
							<select name='bill_state'>
						<?php 
							if(isset($_POST['bill_state'])){ ?> <option value="<?php echo $_POST['bill_state']; ?>"><?php echo $_POST['bill_state'];  ?></option>
						<?php } else { ?><option>-Select State-</option><?php }  ?>
										<option value="Andaman and Nicobar">Andaman & Nicobar</option> 
										<option value="Andhra Pradesh">Andhra Pradesh</option> 
										<!--<option value="Andhra Pradesh (New)">Andhra Pradesh (New)</option> -->
										<option value="Arunachal Pradesh">Arunachal Pradesh</option> 
										<option value="Assam">Assam</option> 
										<option value="Bihar">Bihar</option> 
										<option value="Chandigarh">Chandigarh</option> 
										<option value="Chhattisgarh">Chhattisgarh</option> 
										<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option> 
										<option value="Daman and Diu">Daman & Diu</option> 
										<option value="Delhi">Delhi</option> 
										<option value="Goa">Goa</option> 
										<option value="Gujarat">Gujarat</option> 
										<option value="Haryana">Haryana</option> 
										<option value="Himachal Pradesh">Himachal Pradesh</option> 
										<option value="Jammu and Kashmir">Jammu & Kashmir</option> 
										<option value="Jharkhand">Jharkhand</option> 
										<option value="Karnataka">Karnataka</option> 
										<option value="Kerala">Kerala</option> 
										<option value="Lakshadweep">Lakshadweep</option> 
										<option value="Madhya Pradesh">Madhya Pradesh</option> 
										<option value="Maharashtra">Maharashtra</option> 
										<option value="Manipur">Manipur</option> 
										<option value="Meghalaya">Meghalaya</option> 
										<option value="Mizoram">Mizoram</option> 
										<option value="Nagaland">Nagaland</option> 
										<option value="Odisha">Odisha</option> 
										<option value="Pondicherry">Pondicherry</option> 
										<option value="Punjab">Punjab</option> 
										<option value="Rajasthan">Rajasthan</option> 
										<option value="Sikkim">Sikkim</option> 
										<option value="TamilNadu">TamilNadu</option> 
										<option value="Telangana">Telangana</option> 
										<option value="Tripura">Tripura</option> 
										<option value="Uttar Pradesh">Uttar Pradesh</option> 
										<option value="Uttarakhand">Uttarakhand</option> 
										<option value="West Bengal">West Bengal</option> 
										<option value="Other Territory ">Other Territory</option> 
						 </select>				
				<!--<input type="text" name="bill_state" value="<?php if(isset($_POST['bill_state'])) echo $_POST['bill_state']; ?>"   />-->
				</th>
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
