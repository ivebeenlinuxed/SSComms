<div class="alert alert-info helper-radiogroup" id="helper-radiogroup-<?php echo ($rand = rand(1, 1000000)) ?>">
<h4>Looks like a radio - and goodies!</h4>
<p>Asset #<?php echo $asset->id ?> is a radio, and there are some other items with this.
You may use this alert to move related assets with this radio</p>
<?php
foreach (array_merge($linked_assets, array($asset)) as $l_asset) {
?>
<p><input type="checkbox" name="asset_<?php echo $l_asset->id ?>" /><?php echo $l_asset->getName() ?></p>
<?php
}
?>

<div class="btn-group">
	<a href="javascript:helper_radio_group(<?php echo $rand ?>, 0, null)" data-ajaxless class="btn btn-success">Check-In</a>
<?php
if ($person) {
?>
	<a href="javascript:helper_radio_group(<?php echo $rand ?>, 1, <?php echo $person->id ?>)" data-ajaxless class="btn btn-success">Switch to <?php echo $person->getName() ?></a>
<?php
}
?>
</div>
</div>
