<?php
namespace Library\Live;

class Plugin {
	public static function GetAll() {
		return array(
				"\\Controller\\Widget\\LiveHelper\\Duty_Role",
				"\\Controller\\Widget\\LiveHelper\\Asset_Change",
				
		);
	}
}