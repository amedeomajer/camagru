<?php
	require_once('../config/setup.php');

	if (isset($_SESSION['login_permission'])){
		if ($_SESSION['login_permission'] == 1) {
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				if (isset($_POST["notification-radio"])) {
					if ($_POST["notification-radio"] === "off") // CHANGE NOTIFICATION STATUS TO OFF
					{
						$sql = "UPDATE `user_info` SET `notif_stat` = 0 WHERE `id` = ?";
									$result = $pdo->prepare($sql);
									$result->execute(array($_SESSION["user_id"]));
									$notification_status = $result->fetch();
									header("Location: settings.php?message=notif-off");
									exit();
					}
					if ($_POST["notification-radio"] === "on") // CHANGE NOTIFICATION STATUS TO ON
					{
						$sql = "UPDATE `user_info` SET `notif_stat` = 1 WHERE `id` = ?";
						$result = $pdo->prepare($sql);
						$result->execute(array($_SESSION["user_id"]));
						header("Location: settings.php?message=notif-on");
						exit();
					}
				}
				if (isset($_POST["new-email"]) && !empty($_POST["new-email"]))  // CHANGE EMAIL
				{
					$sql = "SELECT `email` FROM `user_info` WHERE `email` = ?";
					$result = $pdo->prepare($sql);
					$result->execute(array($_POST["new-email"]));
					$result = $result->fetch();
					if (empty($result)) {
						$sql = "UPDATE `user_info` SET `email` = ? WHERE `id` = ?";
						$result = $pdo->prepare($sql);
						$result->execute(array($_POST["new-email"], $_SESSION["user_id"]));
						header("Location: settings.php?message=email_1");
						exit();
					} else {
						header("Location: settings.php?message=email_0");
						exit();
					}
					
				}
				if (isset($_POST["new-password"]) && !empty($_POST["new-password"])) // CHANGE PASSWORD
				{
					$password = $_POST['new-password'];
					$uppercase = preg_match('@[A-Z]@', $password);
					$lowercase = preg_match('@[a-z]@', $password);
					$number    = preg_match('@[0-9]@', $password);
					if(!$uppercase || !$lowercase || !$number || strlen($password) < 8)
					{
						header('Location: settings.php?message=pword_2');
						exit();
					}
					if(isset($_POST["old-password"]) && !empty($_POST["old-password"]))
					{
						$sql = "SELECT `pass_word` FROM `user_info` WHERE `id` = ?";
								$result = $pdo->prepare($sql);
								$result->execute(array($_SESSION["user_id"]));
								$result = $result->fetch();
								$hash = $result['pass_word'];
								if (password_verify($_POST["old-password"], $hash) === true)
								{
									$sql = "UPDATE `user_info` SET `pass_word` = ? WHERE `id` = ?";
									$result = $pdo->prepare($sql);
									$result->execute(array(password_hash($password, PASSWORD_BCRYPT), $_SESSION["user_id"]));
									header('Location: settings.php?message=pword_1');
									exit();
								} else {
									header('Location: settings.php?message=pword_0');
									exit();
								}
					}
				}
				if (isset($_POST["new-username"]) && !empty($_POST["new-username"]))  // CHANGE username
				{
					$sql = "SELECT `userr_name` FROM `user_info` WHERE `userr_name` = ?";
					$result = $pdo->prepare($sql);
					$result->execute(array($_POST["new-username"]));
					$result = $result->fetch();
					if (empty($result)) {
						$sql = "UPDATE `user_info` SET `userr_name` = ? WHERE `id` = ?";
						$result = $pdo->prepare($sql);
						$result->execute(array($_POST["new-username"], $_SESSION["user_id"]));
						$_SESSION['username'] = $_POST["new-username"];
						header('Location: settings.php?message=uname_1');
						exit();
					} else {
						header('Location: settings.php?message=uname_0');
						exit();
					}
					
				}
				header("Location: settings.php");
				exit();
			}
			require_once('settings.view.php');
		}
		else {
			header('Location: landing.php');
		}
	} else {
		header('Location: landing.php');
	}
?>
