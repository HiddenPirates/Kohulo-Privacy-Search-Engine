<?php
	session_start();
	
	include("../functions/functions.php");

	if (isset($_POST['query']) && isset($_POST['api_token']) && isset($_POST['page_no']) && isset($_POST['cc']) && isset($_POST['safesearch']) && isset($_POST['unique_id'])) {

		$query = str_replace(" ", "+", trim(htmlspecialchars($_POST['query'])));

// -----------------------------------------------------------------------------------------
		if ($_POST['api_token'] == "2468543210nuralam543210wrong" && !empty($_POST['page_no']) && !empty($_POST['unique_id'])) {
			
			if (!empty($query) && isset($_SESSION[$_POST['unique_id']])) {
				
				$unique_id = $_POST['unique_id'];

				$api_token = "2468543210nuralam543210";
				$api_file_path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace("xmlhttprequests/image_loader.php", "api/api_image.php", $_SERVER['SCRIPT_NAME']);
				$safesearch = $_POST['safesearch'];
				$show_only = true;
				$page = $_POST['page_no'];
				$cc = $_POST['cc'];

				if (isset($_GET['show-only'])) {

					$data = array(
						'query' => $query,
						'api-token' => $api_token,
						'show-only' => $show_only,
						'safesearch' => $safesearch,
						'cc' => $cc,
						'page' => $page
					);
				}
				else{

					$data = array(
						'query' => $query,
						'api-token' => $api_token,
						'safesearch' => 'off',
						'cc' => $cc,
						'page' => $page
					);
				}

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
				if (is_array($search_result_data)) {
					
					if (!empty($search_result_data['right_key_words'])) {
						# code...
					}
		// 888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
					if (!empty($search_result_data['image_informations'])) {

						foreach ($search_result_data['image_informations'] as $image_information) {
							
							if (!in_array($image_information, $_SESSION[$unique_id])) {
						
								echo '
								<div class="image-card-parent">
									<div class="blur-div" style=" background: url(\''.$image_information['image_thumbnail'].'\') no-repeat center;background-size: cover;filter: blur(20px);-webkit-filter: blur(5px);"></div>
									<a data-width="'.$image_information['image_width'].'" data-height="'.$image_information['image_height'].'" data-thumbnail="'.$image_information['image_thumbnail'].'" href="'.$image_information['mainImageSrc'].'" data-fancybox="gallery" data-siteurl="'.$image_information['pageLink'].'">
										<img style="filter: blur(0) !important;-webkit-filter: blur(0px) !important;" src="'.$image_information['image_thumbnail'].'" />
										<div class="image-size-div">
											'.$image_information['imageResolution'].'
										</div>
									</a>
								</div>
								';

								$_SESSION[$unique_id][] = $image_information;
							}
						}	
					}
					else{
						echo "<style>#load-more-image-btn{display:none !important;}</style>";
					}
		// 888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
				}
				else{
					die();
				}

			}
		}
// -----------------------------------------------------------------------------------------

	}