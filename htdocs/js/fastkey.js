/**
 * 
 */


fastkey = new Array();
function add_fastkey(keycode, message, func) {
	if (fastkey[keycode]) {
		clearTimeout(fastkey[keycode][1]);
	}
	
	t = setTimeout(function(keycode) {
		return function(keycode) {
			fastkey[keycode] = null;
		}
	}(keycode), 5000);
	fastkey[keycode] = new Array(func, t);
	toastr.info(message, "FastKeys");
}

$(document).keypress(function(e) {
	if (fastkey[e.keyCode || e.charCode]) {
		fastkey[e.keyCode || e.charCode][0]();
		e.preventDefault();
		return;
	}
	fastkey = new Array();
});

function clear_fastkey(keycode) {
	fastkey[keycode] = false;
}

function clear_fastkeys() {
	fastkey = new Array();
}
