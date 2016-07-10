<?php
namespace Controller\Widget\LiveHelper;

use Library\Live\TileAction;
use Library\Live\Tile;
use Library\Live\TileResult;

class Duty_Role {
	public function assign_person() {
		\Core\Router::loadView("live/helper/duty_role/assign_person");
	}
	
	public function assign_role($person_id) {
		$person = new \Model\Person($person_id);
		\Core\Router::loadView("live/helper/duty_role/assign_role", array("person"=>$person));
		
	}
	
	public function assign_save() {
		$person = new \Model\Person($_POST['person']);
		$role = new \Model\DutyRole($_POST['role']);
		$role->Reassign($person);
	}
	
	public function retire_role() {
		\Core\Router::loadView("live/helper/duty_role/retire_role");
	}
	
	public function retire_save() {
		$role = new \Model\DutyRole($_POST['role']);
		$role->Retire();
	}
	
	public function view_roles() {
		\Core\Router::loadView("live/helper/duty_role/view_roles");
	}
	
	public static function GetTileResult($since) {
		$tr = new TileResult();
		
		$assigned = 0;
		$total = 0;
		
		
		foreach (\Model\DutyRole::getAll() as $role) {
			$total++;
			if ($role->isAssigned()) {
				$assigned++;
			}
		}
		
		$tile = new Tile();
		$tile->title = "Duty Roles";
		$tile->description = "{$assigned}/{$total} roles are currently on duty";
		
		$tile_action_view = new TileAction();
		$tile_action_view->label = "View";
		$tile_action_view->action = "/widget/livehelper/duty_role/view_roles";
		$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
		$tile->actions[] = $tile_action_view;
		
		$tile_action_view = new TileAction();
		$tile_action_view->label = "Assign";
		$tile_action_view->action = "/widget/livehelper/duty_role/assign_person";
		$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
		$tile->actions[] = $tile_action_view;
		$tile_action_view = new TileAction();
		$tile_action_view->label = "Retire";
		$tile_action_view->action = "/widget/livehelper/duty_role/retire_role";
		$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
		$tile->actions[] = $tile_action_view;
		
		$tr->current_information[] = $tile;
		
		
		
		
		
		$sql = \Model\EquipmentCheckout::getDB()->Select(\Model\DutyRolePerson::class);
		$sql->addField("start_time")->addField("duty_role")->addField("person");
		$and = $sql->getAndFilter();
		$and->gt("start_time", $since);
		$rows = $sql->setFilter($and)->Exec();
		
		foreach ($rows as $row) {
			$duty_role = new \Model\DutyRole($row['duty_role']);
			$person = new \Model\Person($row['person']);
			$time = new \DateTime();
			$time->setTimestamp($row['start_time']);
				
			$tile = new Tile();
			$tile->time = $row['start_time'];
			$tile->title = "Shift Change";
			$tile->description = "{$person->getName()} is now {$duty_role->getName()}";
				
			$action_show_pers = new TileAction();
			$action_show_pers->label = "Show Person";
			$action_show_pers->action = "/api/person/{$person->id}";
			$action_show_pers->action_disposition = TileAction::DISPOSITION_LINK;
			$tile->actions[] = $action_show_pers;
		
			$tr->live_updates[] = $tile;
		}
		
		
		$sql = \Model\EquipmentCheckout::getDB()->Select(\Model\DutyRolePerson::class);
		$sql->addField("end_time")->addField("duty_role")->addField("person");
		$and = $sql->getAndFilter();
		$and->gt("end_time", $since);
		$rows = $sql->setFilter($and)->Exec();
		
		foreach ($rows as $row) {
			$duty_role = new \Model\DutyRole($row['duty_role']);
			$person = new \Model\Person($row['person']);
			$time = new \DateTime();
			$time->setTimestamp($row['end_time']);
			
			if ($duty_role->getCurrentlyAssigned() != null) {
				continue;
			}
			
			$tile = new Tile();
			$tile->time = $row['end_time'];
			$tile->title = "Shift Change";
			$tile->description = "{$person->getName()} is no longer {$duty_role->getName()}";
		
			$action_show_pers = new TileAction();
			$action_show_pers->label = "Show Person";
			$action_show_pers->action = "/api/person/{$person->id}";
			$action_show_pers->action_disposition = TileAction::DISPOSITION_LINK;
			$tile->actions[] = $action_show_pers;
		
			$tr->live_updates[] = $tile;
		}
		
		return $tr;
	}
}