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
			if ($controller[0] == "Controller\Auth") {
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
			return new \Model\Person($_SESSION['person']);
		}
	}
	
	public static function setCurrentPerson(\Model\Person $p) {
		$_SESSION['person'] = $p->id;
	}
	
	public static function addEventListener($signal, $callback) {
		if (!isset(self::$listeners[$signal])) {
			self::$listeners[$signal] = array();
		}
		self::$listeners[$signal][] = $callback;
	}
	
	public static function triggerEvent($signal, $args) {
		if (!isset(self::$listeners[$signal])) {
			return;
		}
		foreach (self::$listeners[$signal] as $callback) {
			call_user_func_array($callback, $args);
		}
	}
	
	public static function triggerFilter($signal, $args) {
		if (!isset(self::$listeners[$signal])) {
			return;
		}
		foreach (self::$listeners[$signal] as $callback) {
			$args = call_user_func_array($callback, $args);
		}
		return $args;
	}
	
}
