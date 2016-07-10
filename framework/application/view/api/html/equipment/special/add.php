<?php
\Core\Router::loadView("api/html/_template/full/top");
?>
<h1>Add Equipment</h1>
<form class="form-horizontal col-md-6" action="/api/equipment" method="post">
	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" />
	</div>
	<div class="form-group">
		<label>Category</label>
		<select class="form-control" name="category">
			<?php 
			foreach (\Model\EquipmentCategory::getAll() as $category) {
			?>
			<option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
			<?php
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label>Tag</label>
		<input type="text" class="form-control" name="tag_id" />
	</div>
	<input type="submit" value="Add" class="btn btn-primary pull-right" />
</form>
<?php 
\Core\Router::loadView("api/html/_template/full/bottom");