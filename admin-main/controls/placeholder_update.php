<?php

session_start();

if (!isset($_SESSION['admin_login'])) {
	die('Invalid access');
}


if (isset($_POST['search-box-placeholder'])) {
	
	$search_box_placeholder = htmlspecialchars(trim($_POST['search-box-placeholder']));

	if (empty($search_box_placeholder)) {
		die("<span class='mb-3 text-danger'>Placeholder fieled is required.</span>");
	}

	include("../../db_config/db_config.php");
	include('../admin_functions/db_functions.php');

	if (updatePlaceholder($search_box_placeholder)) {
		echo "<span class='mb-3 text-success'>Placeholders updated successfully!</span>";
	}
	else{
		echo "<span class='mb-3 text-danger'>Failed to update placeholders.</span>";
	}

}
else{
	echo "<span class='mb-3 text-danger'>This fieled is required.</span>";	
}

?>