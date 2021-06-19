<?php include("layouts/header.php"); ?>



<!-- ----------------------------------------------------------------- -->
<style type="text/css">
	.nav-devider2 ul #tab-link-web{
		border-bottom: 3px solid #36acb8 !important;
	}
	.nav-devider2 ul #tab-link-web a{
		color: #36acb8;
	}
</style>
<!-- ----------------------------------------------------------------- -->
<div class="result-container">


<!-- +++++++++++++++++++++++++++++++++++++++PHP CODE+++++++++++++++++++++++++++++++++ -->
	<?php

		$api_token = "2468543210nuralam543210";

		$api_file_path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "api/api_web.php", $_SERVER['SCRIPT_NAME']);

		$api_file_path_image = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "api/api_image.php", $_SERVER['SCRIPT_NAME']);

		$api_file_path_videos = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "api/api_videos.php", $_SERVER['SCRIPT_NAME']);

		$api_file_path_news = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "api/api_news.php", $_SERVER['SCRIPT_NAME']);

		$safesearch = getSafeSearchMode();

		$show_only = true;

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
				'safesearch' => $safesearch,
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
			sendMail("Empty $search_result_data. (Search Page)");
			die();
		}

		if ($search_result_data == "invalid access.00" || $search_result_data == "invalid access.01" || $search_result_data == "invalid access.02") {
			sendMail("invalid access.00///invalid access.01///invalid access.02 (Search Page)");
			die();
		}


		$search_result_data = json_decode($search_result_data,true);

// **********************************************************************************************************************
		if (!empty($search_result_data['right_words'])) {
			
			echo '
			<div class="right-keyword-div">
				<span>Showing results for <a href="search?q='.str_replace(" ", "+", $search_result_data['right_words']).'">'.$search_result_data['right_words'].'</a></span>
				<br>
				<span class="span2">Show results only for <a href="search?q=%20'.$query.'&show-only">'.$query.'</a></span>
			</div>
			';
		}

// **********************************************************************************************************************
		if (!empty($search_result_data['instant_Result_Wiki_Info'])) {
			
			@$images_data = file_get_contents($api_file_path_image, false, $context);
			$images_data = json_decode($images_data, true);

			if (empty($images_data)) {
				echo "<style>.wiki_info_image_parent{display:none !important;}</style>";
			}
			else if (empty($images_data['image_informations'])) {
				echo "<style>.wiki_info_image_parent{display:none !important;}</style>";
			}
			
			// 00000000000000000000000000000
			echo '
			<div class="result-div instant-result-div wiki-info-main-div">
				<div class="wiki_info_image_parent">
					<div class="wiki_info_image">';

			$count = 0;
			foreach ($images_data['image_informations'] as $image_information) {
				
				echo '<img src="'.$image_information['image_thumbnail'].'" />';
				$count++;
				if ($count >= 8) {
					break;
				}
			}
			
			echo '
					</div>
					<a href="images?q='.$query.'">
						<button type="button" class="wiki_info_image_view_more_btn">View More</button>
					</a>
				</div>
			';
			// 00000000000000000000000000000
			$wiki_des_text_lenth = strlen($search_result_data["instant_Result_Wiki_Info"]["wiki_info_div_texts"]);

			if ($wiki_des_text_lenth > 440) {
				$expand_btn_html = '<div id="expand-wiki_des"><i class="fas fa-plus"></i> Expand</div>';
			}
			else{
				$expand_btn_html = "";
			}

			echo '
			<div class="wiki-info-head-sub">
				<div class="wiki_info_title_01"> '.$search_result_data["instant_Result_Wiki_Info"]["wiki_info_div_title"].' </div>
				<div class="wiki_info_title_02"> '.$search_result_data["instant_Result_Wiki_Info"]["wiki_info_div_identity"].' </div>	
			</div>

			<div class="wiki_info_description">
				<div class="wiki_info_description_text">
					'.$search_result_data["instant_Result_Wiki_Info"]["wiki_info_div_texts"].'
				</div>
				'.$expand_btn_html.'
			</div>
			';

			if (!empty($search_result_data["instant_Result_Wiki_Info"]["wiki_info_div_links"])) {
				
				echo '<div class="wiki_info_profiles_div">';

				foreach ($search_result_data["instant_Result_Wiki_Info"]["wiki_info_div_links"] as $profile) {
					
					if (strcasecmp($profile['link_title'],"Wikipedia") == 0) {
						
						echo '
						<a href="'.$profile['link'].'">
							<div class="wiki_info_profile">
								<div class="wiki_info_profile_img">
									<img src="assets/web-icons/wikipedia.png" />
								</div>
								<div class="wiki_info_profile_name">
									Wikipedia
								</div>
							</div>
						</a>
						';
					}
					
					if (strcasecmp($profile['link_title'],"Official site") == 0) {
						
						echo '
						<a href="'.$profile['link'].'">
							<div class="wiki_info_profile">
								<div class="wiki_info_profile_img">
									<img src="assets/web-icons/website.png" />
								</div>
								<div class="wiki_info_profile_name">
									Official site
								</div>
							</div>
						</a>
						';
					}
					
					if (strcasecmp($profile['link_title'],"Facebook") == 0) {
						
						echo '
						<a href="'.$profile['link'].'">
							<div class="wiki_info_profile">
								<div class="wiki_info_profile_img">
									<img src="assets/web-icons/facebook.png" />
								</div>
								<div class="wiki_info_profile_name">
									Facebook
								</div>
							</div>
						</a>
						';
					}
					
					if (strcasecmp($profile['link_title'],"Instagram") == 0) {
						
						echo '
						<a href="'.$profile['link'].'">
							<div class="wiki_info_profile">
								<div class="wiki_info_profile_img">
									<img src="assets/web-icons/instagram.png" />
								</div>
								<div class="wiki_info_profile_name">
									Instagram
								</div>
							</div>
						</a>
						';
					}
					
					if (strcasecmp($profile['link_title'],"Twitter") == 0) {
						
						echo '
						<a href="'.$profile['link'].'">
							<div class="wiki_info_profile">
								<div class="wiki_info_profile_img">
									<img src="assets/web-icons/twitter.png" />
								</div>
								<div class="wiki_info_profile_name">
									Twitter
								</div>
							</div>
						</a>
						';
					}
					
					if (strcasecmp($profile['link_title'],"YouTube") == 0) {
						
						echo '
						<a href="'.$profile['link'].'">
							<div class="wiki_info_profile">
								<div class="wiki_info_profile_img">
									<img src="assets/web-icons/youtube.png" />
								</div>
								<div class="wiki_info_profile_name">
									YouTube
								</div>
							</div>
						</a>
						';
					}
					
					if (strcasecmp($profile['link_title'],"IMDb") == 0) {
						
						echo '
						<a href="'.$profile['link'].'">
							<div class="wiki_info_profile">
								<div class="wiki_info_profile_img">
									<img src="assets/web-icons/imdb.png" />
								</div>
								<div class="wiki_info_profile_name">
									IMDb
								</div>
							</div>
						</a>
						';
					}
				}

				echo '</div>';
			}

			if (!empty($search_result_data["instant_Result_Wiki_Info"]["wiki_info_div_lists"])) {
				
				echo '
				<div class="wiki_info_div_lists">
					<ul>';

				foreach ($search_result_data["instant_Result_Wiki_Info"]["wiki_info_div_lists"] as $list) {

					echo '
					<li>
						<span>'.$list["title"].'</span>
						'.$list["description"].'
					</li>
					';
				}

				echo '
					</ul>
				</div>
				';
			}

			echo '</div>';
		}

// **********************************************************************************************************************
		if (!empty($search_result_data['instant_result']) && is_array($search_result_data['instant_result'])) {

			echo '
			<div class="result-div instant-result-div">
				<div class="instant-result-text">
					'.trim(str_replace("*****", "</strong>", str_replace("#####", "<strong>", $search_result_data['instant_result']['text']))).'
				</div>
				<div class="instant-result-title">
					<a href="'.$search_result_data['instant_result']['link'].'">
						'.$search_result_data['instant_result']['title'].'
					</a>
				</div>
				<div class="instant-result-link">
					'.explode("#",$search_result_data['instant_result']['link'])[0].'
				</div>
			</div>
			';
		}
// **********************************************************************************************************************
		if (!empty($search_result_data['search_results'])) {
			
			foreach ($search_result_data['search_results'] as $result_data) {
				
				echo '
				<div class="result-div">
						<div class="result-div1">
							<a href="'.$result_data['link'].'" class="result-title-a-tag">
								<div class="result-title">
									'.$result_data['title'].'
								</div>
							</a>
							<a href="'.$result_data['link'].'">
								<div class="result-url">
									'.$result_data['link'].'
								</div>
							</a>
						</div>
					<div class="divider"></div>
					<div class="result-description">
						'.str_replace("www.bing.com", $site_host_name, $result_data['description']) .'
					</div>
				';

				if (!empty($result_data['subLinks']) && is_array($result_data['subLinks'])) {
					
					echo '<div class="sublinks-div">';

						foreach ($result_data['subLinks'] as $subLink) {
							echo '<div class="sublink"><a href="'.$subLink['subLinkUrl'].'">'.$subLink['sublinkTitle'].'</a></div>';
						}

					echo '
							</div>
						</div>
					';
				}
				else{
					echo "</div>";
				}
			}
		}
		else{
			echo "
				<div class='loader-div-search-page-parent'>
					<div class='loader-div-search-page'>
						<img src='assets/logo/loader.gif' />
					</div>
				</div>
				<style>#next-a{display:none;}</style>
				<script>window.location.reload();</script>
			";
		}

// **********************************************************************************************************************

		if ($search_result_data['video_slider'] == true){

			@$videos_data = file_get_contents($api_file_path_videos, false, $context);
			

			if (empty($videos_data)) {
				echo "<style>.video_slider_div{display:none !important;}</style>";
			}

			if (!isJson($videos_data)) {
				echo "<style>.video_slider_div{display:none !important;}</style>";
			}

			$videos_data = json_decode($videos_data, true);

			if (sizeof($videos_data['results']) > 0) {

				echo '
				<div class="result-div video_slider_div slider-divs">
					<div class="slider-title-and-see-more">
						<div class="slider-title">
							Video Results:
						</div>
						<div class="slider-see-more">
							<a href="videos?q='.$query.'">See More</a>
						</div>
					</div>

					<div class="owl-carousel video-slider">';

						$count = 0;

						foreach ($videos_data['results'] as $result) {

							$video_link = $result["rurl"];
							$thumbnail = $result["turl"];
							$duration = $result["l"];
							$upload_time = $result["age"];
							$total_views = numberFormat($result["views"]);
							$video_title = $result["tit"];
							$video_host = $result["host"];
							
							echo '
							<div>
							  	<a class="video-slider-a-tags" href="'.$video_link.'">
									<div class="video-card-parent2">
								    	<div class="thumb-and-duration-div2">
								    		<div class="thumb-div2">
								    			<img src="'.$thumbnail.'" alt="image" />
								    		</div>
								    		<span>'.$duration.' &nbsp; (Views: '.$total_views.')</span>
								    	</div>
								    	<div class="video-title-div2">'.$video_title.'</div>
								    </div>
								</a>
							  </div>
							';

							$count++;
							if ($count >= 15) {
								break;
							}
						}
					  
					echo '
					</div>
				</div>
				';

			}
		}
		// ######################################################
		if ($search_result_data['image_slider'] == true){


			if (!isset($images_data)) {

				@$images_data = file_get_contents($api_file_path_image, false, $context);
				$images_data = json_decode($images_data, true);

				if (empty($images_data)) {
					echo "<style>.image_slider_div{display:none !important;}</style>";
				}
				else if (empty($images_data['image_informations'])) {
					echo "<style>.image_slider_div{display:none !important;}</style>";
				}

				echo '
				<div class="result-div image_slider_div slider-divs">
					<div class="slider-title-and-see-more">
						<div class="slider-title">
							Image Results:
						</div>
						<div class="slider-see-more">
							<a href="images?q='.str_replace(" ", "+", $query).'">See More</a>
						</div>
					</div>
					<div class="owl-carousel image-slider">';

						$count = 0;

						foreach ($images_data['image_informations'] as $image_information) {
							
							echo '
							<div> 
								<a data-width="'.$image_information['image_width'].'" data-height="'.$image_information['image_height'].'" data-thumbnail="'.$image_information['image_thumbnail'].'" data-fancybox="gallery" data-siteurl="'.$image_information['pageLink'].'" href="'.$image_information['mainImageSrc'].'">
									<img src="'.$image_information['image_thumbnail'].'" class="image-result-images" />
								</a> 
							</div>';

							$count++;
							if ($count >= 15) {
								break;
							}
						}

				echo '</div>
				</div>
				';
			}
			else{

				if (empty($images_data)) {
					echo "<style>.image_slider_div{display:none !important;}</style>";
				}
				else if (empty($images_data['image_informations'])) {
					echo "<style>.image_slider_div{display:none !important;}</style>";
				}

				echo '
				<div class="result-div image_slider_div slider-divs">
					<div class="slider-title-and-see-more">
						<div class="slider-title">
							Image Results:
						</div>
						<div class="slider-see-more">
							<a href="images?q='.str_replace(" ", "+", $query).'">See More</a>
						</div>
					</div>
					<div class="owl-carousel image-slider">';

						$count = 0;
						foreach ($images_data['image_informations'] as $image_information) {
							
							echo '
							<div> 
								<a data-width="'.$image_information['image_width'].'" data-height="'.$image_information['image_height'].'" data-thumbnail="'.$image_information['image_thumbnail'].'" data-fancybox="gallery" data-siteurl="'.$image_information['pageLink'].'" href="'.$image_information['mainImageSrc'].'">
									<img src="'.$image_information['image_thumbnail'].'" class="image-result-images" />
								</a> 
							</div>';

							$count++;
							if ($count >= 12) {
								break;
							}
						}

				echo '</div>
				</div>
				';
			}
		}
		// ######################################################
		if ($search_result_data['news_slider'] == true){

			$news_data = file_get_contents($api_file_path_news, false, $context);

			if (empty($news_data)) {
				echo "<style>.news_slider_div{display:none !important;}</style>";
			}

			if ($news_data == "invalid access.00" || $news_data == "invalid access.01" || $news_data == "invalid access.02") {
				echo "<style>.news_slider_div{display:none !important;}</style>";
			}

			$news_data = json_decode($news_data,true);

			if (!is_array($news_data)) {
				echo "<style>.news_slider_div{display:none !important;}</style>";
			}


			if (sizeof($news_data) !== 0) {

				$news_thumb = "";
				$news_title = "";
				$news_link = "";
				$news_description = "";
				$news_owner_website_name = "";
				$news_published_time = "";

				echo '
				<div class="result-div news_slider_div slider-divs">
						<div class="slider-title-and-see-more">
							<div class="slider-title">
								Latest News:
							</div>
							<div class="slider-see-more">
								<a href="news?q='.$query.'">See More</a>
							</div>
						</div>
						<div class="owl-carousel news-slider">
				';

				$count = 0;

				foreach ($news_data as $result) {

					$news_thumb = $result["news_thumb"];
					$news_title = $result["news_title"];
					$news_link = $result["news_link"];
					$news_description = $result["news_description"];
					$news_owner_website_name = $result["news_owner_website_name"];
					$news_published_time = $result["news_published_time"];
					
					echo '
					  <div>
					  	<div class="news-card-parent2">
							<a href="'.$news_link.'">
								<span>'.$news_title.'</span>
								<div class="owner-siteand-pub-date2">
									<p class="owner_website2">'.$news_owner_website_name.'</p>
									<p class="publish_time2">'.$news_published_time.'</p>
								</div>
								<div class="news-description2">
									<p class="s-desc">'.$news_description.'</p>
								</div>
							</a>
						</div>
					  </div>	
					';

					$count++;
					if ($count >= 12) {
						break;
					}
				}
				echo '
					</div>
				</div>
				';
			}
		}
		// ######################################################

// **********************************************************************************************************************
		if (!empty($search_result_data['related_searches']) && is_array($search_result_data['related_searches'])) {

			echo '
			<div class="related-searches-div">
				<div class="related-searcher-heading">
					Related searches for "'.$query.'"
				</div>';
			
			foreach ($search_result_data['related_searches'] as $related_search) {

				echo '
				<div class="related-searches-keywords">
					<a href="search?q='.str_replace(" ", "+", $related_search).'">'.$related_search.'</a>
				</div>
				';
			}

			echo '</div>';
		}

// **********************************************************************************************************************
		if ($page == 1 || $page < 1) {

			echo '
			<div class="next-prev-div">
				<a href="search?q='.$query.'&page='.($page+1).'" id="next-a">
					<button id="next-btn">Next</button>
				</a>
			</div>
			';
		}
		elseif ($page > 1) {

			echo '
			<div class="next-prev-div">
				<a href="search?q='.$query.'&page='.($page-1).'" id="prev-a">
					<button id="prev-btn">Previous</button>
				</a>
				<a href="search?q='.$query.'&page='.($page+1).'" id="next-a">
					<button id="next-btn">Next</button>
				</a>
			</div>
			';
		}

	?>
<!-- +++++++++++++++++++++++++++++++++++++++PHP CODE+++++++++++++++++++++++++++++++++ -->

</div>

<?php include("layouts/footer.php"); ?>