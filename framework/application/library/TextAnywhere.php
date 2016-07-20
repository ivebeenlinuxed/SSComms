<?php
namespace Library;

class TextAnywhere {
	private $client_id;
	private $client_pass;
	
	public $billing_ref = "COMMS_EXT";
	public $client_ref = "COMMS_EXT";
	
	public $originator = "Soul Survivor Comms";
	
	public $message = "";
	
	public $destinations = array();
	
	public function __construct() {
		$this->client_id = \Core\Router::$settings['sms']['client_id'];
		$this->client_pass = \Core\Router::$settings['sms']['client_pass'];
	}
	
	public function addDestination($num) {
		$this->destinations[] = $num;
	}
	
	public function Send() {
		if ($this->message == "") {
			throw new \Exception("Text message is blank");
		}
		
		if (count($this->destinations) == 0) {
			throw new \Exception("No destinations selected");
		}
		
		$dest = array();
		 foreach ($this->destinations as $destination) {
		 	mail($destination."@sms.textapp.net", "", $this->message, "From: soulsurvivorcomms@gmail.com");
		 }
		 return true;
	}
}
