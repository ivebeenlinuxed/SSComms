<?php
use System\Library\StdLib;
?>
<form
	action="<?php echo PUBLIC_ROOT ?>/api/user_notification/group_push"
	method="post" class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
				<span aria-hidden="true">&times;</span> <span class="sr-only">Close</span>
			</button>
			<h4 class="modal-title">Stars</h4>
		</div>
		<div class="modal-body">
			<?php 
			foreach ($stars as $star) {
				$user = $star->getUser();
			?>
			<div class="media">
				<a class="media-left"
					href="<?php echo PUBLIC_ROOT ?>/api/user/<?php echo $user->staff_number ?>">
					<img class="media-object profile-pic"
					src="<?php echo PUBLIC_ROOT ?>/api/user/profile_picture/<?php echo $user->staff_number ?>"
					width="64" alt="<?php echo $user->getName() ?>">
				</a>
				<div class="media-body">
					<h4><?php echo $user->getName() ?></h4>
				</div>
			</div>
			<?php 
			}
			?>
			</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	</div>
	<!-- /.modal-content -->
</form>
<!-- /.modal-dialog -->
