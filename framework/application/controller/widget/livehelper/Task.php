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
	
	public function close() {
		if (isset($_POST['task'])) {
			$task = new \Model\Task($_POST['task']);
			$task->setAttributes(array(
					"closed_actor"=>\Core\Router::getCurrentPerson()->id,
					"closed_time"=>time()
			));
			header("Location: /live");
			return;
		}
		$task = new \Model\Task($_GET['task']);
		\Core\Router::loadView("live/helper/task/close", array("task"=>$task));
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
			$tile_action_view->action = "/widget/livehelper/task/close?task={$task->id}";
			$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
			$tile->actions[] = $tile_action_view;
			
		
			$tr->outstanding_jobs[] = $tile;
		}
		
		$task_sel = \Model\Task::getDB()->Select(\Model\Task::class);
		$task_fil = $task_sel->getAndFilter();
		$task_fil->gt("opened_time", $since);
		$task_sel->setFilter($task_fil);
		$task_sel->addField("id");
		
		foreach ($task_sel->Exec() as $task_row) {
			$task = new \Model\Task($task_row['id']);
			$tile = new Tile();
			$tile->time = $task->opened_time;
			$tile->title = "{$task->getCategory()->getName()} Opened";
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
			$tile_action_view->action = "/widget/livehelper/task/close?task={$task->id}";
			$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
			$tile->actions[] = $tile_action_view;
				
		
			$tr->live_updates[] = $tile;
		}
		
		$task_sel = \Model\Task::getDB()->Select(\Model\Task::class);
		$task_fil = $task_sel->getAndFilter();
		$task_fil->gt("closed_time", $since);
		$task_sel->setFilter($task_fil);
		$task_sel->addField("id");
		
		foreach ($task_sel->Exec() as $task_row) {
			$task = new \Model\Task($task_row['id']);
			$tile = new Tile();
			$tile->title = "{$task->getCategory()->getName()} Closed";
			$tile->time = $task->closed_time;
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
			$tile_action_view->action = "/widget/livehelper/task/close?task={$task->id}";
			$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
			$tile->actions[] = $tile_action_view;
		
		
			$tr->live_updates[] = $tile;
		}
		
		return $tr;
	}
}