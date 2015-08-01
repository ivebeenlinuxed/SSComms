<?php
namespace Controller;

class Venue_Check {
	public function form() {
		\Core\Router::loadView("venue_check/form");
	}

	public function sync() {
		$p = \Core\Router::getCurrentPerson();
		$checks = \Model\VenueCheck::getByAttributes(array("actor"=>$p->id, "status"=>"0"));
		
		$out = array();
		foreach ($checks as $check) {
			$r = $check->getVenueCheckResponses();
			$qs = array();
			foreach ($r as $res) {
				$qs[] = $res->getVenueCheckQuestion();
			}
			$out[] = array(
				"venue"=>$check->getVenue(),
				"check"=>$check,
				"questions"=>$qs,
				"responses"=>$r,
				"logs"=>array()
				);
		}
		echo json_encode($out);
	}
}
