<?php
\Core\Router::loadView("api/html/_template/full/top");
?>
<h1>Generate Tags</h1>
<form method="post" class="form-horizontal">
	<div class="form-group col-md-6">
		<label>Number of Tags</label>
		<div>
			<div class="input-group">
				<input type="number" min="1" max="50" value="10" class="form-control" />
				<div class="input-group-btn">
				<input type="submit" value="Go!" class="btn btn-primary" />
				</div>
			</div>
		</div>
		
	</div>
	
</form>

<?php
\Core\Router::loadView("api/html/_template/full/bottom");