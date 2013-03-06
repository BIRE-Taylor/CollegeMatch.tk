<?php

class LiveSearch extends Controller {
	
	function index()
	{
		$q = $_POST['q'];
		echo "<h3>Searching $q ... </h3>";
	}
}

?>
