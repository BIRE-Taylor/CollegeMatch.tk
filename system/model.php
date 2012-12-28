<?php

class Model {

	private $connection;

	public function __construct()
	{
		global $config;
		
		$this->connection = mysql_pconnect($config['db_host'], $config['db_username'], $config['db_password']) or die('MySQL Error: '. mysql_error());
		mysql_select_db($config['db_name'], $this->connection);
	}

	public function escapeString($string)
	{
		return mysql_real_escape_string($string);
	}

	public function escapeArray($array)
	{
	    array_walk_recursive($array, create_function('&$v', '$v = mysql_real_escape_string($v);'));
		return $array;
	}
	
	public function to_bool($val)
	{
	    return !!$val;
	}
	
	public function to_date($val)
	{
	    return date('Y-m-d', $val);
	}
	
	public function to_time($val)
	{
	    return date('H:i:s', $val);
	}
	
	public function to_datetime($val)
	{
	    return date('Y-m-d H:i:s', $val);
	}
	
	//executes mysql query and returns array of rows as objects
	public function query($qry)
	{
		$result = mysql_query($qry) or die('MySQL Error: '. mysql_error());
		$resultObjects = array();

		while($row = mysql_fetch_object($result)) $resultObjects[] = $row;

		return $resultObjects;
	}

	//Executes mysql query and returns the raw mysql result object
	public function execute($qry)
	{
		$exec = mysql_query($qry) or die('MySQL Error: '. mysql_error());
		return $exec;
	}

	//Updates table $table with object $object in row identified by column $idColumn
	//If $idColumn is null then Primary Key is used
	//If $object is not found the it is created
	public function updateOrCreate($table,$object,$idColumn)
	{
		
	}
    
}
?>
