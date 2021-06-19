$(document).ready(function(){

  $(".image-slider").owlCarousel({
  	margin: 5,
    loop: false,
    autoWidth: true,
    items: 3,
    nav: true,
    dots: false,
   //  responsive: {
   //  	450 : {
	  //       autoplay: true,
	  //       autoplayTimeout:3000,
			// autoplayHoverPause:true,
	  //   },
   //  }
  });

  $(".video-slider").owlCarousel({
  	margin: 5,
    loop: true,
    autoWidth: false,
    items: 4,
    dots: false,
    autoplay:true,
	autoplayTimeout:3000,
	autoplayHoverPause:true,
    responsive : {
    // breakpoint from 0 up
	    0 : {
	        items: 2,
	    },
	    // breakpoint from 480 up
	    450 : {
	        items: 3,
	    },
	    650 : {
	        items: 4,
	    }
	}
  });

  $(".news-slider").owlCarousel({
  	margin: 5,
    loop: true,
    autoWidth: false,
    items: 3,
    dots: false,
    nav: false,
    autoplay:true,
	autoplayTimeout:3000,
	autoplayHoverPause:true,
    responsive: {
    	0 : {
    		items: 1,
    	},

    	350 : {
    		items: 1,
    	}
    }
  });


  // 333333333333333333333

  	$('.video-slider').on('mousewheel', '.owl-stage', function (e) {
	    if (e.deltaY>0) {
	        $('.video-slider').trigger('next.owl');
	    } 
	    else {
	        $('.video-slider').trigger('prev.owl');
	    }
	    e.preventDefault();
	});


  	$('.news-slider').on('mousewheel', '.owl-stage', function (e) {
	    if (e.deltaY>0) {
	        $('.news-slider').trigger('next.owl');
	    } 
	    else {
	        $('.news-slider').trigger('prev.owl');
	    }
	    e.preventDefault();
	});

});