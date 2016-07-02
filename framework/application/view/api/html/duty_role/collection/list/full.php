<a href="#" class="pull-right btn btn-success">Add</a>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Currently Assigned</th>
			<th class="col-xs-3"></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach (\Model\DutyRole::getAll() as $role) {
		?>
		<tr>
			<td><?php echo $role->getName() ?></td>
			<td><?php 
			$assigned = $role->getCurrentlyAssigned();
			if ($assigned == null) {
				echo "Not Assigned";
			} else {
				echo $assigned->getPerson()->getName();	
			}
			?></td>
			<td>
				<div class="btn-group">
					<a href="/api/duty_role/assign/<?= $role->id ?>" data-type="api-modal" class="btn btn-primary">Assign</a>
					<a href="/api/duty_role/retire/<?= $role->id ?>" class="btn btn-danger">Retire</a>
					<a href="/api/duty_role/<?= $role->id ?>/edit" class="btn btn-default">Edit</a>
				</div>
			</td>
		</tr>
		<?php 
		}
		?>
	</tbody>
</table>
