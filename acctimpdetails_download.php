<?php
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

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
		if($_POST) 
		{
			$fdate=$_POST["FDATE"];
			$tdate=$_POST["TDATE"];
			if(strcmp($usermode,"SUPER")==0)	$bankacctno=$_POST["BankAcct"];
			else $bankacctno=$_SESSION['BankAcct'];
			
			$_SESSION["TFdate"]=$fdate;
			$_SESSION["TTdate"]=$tdate;
			
			$_SESSION['BankAcct']=$bankacctno;
			
			$ledger="";
			$bankacctno=$bankacctno;
		}
		else
		{
			$fdate=$_SESSION["TFdate"];
			$tdate=$_SESSION["TTdate"];
			$bankacctno=$_SESSION['BankAcct'];
		}
	// Create a first sheet, representing sales data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle('1:5')->getFont()->setBold(true);
	
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30); 
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);	
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);	
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);	
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);	
		$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Imprest Account Summary as on'.date("d/m/Y"));
		$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');
		$objPHPExcel->getActiveSheet()->setCellValue('A2', $_SESSION['name']);
		$objPHPExcel->getActiveSheet()->mergeCells('A3:J3');
		$objPHPExcel->getActiveSheet()->setCellValue('A3', 'From '.$fdate.' To '.$fdate);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'S.No');
		$objPHPExcel->getActiveSheet()->setCellValue('B5', 'Recoupment Date');
		$objPHPExcel->getActiveSheet()->setCellValue('C5', 'Recoupment Amount');
		$objPHPExcel->getActiveSheet()->setCellValue('D5', 'TransactionDate (Cheque Date)');
		$objPHPExcel->getActiveSheet()->setCellValue('E5', 'Voucher Type');
		$objPHPExcel->getActiveSheet()->setCellValue('F5', 'TransactionNo (Cheque No)');
		$objPHPExcel->getActiveSheet()->setCellValue('G5', 'Particulars');
		$objPHPExcel->getActiveSheet()->setCellValue('H5', 'Transaction Amount');
		$objPHPExcel->getActiveSheet()->setCellValue('I5', 'ProjectNumber');
		$objPHPExcel->getActiveSheet()->setCellValue('J5', 'Naration');
	
		odbc_close_all();
		$insid=$_SESSION['instid'];	
			
	 $sqlconnect=odbc_connect($dsn,$username,$password) or die("Connection Failed");

	if ($fdate!=NULL && $tdate!=NULL)
	{
		$fde=str_replace("/","-",$fdate);
		$fd = date('Y-m-d',strtotime($fde));
		
		$ede=str_replace("/","-",$tdate);
		$ed = date('Y-m-d',strtotime($ede));

		$sql="EXEC [Imprest].[dbo].[InternalSiteLatestOpeningBalance] @AccountNo = N'$bankacctno',@fromdt = N'$fd'";
		
		$processo=odbc_exec($sqlconnect,$sql) or die("Query Execution Failed");
		if (odbc_fetch_row($processo))
		{
		$opbal=odbc_result($processo,"opbal");	
		}
		$opbalc=0;
		$opbald=0;
		odbc_close_all();

		$sql="EXEC [Imprest].[dbo].[InternlSiteReport] @AccountNo = N'$bankacctno',@fromDt = N'$fd',@todate = N'$ed'";

		$process=odbc_exec($sqlconnect,$sql) or die("Query Execution Failed");
		
		$count=1;
		$i="1";
		$ii="2";
		$totdebit=0;
		$totcredit=0;
		$credit=0;
		$c=6;$sno=1;
		while(odbc_fetch_row($process))
		{
			$vdate="";
			
			$vdate=odbc_result($process,"VoucherDate");	
			$date = date('d-m-Y',strtotime($vdate));
			$part=odbc_result($process,"SupplierName"); //particular -- supplier
			$voutype=odbc_result($process,"VoucherType");
			$vrno=odbc_result($process,"VoucherNo");
			$prjno=odbc_result($process,"ProjectNo");
			//$billname=odbc_result($process,"BillName");
			$naration=odbc_result($process,"Narration");
			$cqno=odbc_result($process,"ChequeNo");
			$cqdt=odbc_result($process,"ChequeDate");
			if(is_null($cqdt)){	$cqdt=$vdate;		}
			$cdt=date('d-m-Y',strtotime($cqdt));
			$vtype=odbc_result($process,"VoucherType");
			$crdr=odbc_result($process,"Credit");
			$voucherid =odbc_result($process,"Credit");
			
			
			if ($crdr==true)
			{
				$credit=odbc_result($process,"Amount");
				$debit=0;
			}
			else
			{
				$credit=0;
				$debit=odbc_result($process,"Amount");
			}
			$totcredit=$totcredit+$credit;
			$totdebit=$totdebit+$debit;
			
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $date);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, round($credit));
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $cdt);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $voutype);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $cqno);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, $part);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, round($debit));
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$c, $prjno);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$c, $naration);
		
			$sno++; $c++;	
		}
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Imprest');
	
		odbc_close_all();
	
	
	
		$objPHPExcel->setActiveSheetIndex(0);
	
	
	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Imprest.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
  }
?>