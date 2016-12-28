(function ($, root, undefined) { $(function () {	'use strict';

	contentAnimations();
	function contentAnimations() {
		if(Modernizr.csstransitions) {
			$('.animate').each(function(i) {
				$(this).dequeue().delay(300*i).queue(function(){$(this).addClass('animation');});
			});
		}
	}



}); })(jQuery, this);