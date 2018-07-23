<?php
session_start(); 
include("excel/excelwriter.inc.php");	
$fname="download/gst_reports_".$_GET['type'].".xls";
$excel=new ExcelWriter($fname);
if($excel==false)	echo $excel->error;	

$dsn="FACCTDSN";
$username="sa";
$password="IcsR@123#";
$sqlconnect=odbc_connect($dsn,$username,$password) or die("ODBC CONNECTION 1 Failed");

	
	$inv_type=$_GET['type'];
	$sno=1;
	$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
	
	$bill_table="";
	if($inv_type=="Registered") $bill_table="GST_BILL_TO_DETAILS";
	elseif($inv_type=="Un-Registered-B2CL" or $inv_type=="Un-Registered-B2CS") $bill_table="GST_BILL_TO_DETAILS_VENDOR";
	elseif($inv_type=="Export") $bill_table="GST_BILL_TO_DETAILS_export ";
	elseif($inv_type=="Exempted") $bill_table="GST_BILL_TO_DETAILS";
	
	
	if($inv_type=="Un-Registered-B2CL" or $inv_type=="Un-Registered-B2CS")
	{
		 $inv_type_ur=$inv_type;
		 $inv_type="Un-Registered";
		 
	}
	
	$strsql_inv_tot="Select count(*) as total_inv, count(distinct BillToID) as total_recp, sum(TaxableValue) as tot_tax_val, sum(TotalInvoiceValue) as tot_inv_val from GST_Invoice_Details where InvoiceType='$inv_type' and CONVERT(VARCHAR(25), InvoiceDate, 126) LIKE '".$_SESSION['month']."%'";
	$process_inv_tot=odbc_exec($sqlconnect,$strsql_inv_tot) or die("<br>Connection Failed");
	//echo $inv_type;
	if($inv_type=="Registered" or $inv_type=="Exempted")
		$myArr=array("<b></b>","<b>No. of Receipient</b>","<b></b>","<b>No. of Invoices</b>","<b></b>","<b>Total Invoice Value</b>","<b></b>","<b></b>","<b></b>","<b></b>","<b>Total Taxable Value</b>");
	elseif($inv_type!="Un-Registered")
		$myArr=array("<b></b>","<b>No. of Invoices</b>","<b></b>","<b>Total Invoice Value</b>","<b></b>","<b></b>","<b></b>","<b></b>","<b>Total Taxable Value</b>");
		
	$excel->writeLine($myArr);

	if($inv_type=="Registered" or $inv_type=="Exempted")
		$myArr=array("",odbc_result($process_inv_tot,"total_recp"),"",odbc_result($process_inv_tot,"total_inv"),"",odbc_result($process_inv_tot,"tot_inv_val"),"","","","",odbc_result($process_inv_tot,"tot_tax_val"));
	elseif($inv_type!="Un-Registered")
		$myArr=array("",odbc_result($process_inv_tot,"total_inv"),"",odbc_result($process_inv_tot,"tot_inv_val"),"","","","",odbc_result($process_inv_tot,"tot_tax_val"));
		
	$excel->writeLine($myArr);
	
	

	if($inv_type=="Registered" or $inv_type=="Exempted")
		$myArr=array("<b>S.No</b>","<b>GSTIN of Receipient</b>","<b>Receipient Name</b>","<b>Invoice Number</b>","<b>Invoice Date</b>","<b>Invoice Value</b>","<b>Place of Supply</b>","<b>Reverse Charge</b>","<b>Invoice Type</b>","<b>Rate</b>","<b>Taxable Value</b>");
	else
		$myArr=array("<b>S.No</b>","<b>Invoice Number</b>","<b>Invoice Date</b>","<b>Invoice Value</b>","<b>Place of Supply</b>","<b>Reverse Charge</b>","<b>Invoice Type</b>","<b>Rate</b>","<b>Taxable Value</b>");

	$excel->writeLine($myArr);

	odbc_close_all();
	$sqlconnect=odbc_connect("FACCTGSTDSN","sa","IcsR@123#") or die("ODBC CONNECTION FAILED");
	$strsql_inv="Select * from GST_Invoice_Details a, $bill_table b where a.BillToID=b.bill_id and a.InvoiceType='$inv_type' and CONVERT(VARCHAR(25), a.InvoiceDate, 126) LIKE '".$_SESSION['month']."%' order by a.DINP";
	$process_inv=odbc_exec($sqlconnect,$strsql_inv) or die("<br>Connection Failed");
	while(odbc_fetch_row($process_inv))
	{
		$inv_date=odbc_result($process_inv,"InvoiceDate");
		$inv_date=date("d-m-Y", strtotime($inv_date));
		$inv_no=odbc_result($process_inv,"InvoiceNumber");
		$ProjectNumber=odbc_result($process_inv,"ProjectNumber");
		$PIName=odbc_result($process_inv,"PIName");
		$TaxableValue=odbc_result($process_inv,"TaxableValue");
		$TotalInvoiceValue=odbc_result($process_inv,"TotalInvoiceValue");
		
		//$myArr=array($sno,$inv_date,$inv_no,$ProjectNumber,$PIName,odbc_result($process_inv,"DeptName"),odbc_result($process_inv,"Description"),odbc_result($process_inv,"TaxableValue"),odbc_result($process_inv,"CGSTAmount"),odbc_result($process_inv,"SGSTAmount"),odbc_result($process_inv,"IGSTAmount"),odbc_result($process_inv,"TotalInvoiceValue"),odbc_result($process_inv,"SACNumber"),odbc_result($process_inv,"NAME"),odbc_result($process_inv,"ADDRESS"),odbc_result($process_inv,"DISTRICT"),odbc_result($process_inv,"PINCODE"),odbc_result($process_inv,"STATE"),odbc_result($process_inv,"STATECODE"),odbc_result($process_inv,"GSTIN"),odbc_result($process_inv,"PANNO"),odbc_result($process_inv,"TANNO"),odbc_result($process_inv,"CONTACTPERSON"),odbc_result($process_inv,"EMAIL"),odbc_result($process_inv,"CONTACTNO"));
		
		if($inv_type=="Registered" or $inv_type=="Exempted")
		{
			$myArr=array($sno,odbc_result($process_inv,"GSTIN"),odbc_result($process_inv,"NAME"),$inv_no,$inv_date,$TotalInvoiceValue,odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"),"N","Regular","18.00",odbc_result($process_inv,"TaxableValue"));
			$excel->writeLine($myArr);$sno++;							
		}
		elseif($inv_type=="Un-Registered")
		{
			//echo $inv_type;
			if($inv_type_ur=="Un-Registered-B2CL")
			{
				echo  $inv_type." - ".$inv_type_ur;
				if(odbc_result($process_inv,"STATE")!="TamilNadu" and $TotalInvoiceValue>="250000")
				{
					$myArr=array($sno,$inv_no,$inv_date,$TotalInvoiceValue,odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"),"N","Regular","18.00",odbc_result($process_inv,"TaxableValue"));
					$excel->writeLine($myArr);$sno++;							
				}
			}
			elseif($inv_type_ur=="Un-Registered-B2CS")
			{
				echo  $inv_type." - ".$inv_type_ur;
				if($TotalInvoiceValue<"250000" or odbc_result($process_inv,"STATE")=="TamilNadu")
				{
					$myArr=array($sno,$inv_no,$inv_date,$TotalInvoiceValue,odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"),"N","Regular","18.00",odbc_result($process_inv,"TaxableValue"));
					$excel->writeLine($myArr);$sno++;							
				}
			}
		}
		elseif($inv_type=="Export")
		{
		     $myArr=array($sno,$inv_no,$inv_date,$TotalInvoiceValue,odbc_result($process_inv,"STATECODE")." - ".odbc_result($process_inv,"STATE"),"N","Regular","18.00",odbc_result($process_inv,"TaxableValue"));
			 $excel->writeLine($myArr);$sno++;							
		}
		
		
	}
	header("Location: $fname");
	
	
?>