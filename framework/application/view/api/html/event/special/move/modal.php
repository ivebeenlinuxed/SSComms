<form action="/api/event/move" method="post" data-ajaxless class="modal-dialog" id="task-open-dlg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Move Event</h4>
		</div>
		<div class="modal-body">
			<input type="hidden" name="event" value="<?php echo $event->id ?>" />
			<div class="form-group row">
				<label class="col-xs-3">Venue</label>
				<div class="col-xs-6">
					<select name="venue" class="form-control">
					<?php 
					foreach (\Model\Venue::getAll() as $venue) {
					?>
					<option value="<?php echo $venue->id ?>"<?php echo $event->venue==$venue->id? " selected" : "" ?>><?php echo $venue->getName() ?></option>
					<?php
					}
					?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-3">Description</label>
				<div class="col-xs-6">
					<input type="text" name="description" value="<?php echo $event->description ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-3">Start</label>
				<div class="col-xs-3">
					<input type="date" name="start_date" value="<?php echo date("Y-m-d", $event->start) ?>" class="form-control" />
				</div>
				<div class="col-xs-3">
					<input type="time" name="start_time" value="<?php echo date("H:i", $event->start) ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-xs-3">End</label>
				<div class="col-xs-3">
					<input type="date" name="end_date" value="<?php echo date("Y-m-d", $event->end) ?>" class="form-control" />
				</div>
				<div class="col-xs-3">
					<input type="time" name="end_time" value="<?php echo date("H:i", $event->end) ?>" class="form-control" />
				</div>
			</div>
			<input type="submit" class="btn pull-right btn-primary" />
			<div class="clearfix"></div>
		</div>
	</div>
</div>