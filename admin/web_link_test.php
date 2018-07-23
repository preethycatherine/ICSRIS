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
								<h2 class="box-title text-bold">Add Links</h2>
							</div>							
							<div class="col-xs-6" align="right">
								<button type="button" class="btn bg-navy btn-flat" id="add_link" >Add New</button>
							</div>
						</div>
						
						<div class="box-body" id="link_show">
							
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="add_link_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="linkForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<input class="form-control" id="link_new" name="link_new" type="hidden" value="1" >
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
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="add_link_btn" name="add_link_btn" >Add</button>
						<!--<input type="submit" id="submit" value="Add it" />-->
						<button type="button" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add News Ends Here-->
	
	
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="edit_link_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="editlinkForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<input class="form-control" id="link_edit" name="link_edit" type="hidden" value="1" >
										<input class="form-control" id="link_edit_id" name="link_edit_id" type="hidden" value="1" >
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
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="edit_link_btn" name="edit_link_btn" >Update</button>
						<!--<input type="submit" id="submit" value="Add it" />-->
						<button type="button" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add News Ends Here-->
	
	
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="delete_link_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="deletelinkForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<input class="form-control" id="link_delete" name="link_delete" type="hidden" value="1" >
										<input class="form-control" id="link_delete_id" name="link_delete_id" type="hidden" value="1" >
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
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="delete_link_btn" name="delete_link_btn" >Remove</button>
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
			
			$("#add_link").click(function()
			{
				$("#add_link_popup").modal("show");
			});
			
			$("#add_link_btn").click(function()
			{
				var form=$("#linkForm").serialize();
				
					$.ajax
					({
						type: "POST",
						url: "ajaxcall.php",
						data: form,
						success: function(msg)
						{
							loadData();
							alert("Link Added...");
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
			
			$("#edit_link_btn").click(function()
			{
				var form=$("#editlinkForm").serialize();
													
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
			
			$("#delete_link_btn").click(function()
			{
				var form=$("#deletelinkForm").serialize();
													
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
				
				var dataString = 'frompage=link';
									
				$.ajax
				({
					type: "POST",
					url: "ajaxcall.php",
					data: dataString,
					success: function(msg)
					{
						$("#link_show").html(msg);
					}
				});	
			}
		});
		
		function editLinkPopup(pid,title,plink)
		{
			var dataString = 'editLinkId='+pid;
			$.ajax
			({
				type: "POST",
				url: "ajaxcall.php",
				data: dataString,
				success: function(data)
				{
					//alert(pdate);
					$("#link_edit_id").val(pid);
					$("#edit_title").val(title);
					$("#edit_link").val(plink);
					
					$("#edit_link_popup").modal("show");
				}
			});	
		}
		
		function deleteLinkPopup(pid,title,plink)
		{
			//alert(pid);
			var dataString = 'deleteLinkId='+pid;
			$.ajax
			({
				type: "POST",
				url: "ajaxcall.php",
				data: dataString,
				success: function(data)
				{
					
					$("#link_delete_id").val(pid);
					$("#delete_title").val(title);
					$("#delete_link").val(plink);
					
					$("#delete_link_popup").modal("show");
				}
			});	
		}
		
		
	</script>
</body>
</html>