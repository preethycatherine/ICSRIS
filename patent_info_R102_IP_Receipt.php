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
	<link href="default.css" rel="stylesheet" type="text/css"/>
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
			$('[data-toggle="popover"]').popover();

		} );
	</script>
</head>

<body>

	<div id="outer">
	<!--<div id="header">
	 <table height="75" align="center">			
	 <tr>
	   <td><img src="images/logo.png" width="90" height="90" /></td><td>&nbsp;&nbsp;&nbsp;</td>
	   <td>	
		<h1><a href="icsrisacct.php">Centre for IC & SR</a></h1>
		<h1><a href="icsrisacct.php">Indian Institute of Technology Madras, Chennai</a></h1>
		<h2>IC&SR Project Information System</h2>
	   </td>
	  </tr>
	 </table>
	</div>
	<div id="menu" align="center" >
		<ul>
			<li class="first"><b></b></li>
		</ul>
	</div>-->
		 <script src="https://www.w3schools.com/lib/w3.js"></script>
			<div w3-include-html="menu_patent.html"></div>
				<script>
				w3.includeHTML();
				</script>

		<div id="content">
			<div id="primaryContentContainer">
				<div id="primaryContent">

					<div align="center">
						<h4>
						<a href="patent_info_R102.php" style="padding-left: 800px;" align="right">Back</a></h4>
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
								$strsql1 = "select fileno,title,Inventor1 as Inventor,department,applcn_no as ApplicationNo,convert(date,filing_dt,103) as filing_dt ,pat_no as PatentNo,convert(date,pat_dt,103) as  PatentDt from patdetails where fileno LIKE '$ret'";
							$process = odbc_exec($sqlconnect, $strsql1)or die( "<br> Connection failed at PatentDetails slevel");
											while ($row = odbc_fetch_array($process))
											{?>
						<div align="left" style="font-style:oblique;font-weight: bold;">Receipt Details</div>
						</br>
						<table border="1" width="100%">
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
									<div>Application No.</div>
								</th>
								<td>
									<?php echo($row['ApplicationNo']);?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div>Filling Date</div>
								</th>
								<td>
									<?php echo($row['filing_dt']);?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="25%">
									<div>Inventor</div>
								</th>
								<td>
									<?php echo($row['Inventor']);?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div>Department</div>
								</th>
								<td>
									<?php echo($row['department']);?>
								</td>
							</tr>
							<tr class="rowB">
								<th width="25%">
									<div>Patent No.</div>
								</th>
								<td>
									<?php echo($row['pat_no']);?>
								</td>
							</tr>
							<tr class="rowA">
								<th width="25%">
									<div>Patent Date</div>
								</th>
								<td>
									<?php echo($row['PatentDt']);?>
								</td>
							</tr>

							<?php
							}
							?>


						</table>
						<?php
//						}
//						?>
					<table border="1"  width="100%">
							<tr  style="background-color: #006699;">
								<th width="25%" >
									<div style="color:white; text-align: center"> Submission Date</div>
								</th>
								<th width="25%">
									<div style="color:white;text-align: center"> Transaction Type </div>
								</th>
									<th width="25%">
									<div style="color:white;text-align: center"> Payment Group </div>
								</th>
									<th width="25%">
									<div style="color:white;text-align: center"> Payment Date </div>
								</th>
									<th width="25%">
									<div style="color:white;text-align: center"> Payment Reference </div>
								</th>
									<th width="25%">
									<div style="color:white;text-align: center"> Payment Description </div>
								</th>
									<th width="25%">
									<div style="color:white;text-align: center"> Party </div>
								</th>
									<th width="25%">
									<div style="color:white;text-align: center"> Technology transfer No. </div>
								</th>
								</th>
									<th width="25%">
									<div style="color:white;text-align: center"> Amount in Rupees </div>
								</th>
							</tr>	
							<?php 
							odbc_close_all();
							$strsql = "select EntryDt,FileNo,SlNo,TechTransferNo,Party,PartyRefNo,SubmissionDt,TransType,TransDescription,
							PaymentGroup,PaymentDescription,Currency,ForeignCost,ExRate,dbo.udf_NumberToCurrency((cost_Rs),'IND') as total,PaymentDate,PaymentRef,Year from patentreceipt where fileno = '$ret' order by SlNo";
							$process = odbc_exec($sqlconnect, $strsql)or die( "<br> Connection failed at PatentDetails level");
							
							while ($row = odbc_fetch_array($process))
							{?>
										
						
							<tr class="rowA">								
								<td>
									<?php echo($row['PatentDt']);?>
								</td>
														
								<td>
									<?php echo($row['TransType']);?>
								</td>
															
								<td>
									<?php echo($row['PaymentGroup']);?>
								</td>
														
								<td>
									<?php echo($row['PaymentDate']);?>
								</td>
														
								<td>
									<?php echo($row['PaymentRef']);?>
								</td>
															
								<td>
									<?php echo($row['PaymentDescription']);?>
								</td>
														
								<td>
									<?php echo($row['Party']);?>
								</td>
															
								<td>
									<?php echo($row['TechTransferNo']);?>
								</td>
															
								<td>
									<?php echo($row['total']);?>
								</td>
							</tr>
							<?php
							}
							$strsql1=" select dbo.udf_NumberToCurrency(SUM(cost_Rs),'IND') as total from patentreceipt where fileno like '$ret'";
							
							$process = odbc_exec($sqlconnect, $strsql1)or die( "<br> Connection failed at PatentDetails level");
							 if ( odbc_fetch_row( $process ) ) {
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