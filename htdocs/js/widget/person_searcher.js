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
		this.new_form = imported_doc.querySelector("#person-searcher-new-templ");
		
		
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

		window.setTimeout(() => { this.input.focus(); }, 1000);
	}
	
	Search() {
		fetch("/widget/person_searcher/search?q="+encodeURIComponent(this.input.value), {
			credentials: "include"
		}).then((response) => {
			response.json().then((json) => {
				if (json.full_match) {
					this.onselect(json.data[0]);
					return;
				}
				
				var el = document.importNode(this.template.content, true);
				this.container.innerHTML = "";
				for (var i=0; i<json.data.length; i++) {
					var row = json.data[i];
					var node = el.cloneNode(true);
					node.person_data = row;
					node.querySelector("h4").innerHTML = row.first_name+" "+row.last_name;
					node.querySelector("a").dataset.user = JSON.stringify(row);
					node.querySelector("a").addEventListener("click", (e) => {
						this.onselect(JSON.parse(e.target.closest("a").dataset.user));
					});
					this.container.appendChild(node);
				}
				
				var node = el.cloneNode(true);
				node.person_data = row;
				node.querySelector("h4").innerHTML = "[Add Person] "+this.input.value;
				node.querySelector("a").addEventListener("click", () => {
					this.AddNew();
				});
				this.container.appendChild(node);
			});
			
		});
	}
	
	AddNew() {
		var el = document.importNode(this.new_form.content, true);
		this.container.innerHTML = "";
		this.container.appendChild(el);
		
		var e = this.input.value.split(" ");
		
		this.container.querySelector("input[name='first_name']").value = e[0];
		if (e.length > 1) {
			this.container.querySelector("input[name='last_name']").value = e.slice(1).join(" ");
		}
		
		this.container.querySelector("button").addEventListener("click", () => {
			this.SaveNew();
		});
	}
	
	SaveNew() {
		var fd = new FormData();
		fd.append("first_name", this.container.querySelector("input[name='first_name']").value);
		fd.append("last_name", this.container.querySelector("input[name='last_name']").value);
		fd.append("phone_number", this.container.querySelector("input[name='phone_number']").value);
		fd.append("call_sign", this.container.querySelector("input[name='call_sign']").value);
		fd.append("team", this.container.querySelector("select[name='team']").value);
		fd.append("wristband_id", this.container.querySelector("input[name='barcode']").value);
		fetch("/api/person.json", {
			credentials: "include",
			body: fd,
			method: "post"
		}).then((response) => {
			response.json().then((json) => {
				this.onselect(json.data);
			});
		});
	}
	
	
}