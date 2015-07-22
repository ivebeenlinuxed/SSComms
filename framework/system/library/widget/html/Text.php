<?php
namespace System\Library\Widget\Html;

class Text extends \Library\Widget\Widget {
	public $result = "";
	public function Render() {
		if ($this->edit_mode) {
			echo "<input is='text-widget' class='form-control' value=\"".htmlentities($this->result)."\" {$this->getDataFields()} />";
		} else {
			echo "<span {$this->getDataFields()} data-disabled='1'>".htmlentities($this->result)."</span>";
		}
	}
	
	public function setResult($result) {
		$this->result = $result;
	}
	
	public static function getLoaderView() {
		\Core\Router::loadView("widget/loader/text");
	}
	
}
