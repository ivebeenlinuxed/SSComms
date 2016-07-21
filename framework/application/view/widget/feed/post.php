<?php 
/**
 * @var \Model\ThreadPost $post
 */
?>
<div class="media feed-post" data-id="<?php echo $post->id  ?>" name="post-<?php echo $post->id  ?>">
	<div class="media-left">
		<a
			href="/api/person/<?php echo $user->id ?>">
			<img class="media-object profile-pic"
			src="http://placehold.it/50x50"
			width="64" alt="<?php echo $user->getName() ?>">
		</a>
	</div>
	<div class="media-body">
		<div class="post-message">
			<div class="pull-right">
				<small><?php
				$date = new \DateTime();
				$date->setTimestamp($post->date);
				echo $date->format("d M Y H:i")?>, <?php echo $user->getName() ?></small>
									</div>
			<h4 class="media-heading"><?php echo $post->title ?></h4>
									<?php
									//Main Message
									$pd = new \Library\Parsedown();
									echo $pd->parse($post->message);
									?>
		</div>
	</div>
</div>