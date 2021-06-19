<?php

session_start();

if (isset($_POST['username'], $_POST['password'])) {
	
	$post_username = sha1($_POST['username']);
	$post_password = sha1($_POST['password']);

	include("../../db_config/db_config.php");
	include('../admin_functions/db_functions.php');

	if (validateLogin($post_username,$post_password)) {

		$_SESSION['admin_login'] = true;

		echo "<script>window.location.href='dashboard';</script>";
		// http_response_code(301);
		// header("location:dashboard.php");
	}
	else{
		echo "Invalid username or password.";
	}
}
else{
	http_response_code(404);
	header("location:404");
}