<?php
session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_COOKIE["PHPSESSID"]))
{
	session_destroy();
	setcookie("PHPSESSID","",time()-3600,"/");
	header('location: https://icsris.iitm.ac.in/ICSRIS/admin/index.php');
	exit;

}
else
{
	session_start();
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
	session_register("logname");
	
	$invoice_number=$_SESSION["invoice_number"];
	
	$strsql="";
	if($_SESSION['invoice_type']=="Un-Registered")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_VENDOR b where a.BillToID=b.bill_id and a.InvoiceNumber='$invoice_number'";
	elseif($_SESSION['invoice_type']=="Export")
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_EXPORT b where a.BillToID=b.bill_id and a.InvoiceNumber='$invoice_number'";
	else
		$strsql="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b where a.BillToID=b.bill_id and a.InvoiceNumber='$invoice_number'";
		
	$process=odbc_exec($sqlconnect,$strsql);
	
	if (odbc_fetch_row($process))
	{
		$msg="";
		include("currency_words.php");
		$total_value=odbc_result($process,"TotalInvoiceValue");
		$total_value_words=convert_number_to_words($total_value);

		$TaxableValue=odbc_result($process,"TaxableValue");
		if(odbc_result($process,"CGSTAmount")==0) echo $CGSTAmount="N/A"; else $CGSTAmount=IND_money_format(odbc_result($process,"CGSTAmount"));
		if(odbc_result($process,"SGSTAmount")==0) echo $SGSTAmount="N/A"; else $SGSTAmount=IND_money_format(odbc_result($process,"SGSTAmount"));
		if(odbc_result($process,"IGSTAmount")==0) echo $IGSTAmount="N/A"; else $IGSTAmount=IND_money_format(odbc_result($process,"IGSTAmount"));
		$TotalInvoiceValue=odbc_result($process,"TotalInvoiceValue");
		
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
		<th colspan=5 ><div align="center"> <span style="color:#663300"><strong>TAX INVOICE</strong> </span></div></th>
		</tr>
		<hr>
		</table><br>
		<table width="100%" >
		<tr>
		<th colspan=5 ><div align=center> <b>Invoice Details </b></div></th>
		</tr>
		</table>
		<hr>
		<table width="100%" border="1" >
		<tr>
		<th><div align="left"><span style="color:#663300"> Invoice No</span></div></th>
		<th align="left"> '.odbc_result($process,"InvoiceNumber").'</th>
		<th><div align="left"><span style="color:#663300"> Invoice Date</span></div></th>
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
		<th colspan=5 ><div align=center> <b>Billed To Address </b></div></th>
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
		';
		}
		elseif($_SESSION['invoice_type']=="Export")
		{ 
		$html = $html.'<tr>
		<th><div align="left"><span style="color:#663300"> Country</span></div></th>
		<th align="left"> '.odbc_result($process,"COUNTRY").'</th>
		';
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
		';
		}
		$con_person="";
		if(trim(odbc_result($process,"Communication_CONTACTPERSON"))!="") $con_person=odbc_result($process,"Communication_CONTACTPERSON"); else $con_person=odbc_result($process,"CONTACTPERSON");
		$con_email="";
		if(trim(odbc_result($process,"Communication_EMAIL"))!="") $con_email=odbc_result($process,"Communication_EMAIL"); else $con_email=odbc_result($process,"EMAIL");
		$con_contact="";
		if(trim(odbc_result($process,"Communication_CONTACTNO"))!="") $con_contact=odbc_result($process,"Communication_CONTACTNO"); else $con_contact=odbc_result($process,"CONTACTNO");
		
		$html = $html.'
		<th><div align="left"><span style="color:#663300"> Contact Person</span></div></th>
		<th colspan=2 align="left"> '.$con_person.'</th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Email</span></div></th>
		<th align="left">'.$con_email.'</th>
		<th><div align="left"><span style="color:#663300"> Contact No</span></div></th>
		<th colspan=2 align="left"> '.$con_contact.'</th>
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
		<th colspan=5 ><div align=center> <span style="color:#663300"> &nbsp;</span></div></th>
		</tr>
		</table>
		<hr>
		<table width="100%" border="1">
		<tr>
		<th colspan="2" width="25%"><div align="left"><span style="color:#663300"> Description of Services</span></div></th>
		<th colspan="3" width="75%"><div align="left"> '.substr(odbc_result($process,"Description"),0,250).'</div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> Taxable Value</span></div></th>
		<th colspan="3"><div align="left"> '.IND_money_format(round($TaxableValue)).'</div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> CGST ('.odbc_result($process,"CGSTRate").'%)</span></div></th>
		<th colspan="3"><div align="left"> '.$CGSTAmount.'</div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> SGST ('.odbc_result($process,"CGSTRate").'%)</span></div></th>
		<th colspan="3"><div align="left"> '.$SGSTAmount.'</div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> IGST ('.odbc_result($process,"IGSTRate").'%)</span></div></th>
		<th colspan="3"><div align="left"> '.$IGSTAmount.'</div></th>
		</tr>
		</table>
		<table width="100%">';
		if(is_null(odbc_result($process,"Currency_Type")))
		{ 
		$html = $html.'
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> Total Invoice Value (In figures)</span></div></th>
		<th colspan="3"><div align="left"><img src="images/sym.jpg" height="7" width="7" /><b>  '.IND_money_format(round($TotalInvoiceValue)).'</b></div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> Total Invoice Value (In words)</span></div></th>
		<th colspan="3"><div align="left"><b>'.ucwords($total_value_words).'Rupees Only</b></div></th>
		</tr>';
		 } 
		else { 
		$html = $html.'
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> Total Invoice Value (In figures)</span></div></th>
		<th colspan="3"><div align="left"><b>'.odbc_result($process,"Currency_Type")." ".IND_money_format(round($TotalInvoiceValue)).'</b></div></th>
		</tr>
		<tr>
		<th colspan="2"><div align="left"><span style="color:#663300"> Total Invoice Value (In words)</span></div></th>
		<th colspan="3"><div align="left"><b>'.odbc_result($process,"Currency_Type")." ".ucwords($total_value_words).' Only</b></div></th>
		</tr>';
		 }
		$html = $html.'
		</table>
		
		<br><br>	
		<table width="50%" >
		<tr>
		<th colspan=5 ><div align=center> <b>Bank Account Details </b></div></th>
		</tr>
		</table>
		
		<table width="90%" border="1" >
		<tr>
		<th><div align="left"><span style="color:#663300"> A/C Name</span></div></th>
		<th width="30%"><div align="left"> The Registrar, IIT Madras</div></th>
		<th><div align="left"><span style="color:#663300"> A/C No</span></div></th>
		<th><div align="left"> 2722101016162</div></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> Bank Name</span></div></th>
		<th><div align="left"> CANARA BANK</div></th>
		<th><div align="left"><span style="color:#663300"> Branch Name</span></div></th>
		<th><div align="left"> IIT-Madras Branch</div></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> IFSC</span></div></th>
		<th><div align="left"> CNRB0002722</div></th>
		<th><div align="left"><span style="color:#663300"> MICR Code</span></div></th>
		<th><div align="left"> 600015085</div></th>
		</tr>
		<tr>
		<th><div align="left"><span style="color:#663300"> SWIFT Code</span></div></th>
		<th colspan="4"><div align="left"> CNRBINBBIIT	</div></th>
		</tr>
		</table>	
		
		<table width="100%" >
		<tr>
		<th colspan="5">
			<div align="left">
			<font size="10">
				* Terms and Conditions :<br>
					1. Cheque to be drawn in favour of "The Registrar, IIT Madras", in case of NEFT,RTGS provide details<br>
					2. The taxes shown are not on reverse charge basis<br>';
		if($_SESSION['invoice_type']=="Export")
		{ 
		$html = $html.'
					3. As per Section 16 of the IGST Act 2017, a Letter of Undertaking without Payment of Integrated Tax is Required for Supply Meant for Export of Goods / Services<br>';
		}
		elseif($_SESSION['invoice_type']=="Exempted")
		{ 
		$html = $html.'
					3. As per Section 16 of the IGST Act 2017, a Letter of Undertaking without Payment of Integrated Tax is Required for Supply Meant for Export of Goods / Services & Supplies to SEZ unit<br>';
		}
		else
		{ 
		$html = $html.'3. Not to be used for foreign clients<br>';
		}
		$html = $html.'	</font>
			</div>
		</th>
		</tr>
		<tr><th colspan="3"><div align="left"><span style="color:#663300">Signature :</span></div></th></tr>
		<tr><th colspan="3"><div align="left"><span style="color:#663300">Name of the Signatory:</span></div></th></tr>
		<tr><th colspan="3"><div align="left"><span style="color:#663300">Designation :</span></div></th></tr>
		</table>	
	';
		$pdf->writeHTML($html, true, false, true, false, '');
		
						
		// reset pointer to the last page
		$pdf->lastPage();
		
		// ---------------------------------------------------------
		$fname=$invoice_number.".pdf";
		ob_end_clean();
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output($fname, 'D');
	}
}
?>
