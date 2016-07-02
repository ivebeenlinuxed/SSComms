<?php
\Core\Router::loadView("api/html/_template/full/top");
?>
<h1>Add new Duty Role</h1>
<form class="form-horizontal form col-md-6" method="post" action="/api/duty_role">
	<div class="form-group">
		<label class="col-md-3">Role Name</label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="name" />
		</div>
	</div>
	<input type="submit" value="Add" class="btn btn-primary pull-right" />
</form>
<?php
\Core\Router::loadView("api/html/_template/full/bottom");