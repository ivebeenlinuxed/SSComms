<?php $team = $data; ?>
<h1><?php echo $team->getName() ?> <small>#<?php echo $team->id ?></small>
</h1>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Team Information</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label">Name</label> <input
						class="form-control" type="text" data-table="team"
						data-field="name" data-id="<?php echo $team->id ?>"
						value="<?php echo $team->name ?>" />
				</div><div class="form-group">
					<label class="control-label">Radio Allocation (-1 to ignore)</label> <input
						class="form-control" type="number" data-table="team"
						data-field="radio_allocation" data-id="<?php echo $team->id ?>"
						value="<?php echo $team->radio_allocation ?>" />
				</div>
				<a href="/widget/text_anywhere/modal?recipients=<?php
				$recpients = array();
				foreach ($team->getPeople() as $person) {
					$recipients[] = $person->id;
				}
				echo implode(":", $recipients);
				 ?>&message=Your message" class="btn btn-success" data-type="api-modal">Send Text</a>
				
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
							<th>First Name</th>
							<th>Last Name</th>
							<th>Phone Number</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					foreach ($team->getPeople() as $person) {
					?>
					<tr>
						<td><a href="/api/person/<?php echo $person->id ?>"><?php echo $person->id ?></a></td>
						<td><?php echo $person->first_name ?></td>
						<td><?php echo $person->last_name ?></td>
						<td><?php echo $person->phone_number ?></td>
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
