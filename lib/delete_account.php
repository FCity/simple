<?php session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
<?php
	if (!empty($_GET)) {
		include 'db.php';

		// store SESSION user values for convenience
		$id = $_SESSION['user']['id'];
		$username = $_SESSION['user']['username'];

		$db = new DB;

		if ($db->delete_account($id, $username)) {
			header('Location: logout.php');
		} else {
			header('Location: ../pages/settings.php');
		}
	} else {
		header('Location: ../pages/home.php');
	}
?>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>