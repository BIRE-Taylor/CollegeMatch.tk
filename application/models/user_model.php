<?php

class User_model extends Model {
	
	//Retrieves the user by id $id
	//if $id is null returns the user from current session
	//if no current user and $id is null returns null
	public function getUser($id)
	{
		if($id==null||$id=='')
		{
			if (!isset ($_SESSION)) session_start();
			if (!isset ($_SESSION['user'])) return null;
			$user = $this->getUser($_SESSION['user']);
			return $user;
		}
		$id = $this->escapeString($id);
		$result = $this->query('SELECT * FROM `User` WHERE md5(`id`)="'. $id .'"');
		return $result;
	}
	
	//creates a user with specified values
	public function createUser($user)
	{
		
	}

	//updates a user
	//if $value is null values assumed changed
	//if $property is null all properties are uploaded
	public function updateUser($user,$property=null,$value=null)
	{
		
	}
}

?>
