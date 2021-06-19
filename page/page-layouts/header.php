<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />

	<link rel="stylesheet" type="text/css" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../assets/plugins/fontawesome/css/all.min.css" />
	<link rel="icon" href="../assets/logo/favicon.ico" />

	<script src="../assets/plugins/jquery.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<title>
		<?php
			$self_name = basename($_SERVER['SCRIPT_NAME']);

			if (strtolower($self_name) == "about.php") {
				echo "About Us";
			}
			else if (strtolower($self_name) == "privacy.php") {
				echo "Privacy Policy";
			}
			else if (strtolower($self_name) == "contact.php") {
				echo "Contact Us";
			}
			else if (strtolower($self_name) == "settings.php") {
				echo "Contact Us";
			}
		?>
	</title>
</head>
<body>

