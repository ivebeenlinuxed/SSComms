<template id="control">
	<input type="text" class="asset-listbox-search form-control" /><br />
	<div class="asset-listbox-suggestions row">
	
	</div>
	<div class="list-group asset-listbox-results">
		</div>
</template>

<template id="newform">
<div class="col-xs-12">
<div class="form-group">
	<label>Asset Name</label>
	<input class="form-control" type="text" name="name" />
</div>
<div class="form-group">
	<label>Asset Group</label>
	<select class="form-control" name="equipment_category">
	<?php 
	foreach(\Model\EquipmentCategory::getAll() as $cat) {
	?>
	<option value="<?php echo $cat->id ?>"><?php echo $cat->getName() ?></option>
	<?php 
	}
	?>
	</select>
</div>
<div class="form-group">
	<label>Barcode</label>
	<input class="form-control" type="text" name="barcode" />
</div>
<button class="btn btn-success pull-right">Add Asset</button>
</div>
</template>
<template id="result">
	<div class="col-xs-3 assetlist-result"><a href="#"
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
	</a></div>
</template>
<template id="item">
		  <a href="#" class="list-group-item">
		    Cras justo odio
		  </a>
</template>