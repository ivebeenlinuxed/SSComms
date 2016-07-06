<?php
/**
 * Autogenerated model for \Model\VenueMeeting
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
 * Autogenerated model for \Model\VenueMeeting
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
class VenueMeeting extends \Model\DBObject {
	
	/**
	* int(11)
	* 
	* @var int $id 
	*/
	public $id;
	
	/**
	* int(11)
	* 
	* @var int $venue 
	*/
	public $venue;
	
	/**
	* int(11)
	* 
	* @var int $start_time 
	*/
	public $start_time;
	
	/**
	* int(11)
	* 
	* @var int $end_time 
	*/
	public $end_time;
	
	/**
	* int(11)
	* 
	* @var int $status 
	*/
	public $status;
	
	/**
	* int(11)
	* 
	* @var int $relation 
	*/
	public $relation;
	
	/**
	* varchar(255)
	* 
	* @var string $title 
	*/
	public $title;
	
	/**
	* text
	* 
	* @var unknown_type $description 
	*/
	public $description;	
	/**
	 * Lists all the columns in the database
	 *
	 * @return array
	 */
	public static function getDBColumns() {
		return array("id","venue","start_time","end_time","status","relation","title","description");
	}
	
	/**
	 * Gets the table name (always returns "venue_meeting")
	 * 
	 * @param boolean $read changes the table name if a database view is provided for reading, rather than a table
	 * 
	 * @return string
	 */
	public static function getTable($read=true) {
		return "venue_meeting";
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

		return $keys;
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
		return;	}
}