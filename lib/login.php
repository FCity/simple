<?php session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
<?php header('Location: ../pages/home.php'); ?>
<?php else : ?>
<?php
	if (!empty($_POST)) {
		// extract all POST values
		extract($_POST);

		include '../config/token.php';

		// recreate csrf token
		$calc_str = sprintf('%s_%s_%s', $form_action, $timestamp, NONCE_SALT);
		$calc_hash = hash('sha512', $calc_str);

		// if form is from same server, log in user
		if ($calc_hash == $form_hash) {
			include 'functions.php';
			include 'db.php';

			// escape user input
			$username = _e($username);
			$password = _e($password);

			$db = new DB;
			$_SESSION['user'] = $db->login($username, $password);

			print_r($_SESSION);

			if (!empty($_SESSION['user'])) {
				header('Location: ../pages/home.php');
			} else {
				header('Location: ../index.php');
			}
		}
	} else {
		header('Location: ../index.php');
	}
?>
<?php endif; ?>