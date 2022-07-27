<?php
	require_once('../config/setup.php');
	if (isset($_POST['upload']))
	{
		
		if(isset($_POST['filename'])) {
			if (strstr($_POST['filename'], '.png') == false && strstr($_POST['filename'], '.jpeg') == false) {
				header('Location: profile-page.php?file=notimage');
				exit();
			}
		}
			$photo_name =  uniqid() . '.png'; // set file name
			$file = "../img/user_images/" . $photo_name; // set file path
			$b64 = $_POST['base64'];
			$b64 = str_replace('data:image/png;base64,', '', $b64);
			$b64 = str_replace('data:image/jpeg;base64,', '', $b64);
			$b64 = str_replace(' ', '+', $b64);
			$data = base64_decode($b64);

			$success = file_put_contents($file, $data); // write image data into that file
			$sql = "INSERT INTO `user_images`(`id`, `user_id`) VALUES(?, ?)";
			$result = $pdo->prepare($sql);
			$result->execute(array($file, $_SESSION["user_id"]));
			if ($_POST["sticker1"] != "" && isset($_POST["sticker1"]))
			{
				$im = imagecreatefrompng($file);
				$stamp1 = imagecreatefrompng($_POST["sticker1"]);
				$sx = imagesx($stamp1);
				$sy = imagesy($stamp1);
				imagecopy($im, $stamp1, imagesx($im) - $sx, 0, 0, 0, imagesx($stamp1), imagesy($stamp1));
				imagepng($im, $file, 0);
				imagedestroy($im);
			}
			if ($_POST["sticker2"] != "" && isset($_POST["sticker2"]))
			{
				$im = imagecreatefrompng($file);
				$stamp2 = imagecreatefrompng($_POST["sticker2"]);
				$sx = imagesx($stamp2);
				$sy = imagesy($stamp2);
				imagecopy($im, $stamp2, 0, imagesy($im) - $sy, 0, 0, imagesx($stamp2), imagesy($stamp2));
				imagepng($im, $file, 0);
				imagedestroy($im);
			}
			header("Location: profile-page.php");
		}
?>


<!-- sticker w: 400px h: 301px 
	sticker 1 center top
	sticker 2 center bottom

	$_POST["base64"]
	$_POST["sticker1"]
	$_POST["sticker2]
	$_POST["upload"]=> string(6) "Submit"
	$_SESSION["username"]
	$_SESSION["user_id"]
	$_SESSION["login_permission"]


-->