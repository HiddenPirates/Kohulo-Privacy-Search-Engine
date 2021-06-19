<?php

session_start();

if (!isset($_SESSION['admin_login'])) {

	http_response_code(301);
	header('location:index');
	die();
}

?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />

	<link rel="stylesheet" type="text/css" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../assets/plugins/fontawesome/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/master-login.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/dashboard.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/dashboard-media.css" />
	<link rel="icon" href="assets/images/favicon.ico" />

	<script src="../assets/plugins/jquery.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	
	<!-- <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script> -->

	<link rel="stylesheet" type="text/css" href="assets/plugins/rich-text-editor/src/richtext.min.css" />
	<script src="assets/plugins/rich-text-editor/src/jquery.richtext.min.js"></script>

	<title>Admin Dashboard</title>
</head>
<body>

<div class="container">
	<nav class="mt-2 navbar navbar-expand-lg navbar-dark bg-primary" style="border-radius: 15px 15px 15px 15px;">
	  <div class="container-fluid">
	    <a class="navbar-brand" style="font-weight: bold !important;" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarText">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	      </ul>
	      <span class="navbar-text">
	        <a class="nav-link active" style="font-weight: bold !important;" href="controls/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
	      </span>
	    </div>
	  </div>
	</nav>