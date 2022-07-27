<?php
	require_once("../config/setup.php");
	require_once("authorize.php");   // contains function that check that all daata inserted is valid

	if (isset($_POST['register']) && authorize($_POST) == 1)
	{
		$e_mail = $_POST['register-email'];
		$u_name = $_POST['register-uname'];
		$pwd = $_POST['register-pass'];
		$passwd = password_hash($pwd, PASSWORD_BCRYPT);
		$repeat_passwd = $_POST['re-pass'];
		$activation_code = md5($e_mail).time();
		$acti_stat = 0;
		$notif_stat = 1;

		$sql = "INSERT INTO user_info(email, userr_name, pass_word, activation_code, acti_stat, notif_stat)
							VALUES(?, ?, ?, ?, ?, ?)";
		$result = $pdo->prepare($sql);
		$result->execute(array($e_mail, $u_name, $passwd, $activation_code, $acti_stat, $notif_stat)); 
		$email_content = "Click the link to activate your account!\nhttp://localhost:8080/camagru/src/landing.php?token=$activation_code";
		mail($e_mail, "Account activation", $email_content);
		header("Location: landing.php?registration=success");
		exit();
	}
	else
		echo "Check your input and retry";
?>