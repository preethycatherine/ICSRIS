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
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Project Number');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Start Date');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Close Date');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Grant Received');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Total Exp.+Com.');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Balance');

	odbc_close_all();
	$insid=$_SESSION['instid'];	
		
	$dsn="FACCTDSN";
	$username="sa";
	$password="IcsR@123#";
	$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");
	$sqlconnectacct=odbc_connect("FACCT1DSN","sa","IcsR@123#") or die("ODBC CONNECTION 2 Failed");
	$sqlquery="select nprno,start_date,close_date,pramount from mstlst where instid like '$insid' and close_date<getdate() and (substring(nprno,4,4) in ('EQPT','9899','9900','0001','0102','0203','0304','0405','0506','0607','0708','0809','0910','1011','1112','1213','1314','1415','1516','1617','1718','1819')) order by close_date desc";
	
	//unset($_SESSION['nprno']); 
	$sqlconnect=odbc_connect($dsn,$username,$password);
	$process=odbc_exec($sqlconnect,$sqlquery); 
	
	
	$c=2;$sno=1;
	while(odbc_fetch_row($process))
	{
		$pono = odbc_result($process,"nprno");
		$star_date=odbc_result($process,"start_date");
		$start_date=date('d-m-Y',strtotime($star_date));
		$clos_date=odbc_result($process,"close_date");
		$close_date=date('d-m-Y',strtotime($clos_date));
		$pramount=odbc_result($process,"pramount");
		
		$nprno=$pono;
		
		if((strcmp('CHY0910258',substr($nprno,0,10))==0)or (strcmp('MEE0708226',substr($nprno,0,10))==0) or (strcmp('MEE0809245',substr($nprno,0,10))==0) or (strcmp('CSE0708092',substr($nprno,0,10))==0) or (strcmp('PHY0607185',substr($nprno,0,10))==0) or (strcmp('ELE0506130',substr($nprno,0,10))==0) or (strcmp('APM0102059',substr($nprno,0,10))==0) or (strcmp('CHE0304064',substr($nprno,0,10))==0) or (strcmp('CHE0304062',substr($nprno,0,10))==0) or (strcmp('ELE0304081',substr($nprno,0,10))==0) or (strcmp('PHY0708199',substr($nprno,0,10))==0) or (strcmp('MEE0809238',substr($nprno,0,10))==0) or (strcmp('CHE0304063',substr($nprno,0,10))==0) or (strcmp(substr($nprno,0,3),'IIT')==0) or (strcmp(substr($nprno,10,4),'PCFX')==0) or (strcmp(substr($nprno,10,4),'RMFX')==0))
		{
		$aprlnoc=$nprno;
		}
		else
		{
		$aprlnoc=substr($nprno,0,10)."%";
		}
		//echo "$aprlnoc";
		$stracct="select substring(nprno,11,4) as agency,nprno,stafall,staf,stafcom,eqptall,eqpt,rt,eqptcom,consall,cons,conscom,contall,cont,contcom,travall,trav,travcom,compall, comp,compcom,ohall,inoh,icoh,oterall,oter,otercom,totalall,total,totalcom,rt_balance from ttmaster  where nprno like '$aprlnoc'";
		
		$processacct="";
		$processacct=odbc_exec($sqlconnectacct,$stracct) or dir("processacct Failed to get data");
		
		if(odbc_fetch_row($processacct))
		{
		$totalall = round(odbc_result($processacct,"totalall"),0);
		$total = round(odbc_result($processacct,"total"),0);
		$totalcom = round(odbc_result($processacct,"totalcom"),0);
		$totalcur=$total+$totalcom;
		
		$rt = round(odbc_result($processacct,"rt"),0);
		$rt_balance = round(odbc_result($processacct,"rt_balance"),0);
		$rtbal=$rt-$totalcur;
		}
		else
		{
		$rt="NA";
		$rtbal="NA";
		}		
	
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $nprno);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $start_date);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $close_date);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $rt);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $totalcur);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, $rtbal);
		
		
		$sno++; $c++;
	}

	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('Sponsored_Closed_As_PI');

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
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(95);
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Project Number');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Start Date');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Close Date');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Grant Received');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Total Exp.+Com.');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Balance');

	
	$sqlquery1="select nprno,title,start_date,close_date,pramount from mstlst where close_date<getdate()and nprno in(select nprno from projcoordinators where instid ='$insid') order by close_date desc";
	//echo "$sqlquery1";
	$process1=odbc_exec($sqlconnect,$sqlquery1) or die("Connection Failed"); 
	$c=2;$sno=1;
	
	while(odbc_fetch_row($process1))
	{
	$pono = odbc_result($process1,"nprno");
	$star_date=odbc_result($process1,"start_date");
	$start_date=date('d-m-Y',strtotime($star_date));
	$clos_date=odbc_result($process1,"close_date");
	$close_date=date('d-m-Y',strtotime($clos_date));
	$pramount=odbc_result($process1,"pramount");
	
	
	$nprno=$pono;
		if((strcmp('CHY0910258',substr($nprno,0,10))==0)or (strcmp('MEE0708226',substr($nprno,0,10))==0) or (strcmp('MEE0809245',substr($nprno,0,10))==0) or (strcmp('CSE0708092',substr($nprno,0,10))==0) or (strcmp('PHY0607185',substr($nprno,0,10))==0) or (strcmp('ELE0506130',substr($nprno,0,10))==0) or (strcmp('APM0102059',substr($nprno,0,10))==0) or (strcmp('CHE0304064',substr($nprno,0,10))==0) or (strcmp('CHE0304062',substr($nprno,0,10))==0) or (strcmp('ELE0304081',substr($nprno,0,10))==0) or (strcmp('PHY0708199',substr($nprno,0,10))==0) or (strcmp('MEE0809238',substr($nprno,0,10))==0) or (strcmp('CHE0304063',substr($nprno,0,10))==0) or (strcmp(substr($nprno,0,3),'IIT')==0))
		{
			$aprlnoc=$nprno;
		}
		else
		{
			$aprlnoc=substr($nprno,0,10)."%";
		}
		
		$stracct="select substring(nprno,11,4) as agency,nprno,stafall,staf,stafcom,eqptall,eqpt,rt,eqptcom,consall,cons,conscom,contall,cont,contcom,travall,trav,travcom,compall, comp,compcom,ohall,inoh,icoh,oterall,oter,otercom,totalall,total,totalcom,rt_balance from ttmaster  where nprno like '$aprlnoc'";
		
		$processacct="";
		$processacct=odbc_exec($sqlconnectacct,$stracct) or dir("processacct Failed to get data");
		
			if(odbc_fetch_row($processacct))
			{
				$totalall = round(odbc_result($processacct,"totalall"),0);
				$total = round(odbc_result($processacct,"total"),0);
				$totalcom = round(odbc_result($processacct,"totalcom"),0);
				$totalcur=$total+$totalcom;
				
				$rt = round(odbc_result($processacct,"rt"),0);
				$rt_balance = round(odbc_result($processacct,"rt_balance"),0);
				$rtbal=$rt-$totalcur;
			}
			else
			{
				$rt="NA";
				$rtbal="NA";
			}
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $sno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $nprno);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $start_date);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $close_date);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $rt);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $totalcur);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, $rtbal);
	
		$sno++; $c++;
		}
	
	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('Sponsored_Closed_As_CO-PI');


	$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Sponsoredclosed.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>