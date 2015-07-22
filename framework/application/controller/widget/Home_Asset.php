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
	
	function search_list() {
		$search = explode(" ", $_GET['search']);
	
		$db = \Model\Person::getDB();
		$select = $db->Select("\Model\Equipment");
		$select->addField("id");
		$cols = array("name");
		$and = $select->getAndFilter();
		foreach ($search as $term) {
			$or = $select->getOrFilter();
			foreach ($cols as $col) {
				$or->like($col, "%".$term."%");
			}
			$and->subEq($or);
		}
		$select->setFilter($and);
	
		$results = array();
		foreach ($select->Exec() as $r) {
			$results[] = new \Model\Equipment($r['id']);
		}
		\Core\Router::loadView("widget/home_asset/list", array("results"=>$results));
	}
}