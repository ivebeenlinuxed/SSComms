<?php $person = $data; ?>
<h1><?php echo $person->getName() ?> <small>#<?php echo $person->id ?></small>
</h1>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Person Detail</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label">First Name</label> <input
						class="form-control" type="text" data-table="person"
						data-field="first_name" data-id="<?php echo $person->id ?>"
						value="<?php echo $person->first_name ?>" />
				</div>

				<div class="form-group">
					<label class="control-label">Last Name</label> <input
						class="form-control" type="text" data-table="person"
						data-field="last_name" data-id="<?php echo $person->id ?>"
						value="<?php echo $person->last_name ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Phone Number</label> <input
						class="form-control" type="text" data-table="person"
						data-field="phone_number" data-id="<?php echo $person->id ?>"
						value="<?php echo $person->phone_number ?>" />
				</div>

				<div class="form-group">
					<label class="control-label">Call Sign</label> <input
						class="form-control" type="text" data-table="person"
						data-field="call_sign" data-id="<?php echo $person->id ?>"
						value="<?php echo $person->call_sign ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Wristband ID</label> <input
						class="form-control" type="text" data-table="person"
						data-field="wristband_id" data-id="<?php echo $person->id ?>"
						value="<?php echo $person->wristband_id ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Team</label> <select
						class="form-control" data-table="person" data-field="team"
						data-id="<?php echo $person->id ?>">
		<?php
		foreach ( \Model\Team::getAll() as $team ) {
			?>
		<option value="<?php echo $team->id ?>"
							<?php echo $team->id==$person->team? "selected" : "" ?>><?php echo $team->name ?></option>
		<?php
		}
		?>
	</select>
				</div>
				<?php 
				if ($person->isActive()) {
				?>
				<a data-ajaxless class="btn btn-danger" href="javascript:deactivate_user(<?php echo $person->id ?>)">Deactivate Login</a>
				<?php
				} else {
				?>
				User cannot login
				<?php
				}
				?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Positions</div>
			<div class="panel-body">Panel content</div>
		</div>
	</div>
	<div class="col-md-8 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Asset Log</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Equipment</th>
							<th>Check-Out</th>
							<th>Check-In</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					foreach ($person->getEquipmentCheckouts() as $checkout) {
					?>
					<tr>
						<td><?php echo $checkout->id ?></td>
						<td><a href="/api/equipment/<?php echo $checkout->equipment ?>"><?php echo $checkout->getEquipment()->getName() ?></a></td>
						<td><?php
						$d = new DateTime();
						$d->setTimestamp($checkout->checkout);
						echo $d->format("H:i:s d/m/Y");
						?></td><td><?php
						if ($checkout->checkin > 0) {
							$d = new DateTime();
							$d->setTimestamp($checkout->checkin);
							echo $d->format("H:i:s d/m/Y");
						} else {
							echo "Not returned";
						}
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