$(document).ready(function() {
	$(".movimento").fancybox({

		arrows: false,
		mouseWheel: false,
		loop: false,
		
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		
		keys:{	next : {},
			    prev : {},
			close  : [27], // escape key
			play   : [32], // space - start/stop slideshow
			toggle : [70]  // letter "f" - toggle fullscreen
		}

		});
});