/**
 * 
 */
"use strict";

class FeedWidget {
	constructor(el) {
		this.el = el;

		var submit_post = el.querySelector(".feed-post");
		if (submit_post) {
			submit_post.addEventListener("click", () => {
				this.SubmitPost();
			});
		}
		
		var attacher = this.el.querySelector(".feed-attach");
		if (attacher) {
			attacher.addEventListener("click", () => {
				this.UploadDialog();
			});
		}
		
		if (window.location.hash.indexOf("#post-") == 0) {
			var active_post = window.location.hash.substr(6);
			var found_post = this.el.querySelector(".feed-post[data-id='"+active_post+"'], .feed-comment[data-id='"+active_post+"']");
			if (found_post) {
				found_post.classList.add("highlight");
			}
		}
		
		autobahn_connected.then((session) => {
			   session.subscribe('/model/thread/'+el.dataset.thread, (args) => {
				      event = args[0];
				      if (event.target_module_table == "thread_post") {
				    	  switch (event.type) {
					      case BoilerModel.CREATE:
					    	  if (event.data.reply > 0) {
				    			  this.RenderNewComment(event.data);
				    		  } else {
				    			  this.RenderNewPost(event.data.id);
				    		  }
					    	  return;
					      case BoilerModel.UPDATE:
					    	  return;
					      case BoilerModel.DELETE:
					    	  this.RenderDeletePost(event.old_data.id);
					    	  return;
					      }
			    	  } else if (event.target_module_table == "thread_post_star") {
			    		  switch (event.type) {
					      case BoilerModel.CREATE:
				    		  this.RenderStarLine(event.data.thread_post);
					    	  return;
					      case BoilerModel.UPDATE:
				    		  this.RenderStarLine(event.data.thread_post);
					    	  return;
					      case BoilerModel.DELETE:
					    	  this.RenderStarLine(event.old_data.thread_post);
					    	  return;
					      }
			    	  }
				      
			   });
		});
		
		this.AddEvents(el);
	}
	
	AddEvents(el) {
		el.querySelectorAll(".thread-comment-stream textarea").forEach((comment_el) => {
			comment_el.addEventListener("keydown", (ev) => {
				if (ev.keyCode == 13 && !ev.shiftKey) {
					ev.preventDefault();
					this.PostComment(comment_el);
				}
			});
		});
		
		el.querySelectorAll("[data-type='new-comment']").forEach((show_cf) => {
			show_cf.addEventListener("click", (e) => {
				e.preventDefault();
				var comment_form = show_cf.closest(".feed-post").querySelector(".comment-form");
				if (comment_form.classList.contains("in")) {
					comment_form.classList.remove("in");
				} else {
					comment_form.classList.add("in");
				}
			});
		});
		
		el.querySelectorAll("[data-type='thread-star']").forEach((do_star) => {
			do_star.addEventListener("click", (e) => {
				e.preventDefault();
				this.ToggleStar(e.target.closest(".feed-post").dataset.id);
			});
		});
		
		el.querySelectorAll("[data-type='delete'][data-id]").forEach((del_btn) => {
			del_btn.addEventListener("click", (e) => {
				e.preventDefault();
				fetch(System.PUBLIC_ROOT+"/api/thread_post/"+e.target.dataset.id+".json", {
					method: "DELETE",
					credentials: "include"
				});
			});
		});
		
		el.querySelectorAll("[data-type='comments-expand'][data-id]").forEach((expand_btn) => {
			expand_btn.addEventListener("click", (e) => {
				e.preventDefault();
				el.querySelector(".collapse[data-id='"+expand_btn.dataset.id+"']").classList.add("in");
				expand_btn.remove();
			});
		});
	}
	
	ToggleStar(id) {
		fetch(System.PUBLIC_ROOT+"/widget/feed/toggle_star/"+id, {
			credentials: "include"
		});
	}
	
	RenderStarLine(id) {
		fetch(System.PUBLIC_ROOT+"/widget/feed/star_line/"+id, {
			credentials: "include"
		}).then((response) => {
			response.json().then((json) => {
				var post_el = this.el.querySelector(".feed-post[data-id='"+id+"']");
				var c_list = post_el.querySelector("[data-type='thread-star'] i").classList;
				c_list.remove("fa-star-o");
				c_list.remove("fa-star");
				c_list.remove("new-star");
				if (json.is_starred) {
					c_list.add("fa-star");
					c_list.add("new-star");
				} else {
					c_list.add("fa-star-o");
				}
				
				post_el.querySelector(".thread-star-text").innerHTML = json.star_text;
				post_el.querySelector(".thread-star-count").innerText = json.count;
			});
		});
	}
	
	PostComment(comment_el) {
		var post_id = comment_el.closest(".feed-post").dataset.id;
		var comment = comment_el.value;
		
		var fd = new FormData();
		fd.append("thread", this.el.dataset.thread);
		fd.append("message", comment);
		fd.append("reply", post_id);
		
		fetch(System.PUBLIC_ROOT+"/api/thread_post.json", {
			credentials: "include",
			method: "post",
			body: fd
		}).then((response) => {
			response.json().then((json) => {
				comment_el.closest(".comment-form").classList.remove("in");
				comment_el.value = "";
				//this.RenderNewComment(json.data);
			});
		});
	}
	
	RefreshAttachmentList() {
		var attachel = this.el.querySelector(".feed-attachments");
		attachel.innerHTML = "";
		if (this.files) {
			for (var i=0; i<this.files.length; i++) {
				var item = document.createElement("li");
				item.innerHTML = this.files[i].name;
				attachel.appendChild(item);
			}
		}
		
		if (this.updated_files) {
			for (var i=0; i<this.updated_files.length; i++) {
				var item = document.createElement("li");
				item.innerHTML = "Updating file #"+this.updated_files[i].id;
				attachel.appendChild(item);
			}
		}
		
		if (this.existing_files) {
			for (var i=0; i<this.existing_files.length; i++) {
				var item = document.createElement("li");
				item.innerHTML = "Existing file #"+this.existing_files[i];
				attachel.appendChild(item);
			}
		}
	}
	
	SubmitPost() {
		var fd = new FormData();
		var title_el = this.el.querySelector(".feed-input input");
		var message_el = this.el.querySelector(".feed-input textarea");
		fd.append("thread", this.el.dataset.thread);
		if (title_el) {
			fd.append("title", title_el.value);
		}
		fd.append("message", message_el.value);
		if (this.files) {
			for (var i=0; i<this.files.length; i++) {
				fd.append("file_"+i, this.files[i]);
			}
		}
		if (this.existing_files) {
			for (var i=0; i<this.existing_files.length; i++) {
				fd.append("existing_"+i, this.existing_files[i]);
			}
		}
		if (this.updated_files) {
			for (var i=0; i<this.updated_files.length; i++) {
				fd.append("updated_"+this.updated_files[i].id, this.updated_files[i].file);
			}
		}
		fetch(System.PUBLIC_ROOT+"/api/thread_post.json", {
			credentials: "include",
			method: "post",
			body: fd
		}).then((response) => {
			response.json().then((json) => {
				if (title_el) {
					title_el.value = "";
				}
				message_el.value = "";
				this.files = new Array();
				this.existing_files = new Array();
				this.updated_files = new Array();
				this.RefreshAttachmentList();
				//this.RenderNewPost(json.data.id);
			});
		});
	}
	

	RenderNewPost(id) {
		fetch(System.PUBLIC_ROOT+"/widget/feed/render_post/"+id, {
			credentials: "include"
		}).then((response) => {
			response.text().then((text) => {
				var stream = this.el.querySelector(".feed-posts");
				var template = document.createElement("template");
				template.innerHTML = text;
				var frag = document.importNode(template.content, true);
				frag.querySelector(".feed-post").classList.add("new-post");
				this.AddEvents(frag);
				stream.insertBefore(frag, stream.firstChild);
			});
		})
	}
	
	RenderDeletePost(id) {
		var del_target = this.el.querySelector(".feed-post[data-id='"+id+"'], .feed-comment[data-id='"+id+"']");
		if (del_target.classList.contains("feed-comment")) {
			var count_el = del_target.closest(".feed-post").querySelector(".thread-reply-count");
			count_el.innerHTML--;
		}
		del_target.classList.add("del-media");
		setTimeout(() => {
			del_target.remove();
		}, 2000);
	}
	
	RenderNewComment(data) {
		fetch(System.PUBLIC_ROOT+"/widget/feed/render_comment/"+data.id, {
			credentials: "include"
		}).then((response) => {
			response.text().then((text) => {
				var stream = this.el.querySelector(".feed-post[data-id='"+data.reply+"'] .thread-comment-stream");
				var template = document.createElement("template");
				template.innerHTML = text;
				var frag = document.importNode(template.content, true);
				
				frag.querySelector(".feed-comment").classList.add("new-comment");
				this.AddEvents(frag);
				
				var first_comment = stream.querySelector(".feed-comment");
				if (first_comment) {
					stream.insertBefore(frag, first_comment);
				} else {
					stream.appendChild(frag);
				}
				
				var count_el = stream.closest(".feed-post").querySelector(".thread-reply-count");
				count_el.innerHTML++;
			});
		})
	}
	
	UpdateFile(doc_id, file) {
		if (this.updated_files == null) {
			this.updated_files = new Array();
		}
		this.updated_files.push({id: doc_id, file: file});
		this.RefreshAttachmentList();
	}
	
	ExistingFile(doc_id) {
		if (this.existing_files == null) {
			this.existing_files = new Array();
		}
		this.existing_files.push(doc_id);
		this.RefreshAttachmentList();
	}
	
	NewFile(file) {
		if (this.files == null) {
			this.files = new Array();
		}
		this.files.push(file);
		this.RefreshAttachmentList();
	}
	
	UpdateDialog(doc_id) {
		var xhr = new XMLHttpRequest();
		xhr.open("GET", System.PUBLIC_ROOT+"/widget/feed/update/"+doc_id, true);
		xhr.onreadystatechange = () => {
			if (xhr.readyState == 4) {
				$("#api-modal").html(xhr.responseText).modal('show');
				var modal = document.querySelector("#api-modal");
				document.querySelector(".feed-attach-upload").addEventListener("click", () => {
					var modal = document.querySelector("#api-modal");
					var file_list = modal.querySelector("[name='new_file']").files;
					
					for (var i=0; i<file_list.length; i++) {
						this.UpdateFile(doc_id, file_list[i]);
					}
					
					$("#api-modal").modal('hide');
				});
				
			}
		};
		xhr.send();
		this.RefreshAttachmentList();
	}
	
	UploadDialog() {
		var xhr = new XMLHttpRequest();
		xhr.open("GET", System.PUBLIC_ROOT+"/widget/feed/attach", true);
		xhr.onreadystatechange = () => {
			if (xhr.readyState == 4) {
				$("#api-modal").html(xhr.responseText).modal('show');
				var modal = document.querySelector("#api-modal");
				document.querySelector(".feed-attach-upload").addEventListener("click", () => {
					var modal = document.querySelector("#api-modal");
					var file_list = modal.querySelector("[name='new_file']").files;
					
					for (var i=0; i<file_list.length; i++) {
						this.NewFile(file_list[i]);
					}
					
					$("#api-modal").modal('hide');
				});
				
				[].forEach.call(modal.querySelectorAll(".feed-add-existing"), (el) => {
					el.addEventListener("click", (e) => {
						this.ExistingFile(e.target.dataset.id);
						$("#api-modal").modal('hide');
					});
				});
				
				[].forEach.call(modal.querySelectorAll(".feed-update-existing"), (el) => {
					el.addEventListener("click", (e) => {
						this.UpdateDialog(e.target.dataset.id);
					});
				});
			}
		}
		xhr.send();
	}
}

document.querySelectorAll(".feed").forEach((el) => {
	el.feed = new FeedWidget(el);
});