<h3><?php echo $person->first_name." ".$person->last_name ?> (<?php echo $person->getTeam()->name ?>)</h3>
<div class="form-group">
	<label>Phone Number</label>
	<?php echo $person->phone ?>
</div>
