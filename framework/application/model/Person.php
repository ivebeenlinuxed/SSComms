<?php
/**
 * Autogenerated model for \Model\EquipmentCheckout
 * 
 * PHP version 5.4
 *
 * @category Model
 * @package  Boiler
 * @author   Will Tinsdeall <will.tinsdeall@mercianlabels.com>
 * @license  GNU v3.0 http://www.gnu.org/licenses/gpl-3.0.txt
 * @link     http://www.mercianlabels.com
 *
 */
namespace Model;

/**
 * Autogenerated model for \Model\EquipmentCheckout
 * 
 * PHP version 5.4
 *
 * @category Model
 * @package  Boiler
 * @author   Will Tinsdeall <will.tinsdeall@mercianlabels.com>
 * @license  GNU v3.0 http://www.gnu.org/licenses/gpl-3.0.txt
 * @version  GIT: $Id$
 * @link     http://www.mercianlabels.com
 *
 */
class Person extends \System\Model\Person {
	const ROLE_READONLY = 0;
	const ROLE_READWRITE = 1;
	const ROLE_ADMIN = 2;
	const ROLE_SUPERADMIN = 3;
	
	public static function Init() {
		$fp = new \Library\FieldProperties();
		$fp->visibility = \Library\FieldProperties::VISIBILITY_PRIVATE;
		self::$data_map['password'] = $fp;
		self::$data_map['barcode'] = $fp;
		self::$data_map['verify'] = $fp;
		self::$data_map['verify_time'] = $fp;
		
	}
	
	public function canWrite() {
		return $this->role > self::ROLE_READONLY;
	}
	
	public function isAdmin() {
		return $this->role > self::ROLE_READWRITE;
	}
	
	public function isSuperAdmin() {
		return $this->role > self::ROLE_ADMIN;
	}
	
	public function getName() {
		return $this->first_name." ".$this->last_name;
	}
	
	public static function getActivationRequests() {
		array();
	}
	
	public function isActive() {
		return $this->active==1;
	}
	
	public function Verify($code) {
		if ($this->verify_time > time()-60 && $this->verify == $code) {
			$this->setAttribute("active", 1);
			return true;
		}
		return false;
	}
	
	public function isPhoneValid() {
		$num = trim($this->phone_number);
		$num = str_replace("(", "", $num);
		$num = str_replace(")", "", $num);
		$num = str_replace(" ", "", $num);
		if (strlen($num) == 11 && substr($num, 0, 1) == "0") {
			return true;
		}
		if (substr($num, 0, 1) == "+") {
			return true;
		}
	}
	
	public function getFormattedPhone() {
		$num = trim($this->phone_number);
		$num = str_replace("(", "", $num);
		$num = str_replace(")", "", $num);
		$num = str_replace(" ", "", $num);
		if (substr($num, 0, 1) == "0") {
			return "+44".substr($num, 1);
		} elseif (substr($num, 0, 1) == "+") {
			return $num;
		} else {
			return null;
		}
		
	}
}
Person::Init();
