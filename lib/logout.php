<?php session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
<?php
	session_unset();
	session_destroy();

	header('Location: ../index.php');
?>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>