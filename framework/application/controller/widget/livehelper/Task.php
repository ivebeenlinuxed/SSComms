<?php
namespace Controller\Widget\LiveHelper;

use Library\Live\TileResult;
use Library\Live\Tile;
use Library\Live\TileAction;

class Task {
	public function open_task() {
		\Core\Router::loadView("live/helper/task/open");
	}
	
	public function open_save() {
		$t = \Model\Task::Create(array(
				"summary"=>$_POST['summary'],
				"category"=>$_POST['category'],
				"opened_actor"=>\Core\Router::getCurrentPerson()->id,
				"opened_time"=>time()
		));
		echo json_encode($t);
	}
	
	public static function GetTileResult($since) {
		$tr = new TileResult();
	
		foreach (\Model\Task::getByAttribute("closed_time", false) as $task) {
	
			$tile = new Tile();
			$tile->title = "Open {$task->getCategory()->getName()}";
			$tile->description = "{$task->summary}";
		
			$tile_action_view = new TileAction();
			$tile_action_view->label = "Quick View";
			$tile_action_view->action = "/api/task/{$task->id}";
			$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
			$tile->actions[] = $tile_action_view;
		
			$tile_action_view = new TileAction();
			$tile_action_view->label = "Open";
			$tile_action_view->action = "/api/task/{$task->id}";
			$tile_action_view->action_disposition = TileAction::DISPOSITION_LINK;
			$tile->actions[] = $tile_action_view;
			
			$tile_action_view = new TileAction();
			$tile_action_view->label = "Close";
			$tile_action_view->action = "/widget/livehelper/task/quick_close";
			$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
			$tile->actions[] = $tile_action_view;
			
		
			$tr->outstanding_jobs[] = $tile;
		}
		
		return $tr;
	}
}