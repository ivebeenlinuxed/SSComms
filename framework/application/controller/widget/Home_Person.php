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
		$search = $_GET['search'];
		echo "SEARCH FOR: ".$search;
	}
}