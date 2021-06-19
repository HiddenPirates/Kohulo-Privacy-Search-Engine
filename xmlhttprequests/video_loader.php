<?php
	
	include("../functions/functions.php");

	if (isset($_POST['query']) && isset($_POST['api_token']) && isset($_POST['page_no'])) {

		$query = str_replace(" ", "+", trim(htmlspecialchars($_POST['query'])));

// -----------------------------------------------------------------------------------------
		if ($_POST['api_token'] == "2468543210nuralam543210wrong" && !empty($_POST['page_no']) && !empty($query)) {
			

				$api_token = "2468543210nuralam543210";
				$api_file_path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace("xmlhttprequests/video_loader.php", "api/api_videos.php", $_SERVER['SCRIPT_NAME']);

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
				if (sizeof($search_result_data['results']) !== 0) {
			
					$video_link = "";
					$thumbnail = "";
					$duration = "";
					$upload_time = "";
					$total_views = "";
					$video_title = "";
					$video_host = "";

					foreach ($search_result_data['results'] as $result) {

						$video_link = $result["rurl"];
						$thumbnail = $result["turl"];
						$duration = $result["l"];
						$upload_time = $result["age"];
						$total_views = numberFormat($result["views"]);
						$video_title = $result["tit"];
						$video_host = $result["host"];
						
						echo '
						<a href="'.$video_link.'">
							<div class="video-card-parent">
						    	<div class="thumb-and-duration-div">
						    		<div class="thumb-div">
						    			<img src="'.$thumbnail.'" alt="image" />
						    		</div>
						    		<span>'.$duration.'</span>
						    	</div>
						    	<div class="video-title-div">'.$video_title.'</div>
						    	<div class="upload-time-and-views-count-div">
						    		<div class="upload-time">'.$upload_time.'</div>
						    		<div class="total-views">Views: '.$total_views.'</div>
						    	</div>
						    	<div class="host">'.$video_host.'</div>
						    </div>
						</a>
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