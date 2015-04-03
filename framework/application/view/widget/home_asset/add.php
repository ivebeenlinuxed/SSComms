<h3>Nothing found... Add Something?</h3>
<div class="form-group">
	<label>Asset Name</label>
	<input type="text" id="asset-add-name" class="form-control" />
</div>
<div class="form-group">
	<label>Asset Category</label>
	<select class="form-control" id="asset-add-category">
		<?php 
		foreach (\Model\EquipmentCategory::getAll() as $cat) {
		?>
		<option value="<?php echo $cat->id?>"><?php echo $cat->name ?></option>
		<?php
		}
		?>
	</select>
</div>
<button class="btn btn-success pull-right" id="asset-add-btn" onclick="asset_add(); return false;">Add Asset</button>