(function($) {
	'use strict';
	$(document).ready(function() {
		var smoothUp = $('.wct-smooth-up');
		$(window).on('scroll', function() {
			var scrollTop = $(this).scrollTop();
			if(scrollTop < 1000) {
				smoothUp.fadeOut();
			} else {
				smoothUp.fadeIn();
			}
		});

		$(document).on('click', '.wct-smooth-up', function() {
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			return false;
		});

		$('.color-picker').wpColorPicker();

		$('#wct_story_date').Zebra_DatePicker({
			format: 'm/d/Y h:i a',
			readonly_element: false,
			show_clear_date: true,
			disable_time_picker: false,
			view: 'years'
		});


	});
})(jQuery);
