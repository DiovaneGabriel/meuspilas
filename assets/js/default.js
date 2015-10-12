$(document).ready(function() {
	$(".movimento").fancybox({

		arrows: false,
		width: '400',
		height: '400',
		mouseWheel: false,
		loop: false,
		keys:{	next : {},
			    prev : {},
			close  : [27], // escape key
			play   : [32], // space - start/stop slideshow
			toggle : [70]  // letter "f" - toggle fullscreen
		}

		});
});