<?php
include "../db_config/db_config.php";
include "../functions/db_functions.php";
include "page-layouts/header.php";

$page_name = "privacy";

echo "<div class='container'>";

if (getPageData($page_name) !== null) {
	echo getPageData($page_name)['page_contents'];
}

echo "</div>";

include "page-layouts/footer.php";
?>