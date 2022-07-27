<?php
require_once("../config/setup.php");

//check is session id and user id on picture match first
if(isset($_SESSION['login_permission'])){
$sql = "SELECT `user_id` FROM `user_images` WHERE `id` = ?";
$result = $pdo->prepare($sql);
$result->execute(array($_POST["image"])); 
$fetched = $result->fetch();

if($fetched["user_id"] == $_SESSION["user_id"])
{
	$sql = "DELETE FROM `user_images` WHERE `id` = ?";
	$result = $pdo->prepare($sql);
	$result->execute(array($_POST["image"]));
	$sql = "DELETE FROM `user_likes` WHERE `image_id` = ?";
	$result = $pdo->prepare($sql);
	$result->execute(array($_POST["image"]));
	$sql = "DELETE FROM `user_comments` WHERE `image_id` = ?";
	$result = $pdo->prepare($sql);
	$result->execute(array($_POST["image"]));
	unlink($_POST["image"]);
}
}
header("Location: profile-page.php");
exit();
