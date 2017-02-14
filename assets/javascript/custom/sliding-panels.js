(function( $ ) {
	
	$(document).ready(function() {
		// This shouldn't be hidden as default as 
		// users with JS disabled wouldn't be able to see it at all
		$('#buddypress .activity-comments-container li[id*=acomment-]').css('display', 'none');
		$('#buddypress .activity-comments-container .ac-form-container').css('display', 'none');
		$('#add-event-pane').css('display', 'none');
	});



	$('.comments-toggle').on('click', function(event) {
		console.log('lsdkjlskfd');
		event.stopPropagation();
		$(this).closest('.activity-item').find('.activity-comments-container li[id*=acomment-]').slideToggle();
		$(this).closest('.activity-item').find('.activity-comments-container .ac-form-container').slideToggle();
		if (! $(this).data('toggled')) {
			$(this).data('toggled', true);
			$('#buddypress .activity-comments-container').attr('aria-hidden', false);
		} else {
			$(this).data('toggled', false);
			$('#buddypress .activity-comments-container').attr('aria-hidden', true);
		}

	});

	$('#add-event-pane-toggle').on('click', function(event) {
		event.stopPropagation();
		$('#add-event-pane').slideToggle();

	});

})(jQuery);