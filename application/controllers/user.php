<?php

class User extends Controller {
	
	function index()
	{
		$template = $this->loadView('main_view');
		$template->render();
	}
    
	function register()
	{
		$template = $this->loadView('register_view');
		$template->render();
	}
    
	function login()
	{
		$usermodel = $this->loadModel('user_model');
		echo $usermodel->login($_REQUEST['username'],$_REQUEST['password']);
	}
	
	function test()
	{
		$usermodel = $this->loadModel('user_model',1);
		echo $usermodel->login("taylor@jon.es","password");
	}
}

?>
