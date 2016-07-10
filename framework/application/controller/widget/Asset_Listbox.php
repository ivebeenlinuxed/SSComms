<?php
namespace Controller\Widget;

use Model\Equipment;

class Asset_Listbox {
	public function template() {
		\Core\Router::loadView("widget/asset_listbox/template");
	}
	
	public function search() {
		$out = array("full_match"=>false, "data"=>array());
		if ((int)trim($_GET['q']) > 0) {
			$p = Equipment::getByAttribute("tag_id", $_GET['q']);
			if (count($p) == 1) {
				$out['full_match'] = true;
				$out['data'] = $p;
				echo json_encode($out);
				return;
			}
		}
		
		$out['data'] = Equipment::Search(array("name"), $_GET['q']);
		echo json_encode($out);
	}
}