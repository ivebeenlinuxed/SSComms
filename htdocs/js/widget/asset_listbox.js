/**
 * 
 */
"use strict";

class AssetListbox {
	constructor(container) {
		this.container = container;
		
		this.template_link = document.querySelector("#asset-listbox-import").import;
		this.result_templ = document.importNode(this.template_link.querySelector("#result").content, true);
		this.control_templ = document.importNode(this.template_link.querySelector("#control").content, true);
		this.item_templ = document.importNode(this.template_link.querySelector("#item").content, true);
		this.newform_templ = document.importNode(this.template_link.querySelector("#newform").content, true);
		
		this.container.innerHTML = "";
		this.container.appendChild(this.control_templ);
		
		this.input = this.container.querySelector(".asset-listbox-search");
		this.suggestions = this.container.querySelector(".asset-listbox-suggestions");
		this.results = this.container.querySelector(".asset-listbox-results");
		
		
		this.input.addEventListener("keyup", (e) => {
			if (this.input.value.length < 2) {
				this.suggestions.innerHTML = "";
				return;
			}


			if (parseInt(this.input.value.trim()) > 0 && e.keyCode != 13) {
				return;
			}
			
			this.Search();
		});
		
		this.selected_assets = new Array();

		window.setTimeout(() => { this.input.focus(); }, 1000);
	}
	
	AddResult(data) {
		this.suggestions.innerHTML = "";
		this.input.value = "";
		var item = this.item_templ.cloneNode(true);
		var basetag = item.querySelector("a");
		basetag.innerHTML = data.name;
		basetag.dataset.id = data.id;
		this.results.appendChild(basetag);
		this.selected_assets.push(data);
	}
	
	Search() {
		fetch("/widget/asset_listbox/search?q="+encodeURIComponent(this.input.value), {
			credentials: "include"
		}).then((response) => {
			response.json().then((json) => {
				if (json.full_match) {
					this.AddResult(json.data[0]);
				}
				
				this.suggestions.innerHTML = "";
				for (var i=0; i < (json.data.length<4? json.data.length : 4); i++) {
					var row = json.data[i];
					var node = this.result_templ.cloneNode(true).querySelector(".assetlist-result");
					node.querySelector("a").asset_data = json.data[i];
					node.querySelector("h4").innerHTML = row.name;
					node.querySelector("a").dataset.asset = JSON.stringify(row);
					node.querySelector("a").addEventListener("click", (e) => {
						this.AddResult(JSON.parse(e.target.closest("a").dataset.asset));
					});
					this.suggestions.appendChild(node);
				}
				
				var node = this.result_templ.cloneNode(true).querySelector(".assetlist-result");
				node.querySelector("h4").innerHTML = "[Add Asset] "+this.input.value;
				node.querySelector("a").addEventListener("click", (e) => {
					this.AddNew();
				});
				this.suggestions.appendChild(node);
			});
			
		});
	}
	

	AddNew() {
		var el = this.newform_templ.cloneNode(true);
		this.suggestions.innerHTML = "";
		this.suggestions.appendChild(el);
		
		
		this.suggestions.querySelector("input[name='name']").value = this.input.value;
		
		this.suggestions.querySelector("button").addEventListener("click", () => {
			this.SaveNew();
		});
	}
	
	SaveNew() {
		var fd = new FormData();
		fd.append("name", this.container.querySelector("input[name='name']").value);
		fd.append("category", this.container.querySelector("select[name='equipment_category']").value);
		fd.append("tag_id", this.container.querySelector("input[name='barcode']").value);
		fetch("/api/equipment.json", {
			credentials: "include",
			body: fd,
			method: "post"
		}).then((response) => {
			response.json().then((json) => {
				this.AddResult(json.data);
			});
		});
	}
}