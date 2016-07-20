<div class="feed" data-thread="<?php echo $thread->id ?>">
						<?php
						if ($controller->edit_mode) {
						?>
						<div class="feed-input">
							<?php 
							if ($controller->title) {
							?>
							<input type="text" class="form-control"
								placeholder="Super Cool Title" />
							<?php 
							}
							?>
							<textarea class="form-control" placeholder="Some message here"></textarea>
							<ul class="feed-attachments">
							</ul>
							<div class="pull-right">
								<button class="btn btn-primary feed-post">Post</button>
							</div>
							<!-- 
							<div class="btn-group">
								<button class="btn btn-secondary feed-attach">Attach Document</button>
							</div>
							 -->
						</div>
						<?php
						}
						?>
<div class="feed-posts">
							<?php
							/**
							 * @var \Model\Thread $thread
							 */
							$posts = $thread->getThreadPosts($controller->num_posts);
							foreach ($posts  as $post ) {
								$controller->render_post($post->id);
							}
							
							if (count($posts) == 0) {
								echo "No Posts";
							}
							?>
						</div>
					</div>