<?php
\Core\Router::loadView ( "api/html/_template/full/top" );
?>
<div class="container-fluid" id="live-view">
	<div class="btn-toolbar" role="toolbar" aria-label="...">
		<div class="btn-group" role="group" aria-label="...">
			<a class="btn btn-default" href="/widget/livehelper/asset_change/change_asset" data-type="api-modal">Check Out Assets</a>
			<a data-type="api-modal" href="/widget/livehelper/asset_change/in" class="btn btn-default">Check
				In Assets</a>
		</div>
		<div class="btn-group" role="group" aria-label="...">
			<a data-type="api-modal" href="/widget/livehelper/duty_role/assign_person" class="btn btn-default">Assign Duty</a>
			<a data-type="api-modal" href="/widget/livehelper/duty_role/retire_role" class="btn btn-default">Retire
				Duty</a>
		</div>
		<div class="btn-group" role="group" aria-label="...">
			<a data-type="api-modal" href="/widget/livehelper/task/open_task"
				class="btn btn-default">Open Task/Incident</a>
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
			<div class="clearfix"></div>
			<div class="action-btns btn-group pull-right">
				
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	</template>

	<div class="row">
		<div class="col-xs-4">
			<h3>Live Updates</h3>
			<div class="well live-update-list">
				
			</div>
		</div>
		<div class="col-xs-4">
			<h3>Current Information</h3>
			<div class="well current-information-list">
				
			</div>
		</div>
		<div class="col-xs-4">
			<h3>Outstanding Jobs</h3>
			<div class="well outstanding-job-list">
			</div>
		</div>
	</div>
</div>
<?php
\Core\Router::loadView ( "api/html/_template/full/bottom" );