<?php
namespace Controller\Widget\LiveHelper;

use Model\Person;

class Asset_Change {
	public function change_asset() {
		\Core\Router::loadView("live/helper/asset_change/out_person");
	}
	
	public function change_asset_list(int $person_id) {
		$person = new \Model\Person($person_id);
		\Core\Router::loadView("live/helper/asset_change/change_asset_list", array("person"=>$person));
	}
}