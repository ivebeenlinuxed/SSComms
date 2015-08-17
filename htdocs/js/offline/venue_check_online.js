$(document).ready(function() {
	$.ajax({
		url: "/venue_check/sync",
		method: "POST",
		data: 
		dataType: "json",
		success: function(data) {
			localStorage['venue_checks'] = JSON.stringify(data);
		}
	});
});

function do_venue_status_update() {
	
}
