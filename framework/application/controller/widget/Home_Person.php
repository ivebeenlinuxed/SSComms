<?php
namespace Controller\Widget;

class Home_Person {
	function search($id) {
		$output = array("exists"=>false, "id"=>null, "html"=>"");
		if ($person = \Model\Person::Fetch($id)) {
			$output['html'] = \Core\Router::getView("widget/person_asset/view", array("person"=>$person));
			$output['id'] = $person->id;
			$output['exists'] = true;
		} else {
			$output['html'] = \Core\Router::getView("widget/person_asset/add", array("id"=>$id));
			$output['exists'] = false;
		}
		echo json_encode($output);
	}
	
	function search_list() {
		$search = explode(" ", $_GET['search']);
		
		$db = \Model\Person::getDB();
		$select = $db->Select("\Model\Person");
		$select->addField("id");
		$cols = array("first_name", "last_name");
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
			$results[] = new \Model\Person($r['id']);
		}
		\Core\Router::loadView("widget/person_asset/list", array("results"=>$results));
	}
}