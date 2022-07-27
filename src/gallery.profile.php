<?php
	require_once("../config/setup.php");

	if (isset($_GET['load_index'])){
		$session_id = $_SESSION['user_id'];
		$fetch_image_index = $_GET['load_index'];
		$sql = "SELECT `id`, `user_id` FROM `user_images` WHERE `user_id` =  $session_id ORDER BY `upload_date` DESC LIMIT $fetch_image_index , 4;";
		$statement = $pdo->query($sql);
		$images = $statement->fetchAll(PDO::FETCH_ASSOC);
		if (!empty($images)) 
		{
			foreach($images as $image) {
				$sql = "SELECT `value`, `comment_owner` FROM `user_comments` WHERE `image_id` = '".$image['id']."';";
				$statement = $pdo->query($sql);
				$comments = $statement->fetchAll(PDO::FETCH_ASSOC);
				echo'<table class="gallery">
				<tr id="tr-username">
					<th>' . $_SESSION["username"] . '</th>
				</tr>
				<tr>
					<td>
						<img src="' . $image['id'] . '">
					</td>
				</tr>
				<tr>
					<td id="like-delete">
					<form method="post" action="like.php" style="display: flex;">';
					$sql = "SELECT COUNT(*) FROM `user_likes` WHERE `image_id` = ?;";
					$result = $pdo->prepare($sql);
					$result->execute(array($image['id'])); 
					$number_of_likes = $result->fetchColumn();

					$sql = "SELECT `like_owner` FROM `user_likes` WHERE `image_id` = ? AND `like_owner` = ?";
					$result = $pdo->prepare($sql);
					$result->execute(array($image['id'], $_SESSION['user_id'])); 
					$fetched = $result->fetch();
					if ($fetched === false)
					{
						echo	$number_of_likes.'<div id="like-button" style="background-image: url(../img/icons/like-icon-inactive.png)">';
					}
					else
					{
						echo	$number_of_likes.'<div id="like-button" style="background-image: url(../img/icons/like-icon-active.png)">';
					}
					echo '		<input type="submit" name="like" value="like">
							<textarea name="image" hidden>'.$image["id"].'</textarea>
							<textarea name="like_owner" hidden>'.$_SESSION["user_id"].'</textarea>
							<textarea name="redirect" hidden>pPage</textarea>
						</div>
					</form>
					<form action="delete-picture.php" method="post">
						<textarea name="image" hidden>'.$image["id"].'</textarea>
						<button id="delete-picture-button" type="submit" formmethod="post" formaction="delete-picture.php">X</button>
					</form>
					</td>
				</tr>
				<tr>
					<td>
						<form id="comments-form" action="comments.php" method="POST">
							<textarea placeholder="Leave a comment..." name="comment" id="" cols="30" rows="2" maxlength="300" required></textarea>
							<textarea name="image" hidden>'.$image["id"].'</textarea>
							<textarea name="comment_owner" hidden>'.$_SESSION["user_id"].'</textarea>
							<input id="submit-comment" type="submit" value="">
						</form>';
				if (!empty($comments)) {
					$index = count($comments) - 1;
					while($index >= 0) {
						echo "<br>";
						$sql = "SELECT `userr_name` FROM `user_info` WHERE `id` = '".$comments[$index]['comment_owner']."';";
						$statement = $pdo->query($sql);
						$username = $statement->fetch(PDO::FETCH_ASSOC);
						echo '<div id="comment"><span id="posted-comment-owner">'.$username['userr_name'].'</span><br><p id="comment-content">'.htmlspecialchars($comments[$index]['value']).'</p></div><hr>';
						$index--;
					}
				}
				echo '</table>';
		}}
	}
?>
