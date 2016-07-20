<div class="media feed-comment" data-id="<?php echo $comment->id ?>">
	<a class="media-left"
		href="<?php echo PUBLIC_ROOT ?>/api/user/<?php echo $user->staff_number ?>">
		<img class="media-object profile-pic"
		src="<?php echo PUBLIC_ROOT ?>/api/user/profile_picture/<?php echo $user->staff_number ?>"
		width="32" alt="<?php echo $user->getName() ?>">
	</a>
	<div class="media-body">
		<?php 
		if ($comment->UserCanDelete($current_user)) {
		?>
		<div class="pull-right"><a href="#" data-type="delete" data-id="<?php echo $comment->id ?>">&times;</a></div>
		<?php 
		}
		?>
		<strong><a data-table="user" data-id="<?php echo $user->staff_number ?>" href="<?php echo PUBLIC_ROOT ?>/api/user/<?php echo $user->staff_number ?>"><?php echo $user->getName() ?></a></strong> <?php
		$pd = new \Library\Parsedown();
		echo $pd->parse($comment->message);
		?>
	</div>
</div>