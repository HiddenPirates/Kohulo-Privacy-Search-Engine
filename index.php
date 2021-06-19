<?php 
include('db_config/db_config.php');
include('functions/db_functions.php');

$site_host_name = $_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html>
<head>

	<meta name="theme-color" content="#36acb8" />
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />

	<meta name="msvalidate.01" content="3B7FA1DBB65A2ABC799DA614662330AB" />
	<!-- Pore ei oporer line ta remove kore dibo inshallah -->
	
	<meta name="robots" content="index, follow" />
	<meta name="description" content="<?php if(isset(getSiteMetaInfo()['site_description'])){echo getSiteMetaInfo()['site_description'];}?>" />
    <meta name="keywords" content="<?php if(isset(getSiteMetaInfo()['site_keywords'])){echo getSiteMetaInfo()['site_keywords'];}?>" />
    
    <meta property="og:url" content="<?=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']; ?>" />
    <meta property="og:site_name" content="<?php echo $site_host_name;?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php if(isset(getSiteMetaInfo()['site_title'])){echo getSiteMetaInfo()['site_title'];}?>" />
    <meta property="og:description" content="<?php if(isset(getSiteMetaInfo()['site_description'])){echo getSiteMetaInfo()['site_description'];}?>">
    <meta property="og:image" content="assets/logo/logo-main.png" />

    <meta name="DC.Title" content="<?php if(isset(getSiteMetaInfo()['site_title'])){echo getSiteMetaInfo()['site_title'];}?>" />
    <meta name="DC.Subject" content="Search Engine">
    <meta name="DC.Description" content="<?php if(isset(getSiteMetaInfo()['site_description'])){echo getSiteMetaInfo()['site_description'];}?>" />
    <meta name="DC.Publisher" content="<?php echo $site_host_name;?>" />
    <meta name="DC.Language" content="en" />

    <meta name="twitter:site" content="@<?php echo($site_host_name);?>" />
    <meta name="twitter:title" content="<?php if(isset(getSiteMetaInfo()['site_title'])){echo getSiteMetaInfo()['site_title'];}?>" />
    <meta name="twitter:description" content="<?php if(isset(getSiteMetaInfo()['site_description'])){echo getSiteMetaInfo()['site_description'];}?>" />
    <meta name="twitter:creator" content="@hiddenpiratesgroup" />
    <meta name="twitter:image" content="assets/logo/logo-main.png" />
    <meta name="twitter:domain" content="<?php echo $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']; ?>" />

    <link rel="shortcut icon" type="image/x-icon" href="assets/logo/favicon.ico" />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/plugins/fancybox/dist/jquery.fancybox.css" />

    <link rel="stylesheet" type="text/css" href="assets/css/index.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/index-media-query.css" />

	<title><?php if(isset(getSiteMetaInfo()['site_title'])){echo getSiteMetaInfo()['site_title'];}?></title>

	<script src="assets/plugins/jquery.js"></script>
    <script src="assets/plugins/fancybox/dist/jquery.fancybox.js"></script>

</head>
<body>

	<nav>
		<ul>
			<li>
				<a href="#" id="nav-3-line-bar">
					<i id="3-line-bar" class="fas fa-bars"></i>
					<i id="close-slide-menu" class="fas fa-times"></i>
				</a>
			</li>
		</ul>
	</nav>
<!-- -------------------------------------------------------------------- -->
	<div class="main-container">
		
		<div class="lg-sbox-container">
			<div class="logo-container">
				<img src="assets/logo/logo-main.png" />
			</div>
			<div class="search-box-container">
				<form action="search" method="get">
					<div class="search-box-parent">
						<div class="input-container">
							<input type="text" autocorrect="off" spellcheck="false" autocomplete="off" autocapitalize="none" name="q" class="query-box" placeholder="<?php getSiteSearchBarPlaceholder();?>" required="true" />
						</div>
						<div class="clear-btn-container">
							<i id="clear-icon" class="fas fa-times"></i>
						</div>
						<div class="search-btn-container">
							<button type="submit"><img oncontextmenu="return false" src="assets/logo/search-icon.png" /></button>
						</div>
					</div>
					<div class="search-suggetion-container">
					</div>
				</form>
			</div>
		</div>

	</div>
<!-- ---------------------------------------------------------------------- -->
	<div class="slide-menu-container">
		<div class="slide-ul-container">
			<ul>
				<a href="page/about"><li><i class="fas fa-user"></i> About</li></a>
				<a href="page/contact"><li><i class="fas fa-phone"></i> Contact</li></a>
				<a href="page/privacy"><li><i class="fas fa-lock"></i> Privacy</li></a>
			</ul>
			<ul>
				<a href="page/settings"><li><i class="fas fa-cog"></i> Settings</li></a>
			</ul>
		</div>
	</div>

<!-- 1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111 -->
<!-- 1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111 -->

<script>

	var colors = ['#9451e0', '#a557ad', '#9797de', '#0e95a1', '#026602'];
	
	$(".query-box").focus(function(){

		var random_color = colors[Math.floor(Math.random() * colors.length)];
		$('.search-box-parent').css(
			{
				'box-shadow' : '0px 1.5px 2px 0px '+random_color,
				'border-top' : '1px solid rgb('+hexToRgb(random_color).r+','+hexToRgb(random_color).g+','+hexToRgb(random_color).b+',0.3)',
			}
		);
		
		if ($(window).width() < 451) {
		   $('.logo-container').css({'margin-top':'0px'});
		}

	});

	$(".query-box").focusout(function(){

		var random_color = colors[Math.floor(Math.random() * colors.length)];
		$('.search-box-parent').css(

			{
				'box-shadow' : '0px 1.5px 2px 0px #888',
				'border-top' : '1px solid lightgrey',
			}

		);
	});

	function hexToRgb(hex) {
	  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	  return result ? {
	    r: parseInt(result[1], 16),
	    g: parseInt(result[2], 16),
	    b: parseInt(result[3], 16)
	  } : null;
	}

// ===============================================================================

	var search_suggestion = document.getElementsByClassName("search-suggestions"); // $(".search-suggestions").text();
	let i = 0;
	let current_pos = 0;

	$(".query-box").first().on( "keydown", function( event ) {

		if (event.which == 40) {

			if (i < current_pos) {
				i = current_pos+1;
			}

			if (i == search_suggestion.length) {

				$(".search-suggestions").css("background","white");

				i = 0;

				search_suggestion[i].style.background = "lightblue";

				$(".query-box").first().val(search_suggestion[i].innerText);

				current_pos =  i;

				i = 1;
			}
			else{

				$(".search-suggestions").css("background","white");

				search_suggestion[i].style.background = "lightblue";

				$(".query-box").first().val(search_suggestion[i].innerText);

				current_pos = i;

				i++;
			}
		}

		else if (event.which == 38) {

			if (i > current_pos) {
				i = current_pos-1;
			}

			if (i < 0) {

				console.log("ggg");

				$(".search-suggestions").css("background","white");

				i = search_suggestion.length-1;

				search_suggestion[i].style.background = "lightblue";

				$(".query-box").first().val(search_suggestion[i].innerText);

				current_pos = i;

				i = i-1;
			}
			else{

				$(".search-suggestions").css("background","white");
				search_suggestion[i].style.background = "lightblue";

				$(".query-box").first().val(search_suggestion[i].innerText);

				current_pos = i;

				i--;
			}
		}

		else if (event.which !== 38 || event.which !== 40) {
			i = 0;
			current_pos = 0;
		}
	});

// ===============================================================================

	function showHideClearBtn(){
		let query = $(".query-box").val();

		if (query !== "") {
			$("#clear-icon").show();
		}
		else{
			$("#clear-icon").hide();
		}
	}

	$("#clear-icon").click(function(){
		$(".query-box").first().val("");
		$(".query-box").first().focus();
	});

	// '''''''''''''''''''''''''

	if ($(".query-box").first().val() == "") {
		$(".search-suggetion-container").hide();
	}


	let timeout = null;

	$(".query-box").first().on( "keyup", function( event ){

		showHideClearBtn();

		

		if (event.which == 40 || event.which == 38) {
			console.log(event.which);
		}
		else{
			if ($(".query-box").first().val() !== "") {

				clearTimeout(timeout);

				timeout = setTimeout(function () {
			        
			        $.post("xmlhttprequests/search_suggestions.php",
					  {
					    query: $(".query-box").first().val(),
					    api_token: "2468543210nuralam543210wrong",
					    page: '<?php echo basename($_SERVER["SCRIPT_NAME"]);?>',
					  },

					  function(data, status){
					    
					    if (data !== "") {
					    	$(".search-suggetion-container").html(data);
					    	$(".search-suggetion-container").show();
					    }
					  });

			    }, 600);
			}
			else{
				$(".search-suggetion-container").hide();
			}
		}
	});

	$("#clear-icon").click(function(){
		if ($(".query-box").first().val() !== "") {
			$.post("xmlhttprequests/search_suggestions.php",
			  {
			    query: $(".query-box").first().val(),
			    api_token: "2468543210nuralam543210wrong",
			    page: '<?php echo basename($_SERVER["SCRIPT_NAME"]);?>',
			  },

			  function(data, status){
			    
			    if (data !== "") {
			    	$(".search-suggetion-container").html(data);
				    $(".search-suggetion-container").show();
			    }
			  });
		}
		else{
			$(".search-suggetion-container").hide();
		}
	});
	
	$(".query-box").focus(function(){

		showHideClearBtn();
		if ($(".query-box").first().val() !== "") {
			$(".search-suggetion-container").show();
		}
	});

	$(".query-box").on("focusout", function(){

		if ($(window).width() < 451) {

			$('.search-suggestions').hover(function(){
				$('.query-box').val($(this).text());
			});

		    setTimeout(function(){
			 	showHideClearBtn();
				$(".search-suggetion-container").hide();
				$('.logo-container').css({'margin-top':'40px'});
			},1000);
			
		}
		else{

			$('.search-suggestions').hover(function(){
				$('.query-box').val($(this).text());
			});
			
			setTimeout(function(){
			 	showHideClearBtn();
				$(".search-suggetion-container").hide();
			},600);
		}
	});


// 000000000000000000000000000000000000000000000000000000000000000000

$('#3-line-bar').click(function(){

	$('.slide-menu-container').css("width", "200px");
	$(this).hide();
	$('#close-slide-menu').show();
});

$('#close-slide-menu').click(function(){

	$('.slide-menu-container').css("width", "0");
	$(this).hide();
	$('#3-line-bar').show();

});

</script>

</body>
</html>