<?php
namespace Controller\Widget\Homehelper;

class Loader {
	public function index() {
		if (isset($_GET['active_asset'])) {
			$asset = \Model\Equipment::Fetch($_GET['active_asset']);
		}
		
		if (isset($_GET['active_person'])) {
			$person = \Model\Person::Fetch($_GET['active_person']);
		}
		$helpers = array(
			"\Controller\Widget\Homehelper\Radio_Group",
			"\Controller\Widget\Homehelper\Radio_Limit"
		
		);
		$alerts = array();
		foreach ($helpers as $helper) {		
			$rg = new $helper();
			$alerts = array_merge($alerts, $rg->getAlerts($asset, $person));
		}
		echo json_encode($alerts);
	}
}
