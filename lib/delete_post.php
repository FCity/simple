<?php session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
<?php
	if (!empty($_GET['id'])) {
		include 'db.php';

		$db = new DB;
		echo $db->delete_post($_GET['id']);
	} else {
		header('Location: ../pages/home.php');
	}
?>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>