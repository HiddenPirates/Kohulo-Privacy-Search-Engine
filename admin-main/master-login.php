<?php

session_start();

if (isset($_SESSION['admin_login'])) {
	
	http_response_code(301);
	header("location:dashboard.php");
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
	<link rel="icon" href="assets/images/favicon.ico" />

	<script src="../assets/plugins/jquery.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<title>Admin Dashboard</title>
</head>
	<body>

		<div class="container">
			<div class="login-box">

				<div class="login-title">Admin Login</div>

				<div style="display: none;" class="login-status-displayer text-white bg-danger mb-3 text-center"></div>

				<form method="post" action="controls/login" id="admin-login-form">
					<div class="mb-3">
					  <label class="form-label">Username:</label>
					  <input type="text" class="form-control-lg form-control" id="username" name="username" placeholder="Type username...">
					</div>
					<div class="mb-3">
					  <label class="form-label">Password:</label>
					  <input type="password" class="form-control-lg form-control" id="password" name="password" placeholder="Type password...">
					</div>
					<div class="mb-3">
					  <button type="submit" class="form-control-lg btn btn-primary">Login Me</button>
					</div>
				</form>
			</div>
		</div>

<!-- --------------------------------------------- -->

		<script>
			
			$('#admin-login-form').submit(function(event){

				event.preventDefault();

				$('button').text("Logging...");

				let username = $('#username').val();
				let password = $('#password').val();

				if (username !== "" && password !== "") {

					$.post("controls/login",
					  {
					    username: username,
					    password: password,
					  },

					  function(data, status){
					  	$('.login-status-displayer').show().html(data);
					  	$('button').text("Login Me");
					  });
				}
				else{
					$('.login-status-displayer').show().html("Both input field is required");
					$('button').text("Login Me");
				}
			});
		</script>

	</body>
</html>