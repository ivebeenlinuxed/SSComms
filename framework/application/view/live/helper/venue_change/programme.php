<?php 
$start = new \DateTime();
$start->setTime(0, 0, 0);

?>
<style type="text/css">
.gantt {
	overflow-x: scroll;
}

.gantt-scale, .gantt-row {
	width: 1540px;
	border-bottom: 1px solid #555;
}

.gantt-heading {
	width: 100px;
	display: inline-block;
}

.gantt-container {
	width: 1440px;
	overflow-x: hidden;
	display: inline-block;
}

.gantt-scale > .gantt-container > div {
	width: 59px;
}

.gantt-container > div {
	display: inline-block;
	border-right: 1px solid #555;
}

.gantt-event {
	postion: absolute; 
	height: 50px;
	display: block;
}

</style>
<div class="modal-dialog" id="task-open-dlg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Event Programme</h4>
		</div>
		<div class="modal-body">
			<div class="gantt">
			<div class="gantt-scale"><div class="gantt-heading">
						<?php 
						echo $start->format("d/m/Y");
						?>
					</div><div class="gantt-container"><?php 
						for ($i=0; $i<24; $i++) {
						?><div>
							<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>
						</div><?php	
						}
						?></div></div>
				<?php 
				$start_sec = $start->getTimestamp();
				foreach (\Model\Venue::getAll() as $venue) {
				?>
				<div class="gantt-row"><div class="gantt-heading">
						<?php 
						echo $venue->getName();
						?>
					</div><div class="gantt-container">
						<?php 
						foreach ($venue->getEventsByDay($start) as $event) {
						?>
						<a href="/api/event/<?php echo $event->id ?>" data-ajaxless class="gantt-event" style="background-color: red; margin-left: <?php echo ($event->start-$start_sec)/60 ?>px; width: <?php echo ($event->end-$event->start)/60 ?>px">
							<strong><?php echo $event->description ?></strong>
						</a>
						<?php	
						}
						?>
					</div></div>
				<?php 
				}
				?>
			</div>
		</div>
	</div>
</div>