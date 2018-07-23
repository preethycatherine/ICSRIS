<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
	Design by Free CSS Templates
	http://www.freecsstemplates.org
	Released for free under a Creative Commons Attribution 2.5 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>ICSR ACCOUNTS</title>
	<meta name="keywords" content=""/>
	<meta name="description" content=""/>
	<link href="default_test.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		if ( top != self ) {
			top.location = self.location;
		}

		$( document ).ready( function () {
			$( '[data-toggle="popover"]' ).popover();

		} );


		//function myFunction() {
		//var str = "1363-B";
		//var res = str.split('-');
		//var str = $( "#subFileNo" ).val()
		//var str = '<?php echo $_GET['subFileNo'];?>'
		//var res = str.split('-');
		//	alert (res[0]);
		//window.location.href=window.location.href+'&test=';

		//}
	</script>
</head>

<body>

	<div id="outer">
		<div id="header">
			<h1><a href="icsrisacct_test.php">Centre for IC & SR</a></h1>
			<h1><a href="icsrisacct_test.php">Indian Institute of Technology Madras, Chennai</a></h1>
			<h2>Information System</h2>
		</div>
		<div id="menu">
			<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">Patent Information System</div>
			</h2>
		</div>

		<div id="content">
			<div id="primaryContentContainer">
				<div id="primaryContent">

					<div align="center">
						<h3> </h3>
						<a href="patent_info_R202.php" style="padding-left: 800px;" align="right">Back</a>
					</div>
					<div align="center">
						<input type="hidden" id="subFileNo" value="<?php echo $_GET[ 'subFileNo' ]?>"/>



						<?php
						$ret = $_GET[ 'subFileNo' ];
						$ret1 = $_GET[ 'subfile' ];

						if ( !isset( $_COOKIE[ "PHPSESSID" ] ) ) {
							//echo "<br>session destroy ";
							session_destroy();
							setcookie( "PHPSESSID", "", time() - 3600, "/" );
							header( 'location: https://icsris.iitm.ac.in/ICSRIS/index.php' );
							exit;

						} else {
							session_start();
							if ( $_SESSION[ 'instid' ] ) {
								$insid = $_SESSION[ 'instid' ];
								$usermode = $_SESSION[ 'usermode' ];

							} else {
								session_destroy();
								setcookie( "PHPSESSID", "", time() - 3600, "/" );
								header( 'location: https://icsris.iitm.ac.in/ICSRIS/index.php' );
								exit;
							}
							$dsn = "Patent";
							$username = "sa";
							$password = "IcsR@123#";
							$instid1 = "";
							$sqlconnect = odbc_connect( "$dsn", "$username", "$password" )or die( "ODBC Connection Failed" );
							if ( !isset( $_SESSION[ 'patentid' ] ) ) {
								$patentid = $_REQUEST[ 'irno' ];
								$instid1 = $patentid;
								session_register( "patentid" );
								$_SESSION[ 'patentid' ] = $patentid;
							} else {
								$instid1 = $_SESSION[ 'patentid' ];
								$usermode = $_SESSION[ 'usermode' ];
							}
							$instid1 = $insid;
							$usermode = $_SESSION[ 'usermode' ];
							$strsq1 = "SELECT Inventor1,DeptCode,InstID FROM PatDetails WHERE fileno LIKE '$ret1'";


							$process = odbc_exec( $sqlconnect, $strsq1 )or die( "<br>connection failed" );
							$name = "";
							$dept = "";
							if ( odbc_fetch_row( $process ) ) {
								$name = odbc_result( $process, "Inventor1" );
								$dept = odbc_result( $process, "DeptCode" );

							}
							$today_date = date( "d/m/Y" );
							?>

						<table width="90%" style="background-color:#F6EECC">
							<tr>
								<th width="25%">
									<div align="right" style="color:#2A0000"> INST. ID No. :</div>
								</th>
								<td width="25%">
									<b>
										<div align="left">
											<?php echo "$instid1" ?>
										</div>
									</b>
								</td>
								<th width="20%">
									<div align="right" style="color:#2A0000">Date :</div>
								</th>
								<td>
									<b>
										<div align="left">
											<?php echo "$today_date" ?>
										</div>
									</b>
								</td>
							</tr>
							<tr>
								<th>
									<div align="right" style="color:#2A0000">CoordinatorName :</div>
								</th>
								<td>
									<b>
										<div align="left">
											<?php echo "$name" ?>
										</div>
									</b>
								</td>
								<th>
									<div align="right" style="color:#2A0000">Department :</div>
								</th>
								<td>
									<b>
										<div align="left">
											<?php echo "$dept" ?>
										</div>
									</b>
								</td>
							</tr>
						</table>

						<?php 
							odbc_close_all();
						//$strsql1 = "SELECT title,type,InitialFiling,firstApplicant,secondApplicant,request_dt,Specification FROM PatDetails WHERE fileno LIKE '$ret'";	
							$strsql1 = "SELECT title,type,InitialFiling,firstApplicant,secondApplicant,convert(nvarchar(10),request_dt,103) as request_dt FROM PatDetails WHERE fileno LIKE '$ret1'";
							//echo $strsql1;
														
							$process = odbc_exec($sqlconnect, $strsql1)or die( "<br> Connection failed at PatentDetails slevel");
							while ($row = odbc_fetch_array($process))
							{?>



						<div align="left" style="font-style:oblique;font-weight: bold;">IDF Details</div>
						</br>
						<table border="1" width="90%">
							<tr class="rowA">
								<th width="25%">
									<div>Title</div>
								</th>
								<td>
									<?php echo($row['title']);?>

								</td>
							</tr>
							<tr class="rowB">
								<th width="25%">
									<div>IDF Type</div>
								</th>
								<td>
									<?php echo($row['type']);?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div>Initial Filling</div>
								</th>
								<td>
									<?php echo($row['InitialFiling']);?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="25%">
									<div>First Applicant</div>
								</th>
								<td>
									<?php echo($row['firstApplicant']);?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div>Second Applicant</div>
								</th>
								<td>
									<?php echo($row['secondApplicant']);?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="25%">
									<div>Request State</div>
								</th>
								<td>
									<?php echo($row['request_dt']);?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div>Write Up</div>
								</th>
								<td>
									<?php echo($row['Specification']);?>
								</td>
							</tr>

							<?php
							}
							?>


						</table>
						<?php
						//						}
						//						?>
						<div align="left" style="font-style:oblique;font-weight: bold;">Inventor Details</div>
						</br>
						<table border="1">
							<tr class="rowA" style="background-color: #5C402B;">
								<th style="color:white;">
									<div align="center">S.No.</div>
								</th>
								<th style="color:white;">
									<div align="center"> Inventor ID</div>
								</th>
								<th style="color:white;">
									<div align="center">Inventor Name </div>
								</th>
								<th style="color:white;">
									<div align="center">Inventor Type</div>
								</th>
								<th style="color:white;">
									<div align="center">Department </div>
								</th>
							</tr>
							<?php 
							odbc_close_all();
							$strsql = "select SlNo+1 as SlNo,InventorName,InventorType,InventorID,DeptOrOrganisation as Dept from coinventordetails where fileno like '$ret1' union 
							select 1 as SlNo,Inventor1 as InventorName,InventorType,InstID as InventorID,Department as Dept from patdetails where fileno like '$ret1'";	
							$process = odbc_exec($sqlconnect, $strsql)or die( "<br> Connection failed at PatentDetails level");
							while ($row = odbc_fetch_array($process))
							{							
							?>
							<tr>
								<td class="rowA" style="text-align:center;width:20px;">
									<?php echo ($row['SlNo']); ?>
								</td>
								<td class="rowB" style="text-align:center;width:20px;">
									<?php echo ($row['InventorID']); ?>
								</td>
								<td class="rowA" align="center">
									<?php echo ($row['InventorName']); ?>
								</td>
								<td class="rowB" align="center">
									<?php echo ($row['InventorType']); ?>
								</td>
								<td class="rowA">
									<?php echo ($row['Dept']); ?>
								</td>
							</tr>

							<?php }?>
						</table>
						<?php 
							odbc_close_all();
							$strsql = "select Attorney,Applcn_no, convert(nvarchar(10),Filing_dt,103) as Filing_dt ,Examination, convert(nvarchar(10),Exam_dt,103) as Exam_dt,Publication,convert(nvarchar(10),Pub_dt,103) as Pub_dt,Status,Sub_status, Pat_no,Pat_dt from patdetails where fileno LIKE '$ret1'";	
							
							$process = odbc_exec($sqlconnect, $strsql)or die( "<br> Connection failed at PatentDetails level");
								if ( odbc_fetch_row( $process ) ) {
								$Attorney = odbc_result( $process, "Attorney" );
								$Applcn_no = odbc_result( $process, "Applcn_no" );
								$Filing_dt = odbc_result( $process, "Filing_dt" );
								$Examination = odbc_result( $process, "Examination" );
								$Exam_dt = odbc_result( $process, "Exam_dt" );
								$Publication = odbc_result( $process, "Publication" );							
								$Status = odbc_result( $process, "Status" );
								$Sub_status = odbc_result( $process, "Sub_status" );
								$Pat_no = odbc_result( $process, "Pat_no" );
								$Pub_dt = odbc_result( $process, "Pub_dt" );}
							?>
						<div align="left" style="font-style:oblique;font-weight: bold;">Indian Patent Status</div>
						</br>
						<table border="1" width="90%">
							<tr class="rowA">
								<th width="25%">
									<div> Attorney</div>
								</th>
								<td>
									<?php echo "$Attorney" ?>
									<!--<button onclick="myFunction();">fdg</button>
										<?php echo $res;?>-->
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Application Number </div>
								</th>
								<td>
									<?php echo "$Applcn_no" ?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Filling Date </div>
								</th>
								<td>
									<?php echo "$Filing_dt" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Examination </div>
								</th>
								<td>
									<?php echo "$Examination" ?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Examination Date</div>
								</th>
								<td>
									<?php echo "$Exam_dt" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Publication </div>
								</th>
								<td>
									<?php echo "$Publication" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Publication Date</div>
								</th>
								<td>
									<?php echo "$Pub_dt" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Patent Status </div>
								</th>
								<td>
									<?php echo "$Status" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Patent Sub Status </div>
								</th>
								<td>
									<?php echo "$Sub_status" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Patent Grant Number </div>
								</th>
								<td>
									<?php echo "$Pat_no" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Patent Issue Date </div>
								</th>
								<td>
									<?php echo "$Pat_dt" ?> </td>
							</tr>
						</table>
						<div align="left" style="font-style:oblique;font-weight: bold;">Internationl Patent Status</div>
						<?php 
							odbc_close_all();
							$strsql = "select subFileNo,RequestDt,Country,partner,PartnerNo,type,Attorney,ApplicationNo
,convert(date,FilingDt,103) as dt,PublicationNo,convert(date,PublicationDt,103) as pbdt,
Status,SubStatus,PatentNo,PatentDt,Remark from international  where subFileNo like '$ret'";	
							//echo $strsql;
							$process = odbc_exec($sqlconnect, $strsql)or die( "<br> Connection failed at PatentDetails level");
								if ( odbc_fetch_row( $process ) )
								{
								$subFileNo = odbc_result( $process, "subFileNo" );
								$RequestDt = odbc_result( $process, "RequestDt" );
								$Country = odbc_result( $process, "Country" );
								$partner = odbc_result( $process, "partner" );
								$PartnerNo = odbc_result( $process, "PartnerNo" );
								$type = odbc_result( $process, "type" );							
								$Attorney = odbc_result( $process, "Attorney" );
								$ApplicationNo = odbc_result( $process, "ApplicationNo" );
								$dt= odbc_result( $process, "dt" );
								$PublicationNo = odbc_result( $process, "PublicationNo" );
								$pbdt = odbc_result( $process, "pbdt" );
								$Status = odbc_result( $process, "Status" );
								$SubStatus = odbc_result( $process, "SubStatus" );
								$PatentNo = odbc_result( $process, "PatentNo" );
								$PatentDt = odbc_result( $process, "PatentDt" );
								$Remark = odbc_result( $process, "PatentDt" );
								}
							?>

						</br>      
						<table border="1" width="90%">
							<tr class="rowA">
								<th width="25%">
									<div> SubFile No. </div>
								</th>
								<td>
									<?php echo "$subFileNo" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Request Date </div>
								</th>
								<td>
									<?php echo "$RequestDt" ?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Country </div>
								</th>
								<td>
									<?php echo "$Country" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Partner </div>
								</th>
								<td>
									<?php echo "$partner" ?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Partner No.</div>
								</th>
								<td>
									<?php echo "$PartnerNo" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Type </div>
								</th>
								<td>
									<?php echo "$type" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Attorney</div>
								</th>
								<td>
									<?php echo "$Attorney" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Application No. </div>
								</th>
								<td>
									<?php echo "$ApplicationNo" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Filling Date </div>
								</th>
								<td>
									<?php echo "$dt" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Publication No. </div>
								</th>
								<td>
									<?php echo "$PublicationNo" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Publication Date </div>
								</th>
								<td>
									<?php echo "$pbdt" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Status </div>
								</th>
								<td>
									<?php echo "$Status" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>SubStatus </div>
								</th>
								<td>
									<?php echo "$SubStatus" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Patent No. </div>
								</th>
								<td>
									<?php echo "$PatentNo" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Patent Date </div>
								</th>
								<td>
									<?php echo "$PatentDt" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Remark </div>
								</th>
								<td>
									<?php echo "$Remark" ?> </td>
							</tr>
						</table>
						<!--<div align="left" style="font-style:oblique;font-weight: bold;">Supporting Documents</div>
						</br>
						<table border="1" width="90%" >
							<tr  style="background-color: firebrick;">
								<th width="25%" align-content: center>
									<div style="color:white; text-align: center"> File Description</div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center"> File Name</div>
								</th>
							</tr>					
							<?php 
							odbc_close_all();
							$strsql = "select  filedescription,FileName from PatentFileDetails where fileno like '$ret'";
							$process = odbc_exec($sqlconnect, $strsql)or die( "<br> Connection failed at PatentDetails level");
							while ($row = odbc_fetch_array($process))
							{?>
							<tr class="rowA">
								<th width="20%">								
									<div><?php echo($row['filedescription']);?>  </div>
								</th>
								<td>
									<a href="<?php echo($row['FileName']);?>"><?php echo($row['FileName']);?></a>
								</td>
							</tr>
						
						<?php
							}?>
						</table>-->
						<?php
						}
						?>
					</div>
				</div>
			</div>
			<?php
			if ( strcmp( $usermode, "SUPER" ) == 0 ) {
				?>
			<div id="secondaryContent">
				<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a>
				</div>
				<h3>Sponsored Project</h3>
				<?php
				if ( isset( $_SESSION[ "sponresult" ] ) ) {
					?>
				<p>
					<ul>
						<li><a href="acctspquery.php">Sponsor Query</a>
						</li>
						<li><a href="acctspresult.php">Sponsor Result</a>
						</li>
					</ul>
				</p>
				<?php
				} else {
					?>
				<p>
					<ul>
						<li><a href="acctspquery.php">Sponsor Query</a>
						</li>
					</ul>
				</p>
				<?php
				}
				?>
				<h3>Consultancy Project</h3>
				<?php
				if ( isset( $_SESSION[ "consresult" ] ) ) {
					?>
				<p>
					<ul>
						<li><a href="acctcpquery.php">Consultancy Query</a>
						</li>
						<li><a href="acctcpresult.php">Consultancy Result</a>
						</li>
					</ul>
				</p>
				<?php
				} else {
					?>
				<p>
					<ul>
						<li><a href="acctcpquery.php">Consultancy Query</a>
						</li>
					</ul>
				</p>
				<?php
				}
				?>
				<h3>PCF</h3>
				<?php
				if ( isset( $_SESSION[ "pcfresult" ] ) ) {
					?>
				<p>
					<ul>
						<li><a href="acctpcfquery.php">PCF Query</a>
						</li>
						<li><a href="acctpcfresult.php">PCF Result</a>
						</li>
					</ul>
				</p>
				<?php
				} else {
					?>
				<p>
					<ul>
						<li><a href="acctpcfquery.php">PCF Query</a>
						</li>
					</ul>
				</p>
				<?php
				}
				?>
				<h3>RMF</h3>
				<?php
				if ( isset( $_SESSION[ "rmfresult" ] ) ) {
					?>
				<p>
					<ul>
						<li><a href="acctrmfquery.php">RMF Query</a>
						</li>
						<li><a href="acctrmfresult.php">RMF Result</a>
						</li>
					</ul>
				</p>
				<?php
				} else {
					?>
				<p>
					<ul>
						<li><a href="acctrmfquery.php">RMF Query</a>
						</li>
					</ul>
				</p>
				<?php
				}
				?>
				<h3>Cheque Details</h3>
				<p>
					<ul>
						<li><a href="chequedetails.php">Pending Cheques Details</a>
						</li>
					</ul>
				</p>
			</div>
			<div class="clear"></div>
		</div>
		<?php
		} else {
			?>
		<div id="secondaryContent">
			<div align="right" class="rowA"><a href="signout.php"><strong>Signout</strong></a>
			</div>
			<h3>Unidentified Grant Receipts</h3>
			<p>
				<ul>
					<li><a href="pendingreceipts.php">Unidentified Grant Receipts </a>
					</li>
				</ul>
			</p>
			<?php
			$dsn = "FACCTDSN";
			$username = "sa";
			$password = "IcsR@123#";
			$instid1 = $insid;
			$sqlconnect = odbc_connect( "$dsn", "$username", "$password" )or die( "ODBC Connection Failed" );
			$strsql = "select * from webauthReim where instid like '$instid1'";
			//echo "$strsql";
			$process = odbc_exec( $sqlconnect, $strsql )or die( "Query Execution Failed" );
			if ( odbc_fetch_row( $process ) ) {
				?>
			<h3>Bank Imprest Account</h3>
			<p>
				<ul>
					<li><a href="acctsimprest.php">Imprest Account</a>
					</li>
				</ul>
			</p>
			<?php
			}
			odbc_close_all();
			?>
			<h3>Sponsored Project</h3>
			<p>
				<ul>
					<li><a href="acctsponon.php">Ongoing Projects</a>
					</li>
					<li><a href="acctsponcl.php">Closed Projects</a>
					</li>
				</ul>
			</p>
			<h3>Consultancy Project</h3>
			<p>
				<ul>
					<li><a href="acctconson.php">Ongoing Projects</a>
					</li>
					<li><a href="acctconscl.php">Closed Projects</a>
					</li>
				</ul>
			</p>
			<?php

			mysql_connect( "eservices", "cpdaread", "Cpda@Read!1" );
			mysql_select_db( "cpda" )or die( "msql connection error" );

			$q = mysql_query( "select access from staff_details where StaffNo='" . $insid . "' and Status='Active' " );
			$rowcount = mysql_num_rows( $q );
			//echo $insid;
			//echo $rowcount;
			if ( ( $rowcount == 1 ) ) {
				while ( $row = mysql_fetch_array( $q ) ) {
					//echo $row["access"];
					if ( $row[ "access" ] == 'Yes' ) {

						?>
			<h3>PCF / RMF / CPDA </h3>
			<p>
				<ul>
					<li><a href="acctpcfsum.php">PCF Account</a>
					</li>
					<li><a href="acctrmfsum.php">RMF Account</a>
					</li>
					<li><a href="CPDA/batch.php">CPDA</a>
					</li>
				</ul>
			</p>
			<?php
			} else {
				?>
			<h3>PCF / RMF </h3>
			<p>
				<ul>
					<li><a href="acctpcfsum.php">PCF Account</a>
					</li>
					<li><a href="acctrmfsum.php">RMF Account</a>
					</li>
				</ul>
			</p>
			<?php
			}
			}
			}
			?>
			<h3>SBI Credit Details</h3>
			<p>
				<ul>
					<li><a href="sbicreditdetails.php">Direct Credit Details</a>
					</li>
				</ul>
			</p>
			<h3>Cheque Details</h3>
			<p>
				<ul>
					<li><a href="chequedetails.php">Pending Cheques Details</a>
					</li>
				</ul>
			</p>
			<h3>IPR DASHBOARD</h3>
			<p>
				<ul>
					<li style="margin-right:-20px;"><a href="patent_info_R102.php">IPR Indian Information</a>
					</li>
					<li><a style="margin-right:-60px;" href="patent_info_R202.php">IPR International Information</a>
					</li>
					<li><a style="margin-right:-320px;" href="patent_info_R102A.php">Summary of Cost and Receipt</a>
					</li>
				</ul>
			</p>

		</div>

		<div class="clear"></div>
		<!--</div>-->
		<?php
		}
		//}
		?>
		<div id="footer">
			<p></p>
		</div>
	</div>
</body>

</html>