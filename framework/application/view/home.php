<?php
\Core\Router::loadView("api/html/_template/" . \Core\Router::$disposition . "/top");
?>
<h1 class="text-center">Soul Survivor Comms</h1>

<div role="tabpanel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#asset-manager"
			aria-controls="home" role="tab" data-toggle="tab">Asset Manager</a></li>
		<li role="presentation"><a href="#site-overview"
			aria-controls="profile" role="tab" data-toggle="tab">Site Overview</a></li>
		<li role="presentation"><a href="#tab-incidents" aria-controls="messages"
			role="tab" data-toggle="tab">Incident Reports <span class="badge">0</span></a></li>
		<li role="presentation"><a href="#tab-activations" aria-controls="settings"
			role="tab" data-toggle="tab">Activations <span class="badge">0</span></a></li>
	</ul>
	<br />
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="asset-manager">
			<div class="row-fluid">
				<div class="col-md-5">
					<div class="panel panel-default">
						<div class="panel-heading">People</div>
						<div class="panel-body">
							<div class="form-group">
								<label>Search for Person / iMIS number</label> <input
									type="text" class="form-control" id="person-id" />
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
		<div role="tabpanel" class="tab-pane" id="site-overview">
			<div class="row-fluid">
				<div class="col-md-4">
					<div class="well media">
						<div class="media-left media-top">
							<a href="#"> <img class="media-object"
								src="http://placehold.it/50x50" alt="pic">
							</a>
						</div>
						<div class="media-body">
							<h4 class="media-heading">Duty Site Manager</h4>
							<strong>Name: </strong>Will Tinsdeall<br /> <strong>Call Sign: </strong>Alpha
							1.5<br /> <strong>Phone: </strong>01234 567890<br />
							</dl>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="well media">
						<div class="media-left media-top">
							<a href="#"> <img class="media-object"
								src="http://placehold.it/50x50" alt="pic">
							</a>
						</div>
						<div class="media-body">
							<h4 class="media-heading">Duty Charlie Lima</h4>
							<strong>Name: </strong>Will Tinsdeall<br /> <strong>Call Sign: </strong>Alpha
							1.5<br /> <strong>Phone: </strong>01234 567890<br />
							</dl>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="well media">
						<div class="media-left media-top">
							<a href="#"> <img class="media-object"
								src="http://placehold.it/50x50" alt="pic">
							</a>
						</div>
						<div class="media-body">
							<h4 class="media-heading">Duty Welfare</h4>
							<strong>Name: </strong>Will Tinsdeall<br /> <strong>Call Sign: </strong>Alpha
							1.5<br /> <strong>Phone: </strong>01234 567890<br />
							</dl>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row-fluid">
					<div class="col-md-4">
						<div class="well media">
							<div class="media-left media-top">
								<a href="#"> <img class="media-object"
									src="http://placehold.it/50x50" alt="pic">
								</a>
							</div>
							<div class="media-body">
								<h4 class="media-heading">Duty Village Host</h4>
								<strong>Name: </strong>Will Tinsdeall<br /> <strong>Call Sign: </strong>Alpha
								1.5<br /> <strong>Phone: </strong>01234 567890<br />
								</dl>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="well media">
							<div class="media-left media-top">
								<a href="#"> <img class="media-object"
									src="http://placehold.it/50x50" alt="pic">
								</a>
							</div>
							<div class="media-body">
								<a href="#">View others...</a>
							</div>
						</div>
					</div>
					<!-- 
				<div class="col-md-4">
					<div class="well media">
						<div class="media-left media-top">
							<a href="#"> <img class="media-object"
								src="http://placehold.it/50x50" alt="pic">
							</a>
						</div>
						<div class="media-body">
							<h4 class="media-heading" data-toggle="tooltip"
								data-placement="bottom" title="Most check-outs in the day">Sonic
								Award</h4>
						</div>
					</div>
				</div>
				 -->
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="tab-incidents">
			NOT YET IMPLEMENTED
		</div>
		<div role="tabpanel" class="tab-pane" id="tab-activations">
			NOT YET IMPLEMENTED
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