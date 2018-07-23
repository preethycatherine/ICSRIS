<?php
//print_r(PDO::getAvailableDrivers());
class Connection
{
	private $host="localhost";
	private $dbname="icsris";
	private $user="icsris";
	private $pass="icsris@admin";
	public function dbConnect()
	{
		$dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
		$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		return $dbh;
	}
}
?>