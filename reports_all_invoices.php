<?php
session_start(); 
require_once '../admin/PHPExcel/Classes/PHPExcel.php';
require_once '../admin/PHPExcel/Classes/PHPExcel/IOFactory.php';

$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$styleArray = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
  );
$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);

/************** SHEET 1 **************/


// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17);  
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);  
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);  
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);  
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);  
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);  
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(37);  
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(37);  
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(17);  
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12);  
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(17);  
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(7);  
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(17);  
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(17);  
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(17);  
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25);  
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(17);  
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(17);  
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Invoice Date');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Project Number');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'PI Name');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'DeptName');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Description of Services');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Taxable Value');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'CGST (9%)');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'SGST (9%)');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'IGST (18%)');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Total Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'SACNumber');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'Biller Name');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'Address');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'District');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Pin Code');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'State');
$objPHPExcel->getActiveSheet()->setCellValue('S1', 'State Code');
$objPHPExcel->getActiveSheet()->setCellValue('T1', 'GSTIN');
$objPHPExcel->getActiveSheet()->setCellValue('U1', 'PAN No');
$objPHPExcel->getActiveSheet()->setCellValue('V1', 'TAN No');
$objPHPExcel->getActiveSheet()->setCellValue('W1', 'Contact Person');
$objPHPExcel->getActiveSheet()->setCellValue('X1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'Contact No');

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_inv="Select * from GST_Invoice_Details where ProjectNumber='".$_GET['projectnumber']."' order by DINP";
$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
$c=2;$sno=1;
while(odbc_fetch_row($process_inv))
{
	$inv_date=odbc_result($process_inv,"InvoiceDate");
	$inv_date=date("d-m-Y", strtotime($inv_date));
	$inv_no=odbc_result($process_inv,"InvoiceNumber");
	$ProjectNumber=odbc_result($process_inv,"ProjectNumber");
	$PIName=odbc_result($process_inv,"PIName");
	$TaxableValue=odbc_result($process_inv,"TaxableValue");
	$TotalInvoiceValue=odbc_result($process_inv,"TotalInvoiceValue");


	$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $inv_date);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $inv_no);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $ProjectNumber);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $PIName);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, odbc_result($process_inv,"DeptName"));
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, odbc_result($process_inv,"Description"));
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, odbc_result($process_inv,"TaxableValue"));
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$c, odbc_result($process_inv,"CGSTAmount"));
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$c, odbc_result($process_inv,"SGSTAmount"));
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$c, odbc_result($process_inv,"IGSTAmount"));
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$c, odbc_result($process_inv,"TotalInvoiceValue"));
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$c, odbc_result($process_inv,"SACNumber"));

	$inv_type="";
	$inv_type=odbc_result($process_inv,"InvoiceType");
	$BillToID=odbc_result($process_inv,"BillToID");
	
	$sqlconnect1=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	
	if($inv_type=="Registered" or $inv_type=="Exempted") $strsql_vendor="Select * from GST_BILL_TO_DETAILS where bill_id='$BillToID'";
	elseif($inv_type=="Un-Registered") $strsql_vendor="Select * from GST_BILL_TO_DETAILS_VENDOR where bill_id='$BillToID'";
	elseif($inv_type=="Export") $strsql_vendor="Select * from GST_BILL_TO_DETAILS_EXPORT where bill_id='$BillToID'";
	$process_vendor=odbc_exec($sqlconnect1,$strsql_vendor);
	if(odbc_fetch_row($process_vendor))
	{
		$objPHPExcel->getActiveSheet()->setCellValue('N'.$c, odbc_result($process_vendor,"NAME"));
		$objPHPExcel->getActiveSheet()->setCellValue('O'.$c, odbc_result($process_vendor,"ADDRESS"));
		$objPHPExcel->getActiveSheet()->setCellValue('P'.$c, odbc_result($process_vendor,"DISTRICT"));
		$objPHPExcel->getActiveSheet()->setCellValue('Q'.$c, odbc_result($process_vendor,"PINCODE"));
		$objPHPExcel->getActiveSheet()->setCellValue('R'.$c, odbc_result($process_vendor,"STATE"));
		if($inv_type=="Registered" or $inv_type=="Exempted")
		{
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$c, odbc_result($process_vendor,"STATECODE"));
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$c, odbc_result($process_vendor,"GSTIN"));
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$c, odbc_result($process_vendor,"PANNO"));
			$objPHPExcel->getActiveSheet()->setCellValue('V'.$c, odbc_result($process_vendor,"TANNO"));
		}
		$objPHPExcel->getActiveSheet()->setCellValue('W'.$c, odbc_result($process_vendor,"CONTACTPERSON"));
		$objPHPExcel->getActiveSheet()->setCellValue('X'.$c, odbc_result($process_vendor,"EMAIL"));
		$objPHPExcel->getActiveSheet()->setCellValue('Y'.$c, odbc_result($process_vendor,"CONTACTNO"));
	}
	odbc_close($sqlconnect1);
	
	$sno++; $c++;
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Invoices');

$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Invoices_All.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>