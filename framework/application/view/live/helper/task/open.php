<div class="modal-dialog" id="task-open-dlg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Open Task</h4>
		</div>
		<div class="modal-body">
			<div class="">
				<div class="form-group">
					<label>Category</label>
					<select class="form-control task-open-category">
					<?php 
					foreach (\Model\TaskCategory::getAll() as $category) {
					?>
						<option value="<?php echo $category->id ?>"><?php echo $category->getName() ?></option>
					<?php 
					}
					?>
					</select>
				</div>
				<div class="form-group">
					<label>Summary</label>
					<input type="text" class="form-control task-open-summary" />
				</div>
				<div class="btn-group pull-right">
					<a href="#" class="btn btn-default task-open-return">Save and Return</a>
					<a href="#" class="btn btn-primary task-open-open">Save and Open</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var dlg = document.querySelector("#task-open-dlg");
		dlg.querySelector(".task-open-return").addEventListener("click", () => {
			do_open_task((task) => {
				$("#api-modal").modal("hide");
			});
		});
		dlg.querySelector(".task-open-open").addEventListener("click", () => {
			do_open_task((task) => {
				window.location = "/api/task/"+task.id;
			});
		});

		function do_open_task(callback) {
			var fd = new FormData();
			fd.append("summary", document.querySelector(".task-open-summary").value);
			fd.append("category", document.querySelector(".task-open-category").value);
			fetch("/widget/livehelper/task/open_save", {
				credentials: "include",
				body: fd,
				method: "post"
			}).then((response) => {
				response.json().then((json) => {callback(json);});
			});
		}
	</script>
</div>