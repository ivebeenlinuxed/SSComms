<template id="person-searcher-templ">
<input type="text" class="person-searcher-input form-control"
	placeholder="Search..." />
<br />
<br />
<div class="person-searcher-container row">
	<div class="col-xs-12">Start typing to search</div>
</div>
<div class="clearfix"></div>
</template>

<template id="person-searcher-new-templ">
<div class="col-xs-12">
<div class="form-group">
	<label>First Name</label>
	<input class="form-control" type="text" name="first_name" />
</div>
<div class="form-group">
	<label>Last Name</label>
	<input class="form-control" type="text" name="last_name" />
</div>
<div class="form-group">
	<label>Phone Number</label>
	<input class="form-control" type="text" name="phone_number" />
</div>
<div class="form-group">
	<label>Call Sign</label>
	<input class="form-control" type="text" name="call_sign" />
</div>
<div class="form-group">
	<label>Team</label>
	<select class="form-control" name="team">
	<?php 
	foreach(\Model\Team::getAll() as $team) {
	?>
	<option value="<?php echo $team->id ?>"><?php echo $team->getName() ?></option>
	<?php 
	}
	?>
	</select>
</div>
<div class="form-group">
	<label>Barcode</label>
	<input class="form-control" type="text" name="barcode" />
</div>
<button class="btn btn-success pull-right">Add Person</button>
</div>
</template>

<template id="person-searcher-record-templ"> <div class="col-xs-3"><a href="#"
		class="thumbnail">
		<div class="media">
			<div class="media-left">
				<img class="media-object"
					src="http://placehold.it/60x60" alt="...">
				
			</div>
			<div class="media-body">
				<h4 class="media-heading">Media heading</h4>
			</div>
		</div>
	</a></div> </template>