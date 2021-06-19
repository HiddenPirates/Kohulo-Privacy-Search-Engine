<?php include("layouts/header.php");?>


<!-- ----------------------------------------------------------------- -->
<style type="text/css">
	.nav-devider2 ul #tab-link-image{
		border-bottom: 3px solid #36acb8 !important;
	}
	.nav-devider2 ul #tab-link-image a{
		color: #36acb8;
	}
</style>
<!-- ----------------------------------------------------------------- -->
<!-- div.right-words-div -->
<div class="notifiactions"></div>
<div class="image-result-container">

	<?php
		$unique_id = uniqid();
		$_SESSION[$unique_id] =  array();

		$api_token = "2468543210nuralam543210";
		
		$api_file_path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "api/api_image.php", $_SERVER['SCRIPT_NAME']);

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
			sendMail("Empty $search_result_data (Images Page)");
			die();
		}

		if ($search_result_data == "invalid access.00" || $search_result_data == "invalid access.01" || $search_result_data == "invalid access.02") {
			sendMail("invalid access.00///invalid access.01///invalid access.02 (Images Page)");
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
				echo "<style>.load-btn-container{display:none !important;}</style>";
				echo '<script>$(".notifiactions").html(\'<center><h1 style="background:#000;color:#fff; max-width:800px;">No results found.</h1></center>\')</script>';
			}
// 888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
		}
		else{
			sendMail("Server Error <Array Error>");
			die();
		}

// **********************************************************************************************************************
	?>
	
</div>

<div class="loader-div-parent">
	<div class="loader-div-child">
		<img src="assets/logo/loader.gif" />
	</div>
</div>

<div class="load-btn-container">
	<button type="button" id="load-more-image-btn" class="load-more-btn">Load More Images</button>
</div>

<!-- ------------------------------------------------------------------------------ -->

<script>
	
	var page_no = <?=$page;?>;
	let api_token = "2468543210nuralam543210wrong";
	let cc = "en-<?=$cc;?>";
	let safesearch = "<?=getSafeSearchMode();?>";
	let query = "<?=$query;?>";
	let unique_id = "<?=$unique_id;?>";

	$(document).ready(function() {

	    setTimeout(function(){

	    	page_no++;
	    	// console.log(page_no);

	    	callAjax(query,page_no,api_token,cc,safesearch,unique_id);

	    	// setTimeout(function(){

	    	// 	page_no++;
	    	// 	console.log(page_no);

	    	// 	callAjax(query,page_no,api_token,cc,safesearch);
	    	// },500);

	    },500);

	});


	$("#load-more-image-btn").click(function(){

		$(".loader-div-parent").show();
		page_no++;
		// console.log(page_no);

		callAjax(query,page_no,api_token,cc,safesearch,unique_id);
	});

	// --------------------------------------------------


	$('[data-fancybox="gallery"]').fancybox({

		protect: false,
		loop: false,
		buttons : [ 
			'slideShow',
			'share',
			'zoom',
			'fullScreen',
			'close'
		],

		thumbs : {
			autoStart : false
		},

		image: {
		    // Wait for images to load before displaying
		    //   true  - wait for image to load and then display;
		    //   false - display thumbnail and load the full-sized image over top,
		    //           requires predefined image dimensions (`data-width` and `data-height` attributes)
		    // preload: true
		},

		afterLoad : function( instance, item){

	 		var caption = $(this).data('caption') || '';
			var siteUrl = $(this).data('siteurl') || '';
			var thumbnail = $(this).data('thumbnail');


			if (item.type == 'image') {
				 caption = (caption.length ? caption + '<br><br>' : '') + '<a target="_blank" href="' + item.src + '"> <button class="load-more-btn"> <i class="lni lni-download"></i> View Image</button> </a><br>'
				 + '<br><a target="_blank" href="' + siteUrl + '"> Visit Website </a>';
			}

			return caption;
		},
	});
	// -----------------------------------------------------

	// -----------------------------------------------------

	function callAjax(query,page_no,api_token,cc,safesearch,unique_id) {

		$.post("xmlhttprequests/image_loader.php",
		{
			query: query,
			api_token: api_token,
			page_no: page_no,
			cc: cc,
			safesearch: safesearch,
			unique_id: unique_id,
		},

		function(data, status){
		    
			if (data !== "") {
				$(".image-result-container").append(data);
				$(".loader-div-parent").hide();
			}
		});
	}

</script>

<?php include("layouts/footer.php");?>