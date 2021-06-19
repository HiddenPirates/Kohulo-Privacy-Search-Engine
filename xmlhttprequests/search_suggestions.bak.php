<?php

	include("../functions/functions.php");

	if (isset($_POST['query']) && isset($_POST['api_token']) && isset($_POST['page'])) {

		$query = str_replace(" ", "+", trim(htmlspecialchars($_POST['query'])));

// -----------------------------------------------------------------------------------------
		if ($_POST['api_token'] == "2468543210nuralam543210wrong") {

			if ($_POST['page'] == "search.php" || $_POST['page'] == "videos.php" || $_POST['page'] == "images.php" || $_POST['page'] == "news.php" || $_POST['page'] == "index.php") 
			{
				if (!empty($query)) {
				
					$suggestions = getSearchSuggestion($query);

					if ($suggestions !== null) {
						
						if ($suggestions !== "[]") {
							
							$suggestions = json_decode($suggestions, true);

							echo '<ul>';

							foreach ($suggestions as $suggestion) {
								
								if (is_array($suggestion)) {

									if ($_POST['page'] == "index.php") {
										echo '
						                    <a href="search?q='.str_replace(" ", "+", $suggestion['phrase']).'"><li class="search-suggestions">'.$suggestion['phrase'].'</li></a>
										';
									}
									else{
										echo '
						                    <a href="'.$_POST['page'].'?q='.str_replace(" ", "+", $suggestion['phrase']).'"><li class="search-suggestions">'.$suggestion['phrase'].'</li></a>
										';
									}
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