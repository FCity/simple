<?php session_start(); ?>
<?php if (!empty($_SESSION['user'])) : ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>simple | home</title>
	<link rel="stylesheet" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="links">
			<a href="settings.php">Settings</a>
			<a href="../lib/logout.php">Logout</a>
		</div>

		<header>
		<h3>Welcome <?php echo $_SESSION['user']['username']; ?></h3>
		</header>
	
		<div class="btn-group">
			<button type="button" id="create-post">Create Post</button>
			<button type="button" id="view-posts">View Posts</button>
		</div>
		
		<br><br>
	
		<div id="view"></div>
	</div>

<script>
$(document).ready(function(){
	// GET the create post form
	$("#create-post").click(function(){
		$.get("../views/create_post_form.php?g=1", function(data){
			$("#view").html(data);
		})
	});

	// GET all posts
	$("#view-posts").click(function(){
		$.get("../lib/view_posts.php?g=1", function(data){
			$("#view").html(data);
		});
	});
});

// GET request to delete post from db and remove from view
function deletePost(e) {
	var postID = e.target.id.match(/\d+/);
	
	$.get("../lib/delete_post.php?id=" + postID, function(data){
		if (data) {
			console.log(data)
			$("#post-" + postID).css("display", "none");
		}
	});
}
</script>
</body>
</html>
<?php else : ?>
<?php header('Location: ../index.php'); ?>
<?php endif; ?>