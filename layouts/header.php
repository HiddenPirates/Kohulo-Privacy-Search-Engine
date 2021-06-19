<?php 
session_start();

include('db_config/db_config.php');
include('functions/db_functions.php');
include('functions/functions.php');

$site_host_name = $_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

visitedThisUserOrNot();

?>

<!DOCTYPE html>
<html>
<head>

    <meta name="theme-color" content="#36acb8" />
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />

    <meta name="robots" content="index, follow" />
	<meta name="description" content="<?php if(isset(getSiteMetaInfo()['site_description'])){echo getSiteMetaInfo()['site_description'];}?>" />
    <meta name="keywords" content="<?php if(isset(getSiteMetaInfo()['site_keywords'])){echo getSiteMetaInfo()['site_keywords'];}?>" />
    

    <link rel="shortcut icon" type="image/x-icon" href="assets/logo/favicon.ico" />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/header.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/search.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/search-wiki-info.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/images.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/videos.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/news.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/footer.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/modal.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/owl-slider-custom-css.css" />

    <link rel="stylesheet" type="text/css" href="assets/plugins/owl/dist/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/plugins/owl/dist/assets/owl.theme.default.min.css" />

    <link rel="stylesheet" type="text/css" href="assets/css/search-media-query.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/images-media-query.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/videos-media-query.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/news-media-query.css" />

    <link rel="stylesheet" type="text/css" href="assets/plugins/fancybox/dist/jquery.fancybox.css" />


<!-- ----------------------------------------------------------------------------------- -->
    <?php

    	$query = "";
    	$page = "";
    	$cc = "";

    	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 	   	if (isset($_GET['q']) && !isset($_GET['show-only'])) {
    		$query = trim(htmlspecialchars($_GET['q']));
    	}
    	elseif (isset($_GET['q']) && isset($_GET['show-only'])) {
    		$query = trim(htmlspecialchars($_GET['q']));
    	}

    	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    	if (isset($_GET['cc']) && empty($_GET['cc'])) {
    		$ip = getUserIP();
    		$cc = getCountryCode($ip);
    	}
    	elseif (!isset($_GET['cc'])) {
    		$ip = getUserIP();
    		$cc = getCountryCode($ip);
    	}
    	elseif (isset($_GET['cc']) && !empty($_GET['cc'])) {
    		$cc = trim(htmlspecialchars($_GET['cc']));
    	}

    	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    	if (!isset($_GET['page'])) {
    		$page = 1;
    	}
    	elseif (isset($_GET['page'])) {

    		$page = (int) $_GET['page'];

    		if ($page < 1) {
    			$page = 1;
    		}
    	}

    	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    	if ($query == "") {
    		header("location:/");
    	}
    	if ($cc == null || $cc == "") {
    		$cc = "IN";
    	}

    	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    ?>
<!-- ----------------------------------------------------------------------------------- -->

	<title><?=$query . " - " . substr_replace($site_host_name,"",-1);?></title>

	<script src="assets/plugins/jquery.js"></script>
    <script src="assets/plugins/jquery.mousewheel.min.js"></script>
    <script src="assets/plugins/owl/dist/owl.carousel.min.js"></script>
    <script src="assets/plugins/fancybox/dist/jquery.fancybox.js"></script>
    
</head>
<body>

	<nav>
		<div class="nav-div1">
			<div class="logo-div">
				<img onclick="window.location='index'" id="logo-img" src="assets/logo/logo-side.png" alt="SUDHAO.COM" />
			</div>
		</div>
		<div class="nav-div2">
			<div class="nav-devider1">
				<div class="form-div">
					<form action="<?=basename($_SERVER['SCRIPT_NAME'], ".php");?>" method="get">
						<div class="form-box-parent">
							<div class="input-box">
								<input type="text" autocorrect="off" spellcheck="false" autocomplete="off" autocapitalize="none" name="q" class="query-box" placeholder="<?php getSiteSearchBarPlaceholder();?>" required="true" value="<?=$query;?>" />
							</div>
							<div class="clear-div">
								<span id="clearBtn"><i class="fas fa-times"></i></span>
							</div>
							<div class="search-btn-box">
								<button type="submit" class="search-btn">
									<img oncontextmenu="return false" src="assets/logo/search-icon.png" alt="S" />
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>

<!-- -------------------------------------------------------------------------------------------------------- -->

            <div class="nav-devider3">
                
            </div>

<!-- -------------------------------------------------------------------------------------------------------- -->

			<div class="nav-devider2">
				<ul>
					<li id="tab-link-web"><a href="search?q=<?=$query;?>"><i class="fas fa-search"></i> Web</a></li>
					<li id="tab-link-image"><a href="images?q=<?=$query;?>"><i class="fas fa-images"></i> Images</a></li>
					<li id="tab-link-videos"><a href="videos?q=<?=$query;?>"><i class="fas fa-video"></i> Videos</a></li>
                    <li id="tab-link-news"><a href="news?q=<?=$query;?>"><i class="fas fa-rss"></i> News</a></li>
					<li id="tab-link-maps" onclick="showMapModal()"><a href="#"><i class="fas fa-map-marked"></i> Maps</a></li>						
					<li id="tab-link-more" onclick="showMoreModal()"><a href="#"><i class="fas fa-ellipsis-v"></i> More</a></li>
				</ul>
			</div>

		</div>
	</nav>	

<!-- -------------------------------------------------------------------------------------------------------- -->
    
    <div class="modal-background">
        
        <div class="modal-maps">
            <span onclick="hideAllModal()">X</span>
            <div class="modal-heading">
                <i class="fas fa-map-marked"></i> Maps
            </div>
            <div class="modal-body">
                <a target="_blank" href="https://google.com/maps/search/<?=$query;?>">
                    <button type="button" class="modal-options-btn">
                        <i class="fab fa-google"></i> Google Maps
                    </button>
                </a>
                <br> <div class="modal-btn-spacer-div"></div>
                <a target="_blank" href="https://www.bing.com/maps?q=<?=$query;?>">
                    <button type="button" class="modal-options-btn">
                        <i class="fas fa-map-marker-alt"></i> Bing Maps
                    </button>
                </a>
            </div>
        </div>


        
        <div class="modal-more">
            <span onclick="hideAllModal()">X</span>
            <div class="modal-heading">
                More Options
            </div>
            <div class="modal-body">
                <a target="_blank" href="https://en.wikipedia.org/wiki/Special:Search?search=<?=$query;?>&ns0=1">
                    <button type="button" class="modal-options-btn">
                        <i class="fab fa-wikipedia-w"></i> Wikipedia
                    </button>
                </a>
                <br><div class="modal-btn-spacer-div"></div>
                <a target="_blank" href="https://www.youtube.com/results?search_query=<?=$query;?>">
                    <button type="button" class="modal-options-btn">
                        <i class="fab fa-youtube"></i> YouTube
                    </button>
                </a>
                <br><div class="modal-btn-spacer-div"></div>
                <a target="_blank" href="https://www.amazon.in/s?k=<?=$query;?>">
                    <button type="button" class="modal-options-btn">
                        <i class="fab fa-amazon"></i> Amazon.In
                    </button>
                </a>
            </div>
        </div>

    </div>
