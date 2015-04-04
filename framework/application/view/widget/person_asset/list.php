<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Team</th>
		</tr>
	</thead>
<tbody>
<?php
foreach ($results as $result) {
?>
	<tr>
		<td><a data-ajaxless href="javascript:person_search('<?php echo $result->id ?>')"><?php echo $result->id ?></td>
		<td><?php echo $result->first_name ?></td>
		<td><?php echo $result->last_name ?></td>
		<td><?php echo $result->getTeam()->getName() ?></td>
	</tr>
<?php
}
?>
</tbody>
</table>
<a data-ajaxless href="javascript:person_add()">Add New Person...</a>