<?php
namespace Controller\Widget\LiveHelper;

use Model\Person;
use Model\Equipment;
use Library\Live\TileAction;
use Library\Live\Tile;
use Library\Live\TileResult;

class Asset_Change {
	public function change_asset() {
		\Core\Router::loadView("live/helper/asset_change/out_person");
	}
	
	public function change_asset_list(int $person_id) {
		$person = new \Model\Person($person_id);
		\Core\Router::loadView("live/helper/asset_change/change_asset_list", array("person"=>$person));
	}
	
	public function save_out() {
		$person = new \Model\Person($_POST['user']);
		foreach (json_decode($_POST['assets']) as $asset) {
			$asset = new Equipment($asset);
			$asset->SwitchOwner($person);
		}
	}
	
	public function in() {
		\Core\Router::loadView("live/helper/asset_change/in");
	}
	
	public function in_save() {
		foreach (json_decode($_POST['assets']) as $asset) {
			$asset = new Equipment($asset);
			$asset->CheckIn();
		}
	}
	
	public static function GetTileResult($since) {
		$tr = new TileResult();
	
		
		$sql = \Model\EquipmentCheckout::getDB()->Select(\Model\EquipmentCheckout::class);
		$sql->addField("checkout")->addField("out_actor")->addField("equipment")->addField("person");
		$and = $sql->getAndFilter();
		$and->gt("checkout", $since);
		$rows = $sql->setFilter($and)->Exec();
		
		foreach ($rows as $row) {
			$equipment = new \Model\Equipment($row['equipment']);
			$actor = new \Model\Person($row['out_actor']);
			$person = new \Model\Person($row['person']);
			$time = new \DateTime();
			$time->setTimestamp($row['checkout']);
			
			$tile = new Tile();
			$tile->time = $row['checkout'];
			$tile->title = "Equipment Checkout";
			$tile->description = "{$equipment->getName()} has been signed out to {$person->getName()}";
			$action_show_equip = new TileAction();
			$action_show_equip->label = "Show Equipment";
			$action_show_equip->action = "/api/equipment/{$equipment->id}";
			$action_show_equip->action_disposition = TileAction::DISPOSITION_LINK;
			$tile->actions[] = $action_show_equip;
			
			$action_show_pers = new TileAction();
			$action_show_pers->label = "Show Person";
			$action_show_pers->action = "/api/person/{$person->id}";
			$action_show_pers->action_disposition = TileAction::DISPOSITION_LINK;
			$tile->actions[] = $action_show_pers;

			$tr->live_updates[] = $tile;
		}
		
		$sql = \Model\EquipmentCheckout::getDB()->Select(\Model\EquipmentCheckout::class);
		$sql->addField("checkin")->addField("in_actor")->addField("equipment")->addField("person");
		$and = $sql->getAndFilter();
		$and->gt("checkin", $since);
		$rows = $sql->setFilter($and)->Exec();
		
		foreach ($rows as $row) {
			$equipment = new \Model\Equipment($row['equipment']);
			$actor = new \Model\Person($row['in_actor']);
			$person = new \Model\Person($row['person']);
			$time = new \DateTime();
			$time->setTimestamp($row['checkin']);
				
			$tile = new Tile();
			$tile->time = $row['checkin'];
			$tile->title = "Equipment Checkin";
			$tile->description = "{$equipment->getName()} has been signed in to Comms";
			$action_show_equip = new TileAction();
			$action_show_equip->label = "Show Equipment";
			$action_show_equip->action = "/api/equipment/{$equipment->id}";
			$action_show_equip->action_disposition = TileAction::DISPOSITION_LINK;
			$tile->actions[] = $action_show_equip;
				
			$action_show_pers = new TileAction();
			$action_show_pers->label = "Show Person";
			$action_show_pers->action = "/api/person/{$person->id}";
			$action_show_pers->action_disposition = TileAction::DISPOSITION_LINK;
			$tile->actions[] = $action_show_pers;
			$tr->live_updates[] = $tile;
		}
		
	
		$db = \Model\Team::getDB();
		$rows = $db->Exec(<<<EOF
SELECT COUNT(*) AS number, team.name AS team_name, team.radio_allocation
FROM equipment
LEFT JOIN equipment_category ON equipment.category = equipment_category.id
LEFT JOIN equipment_checkout ON equipment.id = equipment_checkout.equipment
LEFT JOIN person ON equipment_checkout.person = person.id
LEFT JOIN team ON person.team = team.id
WHERE
		(equipment_checkout.checkin=0 OR equipment_checkout.checkin IS NULL)
				AND equipment_category.id=2
				AND team.radio_allocation != -1
				GROUP BY team.id HAVING COUNT(*) > team.radio_allocation ORDER BY number DESC
EOF
		);
		
		foreach ($rows as $row) {
			$tile = new Tile();
			$tile->time = time();
			$tile->title = "Radio Over Allocation";
			$tile->description = "{$row['team_name']} have been assigned {$row['radio_allocation']} radios but have {$row['number']} checked out";
			$action_show_equip = new TileAction();
			$action_show_equip->label = "Show Equipment Category";
			$action_show_equip->action = "/api/equipment_category/2";
			$action_show_equip->action_disposition = TileAction::DISPOSITION_LINK;
			$tile->actions[] = $action_show_equip;
			$tr->current_information[] = $tile;
			
		}
		
	
		return $tr;
	}
}