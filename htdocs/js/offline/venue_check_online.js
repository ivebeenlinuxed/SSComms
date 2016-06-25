$(document).ready(function() {
	do_venue_check_sync();
});

//TODO change to online sync

function do_venue_check_sync() {
	$.ajax({
		url: "/venue_check/sync",
		method: "POST",
		data: {data: localStorage['venue_checks_completed']},
		dataType: "json",
		success: function(data) {
			localStorage['venue_checks'] = JSON.stringify(data);
		}
	});
}
