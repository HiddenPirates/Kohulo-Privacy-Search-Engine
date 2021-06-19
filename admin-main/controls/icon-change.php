<?php

session_start();

if (!isset($_SESSION['admin_login'])) {
	die('Invalid access');
}

if (isset($_FILES['icon'])) {

	$target_dir = "../../assets/logo/";

	if (!empty($_FILES['icon'])) {

		$image_tmp = $_FILES["icon"]["tmp_name"];

		if ($_FILES["icon"]["size"]/1024 > 10) {
			die('<span class="text-danger">Icon size should be less than 10KB</span>');
		}

		if (!getimagesize($image_tmp)) {
			die('<span class="text-danger">A currupted image.</span>');
		}

		if (mime_content_type($image_tmp) == "image/x-icon" || mime_content_type($image_tmp) == "image/vnd.microsoft.icon" || mime_content_type($image_tmp) == "image/ico" || mime_content_type($image_tmp) == "image/icon" || mime_content_type($image_tmp) == "application/ico") {

			$image_name = "favicon.ico";

			if (move_uploaded_file($image_tmp, $target_dir.$image_name)) {
				die('<span class="text-success">Icon changed successfully.</span>');
			}
			else{
				die('<span class="text-danger">Icon upload failed. May be server permission problem.</span>');
			}
		}
		else{
			die('<span class="text-danger">Image type is not image/x-icon (ico)</span>');
		}

	}
}
else{
	die('<span class="text-danger">Invalid access.</span>');
}