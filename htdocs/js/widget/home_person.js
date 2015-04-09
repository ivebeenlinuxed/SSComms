/**
 * 
 */

$(document).ready(function() {
	$("#person-id").keyup(function(e) {
		person_search($(this).val(), e.which==13);
	});
});

function person_search(id, auto) {
	if (_person_search_timeout) {
		clearTimeout(_person_search_timeout);
	}
	_person_search_timeout = setTimeout(_person_search.bind(null, id, auto), 500);
}
active_person = null;
_person_search_timeout = null;
function _person_search(id, auto) {
	_person_search_timeout = null;
	active_person = null;
	
	if (id.length > 1) {
		$("#person-description").html("Searching...");
		
		if (isNaN(parseInt(id))) {
			$.ajax({
				url: "/widget/home_person/search_list?search="+id,
				success: function(data) {
					$("#person-description").html(data);
				},
				error: function() {
					$("#person-description").html("Oops, couldn't search for people...");
				}
			});
			return;
		}
		
		$.ajax({
			url: "/widget/home_person/search/"+id,
			dataType: "json",
			error: function() {
				$("#person-description").html("An error occurred while searching...");
			},
			success: function(id, auto) {
				return function(data) {
					$("#person-description").html(data.html);
					if (data.exists && data.checkedout) {
						add_fastkey(32, "Space for Check-in", function(id) {
							return function() {
								person_checkin(id);
							}
						}(id));
					}
					
					if (data.exists) {
						active_person = id;
						asset_tryCheckoutActive();
					}

				}
			}(id, auto)
		});
	} else {
		$("#person-description").html("Waiting to search...");
	}
}

function addset_tryCheckoutActive() {
	
}


function person_add() {
	$("#person-add-btn").html("Working the magic...");
	$.ajax({
		url: "/api/person",
		type: "POST",
		data: {
			id: $("#person-id").val(),
			first_name: $("#person-add-fname").val(),
			last_name: $("#person-add-lname").val(),
			phone_number: $("#person-add-phone").val(),
			team: $("#person-add-team").val()
		},
		success: function(id) {
			return function() {
				person_search(id);
			}
		}($("#person-id").val()),
		error: function() {
			$("#person-add-btn").html("Dude - problem. Press me again...");
		}
	});
}

function person_checkin(id) {
	toastr.success("Checked in person #"+id, "person Management");
	person_search(id);
}