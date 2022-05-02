<?php session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
<?php 
	if (!empty($_POST)) {
		include 'functions.php';
		include 'db.php';

		// extract all POST values
		extract($_POST);

		// escape user input
		$post_title = _e($post_title);
		$post_content = _e($post_content);

		$db = new DB;
		$db->post($post_title, $post_content, $_SESSION['user']['username']);
	}

	header('Location: ../pages/home.php');
?>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>