<?php

session_start();

if (isset($_SESSION['admin_login'])) {
	
	if ($_SESSION['admin_login'] == true) {
		
		http_response_code(301);
		header("location:dashboard.php");
	}
	else{
		
		http_response_code(403);
		echo "Invalid Login";
	}
}
else{
	
	http_response_code(301);
	header("location:master-login.php");
}