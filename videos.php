<?php 
include("layouts/header.php");
// include("functions/functions.php");
?>

<!-- ----------------------------------------------------------------- -->
<style type="text/css">
	.nav-devider2 ul #tab-link-videos{
		border-bottom: 3px solid #36acb8 !important;
	}
	.nav-devider2 ul #tab-link-videos a{
		color: #36acb8;
	}
</style>
<!-- ----------------------------------------------------------------- -->

<div class="video-result-container">

	<?php

		$api_token = "2468543210nuralam543210";
		$api_file_path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "api/api_videos.php", $_SERVER['SCRIPT_NAME']);

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
			sendMail("Empty $search_result_data (Videos Page)");
			die();
		}

		if (!isJson($search_result_data)) {
			sendMail("invalid access.00///invalid access.01///invalid access.02 (Videos Page)");
			die();
		}

		$search_result_data = json_decode($search_result_data,true);

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
			echo "<center><h1 style='background: #000; color: #fff;'> No results found..</h1></center><style>.load-btn-container{display:none;}</style>";
		}
	?>
	
</div>


<div class="loader-div-parent">
	<div class="loader-div-child">
		<img src="assets/logo/loader.gif" />
	</div>
</div>

<div class="load-btn-container">
	<button type="button" id="load-more-videos-btn" class="load-more-btn">Load More Videos</button>
</div>

<!-- ----------------------------------------------------- -->

<script>
	
	var page_no = <?=$page;?>;
	let api_token = "2468543210nuralam543210wrong";
	let query = "<?=$query;?>";


	$("#load-more-videos-btn").click(function(){

		$(".loader-div-parent").show();
		page_no++;
		callAjax(query,page_no,api_token);
	});


	function callAjax(query,page_no,api_token) {

		$.post("xmlhttprequests/video_loader.php",
		{
			query: query,
			api_token: api_token,
			page_no: page_no,
		},

		function(data, status){
		    
			if (data !== "") {
				$(".video-result-container").append(data);
				$(".loader-div-parent").hide();
			}
		});
	}

</script>

<?php include("layouts/footer.php");?>