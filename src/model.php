<?php

class Model 
{	

	protected $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT.";charset=".DB_CHARSET;
	protected $opt = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];

	protected $db;

	public function __construct()
	{
		$this->db = new PDO($this->dsn, DB_USER, DB_PASS, $this->opt);
	}

	public function homePage() {

		$result = array();

		/*$sql_query = 'SELECT * from artists';

		$stmt = $this->db->prepare($sql_query); // stmt = statement
		$stmt -> execute();
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			
		    $result[] = $row;
		}*/

		return $result;

	}

}

  
