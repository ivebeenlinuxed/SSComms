
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
				<span aria-hidden="true">&times;</span> <span class="sr-only">Close</span>
			</button>
			<h4 class="modal-title">Update Document #<?php echo $doc->id ?> (<?php echo $doc->getFile()->name ?>)</h4>
		</div>
		<div class="modal-body">
			<br /> <input type="file" name="new_file" />
			<div class="clearfix"></div>
			<div class="pull-right">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button class="btn btn-primary feed-attach-upload">Upload</button>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
