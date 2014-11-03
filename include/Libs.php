<?php
/**
* 
*/
class Libs extends medoo
{

	function login_user() {
		$json = array('error' => false,
					  'msg' => "Login successful");
		
		if (!isset($_POST['email']) || !$this->isEmail($_POST['email'])) {
			$json['error'] = true;
			$json['msg'] = "E-mail no válido";
		}

		if (!isset($_POST['password']) || empty($_POST['password'])) {
			$json['error'] = true;
			$json['msg'] = "Password no válido";
		}

		if (!$json['error']) {
			
		}

		return $json;

	}
}

if (isset($_REQUEST["accion"])) {
	switch ($_REQUEST["accion"]) {
		case 'login':
			# code...
			break;
		case 'signup':

			break;
		default:
			# code...
			break;
	}
}else {
	die("Acción no definida");
}

?>