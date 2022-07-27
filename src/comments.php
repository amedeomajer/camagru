<?php
require_once("../config/setup.php");

if (isset($_POST["comment"]) && isset($_POST["image"]) && isset($_POST["comment_owner"]))
	{
		if(strlen($_POST['comment']) > 300) {
			if($_GET['p'] == 'h')
			header("Location: homepage.php?comment=long");
			else
			header("Location: profile-page.php?comment=long");
			exit();
		}
		$sql = "INSERT INTO `user_comments`(`value`, `image_id`, `comment_owner`) VALUES (?, ?, ?)";
		$result = $pdo->prepare($sql);
		$result->execute(array($_POST["comment"], $_POST["image"], $_SESSION["user_id"]));


		// send email
		$sql = "SELECT `user_id` FROM `user_images` WHERE `id` = ?";
		$result = $pdo->prepare($sql);
		$result->execute(array($_POST["image"]));
		$fetched = $result->fetch();
		$sql = "SELECT `email` FROM `user_info` WHERE `id` = ?";
		$result = $pdo->prepare($sql);
		$result->execute(array($fetched["user_id"]));
		$fetched = $result->fetch();

		$sql = "SELECT `user_id` FROM `user_images` WHERE `id` = ?";
		$result = $pdo->prepare($sql);
		$result->execute(array($_POST["image"]));
		$fetched = $result->fetch();
		$sql = "SELECT `email`, `notif_stat` FROM `user_info` WHERE `id` = ?";
		$result = $pdo->prepare($sql);
		$result->execute(array($fetched["user_id"]));
		$fetched = $result->fetch();
		if ($fetched["notif_stat"] == 1) {
			$email_content = "Someone commented on your picture, come check it ou!";
			mail($fetched["email"], "Someone commented your picture!", $email_content);
		}
		if(isset($_GET['p']))
		{
			if($_GET['p'] == 'h')
				header("Location: homepage.php");
		}
		else
			header("Location: profile-page.php");
		exit();
}