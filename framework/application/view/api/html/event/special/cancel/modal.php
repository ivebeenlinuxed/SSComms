<form action="/api/event/cancel" method="post" data-ajaxless class="modal-dialog" id="task-open-dlg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Cancel Event</h4>
		</div>
		<div class="modal-body">
			<input type="hidden" name="event" value="<?php echo $event->id ?>" />
			<div class="alert alert-danger">
				Are you sure you want to cancel this event?
			</div>
			<input type="submit" value="Yes, Cancel" class="btn pull-right btn-danger" />
			<div class="clearfix"></div>
		</div>
	</div>
</div>