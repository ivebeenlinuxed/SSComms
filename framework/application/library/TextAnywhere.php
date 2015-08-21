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
		 $sc = new \SoapClient('http://www.textapp.net/webservice/service.asmx?wsdl');
		 $params = new \stdClass();
		 $params->returnCSVString = false;
		 $params->externalLogin = 'mylogin';
		 $params->password = 'mypassword';
		 $params->clientBillingReference = $this->billing_ref;
		 $params->clientMessageReference = $this->client_ref;
		 $params->originator = $this->originator;
		 $dest = array();
		 foreach ($this->destinations as $destination) {
		 	if (substr($destination, 0, 1) == "0") {
		 		$dest[] = "+44".substr($destination, 1);
		 	} else {
		 		$dest[] = $destination;
		 	}
		 	$params->destinations = implode(", ", $dest);
		 }
		 if (preg_match("/[@£$¥èéùìòÇ\fØø\nÅåΔ_ΦΓΛΩΠΨΣΘΞÆæßÉ !\"#¤%&'()*+,-.\/[0-9]:;<=>\?¡[A-Z]ÄÖÑÜ§¿[a-z]äöñüà\^\{\}\[~\]\|€]+/", $this->body)) {
		 	$params->body = $this->message;
		 	 $params->characterSetID = 1;
		 } else {
		 	$params->body = utf8_encode($this->message);
		 	 $params->characterSetID = 2;
		 }
		 
		 $params->validity = 72;
		 $params->replyMethodID = 1;
		 $params->replyData = '';
		 $params->statusNotificationUrl = '';
		 $result = $sc->__call('SendSMS', array($params));
		 return $result;
	}
}
