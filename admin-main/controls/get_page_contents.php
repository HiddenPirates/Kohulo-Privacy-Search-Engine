<?php

session_start();

if (!isset($_SESSION['admin_login'])) {
	die('Invalid access');
}


if (isset($_POST['page_name'])) {

	if (empty($_POST['page_name'])) {
		die("<center><h3 class='text-danger'>Something got wrong.</h3></center>");
	}

	$page_name = htmlspecialchars(trim($_POST['page_name']));

	include("../../db_config/db_config.php");
	include('../../functions/db_functions.php');

	if (getPageData($page_name) !== null) {
		echo getPageData($page_name)['page_contents'];
	}
	else{
		die("<center><h3 class='text-danger'>Page not found.</h3></center>");
	}
}