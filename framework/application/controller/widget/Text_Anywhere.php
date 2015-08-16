<?php
namespace Controller\Widget;

class Text_Anywhere {
	public function modal() {
		$prefill = array();
		if ($_GET['recipients'] != "") {
			$e = explode(":", $_GET['recipients']);
			foreach ($e as $person_id) {
				if ($p = \Model\Person::Fetch($person_id)) {
					if (strlen($p->telephone) > 5) {
						$prefill[] = $p;
					}
				}
			}
		}
		if ($_GET['message']) {
			$message = htmlencode($_GET['message']);
		} else {
			$message = "";
		}
		\Core\Router::loadView("widget/text_anywhere/modal", array("recipients"=>$prefill, "message"=>$message));
	}
	
	public function send() {
		$text = new \Library\TextAnywhere();
		$e = explode(":", $_POST['people']);
		foreach ($e as $person_id) {
			if ($p = \Model\Person::Fetch($person_id)) {
				if (strlen($p->telephone) > 0) {
					$text->addDestination($p->telephone);
				}
			}
		}
		$text->message = $_POST['message'];
	}
}
?>
