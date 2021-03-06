// Put event listeners into place
var qr = new QrCode();

var asset_list = new Array();

start_scanning = function() {
	// Grab elements, create settings, etc.
	var canvas = document.getElementById("canvas"),
	context = canvas.getContext("2d"),
	video = document.getElementById("video"),
	videoObj = { "video": true },
	errBack = function(error) {
		console.log("Video capture error: ", error.code); 
	};

	// Put video listeners into place
	if(navigator.getUserMedia) { // Standard
		navigator.getUserMedia(videoObj, function(stream) {
			video.src = stream;
			video.play();
		}, errBack);
	} else if(false && navigator.mediaDevices.getUserMedia) { // WebKit-prefixed
		navigator.mediaDevices.getUserMedia().then(videoObj, function(stream){
			video.src = window.URL.createObjectURL(stream);
			video.play();
		}, errBack);
	} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
		navigator.webkitGetUserMedia(videoObj, function(stream){
			video.src = window.webkitURL.createObjectURL(stream);
			video.play();
		}, errBack);
	}
	else if(navigator.mozGetUserMedia) { // Firefox-prefixed
		navigator.mozGetUserMedia(videoObj, function(stream){
			video.src = window.URL.createObjectURL(stream);
			video.play();
		}, errBack);
	}
	
	function getResult(data) {
		if (typeof data == "undefined") {
			return;
		}
		address = "/public_roaming/tag?tag=";
		console.log(data, address);
		if (data.indexOf(address) == -1) {
			alert("We don't recognise this barcode - are you sure it's ours?");
		}
		tag = data.substr(data.indexOf(address)+address.length);
		addAsset(tag);
	}
	
	function getCode() {
		context.drawImage(video, 0, 0, 640, 480);
		var dataURL = canvas.toDataURL();
      		//document.getElementById('canvasImg').src = dataURL;
      		qr.callback = getResult;
      		qr.decode(dataURL);
		setTimeout(getCode, 1000);
      		
	}
	getCode();
	
	function addAsset(tag) {
		if (asset_list.indexOf(tag) != -1) {
			return;
		}
		if (el = document.querySelector("#nothing-item")) {
			el.remove();
		}
		
		
		item = document.importNode(document.querySelector("#asset-item-templ").content, true);
		item.querySelector("h4").innerHTML = "Looking up Item...";
		item.querySelector("a").setAttribute("id", randid = "assetrow-"+Math.round(Math.random()*10000));
		document.querySelector("#asset-list").appendChild(item);
		item = document.querySelector("#"+randid);
		asset_list.push(tag);
		
		fetch("/public_roaming/lookup_tag?tag="+tag, {
			credentials: "include"
		}).then((response) => {
			response.json().then((json) => {
				if (json.tag.id == 2) {
					item.querySelector("h4").innerHTML = json.asset.name+" - "+json.asset.category;
					if (json.asset.keyholder) {
						item.querySelector("p").innerHTML = "Signed out to "+json.keyholder;
					} else {
						item.querySelector("p").innerHTML = "Not signed out";
					}
				} else if (json.tag.id == 1) {
					console.log("Submit!!!");
				}
			});
		});
	}
}

start_scanning();

