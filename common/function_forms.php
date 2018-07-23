<?php
include_once("common/config_forms.php");
class Newconnection
{
	private $db;
	public function __construct()
	{
		$this->db=new Connection();
		$this->db=$this->db->dbConnect();
	}
	
	public function insertQuery($sql,$array)
	{
		$stmt=$this->db->prepare($sql);
		$stmt->execute($array);
		$lastid = $this->db->lastInsertId();;
		return $lastid;
	}
	public function selectQuery($sql,$array)
	{
		$stmt=$this->db->prepare($sql);
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
	
	public function download_csv_results($results, $name)
	{            
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename='. $name);
		header('Pragma: no-cache');
		header("Expires: 0");

		$outstream = fopen("php://output", "w");    
		fputcsv($outstream, array_keys($results[0]));

		foreach($results as $result)
		{
			fputcsv($outstream, $result);
		}

		fclose($outstream);
	}
}
?>