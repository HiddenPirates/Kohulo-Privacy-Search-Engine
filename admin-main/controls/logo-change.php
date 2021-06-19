<?php

session_start();

if (!isset($_SESSION['admin_login'])) {
	die('Invalid access');
}

if (isset($_POST['page'], $_FILES['logo'])) {
	
	$target_dir = "../../assets/logo/";

	if (!empty($_POST['page']) && !empty($_FILES['logo'])) {
		
		$image_tmp = $_FILES["logo"]["tmp_name"];

		if ($_FILES["logo"]["size"]/1024 > 100) {
			die('<span class="text-danger">Image size should be less than 100KB</span>');
		}

		if (getimagesize($image_tmp) && strtolower(mime_content_type($image_tmp)) == "image/png" && @imagecreatefrompng($image_tmp)) {
			
			if (strtolower($_POST['page']) == "index") {
				
				$image_name = "logo-main.png";

				if (move_uploaded_file($image_tmp, $target_dir.$image_name)) {
					die('<span class="text-success">Image uploaded successfully.</span>');
				}
				else{
					die('<span class="text-danger">Image upload failed. May be server permission problem.</span>');
				}
			}
			else if (strtolower($_POST['page']) == "search") {

				$image_name = "logo-side.png";

				if (move_uploaded_file($image_tmp, $target_dir.$image_name)) {
					die('<span class="text-success">Image uploaded successfully.</span>');
				}
				else{
					die('<span class="text-danger">Image upload failed. May be server permission problem.</span>');
				}
			}
			else{
				die('<span class="text-danger">No page specified.</span>');
			}

		}
		else{
			die('<span class="text-danger">A currupted image or image type is not PNG</span>');
		}
	}
}
else{

	die('<span class="text-danger">Invalid access.</span>');
}