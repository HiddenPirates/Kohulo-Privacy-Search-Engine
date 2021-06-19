<?php

session_start();


if (isset($_SESSION['admin_login'], $_POST['page_name'], $_POST['page_contents'])) {
	
	$page_name = trim($_POST['page_name']);
	$page_contents = trim($_POST['page_contents']);

	if (empty($page_name) || empty($page_contents) || strtolower($page_contents) == "<div><br></div>") {
		die('<span class="text-danger mb-3">Page info is require.</span>');
	}

	include("../../db_config/db_config.php");
	include('../admin_functions/db_functions.php');

	if (checkPageExists($page_name)) {
		if (updatePageContents($page_name, $page_contents)) {
			echo('<span class="text-success mb-3">Page updated successfully.</span>');
		}
		else{
			die('<span class="text-danger mb-3">Failed to update page.</span>');
		}
	}
	else{
		if (insertPage($page_name, $page_contents)) {
			echo('<span class="text-success mb-3">Page added successfully.</span>');
		}
		else{
			die('<span class="text-danger mb-3">Failed to add page.</span>');
		}
	}
}
else{
	die('Invalid access.');
}