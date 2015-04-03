<h3><?php echo $asset->name ?> (<?php echo $asset->getCategory()->name ?>)</h3>
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
		foreach ($asset->getEquipmentCheckouts() as $checkout) {
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
<?php 
if ($asset->isCheckedOut()) {
?>
<button onclick="asset_checkin(<?php echo $asset->id ?>)" id="asset-checkin-btn">Check-In</button>
<?php
}
?>
