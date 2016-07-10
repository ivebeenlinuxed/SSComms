<?php
namespace Controller\Widget\LiveHelper;

use Library\Live\TileAction;
use Library\Live\Tile;
use Library\Live\TileResult;

class Duty_Role {
	public function assign_person() {
		\Core\Router::loadView("live/helper/duty_role/assign_person");
	}
	
	public function assign_role() {
		
		\Core\Router::loadView("live/helper/duty_role/assign_role");
		
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
		$tile_action_view->action = "/widget/livehelper/duty_role/view_roles";
		$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
		$tile->actions[] = $tile_action_view;
		
		$tr->current_information[] = $tile;
		
		
		return $tr;
	}
}