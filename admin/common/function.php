<?php
include_once("common/config.php");

class Newconnection
{
	private $db;
	public function __construct()
	{
		$this->db=new Connection();
		$this->db=$this->db->dbConnect();
	}
	
	public function insertQuery($query,$array)
	{
		$stmt=$this->db->prepare($query);
		$stmt->execute($array);
		$lastid = $this->db->lastInsertId();;
		return $lastid;
	}
	
	public function insertTransQuery($query,$array)
	{
		$this->db->beginTransaction(); // Speed up your inserts
		
		$stmt=$this->db->prepare($query);
		$stmt->execute($array);
				
		$this->db->commit();
	}
	
	
	public function selectQuery($query,$array)
	{
		$stmt=$this->db->prepare($query);
		if($array==null)
		{
			$stmt->execute();
		}
		else
		{
			$stmt->execute($array);
		}
		//$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$result=$stmt->fetchAll();
		return $result;
	}
}
?>