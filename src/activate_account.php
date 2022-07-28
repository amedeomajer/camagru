<?php
	require_once("../config/setup.php");

	function activate_account($pdo, $token)
	{
		$stmt = $pdo->query("SELECT * FROM `user_info` WHERE `activation_code` = '$token'");
		$user_info = $stmt->fetch();
		if (isset($user_info['activation_code']))
		{
			if ($user_info['activation_code'] === $token){
				$sql = "UPDATE `user_info`
						SET `acti_stat` = 1
						WHERE `activation_code` = ?";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array($token));
				$new_token = md5($user_info["email"]).time();
				
				$sql = "UPDATE `user_info`
						SET `activation_code` = ?
						WHERE `id` = ?";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array($new_token, $user_info["id"]));
				echo '<script language="javascript">';
				echo 'alert("Account activated, you can now login!")';
				echo '</script>';
			}
		}
	}
?>
