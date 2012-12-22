<html>
<head>
<title>College Match</title>
<?php include 'styles.php';?>
</head>
<body>
<?php 
/**
 * head content
 */

include 'head.php';
?>
<?php 
/**
 * body content
 */

if(isset($_GET['body']))
{
	$q = $_GET['body'];
	if($q == 'search')
	{
		include 'search.php';
	}
	if($q == 'profile')
	{
		include 'profile.php';
	}
}
?>
</body>
</html>