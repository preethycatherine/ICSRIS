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
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);  
 
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Project Number');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'PI Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Vendor Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Invoice Date');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Total Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Total Outstanding');


odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_inv="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b where a.BillToID=b.bill_id and a.InvoiceType='Registered' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
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

	$sqlconnect1=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$rec_tot=0;
	$strsql_rec_tot="Select * from GST_Receipt_Details where InvoiceNumber='$inv_no'";
	$process_rec_tot=odbc_exec($sqlconnect1,$strsql_rec_tot);
	while(odbc_fetch_row($process_rec_tot))
	{
		$rec_tot=$rec_tot+odbc_result($process_rec_tot,"RemittedAmount")+odbc_result($process_rec_tot,"TDSAmount");
	}
	odbc_close($sqlconnect1);
	//echo "rec--".$rec_tot."<br><br>";
	
	$sqlconnect2=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$credit_tot=0;
	$strsql_cr_tot="Select * from GST_Credit_Note_Details where InvoiceNumber='$inv_no'";
	$process_cr_tot=odbc_exec($sqlconnect2,$strsql_cr_tot);
	while(odbc_fetch_row($process_cr_tot))
	{
		$credit_tot=$credit_tot+odbc_result($process_cr_tot,"CN_TotalValue");
	}
	odbc_close($sqlconnect2);
	//echo "credit--".$credit_tot."<br><br>";

	$sqlconnect3=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$debit_tot=0;
	$strsql_de_tot="Select * from GST_Debit_Note_Details where InvoiceNumber='$inv_no'";
	$process_de_tot=odbc_exec($sqlconnect3,$strsql_de_tot);
	while(odbc_fetch_row($process_de_tot))
	{
		$debit_tot=$debit_tot+odbc_result($process_de_tot,"DebitNoteAmount");
	}
	odbc_close($sqlconnect3);
	//echo "debit--".$debit_tot."<br><br>";
	
	$outstand=$TotalInvoiceValue-$rec_tot-$credit_tot+$debit_tot;
	if($outstand!=0)
	{
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $ProjectNumber);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $PIName);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, odbc_result($process_inv,"NAME"));
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $inv_no);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $inv_date);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, odbc_result($process_inv,"TotalInvoiceValue"));
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, $outstand);
		$sno++; $c++;
	}
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
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);  
 
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Project Number');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'PI Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Vendor Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Invoice Date');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Total Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Total Outstanding');

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_inv="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_VENDOR b where a.BillToID=b.bill_id and a.InvoiceType='Un-Registered' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
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

	$sqlconnect1=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$rec_tot=0;
	$strsql_rec_tot="Select * from GST_Receipt_Details where InvoiceNumber='$inv_no'";
	$process_rec_tot=odbc_exec($sqlconnect1,$strsql_rec_tot);
	while(odbc_fetch_row($process_rec_tot))
	{
		$rec_tot=$rec_tot+odbc_result($process_rec_tot,"RemittedAmount")+odbc_result($process_rec_tot,"TDSAmount");
	}
	odbc_close($sqlconnect1);
	//echo "rec--".$rec_tot."<br><br>";
	
	$sqlconnect2=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$credit_tot=0;
	$strsql_cr_tot="Select * from GST_Credit_Note_Details where InvoiceNumber='$inv_no'";
	$process_cr_tot=odbc_exec($sqlconnect2,$strsql_cr_tot);
	while(odbc_fetch_row($process_cr_tot))
	{
		$credit_tot=$credit_tot+odbc_result($process_cr_tot,"CN_TotalValue");
	}
	odbc_close($sqlconnect2);
	//echo "credit--".$credit_tot."<br><br>";

	$sqlconnect3=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$debit_tot=0;
	$strsql_de_tot="Select * from GST_Debit_Note_Details where InvoiceNumber='$inv_no'";
	$process_de_tot=odbc_exec($sqlconnect3,$strsql_de_tot);
	while(odbc_fetch_row($process_de_tot))
	{
		$debit_tot=$debit_tot+odbc_result($process_de_tot,"DebitNoteAmount");
	}
	odbc_close($sqlconnect3);
	//echo "debit--".$debit_tot."<br><br>";
	
	$outstand=$TotalInvoiceValue-$rec_tot-$credit_tot+$debit_tot;
	if($outstand!=0)
	{
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $ProjectNumber);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $PIName);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, odbc_result($process_inv,"NAME"));
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $inv_no);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $inv_date);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, odbc_result($process_inv,"TotalInvoiceValue"));
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, $outstand);
		$sno++; $c++;
	}
	
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
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);  
 
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Project Number');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'PI Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Vendor Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Invoice Date');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Total Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Total Outstanding');

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_inv="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS_export b where a.BillToID=b.bill_id and a.InvoiceType='Export' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
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
$sqlconnect1=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$rec_tot=0;
	$strsql_rec_tot="Select * from GST_Receipt_Details where InvoiceNumber='$inv_no'";
	$process_rec_tot=odbc_exec($sqlconnect1,$strsql_rec_tot);
	while(odbc_fetch_row($process_rec_tot))
	{
		$rec_tot=$rec_tot+odbc_result($process_rec_tot,"RemittedAmount")+odbc_result($process_rec_tot,"TDSAmount");
	}
	odbc_close($sqlconnect1);
	//echo "rec--".$rec_tot."<br><br>";
	
	$sqlconnect2=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$credit_tot=0;
	$strsql_cr_tot="Select * from GST_Credit_Note_Details where InvoiceNumber='$inv_no'";
	$process_cr_tot=odbc_exec($sqlconnect2,$strsql_cr_tot);
	while(odbc_fetch_row($process_cr_tot))
	{
		$credit_tot=$credit_tot+odbc_result($process_cr_tot,"CN_TotalValue");
	}
	odbc_close($sqlconnect2);
	//echo "credit--".$credit_tot."<br><br>";

	$sqlconnect3=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$debit_tot=0;
	$strsql_de_tot="Select * from GST_Debit_Note_Details where InvoiceNumber='$inv_no'";
	$process_de_tot=odbc_exec($sqlconnect3,$strsql_de_tot);
	while(odbc_fetch_row($process_de_tot))
	{
		$debit_tot=$debit_tot+odbc_result($process_de_tot,"DebitNoteAmount");
	}
	odbc_close($sqlconnect3);
	//echo "debit--".$debit_tot."<br><br>";
	
	$outstand=$TotalInvoiceValue-$rec_tot-$credit_tot+$debit_tot;
	if($outstand!=0)
	{
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $ProjectNumber);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $PIName);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, odbc_result($process_inv,"NAME"));
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $inv_no);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $inv_date);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, odbc_result($process_inv,"TotalInvoiceValue"));
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, $outstand);
		$sno++; $c++;
	}
}

// Rename 3RD sheet
$objPHPExcel->getActiveSheet()->setTitle('Export Invoices');


/************** SHEET 4 **************/

odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);  
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);  
 
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Project Number');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'PI Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Vendor Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Invoice Date');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Total Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Total Outstanding');


odbc_close_all();
$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
$strsql_inv="Select * from GST_Invoice_Details a, GST_BILL_TO_DETAILS b where a.BillToID=b.bill_id and a.InvoiceType='Exempted' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
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

	$sqlconnect1=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$rec_tot=0;
	$strsql_rec_tot="Select * from GST_Receipt_Details where InvoiceNumber='$inv_no'";
	$process_rec_tot=odbc_exec($sqlconnect1,$strsql_rec_tot);
	while(odbc_fetch_row($process_rec_tot))
	{
		$rec_tot=$rec_tot+odbc_result($process_rec_tot,"RemittedAmount")+odbc_result($process_rec_tot,"TDSAmount");
	}
	odbc_close($sqlconnect1);
	//echo "rec--".$rec_tot."<br><br>";
	
	$sqlconnect2=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$credit_tot=0;
	$strsql_cr_tot="Select * from GST_Credit_Note_Details where InvoiceNumber='$inv_no'";
	$process_cr_tot=odbc_exec($sqlconnect2,$strsql_cr_tot);
	while(odbc_fetch_row($process_cr_tot))
	{
		$credit_tot=$credit_tot+odbc_result($process_cr_tot,"CN_TotalValue");
	}
	odbc_close($sqlconnect2);
	//echo "credit--".$credit_tot."<br><br>";

	$sqlconnect3=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC Connection Failed");
	$debit_tot=0;
	$strsql_de_tot="Select * from GST_Debit_Note_Details where InvoiceNumber='$inv_no'";
	$process_de_tot=odbc_exec($sqlconnect3,$strsql_de_tot);
	while(odbc_fetch_row($process_de_tot))
	{
		$debit_tot=$debit_tot+odbc_result($process_de_tot,"DebitNoteAmount");
	}
	odbc_close($sqlconnect3);
	//echo "debit--".$debit_tot."<br><br>";
	
	$outstand=$TotalInvoiceValue-$rec_tot-$credit_tot+$debit_tot;
	if($outstand!=0)
	{
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $ProjectNumber);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $PIName);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, odbc_result($process_inv,"NAME"));
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $inv_no);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $inv_date);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, odbc_result($process_inv,"TotalInvoiceValue"));
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, $outstand);
		$sno++; $c++;
	}
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Exempted Invoices');

$objPHPExcel->setActiveSheetIndex(0);

$fname="Oustanding.xls";
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Oustanding.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>