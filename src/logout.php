<?php
	require_once('../config/setup.php');

	session_destroy();
	header("Location: landing.php");

?>