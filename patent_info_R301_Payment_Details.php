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
	<!--<div id="menu">-->
	<!--<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h4>
	</div>-->
	<!--=========== BEGIN MENU SECTION ================-->
			 <script src="https://www.w3schools.com/lib/w3.js"></script>
			<div w3-include-html="menu_patent.html"></div>
				<script>
				w3.includeHTML();
				</script>
		    <!--=========== END MENU SECTION ================--> 

		<div id="content">
			<div id="primaryContentContainer">
				<div id="primaryContent">

					<div align="center">
						<h3> Patent Information </h3>
						<h4><a href="patent_info_R102.php" style="padding-left: 800px;" align="right">Back</a></h4>
						
					</div>
					<div align="center">
						<?php

						$ret = $_GET[ 'fileno' ];

						if ( !isset( $_COOKIE[ "PHPSESSID" ] ) ) {
							//echo "<br>session destroy ";
							session_destroy();
							setcookie( "PHPSESSID", "", time() - 3600, "/" );
							header( 'location: index.php' );
							exit;

						} else {
							session_start();
							if ( $_SESSION[ 'instid' ] ) {
								$insid = $_SESSION[ 'instid' ];
								$usermode = $_SESSION[ 'usermode' ];
							} else {
								session_destroy();
								setcookie( "PHPSESSID", "", time() - 3600, "/" );
								header( 'location: index.php' );
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
							$strsql1 = "SELECT FileNo,Title,Applcn_no,Filing_dt,Inventor1,Department,Pat_no,Pat_dt FROM PatDetails WHERE FileNo LIKE '$ret'";	
							$process = odbc_exec($sqlconnect, $strsql1)or die( "<br> Connection failed at PatentDetails level");
											while ($row = odbc_fetch_array($process))
											{?>
						<div align="left" style="font-style:oblique;font-weight: bold;">Payment Details</div>
						</br>
						<table border="1" width="100%">
							<tr class="rowA">
								<th width="25%">
									<div>File No.</div>
								</th>
								<td>
									<?php echo($row['FileNo']);?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="25%">
									<div>Title</div>
								</th>
								<td>
									<?php echo($row['Title']);?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div>Application No.</div>
								</th>
								<td>
									<?php echo($row['Applcn_no']);?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="25%">
									<div>Filing Date</div>
								</th>
								<td>
									<?php echo($row['Filing_dt']);?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div>Inventor</div>
								</th>
								<td>
									<?php echo($row['Inventor1']);?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="25%">
									<div>Department</div>
								</th>
								<td>
									<?php echo($row['Department']);?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div>Patent No.</div>
								</th>
								<td>
									<?php echo($row['Pat_no']);?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="25%">
									<div>Patent Date</div>
								</th>
								<td>
									<?php echo($row['Pat_dt']);?>
								</td>
							</tr>

							<?php
							}
							?>
						</table>
						<?php
//						}
//						?>
						<?php
						}
						?>
						<table border="1" width="100%">
							<tr style="background-color: #5C402B;">
								<th width="25%" align-content: center>
									<div style="color:white; text-align: center"> Date</div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center"> Cost Group </div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center"> Activity </div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center">Invoice No. </div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center">Invoice date</div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center"> Payment Reference </div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center"> Party Group</div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center"> Party </div>
								</th>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center"> Amount</div>
								</th>
							</tr>
							<?php 
							odbc_close_all();
							$strsql = "SELECT PaymentOrChequeDt,CostGroup,Activity,InvoiceNo,InvoiceDt,PaymentRefOrChequeNo,PType,Party,dbo.udf_NumberToCurrency(PaymentAmtINR,'IND') as amount FROM PatentPayment WHERE FileNo like '$ret' ";
							$process = odbc_exec($sqlconnect, $strsql)or die( "<br> Connection failed at PatentPayment level");
							
							while ($row = odbc_fetch_array($process))
							{?>


							<tr class="rowA">
								<td>
									<?php echo($row['PaymentOrChequeDt']);?>
								</td>

								<td>
									<?php echo($row['CostGroup']);?>
								</td>

								<td>
									<?php echo($row['Activity']);?>
								</td>

								<td>
									<?php echo($row['InvoiceNo']);?>
								</td>

								<td>
									<?php echo($row['InvoiceDt']);?>
								</td>

								<td>
									<?php echo($row['PaymentRefOrChequeNo']);?>
								</td>

								<td>
									<?php echo($row['PType']);?>
								</td>

								<td>
									<?php echo($row['Party']);?>
								</td>

								<td>
									<?php echo($row['amount']);?>
								</td>
							</tr>
							<?php
							}
							$strsql1 = " select dbo.udf_NumberToCurrency(SUM(PaymentAmtINR),'IND') as total from PatentPayment where FileNo= '$ret'";

							$process = odbc_exec( $sqlconnect, $strsql1 )or
								die( "<br> Connection failed at PatentDetails level" );
							if ( odbc_fetch_row( $process ) ) 
							{
								$tot = odbc_result( $process, "total" );

							}
							?>
							<tr class="rowA">
								<th width="25%">
									<div>Total</div>
								</th>
								<td colspan=8 align="right">
									<?php echo "$tot"?>
								</td>
							</tr>
						</table>
						
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
			<h3>IP DASHBOARD</h3>
			<ul>
					<li style="margin-right:-20px;"><a href="patent_info_R102.php">Indian Filings and Patents</a>
					</li>
					<li><a style="margin-right:-60px;" href="patent_info_R202.php">International Filings and Patents</a>
					</li>
					<li><a style="margin-right:-320px;" href="patent_info_R102A.php">Tech Transfer Accounts</a>
					</li>    
				</ul>


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