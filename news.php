<?php include("layouts/header.php");?>


<!-- ----------------------------------------------------------------- -->
<style type="text/css">
	.nav-devider2 ul #tab-link-news{
		border-bottom: 3px solid #36acb8 !important;
	}
	.nav-devider2 ul #tab-link-news a{
		color: #36acb8;
	}
</style>
<!-- ----------------------------------------------------------------- -->
<div class="result-container">


	<?php

		$api_token = "2468543210nuralam543210";
		$api_file_path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "api/api_news.php", $_SERVER['SCRIPT_NAME']);

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
			sendMail("Empty (News Page)");
			die();
		}

		if ($search_result_data == "invalid access.00" || $search_result_data == "invalid access.01" || $search_result_data == "invalid access.02") {
			sendMail("invalid access.00///invalid access.01///invalid access.02 (News Page)");
			die();
		}

		$search_result_data = json_decode($search_result_data,true);

		if (!is_array($search_result_data)) {
			die('<center><h1 style="background:#000;color:#fff;">No results......</h1></center>');
		}


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
			echo '
			<style>.load-btn-container{display:none !important;}</style>
			<center><h1 style="background:#000;color:#fff;">No results found.</h1></center>
			';
		}
	?>

</div>


<div class="loader-div-parent">
	<div class="loader-div-child">
		<img src="assets/logo/loader.gif" />
	</div>
</div>

<div class="load-btn-container">
	<button type="button" id="load-more-news-btn" class="load-more-btn">Load More News</button>
</div>


<!-- ----------------------------------------------------- -->

<script>
	
	var page_no = <?=$page;?>;
	let api_token = "2468543210nuralam543210wrong";
	let query = "<?=$query;?>";


	$("#load-more-news-btn").click(function(){

		$(".loader-div-parent").show();
		page_no++;
		callAjax(query,page_no,api_token);
	});


	function callAjax(query,page_no,api_token) {

		$.post("xmlhttprequests/news_loader.php",
		{
			query: query,
			api_token: api_token,
			page_no: page_no,
		},

		function(data, status){
		    
			if (data !== "") {
				$(".result-container").append(data);
				$(".loader-div-parent").hide();
			}
			else{
				$(".loader-div-parent").hide();
			}
		});
	}

</script>

<?php include("layouts/footer.php");?>