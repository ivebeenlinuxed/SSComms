/**
 * 
 */
"use strict";

class LiveView {
	constructor(container) {
		this.container = container;
		this.last_update = ((new Date()).getTime()/1000)-2000;
		this.Update();
	}
	
	Update() {
		fetch("/live/update?since="+this.last_update, {
			credentials: "include"
		}).then((response) => {
			setTimeout(() => {this.Update()}, 5000);
			
			response.json().then((json) => {
				this.last_update = json.next_update;
				var tile_list = json.tiles.live_updates;
				var tile_container = document.querySelector(".live-update-list");
				for (var i=tile_list.length-1; i>=0; i--) {
					var tile = tile_list[i];
					var node = document.importNode(document.querySelector("#tile-templ").content, true);
					node.querySelector("h4").innerHTML = tile.title;
					node.querySelector("span").innerHTML = tile.description;
					for (var j=0; j<tile.actions.length; j++) {
						var link_el = document.createElement("a");
						var action = tile.actions[j];
						link_el.classList.add("btn");
						link_el.classList.add("btn-xs");
						link_el.classList.add("btn-primary");
						if (action.action_disposition == 1) {
							link_el.setAttribute("data-type", "api-modal");
						}
						link_el.setAttribute("href", action.action);
						link_el.innerHTML = action.label;
						node.querySelector(".btn-group").appendChild(link_el);
					}
					tile_container.insertBefore(node, tile_container.firstChild);
				}
				
				var tile_list = json.tiles.current_information;
				var tile_container = document.querySelector(".current-information-list");
				tile_container.innerHTML = "";
				for (var i=tile_list.length-1; i>=0; i--) {
					var tile = tile_list[i];
					var node = document.importNode(document.querySelector("#tile-templ").content, true);
					node.querySelector("h4").innerHTML = tile.title;
					node.querySelector("span").innerHTML = tile.description;
					for (var j=0; j<tile.actions.length; j++) {
						var link_el = document.createElement("a");
						var action = tile.actions[j];
						link_el.classList.add("btn");
						link_el.classList.add("btn-xs");
						link_el.classList.add("btn-primary");
						if (action.action_disposition == 1) {
							link_el.setAttribute("data-type", "api-modal");
						}
						link_el.setAttribute("href", action.action);
						link_el.innerHTML = action.label;
						node.querySelector(".btn-group").appendChild(link_el);
					}
					tile_container.appendChild(node);
				}
				
				
				
				var tile_list = json.tiles.outstanding_jobs;
				var tile_container = document.querySelector(".outstanding-job-list");
				tile_container.innerHTML = "";
				for (var i=tile_list.length-1; i>=0; i--) {
					var tile = tile_list[i];
					var node = document.importNode(document.querySelector("#tile-templ").content, true);
					node.querySelector("h4").innerHTML = tile.title;
					node.querySelector("span").innerHTML = tile.description;
					for (var j=0; j<tile.actions.length; j++) {
						var link_el = document.createElement("a");
						var action = tile.actions[j];
						link_el.classList.add("btn");
						link_el.classList.add("btn-xs");
						link_el.classList.add("btn-primary");
						if (action.action_disposition == 1) {
							link_el.setAttribute("data-type", "api-modal");
						}
						link_el.setAttribute("href", action.action);
						link_el.innerHTML = action.label;
						node.querySelector(".btn-group").appendChild(link_el);
					}
					tile_container.appendChild(node);
				}
			});
		})
	}
}

var liveview
if (liveview = document.querySelector("#live-view")) {
	new LiveView(liveview);
}