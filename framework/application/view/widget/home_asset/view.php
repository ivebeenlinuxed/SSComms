<h3><?php 
if ($asset->isCheckedOut()) {
?>
<a data-ajaxless href="javascript:asset_checkin('<?php echo $asset->id ?>')" class="btn btn-success pull-right" id="asset-checkin-btn">Check-In</a>
<?php
}
?><?php echo $asset->name ?> (<?php echo $asset->getCategory()->name ?>)</h3>
<?php 
if (!$asset->isInService()) {
?>
<span class="label label-warning">Not in service</span>
<?php
}
?>
<div class="form-group">
	<label class="control-label">Name</label>
	<input class="form-control" type="text" data-table="equipment" data-field="name" data-id="<?php echo $asset->id ?>" value="<?php echo $asset->name ?>" />
</div>
<div class="form-group">
	<label class="control-label">Category</label>
	<select class="form-control" data-table="equipment" data-field="category" data-id="<?php echo $asset->id ?>">
		<?php 
		foreach (\Model\EquipmentCategory::getAll() as $category) {
		?>
		<option value="<?php echo $category->id ?>" <?php echo $category->id==$asset->category? "selected" : "" ?>><?php echo $category->name ?></option>
		<?php 
		}
		?>
	</select>
</div>	
<table class="table table-striped">
	<thead>
		<tr>
			<th>Person</th>
			<th>In</th>
			<th>Out</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach (array_slice(array_reverse($asset->getEquipmentCheckouts()), 0, 5) as $checkout) {
			$person = $checkout->getPerson();
			?>
		<tr>
			<td><a data-ajaxless href="javascript:person_search(<?php echo $person->id ?>)"><?php echo $person->getName() ?></a></td>
			<td><?php echo date("H:i:s d/m/Y", $checkout->checkout) ?></td>
			<td><?php
			if ($checkout->checkin > 0) {
				echo date("H:i:s d/m/Y", $checkout->checkin);
			} else {
				echo "[Current Keyholder]";
			}
			?></td>
		</tr>
		<?php 
		}
		?>
	</tbody>
</table>
<a href="/api/equipment/<?php echo $asset->id ?>" class="btn btn-success pull-right" id="asset-checkin-btn">Open</button>



