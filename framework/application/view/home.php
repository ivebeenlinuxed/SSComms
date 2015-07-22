<?php
\Core\Router::loadView("api/html/_template/" . \Core\Router::$disposition . "/top");
?>
<h1 class="text-center">Soul Survivor Comms</h1>

	<div class="row-fluid">
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">People</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Search for Person / iMIS number</label> <input type="text"
							class="form-control" id="person-id" />
					</div>
					<div id="person-description">Waiting to search...</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<button class="btn btn-success btn-block" disabled
				id="asset-checkout-btn">Check Out &gt;&gt;</button>
		</div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">Assets</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Asset ID</label> <input id="asset-id" type="text"
							class="form-control" />
					</div>
					<div id="asset-description">Waiting to search...</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="javascript-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<p>One fine body&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
\Core\Router::loadView("api/html/_template/" . \Core\Router::$disposition . "/bottom");
?>