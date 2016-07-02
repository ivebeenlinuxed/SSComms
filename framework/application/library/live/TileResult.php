<?php
namespace Library\Live;

class TileResult {
	public $live_updates = array();
	public $current_information = array();
	public $outstanding_jobs = array();
	
	public function Merge(TileResult $result) {
		$this->live_updates = array_merge($this->live_updates, $result->live_updates);
		$this->current_information = array_merge($this->current_information, $result->current_information);
		$this->outstanding_jobs = array_merge($this->outstanding_jobs, $result->outstanding_jobs);
	}
}