<form action="/api/event/add" method="post" data-ajaxless class="modal-dialog" id="task-open-dlg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Add Event for <?php echo $venue->getName() ?></h4>
		</div>
		<div class="modal-body">
			<input type="hidden" name="venue" value="<?php echo $venue->id ?>" />
			<div class="form-group row">
				<label class="col-xs-3">Description</label>
				<div class="col-xs-6">
					<input type="text" name="description" class="form-control" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-3">Start</label>
				<div class="col-xs-3">
					<input type="date" name="start_date" value="<?php echo date("Y-m-d") ?>" class="form-control" />
				</div>
				<div class="col-xs-3">
					<input type="time" name="start_time" value="<?php echo date("H:00") ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-3">End</label>
				<div class="col-xs-3">
					<input type="date" name="end_date" value="<?php echo date("Y-m-d") ?>" class="form-control" />
				</div>
				<div class="col-xs-3">
					<input type="time" name="end_time" value="<?php echo date("H:00") ?>" class="form-control" />
				</div>
			</div>
			<input type="submit" class="btn pull-right btn-primary" />
			<div class="clearfix"></div>
		</div>
	</div>
</div>