<?php session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
<?php
	if (!empty($_POST)) {
		include 'functions.php';
		include 'db.php';
		
		// extract POST value
		extract($_POST);

		// escape user input
		$new_pwd = _e($new_pwd);

		$db = new DB;
		$db->change_pwd($new_pwd, $_SESSION['user']['id']);
	}

	header('Location: ../pages/settings.php');
?>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>