<?php
namespace Controller;

class Safety extends BaseController {
	public function Manager() {
		if (isset($_POST['new_question'])) {
			$venues = \Model\Venue::getAll();
			$venue_check_questions = \Model\VenueCheckQuestion::getAll();
			
			//New questions
			if ($_POST['new_question'] != "") {
				$vq = \Model\VenueCheckQuestion::Create(array("question"=>$_POST['new_question']));
				foreach ($venues as $venue) {
					if ($_POST['question_0_'.$venue->id] == "on") {
						\Model\VenueCheckSelectedQuestion::Create(array("venue"=>$venue->id, "venue_check_question"=>$vq->id));
					}
				}
			}
			
			//Old questions
			foreach ($venue_check_questions as $vc_question) {
				foreach ($venues as $venue) {
					if ($_POST['question_'.$vc_question->id.'_'.$venue->id] == "on") {
						//Save tick
						$qs = \Model\VenueCheckSelectedQuestion::getByAttributes(array("venue"=>$venue->id, "venue_check_question"=>$vc_question->id));
						if (count($qs) == 0) {
							\Model\VenueCheckSelectedQuestion::Create(array("venue"=>$venue->id, "venue_check_question"=>$vc_question->id));
						}
					} else {
						//Save no tick
						$qs = \Model\VenueCheckSelectedQuestion::getByAttributes(array("venue"=>$venue->id, "venue_check_question"=>$vc_question->id));
						foreach ($qs as $q) {
							$q->Delete();
						}
					}
				}
			}
		}
		\Core\Router::loadView("safety/manager");
		
		
	}
}
