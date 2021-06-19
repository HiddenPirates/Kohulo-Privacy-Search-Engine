<?php

session_start();

if (!isset($_SESSION['admin_login'])) {
	die('Invalid access');
}


if (isset($_POST['old_username'], $_POST['old_password'], $_POST['new_username'], $_POST['new_password'])) {
	
	$old_username = sha1($_POST['old_username']);
	$old_password = sha1($_POST['old_password']);
	$new_username = sha1($_POST['new_username']);
	$new_password = sha1($_POST['new_password']);

	if (empty($old_username) || empty($old_password) || empty($new_username) || empty($new_password)) {
		die("<span class='mb-3 text-danger'>Every fieled is required.</span>");
	}

	include("../../db_config/db_config.php");
	include('../admin_functions/db_functions.php');

	if (updateUsernameAndPassword($new_username, $new_password, $old_username, $old_password)) {
		echo "<span class='mb-3 text-success'>Login credentials updated successfully!</span>";
	}
	else{
		echo "<span class='mb-3 text-danger'>Failed to update login credentials. May be you are giving wrong username or password.</span>";
	}
}
else{
	die("<span class='mb-3 text-danger'>Every fieled is required..</span>");
}