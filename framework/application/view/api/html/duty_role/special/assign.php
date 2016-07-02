<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Assign <?= $role->getName() ?></h4>
		</div>
		<div class="modal-body">
			<input type="text" id="assign_role_search" class="form-control"
				placeholder="Search..." /><br /> <br />
			<div id="assign-role-ajax" class="row"><div class="col-xs-12">Start typing to search</div></div>
			<div class="clearfix"></div>
		</div>
	</div>
	<template id="person-assign-card"> <div class="col-xs-3"><a href="#"
		class="thumbnail">
		<div class="media">
			<div class="media-left">
				<img class="media-object"
					src="http://placehold.it/60x60" alt="...">
				
			</div>
			<div class="media-body">
				<h4 class="media-heading">Media heading</h4>
				...
			</div>
		</div>
	</a></div> </template>
	<script type="text/javascript">
	document.querySelector("#assign_role_search").addEventListener("keyup", function() {
		if (this.value.length < 2) {
			document.querySelector("#assign-role-ajax").innerHTML = "";
			return;
		}
		fetch("/api/person/search?q="+encodeURIComponent(this.value), {
			credentials: "include"
		}).then((response) => {
			response.json().then((json) => {
				el = document.importNode(document.querySelector("#person-assign-card").content, true);
				container = document.querySelector("#assign-role-ajax");
				container.innerHTML = "";
				for (i=0; i<json.data.length; i++) {
					row = json.data[i];
					node = el.cloneNode(true);
					node.querySelector("h4").innerHTML = row.first_name+" "+row.last_name;
					node.querySelector("a").dataset.role = <?= $role->id ?>;
					node.querySelector("a").dataset.user = row.id;
					node.querySelector("a").addEventListener("click", function() {
						fd = new FormData();
						fd.append("duty_role", this.dataset.role);
						fd.append("user", this.dataset.user);
						fetch("/api/duty_role/reassign", {
							credentials: "include",
							method: "post",
							body: fd
						}).then((response) => {
							window.location.reload();
						});
					});
					container.appendChild(node);
				}
			});
			
		});
		
	});
	</script>
</div>