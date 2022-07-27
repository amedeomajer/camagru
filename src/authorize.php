<?php

function authorize()
{
		global $pdo;
		if (	isset($_POST['register-email']) &&
				isset($_POST['register-uname']) &&
				isset($_POST['register-pass']) &&
				isset($_POST['re-pass']) &&
				$_POST['re-pass'] == $_POST['register-pass']
			)
			{
				$password = $_POST['register-pass'];
				$uppercase = preg_match('@[A-Z]@', $password);
				$lowercase = preg_match('@[a-z]@', $password);
				$number    = preg_match('@[0-9]@', $password);

				$sql = "SELECT * FROM `user_info` WHERE `email` = ?";
				$result = $pdo->prepare($sql);
				$result->execute(array($_POST["register-email"]));
				$email_duplicate_check = $result->fetch();

				$sql = "SELECT * FROM `user_info` WHERE `userr_name` = ?";
				$result = $pdo->prepare($sql);
				$result->execute(array($_POST["register-uname"]));
				$username_duplicate_check = $result->fetch();

				if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
					header("Location: landing.php?psswd=not_complex");
					exit();
				}
				else if(!empty($username_duplicate_check)) {
					header("Location: landing.php?duplicate=uname");
					exit();
				}
				else if(!empty($email_duplicate_check)) {
					header("Location: landing.php?duplicate=email");
					exit();
				}
				else
					return 1;
			}
		else
		{
			return "Something went wrong<br>";
		}
	}
?>