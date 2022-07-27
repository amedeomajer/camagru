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
	<link rel="stylesheet" href="homepage.css">
	<link rel="stylesheet" href="gallery.css">
	<link rel="stylesheet" href="phone-view.css">
	<script src="homepage.js" defer></script>
</head>
<body>
	<nav>
		<a href="settings.php" title="Settings">
			<img src="../img/icons/settings-icon.png" alt="settings icon">
		</a>
		<!-- <a href="#"><img id="camera-icon" src="./img/icons/camera_heart-color-cool.png" alt="camera icon"></a> -->
		<a href="profile-page.php" title="Profile page"><img id="camera-icon" src="../img/icons/profille-colors.png" alt="profile icon"></a>
		<h1 class="logo">CAMAGRU</h1>
		<a href="logout.php" title="logout"><img id="log-out-icon" src="../img/icons/log-out-color.png" alt="camera icon"></a>
	</nav>
	<div id="user-name-container">
		<h2 id="username-display"><?php if (isset($_SESSION["username"])) {echo $_SESSION["username"];} ?></h2>
	</div>
	<div class="main-container" id="main-container">
		<?php 
			if(isset($_GET['comment']) && $_GET['comment'] = 'long') {
				echo '<script language="javascript">';
				echo 'alert("comment too long, comments cannot exceed 300 characters!")';
				echo '</script>';
			}
		?>
	</div>
	<?php
		require_once('footer.php');
	?>
</body>
</html>