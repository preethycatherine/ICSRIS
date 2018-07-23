<?php
session_start(); 
require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

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
$objPHPExcel->getActiveSheet()->getStyle('1:3')->getFont()->setBold(true);



$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(90);


$objPHPExcel->getActiveSheet()->setCellValue('B1', 'No. of Receipient');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'No. of Invoices');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Total Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Total Taxable Value');

$strsql_inv_tot="Select count(*) as total_inv, count(distinct BillToID) as total_recp, sum(TaxableValue) as tot_tax_val, sum(TotalInvoiceValue) as tot_inv_val from GST_Invoice_Details where InvoiceType='Registered' and CONVERT(VARCHAR(25), InvoiceDate, 126) LIKE '".$_SESSION['month']."%'";
$process_inv_tot=odbc_exec($sqlconnect,$strsql_inv_tot) or die("<br>Connection Failed");

$objPHPExcel->getActiveSheet()->setCellValue('B2', odbc_result($process_inv_tot,"total_recp"));
$objPHPExcel->getActiveSheet()->setCellValue('C2', odbc_result($process_inv_tot,"total_inv"));
$objPHPExcel->getActiveSheet()->setCellValue('E2', odbc_result($process_inv_tot,"tot_inv_val"));
$objPHPExcel->getActiveSheet()->setCellValue('J2', odbc_result($process_inv_tot,"tot_tax_val"));

$objPHPExcel->getActiveSheet()->setCellValue('A3', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'GSTIN of Receipient');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Invoice Date');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('F3', 'Place of Supply');
$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Reverse Charge');
$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Invoice Type');
$objPHPExcel->getActiveSheet()->setCellValue('I3', 'Rate');
$objPHPExcel->getActiveSheet()->setCellValue('J3', 'Taxable Value');

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_inv="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b where a.BillToID=b.bill_id and a.InvoiceType='Registered' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
$c=4;$sno=1;
while(odbc_fetch_row($process_inv))
{
	$inv_date=odbc_result($process_inv,"InvoiceDate");
	$inv_date=date("d-m-Y", strtotime($inv_date));
	$inv_no=odbc_result($process_inv,"InvoiceNumber");
	$ProjectNumber=odbc_result($process_inv,"ProjectNumber");
	$PIName=odbc_result($process_inv,"PIName");
	$TaxableValue=odbc_result($process_inv,"TaxableValue");
	$TotalInvoiceValue=odbc_result($process_inv,"TotalInvoiceValue");

	$myArr=array($sno,odbc_result($process_inv,"GSTIN"),$inv_no,$inv_date,$TotalInvoiceValue,odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"),"N","Regular","18.00",odbc_result($process_inv,"TaxableValue"));

	$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, odbc_result($process_inv,"GSTIN"));
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $inv_no);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $inv_date);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $TotalInvoiceValue);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"));
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, 'N');
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, 'Regular');
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$c, '18.00');
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$c, odbc_result($process_inv,"TaxableValue"));

	$sno++; $c++;
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Registered Invoices');


/************** SHEET 2 **************/

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->getStyle('1:3')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(90);

$objPHPExcel->getActiveSheet()->setCellValue('B1', 'No. of Invoices');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Total Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Total Taxable Value');

$strsql_inv_tot="Select count(*) as total_inv, count(distinct BillToID) as total_recp, sum(TaxableValue) as tot_tax_val, sum(TotalInvoiceValue) as tot_inv_val from GST_Invoice_Details where InvoiceType='Un-Registered' and CONVERT(VARCHAR(25), InvoiceDate, 126) LIKE '".$_SESSION['month']."%'";
$process_inv_tot=odbc_exec($sqlconnect,$strsql_inv_tot) or die("<br>Connection Failed");

$objPHPExcel->getActiveSheet()->setCellValue('B2', odbc_result($process_inv_tot,"total_inv"));
$objPHPExcel->getActiveSheet()->setCellValue('D2', odbc_result($process_inv_tot,"tot_inv_val"));
$objPHPExcel->getActiveSheet()->setCellValue('I2', odbc_result($process_inv_tot,"tot_tax_val"));

$objPHPExcel->getActiveSheet()->setCellValue('A3', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Invoice Date');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Place of Supply');
$objPHPExcel->getActiveSheet()->setCellValue('F3', 'Reverse Charge');
$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Invoice Type');
$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Rate');
$objPHPExcel->getActiveSheet()->setCellValue('I3', 'Taxable Value');

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_inv="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_VENDOR b where a.BillToID=b.bill_id and a.InvoiceType='Un-Registered' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
$c=4;$sno=1;
while(odbc_fetch_row($process_inv))
{
	$inv_date=odbc_result($process_inv,"InvoiceDate");
	$inv_date=date("d-m-Y", strtotime($inv_date));
	$inv_no=odbc_result($process_inv,"InvoiceNumber");
	$ProjectNumber=odbc_result($process_inv,"ProjectNumber");
	$PIName=odbc_result($process_inv,"PIName");
	$TaxableValue=odbc_result($process_inv,"TaxableValue");
	$TotalInvoiceValue=odbc_result($process_inv,"TotalInvoiceValue");

	$myArr=array($sno,odbc_result($process_inv,"GSTIN"),$inv_no,$inv_date,$TotalInvoiceValue,odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"),"N","Regular","18.00",odbc_result($process_inv,"TaxableValue"));

	$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $inv_no);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $inv_date);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $TotalInvoiceValue);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"));
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, 'N');
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, 'Regular');
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, '18.00');
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$c, odbc_result($process_inv,"TaxableValue"));

	$sno++; $c++;
}


// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Un-Registered Invoices');


/************** SHEET 3 **************/


odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->getStyle('1:3')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(90);


$objPHPExcel->getActiveSheet()->setCellValue('B1', 'No. of Invoices');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Total Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Total Taxable Value');

$strsql_inv_tot="Select count(*) as total_inv, count(distinct BillToID) as total_recp, sum(TaxableValue) as tot_tax_val, sum(TotalInvoiceValue) as tot_inv_val from GST_Invoice_Details where InvoiceType='Export' and CONVERT(VARCHAR(25), InvoiceDate, 126) LIKE '".$_SESSION['month']."%'";
$process_inv_tot=odbc_exec($sqlconnect,$strsql_inv_tot) or die("<br>Connection Failed");

$objPHPExcel->getActiveSheet()->setCellValue('B2', odbc_result($process_inv_tot,"total_inv"));
$objPHPExcel->getActiveSheet()->setCellValue('D2', odbc_result($process_inv_tot,"tot_inv_val"));
$objPHPExcel->getActiveSheet()->setCellValue('I2', odbc_result($process_inv_tot,"tot_tax_val"));

$objPHPExcel->getActiveSheet()->setCellValue('A3', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Invoice Date');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Place of Supply');
$objPHPExcel->getActiveSheet()->setCellValue('F3', 'Reverse Charge');
$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Invoice Type');
$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Rate');
$objPHPExcel->getActiveSheet()->setCellValue('I3', 'Taxable Value');

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_inv="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_export b where a.BillToID=b.bill_id and a.InvoiceType='Export' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
$c=4;$sno=1;
while(odbc_fetch_row($process_inv))
{
	$inv_date=odbc_result($process_inv,"InvoiceDate");
	$inv_date=date("d-m-Y", strtotime($inv_date));
	$inv_no=odbc_result($process_inv,"InvoiceNumber");
	$ProjectNumber=odbc_result($process_inv,"ProjectNumber");
	$PIName=odbc_result($process_inv,"PIName");
	$TaxableValue=odbc_result($process_inv,"TaxableValue");
	$TotalInvoiceValue=odbc_result($process_inv,"TotalInvoiceValue");

	$myArr=array($sno,odbc_result($process_inv,"GSTIN"),$inv_no,$inv_date,$TotalInvoiceValue,odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"),"N","Regular","18.00",odbc_result($process_inv,"TaxableValue"));

	$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $inv_no);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $inv_date);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $TotalInvoiceValue);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"));
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, 'N');
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, 'Regular');
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, '18.00');
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$c, odbc_result($process_inv,"TaxableValue"));

	$sno++; $c++;
}

// Rename 3RD sheet
$objPHPExcel->getActiveSheet()->setTitle('Export Invoices');


/************** SHEET 4 **************/

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->getStyle('1:3')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(90);


$objPHPExcel->getActiveSheet()->setCellValue('B1', 'No. of Receipient');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'No. of Invoices');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Total Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Total Taxable Value');

$strsql_inv_tot="Select count(*) as total_inv, count(distinct BillToID) as total_recp, sum(TaxableValue) as tot_tax_val, sum(TotalInvoiceValue) as tot_inv_val from GST_Invoice_Details where InvoiceType='Exempted' and CONVERT(VARCHAR(25), InvoiceDate, 126) LIKE '".$_SESSION['month']."%'";
$process_inv_tot=odbc_exec($sqlconnect,$strsql_inv_tot) or die("<br>Connection Failed");

$objPHPExcel->getActiveSheet()->setCellValue('B2', odbc_result($process_inv_tot,"total_recp"));
$objPHPExcel->getActiveSheet()->setCellValue('C2', odbc_result($process_inv_tot,"total_inv"));
$objPHPExcel->getActiveSheet()->setCellValue('E2', odbc_result($process_inv_tot,"tot_inv_val"));
$objPHPExcel->getActiveSheet()->setCellValue('J2', odbc_result($process_inv_tot,"tot_tax_val"));

$objPHPExcel->getActiveSheet()->setCellValue('A3', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'GSTIN of Receipient');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Invoice Date');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('F3', 'Place of Supply');
$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Reverse Charge');
$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Invoice Type');
$objPHPExcel->getActiveSheet()->setCellValue('I3', 'Rate');
$objPHPExcel->getActiveSheet()->setCellValue('J3', 'Taxable Value');

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_inv="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b where a.BillToID=b.bill_id and a.InvoiceType='Exempted' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
$c=4;$sno=1;
while(odbc_fetch_row($process_inv))
{
	$inv_date=odbc_result($process_inv,"InvoiceDate");
	$inv_date=date("d-m-Y", strtotime($inv_date));
	$inv_no=odbc_result($process_inv,"InvoiceNumber");
	$ProjectNumber=odbc_result($process_inv,"ProjectNumber");
	$PIName=odbc_result($process_inv,"PIName");
	$TaxableValue=odbc_result($process_inv,"TaxableValue");
	$TotalInvoiceValue=odbc_result($process_inv,"TotalInvoiceValue");

	$myArr=array($sno,odbc_result($process_inv,"GSTIN"),$inv_no,$inv_date,$TotalInvoiceValue,odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"),"N","Regular","18.00",odbc_result($process_inv,"TaxableValue"));

	$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, odbc_result($process_inv,"GSTIN"));
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $inv_no);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $inv_date);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $TotalInvoiceValue);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"));
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, 'N');
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, 'Regular');
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$c, '18.00');
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$c, odbc_result($process_inv,"TaxableValue"));

	$sno++; $c++;
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Exempted Invoices');

$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="gst_reports_all.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>