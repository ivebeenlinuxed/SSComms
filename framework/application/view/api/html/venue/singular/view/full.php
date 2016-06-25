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
		<div class="panel panel-default">
			<form class="hidden" method="post" action="/api/venue_check" id="frm_venue_check_add">
			<input type="hidden" name="venue" value="<?php echo $venue->id ?>" />
			</form>
			<div class="panel-heading"><a data-ajaxless href="javascript:$('#frm_venue_check_add').get(0).submit()" class="btn btn-success btn-xs pull-right">Add</a>Venue Safety Checks</div>
			<div class="panel-body">
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
					foreach ($venue->getVenueChecks() as $check) {
					?>
					<tr>
						<td><a href="/api/venue_check/<?php echo $check->id ?>"><?php echo $check->id ?></a></td>
						<td><?php
						$d = new DateTime();
						$d->setTimestamp($check->time);
						echo $d->format("d/m/Y H:i");
						 ?></td>
						<td><a href="/api/person/<?php echo $check->getActor()->getName() ?>"><?php echo $check->getActor()->getName() ?></a></td>
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
