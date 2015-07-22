HomeActivations = new Object();

HomeActivations.StartLoop = function() {
	HomeActivations._doLoop();
}

HomeActivations.StopLoop = function() {
	if (HomeActivations._checkTimeout) {
		clearTimeout(HomeActivations._checkTimeout);
	}
}

HomeActivations._doLoop = function() {
	HomeActivations.CheckForUpdates();
	if (HomeActivations._checkTimeout) {
		clearTimeout(HomeActivations._checkTimeout);
	}
	HomeActivations._checkTimeout = setTimeout(HomeActivations._doLoop, 3000);
}

HomeActivations.TryActivate = function(person_id, code) {
	$.ajax({
		url: "/home/try_activate",
		dataType: "json",
		type: "post",
		data: {id: person_id, verify: code},
		success: function(data) {
			if (data.success) {
				toastr.success("Device has been activated", "Device Active");
			} else {
				toastr.error("The activation code was invalid", "Device Denied");
			}
		}
	})
}

HomeActivations.CheckForUpdates = function() {
	if ($(".home-activations-active").is(":focus")) {
		return;
	}
	$.ajax({
		url : "/home/get_activations",
		dataType : "json",
		type: "post",
		success : function(data) {
			$("#home-activations-count").html(data.length);
			if (data.length > 0) {
				$("#home-activations-count").removeClass("label-default")
						.addClass("label-danger");
			} else {
				$("#home-activations-count").removeClass("label-danger")
						.addClass("label-default");
			}

			$("#home-activations-table tbody").empty();
			for (i in data) {
				row = data[i];
				clone = document.importNode($("#home-activations-template").get(0).content, true);
				
				clone.querySelectorAll("td")[0].innerText = row.phone_number;
				clone.querySelectorAll("td")[1].innerText = row.first_name;
				clone.querySelectorAll("td")[2].innerText = row.last_name;
				clone.querySelectorAll("input")[0].id = "home-activation-input-"+row.id;
				clone.querySelectorAll("button")[0].id = "home-activation-btn-"+row.id;
				$("#home-activations-table tbody").append(clone);
				$("#home-activation-btn-"+row.id).click(function(id) {
					return function() {
						HomeActivations.TryActivate(id, $("#home-activation-input-"+id).val());
					}
				}(row.id));
			}
		},
		error : function() {

		}
	});
}

$(document).ready(function() {
	if ($("#home-activations-table").length == 0) {
		return;
	}
	HomeActivations.StartLoop();
});
