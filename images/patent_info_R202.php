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
	</script>
	<script>
		$( document ).ready( function () {
			$( '[data-toggle="popover"]' ).popover();
			$( '.popuplink' ).on( "click", function ( e ) {
				e.preventDefault();
			} );

			$( '.popuplink' ).click( function ( e ) {
				$( '.popuplink' ).not( this ).popover( 'hide' );
				$( this ).popover( "toggle" );
				e.stopPropagation();
			} );

			$( document ).click( function ( e ) {
				if ( ( $( '.popover' ).has( e.target ).length == 0 ) || $( e.target ).is( '.close' ) ) {
					$( '.popuplink' ).popover( 'hide' );
				}
			} );
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
			<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div>
			</h2>
		</div>

		<div id="content">
			<div id="primaryContentContainer">
				<div id="primaryContent">

					<div align="center">
						<h3> Patent Information </h3>
					</div>
					<div align="center">
						<?php

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
							$sqlconnect = odbc_connect( "$dsn", "$username", "$password" )or die( "ODBC Connection Faileddd" );


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
							$strsq1 = "SELECT Inventor1,DeptCode,InstID FROM PatDetails WHERE InstID LIKE '$instid1'";
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
									<div align="right" style="color:#2A0000"> INST. ID No.:</div>
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
						<div>
							<nobr>
								<a href="patent_info_R102.php"><span>Indian Patent Status</span></a> | <a href="patent_info_R202.php">International Patent Status</a> | <a href="patent_info_R102A.php">Receipt and Payment Summary</a> </h4>
							</nobr>

						</div><br/>
						<?php
						$postTitleOrder1 = "asc";
						$postTitleOrder2 = "desc";


						if ( $orderBy == "fileno"
							and $order == "asc" ) {
							$postTitleOrder1 = "desc";
							echo "enterdf";
						}
						if ( $orderBy == "fileno"
							and $order == "desc" ) {
							$postTitleOrder1 = "asc";
						}

						if ( $orderBy == "Filing_dt"
							and $order == "asc" ) {
							echo "enter";
							$postTitleOrder2 = "desc";
						}
						if ( $orderBy == "Filing_dt"
							and $order == "desc" ) {
							$postTitleOrder1 = "asc";
						}

						?>
						<table border="1" width="60%" ">

							<tr style="background-color: #5C402B;">
								<th width="30%" style="color:white; text-align: center"><span>File No.
								<a href="?orderby=fileno&order=<?php echo $postTitleOrder1; ?>"><img src="img/up1.png" alt="Ascending"></a>
								
								<a href="?orderby=fileno&order=<?php echo $postTitleOrder2; ?>"><img src="img/down1.png" alt="Descending"></a>
								</th>
								<th width="25%">
									<div style="color:white; text-align: center">Title</div>
								</th>
								<th width="25%">
									<div style="color:white; text-align: center">Application No.</div>
								</th>
								
								<th width="30%" style="color:white; text-align: center"><span>Filling Dt.<br/>
									<a href="?orderby=Filing_dt&order=<?php echo $postTitleOrder1; ?>"><img src="img/up1.png" alt="Ascending"></a>

									<a href="?orderby=Filing_dt&order=<?php echo $postTitleOrder2; ?>"><img src="img/down1.png" alt="Ascending"></a>
								</th>
								<th width="15%">
									<div style="color:white; text-align: center">Patent No.</div>
								</th>
								<th width="15%">
									<div style="color:white; text-align: center">Patent Dt.</div>
								</th>
								<th width="15%">
									<div style="color:white; text-align: center">Type</div>
								</th>
								<th width="15%">
									<div style="color:white; text-align: center">Attorney</div>
								</th>
								<th width="15%">
									<div style="color:white; text-align: center">Status</div>
								</th>
								<th width="15%">
									<div style="color:white; text-align: center">Sub Status</div>
								</th>
							</tr>
							<tr>
								<div align="center">
									<?php 
										odbc_close_all();
							
							
							if ( empty( $_GET[ "orderby" ] ) )
							{
								$orderBy = "Filing_dt";
								$order = "asc";
							}

							if ( !empty( $_GET[ "orderby" ] ) ) {
								$orderBy = $_GET[ "orderby" ];
							}
							if ( !empty( $_GET[ "order" ] ) ) {
								$order = $_GET[ "order" ];
							}
									/*$strsq1="select a.fileno,A.Title,A.Applcn_no,A.Filing_dt,A.Pat_no,A.Pat_dt,A.Type,A.Attorney,A.Status,A.Sub_Status
									from  PatDetails as a
									WHERE exists
									(select B.subFileNo,B.Country,B.ApplicationNo,B.FilingDt,B.PatentNo,B.PatentDt,B.TYPE,B.Attorney,B.Status,B.SubStatus from INTERNATIONAL B
									WHERE  A.fileno=B.fileno and A.InstID like '$instid1')
									union 
									select B.subFileNo,B.Country,B.ApplicationNo,B.FilingDt,B.PatentNo,B.PatentDt,B.TYPE,B.Attorney,B.Status,B.SubStatus
									from  INTERNATIONAL as B
									WHERE  exists
									(select  a.fileno,A.Title,A.Applcn_no,A.Filing_dt,A.Pat_no,A.Pat_dt,A.Type,A.Attorney,A.Status,A.Sub_Status from PatDetails A
									WHERE B.fileno=A.fileno and A.InstID like '$instid1')";*/
							
							
				
							
													
							$strsq1="select a.fileno ,A.Title,A.Applcn_no,A.Filing_dt,A.Pat_no,A.Pat_dt,A.Type,A.Attorney,A.Status,A.Sub_Status from PatDetails as a 
WHERE exists 
(select B.subFileNo,B.Country,B.ApplicationNo,B.FilingDt,B.PatentNo,B.PatentDt,B.TYPE,B.Attorney,B.Status,B.SubStatus from INTERNATIONAL B WHERE A.fileno=B.fileno and A.InstID like '$instid1') 
union
select B.subFileNo,B.Country,B.ApplicationNo,B.FilingDt,B.PatentNo,B.PatentDt,B.TYPE,B.Attorney,B.Status,B.SubStatus from INTERNATIONAL as B 
WHERE exists
(select a.fileno ,A.Title,A.Applcn_no,A.Filing_dt,A.Pat_no,A.Pat_dt,A.Type,A.Attorney,A.Status,A.Sub_Status from PatDetails A
 WHERE B.fileno=A.fileno and A.InstID like '$instid1')order by " .$orderBy . " " . $order ;
							
									$process = odbc_exec( $sqlconnect, $strsq1 )or die( "<br> Connection failed at PatentDetails level" );
											while ($row = odbc_fetch_array($process))
											{?>
									<tr>
										<td class="rowA">
											<a href="#" class="popuplink" data-toggle="popover" title="" data-content="<a href='patent_info_R102_IP_Details.php?fileno=<?php echo $row['fileno'];?>'>IP Details</a> <br/><a href='patent_info_R301_Payment_Details.php?fileno=<?php echo $row['fileno'];?>'>Payment Details</a><br/>
											<a href='patent_info_R102_IP_Receipt.php?fileno=<?php echo $row['fileno'];?>'>Receipt Details</a>" data-original-title="" data-html="true">
												<?php echo($row['fileno']);?>
											</a>


										</td>
										<td class="rowB">
											<?php echo($row['Title']);?>
										</td>
										<td class="rowA">
											<?php echo($row['Applcn_no']);?>
										</td>
										<td class="rowB">
											<?php echo($row['Filing_dt']);?>
										</td>
										<td class="rowA">
											<?php echo($row['Pat_no']);?>
										</td>
										<td class="rowB">
											<?php echo($row['Pat_dt']);?>
										</td>
										<td class="rowB">
											<?php echo($row['Type']);?>
										</td>
										<td class="rowA">
											<?php echo($row['Attorney']);?>
										</td>
										<td class="rowA">
											<?php echo($row['Status']);?>
										</td>
										<td class="rowA">
											<?php echo($row['Sub_Status']);?>
										</td>


									</tr>
									<?php
									}
									?>
								</div>
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
			<h3>DASHBOARD</h3>
			<p>
				<ul>
					<li><a href="patent_info.php">Patent Information</a>
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