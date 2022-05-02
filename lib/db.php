<?php
require '../config/creds.php';

class DB {
	// Connect to the 'simple' database
	public function connect() {
		return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}

	// Signup new users
	public function signup($username, $password) {
		$db = $this->connect();

		// hash password
		$hash = password_hash($password, PASSWORD_DEFAULT);

		// insert user input
		$stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
		$stmt->bind_param("ss", $username, $hash);
		$stmt->execute();

		$db->close();
	}

	// Login user
	public function login($username, $password) {
		$db = $this->connect();

		$result = $db->query("SELECT * FROM users WHERE username='$username'");

		$db->close();

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			
			$hash = $row['password'];

			// check password credential
			if (password_verify($password, $hash)) {
				// store only the id & username to return
				$user['id'] = $row['id'];
				$user['username'] = $row['username'];

				return $user;
			}
		}
	}

	// Create new post
	public function post($title, $content, $author) {
		$db = $this->connect();

		$stmt = $db->prepare("INSERT INTO posts (post_title, post_content, post_author) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $title, $content, $author);
		$stmt->execute();

		$db->close();
	}

	// Output all existing posts
	public function view($username) {
		$db = $this->connect();

		$sql = "SELECT * FROM posts";
		$result = $db->query($sql);

		$db->close();

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				// keep $results index and $post_id congruent
				$results[$row['post_id']] = $row;
			}
		}

		// posts wrapper
		$view = '<div>';

		if (isset($results)) {
			foreach ($results as $key => $post) {
				// individual post wrapper
				//	w/ dynamic 'post-id' value
				$view .= '<div class="post" id="post-' . $key . '">';

				foreach ($post as $key => $value) {
					// exclude 'post_id' from output
					if ($key != 'post_id') {
						// store 'post_author' for delete button option
						if ($key == 'post_author') {
							$post_author = $value;
						}

						$view .= '<p><b>' . $key . ':</b> ' . $value . '</p>';
					} else {
						// store 'post_id' for dynamic delete button id
						$post_id = $value;
					}
				}

				// only create delete button for posts by the user currently logged in
				if ($username == $post_author) {
					// delete button is linked to 'post_id'
					$view .= '<button type="button" class="btn-delete" id="delete-post-' . $post_id . '" onclick="deletePost(event)">Delete Post</button>';
				}

				$view .= '</div>';
			}
		} else {
			$view .= '<p>No posts</p>';
		}

		$view .= '</div>';

		return $view;
	}

	// Delete a post
	public function delete_post($post_id) {
		$db = $this->connect();

		$id = intval($post_id);

		$stmt = $db->prepare("DELETE FROM posts WHERE post_id=?");
		$stmt->bind_param("i", $id);
		$stmt->execute();

		// Returns 0 or 1;
		$result = $stmt->affected_rows;

		$db->close();

		return $result;
	}

	// Change user password
	public function change_pwd($pwd, $id) {
		$db = $this->connect();

		$hash = password_hash($pwd, PASSWORD_DEFAULT);
		$id = intval($id);

		$stmt = $db->prepare("UPDATE users SET password=? WHERE id=?");
		$stmt->bind_param("si", $hash, $id);
		$stmt->execute();

		$db->close();
	}

	public function delete_account($id, $username) {
		$db = $this->connect();

		$stmt = $db->prepare("DELETE FROM posts WHERE post_author=?");
		$stmt->bind_param("s", $username);
		$stmt->execute();

		$stmt = $db->prepare("DELETE FROM users WHERE id=?");
		$stmt->bind_param("i", intval($id));
		$stmt->execute();

		// Returns 0 or 1
		//	1 = user deleted
		$result = $stmt->affected_rows;

		$db->close();

		return $result;
	}
}
?>