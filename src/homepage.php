<?php
	require_once('../config/setup.php');
	
	if (!isset($_SESSION['username']) && !isset($_SESSION['user_id']) && !isset($_SESSION['login_permission']))
		header("Location: landing.php");
	
	require_once('./homepage.view.php');
?>