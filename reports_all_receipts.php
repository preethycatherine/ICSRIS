<?php
session_start(); 
require_once '../admin/PHPExcel/Classes/PHPExcel.php';
require_once '../admin/PHPExcel/Classes/PHPExcel/IOFactory.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$styleArray = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
  );
//$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);

/************** SHEET 1 **************/


// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17);  
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);  
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(17); 
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Receipt Number');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Project Number');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Amount Received');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'TDS Receivable');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'TDS Percentage (%) ');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Mode of Payment ');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Reference Number');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Instruments Date');

$invoice_number=$_SESSION["invoice_number"];
$sno=1;
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_recpt="Select * from GST_Receipt_Details where invoicenumber='$invoice_number'";
$process_recpt=odbc_exec($sqlconnect,$strsql_recpt) or die("<br>Connection Failed");
$c=2;$sno=1;
while(odbc_fetch_row($process_recpt))
{
	$recpt_no=odbc_result($process_recpt,"ReceiptNumber");
	$InvoiceNumber=odbc_result($process_recpt,"InvoiceNumber");
	$ProjectNumber=odbc_result($process_recpt,"ProjectNumber");
	$Amount=odbc_result($process_recpt,"RemittedAmount");
	$ReceiptDate=odbc_result($process_recpt,"ReceiptDate");
	$ReferenceNumber=odbc_result($process_recpt,"ReferenceNumber");
	$PaymentMode=odbc_result($process_recpt,"PaymentMode");


	$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $recpt_no);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $InvoiceNumber);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $ProjectNumber);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $Amount);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, odbc_result($process_recpt,"TDSAmount"));
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, odbc_result($process_recpt,"TDSPercentage"));
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, odbc_result($process_recpt,"PaymentMode"));
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$c, odbc_result($process_recpt,"ReferenceNumber"));
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$c, odbc_result($process_recpt,"ReceiptDate"));
	$sno++; $c++;
}
$objPHPExcel->getActiveSheet()->getStyle('A1:J'.($c-1))->applyFromArray($styleArray);

odbc_close($sqlconnect);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Receipts');

$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Receipts_All.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>