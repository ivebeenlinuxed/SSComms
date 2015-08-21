<?php
namespace Controller\Widget;

class Text_Anywhere {
	public function modal() {
		$prefill = array();
		if ($_GET['recipients'] != "") {
			$e = explode(":", $_GET['recipients']);
			foreach ($e as $person_id) {
				if ($p = \Model\Person::Fetch($person_id)) {
					$prefill[] = $p;
				}
			}
		}
		if ($_GET['message']) {
			$message = \htmlentities($_GET['message']);
		} else {
			$message = "";
		}
		\Core\Router::loadView("widget/text_anywhere/modal", array("recipients"=>$prefill, "message"=>$message));
	}
	
	public function send() {
		$text = new \Library\TextAnywhere();
		$e = explode(":", $_POST['recipients']);
		foreach ($e as $person_id) {
			if ($p = \Model\Person::Fetch($person_id)) {
				if ($p->isPhoneValid()) {
					$text->addDestination($p->getFormattedPhone());
				}
			}
		}
		$text->message = $_POST['message'];
		\Core\Router::loadView("widget/text_anywhere/modal_result", array("result"=>$text->Send()));
	}
}
?>
