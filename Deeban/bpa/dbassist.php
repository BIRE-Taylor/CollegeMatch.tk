<?php
$h = "localhost";
$u = "root";
$p = "diivanand";
$db = "bpa";
function register($username, $password)
{ 
	global $h;
	global $u;
	global $p;
	global $db;
	$con = mysql_connect($h,$u,$p);
	echo $h;
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db($db, $con);

	mysql_query("INSERT INTO users (username, password)
	VALUES ('$username', '$password')");

	mysql_close($con);

}
function login($username, $password)
{
	global $h;
	global $u;
	global $p;
	global $db;
	
	$con = mysql_connect($h,$u,$p);

	if(!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($db,$con);

	$result = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

	while($row = mysql_fetch_array($result))
	{
		echo $row['username'] . " " . $row['password'];
		echo "<br />";
	}
	
	mysql_close($con);

}
?>