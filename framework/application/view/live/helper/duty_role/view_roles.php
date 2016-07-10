<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">View Roles</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<?php 
				foreach (\Model\DutyRole::getAll() as $role) {
				?>
				<div class="col-md-3">
					<div class="thumbnail">
					<h4><?php echo $role->getName() ?></h4>
					<div><?php
					$assignee = $role->getCurrentlyAssigned();
					if ($assignee != null) {
						echo "Currently assigned to {$assignee->getPerson()->getName()}";
					} else {
						echo "Currently unassigned";
					}
					?></div>
				</div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
	
</div>