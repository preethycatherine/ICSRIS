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
	<script type="text/javascript">
		if ( top != self ) {
			top.location = self.location;
		}
	</script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
		$( document ).ready( function () {
			$( '[data-toggle="popover"]' ).popover();

		} );
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
						<h3>  </h3>
						<a href="patent_info_R102.php" style="padding-left: 800px;" align="right">Back</a>
						
					</div>
					<div align="center">
						<?php

						$ret = $_GET[ 'fileno' ];

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
							$strsq1 = "SELECT Inventor1,DeptCode,InstID FROM PatDetails WHERE fileno LIKE '$ret'";
							$process = odbc_exec( $sqlconnect, $strsq1 )or die( "<br>connection failed" );
							$name = "";
							$dept = "";
							if ( odbc_fetch_row( $process ) ) {
								$name = odbc_result( $process, "Inventor1" );
								$dept = odbc_result( $process, "DeptCode" );

							}
							$today_date = date( "d/m/Y" );
							?>



						<?php 
										odbc_close_all();
							//$strsql1 = "SELECT title,type,InitialFiling,firstApplicant,secondApplicant,request_dt,Specification FROM PatDetails WHERE fileno LIKE '$ret'";		
							$strsql1 = "SELECT title,type,InitialFiling,firstApplicant,secondApplicant,request_dt FROM PatDetails WHERE fileno LIKE '$ret'";	
							$process = odbc_exec($sqlconnect, $strsql1)or die( "<br> Connection failed at PatentDetails level");
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
						<table border="1" width="90%">
							<tr class="rowA">
								<th width="25%">
									<div> INST. ID No.</div>
								</th>
								<td>
									<?php echo "$instid1" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Date </div>
								</th>
								<td>
									<?php echo "$today_date" ?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>CoordinatorName</div>
								</th>
								<td>
									<?php echo "$name" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Department </div>
								</th>
								<td>

									<?php echo "$dept" ?>

								</td>
							</tr>
						</table>
						<?php 
							odbc_close_all();
							$strsql = "select Attorney,Applcn_no,Filing_dt,Examination,Exam_dt,Publication,Pub_dt,Status,Sub_status, Pat_no,Pat_dt from patdetails where fileno LIKE '$ret'";	
							
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

					<?php 
							odbc_close_all();
							$strsql = "select Commercial,InventionNo,Validity_from_dt,Validity_to_dt,Industry1,Industry2,Industry3,IPC_Code,Abstract,DevelopmentStatus,Commercialized,PatentLicense,TechTransNo,Remarks from patdetails where fileno like '$ret'";	
							
							$process = odbc_exec($sqlconnect, $strsql)or die( "<br> Connection failed at PatentDetails level");
								if ( odbc_fetch_row( $process ) ) {
								$Commercial = odbc_result( $process, "Commercial" );
								$InventionNo = odbc_result( $process, "InventionNo" );
								$Validity_from_dt = odbc_result( $process, "Validity_from_dt" );
								$Validity_to_dt = odbc_result( $process, "Validity_to_dt" );
								$Industry1 = odbc_result( $process, "Industry1" );
								$Industry2 = odbc_result( $process, "Industry2" );							
								$Industry3 = odbc_result( $process, "Industry3" );
								$IPC_Code = odbc_result( $process, "IPC_Code" );
								$Abstract = odbc_result( $process, "Abstract" );
								$DevelopmentStatus = odbc_result( $process, "DevelopmentStatus" );
								$Commercialized = odbc_result( $process, "Commercialized" );
								$PatentLicense = odbc_result( $process, "PatentLicense" );
								$TechTransNo = odbc_result( $process, "TechTransNo" );
								$Remarks = odbc_result( $process, "Remarks" );}
							?>
						<div align="left" style="font-style:oblique;font-weight: bold;">Commercialization</div>
						</br>
						<table border="1" width="90%">
							<tr class="rowA">
								<th width="25%">
									<div> Commercialization Responsibility</div>
								</th>
								<td>
									<?php echo "$Commercial" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Partner Reference No. </div>
								</th>
								<td>
									<?php echo "$InventionNo" ?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Valiodating From Date </div>
								</th>
								<td>
									<?php echo "$Filing_dt" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Validating Till Date </div>
								</th>
								<td>
									<?php echo "$Validity_to_dt" ?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Industry</div>
								</th>
								<td>
									<?php echo "$Industry1" ?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Industry2 </div>
								</th>
								<td>
									<?php echo "$Industry2" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Usage Area</div>
								</th>
								<td>
									<?php echo "Industry3" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>International Patent Classification (IPC) Code </div>
								</th>
								<td>
									<?php echo "$IPC_Code" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Abstract (Value Proposition) </div>
								</th>
								<td>
									<?php echo "$Abstract" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Development Status </div>
								</th>
								<td>
									<?php echo "$DevelopmentStatus" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Commercialization status </div>
								</th>
								<td>
									<?php echo "$Commercialized" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Patent Agreement </div>
								</th>
								<td>
									<?php echo "$PatentLicense" ?> </td>
							</tr>
							<tr class="rowA">
								<th width="20%">
									<div>Technology Transfer No. / Marketing No. </div>
								</th>
								<td>
									<?php echo "$TechTransNo" ?> </td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Remark </div>
								</th>
								<td>
									<?php echo "$Remarks" ?> </td>
							</tr>
						</table>					
					
						<!--<div align="left" style="font-style:oblique;font-weight: bold;">Supporting Documents</div>
						</br>
						<table border="1" width="90%" >
							<tr  style="background-color: firebrick;">
								<th width="25%" align-content: center>
									<div style="color:white; text-align: center" > File Description</div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center"> File Name</div>
								</th>
								
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div> IDF</div>
								</th>
								<td>
									
								</td>
							</tr>
							<tr class="rowB">
								<th width="20%">
									<div>Patent Certificate  </div>
								</th>
								<td>
									
								</td>
							</tr>
							
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
		}
		//}
		?>
		<div id="footer">
			<p></p>
		</div>
	</div>
</body>

</html>