<?php
	require_once("../config/setup.php");
	if (isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['log']))
	{
		$u_name = $_POST['uname'];
		$password = $_POST['pass'];
		$sql = "SELECT * FROM `user_info` WHERE `userr_name` = ?";
		$result = $pdo->prepare($sql);
		$result->execute(array($u_name)); 
		$result = $result->fetch();
		if (!empty($result))
		{
			if ($result['acti_stat'] != 1) {
				header("Location: landing.php?login_error=inactive");
				exit();
			}
			$hash = $result['pass_word'];
			if (password_verify($password, $hash) === true)
			{
				$_SESSION['username'] = $u_name;
				$_SESSION['user_id'] = $result['id'];
				$_SESSION['login_permission'] = 1;
				header("Location: homepage.php");
				exit();
			}
			else
			{
				header("Location: landing.php?login_error=password");
				exit();
			}
		}
		else 
		{
			header("Location: landing.php?login_error=username");
			exit();
		}
	}
	if(!isset($_SESSION['login_permission'])){
		header('Location: landing.php');
		exit();
	}
	if(isset($_SESSION['login_permission'])){
		header('Location: homepage.php');
		exit();
	}
?>