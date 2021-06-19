<?php

session_start();

if (!isset($_SESSION['admin_login'])) {
	die('Invalid Access');
}


if (isset($_POST['facebook_user_id'], $_POST['instagram_user_id'], $_POST['youtube_user_id'], $_POST['github_user_id'], )) {
	
	$facebook = htmlspecialchars(trim($_POST['facebook_user_id']));
	$instagram = htmlspecialchars(trim($_POST['instagram_user_id']));
	$youtube = htmlspecialchars(trim($_POST['youtube_user_id']));
	$github = htmlspecialchars(trim($_POST['github_user_id']));

	include("../../db_config/db_config.php");
	include('../admin_functions/db_functions.php');

	if (updateSocialLinks($facebook, $github, $youtube, $instagram)) {
		echo '<span class="mb-3 text-success">Social links updated.</span>';
	}
	else{
		die('<span class="mb-3 text-danger">Something went wrong. Failed to update.</span>');
	}
}
else{
	die('<span class="mb-3 text-danger">Invalid access.</span>');
}