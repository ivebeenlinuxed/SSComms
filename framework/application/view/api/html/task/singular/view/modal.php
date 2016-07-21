<?php 
$task = $data;
?>
<div class="modal-dialog">
	<div class="modal-content" id="view-task-modal-feed">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">View Task #<?php echo $task->id ?></h4>
		</div>
		<div class="modal-body">
			<a href="/widget/livehelper/task/close?task=<?php echo $task->id ?>" class="btn btn-danger pull-right">Close Task</a>
			<p><strong>Summary: </strong><?php echo $task->summary ?></p>
			<p><strong>Opened: </strong><?php echo date("d/m/Y H:i", $task->opened_time) ?> (<?php echo $task->getOpenedActor()->getName() ?>)</p>
			<p><strong>Category: </strong><?php echo $task->getCategory()->getName() ?></p>
			<?php 
			if ($task->closed_time) {
			?>
			<p><strong>Closed: </strong><?php echo date("d/m/Y H:i", $task->closed_time) ?> (<?php echo $task->getClosedActor()->getName() ?>)</p>
			<?php 
			}
			
			$feed = new \Controller\Widget\Feed();
			$feed->title = false;
			$feed->index($task->getThread());
			?>
			
		</div>
	</div>
</div>