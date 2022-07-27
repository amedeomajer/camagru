<?php
	require_once('../config/setup.php');

	if (isset($_SESSION['login_permission'])) {
		if ($_SESSION['login_permission'] == 1) {
			if(isset($_GET['comment']) && $_GET['comment'] = 'long') {
				echo '<script language="javascript">';
				echo 'alert("comment too long, comments cannot exceed 300 characters!")';
				echo '</script>';
			}
			if(isset($_GET['file']) && $_GET['file'] = 'notimage') {
				echo '<script language="javascript">';
				echo 'alert("Please select an image file, jpeg or png!")';
				echo '</script>';
			}
			require_once('profile-page.view.php');
		} else {
			header('Location: landing.php');
		}
	} else {
		header('Location: landing.php');
	}
?>