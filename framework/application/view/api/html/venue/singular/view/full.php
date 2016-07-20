<?php $venue = $data; ?>
<h1><?php echo $venue->getName() ?> <small>#<?php echo $venue->id ?></small>
</h1>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Venue Information</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label">Name</label> <input
						class="form-control" type="text" data-table="venue"
						data-field="name" data-id="<?php echo $venue->id ?>"
						value="<?php echo $venue->name ?>" />
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-xs-12">
		<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a href="#venue_programme"
				role="tab" data-toggle="tab">Programme</a></li>
			<li role="presentation"><a href="#safety_checks" role="tab"
				data-toggle="tab">Safety Checks</a></li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="venue_programme">
				<a href="/api/event/add?venue=<?php echo $venue->id ?>" data-type="api-modal" class="pull-right btn btn-primary">Add Event</a>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Start</th>
							<th>End</th>
							<th>Description</th>
							<th>Status</th>
							<th class="col-xs-4"></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($venue->getEvents() as $event) {
						?>
						<tr>
							<td><?php echo date("d/m H:i", (int)$event->start) ?></td>
							<td><?php echo date("H:i", (int)$event->end) ?></td>
							<td><?php echo $event->description ?></td>
							<td><?php echo $event->getStatus() ?></td>
							<td>
								<?php 
								if ($event->status == \Model\Event::STATUS_ASPLANNED || $event->status == \Model\Event::STATUS_AMENDMENT) {
								?>
								<div class="btn-group">
									<a href="/api/event/cancel?event=<?php echo $event->id ?>" data-type="api-modal" class="btn btn-danger">Cancel</a>
									<a href="/api/event/move?event=<?php echo $event->id ?>" data-type="api-modal" class="btn btn-primary">Move</a>
									<a href="/api/event/repeat?event=<?php echo $event->id ?>" data-type="api-modal" class="btn btn-success">Repeat</a>
									<a href="/api/event/delete?event=<?php echo $event->id ?>" data-type="api-modal" class="btn btn-default">Delete</a>
								</div>
								<?php 
								}
								?>
							</td>
						</tr>
						<?php 
						}
						?>
					</tbody>
				</table>
			</div>
			<div role="tabpanel" class="tab-pane" id="safety_checks">
				<a data-ajaxless
					href="javascript:$('#frm_venue_check_add').get(0).submit()"
					class="btn btn-primary pull-right">Add</a>
				<form class="hidden" method="post" action="/api/venue_check"
					id="frm_venue_check_add">
					<input type="hidden" name="venue" value="<?php echo $venue->id ?>" />
				</form>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Time</th>
							<th>Actor</th>
							<th>Status</th>

						</tr>
					</thead>
					<tbody>
					<?php
					foreach ( $venue->getVenueChecks () as $check ) {
						?>
					<tr>
							<td><a href="/api/venue_check/<?php echo $check->id ?>"><?php echo $check->id ?></a></td>
							<td><?php
						$d = new DateTime ();
						$d->setTimestamp ( $check->time );
						echo $d->format ( "d/m/Y H:i" );
						?></td>
							<td><a
								href="/api/person/<?php echo $check->getActor()->getName() ?>"><?php echo $check->getActor()->getName() ?></a></td>
							<td><?php
						echo $check->status;
						?></td>
						</tr>
					<?php
					}
					?>
					</tbody>
				</table>

			</div>

		</div>

	</div>
</div>
