<?php
/**
 * Autogenerated model for \Model\Task
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
 * Autogenerated model for \Model\Task
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
class Task extends \Model\DBObject {
	
	/**
	* int(11)
	* 
	* @var int $id 
	*/
	public $id;
	
	/**
	* varchar(255)
	* 
	* @var string $summary 
	*/
	public $summary;
	
	/**
	* int(11)
	* 
	* @var int $opened_actor 
	*/
	public $opened_actor;
	
	/**
	* int(11)
	* 
	* @var int $opened_time 
	*/
	public $opened_time;
	
	/**
	* int(11)
	* 
	* @var int $category 
	*/
	public $category;
	
	/**
	* int(11)
	* 
	* @var int $closed_time 
	*/
	public $closed_time;
	
	/**
	* int(11)
	* 
	* @var int $closed_actor 
	*/
	public $closed_actor;
	
	/**
	* int(11)
	* 
	* @var int $thread 
	*/
	public $thread;	
	/**
	 * Lists all the columns in the database
	 *
	 * @return array
	 */
	public static function getDBColumns() {
		return array("id","summary","opened_actor","opened_time","category","closed_time","closed_actor","thread");
	}
	
	/**
	 * Gets the table name (always returns "task")
	 * 
	 * @param boolean $read changes the table name if a database view is provided for reading, rather than a table
	 * 
	 * @return string
	 */
	public static function getTable($read=true) {
		return "task";
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
		$std->table = "person";
		$std->field = "id";
		
		$keys['opened_actor'] = $std;	
		$std = new \stdClass();
		$std->table = "task_category";
		$std->field = "id";
		
		$keys['category'] = $std;	
		$std = new \stdClass();
		$std->table = "person";
		$std->field = "id";
		
		$keys['closed_actor'] = $std;	
		$std = new \stdClass();
		$std->table = "thread";
		$std->field = "id";
		
		$keys['thread'] = $std;	
		return $keys;
	}
		
	/**
	 * Gets all Person associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getOpenedActor() {
		return \Model\Person::Fetch($this->opened_actor);
	}			
		
	/**
	 * Gets all objects relating to Person
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByOpenedActor(Person $class) {
		$c = get_called_class();
		return $c::getByAttribute("opened_actor", $class->id);
	}
		
	/**
	 * Gets all TaskCategory associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getCategory() {
		return \Model\TaskCategory::Fetch($this->category);
	}			
		
	/**
	 * Gets all objects relating to TaskCategory
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByCategory(TaskCategory $class) {
		$c = get_called_class();
		return $c::getByAttribute("category", $class->id);
	}
		
	/**
	 * Gets all Person associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getClosedActor() {
		return \Model\Person::Fetch($this->closed_actor);
	}			
		
	/**
	 * Gets all objects relating to Person
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByClosedActor(Person $class) {
		$c = get_called_class();
		return $c::getByAttribute("closed_actor", $class->id);
	}
		
	/**
	 * Gets all Thread associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getThread() {
		return \Model\Thread::Fetch($this->thread);
	}			
		
	/**
	 * Gets all objects relating to Thread
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByThread(Thread $class) {
		$c = get_called_class();
		return $c::getByAttribute("thread", $class->id);
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
		$obj = $this->getOpenedActor();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}

		$obj = $this->getCategory();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}

		$obj = $this->getClosedActor();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}

		$obj = $this->getThread();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}
	}
}