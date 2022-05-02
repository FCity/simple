<?php session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
<?php
	if (!empty($_GET)) {
		include 'db.php';

		$db = new DB;
		echo $db->view($_SESSION['user']['username']);
	} else {
		header('Location: ../pages/home.php');
	}
?>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>