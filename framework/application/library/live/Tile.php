<?php
namespace Library\Live;

class Tile {
	public $title;
	public $description;
	public $actions;
	public $time;
	
	public function __construct() {
		$this->time = time();
	}
}