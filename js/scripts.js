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

}); })(jQuery, this);