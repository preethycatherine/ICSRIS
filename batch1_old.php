<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ICSR ACCOUNTS</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
if (top !=self) {
   top.location=self.location;
}
</script>
</head>
<body>
<div id="outer">
	<div id="header">
		<h1>CPDA Accounts </h1>
		<h1>Indian Institute of Technology Madras, Chennai</h1>
		<h2>Information System</h2>
	</div>
	<div id="menu">
	<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">CPDA Accounts Information System</div></h2>
	</div>

	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
				
				<div align="center">
				  <h3> CPDA Account Statement </h3>
				</div>
<div align="center">
<?php
session_start();


$dsn="eservices";
$username="cpdaread";
$password="Cpda@Read!1";

 $instid1= $_GET['StaffNo'];

mysql_connect("$dsn","$username","$password") or die("ODBC Connection Failed");
mysql_select_db("cpda") or die("cannot select DB");







  $sqlquery="select StaffName,Department  from staff_details where StaffNo LIKE '".$instid1."' and Status='Active'";
$process=mysql_query($sqlquery);
//$strsq1="SELECT NAME,DEPT FROM CO_NME WHERE IIRNO LIKE '$instid1'";


//$process=odbc_exec($sqlconnect,$strsq1) or die("<br>connection failed");

$name="";
$dept="";

while($row=mysql_fetch_array($process))
{
$name=$row["StaffName"];
$dept=$row["Department"];
}
$today_date=date("Y/m/d");
?>

<table width="90%"  style="background-color:#F6EECC">
<tr   >
<th width="25%" ><div  align="right" style="color:#2A0000"> IIRNO :</div></th>
<td width="25%"><b><div align="left" ><?php echo "$instid1" ?></div></b></td>
<th width="20%" ><div  align="right" style="color:#2A0000">Date :</div></th>
<td><b><div align="left"><?php echo "$today_date" ?></div></b></td>
</tr>
<tr>
<th ><div  align="right" style="color:#2A0000">CoordinatorName :</div></th>
<td><b><div align="left"><?php echo "$name" ?></div></b></td>
<th ><div  align="right" style="color:#2A0000">Department :</div></th>
<td><b><div align="left"><?php echo "$dept " ?></div></b></td>
</tr>
</table>

<?php
//die();
mysql_close();
?>

	
   <?php
$con =   mysql_connect('eservices','cpdaread','Cpda@Read!1') or die("Connection is  failed : ".mysql_error());
 mysql_select_db('cpda') or die("DB Selection is failed ".mysql_error());
 
$sql = "SELECT * FROM batch_details WHERE StaffNo = '".$_GET['StaffNo']."' order by BatchStartDate";  
$rs = mysql_query($sql);
 $sql="TRUNCATE table dummy_details";
	 
 $rs1 = mysql_query($sql);
   echo "<br>";
$count=1;
while($row = mysql_fetch_object($rs))
{
   $No=$count;
   $BatchNo = $row->BatchNo;
   $StaffNo = $row->StaffNo ;
   $BatchStartDate = $row->BatchStartDate;
   $BatchEndDate = $row->BatchEndDate;
   $GivenAmount = $row->GivenAmount;
   
 
 
   $sq2="INSERT INTO dummy_details (`No`,`StaffNo`,`BatchStartDate`, `BatchEndDate`, `GivenAmount`) VALUES('".$count."' ,'".$row->StaffNo."','".$row->BatchStartDate."', '".$row->BatchEndDate."', '".$row->GivenAmount."')";
	 
 $rs2 = mysql_query($sq2);
   

    
 
         //echo " <tr><td>$No </td><td>$StaffNo </td>    <td>$BatchStartDate</td>
	//<td>$BatchEndDate</td>
	//<td>$GivenAmount </td>
	//<td><a href='updatebatch.php?id=$BatchNo'>Update</a></td>
  //</tr>" ;
  $count++;
 

  }
  
  ?>





<table border="1" width="90%">
  <tr>
    
    <th width="13%"><div align="center">StaffNo</div></td>

	<th width="13%"><div align="center">BatchStartDate</div></td>  
	<th width="13%"><div align="center">BatchEndDate</div></td>  
	<th width="13%"><div align="center">Available Amount</div></td>  
	<th width="25%"><div align="center">Amount Spend </div></td>  
	<th width="13%"><div align="center">Balance</div></td>  
	<th width="13%"><div align="center">summary</div></td>  

  </tr><?php
 
$con =   mysql_connect('eservices','cpdaread','Cpda@Read!1') or die("Connection is  failed : ".mysql_error());
 mysql_select_db('cpda') or die("DB Selection is failed ".mysql_error());
$sql = "SELECT * FROM staff_details WHERE StaffNo = '".$_GET['StaffNo']."'";  

 $rs = mysql_query($sql);

while($row = mysql_fetch_object($rs))
{
 
    $date = $row->Batchingdate;
     
     $StaffNo = $row->StaffNo;
	
// if($date != '0000-00-00' )
 
 //{
$dateArr = explode('-',$row->Batchingdate);
		
		
$timestamp1 = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]); 
 echo "<br>";
 
 
 

   if($dateArr[0] >= '2006')
		{
		$start_year = $dateArr[0];
		}
		else
		{
		$start_year = '2006';
		}
  $deaddate ="2007-06-30";
   $dateArr1 = explode('-',$deaddate);
 $timestamp2 = mktime(0,0,0,$dateArr1[1],$dateArr1[2],$dateArr1[0]); 
  $i =0;
  if ($timestamp1 <= $timestamp2)
{
 
 
              {
              $i =1;
               }
		        $until_year = date('Y') ;


               do{
			
	              if($i==1)
	                   {	
	                   $balance = Balance($StaffNo);
		               $i++;
                         }        
	   
	                       else  if($i==2)
	                              {		
		                         $start_year = Balance2($balance,$StaffNo);		
		                         $i++;
                                  }  
      
	   
	                                    else 
	                                         {
	//echo $i;
	                                   		   $start_year =Balanceother($StaffNo,$i,$start_year);
											$i++;
												}
												
                                                          
														  } while($until_year >= $start_year);
                                                              //}

}

 
else
   {	
					$con =   mysql_connect('eservices','cpdaread','Cpda@Read!1') or die("Connection is  failed : ".mysql_error());
                    mysql_select_db('cpda') or die("DB Selection is failed ".mysql_error());
					
					 $sq = "SELECT * FROM dummy_details WHERE StaffNo = '".$_GET['StaffNo']."'";    
$rb = mysql_query($sq);
while($batch = mysql_fetch_object($rb))
	   
	  { 
	   
	   
       $mysqlStart = $batch->BatchStartDate;
    
     $mysqlEnd = $batch->BatchEndDate;
	 
       
  $sql = "SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs = mysql_query($sql);
while($pcf = mysql_fetch_object($rs))
{
 $sql1 = "SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs1 = mysql_query($sql1);
while($pcf1 = mysql_fetch_object($rs1))
{
 $sql2 = "SELECT SUM(CommitAmount)as total2 FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND CommitDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs2 = mysql_query($sql2);
while($pcf2 = mysql_fetch_object($rs2))
{
 $sql3 = "SELECT GivenAmount FROM dummy_details WHERE StaffNo = '".$_GET['StaffNo']."' AND BatchStartDate ='".$mysqlStart."' AND BatchEndDate='".$mysqlEnd."'";
$rs3 = mysql_query($sql3);
while($pcf3 = mysql_fetch_object($rs3))
{
  $given_amount=$pcf3->GivenAmount;
   $balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
   $spent=($pcf->total-$pcf1->total1)+$pcf2->total2;
      echo " <tr>  <td>'".$_GET['StaffNo']."' </td>  <td>'".$mysqlStart."'</td>
	<td>'".$mysqlEnd."'</td><td>$given_amount</td><td>$spent</td><td>$balance</td><td><a href='acctcpdasum1.php?amount=$given_amount&start=$mysqlStart&end=$mysqlEnd&StaffNo=".$_GET['StaffNo']."'>summary </a></td>
	
	
  </tr>" ;
    //echo $pcf->details." --".$pcf->amount."<br>";
    }
	}
}
}
   }  
					
}	

}			 
												 
 ?>
 <?php
	function Balance($StaffNo){  
	
	 $sq = "SELECT * FROM dummy_details WHERE StaffNo = '".$_GET['StaffNo']."' && No='1'";    
$rb = mysql_query($sq);
while($batch = mysql_fetch_object($rb))
	   
	  { 
	   
	   
       $mysqlStart = $batch->BatchStartDate;
    
     $mysqlEnd = $batch->BatchEndDate;
	 
       
  $sql = "SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs = mysql_query($sql);
while($pcf = mysql_fetch_object($rs))
{
 $sql1 = "SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs1 = mysql_query($sql1);
while($pcf1 = mysql_fetch_object($rs1))
{
 $sql2 = "SELECT SUM(CommitAmount)as total2 FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND CommitDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs2 = mysql_query($sql2);
while($pcf2 = mysql_fetch_object($rs2))
{
 $sql3 = "SELECT GivenAmount FROM dummy_details WHERE StaffNo = '".$_GET['StaffNo']."' AND BatchStartDate ='".$mysqlStart."' AND BatchEndDate='".$mysqlEnd."'";
$rs3 = mysql_query($sql3);
while($pcf3 = mysql_fetch_object($rs3))
{
  $given_amount=$pcf3->GivenAmount;
   $balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
      $spent=($pcf->total-$pcf1->total1)+$pcf2->total2;

      echo " <tr>  <td>'".$_GET['StaffNo']."' </td>  <td>'".$mysqlStart."'</td>
	<td>'".$mysqlEnd."'</td><td>$given_amount</td><td>$spent</td><td>$balance</td><td><a href='acctcpdasum1.php?amount=$given_amount&start=$mysqlStart&end=$mysqlEnd&StaffNo=".$_GET['StaffNo']."'>summary </a></td>
	
	
  </tr>" ;
    //echo $pcf->details." --".$pcf->amount."<br>";
    }
	}
}
}
   }     echo "<br>";
		
                return $balance;
        }
		
		
		
		 function Balance2($balance,$StaffNo){
        $sq = "SELECT * FROM dummy_details WHERE StaffNo = '".$_GET['StaffNo']."' && No='2'";
$rb = mysql_query($sq);
while($batch = mysql_fetch_object($rb))
	   
	  { 
	   
	   
       $mysqlStart = $batch->BatchStartDate;
    
     $mysqlEnd = $batch->BatchEndDate;
	 $dateArr1 = explode('-',$mysqlEnd);
     $end_year = $dateArr1[0]; 
	 
   $sql = "SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs = mysql_query($sql);
while($pcf = mysql_fetch_object($rs))
{
 $sql1 = "SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs1 = mysql_query($sql1);
while($pcf1 = mysql_fetch_object($rs1))
{
 $sql2 = "SELECT SUM(CommitAmount)as total2 FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND CommitDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs2 = mysql_query($sql2);
while($pcf2 = mysql_fetch_object($rs2))
{
 $sql3 = "SELECT GivenAmount FROM dummy_details WHERE StaffNo = '".$_GET['StaffNo']."' AND BatchStartDate ='".$mysqlStart."' AND BatchEndDate='".$mysqlEnd."'";
$rs3 = mysql_query($sql3);
while($pcf3 = mysql_fetch_object($rs3)){
  $given_amount=$pcf3->GivenAmount+$balance;
   $balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
        $spent=($pcf->total-$pcf1->total1)+$pcf2->total2;
      echo " <tr>  <td>'".$_GET['StaffNo']."' </td>  <td>'".$mysqlStart."'</td>
	<td>'".$mysqlEnd."'</td><td>$given_amount</td><td>$spent</td><td>$balance</td><td><a href='acctcpdasum1.php?amount=$given_amount&start=$mysqlStart&end=$mysqlEnd&StaffNo=".$_GET['StaffNo']."'>summary </a></td>
	
	
  </tr>" ;
    //echo $pcf->details." --".$pcf->amount."<br>";
    }
	}
	}
	}
	}
        echo "<br>";
        return $end_year;
		
    }
	 
	 
	function Balanceother($StaffNo,$i,$start_year)
	{
	 $sq = "SELECT * FROM dummy_details WHERE StaffNo = '".$_GET['StaffNo']."' && No='$i'";
	$rb = mysql_query($sq);
	while($batch = mysql_fetch_object($rb))
	   { 
	   
	   
    $mysqlStart = $batch->BatchStartDate;
    
     $mysqlEnd = $batch->BatchEndDate;
	 $dateArr1 = explode('-',$mysqlEnd);
     $end_year = $dateArr1[0]; 
	 

	  $sql = "SELECT SUM(PayAmount)as total FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND BrDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs = mysql_query($sql);
//echo $rs;
while($pcf = mysql_fetch_object($rs))
{
   $sql1 = "SELECT SUM(RcptAmount)as total1 FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND RcptDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs1 = mysql_query($sql1);
while($pcf1 = mysql_fetch_object($rs1))
{
 $sql2 = "SELECT SUM(CommitAmount)as total2 FROM expenditure_details WHERE StaffNo = '".$_GET['StaffNo']."' AND CommitDate   BETWEEN '".$mysqlStart."'
AND '".$mysqlEnd."'";
$rs2 = mysql_query($sql2);
while($pcf2 = mysql_fetch_object($rs2))
{
  $sql3 = "SELECT GivenAmount FROM dummy_details WHERE StaffNo = '".$_GET['StaffNo']."' AND BatchStartDate ='".$mysqlStart."' AND BatchEndDate='".$mysqlEnd."'";
$rs3 = mysql_query($sql3);
while($pcf3 = mysql_fetch_object($rs3))
{
  $given_amount=$pcf3->GivenAmount;
   $balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
        $spent=($pcf->total-$pcf1->total1)+$pcf2->total2;
      echo " <tr>  <td>".$_GET['StaffNo']." </td>  <td>".$mysqlStart."</td>
	<td>".$mysqlEnd."</td><td>$given_amount</td><td>$spent</td><td>$balance</td> <td><a href='acctcpdasum1.php?amount=$given_amount&start=$mysqlStart&end=$mysqlEnd&StaffNo=".$_GET['StaffNo']."'>summary </a></td>
	
  </tr>" ;
     }
	 }
    }
	} 
		 
	}		return $i++;
		  
		   } 
		
		
		
	?>
</table>
</div>
 </div>
 </div>
<div id="secondaryContent">
<div align="right" class="rowA"><a href="../signout.php"><strong>Signout</strong></a></div>
<h3>CPDA ACCOUNT</h3>
<p><ul><li><a href="../icsrisacct.php">CPDA HOME PAGE</a></li></ul></p>
<p><ul><li><a href="acctcpdaquery.php">CPDA QUERY PAGE</a></li></ul></p>

<div id="footer">
</div>
</div>

</body>
</html>


