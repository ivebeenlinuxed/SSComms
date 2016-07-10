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
					<label class="control-label">Tag ID</label> <input
						class="form-control" type="text" data-table="equipment"
						data-field="tag_id" data-id="<?php echo $equipment->id ?>"
						value="<?php echo $equipment->tag_id ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">In Service</label>
					<input type="checkbox" data-table="equipment" data-field="in_service"
					data-activated="1" data-deactivated="0"
					data-id="<?php echo $equipment->id ?>" <?php echo $equipment->isInService()? "checked" : "" ?> />
				</div>
				<div class="form-group">
					<label class="control-label">Category</label> <select
						class="form-control" data-table="equipment" data-field="category"
						data-id="<?php echo $equipment->id ?>">
		<?php
		foreach ( \Model\EquipmentCategory::getAll() as $equipment_category ) {
			?>
		<option value="<?php echo $equipment_category->id ?>"
							<?php echo $equipment_category->id==$equipment->category? "selected" : "" ?>><?php echo $equipment_category->name ?></option>
		<?php
		}
		?>
	</select>
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
							<th>Check-Out Actor</th>
							<th>Check-In</th>
							<th>Check-In Actor</th>
							
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
						?></td>
						<td><?php
						$a = $checkout->getOutActor();
						if ($a == null) {
							echo "Unknown";
						} else {
							echo $a->getName();
						}
						 ?></td>
						<td><?php
						if ($checkout->checkin > 0) {
							$d = new DateTime();
							$d->setTimestamp($checkout->checkin);
							echo $d->format("H:i:s d/m/Y");
						} else {
							echo "Not returned";
						}
						?></td>
						<td><?php
						$a = $checkout->getInActor();
						if ($a == null) {
							echo "Unknown";
						} else {
							echo $a->getName();
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
