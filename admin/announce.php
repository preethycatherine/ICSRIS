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
								<h2 class="box-title text-bold">Announcements</h2>
							</div>							
							<div class="col-xs-6" align="right">
								<button type="button" class="btn bg-navy btn-flat" id="add_announce" >Add New</button>
							</div>
						</div>
						
						<div class="box-body" id="announce_show">
							
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- Add Announcements Starts Here-->
	<div class="modal modal-primary fade" id="add_announce_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="announceForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<label>Announcements Title</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="title_new" name="title_new" type="hidden" value="1" >
										<input class="form-control" id="announce_title" name="announce_title" type="text" >
									</td>
								</tr>
									
								<tr>
									<td class="col-xs-3">
										<label>Upload File</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" type="file" name="file" id="file" multiple>
									</td>
								</tr>
								
								<tr>
									<td class="col-xs-3">
										<label>date</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="announce_date" name="announce_date" type="text" value="<?php echo date("d/m/Y"); ?>" >
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="add_announce_btn" name="add_announce_btn" >Add</button>
						<!--<input type="submit" id="submit" value="Add it" />-->
						<button type="button" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add Announcements Ends Here-->
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
			
			$("#add_announce").click(function()
			{
				$("#add_announce_popup").modal("show");
			});
			
			$("#add_announce_btn").click(function()
			{
				var form=$("#announceForm").serialize();
				var formData = new FormData(this);
					$.ajax
					({
						type: "POST",
						url: "ajaxcall.php",
						data: form,
						success: function(msg)
						{
							loadData();
							alert("Announced...");
						}
					});	
				
			});
			
			
			function loadData()
			{
				$("#announce_show").html(loading);
				
				var dataString = 'frompage=announce';
									
				$.ajax
				({
					type: "POST",
					url: "ajaxcall.php",
					data: dataString,
					success: function(msg)
					{
						$("#announce_show").html(msg);
					}
				});	
			}
		});
	</script>
</body>
</html>