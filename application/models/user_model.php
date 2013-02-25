<?php

class User_model extends Model {

	$user = '';

	//Retrieves the user by id $id
	//if $id is null returns the user from current session
	//if no current user and $id is null returns null
	public function getUser($id)
	{
		if($id==null||$id=='')
		{
			if($this->user!='') return $this->user; 
			if (!isset ($_SESSION)) session_start();
			if (!isset ($_SESSION['user'])||$_SESSION['user']=='') return null;
			$user = $this->getUser($_SESSION['user']);
			return $user;
		}
		$id = $this->escapeString($id);
		$result = $this->query('SELECT * FROM `User` WHERE md5(`id`)="'. $id .'"');
		return $result;
	}
	
	//Retrieves a user by provided username
	public function getUserByName($userName)
	{
		$result = $this->query('SELECT * FROM `User` WHERE `user` LIKE \''.$userName.'\';');
		return $result
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

	//Saves the current user to the session
	public function saveUser($id)
	{
		if (!isset ($_SESSION)) session_start();
		if (getUser($id)!=null) $_SESSION['user'] = md5($id);
	}

	//Authenticates user and stores them in the session
	//Returns authenticated user or false
	public function AuthenticateUser($userName,$password,$timestamp)
	{
		$user=getUserByName($userName);
		if($user==null) return false;
		$passHashed=md5($user->password.$timestamp);
		if($passHashed==$password)
		{
			saveUser($user->id);
			$this->user = $user;
			return $user;
		}
	}

}

?>
