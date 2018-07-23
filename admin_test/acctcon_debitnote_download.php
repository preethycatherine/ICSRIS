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
	
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$instid1="";
	$sqlconnect=odbc_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
	
}

if(isset($_COOKIE["PHPSESSID"]))
{
	$DebitNoteNumber=$_SESSION["DebitNoteNumber"];
	
	$strsql="";
	if($_SESSION['invoice_type']=="Un-Registered")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_VENDOR b, GST_Debit_Note_Details c where a.BillToID=b.bill_id and c.DebitNoteNumber='$DebitNoteNumber' and a.InvoiceNumber=c.InvoiceNumber";
	elseif($_SESSION['invoice_type']=="Export")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_EXPORT b, GST_Debit_Note_Details c where a.BillToID=b.bill_id and c.DebitNoteNumber='$DebitNoteNumber' and a.InvoiceNumber=c.InvoiceNumber";
	else
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b, GST_Debit_Note_Details c where a.BillToID=b.bill_id and c.DebitNoteNumber='$DebitNoteNumber' and a.InvoiceNumber=c.InvoiceNumber";
	
	include("../currency_words.php");
	//echo $strsql;	
	$process=odbc_exec($sqlconnect,$strsql);
	
	if (odbc_fetch_row($process))
	{
		$msg="";
		require_once('../tcpdf/config/lang/eng.php');
		require_once('../tcpdf/tcpdf.php');
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
		<th colspan=5 ><div align="center"> <strong>DEBIT NOTE</strong> </div></th>
		</tr>
		</table>
		<br><br>
		<table width="100%">
		<tr>
		<th><div align="left"><b> GSTIN : 33AAAAI3615G1Z6</b></div></th>
		<th><div align="left"><b> Invoice Ref. No.  :  '.odbc_result($process,"InvoiceNumber").'</b></div></th>
		</tr>
		</table>
		<br><br>
		<table width="100%">
		<tr>
		<th ><div align="left"> Date </div></th>
		<th colspan="4"><div align="left"> :  '.odbc_result($process,"DebitnoteDate").'</div></th>
		</tr>
		<tr>
		<th ><div align="left"> Debit Note No </div></th>
		<th colspan="4"><div align="left"> :  '.odbc_result($process,"DebitNoteNumber").'</div></th>
		</tr>
		<tr>
		<th><div align="left"> Project Number </div></th>
		<th colspan="4"><div align="left"> :  '.odbc_result($process,"ProjectNumber").'</div></th>
		</tr>
		</table>
		
		<table width="100%" >
		<tr>
		<th colspan=5 ><div align=center> &nbsp;</div></th>
		</tr>
		</table>
		
		<table width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <b>Billing Details </b></div></th>
		</tr>
		</table>
		<table width="100%" border="1" >
		<tr>
		<th width="25%"><div align="left"><span style="color:#663300"> Name</span></div></th>
		<th colspan=5 align="left" width="75%"> '.odbc_result($process,"NAME").'</th>
		</tr>
		<tr>
		<th width="25%"><div align="left"><span style="color:#663300"> Address</span></div></th>
		<th colspan=5 align="left" width="75%"> '.odbc_result($process,"ADDRESS").'</th>
		</tr>
		';
		if($_SESSION['invoice_type']=="Un-Registered")
			{ 
		$html = $html.'
		<tr>
		<th><div align="left"><span style="color:#663300"> State</span></div></th>
		<th align="left"> '.odbc_result($process,"STATE").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Contact Person</span></div></th>
		<th colspan=2 align="left"> '.odbc_result($process,"CONTACTPERSON").'</th>
		</tr>';
		}
		elseif($_SESSION['invoice_type']=="Export")
		{ 
		$html = $html.'<tr>
		<th><div align="left"><span style="color:#663300"> Country</span></div></th>
		<th align="left"> '.odbc_result($process,"COUNTRY").'</th>
		<th><div align="left"><span style="color:#663300"> Contact Person</span></div></th>
		<th colspan=5 align="left"> '.odbc_result($process,"CONTACTPERSON").'</th>
		</tr>';
		}
		else
		{ 
		$html = $html.'
		<tr>
		<th><div align="left"><span style="color:#663300"> State</span></div></th>
		<th align="left"> '.odbc_result($process,"STATE").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> State Code</span></div></th>
		<th colspan=5 align="left"> '.odbc_result($process,"STATECODE").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> GSTIN</span></div></th>
		<th align="left"> '.odbc_result($process,"GSTIN").'</th>
		</tr>';
		}
		$html = $html.'
		</table>
		
		<table width="100%" >
		<tr>
		<th colspan=5 ><div align=center> &nbsp;</div></th>
		</tr>
		</table>
		<table width="100%" border="1">
		<tr>
		<th colspan="2" width="25%"><div align="left"> Description of Services</div></th>
		<th colspan="3" width="75%"><div align="left"> '.odbc_result($process,"Description").'</div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"> SAC</div></th>
		<th colspan="3"><div align="left"> '.odbc_result($process,"SACNumber").'</div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"> Amount</div></th>
		<th colspan="3"><div align="left"> '.IND_money_format(odbc_result($process,"DebitNoteAmount")).'</div></th>
		</tr>
		</table>
		<br><br>
		<table width="100%">';
		$total_value=odbc_result($process,"DebitNoteAmount");
		$total_value_words=convert_number_to_words($total_value);
		
		if(is_null(odbc_result($process,"Currency_Type")))
		{ 
		$html = $html.'
		</table>
		<table width="100%" border="1">
		<tr>
		<th colspan="3"><div align="left"> <b>NET AMOUNT DEBITED ON YOUR ACCOUNT </b></div></th>
		<th colspan="2"><div align="center"><img src="images/sym.jpg" height="7" width="7" /><b>  '.IND_money_format(round($total_value)).'</b></div></th>
		</tr>
		</table>
		<br><br>
		<table width="100%">
		<tr>
		<th colspan="2"><div align="left"> Total Invoice Value (In words)</div></th>
		<th colspan="3"><div align="left"><b>'.strtoupper($total_value_words).' ONLY</b></div></th>
		</tr>';
		 } 
		else { 
		$html = $html.'
		<tr>
		<th colspan="3"><div align="left"> <b>NET AMOUNT DEBITED ON YOUR ACCOUNT </b></div></th>
		<th colspan="2"><div align="left"><b>'.odbc_result($process,"Currency_Type")." ".IND_money_format(round($total_value)).'</b></div></th>
		</tr><br>
		<tr>
		<th colspan="2"><div align="left"> Total Invoice Value (In words)</div></th>
		<th colspan="3"><div align="left"><b>'.odbc_result($process,"Currency_Type")." ".strtoupper($total_value_words).' ONLY</b></div></th>
		</tr>';
		 }
		$html = $html.'<br><br>
		<tr>
		<th colspan="1"><div align="left"> Narration :</div></th>
		<th colspan="4"><div align="left"><b>'.odbc_result($process,"narration").'</b></div></th>
		</tr><br><br>
		<tr>
		<th colspan="1">&nbsp;</th>
		<th colspan="4"><div align="right"><b>For IITM</b></div></th>
		</tr><br><br>
		<tr>
		<th colspan="1"><div align="left"> Prepared By :</div></th>
		<th colspan="4"><div align="right">Authorised Signatory</div></th>
		</tr>
		</table>		
		<br><br>		
	';
		$pdf->writeHTML($html, true, false, true, false, '');
		
						
		// reset pointer to the last page
		$pdf->lastPage();
		
		// ---------------------------------------------------------
		$fname=$DebitNoteNumber.".pdf";
		ob_end_clean();
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output($fname, 'D');
	}
}
?>
