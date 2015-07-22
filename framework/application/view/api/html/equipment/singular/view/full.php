<?php $equipment = $data; ?>
<h1><?php echo $equipment->getName() ?> <small>#<?php echo $equipment->id ?></small>
</h1>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Equipment Information</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label">Name</label> <input
						class="form-control" type="text" data-table="equipment"
						data-field="name" data-id="<?php echo $equipment->id ?>"
						value="<?php echo $equipment->name ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">In Service</label>
					NYI
				</div>
			</div>
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
							<th>Name</th>
							<th>Check-Out</th>
							<th>Check-In</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					foreach ($equipment->getEquipmentCheckouts() as $checkout) {
					?>
					<tr>
						<td><?php echo $checkout->id ?></td>
						<td><a href="/api/person/<?php echo $checkout->person ?>"><?php echo $checkout->getPerson()->getName() ?></a></td>
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