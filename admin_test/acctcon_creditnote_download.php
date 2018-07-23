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
	$CreditNoteNumber=$_SESSION["CreditNoteNumber"];
	
	$strsql="";
	if($_SESSION['invoice_type']=="Un-Registered")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_VENDOR b, GST_Credit_Note_Details c where a.BillToID=b.bill_id and c.CreditNoteNumber='$CreditNoteNumber' and a.InvoiceNumber=c.InvoiceNumber";
	elseif($_SESSION['invoice_type']=="Export")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_EXPORT b, GST_Credit_Note_Details c where a.BillToID=b.bill_id and c.CreditNoteNumber='$CreditNoteNumber' and a.InvoiceNumber=c.InvoiceNumber";
	else
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b, GST_Credit_Note_Details c where a.BillToID=b.bill_id and c.CreditNoteNumber='$CreditNoteNumber' and a.InvoiceNumber=c.InvoiceNumber";
	
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
		
		$total_value=odbc_result($process,"CN_TotalValue");
		$total_value_words=convert_number_to_words($total_value);


		$html = '
		<table><tr><td><img src="images/logo_iitm.jpg"></td></tr></table>
		';
		$pdf->writeHTML($html, true, false, true, false, '');
		
		// create some HTML content
		$html = '
		<table style="background-color:#62AC80" width="100%" >
		<tr>
		<th colspan=5 ><div align="center"> <strong>CREDIT NOTE</strong> </div></th>
		</tr>
		</table>
		<br><br>
		<table width="100%" border="1" >
		<tr>
		<th><div align="left"><span style="color:#663300"> Credit Note No. </span></div></th>
		<th colspan=2 align="left">'.odbc_result($process,"creditnoteNumber").'</th>
		<th><div align="left"><span style="color:#663300"> Credit Note Date</span></div></th>
		<th colspan=2 align="left">'.odbc_result($process,"creditnoteDate").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Original Invoice No</span></div></th>
		<th align="left"> '.odbc_result($process,"InvoiceNumber").'</th>
		<th><div align="left"><span style="color:#663300"> Original Invoice Date</span></div></th>
		<th colspan=2 align="left"> '.date('d-M-Y', strtotime(odbc_result($process,"InvoiceDate"))).'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Project Number</span></div></th>
		<th colspan="4"><div align="left"> '.odbc_result($process,"ProjectNumber").'</div></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Department Name</span></div></th>
		<th colspan=2 align="left"> '.odbc_result($process,"DeptName").'</th>
		<th><div align="left"><span style="color:#663300"> PI Name</span></div></th>
		<th align="left"> '.odbc_result($process,"PIName").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> SAC Number</span></div></th>
		<th colspan=2 align="left"> '.odbc_result($process,"SACNumber").'</th>
		<th><div align="left"><span style="color:#663300"> IITM - GSTIN</span></div></th>
		<th align="left"> '.odbc_result($process,"InstGSTINNo").'</th>
		</tr>
		</table>
		
		<table width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <b>Registered Address </b></div></th>
		</tr>
		</table>
		<hr>
		<table width="100%" border="1" >
		<tr>
		<th width="20%"><div align="left"><span style="color:#663300"> Name</span></div></th>
		<th align="left" width="30%"> '.odbc_result($process,"NAME").'</th>
		<th width="20%"><div align="left"><span style="color:#663300"> Address</span></div></th>
		<th colspan=2 align="left" width="30%"> '.odbc_result($process,"ADDRESS").'</th>
		</tr>
		';
		if($_SESSION['invoice_type']=="Un-Registered")
			{ 
		$html = $html.'<tr>
		<th><div align="left"><span style="color:#663300"> District</span></div></th>
			<th align="left"> '.odbc_result($process,"DISTRICT").'</th>
		<th><div align="left"><span style="color:#663300"> Pin Code</span></div></th>
		<th colspan=2 align="left"> '.odbc_result($process,"PINCODE").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> State</span></div></th>
		<th align="left"> '.odbc_result($process,"STATE").'</th>
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
		<th colspan=2 align="left"> '.odbc_result($process,"CONTACTPERSON").'</th>
		</tr>';
		}
		else
		{ 
		$html = $html.'<tr>
		<th><div align="left"><span style="color:#663300"> District</span></div></th>
			<th align="left"> '.odbc_result($process,"DISTRICT").'</th>
		<th><div align="left"><span  style="color:#663300"> Pin Code</span></div></th>
		<th colspan=2 align="left"> '.odbc_result($process,"PINCODE").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> State</span></div></th>
		<th align="left"> '.odbc_result($process,"STATE").'</th>
		<th><div align="left"><span style="color:#663300"> State Code</span></div></th>
		<th colspan=2 align="left"> '.odbc_result($process,"STATECODE").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> GSTIN</span></div></th>
		<th align="left"> '.odbc_result($process,"GSTIN").'</th>
		<th><div align="left"><span style="color:#663300"> PAN No</span></div></th>
		<th colspan=2 align="left"> '.odbc_result($process,"PANNO").'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> TAN No</span></div></th>
		<th align="left"> '.odbc_result($process,"TANNO").'</th>
		<th><div align="left"><span style="color:#663300"> Contact Person</span></div></th>
		<th colspan=2 align="left"> '.odbc_result($process,"CONTACTPERSON").'</th>
		</tr>';
		}
		$html = $html.'
		<tr>
		<th><div align="left"><span style="color:#663300"> Email</span></div></th>
		<th align="left">'.odbc_result($process,"EMAIL").'</th>
		<th><div align="left"><span style="color:#663300"> Contact No</span></div></th>
		<th colspan=2 align="left"> '.odbc_result($process,"CONTACTNO").'</th>
		</tr>
		</table>
		';
		if(trim(odbc_result($process,"Communication_Address"))!="")
			{ 
		$html = $html.'		
		<table width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <b>Communication Address </b></div></th>
		</tr>
		</table>
		<hr>
		<table width="100%" border="1" >
		<tr>
		<th colspan=5 align="left"> '.substr(odbc_result($process,"Communication_Address"),0,150).'</th>
		</tr>
		</table>';
		}
		$html = $html.'		
		<table width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <span style="color:#663300">&nbsp;</span></div></th>
		</tr>
		</table>
		<hr>
		<table width="100%" border="1">
		<tr>
		<th colspan="2" width="25%"><div align="left"><span style="color:#663300"> Description of Services</span></div></th>
		<th colspan="3" width="75%"><div align="left"> '.substr(odbc_result($process,"Description"),0,250).'</div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"> Credit Note Amount</div></th>
		<th colspan="3"><div align="left"> '.odbc_result($process,"CreditNoteAmount").'</div></th>
		</tr>
		';
		if(odbc_result($process,"CN_CGSTAmount")>0)
		{ 
		$html = $html.'	
		<tr><th colspan="2"><div align="left"><span style="color:#663300"> CGST (9%)</span></div></th>
		<th colspan="3"><div align="left"> '.odbc_result($process,"CN_CGSTAmount").'</div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> SGST (9%)</span></div></th>
		<th colspan="3"><div align="left"> '.odbc_result($process,"CN_SGSTAmount").'</div></th>
		</tr>
		';
		}
		if(odbc_result($process,"CN_IGSTAmount")>0)
		{ 
		$html = $html.'	
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> IGST (18%)</span></div></th>
		<th colspan="3"><div align="left"> '.odbc_result($process,"CN_IGSTAmount").'</div></th>
		</tr>';
		} 
		$html = $html.'	
		</table>
		<table width="100%" >
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> Total Credit Value (In figures)</span></div></th>
		<th colspan="3"><div align="left"><img src="images/sym.jpg" height="7" width="7" /><b>  '.round($total_value).'</b></div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> Total Credit Value (In words)</span></div></th>
		<th colspan="3"><div align="left"><b>'.ucwords($total_value_words).'Rupees Only</b></div></th>
		</tr><br><br>
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> Reason for Issuing document</span></div></th>
		<th colspan="3"><div align="left"><b>'.odbc_result($process,"Reason_Document").'</b></div></th>
		</tr>
		</table><br><br>
		<table width="100%" border="1">
		<tr>
		<th colspan="1"><div align="left"><span style="color:#663300"> Narration</span></div></th>
		<th colspan="4"><div align="left">'.odbc_result($process,"narration").'</div></th>
		</tr>
		</table>	<br><br>
		<table width="100%" >
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
		$fname=$CreditNoteNumber.".pdf";
		ob_end_clean();
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output($fname, 'D');
	}
}
?>
