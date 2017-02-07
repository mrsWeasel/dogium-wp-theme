( function( $ ) {
	var searchContainer = $('#search-container');

	searchContainer.css('visibility', 'hidden');	

	searchContainer.on('click', function(event){
		// prevent hiding the searchform when clicked (don't bubble up to document)
		event.stopPropagation();
	});

	$(document).on('click', function(event) {
		// hide searchform when something outside of it is clicked
		if (searchContainer.attr('aria-hidden') == 'false') {
			exitSearch();
		}
	});
	
	$('#search-toggle').on('click', function(event) {
		event.stopPropagation();
		if (searchContainer.attr('aria-hidden') == 'true') {
			searchContainer.css('visibility', 'visible');	
			searchContainer.attr('aria-hidden', 'false');
			searchContainer.attr('data-visible', 'true');
			searchContainer.find('.search-field').first().focus();
		} else {
			exitSearch();
		}
	});

	$('#search-container .search-field').on('keydown', function(event) {
		event.stopPropagation();
		if (event.keyCode == 27) {
			exitSearch();
		}
	});

function exitSearch() {
	// wait for the css animation to complete
	setTimeout((function(){searchContainer.attr('aria-hidden', 'true'); searchContainer.css('visibility', 'hidden');}), 500);
	searchContainer.attr('data-visible', 'false');
}

} )( jQuery );