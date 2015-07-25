
var sliderTimeout;
		function sliderAutoplay(){
		    $( '#slider1' ).trigger( 'nextSlide' );
		    console.log("autoplay");
		    sliderTimeout = setInterval( 'sliderAutoplay', 5000 );
		}

$(document).ready(function(){ 

	/*
	 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
	*/
	$('.fancybox-media')
		.attr('rel', 'media-gallery')
		.fancybox({
			openEffect : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',

			arrows : false,
			helpers : {
				media : {},
				buttons : {}
			}
		});

		$(".fancybox-media").eq(0).trigger('click');



		

		$( '#slider1' ).lemmonSlider({
			infinite: true
		});

	//sliderAutoplay();


		
 });


