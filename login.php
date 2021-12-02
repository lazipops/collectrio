<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/navStyle.css" />
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
	<?php
	require('db.php');
	session_start();
	// If form submitted, check if values are valid.
	if (isset($_POST['username'])) {
		// removes backslashes
		$username = stripslashes($_REQUEST['username']);
		//escapes special characters in a string
		$_SESSION['username'] = mysqli_real_escape_string($con, $username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con, $password);
		//Checking is user existing in the database or not (need to protect this from sql injection)
		$query = "SELECT * FROM `users` WHERE username='$username'
		and passhash='" . md5($password) . "'";
		$idQuery = "SELECT id FROM `users` WHERE username='$username'
		and passhash='" . md5($password) . "'";
		$fetchId = mysqli_fetch_row(mysqli_query($con, $idQuery));
		if ($fetchId) {
			$id = $fetchId[0];
			$_SESSION['id'] = $fetchId[0];
			$emailQuery = "SELECT email FROM `users` WHERE id = '$id'";
			$fetchEmail = mysqli_fetch_row(mysqli_query($con, $emailQuery));
			if ($fetchEmail) {
				$email = $fetchEmail[0];
				$_SESSION['email'] = $fetchEmail[0];
				$adminQuery = "SELECT admin FROM `users` WHERE id = '$id'";
				$fetchAdmin = mysqli_fetch_row(mysqli_query($con, $adminQuery));
				if ($fetchAdmin) {
					$_SESSION['admin'] = $fetchAdmin[0];
				}
			}
		}
		$result = mysqli_query($con, $query);
		$rows = mysqli_num_rows($result);
		if ($rows == 1) {
			// Redirect user to nav.php
			header("Location: nav.php");
		} else { ?>
			<div class='form'>
				<h3>Username/password is incorrect.</h3>
				<br />Click here to <a href='login.php'>Login</a>
			</div>
		<?php } ?>
	<?php } else { ?>
		<div class="form">
			<h1>Log In</h1>
			<form action="" method="post" name="login">
				<input type="text" name="username" placeholder="Username" required />
				<input type="password" name="password" placeholder="Password" required />
				<br>
				<input name="submit" type="submit" value="Login" />
			</form>
			<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
		</div>
	<?php } ?>
</body>

</html>