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
								<h2 class="box-title text-bold">FAQs</h2>
							</div>							
							<div class="col-xs-6" align="right">
								<button type="button" class="btn bg-navy btn-flat" id="add_faqs" >Add New</button>
							</div>
						</div>
						
						<div class="box-body" id="faqs_show">
							
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="add_faqs_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="faqsForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<label>Question</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="faq_new" name="faq_new" type="hidden" value="1" >
										<input class="form-control" id="title" name="title" type="text" >
									</td>
								</tr>
									
								<tr>
									<td class="col-xs-3">
										<label>Answer</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<textarea class="form-control" id="answer" name="answer"></textarea>
									</td>
								</tr>
								
								<tr>
									<td class="col-xs-3">
										<label>Department</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<select class="form-control" id="Dept" name="Dept">
											<option value="">Choose Department</option>
											<option value="Accounts">Accounts</option>
											<option value="IPM Cell">IPM Cell</option>
											<option value="Office">Office</option>
											<option value="Purchase">Purchase</option>
											<option value="Recruitment">Recruitment</option>
											<option value="General">General</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="add_faqs_btn" name="add_faqs_btn" >Add</button>
						<!--<input type="submit" id="submit" value="Add it" />-->
						<button type="button" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add News Ends Here-->
	
	
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="edit_faqs_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="editfaqsForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<label>Question</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="faq_edit" name="faq_edit" type="hidden" value="1" >
										<input class="form-control" id="faq_edit_id" name="faq_edit_id" type="hidden" value="1" >
										<input class="form-control" id="edit_title" name="edit_title" type="text" >
									</td>
								</tr>
									
								<tr>
									<td class="col-xs-3">
										<label>Answer</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<textarea class="form-control" id="edit_answer" name="edit_answer"></textarea>
									</td>
								</tr>
								
								<tr>
									<td class="col-xs-3">
										<label>Department</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<select class="form-control" id="edit_Dept" name="edit_Dept">
											<option value="">Choose Department</option>
											<option value="Accounts">Accounts</option>
											<option value="IPM Cell">IPM Cell</option>
											<option value="Office">Office</option>
											<option value="Purchase">Purchase</option>
											<option value="Recruitment">Recruitment</option>
											<option value="General">General</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="edit_faqs_btn" name="edit_faqs_btn" >Update</button>
						<!--<input type="submit" id="submit" value="Add it" />-->
						<button type="button" class="btn btn-outline  btn-flat pull-left" data-dismiss="modal" >Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Add News Ends Here-->
	
	
	<!-- Add News Starts Here-->
	<div class="modal modal-primary fade" id="delete_faqs_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="deletefaqsForm" role="form" method="post" enctype= "multipart/form-data" >
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
										<label>Question</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="faq_delete" name="faq_delete" type="hidden" value="1" >
										<input class="form-control" id="faq_delete_id" name="faq_delete_id" type="hidden" value="1" >
										<input class="form-control" id="delete_title" name="delete_title" type="text" readonly>
									</td>
								</tr>
									
								<tr>
									<td class="col-xs-3">
										<label>Answer</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="delete_answer" name="delete_answer" type="text" readonly>
									</td>
								</tr>
								
								<tr>
									<td class="col-xs-3">
										<label>Department</label>
									</td>
									<td class="col-xs-9" colspan=2 >
										<input class="form-control" id="delete_Dept" name="delete_Dept" type="text" readonly>
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline  btn-flat" id="delete_faqs_btn" name="delete_faqs_btn" >Remove</button>
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
			
			$("#add_faqs").click(function()
			{
				$("#add_faqs_popup").modal("show");
			});
			
			$("#add_faqs_btn").click(function()
			{
				var form=$("#faqsForm").serialize();
				
					$.ajax
					({
						type: "POST",
						url: "ajaxcall.php",
						data: form,
						success: function(msg)
						{
							loadData();
							alert("FAQ Added...");
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
			
			$("#edit_faqs_btn").click(function()
			{
				var form=$("#editfaqsForm").serialize();
													
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
			
			$("#delete_faqs_btn").click(function()
			{
				var form=$("#deletefaqsForm").serialize();
												
				$.ajax
				({
					type: "POST",
					url: "ajaxcall.php",
					data: form,
					success: function(msg)
					{
						//alert("remove");	
						loadData();
						alert("Removed Successfully...");
					}
				});	
			});
			
			
			function loadData()
			{
				
				var dataString = 'frompage=faqs';
									
				$.ajax
				({
					type: "POST",
					url: "ajaxcall.php",
					data: dataString,
					success: function(msg)
					{
						$("#faqs_show").html(msg);
					}
				});	
			}
		});
		
		function editFaqPopup(fid,Question,Answer,Department)
		{
			var dataString = 'editFaqsId='+fid;
			$.ajax
			({
				type: "POST",
				url: "ajaxcall.php",
				data: dataString,
				success: function(data)
				{
					
					$("#faq_edit_id").val(fid);
					$("#edit_title").val(Question);
					$("#edit_answer").val(Answer);
					$("#edit_Dept").val(Department);
					$("#edit_Dept").prepend("<option value='"+Department+"'>"+Department+"</option>");
					
					$("#edit_faqs_popup").modal("show");
				}
			});	
		}
		
		function deleteFaqPopup(fid,Question,Answer,Department)
		{
			//alert(pid);
			var dataString = 'deleteFaqsId='+fid;
			$.ajax
			({
				type: "POST",
				url: "ajaxcall.php",
				data: dataString,
				success: function(data)
				{
					
					$("#faq_delete_id").val(fid);
					$("#delete_title").val(Question);
					$("#delete_answer").val(Answer);
					$("#delete_Dept").val(Department);
					
					$("#delete_faqs_popup").modal("show");
				}
			});	
		}
		
		
	</script>
</body>
</html>