<?php 
/**
 * @var \Model\ThreadPost $post
 */
?>
<div class="media feed-post" data-id="<?php echo $post->id  ?>" name="post-<?php echo $post->id  ?>">
	<div class="media-left">
		<a
			href="<?php echo PUBLIC_ROOT ?>/api/user/<?php echo $user->staff_number ?>">
			<img class="media-object profile-pic"
			src="<?php echo PUBLIC_ROOT ?>/api/user/profile_picture/<?php echo $user->staff_number ?>"
			width="64" alt="<?php echo $user->getName() ?>">
		</a> <br />
		<div>
			<?php 
			if ($controller->edit_mode) {
			?>
			<a href="#" data-type="thread-star">
			<?php 
			}
			?>
			<i
				class="fa <?php echo $post->isStarredByUser($current_user)? "fa-star" : "fa-star-o" ?>"></i>
				<span class="thread-star-count"><?php echo count($stars)?></span>
				Star
				
				<?php 
			if ($controller->edit_mode) {
			?>
			</a><?php 
			}
			?>
		</div>
		<div>
			<?php 
			if ($controller->edit_mode) {
			?><a href="#" data-type="new-comment"><?php 
			}
			?><i class="fa fa-comment-o"></i> <span class="thread-reply-count"><?php echo count($comments) ?></span> Reply<?php 
			if ($controller->edit_mode) {
			?></a><?php 
			}
			?>
		</div>
	</div>
	<div class="media-body">
		<div class="post-message">
			<div class="pull-right">
				<small><?php
				echo (new \DateTime($post->date))->format("d M Y H:i")?>, <?php echo $user->getName() ?></small>
									<?php
									if ($post->UserCanDelete($current_user)) {
										?>
					<a href="#" data-type="delete" data-id="<?php echo $post->id ?>">&times;</a>
									<?php
									}
									?>
		
									</div>
			<h4 class="media-heading"><?php echo $post->title ?></h4>
									<?php
									//Main Message
									$pd = new \Library\Parsedown();
									echo $pd->parse($post->message);
									
									
									
									
									//Attached documents
									$pics = $post->getUserDocumentsByType(\Model\ThreadPost::USER_DOCUMENT_TYPE_PICTURE);
									$docs = $post->getUserDocumentsByType(\Model\ThreadPost::USER_DOCUMENT_TYPE_DOCUMENT);
									
									if (count($pics) > 0) {
									?>
									<div class="feed-lightbox">
									<?php
									}
									foreach ($pics as $key=>$pic) {
									?>
									<a href="<?php echo PUBLIC_ROOT ?>/widget/feed/lightbox/<?php echo $post->id ?>?id=<?php echo $key ?>" data-type="api-modal">
										<img src="<?php echo PUBLIC_ROOT ?>/widget/feed/download/<?php echo $pic->getFile()->getLatestVersion()->id ?>?noattach" />
									</a>
									<?php	
									}
									
									if (count($pics) > 0) {
									?>
									</div>
									<?php	
									}
									
									foreach ($docs as $user_document) {
									$file = $user_document->getFile();
										?>
									<div class="media">
				<a class="media-left" href="<?php echo PUBLIC_ROOT ?>/widget/feed/download/<?php echo $file->getLatestVersion()->id ?>"> <img class="media-object"
					src="<?php echo PUBLIC_ROOT ?>/img/icons/download.svg" width="40" alt="Generic placeholder image">
				</a>
				<div class="media-body">
					<h5 class="media-heading"><?php echo $file->name ?></h5>
					<a
						href="<?php echo PUBLIC_ROOT ?>/widget/feed/download/<?php echo $file->getLatestVersion()->id ?>"><i
						class="fa fa-paperclip"></i> Download Attachment</a>
				</div>
			</div>
									<?php
									}
									?>
									</div>
		<div>
			<small class="thread-star-text"><?php
			//"X and Y starred this"
			echo $controller->getStarLineText($post);
			?></small>
			<!-- Comment Stream -->
			<div class="thread-comment-stream">
				<!-- Submission Form -->
				<div class="media comment-form">
					<a class="media-left"
						href="<?php echo PUBLIC_ROOT ?>/api/user/<?php echo $current_user->staff_number ?>">
						<img class="media-object profile-pic"
						src="<?php echo PUBLIC_ROOT ?>/api/user/profile_picture/<?php echo $current_user->staff_number ?>"
						width="32" alt="<?php echo $current_user->getName() ?>">
					</a>
					<div class="media-body">
						<textarea class="form-control"></textarea>
					</div>
				</div>
											<?php
											foreach ( $comments as $key=>$comment ) {
												if ($key == 5) {
												?>
												<a href="#" data-id="<?php echo $post->id ?>" data-type="comments-expand"><small>Show Older Comments...</small></a>
												<div class="collapse" data-id="<?php echo $post->id ?>">
												<?php 
												}
												$controller->render_comment($comment);
											}
											
											if ($key >= 5) {
											?>
											</div>
											<?php 
											}
											?>
										</div>
		</div>
	</div>
</div>