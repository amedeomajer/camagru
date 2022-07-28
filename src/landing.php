<?php
	require_once("../config/setup.php");
	require_once("activate_account.php");
	require_once("errors.php");

	if (isset($_GET['token']))
	{
		$token = $_GET['token'];
		activate_account($pdo, $token);
	}
	if (isset($_SESSION['login_permission'])) {
		if ($_SESSION['login_permission'] == 1) {
			header("Location: ./homepage.php");
			exit();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
	<link rel="stylesheet" href="login-register-form.css">
    <title>CAMAGRU</title>
</head>

<body>
	<div class="color-palette"></div>
	<nav>
		<h1 class="logo">CAMAGRU</h1>
	</nav>
	<div class="main-container"> <!-- CONTAINER THAT KEEPS THE FORM IN THE CENTRE OF THE PAGE -->
		<div class="login-register"> <!-- CONTAINS THE LOGIN REGISTE BUTTONS AND THE FORMS -->
			<div class="select"> <!-- CONTAINS THE LOGIN REGISTE BUTTONS-->
				<button id="loginBtn" class="login-butt">LOGIN</button>
				<button id="registerBtn" class="register-butt">REGISTER</button>
			</div>	
			<div class="login-form" id="login-form"> <!-- START LOGIN FORM -->
				<h2>LOGIN</h2>
				<form action="login.php" method="post">
					<?php
						if (isset($_GET['recover']) && $_GET['recover'] == 'succesfull')
							echo "Password succesfully reset.<br>";
						if (isset($_GET['login_error']) && $_GET['login_error'] == 'inactive')
							echo "Account not activated, check your inbox and activate your account.<br>";
						if (isset($_GET['delete_account']) && $_GET['delete_account'] == 'no')
							echo "There was an error .<br>";
						if(isset($_GET['psswd']) && $_GET['psswd'] == 'not_complex') 
							echo "Password needs to be at least 8 chars long and have one uppercase, one lowercase and one number<br>";
						if (isset($_GET['registration']))
							echo display_registration_messages($_GET['registration']);
						if (isset($_GET['delete_account']) && $_GET['delete_account'] == 'yes')
							echo "Account deleted, we are sorry to see you go.<br>";
						if (isset($_GET['duplicate']) && $_GET['duplicate'] == 'email')
							echo "Email already in use.<br>";
						if (isset($_GET['duplicate']) && $_GET['duplicate'] == 'uname')
							echo "Username already in use.<br>";
						if(isset($_POST["reco-passwd"]) && !empty($_POST["reco-passwd"]))
						{
							$sql = 'SELECT `email`, `activation_code` FROM `user_info` WHERE `email` = ?';
							$result = $pdo->prepare($sql);
							$result->execute(array($_POST['reco-passwd']));
							$result = $result->fetch();
							if (empty($result["email"])) {
								echo 'Wrong email.<br>';
							}
							if (!empty($result["email"])) {
								$activation_code = $result['activation_code'];
								$email_content = "Click the link to recover your password!\nhttp://localhost:8080/camagru/recover-password.php?token=$activation_code";
								mail($result['email'], "Password recover", $email_content);
								echo 'We have sent a recovery email at '. $result["email"] . '.<br>';
							}
							if (isset($_GET['login_error']))
								echo display_login_messages($_GET['login_error']);
						}
					?>
					<label>User Name</label>
					<br><input type="text" name="uname" id="uname">
					<br><label>Password</label>
					<br><input type="Password" name="pass" id="pass" autocomplete="on">
					<br><input type="submit" name="log" id="log" value="Log In">
					<br><a class="forgot-password" id="forgot-password" href="#">Forgot Password</a><br>
					
					
				</form> 
								<!-- END LOGIN FORM -->
			</div>

			<div id="register-form"> <!-- CONTAINS THE REGISTER FORM -->
				<h2>REGISTER</h2>
				<form action="registration.php" method="POST">  <!-- action="registration.php" method="post"--> 
					<label>User Name</label>
					<br><input type="text" name="register-uname" id="register-uname" required>
					
					<br><label>E-mail</label>
					<br><input type="email" name="register-email" id="register-email" required>
					
					<br><label>Password</label><br>
					<span style="color: #fa26a0;">min 8 characters, at least one uppercase, one lowercase and one number</span>
					<br><input type="password" name="register-pass" id="register-pass" autocomplete="off">
					<br><label>Repeat Password</label>
					<br><input type="Password" name="re-pass" id="re-pass" autocomplete="off">

					<br><input type="submit" name="register" id="register" value="Register" onclick="">
				</form>
			</div>

			<div class="reset-password" id="reset-password"> <!-- CONTAINS THE LOGIN FORM -->
				<h2>RECOVER PASSWORD</h2>
				<form action="landing.php" method="POST">
					<label>E-mail</label>
					<br><input type="email" name="reco-passwd" id="reco-passwd">
					<br><input type="submit" name="recover" id="recover" value="Recover">
				</form>
			</div>
		</div>
		<!-- <script src="load.gallery.profile.js"></script> -->
		<script type="text/javascript" src="index.js">
			</script>
			<div id="gallery">
			
			</div>
			</div>
			<?php
				require_once('footer.php');
			?>
</body>

</html>
