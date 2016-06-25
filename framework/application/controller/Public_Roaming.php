<?php
namespace Controller;

class Public_Roaming {
	public function tag($id=null) {
		\Core\Router::loadView("public_roaming/tag");
	}
}
?>
