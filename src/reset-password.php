<?php

if(isset($_GET['token']))
{
	$stmt = $pdo->query("SELECT *
	FROM `user_info`
	WHERE
	`activation_code` = '$token'");
	$code = $stmt->fetch();
	
	$sql = "UPDATE `user_info`
			SET `acti_stat` = 1
			WHERE `activation_code` = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array($token));
	echo "Account Activated! Praise the Lord!";
}