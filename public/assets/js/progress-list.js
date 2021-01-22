'use strict';

// Animate progress-bar
$(".progress-bar").each(function () {
	$(this).animate({
		width: $(this).attr('aria-valuenow') + '%'
	}, 10000);
});
