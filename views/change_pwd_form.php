<?php session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
<?php
	if (!empty($_GET)) {
		echo '<form action="../lib/change_pwd.php" method="post">
			New Password: <input type="password" name="new_pwd" required>
			<br><br>
			<input type="submit" value="Submit">
		</form>';
	} else {
		header('Location: ../pages/home.php');
	}
?>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>