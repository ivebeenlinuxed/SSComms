<h3><?php echo $person->first_name." ".$person->last_name ?> (<?php echo $person->getTeam()->name ?>)</h3>
<div class="form-group">
	<label class="control-label">First Name</label>
	<input class="form-control" type="text" data-table="person" data-field="first_name" data-id="<?php echo $person->id ?>" value="<?php echo $person->first_name ?>" />
</div>

<div class="form-group">
	<label class="control-label">Last Name</label>
	<input class="form-control" type="text" data-table="person" data-field="last_name" data-id="<?php echo $person->id ?>" value="<?php echo $person->last_name ?>" />
</div>
<div class="form-group">
	<label class="control-label">Phone Number</label>
	<input class="form-control" type="text" data-table="person" data-field="phone_number" data-id="<?php echo $person->id ?>" value="<?php echo $person->phone_number ?>" />
</div>

<div class="form-group">
	<label class="control-label">Call Sign</label>
	<input class="form-control" type="text" data-table="person" data-field="call_sign" data-id="<?php echo $person->id ?>" value="<?php echo $person->call_sign ?>" />
</div>	
<div class="form-group">
	<label class="control-label">Wristband ID</label>
	<input class="form-control" type="text" data-table="person" data-field="wristband_id" data-id="<?php echo $person->id ?>" value="<?php echo $person->wristband_id ?>" />
</div>
<div class="form-group">
	<label class="control-label">Team</label>
	<select class="form-control" data-table="person" data-field="team" data-id="<?php echo $person->id ?>">
		<?php 
		foreach (\Model\Team::getAll() as $team) {
		?>
		<option value="<?php echo $team->id ?>" <?php echo $team->id==$person->team? "selected" : "" ?>><?php echo $team->name ?></option>
		<?php 
		}
		?>
	</select>
</div>	
<a href="/api/person/<?php echo $person->id ?>" class="btn btn-success pull-right">Open</a>

<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Set Duty <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
  <?php 
  foreach (\Model\DutyRole::getAll() as $role) {
  ?>
    <li><a href="#"><?php echo $role->getName() ?></a></li>
    <?php 
  }
    ?></ul>
</div>
