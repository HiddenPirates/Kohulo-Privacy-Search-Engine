<?php

session_start();

if (isset($_SESSION['admin_login'])) {
	
	unset($_SESSION['admin_login']);

	header("location: ../index");
}
else{
	header("location: ../index");
}