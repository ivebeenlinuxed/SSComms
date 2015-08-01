<?php $venue_check = $data; ?>
<h1>Venue Check #<?php echo $venue_check->id ?> <small><?php echo $venue_check->getVenue()->getName() ?></small>
</h1>
<?php
$responses = $venue_check->getVenueCheckResponses();
foreach ($responses as $response) {
	$question = $response->getVenueCheckQuestion();
?>
<div class="panel panel-default">
  <div class="panel-heading"><?php echo $question->question ?></div>
  <div class="panel-body">
	<label><input type="radio" class="venue" name="question_<?php echo $response->id ?>" value="1" />YES</label>
	&nbsp;&nbsp;
	<label><input type="radio" name="question_<?php echo $response->id ?>" value="0" />NO</label>
	<div class="well">
		<label>Raise a log</label>
		<textarea class="form-control"></textarea>
		<label><input type="checkbox" checked /> Requires Action</label>
	</div>
  </div>
</div>

<strong></strong><br /><br />
<?php
}
?>
