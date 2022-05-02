<?php
include 'config/token.php';

$time = time();

$action_login = 'login_form';
$login_str = sprintf('%s_%s_%s', $action_login, $time, NONCE_SALT);
$login_hash = hash('sha512', $login_str);

$action_signup = 'signup_form';
$signup_str = sprintf('%s_%s_%s', $action_signup, $time, NONCE_SALT);
$signup_hash = hash('sha512', $signup_str);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>simple</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="form col-md-6 col-lg-6">
				<h2>Login</h2>
				<form action="lib/login.php" method="post">
					<input type="hidden" name="form_action" value="<?php echo $action_login; ?>">
					<input type="hidden" name="timestamp" value="<?php echo $time; ?>">
					<input type="hidden" name="form_hash" value="<?php echo $login_hash; ?>">
					Enter Username: <input type="text" name="username" required>
					<br><br>
					Enter Password: <input type="password" name="password" required>
					<br><br>
					<input type="submit" value="Login">
				</form>
			</div>
			<div class="form col-md-6 col-lg-6">
				<h2>Sign Up</h2>
				<form action="lib/signup.php" method="post">
					<input type="hidden" name="form_action" value="<?php echo $action_signup; ?>">
					<input type="hidden" name="timestamp" value="<?php echo $time; ?>">
					<input type="hidden" name="form_hash" value="<?php echo $signup_hash; ?>">
					Enter Username: <input type="text" name="username" required>
					<br><br>
					Enter Password: <input type="password" name="password" required>
					<br><br>
					<input type="submit" value="Sign Up">
				</form>
			</div>
		</div>
	</div>
</body>
</html>