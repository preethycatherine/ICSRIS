<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
<!--<div id="menu">-->
<!--<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h2>
</div>-->
<!--=========== BEGIN MENU SECTION ================-->
	 <script src="https://www.w3schools.com/lib/w3.js"></script>
	<!--<div w3-include-html="menu.html"></div>-->
	<div w3-include-html="menu.php"></div>
		<script>
		w3.includeHTML();
		</script>
	<!--=========== END MENU SECTION ================--> 

	<div id="content">
		<div id="primaryContentContainer">
			<div id="primaryContent">
				
				<div align="center">
				  <h3> CPDA Account Statement </h3>
				</div>
<div align="center">
<?php
session_start();

mysql_connect("eservices", "cpda", "12~CpDa09#") or die("cannot connect"); 
		mysql_select_db("cpda") or die("cannot select DB");

$q=mysql_query("select * from staff_details where StaffNo='".$_SESSION['instid']."' and Status='Active' ")or die(mysql_error());
 $_GET['StaffNo']=$_SESSION['instid'];			
 	
				$rowcount=mysql_num_rows($q);
				if(($rowcount==1))
				{
				while($row = mysql_fetch_array($q))
								{
					
				//$_SESSION['StaffNo']="";
				    //$_SESSION['StaffNo']=$_POST['StaffNo'];
				// $_SESSION['cpdaid']  = $row['StaffNo'];
					
					if($row["Usermode"] == 'Normal')
					
					{
					// header("Location: batch.php");
					}
					
					else
					
					{
					header("Location: acctcpdaquery.php");
					}
				}
			     
				}


?>



<?php
session_start();


$dsn="eservices";
$username="cpda";
$password="12~CpDa09#";

 $instid1= $_GET['StaffNo'];
$inid=$_GET['StaffNo'];
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

<table width="100%" border="1">
<tr>
<th width="25%" ><div  align="right" style="color:#2A0000"> IIRNO :</div></th>
<td width="25%"><b><div align="left" ><?php echo "00$instid1" ?></div></b></td>
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
$con =   mysql_connect('eservices','cpda','12~CpDa09#') or die("Connection is  failed : ".mysql_error());
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







<table width="100%" border="1" align="center">
  <tr align="center">
    
    <th width="15%">StaffNo</td>
	<th width="18%">BatchStartDate</td>  
	<th width="18%">BatchEndDate</td>  
	<th width="18%">Given Amount</td>  
	<th width="18%">Prevailing Amount</td>  
	<th width="22%">Amount Spent </td>  
	<th width="20%">Balance</td>  
	<th width="20%">summary</td>  
  </tr>
  <?php
 
$con =   mysql_connect('eservices','cpda','12~CpDa09#') or die("Connection is  failed : ".mysql_error());
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
		                         $result = Balance2($balance,$StaffNo);		
								 $start_year=$result[0];
								 $balance1=$result[1];
		                         $i++;
                                  }  
      
	   
	                                    else 
	                                         {
	//echo $i;
	                                   		   $values =Balanceother($StaffNo,$i,$balance1,$start_year);
											  //$i=  $values[0];
											  $balance1 =$values[1];
											  $start_year=$values[0];
											  $i++;
											
												}
												  } while($until_year >= $start_year);
                                                          
														  
                                                              //}

}

 
else
   {	
					$con =   mysql_connect('eservices','cpda','12~CpDa09#') or die("Connection is  failed : ".mysql_error());
                    mysql_select_db('cpda') or die("DB Selection is failed ".mysql_error());
					$balance =0;$prevailing_amount ='-';
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
  if($balance <0) 
  {
	  $prevailing_amount = $given_amount + $balance;
 	$balance =  ($prevailing_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
  }else {  
  $balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
   $prevailing_amount = $given_amount ;
     }
$amtspend=($pcf->total-$pcf1->total1)+$pcf2->total2;
 $inid=$_GET['StaffNo'];
  
   //$balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
   
//      echo " <tr>  <td align=center>".$_GET['StaffNo']." </td>  <td align=center>".$mysqlStart."</td>
//	<td align=center>".$mysqlEnd."</td><td align=right>$given_amount</td><td align=right>$prevailing_amount</td><td align=right>($pcf->total-$pcf1->total1)+$pcf2->total2</td><td align=right>$balance</td><td><a href='acctcpdasum.php?amount=$prevailing_amount&start=$mysqlStart&end=$mysqlEnd'>summary </a></td>
	
	
//  </tr>" ;
  ?>
    <tr>
    <td align="center"><?php echo "00$inid" ?></td>
	<td align="center"><?php echo "$mysqlStart" ?></td>  
	<td align="center"><?php echo "$mysqlEnd" ?></td>  
	<td align="right"><?php echo "$given_amount" ?></td>  
	<td align="right"><?php echo "$prevailing_amount" ?></td>  
	<td align="right"><?php echo "$amtspend" ?> </td>  
	<td align="right"><?php echo "$balance" ?></td>  
	<td align="center"><?php echo "<a href='acctcpdasum.php?amount=$prevailing_amount&start=$mysqlStart&end=$mysqlEnd'>summary </a>"?></td>  
  </tr>
  <?php
  

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
		$balance =0;$prevailing_amount ='-';
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
  
   if($balance <0) 
  {
	  $prevailing_amount = $given_amount + $balance;
 	$balance =  ($prevailing_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
  }else {  
  $balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
   $prevailing_amount = $given_amount ;
     }
	 
$amtspend=($pcf->total-$pcf1->total1)+$pcf2->total2;
 $inid=$_GET['StaffNo'];
  
   //$balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
   
//      echo " <tr>  <td align=center>".$_GET['StaffNo']." </td>  <td align=center>".$mysqlStart."</td>
//	<td align=center>".$mysqlEnd."</td><td align=right>$given_amount</td><td align=right>$prevailing_amount</td><td align=right>($pcf->total-$pcf1->total1)+$pcf2->total2</td><td align=right>$balance</td><td><a href='acctcpdasum.php?amount=$prevailing_amount&start=$mysqlStart&end=$mysqlEnd'>summary </a></td>
	
	
//  </tr>" ;
  ?>
    <tr>
    <td align="center"><?php echo "00$inid" ?></td>
	<td align="center"><?php echo "$mysqlStart" ?></td>  
	<td align="center"><?php echo "$mysqlEnd" ?></td>  
	<td align="right"><?php echo "$given_amount" ?></td>  
	<td align="right"><?php echo "$prevailing_amount" ?></td>  
	<td align="right"><?php echo "$amtspend" ?> </td>  
	<td align="right"><?php echo "$balance" ?></td>  
	<td align="center"><?php echo "<a href='acctcpdasum.php?amount=$prevailing_amount&start=$mysqlStart&end=$mysqlEnd'>summary </a>"?></td>  
  </tr>
  <?php
  
   //echo $balance;
    //echo $pcf->details." --".$pcf->amount."<br>";
    }
	}
}
}
   }     echo "<br>";
		
             //echo $balance;
			    return $balance;
        }
		
		
		
		 function Balance2($balance,$StaffNo){
		// echo $balance;
		$balance1=0;$end_year='0000-00-00';
		 $x=0;$prevailing_amount =0;
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


$given_amount=$pcf3->GivenAmount;
$prevailing_amount = $given_amount+$balance;
$balance =  ($prevailing_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
 
//echo $balance;
    $balance1=$balance;
  
   //$balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
 $amtspend=($pcf->total-$pcf1->total1)+$pcf2->total2;
 $inid=$_GET['StaffNo'];
  
   //$balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
   
//      echo " <tr>  <td align=center>".$_GET['StaffNo']." </td>  <td align=center>".$mysqlStart."</td>
//	<td align=center>".$mysqlEnd."</td><td align=right>$given_amount</td><td align=right>$prevailing_amount</td><td align=right>($pcf->total-$pcf1->total1)+$pcf2->total2</td><td align=right>$balance</td><td><a href='acctcpdasum.php?amount=$prevailing_amount&start=$mysqlStart&end=$mysqlEnd'>summary </a></td>
	
	
//  </tr>" ;
  ?>
    <tr>
    <td align="center"><?php echo "00$inid" ?></td>
	<td align="center"><?php echo "$mysqlStart" ?></td>  
	<td align="center"><?php echo "$mysqlEnd" ?></td>  
	<td align="right"><?php echo "$given_amount" ?></td>  
	<td align="right"><?php echo "$prevailing_amount" ?></td>  
	<td align="right"><?php echo "$amtspend" ?> </td>  
	<td align="right"><?php echo "$balance" ?></td>  
	<td align="center"><?php echo "<a href='acctcpdasum.php?amount=$prevailing_amount&start=$mysqlStart&end=$mysqlEnd'>summary </a>"?></td>  
  </tr>
  <?php
  
    //echo $pcf->details." --".$pcf->amount."<br>";
    }
	}
	}
	}
	}
        echo "<br>";
        return array(0=>$end_year,1=>$balance1);
		
    }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	function Balanceother($StaffNo,$i,$balance1)
	{
	$balance =0;$prevailing_amount ='-';$balance2 =0;
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
  
   if($balance1 <0) 
  {
	  $prevailing_amount = $given_amount + $balance1;
 	$balance =  ($prevailing_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
  }else {  
  $balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
   $prevailing_amount = $given_amount ;
     }//echo $balance;
   //$balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
   $balance2= $balance;
$amtspend=($pcf->total-$pcf1->total1)+$pcf2->total2;
 $inid=$_GET['StaffNo'];
  
   //$balance =  ($given_amount-($pcf->total-$pcf1->total1)-$pcf2->total2);
   
//      echo " <tr>  <td align=center>".$_GET['StaffNo']." </td>  <td align=center>".$mysqlStart."</td>
//	<td align=center>".$mysqlEnd."</td><td align=right>$given_amount</td><td align=right>$prevailing_amount</td><td align=right>($pcf->total-$pcf1->total1)+$pcf2->total2</td><td align=right>$balance</td><td><a href='acctcpdasum.php?amount=$prevailing_amount&start=$mysqlStart&end=$mysqlEnd'>summary </a></td>
	
	
//  </tr>" ;
  ?>
    <tr>
    <td align="center"><?php echo "00$inid" ?></td>
	<td align="center"><?php echo "$mysqlStart" ?></td>  
	<td align="center"><?php echo "$mysqlEnd" ?></td>  
	<td align="right"><?php echo "$given_amount" ?></td>  
	<td align="right"><?php echo "$prevailing_amount" ?></td>  
	<td align="right"><?php echo "$amtspend" ?> </td>  
	<td align="right"><?php echo "$balance" ?></td>  
	<td align="center"><?php echo "<a href='acctcpdasum.php?amount=$prevailing_amount&start=$mysqlStart&end=$mysqlEnd'>summary </a>"?></td>  
  </tr>
  <?php
  
     }
	 }
    }
	} 
		 
	}		return array(0=>$i++,1=>$balance2);
		  
		   } 
		
		
		
	?>
 </table>
</div>
 </div>
 </div>
<div id="secondaryContent">

<div id="footer">
</div>
</div>
</div>
</body>
</html>