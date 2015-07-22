/**
 * 
 */

function deactivate_user(id) {
	$.ajax({
		url: "/api/person/"+id+".json",
		method: "PUT",
		data: {active: 0},
		success: function() {
			window.location.reload();
		}
	})
	
}