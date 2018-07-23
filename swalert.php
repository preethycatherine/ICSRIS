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
<link href="default.css" rel="stylesheet" type="text/css"/>
<!--<link href="css/style.css" rel="stylesheet" type="text/css" />-->

<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" type="text/css" href="css/magnific-popup.css" />
<link rel="stylesheet" type="text/css" href="css/tabstyles.css" />

<link rel="stylesheet" type="text/css" href="css/sweet-alert.css" />

<link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>   
<link href='https://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="alert/sweetalert.min.js"></script>
   <script>
            $(function showSwal()
				 { 
				 swal("Insurance Submitted!", "Please check your mail for confirmation !", "success")
				 } );
			  

			  
		setInterval(function () {
			var d = new Date();
			var seconds = d.getMinutes() * 60 + d.getSeconds();
			var fiveMin = 60 * 5;
			var timeleft = fiveMin - seconds % fiveMin; 
			var result = parseInt(timeleft / 60) + ':' + timeleft % 60; 
			//document.getElementById('test').innerHTML = result;
		 window.location.href = "Group_Travel_Insurance1.php";
		}, 3000) 

    </script>
  
</head>
<body>
<div id="outer">

<!--=========== BEGIN MENU SECTION ================-->
	 <script src="https://www.w3schools.com/lib/w3.js"></script>
	<div w3-include-html="menu_o.html"></div>
		<script>
		w3.includeHTML();
		</script>
	<!--=========== END MENU SECTION ================--> 
<br /><br />
Time left to next 5 min:
<div id="test"></div>
test page
<button id="btnShowAlert">Show Sweet Alert without click</button>
<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;height:50px;" onclick="showSwal();">
</div>
</body>
</html>