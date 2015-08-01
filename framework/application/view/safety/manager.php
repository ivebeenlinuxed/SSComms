<?php
\Core\Router::loadView("api/html/_template/" . \Core\Router::$disposition . "/top");
?>
<h1 class="text-center">Safety Check Manager</h1>
<form method="post" action="/safety/manager">
	<table class="table table-striped table-bordered">
	<tr>
		<th></th>
		<?php
		$venues = \Model\Venue::getAll();
		foreach ($venues as $venue) {
		?>
		<th><?php echo $venue->getName() ?></th>
		<?php
		}
		?>
	</tr>
	<?php
	$questions = \Model\VenueCheckQuestion::getAll();
	foreach ($questions as $question) {
	?>
	<tr>
		<th><?php echo $question->question ?></th>
		<?php
		foreach ($venues as $venue) {
			$q = \Model\VenueCheckSelectedQuestion::Get($venue, $question);
		?>
		<td><input type="checkbox" name="question_<?php echo $question->id ?>_<?php echo $venue->id ?>" <?php echo $q==null? "" : "checked" ?> /></td>
		<?php
		}
		?>
	</tr>
	<?php
	}
	?>
	<tr>
		<th><input type="text" name="new_question" class="form-control" /></th>
		<?php
		foreach ($venues as $id=>$venue) {
			?>
			<td><input type="checkbox" name="question_0_<?php echo $venue->id ?>" /></td>
			<?php
		}
		?>
	</tr>
	</table>
	<input type="submit" value="Save" class="btn btn-success" />
</form>
<?php

?>
<?php
\Core\Router::loadView("api/html/_template/" . \Core\Router::$disposition . "/bottom");
?>
