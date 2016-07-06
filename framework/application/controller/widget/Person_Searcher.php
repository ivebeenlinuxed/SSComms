<?php
namespace Controller\Widget;

use Model\Person;

class Person_Searcher {
	public $id = 0;
	
	public function __construct() {
		$this->id = rand(10000,99999);
	}
	
	public function template() {
		\Core\Router::loadView("widget/person_searcher/template");
	}
	
	public function search() {
		$out = array("full_match"=>false, "data"=>array());
		if ((int)trim($_GET['q']) > 0) {
			$p = Person::getByAttribute("wristband_id", $_GET['q']);
			if (count($p) == 1) {
				$out['full_match'] = true;
				$out['data'] = $p;
				echo json_encode($out);
				return;
			}
		}
		
		$out['data'] = Person::Search(array("first_name", "last_name"), $_GET['q']);
		echo json_encode($out);
	}
}