<?php
abstract class Object
{
//	protected string $tableName;
	private final function __construct(){}

	public static function get()
	{
		return __construct();
	}

	public function save()
	{
		
	}

	public static function __callStatic(string $name , array $arguments)
	{
		echo $name;
		if(substr($name,0,6)=="findBy")
		{
			echo $name;
		}
	}
}

?>

