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
	<br/>
	<div class="login_box">
		<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
			<br />
			<table>
				<tr>
					<td>Username <input name="username" type="text" />
					</td>
				</tr>
				<tr>
					<td>Password <input name="password" type="password" id="password" />
					</td>
				</tr>
				<tr>
					<td>Retype Password <input name="password2" onkeyup="if(this.value != document.getElementById('password').value){document.getElementById('alertPassword').innerHTML = 'Passwords do not match!';}else{document.getElementById('alertPassword').innerHTML = 'Passwords match!';};" name="password" type="password" />
					</td>
					<td><div id="alertPassword"></div></td>
				</tr>
				<tr>
					<td><button type="submit">Register</button></td>
				</tr>
			</table>
		</form>
		<br />
	</div>
	<?php if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])) {
		if($_POST['password'] == $_POST['password2'])
		{
			register($_POST['username'], $_POST['password']);
			echo "Registration successful!";
			echo "<a href='login.php'>Go back to login?</a>";
		}
	}?>
</body>
</html>
