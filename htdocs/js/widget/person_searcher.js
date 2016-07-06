/**
 * 
 */

"use strict"

class PersonSearcher {
	constructor(parent) {
		this.parent = parent;
		var imported_doc = document.querySelector("#person-searcher-import").import;
		var el = document.importNode(imported_doc.querySelector("#person-searcher-templ").content, true);
		
		this.parent.innerHTML = "";
		this.parent.appendChild(el);
		
		this.input = parent.querySelector(".person-searcher-input");
		this.container = parent.querySelector(".person-searcher-container");
		this.template = imported_doc.querySelector("#person-searcher-record-templ");
		
		
		this.input.addEventListener("keyup", (e) => {
			if (this.input.value.length < 2) {
				this.container.innerHTML = "";
				return;
			}


			if (parseInt(this.input.value.trim()) > 0 && e.keyCode != 13) {
				return;
			}
			
			this.Search();
			
			
		});
		this.onselect = function() {};
		console.log(this.input);
		window.setTimeout(() => { this.input.focus(); }, 1000);
	}
	
	Search() {
		fetch("/widget/person_searcher/search?q="+encodeURIComponent(this.input.value), {
			credentials: "include"
		}).then((response) => {
			response.json().then((json) => {
				if (json.full_match) {
					this.onselect(json.data[0]);
				}
				
				var el = document.importNode(this.template.content, true);
				this.container.innerHTML = "";
				for (var i=0; i<json.data.length; i++) {
					var row = json.data[i];
					var node = el.cloneNode(true);
					node.person_data = row;
					node.querySelector("h4").innerHTML = row.first_name+" "+row.last_name;
					node.querySelector("a").dataset.user = row.id;
					node.querySelector("a").addEventListener("click", this.onselect);
					this.container.appendChild(node);
				}
			});
			
		});
	}
	
	
	
	
}