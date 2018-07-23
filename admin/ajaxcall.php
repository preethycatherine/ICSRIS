<?php
session_start(); 
if(!isset($_SESSION['admin_user_id']))
{
	 header("Location:index.php");
}  
include_once("common/function.php");

$classcall=new Newconnection();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/***************************** proposals **********************************************************************/

if(isset($_POST['frompage']) && ($_POST['frompage']=="proposals"))
{
	$query="SELECT * FROM tbl_proposals ORDER BY DINP DESC";
	$array=array();
	$proposalslists=$classcall->selectQuery($query,$array);
	$data='<table id="year_list" class="table table-bordered table-striped">
				<thead>
					<tr class="bg-success">
						<th>S.No</th>
						<th>Title</th>
						<th>Link</th>
						<th>Due Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
	$inc=0;
	foreach($proposalslists as $proposallists)
	{
		$inc++;
		$duedate=date('d/m/Y', strtotime($proposallists['date']));
		$data.="<tr>
					<td>".$inc."</td>
					<td>".$proposallists['Title']."</td>
					<td>".$proposallists['Link']."</td>
					<td>".$duedate."</td>
					<td width='10%'><p class='btn btn-success' title='Edit' onClick='return editProposalsPopup(`".trim($proposallists['proposal_auto_id'])."`,`".trim($proposallists['Title'])."`,`".trim($proposallists['Link'])."`,`".$duedate."`)'><i class='fa fa-pencil'></i></p>&nbsp;&nbsp;<p class='btn btn-danger' title='Delete' onClick='return deleteProposalsPopup(`".trim($proposallists['proposal_auto_id'])."`,`".trim($proposallists['Title'])."`,`".trim($proposallists['Link'])."`,`".$duedate."`)'><i class='fa fa-trash' aria-hidden='true'></i></p></td>
				</tr>";
	}
	
	$data.='</tbody>
			</table>';
?>
	<script>
	$(document).ready(function () 
	{
		$("#year_list").DataTable();
	});
	</script>
<?php
	echo $data;
	//echo $query;
	
}
if(isset($_POST['proposal_new']))
{
	$query="INSERT INTO `tbl_proposals` (`DINP`, `Title` ,`Link` ,`date` ) VALUES (NOW(),'".$_POST['title']."', '".$_POST['link']."', '".$_POST['date']."')";

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}
if(isset($_POST['proposal_edit']))
{
	echo $query="update `tbl_proposals` set `Title`='".$_POST['edit_title']."' ,`Link`='".$_POST['edit_link']."' ,`date`='".date('Y/d/m', strtotime($_POST['edit_date']))."' where`proposal_auto_id`=".$_POST['proposal_edit_id'];

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}
if(isset($_POST['proposal_delete']))
{
	$query="delete from `tbl_proposals` where `proposal_auto_id`=".$_POST['proposal_delete_id'];

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}

/***************************** Collaboration **********************************************************************/


if(isset($_POST['frompage']) && ($_POST['frompage']=="collaboration"))
{
	$query="SELECT * FROM tbl_collaborations ORDER BY DINP DESC";
	$array=array();
	$collaborationslists=$classcall->selectQuery($query,$array);
	$data='<table id="year_list" class="table table-bordered table-striped">
				<thead>
					<tr class="bg-success">
						<th>S.No</th>
						<th>Title</th>
						<th>Link</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
	$inc=0;
	foreach($collaborationslists as $collaborationlists)
	{
		$inc++;
		$duedate=date('d/m/Y', strtotime($collaborationlists['date']));
		$data.="<tr>
					<td>".$inc."</td>
					<td>".$collaborationlists['Title']."</td>
					<td>".$collaborationlists['Link']."</td>
					<td width='10%'><p class='btn btn-success' title='Edit' onClick='return editCollaborationPopup(`".trim($collaborationlists['collaboration_auto_id'])."`,`".trim($collaborationlists['Title'])."`,`".trim($collaborationlists['Link'])."`,`".$duedate."`)'><i class='fa fa-pencil'></i></p>&nbsp;&nbsp;<p class='btn btn-danger' title='Delete' onClick='return deleteCollaborationPopup(`".trim($collaborationlists['collaboration_auto_id'])."`,`".trim($collaborationlists['Title'])."`,`".trim($collaborationlists['Link'])."`,`".$duedate."`)'><i class='fa fa-trash' aria-hidden='true'></i></p></td>
				</tr>";
	}
	
	$data.='</tbody>
			</table>';
?>
	<script>
	$(document).ready(function () 
	{
		$("#year_list").DataTable();
	});
	</script>
<?php
	echo $data;
	//echo $query;
	
}
if(isset($_POST['collaboration_new']))
{
	$query="INSERT INTO `tbl_collaborations` (`DINP`, `Title` ,`Link` ) VALUES (NOW(),'".$_POST['title']."', '".$_POST['link']."')";

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}
if(isset($_POST['collaboration_edit']))
{
	echo $query="update `tbl_collaborations` set `Title`='".$_POST['edit_title']."' ,`Link`='".$_POST['edit_link']."' where`collaboration_auto_id`=".$_POST['collaboration_edit_id'];

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}
if(isset($_POST['collaboration_delete']))
{
	$query="delete from `tbl_collaborations` where `collaboration_auto_id`=".$_POST['collaboration_delete_id'];

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}


/***************************** LINK **********************************************************************/

if(isset($_POST['frompage']) && ($_POST['frompage']=="link"))
{
	$query="SELECT * FROM tbl_links ORDER BY DINP ASC";
	$array=array();
	$linkslists=$classcall->selectQuery($query,$array);
	$data='<table id="year_list" class="table table-bordered table-striped">
				<thead>
					<tr class="bg-success">
						<th>S.No</th>
						<th>Title</th>
						<th>Link</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
	$inc=0;
	foreach($linkslists as $linklists)
	{
		$inc++;
		//$duedate=date('d/m/Y', strtotime($linklists['date']));
		$data.="<tr>
					<td>".$inc."</td>
					<td>".$linklists['Title']."</td>
					<td>".$linklists['Link']."</td>
					<td width='10%'><p class='btn btn-success' title='Edit' onClick='return editLinkPopup(`".trim($linklists['links_auto_id'])."`,`".trim($linklists['Title'])."`,`".trim($linklists['Link'])."`)'><i class='fa fa-pencil'></i></p>&nbsp;&nbsp;<p class='btn btn-danger' title='Delete' onClick='return deleteLinkPopup(`".trim($linklists['links_auto_id'])."`,`".trim($linklists['Title'])."`,`".trim($linklists['Link'])."`)'><i class='fa fa-trash' aria-hidden='true'></i></p></td>
				</tr>";
	}
	
	$data.='</tbody>
			</table>';
?>
	<script>
	$(document).ready(function () 
	{
		$("#year_list").DataTable();
	});
	</script>
<?php
	echo $data;
	//echo $query;
	
}
if(isset($_POST['link_new']))
{
	$query="INSERT INTO `tbl_links` (`DINP`, `Title` ,`Link` ) VALUES (NOW(),'".$_POST['title']."', '".$_POST['link']."')";

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}
if(isset($_POST['link_edit']))
{
	echo $query="update `tbl_links` set `Title`='".$_POST['edit_title']."' ,`Link`='".$_POST['edit_link']."'  where`links_auto_id`=".$_POST['link_edit_id'];

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}
if(isset($_POST['link_delete']))
{
	$query="delete from `tbl_links` where `links_auto_id`=".$_POST['link_delete_id'];

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}


/***************************** FAQs **********************************************************************/

if(isset($_POST['frompage']) && ($_POST['frompage']=="faqs"))
{
	$query="SELECT * FROM tbl_faqs ORDER BY DINP ASC";
	$array=array();
	$faqslists=$classcall->selectQuery($query,$array);
	$data='<table id="year_list" class="table table-bordered table-striped">
				<thead>
					<tr class="bg-success">
						<th>S.No</th>
						<th>Qustion</th>
						<th>Answer</th>
						<th>Department</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
	$inc=0;
	foreach($faqslists as $faqlists)
	{
		$inc++;
		//$duedate=date('d/m/Y', strtotime($faqlists['date']));
		$data.="<tr>
					<td>".$inc."</td>
					<td>".$faqlists['Question']."</td>
					<td>".$faqlists['Answer']."</td>
					<td>".$faqlists['Department']."</td>
					<td width='10%'><p class='btn btn-success' title='Edit' onClick='return editFaqPopup(`".trim($faqlists['faq_auto_id'])."`,`".trim($faqlists['Question'])."`,`".trim($faqlists['Answer'])."`,`".trim($faqlists['Department'])."`)'><i class='fa fa-pencil'></i></p>&nbsp;&nbsp;<p class='btn btn-danger' title='Delete' onClick='return deleteFaqPopup(`".trim($faqlists['faq_auto_id'])."`,`".trim($faqlists['Question'])."`,`".trim($faqlists['Answer'])."`,`".trim($faqlists['Department'])."`)'><i class='fa fa-trash' aria-hidden='true'></i></p></td>
				</tr>";
	}
	
	$data.='</tbody>
			</table>';
?>
	<script>
	$(document).ready(function () 
	{
		$("#year_list").DataTable();
	});
	</script>
<?php
	echo $data;
	//echo $query;
	
}
if(isset($_POST['faq_new']))
{
	$query="INSERT INTO `tbl_faqs` (`DINP`, `Question` ,`Answer`,`Department` ) VALUES (NOW(),'".$_POST['title']."', '".$_POST['answer']."', '".$_POST['Dept']."')";

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}
if(isset($_POST['faq_edit']))
{
	echo $query="update `tbl_faqs` set `Question`='".$_POST['edit_title']."' ,`Answer`='".$_POST['edit_answer']."',`Department`='".$_POST['edit_Dept']."'  where`faq_auto_id`=".$_POST['faq_edit_id'];

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}
if(isset($_POST['faq_delete']))
{
	$query="delete from `tbl_faqs` where `faq_auto_id`=".$_POST['faq_delete_id'];

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}

/***************************** UC **********************************************************************/

if(!empty($_POST["keyword"]))
{
	//include("common/db-icsr.php");
	//$query ="select * from mstlst ORDER BY cprno";
	//$result = sqlsrv_query($selected,$query);
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$instid1="";
	$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
	$strsql="select * from mstlst WHERE NPRNO like '" . $_POST["keyword"] . "%' ORDER BY NPRNO";
	$process=odbc_exec($sqlconnect,$strsql) or die("<br>Connection Failed");
	
	if(!empty($process)) 
	{
		
		?>
		<ul id="Course-list" style="background-color:#666666" style="font:'Times New Roman', Times, serif">
		<?php
		while(odbc_fetch_row($process))
		{
		?>
		<li onClick="selectProject('<?php echo odbc_result($process,"NPRNO"); ?> ');" style="cursor:pointer"><?php echo odbc_result($process,"NPRNO"); ?></li>
		<?php	
		} 	
		?>
		</ul>
		<?php
	}
	
} 

if(isset($_POST['frompage']) && ($_POST['frompage']=="uc"))
{
	$query="SELECT * FROM tbl_uc ORDER BY DINP ASC";
	$array=array();
	$uclists=$classcall->selectQuery($query,$array);
	$data='<table id="uc_list" class="table table-bordered table-striped">
				<thead>
					<tr class="bg-success">
						<th>S.No</th>
						<th>Project Number</th>
						<th>Financial Year</th>
						<th>File</th>
						<th>Uploaded On</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
	$inc=0;
	foreach($uclists as $uclist)
	{
		$inc++;
		//$duedate=date('d/m/Y', strtotime($faqlists['date']));
		$data.="<tr>
					<td>".$inc."</td>
					<td>".$uclist['project_number']."</td>
					<td>".$uclist['financial_year']."</td>
					<td><a href='".$uclist['path']."' target='_blank'>".str_replace("uploads/","",$uclist['path'])."</a></td>
					<td>".date('d/m/Y', strtotime($uclist['dinp']))."</td>	
					<td width='10%'><p class='btn btn-danger' title='Delete' onClick='return deleteUCPopup(`".trim($uclist['uc_auto_id'])."`,`".trim($uclist['project_number'])."`,`".trim($uclist['financial_year'])."`)'><i class='fa fa-trash' aria-hidden='true'></i></p></td>				
				</tr>";
	}
	
	$data.='</tbody>
			</table>';
?>
	<script>
	$(document).ready(function () 
	{
		$("#uc_list").DataTable();
	});
	</script>
<?php
	echo $data;
	//echo $query;	
}
if(isset($_POST['uc_delete']))
{
	$query="delete from `tbl_uc` where `uc_auto_id`=".$_POST['uc_delete_id'];

	$classcall->insertQuery($query,$array);
	
	echo "Success";
}


?>
