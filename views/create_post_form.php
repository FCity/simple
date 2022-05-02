<?php session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
<?php
	if (!empty($_GET)) {
		echo '<form action="../lib/create_post.php" method="post">
			Title: <input type="text" name="post_title" required>
			<br><br>
			Content:<br><textarea name="post_content" rows="10" cols="50" required></textarea>
			<br><br>
			<input type="submit" value="Post">
		</form>';
	} else {
		header('Location: ../pages/home.php');
	}
?>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>