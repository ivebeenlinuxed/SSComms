<?php $equipment_category = $data; ?>
<h1><?php echo $equipment_category->getName() ?> <small>#<?php echo $equipment_category->id ?></small>
</h1>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Team Information</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label">Name</label> <input
						class="form-control" type="text" data-table="equipment_category"
						data-field="name" data-id="<?php echo $equipment_category->id ?>"
						value="<?php echo $equipment_category->name ?>" />
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Team Members</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					foreach ($equipment_category->getEquipment() as $equipment) {
					?>
					<tr>
						<td><a href="/api/equipment/<?php echo $equipment->id ?>"><?php echo $equipment->id ?></a></td>
						<td><?php echo $equipment->name ?></td>
						<td><?php echo ($equipment->isInService())? "In Service" : "Out of Service" ?></td>
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