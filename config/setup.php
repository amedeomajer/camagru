<?php
	session_start();
	include("database.php"); 
	//here we have saved the variables with the
	// info we need to create and operate the database

	// If an exception is thrown within the try{ } block, the script stops
	// executing and flows directly to the first catch(){ } block.

	try // TRY WILL RUN THE CODE AND IF THERE IS AN ERROR IT WILL STOP
	// AT THAT POINT AND RUN THE CODE IN CATCH
	{
		$pdo = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);
		// CREATE A PDO WITH THE VALUES SET IN database.php
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// SET ATTRIBUTES TO THE PDO USING ERROR CHECK METHODS
		$sql = "CREATE DATABASE IF NOT EXISTS `camagru_db`";
		// CREATE THE DATABASE IN SQL LANGUAGE
		$pdo->exec($sql);
		// EXECURE SQL CODE
	}
	catch (PDOException $e)
	{
		echo "Connection failed first part: ".$e->getMessage()."<br>";
	}
	$pdo = null;
	
	// CREATE THE user_info TABLE IN THE DATABASE
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "USE `camagru_db`";
		$pdo->exec($sql);
		$sql = "CREATE TABLE IF NOT EXISTS `user_info` (
			`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`email` VARCHAR(100) NOT NULL,
			`userr_name` VARCHAR(50) NOT NULL,
			`pass_word` VARCHAR(1000) NOT NULL,
			`activation_code` VARCHAR(255) NOT NULL,
			`acti_stat` int(11) NOT NULL,
			`notif_stat` int(11) NOT NULL,
			`reg_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		$pdo->exec($sql);
		$sql = "CREATE TABLE IF NOT EXISTS `user_images` (
			`unique_id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`id` VARCHAR(70) NOT NULL,
			`user_id`INT(11) NOT NULL,
			`upload_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		$pdo->exec($sql);
		$sql = "CREATE TABLE IF NOT EXISTS `user_comments` (
			`unique_id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`value` VARCHAR(300) NOT NULL,
			`image_id` VARCHAR(70) NOT NULL,
			`comment_owner`INT(11) NOT NULL,
			`time_of_post` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		$pdo->exec($sql);
		$sql = "CREATE TABLE IF NOT EXISTS `user_likes` (
			`unique_id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`like_owner` VARCHAR(500) NOT NULL,
			`image_id` VARCHAR(70) NOT NULL,
			`time_of_post` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		$pdo->exec($sql);
	}
	catch (PDOException $e)
	{
		echo "Connection failed 2nd part: ".$e->getMessage();
	}
?>