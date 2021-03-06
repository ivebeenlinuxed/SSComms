RTCOrderEventType = {
	UPDATE : 1,
	DELETE : 4,
	CREATE : 2
};

RTCList = new Array();

RTCQueue = function(channel) {
	if (RTCList[channel]) {
		return RTCList[channel];
	}
	this.channel = channel;
	this.host = "ws://" + window.location.host; //+ ":8888";
	this.websocket = new WebSocket(this.host + this.channel);
	this.websocket.onmessage = function(that) {
		return function(evt) {
			that.triggerEvent("message", evt);
		}
	}(this);

	this.events = new Array();

	this.addEventListener = function(event, func) {
		if (this.events[event] == undefined) {
			this.events[event] = new Array();
		}
		this.events[event].push(func);
	};

	this.triggerEvent = function(event, e) {
		if (this.events[event] == undefined) {
			return;
		}
		for (i in this.events[event]) {
			this.events[event][i].call(this, e);
		}
	};

}

var waitSocketListeners = new Array();
function waitForSocket(func) {
	if (wsconn) {
		func(wsconn);
	} else {
		waitSocketListeners.push(func);
	}
}

function triggerSocket() {
	for (var i in waitSocketListeners) {
		waitSocketListeners[i](wsconn);
	}
}
var connection = new autobahn.Connection({
//    url: "ws://" + window.location.host,
  url: "ws://" + window.location.host + ":8282",
   realm: 'boiler',
    protocols: []
 });

wsconn=null;

connection.onopen = function (session) {
	wsconn = session;
	triggerSocket();
}

connection.open();

/*
var wsuri = "ws://" + window.location.host; // + ":8080";
var wsconn = autobahn.Session(wsuri, function(session) {
		wsconn = session;
		triggerSocket();
});
*/