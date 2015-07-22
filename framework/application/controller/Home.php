<?php
namespace Controller;

class Home {
	function index() {
		\Core\Router::loadView("home");
	}
	
	public function get_activations() {
		$db = \Model\Person::getDB();
		$select = $db->Select("\Model\Person");
		$select->addField("id");
		$select->addField("phone_number");
		$select->addField("first_name");
		$select->addField("last_name");
		$select->addField("team");
		$select->addField("verify_time");
		
		$and = $select->getAndFilter();
		$and->eq("active", 0);
		$and->gt("verify_time", time()-40);
		$select->setFilter($and);
		
		echo json_encode($select->Exec());
	}
	
	public function try_activate() {
		if (!isset($_POST['id']) || !isset($_POST['verify'])) {
			return;
		}
		$p = new \Model\Person($_POST['id']);
		echo json_encode(array("success"=>$p->Verify($_POST['verify'])));
	}
	
	public function activation() {
		\Core\Router::loadView("activation");
		
	}
}
