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
		include BOILER_LOCATION."../vendor/autoload.php";
		$mailer = new \PHPMailer();
		$mailer->isSMTP();
		$mailer->SMTPAuth   = true;                  // enable SMTP authentication
		$mailer->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mailer->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mailer->Port       = 587;                   // set the SMTP port for the GMAIL server
		$mailer->Username   = \Core\Router::$settings['email']['username'];  // GMAIL username
		$mailer->Password   = \Core\Router::$settings['email']['password'];            // GMAIL password
		$mailer->SetFrom(\Core\Router::$settings['email']['username']);
		$mailer->Subject = "";
		$mailer->Body = $this->message;
		
		foreach ($this->destinations as $destination) {
		 	$mailer->addAddress($destination."@sms.textapp.net");
		 }
		 $mailer->send();
		 return true;
	}
}
