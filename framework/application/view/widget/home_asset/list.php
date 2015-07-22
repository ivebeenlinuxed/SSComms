<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Category</th>
			<th>Status</th>
		</tr>
	</thead>
<tbody>
<?php
foreach ($results as $result) {
?>
	<tr>
		<td><a data-ajaxless href="javascript:asset_search('<?php echo $result->id ?>')"><?php echo $result->id ?></td>
		<td><?php echo $result->name ?></td>
		<td><?php echo $result->getCategory()->getName() ?></td>
		<td><?php
		if ($result->isCheckedOut()) {
			echo "Checked Out";
		} elseif ($result->isInService()) {
			echo "Available";
		} else {
			echo "Unavailable";
		}
		?></td>
	</tr>
<?php
}
?>
</tbody>
</table>
<a data-ajaxless href="javascript:asset_add()">Add New Asset...</a>