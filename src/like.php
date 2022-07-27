<?php
	require_once("../config/setup.php");

	$sql = "SELECT * FROM `user_likes` WHERE `image_id` = ? AND `like_owner` = ?";
	$result = $pdo->prepare($sql);
	$result->execute(array($_POST["image"], $_SESSION['user_id'])); 
	$fetched = $result->fetch();
	if ($fetched === false)
	{
		// unique_id	like_owner	image_id	time_of_post
		$sql = "INSERT INTO user_likes(`like_owner`, `image_id`) VALUES(?, ?)";
		$result = $pdo->prepare($sql);
		$result->execute(array($_SESSION["user_id"], $_POST["image"]));

		$sql = "SELECT `user_id` FROM `user_images` WHERE `id` = ?";
		$result = $pdo->prepare($sql);
		$result->execute(array($_POST["image"]));
		$fetched = $result->fetch();

		$sql = "SELECT `email`, `notif_stat` FROM `user_info` WHERE `id` = ?";
		$result = $pdo->prepare($sql);
		$result->execute(array($fetched["user_id"]));
		$fetched = $result->fetch();
		if ($fetched["notif_stat"] === 1) {
			$email_content = "Someone likes your picture, come check it ou!";
			mail($fetched["email"], "Someone likes your picture!", $email_content);
		}
	}
	else
	{
		// DELETE FROM `table_name` [WHERE condition];

		$sql = "DELETE FROM user_likes WHERE `image_id` = ? AND `like_owner` = ?";
		$result = $pdo->prepare($sql);
		$result->execute(array($_POST["image"], $_SESSION['user_id']));
	}



	if ($_POST["redirect"] == "pPage")
		header("Location: profile-page.php");
	else
		header("Location: homepage.php");
?>

<!-- ["like"]=> string(4) "like" 
["image"]=> string(35) "./img/user_images/62c17ffb4b831.png" 
["like_owner"]=> string(1) "1" 
["redirect"]=> string(28) ""Location: profile-page.php"" } -->