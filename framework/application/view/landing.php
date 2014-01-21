<?php
if (!isset($_GET['_pjax'])) {
\Core\Router::loadView("template/top");
?>
<div id="main-container">
	<?php 
}
	$req = $_SERVER['REQUEST_URI'];
	if (strpos($req, "?")) {
		$req = substr($req, 0, strpos($req, "?"));
	}
	$call = Core\Router::getController(
			array_merge(
					array("api"),
					explode("/", trim($req, "/"))
					)
			);
	
	if ($call[0] != "Controller\\Home") {
		$obj = new $call[0];
		call_user_func_array(array($obj, $call[1]), $call[2]);
	} else {
		\Core\Router::loadView("home");
	}
if (!isset($_GET['_pjax'])) {
	?>
</div>
<?php
\Core\Router::loadView("template/bottom");
}