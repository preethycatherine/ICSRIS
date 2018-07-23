<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

//echo "sss";


$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");


if($_GET['type']=="R")
	$strsql="select * from GST_BILL_TO_DETAILS where BILL_ID='".$_GET['bill_id']."'";
elseif($_GET['type']=="U")
	$strsql="select * from GST_BILL_TO_DETAILS_VENDOR where BILL_ID='".$_GET['bill_id']."'";
elseif($_GET['type']=="E")
	$strsql="select * from GST_BILL_TO_DETAILS_export where BILL_ID='".$_GET['bill_id']."'";

//echo $strsql;

if (isset($_POST['submit']) && ($_POST['submit'] == "Remove")) 
{
		$BILL_ID=$_POST['BILL_ID'];
		$type=$_POST['type'];
		
		if($type=="R")
			$strsqld="delete from GST_BILL_TO_DETAILS where BILL_ID='".$_GET['bill_id']."'";
		elseif($type=="U")
			$strsqld="delete from GST_BILL_TO_DETAILS_VENDOR where BILL_ID='".$_GET['bill_id']."'";
		elseif($type=="E")
			$strsqld="delete from GST_BILL_TO_DETAILS_export where BILL_ID='".$_GET['bill_id']."'";
			
		odbc_close_all();
		//echo $strsqld;
		$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
		odbc_exec($sqlconnect,$strsqld);
		echo "<SCRIPT language=JavaScript> window.opener.location.reload(true); window.close(); </script>";   
}

$process=odbc_exec($sqlconnect,$strsql) or die("<br>Connection Failed");
odbc_fetch_row($process);
?>
<style type="text/css">
<!--
.style1 {
	color: #FF9900;
	font-style: italic;
	font-weight: bold;
}
.style4 {color: #FF3333}
-->
</style>
<script>
function test(){
			if(document.getElementById("upload").checked == true)
				document.getElementById("file4").style.visibility = "visible";
			else 
				document.getElementById("file4").style.visibility = "hidden";				
		}
	</script>
<form name='remove_prof' method='POST' enctype="multipart/form-data">
<table align="center" width="100%">
<tr><td width="100%" height="28"  align="left" colspan="6"> <strong><font size="4" color="#FF6600"><em><?php echo odbc_result($process,"NAME")."  -  ".odbc_result($process,"ADDRESS"); ?></em></font> </strong></td>
<tr><td width="100%" height="28"  align="left" colspan="6"> <hr /></td>
<tr><td align="left" colspan="3">&nbsp; </td></tr> 
<tr><td align="center" colspan="3">&nbsp;
<span style="font-weight: bold; font-style: italic; color: #FF6600">Are you sure to remove the Vendor?	</span><br /><br />
		<input type="submit" name="submit" id="submit" value="Remove" />
		<input type="hidden" name="BILL_ID" id="BILL_ID" size="70" value="<?php echo $_GET['BILL_ID']; ?>" />
		<input type="hidden" name="type" id="type" size="70" value="<?php echo $_GET['type']; ?>" />
 </td></tr> 
</table>
</form>