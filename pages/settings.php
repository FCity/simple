<?php session_start(); ?>
<?php if (!empty($_SESSION['user'])) : ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>simple | settings</title>
	<link rel="stylesheet" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="links">
			<a href="home.php">Home</a>
			<a href="../lib/logout.php">Logout</a>
		</div>

		<br><br>

		<div class="btn-group">
			<button type="button" id="change-pwd">Change Password</button>
			<button type="button" class="btn-delete" id="delete-account">Delete Account</button>
		</div>

		<br><br>

		<div id="view"></div>

<script>
$(document).ready(function(){
	$("#change-pwd").click(function(){
		$.get("../views/change_pwd_form.php?g=1", function(data) {
			$("#view").html(data);
		});
	});

	$("#delete-account").click(function(){
		if (confirm("Are you sure you want to delete your account?")) {
			window.location.href = "../lib/delete_account.php?g=1";
		}
	});
});
</script>
</body>
</html>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>