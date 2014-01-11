<div class="api api-full api-list">
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li class="active">List <?php echo $table ?></li>
</ol>
<a class="btn btn-success" href="/api/<?php echo $table ?>/add">Add</a>
<?php 
$t = new \Library\Widget\APITable($class);
$t->page_size = $controller->page_size;
$t->current_page = $controller->page;
$t->setQuery($controller->query);

$key = $class::getPrimaryKey()[0];

foreach ($class::getDBColumns() as $col) {
	$t->addColumn($col, $col, $col==$key? true : false);
}
$t->Render();
?>
</div>