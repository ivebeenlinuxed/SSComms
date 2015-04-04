<h3><?php echo $person->first_name." ".$person->last_name ?> (<?php echo $person->getTeam()->name ?>)</h3>
<div class="form-group">
	<label>Phone Number</label>
	<input class="form-control" type="text" data-table="person" data-field="phone_number" data-id="<?php echo $person->id ?>" value="<?php echo $person->phone_number ?>" />
</div>
