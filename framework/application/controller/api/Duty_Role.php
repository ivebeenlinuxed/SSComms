<?php
/**
 * API Generation for the framework
 * 
 * PHP version 5.4
 * 
 * @category  API
 * @package   Boiler
 * @author    Will Tinsdeall <will.tinsdeall@mercianlabels.com>
 * @copyright 2013 Mercian Labels
 * @license   http://www.mercianlabels.com All Rights Reserved
 * @link      http://www.mercianlabels.com
 */
namespace Controller\Api;

/**
 * Autogenerated stub for API access to the model \Model\Duty_Role
 * 
 * PHP version 5.4
 *
 * @category API
 * @package  Boiler
 * @author   ivebeenlinuxed <will.tinsdeall@mercianlabels.com>
 * @license  All Rights Reserved
 * @version  GIT: $Id$
 * @link     http://www.mercianlabels.com
 *
 */
class Duty_Role extends \System\Controller\Api\Duty_Role {
	public function Add() {
		\Core\Router::loadView("api/html/duty_role/special/add");
	}
	
	public function Assign($id) {
		\Core\Router::loadView("api/html/duty_role/special/assign", array("role"=>new \Model\DutyRole($id)));
	}
	
	public function Reassign() {
		(new \Model\DutyRole($_POST['duty_role']))->Reassign(new \Model\Person($_POST['user']));
	}
}