<h3>Nothing found... Add Something?</h3>
<div class="form-group">
	<label>First Name</label>
	<input type="text" id="person-add-fname" class="form-control" />
</div>
<div class="form-group">
	<label>Last Name</label>
	<input type="text" id="person-add-lname" class="form-control" />
</div>
<div class="form-group">
	<label>Phone</label>
	<input type="text" id="person-add-phone" class="form-control" />
</div>
<div class="form-group">
	<label>Team</label>
	<select class="form-control" id="person-add-team">
		<?php 
		foreach (\Model\Team::getAll() as $team) {
		?>
		<option value="<?php echo $team->id?>"><?php echo $team->name ?></option>
		<?php
		}
		?>
	</select>
</div>
<button class="btn btn-success pull-right" id="person-add-btn" onclick="person_add(); return false;">Add Person</button>