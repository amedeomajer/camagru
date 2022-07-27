<?php
	require_once('../config/setup.php');
	?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Camagru</title>
		<link rel="stylesheet" href="profile-page.css">
		<link rel="stylesheet" href="gallery.css">
		<link rel="stylesheet" href="phone-view.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="load.gallery.profile.js" defer></script>
	</head>
<body>
	<nav>
		<a href="settings.php">
			<img src="../img/icons/settings-icon.png" alt="settings icon">
		</a>
		<a href="homepage.php">
			<h1 class="logo">CAMAGRU</h1>
		</a>
		<img id="camera-icon" src="../img/icons/camera-color.png" alt="camera icon">
		<img id="show-hide-upload-file-container" src="../img/icons/upload-icon.png" alt="">
		<a href="logout.php"><img id="log-out-icon" src="../img/icons/log-out-color.png" alt="camera icon"></a>
	</nav>
	<div id="user-name-container">
		<h2 id="username-display"><?php echo $_SESSION["username"]?></h2>
	</div>
	<div class="main-container" id="main-container">
		<div id="selfie-container">
			<div id="stickers">
				<img id="everyday69" src="../img/stickers/everyday69.png" alt="everyday69 sticker">
				<img id="boomer" src="../img/stickers/boomer.png" alt="boomer sticker">
				<img id="gid95" src="../img/stickers/getting-it-done.png" alt="getting it done sticker">
				<img id="tutan" src="../img/stickers/tutankhamon.png" alt="tutankhamon sticker">
				<img id="up-and-down" src="../img/stickers/up_and_down.png" alt="up and down profanity sticker">
			</div>
			<div id="camera">
				<div id="view-finder">
					<button id="clear-canvas">X</button>
					<video autoplay="true" id="videoElement"></video>
					<div id="sticker-preview"></div>
					<div id="sticker-preview2"></div>
					<canvas id="canvas" width="400" height="300"></canvas>
				</div>
				<form action="loading_page.php" method="post" id="upload-form">
					<textarea name="base64" id="base64" readonly="readonly" hidden></textarea>
					<textarea name="sticker1" id="sticker1" readonly="readonly" hidden></textarea>
					<textarea name="sticker2" id="sticker2" readonly="readonly" hidden></textarea>
					<input type="submit" id="upload" name="upload">
				</form>
				<button id="shutter"><img src="../img/icons/camera_heart-color-cool.png" width="55px"></button>
			</div>
			
		</div>
		<div id="upload-file-container">
			<div id="stickers-upload-file">
				<img id="everyday69_2" src="../img/stickers/everyday69.png" alt="everyday69 sticker">
				<img id="boomer_2" src="../img/stickers/boomer.png" alt="boomer sticker">
				<img id="gid95_2" src="../img/stickers/getting-it-done.png" alt="getting it done sticker">
				<img id="tutan_2" src="../img/stickers/tutankhamon.png" alt="tutankhamon sticker">
				<img id="up-and-down_2" src="../img/stickers/up_and_down.png" alt="up and down profanity sticker">
			</div>
			<form id="upload-file-form" action="loading_page.php" method="post">
				<div id="file-preview" >
					<img id="img-file-preview">
					<div id="sticker-preview_upload"></div>
					<div id="sticker-preview2_upload"></div>
				</div>
				<input type="file" id="myFile" name="filename" accept="image/*" onchange="showPreview(event);" required>
				<textarea name="base64" id="base64_2" readonly="readonly" hidden></textarea>
				<textarea name="sticker1" id="sticker1_2" readonly="readonly" hidden></textarea>
				<textarea name="sticker2" id="sticker2_2" readonly="readonly" hidden></textarea>
				<input type="submit" name="upload" id="upload-file-button">
			</form>
		</div>
		<script src="profile-page.js"></script>
	</div>
	<div id="test">
	</div>
	<?php
		require_once('footer.php');
	?>
</body>
</html>