<?php
namespace Controller\Admin;

class Tag {
	public function index() {
		\Core\Router::loadView("admin/tag/index");
		
	}
}