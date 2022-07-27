<?php
	require_once("../config/setup.php");

	if (isset($_POST['email']) && isset($_POST['password']) && $_POST['delete-account'] === "delete")
	{
		$sql = "SELECT * FROM `user_info` WHERE `email` = ?";
		$result = $pdo->prepare($sql);
		$result->execute(array($_POST["email"]));
		$user_info = $result->fetch();

		if ($_SESSION["user_id"] === $user_info["id"]) {

			$sql = "DELETE FROM `user_info` WHERE `id` = ?";

			$result = $pdo->prepare($sql);
			$result->execute(array($_SESSION["user_id"]));

			$sql = "DELETE FROM `user_images` WHERE `user_id` = ?";

			$result = $pdo->prepare($sql);
			$result->execute(array($_SESSION["user_id"]));

			$sql = "DELETE FROM `user_comments` WHERE `comment_owner` = ?";

			$result = $pdo->prepare($sql);
			$result->execute(array($_SESSION["user_id"]));

			$sql = "DELETE FROM `user_likes` WHERE `like_owner` = ?";

			$result = $pdo->prepare($sql);
			$result->execute(array($_SESSION["user_id"]));

			session_destroy();
			header("Location: landing.php?delete_account=yes");
		}
		else {
			session_destroy();
			header("Location: landing.php?delete_account=no");
		}
	}
	if(!isset($_SESSION['login_permission'])){
		header('Location: landing.php');
		exit();
	}
	if(isset($_SESSION['login_permission'])){
		header('Location: homepage.php');
		exit();
	}


	// $_POST { ["email"]=> string(16) "amajer@proton.me" ["password"]=> string(6) "123456" ["delete-account"]=> string(6) "delete" } 
	// $_SESSION { ["username"]=> string(6) "amedeo" ["user_id"]=> int(7) ["login_permission"]=> int(1) }
?>