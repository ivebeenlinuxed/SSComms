<?php
namespace Controller\Widget\LiveHelper;

use Library\Live\TileAction;
use Library\Live\Tile;

class Duty_Role {
	public function GetTileResult() {
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
		
	}
}