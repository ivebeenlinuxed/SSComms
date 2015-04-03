<?php
namespace Controller\Widget;

class Home_Asset {
	function search($id) {
		$output = array("exists"=>false, "checkout"=>null, "id"=>null, "html"=>"");
		if ($equipment = \Model\Equipment::Fetch($id)) {
			$output['html'] = \Core\Router::getView("widget/home_asset/view", array("asset"=>$equipment));
			$output['id'] = $equipment->id;
			$output['checkout'] = $equipment->isCheckedOut();
			$output['exists'] = true;
		} else {
			$output['html'] = \Core\Router::getView("widget/home_asset/add", array("id"=>$id));
			$output['exists'] = false;
		}
		echo json_encode($output);
	}
	
	function check_in($id) {
		if ($equipment = \Model\Equipment::Fetch($id)) {
			echo json_encode($equipment->CheckIn());
		}
	}
}