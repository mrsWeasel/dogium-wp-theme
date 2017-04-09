(function( $ ) {
	var inputs = $('#bp-login-widget-form>input[type="text"], #bp-login-widget-form>input[type="password"]');
	inputs.on('blur', function(event) {
		if ( inputs.val() !== '' ) {
		inputs.addClass('focused');
		} else {
			inputs.removeClass('focused');
		}
	});

})(jQuery);