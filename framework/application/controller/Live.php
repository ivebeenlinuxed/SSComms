<?php
namespace Controller;

class Live {
	public function index() {
		\Core\Router::loadView("live/index");
	}
}