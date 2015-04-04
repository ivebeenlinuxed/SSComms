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
	if (fastkey[e.which]) {
		fastkey[e.which][0]();
		e.preventDefault();
		return;
	}
	fastkey = new Array();
});