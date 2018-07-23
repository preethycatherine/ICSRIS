<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.navbar {
    overflow: hidden;	
    background-color: #006699;
    font-family: Arial, Helvetica, sans-serif;
	display: flex;
    justify-content: center;
}

.navbar a {
    float: right;
    font-size: 14px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 14px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: #0099CC;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
</head>
<body>
<div id="header">
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

<div class="navbar">
  <div class="dropdown">
    <button class="dropbtn"><strong>Home </strong>
    </button>
  </div> 
  <div class="dropdown">
    <button class="dropbtn"><strong>Invoices</strong> 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="acctconson_test.php">Create Invoice</a>
      <a href="acctconscl_test.php">Submitted Invoices</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn"><strong>Pay in Slip Details</strong>
    </button>
    <div class="dropdown-content">
    </div>
  </div> 
   <div class="dropdown">
    <button class="dropbtn"><strong>Credit/Debit</strong> 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="acctconson_test.php">Credit Notes</a>
      <a href="acctconscl_test.php">Debit Notes</a>
    </div>
  </div>
 <div class="dropdown">
    <button class="dropbtn"><strong>&nbsp;</strong>
    </button>
    <div class="dropdown-content">
    </div>
  </div> 

</div>


</body>
</html>
