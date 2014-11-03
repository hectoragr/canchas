<?php
/**
* 
*/
session_start();
include_once("medoo.min.php");
class Libs
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
			$db = new medoo();

			$usuario = $db->get("usuario", 
								   ["nombres", "id", "correo", "apellidos"], 
								   ["AND" =>  
								   		["correo" => $_POST["email"], 
								   		 "password" => sha1($_POST["password"])
								   		]
								   	]);
			//$usuario = $usuario[0];
			if (!empty($usuario['id'])) {
				$json['data'] = $usuario;
				$_SESSION['user'] = $usuario;
			}else {
				$json['error'] = true;
				$json['msg'] = "Usuario y/o contraseña no válidos";
			}
		}

		return $json;

	}

	function sign_up() {
		$json = array('error' => false,
					  'msg' => "Verifica tu correo para validar tu cuenta");
		
		if (!isset($_POST['email']) || !$this->isEmail($_POST['email'])) {
			$json['error'] = true;
			$json['msg'] = "E-mail no válido";
		}

		if (!isset($_POST['password']) || !isset($_POST['rpassword']) || empty($_POST['password']) || $_POST['password'] != $_POST['rpassword']) {
			$json['error'] = true;
			$json['msg'] = "Contraseña no coincide";
		}

		if (!isset($_POST['name']) || empty($_POST['name'])){
			$json['error'] = true;
			$json['msg'] = "Nombre(s) no válido(s)";
		}

		if (!isset($_POST['lastname']) || empty($_POST['lastname'])){
			$json['error'] = true;
			$json['msg'] = "Apellido(s) no válido(s)";
		}

		if (!isset($_POST['phone']) || empty($_POST['phone'])){
			$json['error'] = true;
			$json['msg'] = "Teléfono no válido";
		}

		if (!$json['error']) {
			$db = new medoo();
 
			$last_user_id = $db->insert("usuario", [
				"nombres" => $_POST['name'],
				"apellidos" => $_POST['lastname'],
				"correo" => $_POST['email'],
				"telefono" => $_POST['phone'],
				"emergencia" => $_POST['phone'],
				"password" => sha1($_POST['password'])
			]);
			//$usuario = $usuario[0];
			if (is_numeric($last_user_id)) {
				$url = "";
			}else {
				$json['error'] = true;
				$json['msg'] = "Usuario y/o contraseña no válidos";
			}
		}

		return $json;
	}

	function get_user() {
		if (!isset($_SESSION['user'])) {
			die("error");
		}else {
			$db = new medoo();

			$usuario = $db->get("usuario", 
								   ["nombres", "id", "correo", "apellidos", "emergencia", "telefono"], 
								   ["id" =>  $_SESSION['user']['id']
								   	]);
			if (!empty($usuario['id'])) {
				$json = $usuario;
				$_SESSION['user'] = $usuario;
			}else {
				$json['error'] = true;
				$json['msg'] = "Usuario y/o contraseña no válidos";
			}
		}
		return $json;

	}


	function isEmail($email){
		return (!preg_match("/^[a-z]([\w\.]*)@[a-z]([\w\.-]*)\.[a-z]{2,3}$/", $email)) ? false : true;
	}
}

if (isset($_GET["accion"])) {
	$libs = new Libs();
	switch ($_GET["accion"]) {
		case 'login':
			$json = $libs->login_user();
			break;
		case 'signup':
			$json = $libs->sign_up();
			break;
		case 'getuser':
			$json = $libs->get_user();
			break;
		default:
			$json = array("error" => true, "msg" => "Not found.");
			break;
	}
	echo json_encode($json);
}else {
	die("Acción no definida");
}

?>