<?php
//print_r(PDO::getAvailableDrivers());
class Connection
{
	private $host="10.24.0.162";
	private $dbname="icsriitmdb";
	private $user="icsriitm";
	private $pass="icsr09iitm";
	public function dbConnect()
	{
		$dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
		$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		return $dbh;
	}
}
?>