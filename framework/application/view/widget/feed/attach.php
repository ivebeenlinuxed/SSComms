
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
				<span aria-hidden="true">&times;</span> <span class="sr-only">Close</span>
			</button>
			<h4 class="modal-title">Attach Document</h4>
		</div>
		<div class="modal-body">
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item"><a class="nav-link active" href="#upload_new"
					role="tab" data-toggle="tab">Upload New</a></li>
				<li class="nav-item"><a class="nav-link" href="#update_existing" role="tab"
					data-toggle="tab">Update Existing</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="upload_new">
					<br />
					<input type="file" name="new_file" multiple />
					<div class="clearfix"></div>
					<div class="pull-right">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button class="btn btn-primary feed-attach-upload">Upload</button>
					</div>
					<div class="clearfix"></div>
				</div>
				<div role="tabpanel" class="tab-pane" id="update_existing">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Last Updated</th>
								<th>Versions</th>
								<th>Author</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach (\Model\UserDocument::getAll() as $doc) {
								$file = $doc->getFile();
								$version = $file->getLatestVersion();
							?>
							<tr>
								<td><?php echo $doc->id ?></td>
								<td><?php echo $file->getName() ?></td>
								<td><?php
								$date = new \DateTime($version->date_added);
								echo $date->format("d/m/Y H:i");
								?></td>
								<td><?php echo count($file->getVersions()) ?></td>
								<td>[NYI]</td>
								<td>
									<div class="btn-group">
										<button class="btn btn-secondary feed-update-existing" data-id="<?php echo $doc->id ?>">Update</button>
										<button class="btn btn-primary feed-add-existing" data-id="<?php echo $doc->id ?>">Add</button>
									</div>
								</td>
							</tr>
							<?php 
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
