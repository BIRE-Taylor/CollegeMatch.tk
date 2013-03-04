<?php

	class User_model extends Model
	{
		var $perms = array();		//Array : Stores the permissions for the user
		var $userID = 0;			//Integer : Stores the ID of the current user
		var $userRoles = array();	//Array : Stores the roles of the current user
		var $loggedIn = false;
		
		function __constructor($userID = '')
		{
			parent::__construct(); 
			if ($userID != '')
			{
				$this->loggedIn = true;
				$this->userID = floatval($userID);
			} else if(isset($_SESSION['userID']))
			{
				$this->loggedIn = true;
				$this->userID = floatval($_SESSION['userID']);
			}
			else
			{
				$this->loggedIn = false;
				return;
			}
			$this->userRoles = $this->getUserRoles('ids');
			$this->buildACL();
		}
		
		function buildACL()
		{
			if(!$this->loggedIn)
				return;
			//first, get the rules for the user's role
			if (count($this->userRoles) > 0)
			{
				$this->perms = array_merge($this->perms,$this->getRolePerms($this->userRoles));
			}
			//then, get the individual user permissions
			$this->perms = array_merge($this->perms,$this->getUserPerms($this->userID));
		}
		
		function getPermKeyFromID($permID)
		{
			if(!$this->loggedIn)
				return;
			$strSQL = "SELECT `permKey` FROM `permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
			$data = $this->query($strSQL);
			foreach($data as $row)
			{
				return $row[0];
			}
		}
		
		function getPermNameFromID($permID)
		{
			$strSQL = "SELECT `permName` FROM `permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
			$data = $this->query($strSQL);
			foreach($data as $row)
			{
				return $row[0];
			}
		}
		
		function getRoleNameFromID($roleID)
		{
			$strSQL = "SELECT `roleName` FROM `roles` WHERE `ID` = " . floatval($roleID) . " LIMIT 1";
			$data = $this->query($strSQL);
			foreach($data as $row)
			{
				return $row[0];
			}
		}
		
		function getUserRoles()
		{
			if(!$this->loggedIn)
				return array();
			$strSQL = "SELECT * FROM `user_roles` WHERE `userID` = " . floatval($this->userID) . " ORDER BY `addDate` ASC";
			$data = $this->query($strSQL);
			$resp = array();
			foreach($data as $row)
			{
				$resp[] = $row['roleID'];
			}
			return $resp;
		}
		
		function getAllRoles($format='ids')
		{
			$format = strtolower($format);
			$strSQL = "SELECT * FROM `roles` ORDER BY `roleName` ASC";
			$data = $this->query($strSQL);
			$resp = array();
			foreach($data as $row)
			{
				if ($format == 'full')
				{
					$resp[] = array("ID" => $row['ID'],"Name" => $row['roleName']);
				} else {
					$resp[] = $row['ID'];
				}
			}
			return $resp;
		}
		
		function getAllPerms($format='ids')
		{
			$format = strtolower($format);
			$strSQL = "SELECT * FROM `permissions` ORDER BY `permName` ASC";
			$data = $this->query($strSQL);
			$resp = array();
			foreach($data as $row)
			{
				if ($format == 'full')
				{
					$resp[$row['permKey']] = array('ID' => $row['ID'], 'Name' => $row['permName'], 'Key' => $row['permKey']);
				} else {
					$resp[] = $row['ID'];
				}
			}
			return $resp;
		}

		function getRolePerms($role)
		{
			if (is_array($role))
			{
				$roleSQL = "SELECT * FROM `role_perms` WHERE `roleID` IN (" . implode(",",$role) . ") ORDER BY `ID` ASC";
			} else {
				$roleSQL = "SELECT * FROM `role_perms` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
			}
			$data = $this->query($strSQL);
			$perms = array();
			foreach($data as $row)
			{
				$pK = strtolower($this->getPermKeyFromID($row['permID']));
				if ($pK == '') { continue; }
				if ($row['value'] === '1') {
					$hP = true;
				} else {
					$hP = false;
				}
				$perms[$pK] = array('perm' => $pK,'inheritted' => true,'value' => $hP,'Name' => $this->getPermNameFromID($row['permID']),'ID' => $row['permID']);
			}
			return $perms;
		}
		
		function getUserPerms($userID)
		{
			if(!$this->loggedIn)
				return array();
			$strSQL = "SELECT * FROM `user_perms` WHERE `userID` = " . floatval($userID) . " ORDER BY `addDate` ASC";
			$data = $this->query($strSQL);
			$perms = array();
			foreach($data as $row)
			{
				$pK = strtolower($this->getPermKeyFromID($row['permID']));
				if ($pK == '') { continue; }
				if ($row['value'] == '1') {
					$hP = true;
				} else {
					$hP = false;
				}
				$perms[$pK] = array('perm' => $pK,'inheritted' => false,'value' => $hP,'Name' => $this->getPermNameFromID($row['permID']),'ID' => $row['permID']);
			}
			return $perms;
		}
		
		function userHasRole($roleID)
		{
			if(!$this->loggedIn)
				return false;
			foreach($this->userRoles as $k => $v)
			{
				if (floatval($v) === floatval($roleID))
				{
					return true;
				}
			}
			return false;
		}
		
		function hasPermission($permKey)
		{
			if(!$this->loggedIn)
				return false;
			$permKey = strtolower($permKey);
			if (array_key_exists($permKey,$this->perms))
			{
				if ($this->perms[$permKey]['value'] === '1' || $this->perms[$permKey]['value'] === true)
				{
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		
		function getUsername($userID)
		{
			if(!$this->loggedIn)
				return "";
			$strSQL = "SELECT `email` FROM `student` WHERE `s_id` = " . floatval($userID) . " LIMIT 1";
			$data = $this->query($strSQL);
			foreach($data as $row)
			{
				return $row[0];
			}
		}
		
		function login($username,$password)
		{
			$strSQL = "SELECT `s_id`,`pass`,`secret` FROM `student` WHERE `email` LIKE '" . $this->escapeString($username) . "' LIMIT 1";
			$data = $this->query($strSQL);
			$id = $data[0]->s_id;
			$pass = $data[0]->pass;
			$secret = $data[0]->secret;
			if($pass==md5($password))
			{
				$_SESSION['userID'] = $id;
				$userID = $id;
				$this->userRoles = $this->getUserRoles('ids');
				$this->buildACL();
				return true;
			}
			return false;
		}
	}

?>