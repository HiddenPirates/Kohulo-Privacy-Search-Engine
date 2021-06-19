
<?php include('footer-html.php');?>

<script type="text/javascript">
	
	var colors = ['#9451e0', '#a557ad', '#9797de', '#0e95a1', '#026602'];

	$(".query-box").first().focusin(function(){

		var random_color = colors[Math.floor(Math.random() * colors.length)];

		$(".form-box-parent").first().css(
			{
				'box-shadow' : '0px 1px 2px 0px'+random_color,
				'border' : '1px solid rgb('+hexToRgb(random_color).r+','+hexToRgb(random_color).g+','+hexToRgb(random_color).b+',0.3)',
			}
		);

		showHideClearBtn();
	});
 	// ****************************************************
	$(".query-box").first().focusout(function(){
		
		$(".form-box-parent").first().css(
			{
				"box-shadow" : "0px 1px 2px 0px #888",
				"border" : "1px solid lightgrey"
			}
		);

		showHideClearBtn();
	}); 
// --------------------------------------------------------------------------
	$(".query-box").first().keydown(function(){
		showHideClearBtn();
	});
	$(".query-box").first().keyup(function(){
		showHideClearBtn();
	});

// --------------------------------------------------------------------------
	function hexToRgb(hex) {
	  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	  return result ? {
	    r: parseInt(result[1], 16),
	    g: parseInt(result[2], 16),
	    b: parseInt(result[3], 16)
	  } : null;
	}


	function showHideClearBtn(){
		let query = $(".query-box").val();

		if (query !== "") {
			$("#clearBtn").css("display", "block");
		}
		else{
			$("#clearBtn").css("display", "none");
		}
	}
// --------------------------------------------------------------------------
	$("#clearBtn").click(function(){
		$(".query-box").first().val("");
		$(".query-box").first().focus();
	});

	// ----------------------------------------------------------------------

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

// --------------------------------------------------------------------------------
	if ($(".query-box").first().val() == "") {
		$(".nav-devider3").hide();
	}


	let timeout = null;

	$(".query-box").first().on( "keyup", function( event ){

		if (event.which == 40 || event.which == 38) {
			console.log(event.which);
		}
		else{
			if ($(".query-box").first().val() !== "") {

				clearTimeout(timeout);

				timeout = setTimeout(function() {

					$.post("xmlhttprequests/search_suggestions.php",
					  {
					    query: $(".query-box").first().val(),
					    api_token: "2468543210nuralam543210wrong",
					    page: '<?php echo basename($_SERVER["SCRIPT_NAME"]);?>',
					  },

					  function(data, status){
					    
					    if (data !== "") {
					    	$(".nav-devider3").html(data);
					    	$(".nav-devider3").css("display","block");
					    }
					  });

				}, 600);
				
			}
			else{
				$(".nav-devider3").css("display","none");
			}
		}
	});

	$("#clearBtn").click(function(){
		if ($(".query-box").first().val() !== "") {
			$.post("xmlhttprequests/search_suggestions.php",
			  {
			    query: $(".query-box").first().val(),
			    api_token: "2468543210nuralam543210wrong",
			    page: '<?php echo basename($_SERVER["SCRIPT_NAME"]);?>',
			  },

			  function(data, status){
			    
			    if (data !== "") {
			    	$(".nav-devider3").html(data);
				    $(".nav-devider3").css("display","block");
			    }
			  });
		}
		else{
			$(".nav-devider3").css("display","none");
		}
	});
	
	$(".query-box").focus(function(){

		if ($(".query-box").first().val() !== "") {

			$.post("xmlhttprequests/search_suggestions.php",
			 {
			   query: $(".query-box").first().val(),
			   api_token: "2468543210nuralam543210wrong",
			   page: '<?php echo basename($_SERVER["SCRIPT_NAME"]);?>',
			 },

			 function(data, status){
			    
			   if (data !== "") {
			   	$(".nav-devider3").html(data);
			    $(".nav-devider3").css("display","block");
			   }
			});
		}
	});

	$(".query-box").on("focusout", function(){

		 setTimeout(function(){
		 	showHideClearBtn();
			$(".nav-devider3").hide();
		},600);
	});

// --------------------------------------------------------------------------

function showMapModal(){
	$(".modal-background").show();
	$(".modal-maps").show();
}

function showMoreModal(){
	$(".modal-background").show();
	$(".modal-more").show();
}

function hideAllModal(){
	$(".modal-background").hide();
	$(".modal-maps").hide();
	$(".modal-more").hide();
	// $(".modal-more").hide();
}
// --------------------------------------------------------------------------------

$("#expand-wiki_des").click(function(){

	$('.wiki_info_description_text').css({
		"display":"block",
		"overflow":"auto",
	});
	$(this).hide();

});
</script>

<script src="assets/plugins/popper.js"></script>
<script src="assets/plugins/tippy.js"></script>
<script>
	tippy('[data-tippy-content]');
</script>

<script src="assets/js/owl-slider-custom-codes.js"></script>

</body>
</html>