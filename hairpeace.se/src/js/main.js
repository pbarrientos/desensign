
	(function () {
		'use strict';
		$(document).ready(function(){

		//Scroll to sections
		$(".menu-item a.menu-link").click(function(event) {
			event.stopPropagation();
			var link = $(this).data('link');
			if(link){
				scrollToAnchor(link);
			}
			
		});


		//GALLERIA
		Galleria.loadTheme('./galleria/themes/classic/galleria.classic.min.js');
		Galleria.configure({
			imageCrop: false
		});
		Galleria.run('.galleria');
	});

		function scrollToAnchor(id){
			var divTag = $("#"+id);
			$('html,body').animate({scrollTop: divTag.offset().top},'slow');
		}

		function scrollToDiv(element){
			var offset = element.offset();
			var offsetTop = offset.top - 40;
			$('body,html').animate({
				scrollTop: offsetTop
			}, 500);
		}

	// Scroll to top
	$('#back-top').click(function(){
		$('html,body').animate({scrollTop:0},500);
	});

	// Back to top button
	$(window).on('scroll touchstart',function(e){
		if($(window).scrollTop() > 500 && $(window).width() < 768){
			$('#back-top').show();
		}
		else{
			$('#back-top').hide();
		}
	});


	}());