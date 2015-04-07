<?php
namespace Controller;

class Auth {
	const STATUS_USER_UNKNOWN=0;
	const STATUS_USER_NOT_ACTIVE=1;
	const STATUS_USER_UNAUTHENTICATED=2;
	const STATUS_USER_AUTHENTICATED=3;
	
	const VERIFY_TIMEOUT = 30;
	
	public function login() {
		\Core\Router::loadView("auth/device");
	}
	
	public function request_activation() {
		$output = array("successful"=>false, "messages"=>array());
		if (strlen($_POST['device_name']) < 5) {
			$output['messages'][] = "Device name not long enough";
		}
		
		if (strlen($_POST['fingerprint']) < 5) {
			$output['messages'][] = "Fingerprint not valid";
		}
		json_encode($output);
	}
	
	public function logout() {
		session_destroy();
		header("Location: /");
	}
	
	public function active_check() {
		if (!isset($_POST['phone']) || !isset($_POST['password'])) {
			echo json_encode(false);
			return;
		}
		
		$user = \Model\Person::getByAttribute("phone_number", $_POST['phone']);
		if (count($user) == 0) {
			echo json_encode(false);
			return;
		}
		
		if ($user[0]->active && password_verify($_POST['password'], $user[0]->password)) {
			echo json_encode(true);
			return;
		}
		
		echo json_encode(false);
	}
	
	public function check_status() {
		$output = array("status"=>self::STATUS_USER_UNKNOWN);
		
		$person = \Core\Router::getCurrentPerson();
		if ($person != null) {
			$output['status'] = self::STATUS_USER_AUTHENTICATED;
			echo json_encode($output);
		}
		
		if (!isset($_POST['phone']) || !isset($_POST['password'])) {
			$output['status'] = self::STATUS_USER_UNKNOWN;
			echo json_encode($output);
			return;
		}
		
		$user = \Model\Person::getByAttribute("phone_number", $_POST['phone']);
		if (count($user) > 0) {
			$user = $user[0];
		} else {
			$output['status'] = self::STATUS_USER_UNKNOWN;
			echo json_encode($output);
			return;
		}
		
		if ($user->active != 1) {
			$output['status'] = self::STATUS_USER_NOT_ACTIVE;
			$user->setAttribute("verify", rand(1000, 9999));
			$user->setAttribute("verify_time", time());
			$output['code'] = $user->verify;
			$user->setAttribute("password", password_hash($_POST['password'], PASSWORD_DEFAULT));
			echo json_encode($output);
			return;
		}
		
		
		if (password_verify($_POST['password'], $user->password)) {
			\Core\Router::setCurrentPerson($user);
			$output['status'] = self::STATUS_USER_AUTHENTICATED;
			echo json_encode($output);
			return;
		}

		$output['status'] = self::STATUS_USER_UNAUTHENTICATED;
		echo json_encode($output);
		return;
		
		
	}
}