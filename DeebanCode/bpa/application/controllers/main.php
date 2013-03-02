<?php

class Main extends Controller {
	
	function index()
	{
		$template = $this->loadView('main_view');
		$template->render();
	}
	
	function Calendar()
	{
		$template = $this->loadView('calendar');
		$template->render();
	}

}

?>
