<?php
\Core\Router::loadView("api/html/_template/full/top");
?>
<h1>Generate Tags</h1>
<form method="post" class="form-horizontal col-md-6" data-ajaxless>
	<div class="form-group">
		<label>Number of Tags</label>
		<input type="number" name="tag_count" min="1" max="50" value="10" class="form-control" />
	</div>
	<div class="form-group">
		<label>Tag Size</label>
		<select class="form-control" name="tag_size">
			<option value="1">Small Tags</option>
			<option value="2">Large Tags</option>
		</select>
	</div>
	<input type="submit" value="Go!" class="btn btn-primary pull-right" />
</form>

<?php
\Core\Router::loadView("api/html/_template/full/bottom");