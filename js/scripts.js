(function ($, root, undefined) { $(function () { 'use strict';

	contentAnimations();
	function contentAnimations() {
		if(Modernizr.csstransitions) {			
			$('.animate').on('inview', function(event, isInView) {
				if (isInView) {
					$(this).addClass('animation');
				}
			});
		}
	}

	menuToggle();
	function menuToggle() {
		$('.menu-toggle').click(function(e) {
			e.preventDefault();
			$(this).blur();
			if($('body').hasClass('nav-opened')) {
				$('body').removeClass('nav-opened');
			} else {
				$('body').addClass('nav-opened');
			}
		});	
	}
	
	$(window).scroll(function() {
		headerScroll();
	});
	headerScroll();
	function headerScroll() {
		var windowHeight = 120;
		var windowTop = $(document).scrollTop();	
		if(  windowTop > windowHeight) {
			$('body').addClass('header-scrolled'); 
		} else {
			$('body').removeClass('header-scrolled'); 	
		}
	}

}); })(jQuery, this);