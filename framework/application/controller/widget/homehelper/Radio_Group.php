<?php
namespace Controller\Widget\Homehelper;

class Radio_Group {
	public function test() {
		echo "Hello World";
	}
	
	public function getAlerts($asset, $person) {
		$alerts = array();
		
		if (!$asset->isCheckedOut()) {
			return $alerts;
		}
		
		$owner = $asset->getCurrentCheckout()->getPerson();
		
		
		$linked_assets = array();
		foreach ($owner->getCurrentEquipment() as $l_asset) {
			if ($l_asset->category == 7) {
				$linked_assets[] = $l_asset;
			}
		}
		
		
		if ($asset->category == 2 && $asset->isCheckedOut() && count($linked_assets) > 0) {
			$alerts[] = \Core\Router::getView("widget/homehelper/radio_group/alert", array("person"=>$person, "asset"=>$asset, "linked_assets"=>$linked_assets));
		}
		return $alerts;
	}
}
