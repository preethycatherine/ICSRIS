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
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
	

	<link href="default.css" rel="stylesheet" type="text/css"/>
<!--	<link href="css/dashboard.css.css" rel="stylesheet" type="text/css"/>-->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
		function myFunction(df){
			//alert('df');
			var res = df.split('-');	
			window.location.href='patent_info_R202_IP_Details.php?subFileNo='+df +'&subfile='+res[0];
		
		}
	</script>

</head>

<body>

<div id="outer">
	<!--<div id="menu">-->
	<!--<div style="font-size:18px; color:#330000; font-weight:bolder; padding-left:8.5em;">ICSR Accounts Information System</div></h4>
	</div>-->
	<!--=========== BEGIN MENU SECTION ================-->
			 <script src="https://www.w3schools.com/lib/w3.js"></script>
			<!--<div w3-include-html="menu_patent.html"></div>-->
				<!--<div w3-include-html="menu_o.html"></div>-->
			<div w3-include-html="menu_o.php"></div>
				<script>
				w3.includeHTML();
				</script>
		    <!--=========== END MENU SECTION ================--> 

		<div id="content">
			<div id="primaryContentContainer">
				<div id="primaryContent">

					
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
							$instid1 = $insid;
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
						<table width="100%" border="1">
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
						<div>
							<nobr>
								<h4><a href="patent_info_R102.php"><span >Indian Filings and Patents</span></a> | <a href="patent_info_R202.php">International Filings and Patents</a> | <a href="patent_info_R102A.php">Tech Transfer Accounts</a>					</h4>
							</nobr>	

						</div><p style="text-align: center;color:darkgoldenrod">Note: Kindly click the File Number for detailed information.</p>
						<?php
						$postTitleOrder1 = "asc";
						$postTitleOrder2 = "desc";


						if ( $orderBy == "fileno"
							and $order == "asc" ) {
							$postTitleOrder1 = "desc";
							echo "enter";
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
						<table border="1" style="text-align: center" width="100%">

							<tr style="background-color: #006699;">
								<th style="color:white;text-align:center;"><span>File No.<br/>
								<a href="?orderby=fileno&order=<?php echo $postTitleOrder1; ?>"><img src="images/up1.png" alt="Ascending"></a>
								
								<a href="?orderby=fileno&order=<?php echo $postTitleOrder2; ?>"><img src="images/down1.png" alt="Descending"></a></span>
								</th>
								<th>
									<div style="color:white; text-align: center">County</div>
								</th>
								<th>
									<div style="color:white; text-align: center">Application No.</div>
								</th>

								<th style="color:white; text-align: center"><span>Filling Date <br/>
									<a href="?orderby=Filing_dt&order=<?php echo $postTitleOrder1; ?>"><img src="images/up1.png" alt="Ascending"></a>

									<a href="?orderby=Filing_dt&order=<?php echo $postTitleOrder2; ?>"><img src="images/down1.png" alt="Ascending"></a></span>
								</th>
								<th>
									<div style="color:white; text-align: center">Grant / Registration No.</div>
								</th>
								<th>
									<div style="color:white; text-align: center">Grant / Registration Date</div>
								</th>


								<th>
									<div style="color:white; text-align: center">Status</div>
								</th>

							</tr>

							<div align="center">
								<?php 
									odbc_close_all();
							
							if (empty($_GET[ "orderby" ] ) )
							{
								$orderBy = "subFileNo";
								$order = "asc";
							}

							if ( !empty( $_GET[ "orderby" ] ) ) {
								$orderBy = $_GET[ "orderby" ];
							}
							if ( !empty( $_GET[ "order" ] ) ) {
								$order = $_GET[ "order" ];
							}
					
							$strsq1="select B.subFileNo,B.Country,B.ApplicationNo,convert(date,B.FilingDt,103) as Filing_dt,B.PatentNo,B.PatentDt,B.TYPE,B.Attorney,B.Status,B.SubStatus from INTERNATIONAL as B 
							WHERE exists (select a.fileno ,A.Title,A.Applcn_no,convert(date,A.Filing_dt,103) as Filing_dt,A.Pat_no,A.Pat_dt,A.Type,A.Attorney,A.Status,A.Sub_Status from PatDetails A
							WHERE B.fileno=A.fileno and A.InstID like '$instid1')order by " .$orderBy . " " . $order;
														
							$process = odbc_exec( $sqlconnect, $strsq1 )or die( "<br> Connection failed at PatentDetails level" );
								while ($row = odbc_fetch_array($process))
								{?>
								<tr>
									<td class="rowA">
										<a href="#"  class="popuplink" data-toggle="popover" title="" data-content="<a href='#' onClick='myFunction(`<?php echo($row['subFileNo']);?>`)'>Parent IDF Details</a>" data-original-title="" data-html="true">
											<?php echo($row['subFileNo']);?>
										</a>



									</td>
									<td class="rowB" id="res">
										<?php echo($row['Country']);?>
										<!--<button onclick="myFunction();">fdg</button>
										<?php echo $res;?>-->

									</td>
									<td class="rowA">
										<?php echo($row['ApplicationNo']);?>
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
									<td class="rowA">
										<?php echo($row['Status']);?>
									</td>
								</tr>
								<?php
								}
								?>
							</div>

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