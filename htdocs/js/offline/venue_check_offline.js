$(document).ready(function() {
	if (localStorage['venue_checks'].length > 0 && $("#offline_actions").length > 0) {
		storage = JSON.parse(localStorage['venue_checks']);
		for (i=0; i<storage.length; i++) {
			check = storage[i];
			$("#offline_actions").append("<li><a href='/venue_check/form#"+check.check.id+"'>Venue check for "+check.venue.name+"</a></li>");
		}
	}
});
