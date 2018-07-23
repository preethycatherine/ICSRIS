<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(!isset($_COOKIE["PHPSESSID"]))
{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: https://icsris.iitm.ac.in/ICSRIS/index.php');
	exit;

}
else
{
	$insid=$_SESSION['instid'];
	$usermode=$_SESSION['usermode'];
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$instid1="";
	$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
	
}

if(isset($_COOKIE["PHPSESSID"]))
{
	$ReceiptNumber=$_SESSION["ReceiptNumber"];
	
	$strsql="";
	if($_SESSION['invoice_type']=="Un-Registered")
		$strsql="Select * from GST_Receipt_Details a, GST_BILL_TO_DETAILS_VENDOR b, GST_Invoice_Details c where c.BillToID=b.bill_id and a.ReceiptNumber='$ReceiptNumber' and a.InvoiceNumber=c.InvoiceNumber";
	elseif($_SESSION['invoice_type']=="Export")
		$strsql="Select * from GST_Receipt_Details a, GST_BILL_TO_DETAILS_EXPORT b, GST_Invoice_Details c where c.BillToID=b.bill_id and a.ReceiptNumber='$ReceiptNumber' and a.InvoiceNumber=c.InvoiceNumber";
	else
		$strsql="Select * from GST_Receipt_Details a, GST_BILL_TO_DETAILS b, GST_Invoice_Details c where c.BillToID=b.bill_id and a.ReceiptNumber='$ReceiptNumber' and a.InvoiceNumber=c.InvoiceNumber";
	
	//echo $strsql;	
	$process=odbc_exec($sqlconnect,$strsql);
	
	if (odbc_fetch_row($process))
	{
		$msg="";
			
		include("currency_words.php");
		require_once('tcpdf/config/lang/eng.php');
		require_once('tcpdf/tcpdf.php');
		date_default_timezone_set('Asia/Calcutta');
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->AddPage();
		
		$html = '
		<table><tr><td><img src="images/logo_iitm.jpg"></td></tr></table>
		';
		$pdf->writeHTML($html, true, false, true, false, '');
		
		// create some HTML content
		$html = '
		<table style="background-color:#62AC80" width="100%" >
		<tr>
		<th colspan=5 ><div align="center"> <span style="color:#663300"><strong>PAY-IN-SLIP</strong> </span></div></th>
		</tr>
		</table>
		<br><br>
		<table width="100%">
		<tr>
		<th><div align="right"><span style="color:#663300"> Pay in Slip Number : </span></div></th>
		<th><div align="left"> '.$ReceiptNumber.'</div></th>
		<th><div align="right"><span style="color:#663300"> Date of Pay in Slip : </span></div></th>
		<th><div align="left"> '.date('d-M-Y', strtotime(odbc_result($process,"DINP"))).'</div></th>
		</tr>
		</table>
		<br><br>
		<table width="100%" border="1" >
		<tr>
		<th><div align="left"><span style="color:#663300"> Project Number</span></div></th>
		<th colspan="4"><div align="left"> '.odbc_result($process,"ProjectNumber").'</div></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> PI Name</span></div></th>
		<th colspan="4"><div align="left"> '.odbc_result($process,"PIName").'</div></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Invoice No</span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"InvoiceNumber").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Invoice Date</span></div></th>
		<th colspan="4" align="left"> '.date('d-M-Y', strtotime(odbc_result($process,"InvoiceDate"))).'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Name of Client</span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"NAME").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Address of Client</span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"ADDRESS").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> District</span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"DISTRICT").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> State</span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"STATE").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> GSTIN of Client</span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"GSTIN").'</th>
		</tr>
		</table>
		<br><br>
		<table width="100%" border="1">
		<tr>
		<th><div align="left"><span style="color:#663300">Taxable Value</span></div></th>
		<th colspan="4" align="left"> '.IND_money_format(odbc_result($process,"TaxableValue")).'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">CGST (9%)</span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"CGSTAmount").'</th>	
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">SGST (9%)</span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"SGSTAmount").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">IGST (18%)</span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"IGSTAmount").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300">Total Invoice Value </span></div></th>
		<th colspan="4" align="left"> '.odbc_result($process,"TotalInvoiceValue").'</th>
		</tr>
		</table>
		<br><br>
		<table width="100%" border="1">
		<tr>
		<th><div align="left"><span style="color:#663300"> Amount Received</span></div></th>
		<th colspan="4" align="left">  '.IND_money_format(odbc_result($process,"RemittedAmount")).'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> TDS Receivable</span></div></th>
		<th colspan="4" align="left">  '.IND_money_format(odbc_result($process,"TDSAmount")).'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Mode of Payment</span></div></th>
		<th colspan="4" align="left">  '.odbc_result($process,"PaymentMode").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Reference Number</span></div></th>
		<th colspan="4" align="left">  '.odbc_result($process,"ReferenceNumber").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Instruments Date </span></div></th>
		<th colspan="4" align="left">  '.odbc_result($process,"ReceiptDate").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Remarks </span></div></th>
		<th colspan="4" align="left">  '.odbc_result($process,"Remarks").'</th>
		</tr>';
			$avail_amt=0;
			$TotalInvoiceValue=odbc_result($process,"TotalInvoiceValue");
			$invoice_number=odbc_result($process,"InvoiceNumber");
			
			odbc_close_all();
			$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
			$rec_tot=0;
			$strsql_rec_tot="Select * from GST_Receipt_Details where InvoiceNumber='$invoice_number'";
			$process_rec_tot=odbc_exec($sqlconnect,$strsql_rec_tot);
			while(odbc_fetch_row($process_rec_tot))
			{
				$rec_tot=$rec_tot+odbc_result($process_rec_tot,"RemittedAmount")+odbc_result($process_rec_tot,"TDSAmount");
			}
		$html = $html.'
		<tr>
		<th><div align="left"><span style="color:#663300"> Outstanding </span></div></th>
		<th colspan="4" align="left"> '.($TotalInvoiceValue-$rec_tot).'</th>
		</tr>
		</table><br><br>
		<table width="100%" >
		<tr><th colspan="4"><div align="left"><span style="color:#663300"> Signature of the PI :</span></div></th></tr>
		<tr>
		<th colspan="4">
			<div align="left"><br><br>
			<strong>Note :</strong><br>		<br>			
			<font size="10">1. To be sent IC&SR Office<br><br>
					2. GST (as stipulated by Central Govt) 18% w.e.f. 01.07.2017 to be deducted from the receipts to the Consultancy Projects, based on the invoice.<br><br>
					3. Invoice shall be raised always through IC&SR web page.<br>	<br>
					4. For RC Projects Overheads will not be deducted initially. For IC Projects 10% (5% Corpus, 5% IC&SR) of the receipts after deduction of service tax will be taken as overheads. For RB / CSR Projects 5% (2.5% Corpus, 2.5% IC&SR ) of the receipts after deduction of service tax will be taken as overheads.</font>
			</div>
		</th>
		</tr>
		</table>	
	';
		$pdf->writeHTML($html, true, false, true, false, '');
		
						
		// reset pointer to the last page
		$pdf->lastPage();
		
		// ---------------------------------------------------------
		$fname=$ReceiptNumber.".pdf";
		ob_end_clean();
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output($fname, 'D');
	}
}
?>
