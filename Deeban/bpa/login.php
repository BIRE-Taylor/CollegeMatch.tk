<html>
<head>
<title>College Match</title>
<?php include 'styles.php'; include 'dbassist.php'?>
</head>
<body>
	<?php 
	/**
	 * head content
	 */

	include 'head.php';
	?>
	<br />
	<div class="login_box">
		<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
			<br />
			<table>
				<tr>
					<td>Username <input name="username" type="text" />
					</td>
				</tr>
				<tr>
					<td>Password <input name="password" type="password" />
					</td>
				</tr>
				<tr>
					<td><button type="submit">Login</button></td>
				</tr>
				<tr>
					<td><a href="register.php">Not registered yet?</a></td>
				</tr>
			</table>
		</form>
		<br />
	</div>
	<?php if(isset($_POST['username']) && isset($_POST['password'])) {
		login($_POST['username'], $_POST['password']);
	}?>
</body>
</html>
