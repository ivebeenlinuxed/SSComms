<?php
/**
 * Autogenerated model for \Model\VenueCheckResponse
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
 * Autogenerated model for \Model\VenueCheckResponse
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
class VenueCheckResponse extends \Model\DBObject {
	
	/**
	* int(11)
	* 
	* @var int $id 
	*/
	public $id;
	
	/**
	* int(11)
	* 
	* @var int $venue_check 
	*/
	public $venue_check;
	
	/**
	* int(11)
	* 
	* @var int $venue_check_question 
	*/
	public $venue_check_question;
	
	/**
	* int(11)
	* 
	* @var int $response 
	*/
	public $response;	
	/**
	 * Lists all the columns in the database
	 *
	 * @return array
	 */
	public static function getDBColumns() {
		return array("id","venue_check","venue_check_question","response");
	}
	
	/**
	 * Gets the table name (always returns "venue_check_response")
	 * 
	 * @param boolean $read changes the table name if a database view is provided for reading, rather than a table
	 * 
	 * @return string
	 */
	public static function getTable($read=true) {
		return "venue_check_response";
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
		$std->table = "venue_check_question";
		$std->field = "id";
		
		$keys[venue_check_question] = $std;	
		$std = new \stdClass();
		$std->table = "venue_check";
		$std->field = "id";
		
		$keys[venue_check] = $std;	
		return $keys;
	}
		
	/**
	 * Gets all VenueCheckQuestion associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getVenueCheckQuestion() {
		return \Model\VenueCheckQuestion::Fetch($this->venue_check_question);
	}			
		
	/**
	 * Gets all objects relating to VenueCheckQuestion
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByVenueCheckQuestion(VenueCheckQuestion $class) {
		$c = get_called_class();
		return $c::getByAttribute("venue_check_question", $class->id);
	}
		
	/**
	 * Gets all VenueCheck associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getVenueCheck() {
		return \Model\VenueCheck::Fetch($this->venue_check);
	}			
		
	/**
	 * Gets all objects relating to VenueCheck
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByVenueCheck(VenueCheck $class) {
		$c = get_called_class();
		return $c::getByAttribute("venue_check", $class->id);
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
		$obj = $this->getVenueCheckQuestion();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}

		$obj = $this->getVenueCheck();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}
	}
}