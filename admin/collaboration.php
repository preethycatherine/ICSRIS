<?php
ob_start();
session_start();
include_once("common/function.php");
$classcall=new Newconnection();
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
								<h2 class="box-title text-bold">Interest for Collaboration</h2>
							</div>							
							<div class="col-xs-6" align="right">
								<button type="button" class="btn bg-navy btn-flat" id="add_collaboration" >Add New</button>
							</div>
						</div>
						
						<div class="box-body" id="collaboration_show">
							
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="add_collaboration_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="collaborationForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<label>Title</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="collaboration_new" name="collaboration_new" type="hidden" value="1" >
										<input class="form-control" id="title" name="title" type="text" >
									</td>
								</tr>
									
								<tr>
									<td class="col-xs-3">
										<label>Link</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="link" name="link" type="text" >
									</td>
								</tr>
								
								<!--<tr>
									<td class="col-xs-3">
										<label>Due Date</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="date" name="date" type="date" >
									</td>
								</tr>-->
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="add_collaboration_btn" name="add_collaboration_btn" >Add</button>
						<!--<input type="submit" id="submit" value="Add it" />-->
						<button type="button" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add News Ends Here-->
	
	
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="edit_collaboration_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="editcollaborationForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<input class="form-control" id="collaboration_edit" name="collaboration_edit" type="hidden" value="1" >
										<input class="form-control" id="collaboration_edit_id" name="collaboration_edit_id" type="hidden" value="1" >
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
								<!--
								<tr>
									<td class="col-xs-3">
										<label>Due Date</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="edit_date" name="edit_date" type="text" >
									</td>
								</tr>-->
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="edit_collaboration_btn" name="edit_collaboration_btn" >Update</button>
						<!--<input type="submit" id="submit" value="Add it" />-->
						<button type="button" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add News Ends Here-->
	
	
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="delete_collaboration_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="deletecollaborationForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<input class="form-control" id="collaboration_delete" name="collaboration_delete" type="hidden" value="1" >
										<input class="form-control" id="collaboration_delete_id" name="collaboration_delete_id" type="hidden" value="1" >
										<input class="form-control" id="delete_title" name="delete_title" type="text" >
									</td>
								</tr>
									
								<tr>
									<td class="col-xs-3">
										<label>Link</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="delete_link" name="delete_link" type="text" >
									</td>
								</tr>
								<!--
								<tr>
									<td class="col-xs-3">
										<label>Due Date</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="delete_date" name="delete_date" type="text" >
									</td>
								</tr>-->
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="delete_collaboration_btn" name="delete_collaboration_btn" >Remove</button>
						<!--<input type="submit" id="submit" value="Add it" />-->
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
		$(document).ready(function () 
		{
			var loading = "<center><img src='img/loading.gif' /></center>";
			
			loadData();
			
			$("#add_collaboration").click(function()
			{
				$("#add_collaboration_popup").modal("show");
			});
			
			$("#add_collaboration_btn").click(function()
			{
				var form=$("#collaborationForm").serialize();
				
					$.ajax
					({
						type: "POST",
						url: "ajaxcall.php",
						data: form,
						success: function(msg)
						{
							loadData();
							alert("Collaboration Added...");
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
				
			});
			
			$("#edit_collaboration_btn").click(function()
			{
				var form=$("#editcollaborationForm").serialize();
													
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
			
			$("#delete_collaboration_btn").click(function()
			{
				var form=$("#deletecollaborationForm").serialize();
													
				$.ajax
				({
					type: "POST",
					url: "ajaxcall.php",
					data: form,
					success: function(msg)
					{
						loadData();
						alert("Removed Successfully...");
					}
				});	
			});
			
			
			function loadData()
			{
				
				var dataString = 'frompage=collaboration';
									
				$.ajax
				({
					type: "POST",
					url: "ajaxcall.php",
					data: dataString,
					success: function(msg)
					{
						$("#collaboration_show").html(msg);
					}
				});	
			}
		});
		
		function editCollaborationPopup(pid,title,plink)
		{
			var dataString = 'editCollaborationId='+pid;
			$.ajax
			({
				type: "POST",
				url: "ajaxcall.php",
				data: dataString,
				success: function(data)
				{
					//alert(pdate);
					$("#collaboration_edit_id").val(pid);
					$("#edit_title").val(title);
					$("#edit_link").val(plink);
					
					$("#edit_collaboration_popup").modal("show");
				}
			});	
		}
		
		function deleteCollaborationPopup(pid,title,plink)
		{
			//alert(pid);
			var dataString = 'deleteCollaborationId='+pid;
			$.ajax
			({
				type: "POST",
				url: "ajaxcall.php",
				data: dataString,
				success: function(data)
				{
					
					$("#collaboration_delete_id").val(pid);
					$("#delete_title").val(title);
					$("#delete_link").val(plink);
					
					$("#delete_collaboration_popup").modal("show");
				}
			});	
		}
		
		
	</script>
</body>
</html>