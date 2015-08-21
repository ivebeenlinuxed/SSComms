function helper_radio_group(elid, action, person) {
	assets = new Array();
	$("#helper-radiogroup-"+elid+" input[type='checkbox']").each(function(index, el) {
		if ($(el).is("[name^='asset_']:checked")) {
			assets.push($(el).attr("name").substr(6));
		}
	});
	if (action == 0) {
		for (var i=0; i<assets.length; i++) {
			asset_checkin(assets[i]);
		}
	} else {
		for (var i=0; i<assets.length; i++) {
			asset_switch(assets[i], person);
		}
	}
	
}
