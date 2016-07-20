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
			<h4 class="modal-title">Picture Gallery (<?php echo $id+1 ?> of <?php echo count($pics) ?>)</h4>
		</div>
		<div class="modal-body text-center">
			<a href="<?php echo PUBLIC_ROOT ?>/widget/feed/lightbox/<?php echo $post->id ?>?id=<?php echo $next_id ?>">
				<img style="max-width: 100%;" src="<?php echo PUBLIC_ROOT ?>/widget/feed/download/<?php echo $picture->getFile()->getLatestVersion()->id ?>?noattach" />
			</a>
		</div>
		<div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
			<a class="btn btn-secondary" href="<?php echo PUBLIC_ROOT ?>/widget/feed/lightbox/<?php echo $post->id ?>?id=<?php echo $prev_id ?>">Previous</a>
			<a class="btn btn-primary" href="<?php echo PUBLIC_ROOT ?>/widget/feed/lightbox/<?php echo $post->id ?>?id=<?php echo $next_id ?>">Next</a>
		</div>
	</div>
	<!-- /.modal-content -->
</form>
<!-- /.modal-dialog -->
