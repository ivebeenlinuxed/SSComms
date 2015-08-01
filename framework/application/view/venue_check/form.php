<?php
\Core\Router::loadView("api/html/_template/" . \Core\Router::$disposition . "/top");
?>
<div id="check_alert"></div>
<div id="check_form">
	<h1>Venue Check for {venue name}</h1>
	<dl>
		<dt>Checked Out</dt>
		<dd>{checkout date}</dd>
		<dt>Expiry Date</dt>
		<dd>{expiry date}</dd>
	</dl>
	<div id="response_container"></div>
</div>
<template id="response_templ">
<div class="panel panel-default">
  <div class="panel-heading">{question_text}</div>
  <div class="panel-body">
	<label><input type="radio" class="venue" name="response_{response_no}" value="1" />YES</label>
	&nbsp;&nbsp;
	<label><input type="radio" name="response_{response_no}" value="0" />NO</label>
	<div class="well hidden" id="response_{response_no}_logger">
		<label>Raise a log</label>
		<textarea class="form-control"></textarea>
		<label><input type="checkbox" checked /> Requires Action</label>
	</div>
  </div>
</div>
</template>
<script type="text/javascript">
var check_data = null;
$(document).ready(function() {
	var check_id = window.location.hash.substr(1);
	var storage = JSON.parse(localStorage['venue_checks']);
	for (i=0; i<storage.length; i++) {
		if (storage[i].check.id == check_id) {
			check_data = storage[i];
			break;
		}
	}
	if (check_data == null) {
		$("#check_form").addClass("hidden");
		$("#check_alert").addClass("alert").addClass("alert-danger");
		$("#check_alert").html("<strong>Sorry!</strong> We couldn't find the data to start this check."
			+" Has it been completed, or not yet synced?");
	}
});
</script>
<?php
\Core\Router::loadView("api/html/_template/" . \Core\Router::$disposition . "/bottom");
?>
