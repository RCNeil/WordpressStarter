(function ($, root, undefined) { $(function () {	'use strict';

	contentAnimations();
	function contentAnimations() {
		if(Modernizr.csstransitions) {
			$('.animate').css({ "opacity" : 0.0 }); 
			$('.animate').each(function(i) {
				$(this).dequeue().delay(300*i).queue(function(){$(this).addClass('animation');});
			});
		}
	}



}); })(jQuery, this);