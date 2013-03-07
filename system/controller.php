<?php

class Controller {
	
	public function loadModel($name, $param = null)
	{
		require(APP_DIR .'models/'. strtolower($name) .'.php');
		if($param==null)
		{
			$model = new $name;
		}
		else
		{
			$model = new $name($param);
		}
		return $model;
	}
	
	public function loadView($name,$template = null)
	{
		if($template !=null)
		{
			return new View($name, $template);
		}
		return new View($name);
	}
	
	public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}
	
	public function loadHelper($name)
	{
		require(APP_DIR .'helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}
	
	public function redirect($loc)
	{
		header('Location: '. $config['base_url'] . $loc);
	}
    
}

?>
