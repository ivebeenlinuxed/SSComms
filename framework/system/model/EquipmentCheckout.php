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
namespace System\Model;
	
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
class EquipmentCheckout extends \Model\DBObject {
	
	/**
	* int(11)
	* 
	* @var int $id 
	*/
	public $id;
	
	/**
	* int(11)
	* 
	* @var int $equipment 
	*/
	public $equipment;
	
	/**
	* int(11)
	* 
	* @var int $person 
	*/
	public $person;
	
	/**
	* int(11)
	* 
	* @var int $checkout 
	*/
	public $checkout;
	
	/**
	* int(11)
	* 
	* @var int $checkin 
	*/
	public $checkin;
	
	/**
	* int(11)
	* 
	* @var int $in_actor 
	*/
	public $in_actor;
	
	/**
	* int(11)
	* 
	* @var int $out_actor 
	*/
	public $out_actor;	
	/**
	 * Lists all the columns in the database
	 *
	 * @return array
	 */
	public static function getDBColumns() {
		return array("id","equipment","person","checkout","checkin","in_actor","out_actor");
	}
	
	/**
	 * Gets the table name (always returns "equipment_checkout")
	 * 
	 * @param boolean $read changes the table name if a database view is provided for reading, rather than a table
	 * 
	 * @return string
	 */
	public static function getTable($read=true) {
		return "equipment_checkout";
	}
	
	/**
	 * Gets the primary key
	 * 
	 * @return array
	 */
	public static function getPrimaryKey() {
		return array("id");
	}
	
	/**
	 * Gets the field the key references
	 * 
	 * @return array
	 */
	public static function getForeignKeys() {
		$keys = array();

		$std = new \stdClass();
		$std->table = "equipment";
		$std->field = "id";
		
		$keys['equipment'] = $std;	
		$std = new \stdClass();
		$std->table = "person";
		$std->field = "id";
		
		$keys['person'] = $std;	
		$std = new \stdClass();
		$std->table = "person";
		$std->field = "id";
		
		$keys['in_actor'] = $std;	
		$std = new \stdClass();
		$std->table = "person";
		$std->field = "id";
		
		$keys['out_actor'] = $std;	
		return $keys;
	}
		
	/**
	 * Gets all Equipment associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getEquipment() {
		return \Model\Equipment::Fetch($this->equipment);
	}			
		
	/**
	 * Gets all objects relating to Equipment
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByEquipment(Equipment $class) {
		$c = get_called_class();
		return $c::getByAttribute("equipment", $class->id);
	}
		
	/**
	 * Gets all Person associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getPerson() {
		return \Model\Person::Fetch($this->person);
	}			
		
	/**
	 * Gets all objects relating to Person
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByPerson(Person $class) {
		$c = get_called_class();
		return $c::getByAttribute("person", $class->id);
	}
		
	/**
	 * Gets all Person associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getInActor() {
		return \Model\Person::Fetch($this->in_actor);
	}			
		
	/**
	 * Gets all objects relating to Person
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByInActor(Person $class) {
		$c = get_called_class();
		return $c::getByAttribute("in_actor", $class->id);
	}
		
	/**
	 * Gets all Person associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getOutActor() {
		return \Model\Person::Fetch($this->out_actor);
	}			
		
	/**
	 * Gets all objects relating to Person
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByOutActor(Person $class) {
		$c = get_called_class();
		return $c::getByAttribute("out_actor", $class->id);
	}		
		
	public function getBy() {
		return self::getByAttributes(array());
	}
	
	public function bubbleUpdateResult($update_result, $loop_control=array()) {
		if (in_array(get_class(), $loop_control)) {
			return;
		}
		$loop_control[] = get_class();
		$update_result->module = get_class();
		$c = get_class();
		$update_result->module_table = $c::getTable();
		if (\System\Library\StdLib::parent_method_exists($this, "bubbleUpdateResult", __CLASS__)) {
			parent::bubbleUpdateResult($update_result, $loop_control);	
		}
		\Library\RTCQueue::Send("/model/".self::getTable()."/{$this->id}", $update_result);
		return;
		$obj = $this->getEquipment();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}

		$obj = $this->getPerson();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}

		$obj = $this->getInActor();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}

		$obj = $this->getOutActor();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}
	}
}