<?php
session_start(); 
/*error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
*/
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
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);  
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);	
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Project Number');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Start Date');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Close Date');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Project Value');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Grant Received');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Total Exp.+Com.');
	$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Balance');

	odbc_close_all();
	$insid=$_SESSION['instid'];	
		
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
	$sqlconnectacct=odbc_connect("FACCT1DSN","sa","IcsR@123#") or die("ODBC CONNECTION 2 Failed");
	$sqlquery="select cprno,s_date,c_date,c_cost from cmstlst where instid like '$insid' and c_date<CAST(CAST(GETDATE() AS DATE) AS DATETIME) and (substring(cprno,3,4) in ('0203','0304','0405','0506','0607','0708','0809','0910','1011','1112','1213','1314','1415','1516','1617','1718','1819')) order by c_date desc";
	
	unset($_SESSION['cprno']); 
	$usermode=$_SESSION['usermode'];
	$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC Connection Failed");
	$process=odbc_exec($sqlconnect,$sqlquery) or die("ODBC Query Execution Failed"); 
	$c=2;$sno=1;
	while(odbc_fetch_row($process))
	{
		$pono = odbc_result($process,"cprno");
		$star_date=odbc_result($process,"s_date");
		$start_date=date('d-m-Y',strtotime($star_date));
		
		$clos_date=odbc_result($process,"c_date");
		if($clos_date!='')
		{ 
			$close_date=date('d-m-Y',strtotime($clos_date));
		}
		else
		{
			$close_date='';
		}
		
		$pramount=odbc_result($process,"c_cost");
		
		$aprlnoc=$pono;
		$stracct="select cprno,c_staf,c_eqpt,c_cons,c_cont,c_trav,c_comp,c_oter,c_inoh,c_icoh,c_euco,c_irdf,c_cent,c_remu,c_faci,c_sert,c_balance,C_RT,c_used,C_TOTALCOM,C_CONTCOM,C_STAFCOM,C_BALANCE from cmaster  where CPRNO LIKE '$aprlnoc'";
		
		$process1="";
		$sqlconnectacct=odbc_connect("FACCT1DSN","sa","IcsR@123#") or die("ODBC CONNECTION 2 Failed");
		$process1=odbc_exec($sqlconnectacct,$stracct) or dir("processacct Failed to get data");
		
		if(odbc_fetch_row($process1))
		{
		$sta=odbc_result($process1,"c_staf");
		$staf=round($sta,2);
		$eqp=odbc_result($process1,"c_eqpt");
		$eqpt=round($eqp,2);
		$cons=odbc_result($process1,"c_cons");
		$cons=round($cons,2);
		$cont=odbc_result($process1,"c_cont");
		$cont=round($cont,2);
		$trav=odbc_result($process1,"c_trav");
		$trav=round($trav,2);
		$comp=odbc_result($process1,"c_comp");
		$comp=round($comp,2);
		$oter=odbc_result($process1,"c_oter");
		$oter=round($oter,2);
		$tota=$staf+$eqpt+$cons+$cont+$trav+$comp+$oter;
		$tota=round($tota,2);
		$inoh=odbc_result($process1,"c_inoh");
		$inoh=round($inoh,2);
		$icoh=odbc_result($process1,"c_icoh");
		$icoh=round($icoh,2);
		$euco=odbc_result($process1,"c_euco");
		$euco=round($euco,2);
		$irdf=odbc_result($process1,"c_irdf");
		$irdf=round($irdf,2);
		$cent=odbc_result($process1,"c_cent");
		$cent=round($cent,2);
		$remu=odbc_result($process1,"c_remu");
		$remu=round($remu,2);
		$faci=odbc_result($process1,"c_faci");
		$faci=round($faci,2);
		$sert=odbc_result($process1,"c_sert");
		$sert=round($sert,2);
		$balance=odbc_result($process1,"c_balance");
		$balance=round($balance,2);
		$rt=odbc_result($process1,"C_RT");
		$rt=round($rt,2);
		$used=odbc_result($process1,"c_used");
		$used=round($used,2);
		$texpb=$inoh+$icoh+$euco+$irdf+$cent+$remu+$faci+$used+$sert;
		$texpb=round($texpb,2);
		$totalcom=odbc_result($process1,"C_TOTALCOM");
		$totalcom=round($totalcom,2);
		$contcom=odbc_result($process1,"C_CONTCOM");
		$contcom=round($contcom,2);
		$stafcom=odbc_result($process1,"C_STAFCOM");
		$stafcom=round($stafcom,2);
		$cbalance=odbc_result($process1,"C_BALANCE");
		$cbalance=round($cbalance,2);
		$balpurcom=$totalcom-$stafcom;
		$balpurcom=round($balpurcom,2);
		$balance=$cbalance-$totalcom;
		$exptot=$tota+$texpb+$totalcom;
		$balance=round($balance,2);
		}
		else
		{
		$rt="NA";
		$stafcom="NA";
		$rtbal="NA";
		}	
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $pono);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $start_date);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $close_date);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $pramount);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $rt);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, $exptot);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, $balance);
	
		$sno++; $c++;	
	}
	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('Consultancy_Closed_As_PI');

	odbc_close_all();
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(1);
	$objPHPExcel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);  
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);  
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);  
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);	
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Project Number');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Start Date');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Close Date');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Project Value');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Grant Received');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Total Exp.+Com.');
	$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Balance');

	
	$sqlquery1="select cprno,s_date,c_date,c_cost from cmstlst where c_date<getdate() and cprno in (select cprno from conscocoordinators where instid ='$insid') order by c_date asc";
				
	$sqlconnect=odbc_connect("FACCTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
	$process2=odbc_exec($sqlconnect,$sqlquery1) or die("Connection Failed"); 
	$c=2;$sno=1;
	while(odbc_fetch_row($process2))
	{
		$pono = odbc_result($process2,"cprno");
		$star_date=odbc_result($process2,"s_date");
		$start_date=date('d-m-Y',strtotime($star_date));
		$clos_date=odbc_result($process2,"c_date");
		$close_date=date('d-m-Y',strtotime($clos_date));
		$pramount=odbc_result($process2,"c_cost");
		
		$aprlnoc=$pono;
		$stracct="select cprno,c_staf,c_eqpt,c_cons,c_cont,c_trav,c_comp,c_oter,c_inoh,c_icoh,c_euco,c_irdf,c_cent,c_remu,c_faci,c_sert,c_balance,C_RT,c_used,C_TOTALCOM,C_CONTCOM,C_STAFCOM,C_BALANCE from cmaster  where CPRNO LIKE '$aprlnoc'";
		
		$process1="";
		$sqlconnectacct=odbc_connect("FACCT1DSN","sa","IcsR@123#") or die("ODBC CONNECTION 2 Failed");
		$process1=odbc_exec($sqlconnectacct,$stracct) or dir("processacct Failed to get data");
		
		if(odbc_fetch_row($process1))
		{
		$sta=odbc_result($process1,"c_staf");
		$staf=round($sta,2);
		$eqp=odbc_result($process1,"c_eqpt");
		$eqpt=round($eqp,2);
		$cons=odbc_result($process1,"c_cons");
		$cons=round($cons,2);
		$cont=odbc_result($process1,"c_cont");
		$cont=round($cont,2);
		$trav=odbc_result($process1,"c_trav");
		$trav=round($trav,2);
		$comp=odbc_result($process1,"c_comp");
		$comp=round($comp,2);
		$oter=odbc_result($process1,"c_oter");
		$oter=round($oter,2);
		$tota=$staf+$eqpt+$cons+$cont+$trav+$comp+$oter;
		$tota=round($tota,2);
		$inoh=odbc_result($process1,"c_inoh");
		$inoh=round($inoh,2);
		$icoh=odbc_result($process1,"c_icoh");
		$icoh=round($icoh,2);
		$euco=odbc_result($process1,"c_euco");
		$euco=round($euco,2);
		$irdf=odbc_result($process1,"c_irdf");
		$irdf=round($irdf,2);
		$cent=odbc_result($process1,"c_cent");
		$cent=round($cent,2);
		$remu=odbc_result($process1,"c_remu");
		$remu=round($remu,2);
		$faci=odbc_result($process1,"c_faci");
		$faci=round($faci,2);
		$sert=odbc_result($process1,"c_sert");
		$sert=round($sert,2);
		$balance=odbc_result($process1,"c_balance");
		$balance=round($balance,2);
		$rt=odbc_result($process1,"C_RT");
		$rt=round($rt,2);
		$used=odbc_result($process1,"c_used");
		$used=round($used,2);
		$texpb=$inoh+$icoh+$euco+$irdf+$cent+$remu+$faci+$used+$sert;
		$texpb=round($texpb,2);
		$totalcom=odbc_result($process1,"C_TOTALCOM");
		$totalcom=round($totalcom,2);
		$contcom=odbc_result($process1,"C_CONTCOM");
		$contcom=round($contcom,2);
		$stafcom=odbc_result($process1,"C_STAFCOM");
		$stafcom=round($stafcom,2);
		$cbalance=odbc_result($process1,"C_BALANCE");
		$cbalance=round($cbalance,2);
		$balpurcom=$totalcom-$stafcom;
		$balpurcom=round($balpurcom,2);
		$exptot=$tota+$texpb+$totalcom;
		$balance=$cbalance-$totalcom;
		$balance=round($balance,2);
		}
		else
		{
		$rt="NA";
		$stafcom="NA";
		$rtbal="NA";
		}
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $pono);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $start_date);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $close_date);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $pramount);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $rt);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, $exptot);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$c, $balance);
		$sno++; $c++;	
	}
	
	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('Consultancy_Closed_As_CO-PI');


	$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Consultancyclosed.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>