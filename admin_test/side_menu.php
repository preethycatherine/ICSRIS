<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
?>
<h3>Invoices</h3>
<p><ul><li><a href="icsrisacct.php">Home</a></li></ul></p>	
<?php if($_SESSION["username"]=="admin"){ ?>	<p><ul><li><a href="create_inv.php">Create Invoice</a></li></ul></p> <?php }	?>
<p><ul><li><a href="invoices.php">Submitted Invoices</a></li></ul></p>	
<p><ul><li><a href="receipts.php">Pay in Slip Details</a></li></ul></p>		
<?php if($_SESSION["username"]=="admin"){ ?>
	<!--<p><ul><li><a href="create_inv_blank.php">Create Invoice - Blanket</a></li></ul></p>	-->	
	<p><ul><li><a href="credit_notes.php">Credit Notes</a></li></ul></p>		
	<p><ul><li><a href="debit_notes.php">Debit Notes</a></li></ul></p>		
<?php }	?>
	<h3>Billing Address</h3>
	<p><ul><li><a href="Billing_address_gstin.php">View Billing Address</a></li></ul></p>	
	<p><ul><li><a href="Billing_address_add.php">Add Billing Address</a></li></ul></p>		
	<h3>Reports</h3>
	<p><ul><li><a href="gst_reports.php">GST Reports</a></li></ul></p>	
	<p><ul><li><a href="search_inv.php">Search Invoices</a></li></ul></p>	
	<p><ul><li><a href="reports_over_all_invoices.php">All Invoices</a></li></ul></p>	
	<p><ul><li><a href="reports_overall_outstanding.php">All Outstandings</a></li></ul></p>	
