<?php
ob_start();
session_start();
include_once("common/function.php");
$classcall=new Newconnection();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_SESSION['admin_user_id']=="")
{
	header('location: index.php');
}
if (isset($_POST['submit']))
{
	$path = 'uploads/'.$_POST['fyear'];
	if (!file_exists($path)){	mkdir($path, 0777, true); }
	
	
	$filename = $_FILES['file']['name'];
	$location = $path.'/'.$filename;
	$file_extension = pathinfo($location, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);
	$image_ext = array("pdf","doc","docx");
	
	$response = 0;
	if(in_array($file_extension,$image_ext)){
	  // Upload file
	  $location = $path.'/'.trim($_POST['projectno']).".".$file_extension;
	  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
		$response = $location;
	  }
	}
	if($_FILES['file']['name']!="")
	{
		$query="INSERT INTO `tbl_uc` (`DINP`, `project_number`, `financial_year`, `path` ) VALUES (NOW(),'".trim($_POST['projectno'])."','".$_POST['fyear']."', '$location')";
		$classcall->insertQuery($query,$array);
		 header("Location:uc_upload.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ICSR - ADMIN</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<?php include_once "include_styles.php"; ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Main Header -->
		<?php include_once "header.php"; ?>
		
		<?php include_once "sidebar.php"; ?>
		
		<!-- Content Wrapper -->
		<div class="content-wrapper">
			<!-- Content Header -->
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="box">
							
						<div class="box-header text-success text-bold">
							<div class="col-xs-6">
								<h2 class="box-title text-bold">UC Certificate for Sponsored Project</h2>
							</div>							
							<div class="col-xs-6" align="right">
								<button type="button" class="btn bg-navy btn-flat" id="add_uc" >Add New</button>
							</div>
						</div>
						
						<div class="box-body" id="uc_show">
							
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="add_uc_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="ucForm" role="form" method="post" enctype= "multipart/form-data" action="uc_upload.php" >
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="myModalLabel">Add New Here</h4>
					</div>
					
					<div class="modal-body">
						<div class="box-body" id="add_question_body" >
							<table class="col-xs-12" id="popuptable">
								<tr>
									<td class="col-xs-3">
										<label>Project Number</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="uc_new" name="uc_new" type="hidden" value="1" >
										<input class="form-control" id="projectno" name="projectno" type="text" >
										<div id="suggesstion-box"></div>
									</td>
								</tr>
								<tr>
									<td class="col-xs-3">
										<label>Choose Financial Year</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<select class="form-control" id="fyear" name="fyear">
											<option value="">Choose Year</option>
											<option value="FY_2017-18">FY_2017-18</option>
											<option value="FY_2018-19">FY_2018-19</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td class="col-xs-3">
										<label>Select file </label>
									</td>
									<td class="col-xs-9" colspan=2 >										
										  <input type='file' name='file' id='file' class='form-control' >	
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" name="submit" id="submit" value="Upload" >Upload</button>
						<!--<input type="button" id="button" value="Add it" />-->
						<button type="reset" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add News Ends Here-->
	
	
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="edit_uc_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="editucForm" role="form" method="post" enctype= "multipart/form-data" >
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="myModalLabel">Edit Here</h4>
					</div>
					
					<div class="modal-body">
						<div class="box-body" id="add_question_body" >
							<table class="col-xs-12" id="popuptable">
								<tr>
									<td class="col-xs-3">
										<label>Title</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="uc_edit" name="uc_edit" type="hidden" value="1" >
										<input class="form-control" id="uc_edit_id" name="uc_edit_id" type="hidden" value="1" >
										<input class="form-control" id="edit_title" name="edit_title" type="text" >
									</td>
								</tr>
									
								<tr>
									<td class="col-xs-3">
										<label>Link</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="edit_link" name="edit_link" type="text" >
									</td>
								</tr>
								
								<tr>
									<td class="col-xs-3">
										<label>Due Date</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="edit_date" name="edit_date" type="text" >
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="edit_uc_btn" name="edit_uc_btn" >Update</button>
						<!--<input type="button" id="button" value="Add it" />-->
						<button type="submit" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add News Ends Here-->
	
	
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="delete_uc_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="deleteucForm" role="form" method="post" enctype= "multipart/form-data" >
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="myModalLabel">Delete Here</h4>
					</div>
					
					<div class="modal-body">
						<div class="box-body" id="add_question_body" >
							<table class="col-xs-12" id="popuptable">
								<tr>
									<td class="col-xs-3">
										<label>Title</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="uc_delete" name="uc_delete" type="hidden" value="1" >
										<input class="form-control" id="uc_delete_id" name="uc_delete_id" type="hidden" >
										<input class="form-control" id="delete_projectno" name="delete_projectno" type="text" readonly >
									</td>
								</tr>
								<tr>
									<td class="col-xs-3">
										<label>Financial Year</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="delete_fyear" name="delete_fyear" type="text" readonly>
									</td>
								</tr>	
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-outline  btn-flat" id="delete_uc_btn" name="delete_uc_btn" >Remove</button>
						<!--<input type="button" id="button" value="Add it" />-->
						<button type="button" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add News Ends Here-->
	<!-- Javascript Files -->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/app.min.js"></script>
	
	<!-- DataTables -->
	<script src="js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="js/plugins/datatables/dataTables.bootstrap.min.js"></script>
	
	<script type="text/javascript" src="js/ajaxfileupload.js"></script>
	<script>
		function selectProject(projectno) {
				//alert(coursename);
				$("#projectno").val(projectno);
				$("#suggesstion-box").hide();
				}
	
		
		$(document).ready(function () 
		{
			var loading = "<center><img src='img/loading.gif' /></center>";
			
			loadData();
			
			$("#add_uc").click(function()
			{
				$("#add_uc_popup").modal("show");
			});
			
			$("#projectno").keyup(function(){
					
					$.ajax({
					type: "POST",
					url: "ajaxcall.php",
					data:'keyword='+$(this).val(),
					beforeSend: function(){
						$("#projectno").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
					},
					success: function(data){
						$("#suggesstion-box").show();
						$("#suggesstion-box").html(data);
						$("#projectno").css("background","#FFF");
					}
					});
				}); 
			
			/*$("#add_uc_btn").click(function()
			{
				var form=$("#ucForm").serialize();
				
					$.ajax
					({
						type: "POST",
						url: "ajaxcall.php",
						data: form,
						success: function(msg)
						{
							loadData();
							alert("Proposal Added...");
						},
						error: function (jqXHR, exception) {
						
							var msg = '';
							if (jqXHR.status === 0) {
								msg = 'Not connect.\n Verify Network.';
							} else if (jqXHR.status == 404) {
								msg = 'Requested page not found. [404]';
							} else if (jqXHR.status == 500) {
								msg = 'Internal Server Error [500].';
							} else if (exception === 'parsererror') {
								msg = 'Requested JSON parse failed.';
							} else if (exception === 'timeout') {
								msg = 'Time out error.';
							} else if (exception === 'abort') {
								msg = 'Ajax request aborted.';
							} else {
								msg = 'Uncaught Error.\n' + jqXHR.responseText;
							}
							$('#post').html(msg);
						},
					});	
				
			});*/
			
			$("#edit_uc_btn").click(function()
			{
				var form=$("#editucForm").serialize();
													
				$.ajax
				({
					type: "POST",
					url: "ajaxcall.php",
					data: form,
					success: function(msg)
					{
						loadData();
						alert("Updated Successfully...");
					}
				});	
			});
			
			$("#delete_uc_btn").click(function()
			{
				var form=$("#deleteucForm").serialize();
													
				$.ajax
				({
					type: "POST",
					url: "ajaxcall.php",
					data: form,
					success: function(msg)
					{						
						alert("Removed Successfully...");
						loadData();
					}
				});	
			});
			
			
			function loadData()
			{
				$("#edit_uc_popup").modal("hide");
				$("#delete_uc_popup").modal("hide");
				var dataString = 'frompage=uc';
									
				$.ajax
				({
					type: "POST",
					url: "ajaxcall.php",
					data: dataString,
					success: function(msg)
					{
						$("#uc_show").html(msg);
					}
				});	
			}
		});
		
		function editProposalsPopup(pid,title,plink,pdate)
		{
			var dataString = 'editProposalsId='+pid;
			$.ajax
			({
				type: "POST",
				url: "ajaxcall.php",
				data: dataString,
				success: function(data)
				{
					
					$("#uc_edit_id").val(pid);
					$("#edit_title").val(title);
					$("#edit_link").val(plink);
					$("#edit_date").val(pdate);
					
					$("#edit_uc_popup").modal("show");
				}
			});	
		}
		
		function deleteUCPopup(uc_auto_id,projectno,fyear)
		{
			//alert(pid);
			var dataString = 'deleteUCId='+uc_auto_id;
			$.ajax
			({
				type: "POST",
				url: "ajaxcall.php",
				data: dataString,
				success: function(data)
				{
					
					$("#uc_delete_id").val(uc_auto_id);
					$("#delete_projectno").val(projectno);
					$("#delete_fyear").val(fyear);
					
					$("#delete_uc_popup").modal("show");
				}
			});	
		}
		
		
	</script>
</body>
</html>