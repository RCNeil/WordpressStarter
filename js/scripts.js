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

	mobileToggle();
	function mobileToggle() {
		$('.mobile-menu').click(function(e) {
			e.preventDefault();
			$(this).blur();
			if($('.header').hasClass('opened')) {
				$('.header').removeClass('opened');
			} else {
				$('.header').addClass('opened');
			}
		});	
	}

}); })(jQuery, this);