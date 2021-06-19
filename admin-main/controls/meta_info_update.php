<?php

session_start();

if (!isset($_SESSION['admin_login'])) {
	die('Invalid access');
}


if (isset($_POST['site_title'], $_POST['site_description'], $_POST['site_keywords'])) {

	$site_title = htmlspecialchars(trim($_POST['site_title']));
	$site_description = htmlspecialchars(trim($_POST['site_description']));
	$site_keywords = htmlspecialchars(trim($_POST['site_keywords']));

	if (empty($site_title ) || empty($site_description ) || empty($site_keywords )) {
		die("<span class='mb-3 text-danger'>Every fieled is required.</span>");
	}

	include("../../db_config/db_config.php");
	include('../admin_functions/db_functions.php');

	if (updateSiteMetaInfo($site_title, $site_description, $site_keywords)) {
		echo "<span class='mb-3 text-success'>Meta informations updated successfully!</span>";
	}
	else{
		echo "<span class='mb-3 text-danger'>Failed to update meta informations.</span>";
	}
}
else{
	echo "<span class='mb-3 text-danger'>Every fieled is required.</span>";
}

?>