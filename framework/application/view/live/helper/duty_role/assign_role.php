<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Assign Role to <?= $person->getName() ?></h4>
		</div>
		<div class="modal-body">
			<input type="hidden" id="assign-role-person" value="<?php echo $person->id ?>" />
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
					<button class="btn btn-success pull-right assign-role-btn" data-role="<?= $role->id ?>">Assign</button>
					<div class="clearfix"></div>
				</div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
			document.querySelectorAll(".assign-role-btn").forEach((btn) => {
				btn.addEventListener("click", () => {
					var fd = new FormData();
					fd.append("person", document.querySelector("#assign-role-person").value);
					fd.append("role", btn.dataset.role);

					fetch("/widget/livehelper/duty_role/assign_save", {
						credentials: "include",
						body: fd,
						method: "post"
					}).then(() => {
							$("#api-modal").modal('hide');
					});
				});
			});
			</script>
</div>