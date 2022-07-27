<?php
	require_once("../config/setup.php");

	function display_login_messages($message)
	{
		if ($message === "password")
			return "<br><p>Wrong Password</p><br>";
		else if ($message === "username")
			return "<br><p>wrong Username</p><br>";
	}

	function display_registration_messages($message)
	{
		if ($message === "success")
			return "An email has been sent!<br>";
		else
			return "There was some problem with the registration, please try again";
	}
?>