<?php include('page-layouts/header.php');?>

<script>
	document.querySelector('title').innerHTML = "Settings";
</script>

<br>

<div class="container">
	
	<div class="settings-container" style="margin: 0 auto; max-width: 500px; width: 100%;padding: 0px 20px;">
		<center><h1><b><i class="fas fa-cog"></i> SETTINGS</b></h1></center>

		<div class="alert alert-success alert-dismissible fade show mt-5" role="alert" style="display: none;">
		  Settings saved!
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>

		<form action="" method="post">
			<div class="mt-5">
				<h3>Safe Search:</h3>
			</div>
			<div class="mb-3">
				<select id="search-mode-selection" name="search-mode" class="form-control">
					<option value="off">Off</option>
					<option value="moderate">Moderate</option>
					<option value="strict">Strict</option>
				</select>
			</div>

			<div class="mb-3">
				<button type="submit" name="submit" class="btn btn-primary">Save</button>
			</div>
		</form>

	</div>

</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<!-- ---------------------------------------------- -->

<?php

$cookie_name = "search-mode";

if (isset($_POST['submit'], $_POST['search-mode'])) {
	
	if (!empty($_POST['search-mode'])) {
		
		if ($_POST['search-mode'] == "off" || $_POST['search-mode'] == "moderate" || $_POST['search-mode'] == "strict") {
			
			$cookie_value = $_POST['search-mode'];

			setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
			echo "<script>$('.alert-success').show();window.location.reload();</script>";

		}
	}
}
// ++++++++++++++++++++++++++++++++++++++++++++++++++


if(isset($_COOKIE[$cookie_name])) {
	
	if ($_COOKIE[$cookie_name] == "moderate") {
		echo "<script>$('#search-mode-selection').val('moderate');</script>";
	}
	else if ($_COOKIE[$cookie_name] == "strict") {
		echo "<script>$('#search-mode-selection').val('strict');</script>";
	}
	else if ($_COOKIE[$cookie_name] == "off") {
		echo "<script>$('#search-mode-selection').val('off');</script>";
	}
	else{
		echo "<script>$('#search-mode-selection').val('off');</script>";
	}
}
?>

<?php include('page-layouts/footer.php');?>