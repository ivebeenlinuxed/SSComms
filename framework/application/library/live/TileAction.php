<?php
namespace Library\Live;

class TileAction {
	const DISPOSITION_LINK = 0;
	const DISPOSITION_MODAL = 1;
	
	public $label = "Unlabeled";
	public $action = "";
	public $action_disposition = self::DISPOSITION_LINK;
}