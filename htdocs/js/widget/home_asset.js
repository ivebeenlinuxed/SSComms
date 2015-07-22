/**
 * 
 */

$(document).ready(function() {
	$("#asset-id").keyup(function(e) {
		asset_search($(this).val(), e.which==13);
	});
	
	$("#asset-checkout-btn").click(asset_checkout_btn);
});

function asset_search(id, auto) {
	if (_asset_search_timeout) {
		clearTimeout(_asset_search_timeout);
	}
	_asset_search_timeout = setTimeout(_asset_search.bind(null, id, auto), 500);
}

active_asset = null;
active_asset_out = null;
_asset_search_timeout = null;
function _asset_search(id, auto) {
	_asset_search_timeout = null;
	active_asset = null;
	if (!isNaN(parseInt(id))) {
		$("#asset-description").html("Searching...");
		$.ajax({
			url: "/widget/home_asset/search/"+id,
			dataType: "json",
			error: function() {
				$("#asset-description").html("An error occurred while searching...");
			},
			success: function(id, auto) {
				return function(data) {
					$("#asset-description").html(data.html);
					if (data.exists && data.checkout) {
						add_fastkey(32, "Space for Check-in asset #"+id, function(id) {
							return function() {
								asset_checkin(id);
							}
						}(id));
					}
					
					if (data.exists) {
						active_asset = id;
						active_asset_out = data.checkout;
						asset_tryCheckoutActive();
					}

				}
			}(id, auto)
		});
	} else if (id.length > 1) {
		$.ajax({
			url: "/widget/home_asset/search_list?search="+id,
			success: function(data) {
				$("#asset-description").html(data);
			},
			error: function() {
				$("#asset-description").html("Oops, couldn't search for assets...");
			}
		});
		return;
	} else {
		$("#asset-description").html("Waiting to search...");
	}
}

function asset_tryCheckoutActive() {
	if (active_asset && active_person && !active_asset_out) {
		$("#asset-checkout-btn").attr("disabled", false);
		add_fastkey(32, "Space for Check-out asset #"+active_asset, asset_checkout_btn);
	} else {
		$("#asset-checkout-btn").attr("disabled", true);
	}
}

function asset_checkout_btn() {
	asset_checkout(active_asset, active_person);
}

function asset_checkout(asset, person) {
	$.ajax({
		url: "/api/equipment_checkout",
		type: "POST",
		data: {equipment: asset, person: person, checkout: (Date.now() / 1000)},
		success: function(asset) {
			return function() {
				toastr.success("Checked out asset #"+asset, "Asset Management");
				$("#asset-id").val("");
				asset_search("");
			}
		}(asset),
		error: function() {
			alert("A problem has occurred");
		}
	});
}


function asset_add() {
	$("#asset-add-btn").html("Working the magic...");
	
	val = $("#asset-id").val();
	
	
	$.ajax({
		url: "/api/equipment.json",
		type: "POST",
		data: {name: val},
		dataType: "json",
		success: function(response) {
			asset_search(response.data.id);
		},
		error: function() {
			$("#asset-add-btn").html("Dude - problem. Press me again...");
		}
	});
}

function asset_checkin(id) {
	toastr.success("Checked in asset #"+id, "Asset Management");
	$.ajax({
		url: "/widget/home_asset/check_in/"+id,
		dataType: "json",
		success: function() {
			$("#asset-id").val("");
			asset_search("");
		},
		error: function() {
			alert("A problem has occurred");
		}
	});
	
}