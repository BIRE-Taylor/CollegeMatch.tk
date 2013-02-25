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
}

?>
