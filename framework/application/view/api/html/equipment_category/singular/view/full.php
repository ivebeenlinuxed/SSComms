<?php $equipment_category = $data; ?>
<h1><?php echo $equipment_category->getName() ?> <small>#<?php echo $equipment_category->id ?></small>
</h1>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Category Information</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label">Name</label> <input
						class="form-control" type="text" data-table="equipment_category"
						data-field="name" data-id="<?php echo $equipment_category->id ?>"
						value="<?php echo $equipment_category->name ?>" />
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Team Breakdown</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<tr>
						<th>Team</th>
						<th>#</th>
					</tr>
					<?php
					$db = \Model\Team::getDB();
					$rows = $db->Exec(<<<EOF
SELECT COUNT(*) AS number, team.name AS team_name
FROM equipment
LEFT JOIN equipment_category ON equipment.category = equipment_category.id
LEFT JOIN equipment_checkout ON equipment.id = equipment_checkout.equipment
LEFT JOIN person ON equipment_checkout.person = person.id
LEFT JOIN team ON person.team = team.id
WHERE equipment_checkout.checkin=0 AND equipment_category.id={$equipment_category->id} GROUP BY team.id ORDER BY number DESC
EOF
);
					foreach ($rows as $row) {
					?>
					<tr>
						<td><?php echo $row['team_name'] ?></td>
						<td>
						<?php
						echo $row['number'];
						?>
						</td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-xs-12">
		<?php
		$has_advanced = \Core\Router::hasView("equipment_category/specialist/{$equipment_category->id}");
		
		if ($has_advanced) {
		?>
		<ul class="nav nav-tabs">
		  <li role="presentation" class="active"><a href="#specialist_view" role="tab" data-toggle="tab">Specialist View</a></li>
		  <li role="presentation"><a href="#standard_view" role="tab" data-toggle="tab">Standard View</a></li>
		</ul>
  <div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="standard_view">
		<?php
		} else {
		?>
		<div class="panel panel-default">
			<div class="panel-heading">Team Members</div>
			<div class="panel-body">
		<?php 
		}
		?>
		
		
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
						<td><?php
						if (!$equipment->isInService()) {
							echo "Out of Service";
						} elseif ($equipment->isCheckedOut()) {
							echo "Checked Out to ";
							$e = $equipment->getEquipmentCheckouts();
							$co = $e[count($e)-1];
							$person = $co->getPerson();
							$team = $person->getTeam();
							echo "<a href='/api/person/{$person->id}'>".$person->getName()."</a>";
							echo " (<a href='/api/team/{$team->id}'>".$team->getName()."</a>)";
						} else {
							echo "Checked In";
						}
						?></td>
					</tr>
					<?php 
					}
					?>
					</tbody>
				</table>
		<?php 
		if ($has_advanced) {
		?>
		</div>
		<div role="tabpanel" class="tab-pane active" id="specialist_view">...</div>
		
		</div>
		</div>
		<?php 
		} else {
		?>
			</div>
		</div>
		<?php 
		}
		?>
	</div>
</div>
