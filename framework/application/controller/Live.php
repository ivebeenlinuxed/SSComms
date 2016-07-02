<?php
namespace Controller;

use Library\Live\TileResult;

class Live {
	public function index() {
		\Core\Router::loadView("live/index");
	}
	
	public function update() {
		if (!isset($_GET['since'])) {
			$_GET['since'] = time()-(60*5);
		}
		
		$nextupdate = time();
		$result = new TileResult();
			
		
		foreach (\Library\Live\Plugin::GetAll() as $plugin) {
			$result->Merge($plugin::GetTileResult($_GET['since']));
		}
		
		echo json_encode(array("next_update"=>$nextupdate, "tiles"=>$result));
	}
}