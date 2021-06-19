<?php

	include("../functions/functions.php");

	if (isset($_POST['query']) && isset($_POST['api_token']) && isset($_POST['page'])) {

		$query = trim($_POST['query']);

// -----------------------------------------------------------------------------------------
		if ($_POST['api_token'] == "2468543210nuralam543210wrong") {

			if ($_POST['page'] == "search.php" || $_POST['page'] == "videos.php" || $_POST['page'] == "images.php" || $_POST['page'] == "news.php" || $_POST['page'] == "index.php") 
			{
				if (!empty($query)) {
				
					$suggestions = getSearchSuggestion($query);

					if ($suggestions !== null) {
						
						$suggestions = json_decode($suggestions, true);

						if (!empty($suggestions[1])) {
							
							echo '<ul>';

							foreach ($suggestions[1] as $suggestion) {
								
								if ($_POST['page'] == "index.php") {
									echo '
					                    <a href="'.$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace("xmlhttprequests/".basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']).'search?q='.str_replace(" ", "+", $suggestion).'"><li class="search-suggestions">'.$suggestion.'</li></a>
									';
								}
								else{
									echo '
					                    <a href="'.$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace("xmlhttprequests/".basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']).basename($_POST['page'],".php").'?q='.str_replace(" ", "+", $suggestion).'"><li class="search-suggestions">'.$suggestion.'</li></a>
									';
								}
							}

							echo '</ul>';
						}
					}
				}
			}
		}
// -----------------------------------------------------------------------------------------

	}