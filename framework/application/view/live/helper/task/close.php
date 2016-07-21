<form action="/widget/livehelper/task/close" data-ajaxless method="post" class="modal-dialog" id="task-open-dlg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Close Task</h4>
		</div>
		<div class="modal-body">
				<input type="hidden" name="task" value="<?php echo $task->id ?>" />
				<div class="alert alert-danger">Are you sure you want to close this task?</div>
				<input type="submit" class="btn btn-danger pull-right" value="Yes, Close" />
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</form>