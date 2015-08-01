$(document).ready(function() {
	$.ajax({
		url: "/venue_check/sync",
		dataType: "json",
		success: function(data) {
			localStorage['venue_checks'] = JSON.stringify(data);
		}
	});
});
