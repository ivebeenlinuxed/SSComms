<?php
/**
 * 
 * @author ivebeenlinuxed <will@bcslichfield.com>
 *
 */
namespace Core;

use Model\User;

class Router extends \System\Core\Router {
	
	protected static $listeners;
	
	public static function getController($array) {
		session_start();
		$controller = parent::getController($array);
		if (self::getCurrentPerson() != null) {
			return $controller;
		} else {
			if ($controller[0] == "Controller\Auth" || $controller[0] == "Controller\Public_Roaming") {
				return $controller;
			} else {
				return array("Controller\Auth", "login", array());
			}
		}
	}
	
	public static function getCurrentPerson() {
		if (!isset($_SESSION['person'])) {
			return null;
		} else {
			$p = new \Model\Person($_SESSION['person']);
			if ($p->isActive()) {
				return $p;
			} else {
				null;
			}
		}
	}
	
	public static function setCurrentPerson(\Model\Person $p) {
		$_SESSION['person'] = $p->id;
	}
	
	
	
}
