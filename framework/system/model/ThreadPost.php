<?php
/**
 * Autogenerated model for \Model\ThreadPost
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
 * Autogenerated model for \Model\ThreadPost
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
class ThreadPost extends \Model\DBObject {
	
	/**
	* int(11)
	* 
	* @var int $id 
	*/
	public $id;
	
	/**
	* int(11)
	* 
	* @var int $thread 
	*/
	public $thread;
	
	/**
	* int(11)
	* 
	* @var int $person 
	*/
	public $person;
	
	/**
	* int(11)
	* 
	* @var int $reply 
	*/
	public $reply;
	
	/**
	* text
	* 
	* @var unknown_type $message 
	*/
	public $message;
	
	/**
	* varchar(255)
	* 
	* @var string $title 
	*/
	public $title;
	
	/**
	* int(11)
	* 
	* @var int $date 
	*/
	public $date;	
	/**
	 * Lists all the columns in the database
	 *
	 * @return array
	 */
	public static function getDBColumns() {
		return array("id","thread","person","reply","message","title","date");
	}
	
	/**
	 * Gets the table name (always returns "thread_post")
	 * 
	 * @param boolean $read changes the table name if a database view is provided for reading, rather than a table
	 * 
	 * @return string
	 */
	public static function getTable($read=true) {
		return "thread_post";
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
		
		$keys['person'] = $std;	
		$std = new \stdClass();
		$std->table = "thread_post";
		$std->field = "id";
		
		$keys['reply'] = $std;	
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
	 * Gets all ThreadPost associated with this object
	 * 
	 * @return System\Model$className
	 */
	public function getReply() {
		return \Model\ThreadPost::Fetch($this->reply);
	}			
		
	/**
	 * Gets all objects relating to ThreadPost
	 * 
	 * @param $class \Model$className Get objects relating to this class
	 * 
	 * @return array
	 */		
	public static function getByReply(ThreadPost $class) {
		$c = get_called_class();
		return $c::getByAttribute("reply", $class->id);
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

	/**
	 * Gets all ThreadPosts relating to this model by the field reply
	 * 
	 * @return array
	 */	
	public function getThreadPosts() {
		return \Model\ThreadPost::getByReply($this);
	}
	

	/**
	 * Gets all ThreadPostStars relating to this model by the field thread_post
	 * 
	 * @return array
	 */	
	public function getThreadPostStars() {
		return \Model\ThreadPostStar::getByThreadPost($this);
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
		$obj = $this->getPerson();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}

		$obj = $this->getReply();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}

		$obj = $this->getThread();
		if ($obj) {
			$obj->bubbleUpdateResult($update_result, $loop_control);
		}
	}
}