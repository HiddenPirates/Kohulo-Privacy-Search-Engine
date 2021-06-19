<?php
	
	include("../functions/functions.php");

	if (isset($_POST['query']) && isset($_POST['api_token']) && isset($_POST['page_no'])) {

		$query = str_replace(" ", "+", trim(htmlspecialchars($_POST['query'])));

// -----------------------------------------------------------------------------------------
		if ($_POST['api_token'] == "2468543210nuralam543210wrong" && !empty($_POST['page_no']) && !empty($query)) {
			

				$api_token = "2468543210nuralam543210";
				$api_file_path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace("xmlhttprequests/".basename($_SERVER['SCRIPT_NAME']), "api/api_news.php", $_SERVER['SCRIPT_NAME']);

				$page = $_POST['page_no'];

				$data = array(
						'query' => $query,
						'api-token' => $api_token,
						'page' => $page
					);

				$data_array = http_build_query($data);

				$options = array(
				    'http' => array(
				    	'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
		                    "Content-Length: ".strlen($data_array)."\r\n".
		                    "User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36\r\n",
					    'method' => 'POST',
					    'content' => http_build_query($data)
					)
				);

				$context = stream_context_create($options);
				$search_result_data = file_get_contents($api_file_path, false, $context);

				if (empty($search_result_data)) {
					die();
				}

				if (!isJson($search_result_data)) {
					die();
				}

				$search_result_data = json_decode($search_result_data,true);

		// **********************************************************************************************************************
				if (sizeof($search_result_data) !== 0) {
			
					$news_thumb = "";
					$news_title = "";
					$news_link = "";
					$news_description = "";
					$news_owner_website_name = "";
					$news_published_time = "";

					foreach ($search_result_data as $result) {

						$news_thumb = $result["news_thumb"];
						$news_title = $result["news_title"];
						$news_link = $result["news_link"];
						$news_description = $result["news_description"];
						$news_owner_website_name = $result["news_owner_website_name"];
						$news_published_time = $result["news_published_time"];
						
						echo '
						<div class="news-card-parent">
							<a href="'.$news_link.'">
								<div class="news-thumb-div">
									<img src="'.$news_thumb.'" />
								</div>
								<div class="news-details-div">
									<a href="'.$news_link.'">
										<span>'.$news_title.'</span>
									</a>
									<div class="owner-siteand-pub-date">
										<p class="owner_website">'.$news_owner_website_name.'</p>
										<p class="publish_time">'.$news_published_time.'</p>
									</div>
									<div class="news-description">'.$news_description.'</div>
								</div>
							</a>
						</div>
						';
					}
				}
				else{
					echo "<style>.load-btn-container{display:none !important;}</style>";
				}
		}
		else{
			echo "<style>.load-btn-container{display:none !important;}</style>";
		}
// -----------------------------------------------------------------------------------------

	}
	else{
		echo "string";
	}