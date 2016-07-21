"use strict";


class FeedWidget {
	constructor(el) {
		this.element = el;
		this.id = this.element.dataset.thread;
		this.timer = setInterval(() => {
			this.Refresh();
		}, 5000);
		
		this.element.querySelector(".feed-post").addEventListener("click", () => {
			this.Post();
		});
	}
	
	Refresh() {
		fetch("/widget/feed/"+this.id+"?update=1", {
			credentials: "include"
		}).then((response) => {
			response.text().then((text) => {
				this.element.querySelector(".feed-posts").innerHTML = text;
			});
		});
	}
	
	Post() {
		var message = this.element.querySelector("textarea").value;
		var fd = new FormData();
		fd.append("thread", this.id);
		fd.append("message", message);
		fetch("/widget/feed/post", {
			credentials: "include",
			method: "post",
			body: fd
		}).then(() => {
			this.element.querySelector("textarea").value = "";
			this.Refresh();
		});
	}
}