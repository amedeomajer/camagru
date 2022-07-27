<?php
	require_once('../config/setup.php');
	$user = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="settings.css">
	<!-- <link rel="stylesheet" href="phone-view.css"> -->
	<title>Camagru</title>
	<style>
nav img {
	max-width: 32px;
	width: 6vw;
}
.logo {
	font-size: 6vw;
}
nav {
	background-color: #333;
	overflow: hidden;
	height: 49px;
	z-index: 1234;
	display: flex;
	justify-content: space-evenly;
	align-items: center;
	align-content: center;
}
a {
	text-decoration: none;
	color: white;
}
a:hover {
	text-shadow: 2px 2px 0 #ff9cd6, 4px 4px 0 #a3f7bf;
	-webkit-text-shadow: 2px 2px 0 #ff9cd6, 4px 4px 0 #a3f7bf;
}
@media screen and (min-width: 600px) {
	.logo {
	font-size: 30px;
	}
}
	</style>
</head>
<body>
	<nav>
		<a href="profile-page.php"><img id="camera-icon" src="../img/icons/profille-colors.png" alt="profile icon"></a>
		<a href="homepage.php"><h1 class="logo">CAMAGRU</h1></a>
		<a href="logout.php"><img id="log-out-icon" src="../img/icons/log-out-color.png" alt="camera icon"></a>
	</nav>
	<div id="settings-main">
		<div id='message'>
			<span>
				<?php
					if(isset($_GET['message'])) {

					}
				?>
			</span>
		</div>
		<form action="settings.php" method="POST">
				<label class="switch">
					<?php 
						$sql = "SELECT `notif_stat` FROM `user_info` WHERE `id` = ?";
						$result = $pdo->prepare($sql);
						$result->execute(array($_SESSION["user_id"]));
						$notification_status = $result->fetch();
						if ($notification_status["notif_stat"] === 1)
							echo '<label>
							Notifications: 
							</label>  <br>
							<input type="radio" class="notification-radio" name="notification-radio" value="on" checked/> ON  
							<br>
							<input type="radio" class="notification-radio" name="notification-radio" value="off"/> OFF <br/>';
						else
							echo '<label>
							Notifications: 
							</label>  <br>
							<input type="radio" class="notification-radio" name="notification-radio" value="on"/> ON  
							<br>
							<input type="radio" class="notification-radio" name="notification-radio" value="off" checked/> OFF <br/>';
					?>
				</label>
				<input type="submit" name="save-settings"><br>
				<?php 
					if(isset($_GET['message'])) {
						if($_GET['message'] == 'notif-on')
							echo 'notification emails turned on';
						if($_GET['message'] == 'notif-off')
							echo 'notification emails turned off';
					}
				?>
		</form>
		<hr>
		<form action="settings.php" method="post">
			<span>change email</span>
			<br>
			<input type="email" name="new-email" class="settings-textarea" cols="30" rows="1" required>
			<br>
			<input type="submit" name="save-settings">
			<br>
			<?php 
				if(isset($_GET['message'])) {
					if($_GET['message'] == 'email_1')
						echo 'Your email has been successfully updated';
					if($_GET['message'] == 'email_0')
						echo 'That email is already in use';
				}
			?>
			<br>
		</form>
		<hr>
		<form action="settings.php" method="post">
			<span>change username</span>
			<br>
			<textarea  name="new-username" class="settings-textarea" cols="30" rows="1" required></textarea>
			<br>
			<input type="submit" name="save-settings">
			<br>
			<?php 
				if(isset($_GET['message'])) {
					if($_GET['message'] == 'uname_1')
						echo 'Your user name has been successfully updated';
					if($_GET['message'] == 'uname_0')
						echo 'That user name is already in use';
				}
			?>
			<br>
		</form>
		<hr>
		<form action="settings.php" method="post">
			<span>change password</span>
			<br>
			<span>new password</span>
			<br>
			<input type="password" name="new-password" class="settings-textarea" cols="30" rows="1" autocomplete="off" required>
			<br>
			<span>old password</span>
			<br>
			<input type="password" name="old-password" class="settings-textarea" cols="30" rows="1" autocomplete="off" required>
			<br>
			<input type="submit" name="save-settings">
			<br>
			<?php 
				if(isset($_GET['message'])) {
					if($_GET['message'] == 'pword_0')
						echo 'Please insert the correct old password';
					if($_GET['message'] == 'pword_1')
						echo 'Password succesfully updated';
					if($_GET['message'] == 'pword_2')
						echo 'Please create a new password min 8 characters long.<br>Contaning at least 1 uppercase letter<br>1 lowercase letter<br>and 1 number.';
				}
			?>
			<br>
		</form>
		<hr>
		<br>
		<div>
			!DELETE ACCOUNT!
			<form action="delete-account.php" method="post"> <br>
			email
			<input type="email" name="email" required> <br>
			password
			<input type="password" name="password" autocomplete="off" required> <br>
			<input type="submit" name="delete-account" value="delete"><br>
			</form>
			<hr>
		</div>
	</div>
</body>
</html>

