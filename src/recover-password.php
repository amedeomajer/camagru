<?php
	require_once("../config/setup.php");
	if(isset($_GET['token'])) {
		$post_action = "recover-password.php?token=".$_GET['token'];
		$sql = 'SELECT * FROM `user_info` WHERE `activation_code` = ?';
		$result = $pdo->prepare($sql);
		$result->execute(array($_GET['token'])); 
		$fetched = $result->fetch();
		if ($fetched) {
			?>

			<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Document</title>
				</head>
				<body>
					<form action="" method="POST">
						<br><label>New Password</label>
						<br><input type="password" name="new-pass">
						<br><label>Repeat Password</label>
						<br><input type="password" name="re-pass">
						<br><input type="submit" name="reset" value="reset"> <?php
						if(isset($_POST['new-pass']) && !empty($_POST['new-pass']) && isset($_POST['re-pass']) && !empty($_POST['re-pass']) && isset($_POST['reset']))
						{
							if($_POST['new-pass'] != $_POST['re-pass']){
								echo 'passwords do not match!<br>';
							}
							else {
								$password = $_POST['new-pass'];
								$uppercase = preg_match('@[A-Z]@', $password);
								$lowercase = preg_match('@[a-z]@', $password);
								$number    = preg_match('@[0-9]@', $password);
								if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
									echo "Password needs to be at least 8 chars long and have one uppercase, one lowercase and one number<br>";
								}
								else {
									$pwd = $_POST['new-pass'];
									$passwd = password_hash($pwd, PASSWORD_BCRYPT);
									$token = $_GET['token'];
									$sql = 'UPDATE `user_info` SET `pass_word` = ? WHERE `activation_code` = ?';
									$result = $pdo->prepare($sql);
									$result->execute(array($passwd, $token));
									$email = $fetched['email'];
									$new_activation_code = md5($email).time();
									$sql = 'UPDATE `user_info` SET `activation_code` = ? WHERE `activation_code` = ?';
									$result = $pdo->prepare($sql);
									$result->execute(array($new_activation_code ,$token));
									header("Location: landing.php?recover=succesfull");
									exit();
								}
							}
							
						}
					?>
					</form>
				</body>
				</html>
	
	<?php

		}
	}
	?>
