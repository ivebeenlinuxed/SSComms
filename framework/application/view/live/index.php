<?php
\Core\Router::loadView ( "api/html/_template/full/top" );
?>
<div class="container-fluid">
	<div class="btn-toolbar" role="toolbar" aria-label="...">
		<div class="btn-group" role="group" aria-label="...">
			<a class="btn btn-default" href="/widget/livehelper/asset_change/change_asset" data-type="api-modal">Check Out Assets</a> <a
				class="btn btn-default">Switch Assets</a> <a class="btn btn-default">Check
				In Assets</a>
		</div>
		<div class="btn-group" role="group" aria-label="...">
			<a class="btn btn-default">Assign Duty</a> <a class="btn btn-default">Retire
				Duty</a>
		</div>
		<div class="btn-group" role="group" aria-label="...">
			<a class="btn btn-default">Allocate Incident</a> <a
				class="btn btn-default">Open Task</a>
		</div>
	</div>
	<template id="tile-templ">
	<div class="media">
		<div class="media-left">
			<a href="#"> <img class="media-object"
				src="http://placehold.it/30x30" alt="...">
			</a>
		</div>
		<div class="media-body">
			<h4 class="media-heading">Media heading</h4>
			<span></span>
			<div class="action-btns">
				<a href="#" class="pull-right btn btn-xs btn-primary">View</a>
			</div>
		</div>
	</div>
	</template>

	<div class="row">
		<div class="col-xs-4">
			<h3>Live Updates</h3>
			<div class="well">
				<div class="media">
					<div class="media-left">
						<a href="#"> <img class="media-object"
							src="http://placehold.it/30x30" alt="...">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Media heading</h4>
						...
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<h3>Current Information</h3>
			<div class="well">
				<div class="media">
					<div class="media-left">
						<a href="#"> <img class="media-object"
							src="http://placehold.it/30x30" alt="...">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Duty Roles</h4>
						5/6 key roles are currently on duty

						<div>
							<a href="#" class="pull-right btn btn-xs btn-primary">View</a>
						</div>
					</div>
				</div>
				<div class="media">
					<div class="media-left">
						<a href="#"> <img class="media-object"
							src="http://placehold.it/30x30" alt="...">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Venue Changes</h4>
						There are 3 venue changes today
						<div>
							<a href="#" class="pull-right btn btn-xs btn-primary">View</a>
						</div>
					</div>
				</div>
				<div class="media">
					<div class="media-left">
						<a href="#"> <img class="media-object"
							src="http://placehold.it/30x30" alt="...">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Radio Allocations</h4>
						Currently 34 radios in service, 12 in stock, 2 teams over limits
						<div>
							<a href="#" class="pull-right btn btn-xs btn-primary">View</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<h3>Outstanding Jobs</h3>
		</div>
	</div>
</div>
<?php
\Core\Router::loadView ( "api/html/_template/full/bottom" );