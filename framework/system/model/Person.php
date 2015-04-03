<?php
/**
 * Autogenerated model for \Model\Person
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
 * Autogenerated model for \Model\Person
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
class Person extends \Model\DBObject {
	
	/**
	* int(11)
	* 
	* @var int $id 
	*/
	public $id;
	
	/**
	* int(11)
	* 
	* @var int $first_name 
	*/
	public $first_name;
	
	/**
	* int(11)
	* 
	* @var int $last_name 
	*/
	public $last_name;
	
	/**
	* int(11)
	* 
	* @var int $phone_number 
	*/
	public $phone_number;
	
	/**
	* int(11)
	* 
	* @var int $team 
	*/
	public $team;
	
	/**
	* int(11)
	* 
	* @var int $barcode 
	*/
	public $barcode;	
	/**
	 * Lists all the columns in the database
	 *
	 * @return array
	 */
	public static function getDBColumns() {
		return array("id","first_name","last_name","phone_number","team","barcode");
	}
	
	/**
	 * Gets the table name (always returns "person")
	 * 
	 * @param boolean $read changes the table name if a database view is provided for reading, rather than a table
	 * 
	 * @return string
	 */
	public static function getTable($read=true) {
		return "person";
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
		$std->table = "team";
		$std->field = "id";
		
		$keys[team] = $std;	
		return $keys;
	}
		
	/**
	 * Gets all Team associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getTeam() {
		return \Model\Team::Fetch($this->team);
	}			
		
	/**
	 * Gets all objects relating to Team
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByTeam(Team $class) {
		$c = get_called_class();
		return $c::getByAttribute("team", $class->id);
	}

	/**
	 * Gets all EquipmentCheckouts relating to this model by the field person
	 * 
	 * @return array
	 */	
	public function getEquipmentCheckouts() {
		return \Model\EquipmentCheckout::getByPerson($this);
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
		$obj = $this->getTeam();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}
	}
}