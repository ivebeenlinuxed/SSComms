<?php
/**
 * Autogenerated model for \Model\Event
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
 * Autogenerated model for \Model\Event
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
class Event extends \System\Model\Event {
	const STATUS_ASPLANNED = 0;
	const STATUS_CANCELLED = 1;
	const STATUS_MOVED = 2;
	const STATUS_REPEATED = 3;
	const STATUS_AMENDMENT = 4;
	
	
	public function getStatus() {
		switch ($this->status) {
			case 0:
				return "As Planned";
			case 1:
				return "Cancelled";
			case 2:
				return "Moved";
			case 3:
				return "Repeated";
			case 4:
				return "Amendment";
			default:
				return "Unknown";
		}
	}
}