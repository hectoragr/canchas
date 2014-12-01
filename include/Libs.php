<?php
/**
* 
*/
session_start();
setlocale(LC_ALL, "es_ES");
include_once("medoo.min.php");
class Libs
{

	function login_user() {
		$json = array('error' => false,
					  'msg' => "Login successful");
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}

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
				$usuario = $db->get("administrador", 
									   ["nombres", "id", "correo", "apellidos"], 
									   ["AND" =>  
									   		["correo" => $_POST["email"], 
									   		 "password" => sha1($_POST["password"])
									   		]
									   	]);
				if (!empty($usuario['id'])) {
					$usuario['admin'] = 1;
					$json['data'] = $usuario;
					$_SESSION['user'] = $usuario;
				}else {
					$json['error'] = true;
					$json['msg'] = "Usuario y/o contraseña no válidos";
				}
			}
		}

		return $json;

	}

	function sign_up() {
		$json = array('error' => false,
					  'msg' => "Verifica tu correo para validar tu cuenta");
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}

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
			if ($_SESSION['user']['admin']) {
				$usuario = $db->get("administrador", 
									   ["nombres", "id", "correo", "apellidos"], 
									   ["AND" =>  
									   		["correo" => $_POST["email"], 
									   		 "password" => sha1($_POST["password"])
									   		]
									   	]);
				$usuario['admin'] = 1;
			}else {
				$usuario = $db->get("usuario", 
									   ["nombres", "id", "correo", "apellidos", "emergencia", "telefono"], 
									   ["id" =>  $_SESSION['user']['id']
									   	]);	
			}
			
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

	function draw_cal($currM, $currY){
	    if(!$currM){ $currM = date("m"); }
	    if(!$currY){ $currY = date("Y"); }

	    $timestamp = mktime(0,0,0,$currM,01,$currY);;
	    
	    $monthName = date("F", $timestamp);
	    $dateFormat = date("Y", $timestamp);    
	    $daysInMonth = date("t", $timestamp);
	    $startDay = date("w", $timestamp);
	        
	    $str .= "
	    <form action='gen/date' method='post' id='caldays'>
	    <table class='responsive'>
	    <tr>
	    	<td colspan='7' class='calTitle'>$monthName $dateFormat</td>
	    	<input type='hidden' name='year' value='$currY'>
	    	<input type='hidden' name='month' value='$currM'>
	    </tr>
	    <theader>
	    <tr>
		    <th class='daysWeek'>Domingo</th>
		    <th class='daysWeek'>Lunes</th>
		    <th class='daysWeek'>Martes</th>
		    <th class='daysWeek'>Miercoles</th>
		    <th class='daysWeek'>Jueves</th>
		    <th class='daysWeek'>Viernes</th>
		    <th class='daysWeek'>Sábado</th>
	    </tr>
	    </theader>
	    <tbody>
	    <tr>
	    ";
	    
	    $x = 1;
	    $z = 0;
	    for ($i = 0; $i < 42; $i++) {
	    
	      if ($z >= $daysInMonth) {
	         $str .= "<td class='daysBlank'></td>";
	      } else {
	    
	         if ($i >= $startDay) {
	            $z++;
	            
	            $class = "days";
	            $info = "$z";
	            
	            if (strlen($z) == 1) {
	               $zy = "0".$z;
	            } else {
	               $zy = $z;
	            }

	            $str .= "<td class='$class'>$z</td> <input type='hidden' name='$z' value='$z'>";
	         } else {
	            $str .= "<td class='daysBlank'></td>";
	         }
	    
	      }
	    
	      if ($x == 7) {
	      
	         if ($z > $daysInMonth) {
	            break;
	         }
	      
	         $str .= "</tr><tr>";
	         $x = 0;
	      }
	      $x++;
	    }
	    
	       
	    
	    $str .= "
	    </tr>
	    </tbody>
	    </table>
	    <div class='row'>
	    	<input type='submit' class='button block primary' value='Generar' id='btnGenDates'>
	    </div>
	    </form>
	    ";
	    $json = array("msg" => $str);
	    return $json;

	}

	function get_arbitros() {
		$json = array();
		$db = new medoo();
		// $usuario = $db->select("arbitro", 
		// 					   ["nombres", "id", "correo", "apellidos"], ["id[>]"=>0]);
		$usuario = $db->select("arbitro", "*");
		$msg = "";
		foreach ($usuario as $user) {
			$nombre = $user['nombres']." ".$user['apellidos'];
			$id = $user['id'];
			$botones = "<a href='editar/arbitro/$id' class='button primary editArb'>
							Editar
						</a>
						<a href='eliminar/arbitro/$id' class='button danger deleteArb' data-furatto='modal' data-target='#modal-1'>
							Eliminar
						</a>";
			$msg .= "<tr>
						<td>$nombre</td>
						<td>
							$botones
						</td>
					</tr>";
		}

		$json['data'] = $msg;
		return $json;
	}

	function get_arbitro() {
		$json = array();
		$db = new medoo();
		$usuario = $db->select("arbitro", 
		 					   ["nombres", "id", "correo", "apellidos", "telefono"], ["id"=>$_REQUEST['id']]);
		$usuario = $usuario[0];
		$json = $usuario;
		return $json;
	}

	function get_equipo() {
		$json = array();
		$db = new medoo();
		$usuario = $db->select("equipo", 
		 					   ["nombre", "id", "capitan"], ["id"=>$_REQUEST['id']]);
		$usuario = $usuario[0];
		$json = $usuario;
		return $json;
	}

	function get_users() {
		$json = array();
		$db = new medoo();
		$usuarios = $db->select("usuario", "*");
		$msg = "<option>Selecciona Capitan</option>";
		foreach ($usuarios as $user) {
			$msg .= "<option value='".$user['id']."'>".$user['nombres']." ".$user['apellidos']."</option>";
		}
		$json['data'] = $msg;

		return $json;
	}

	function get_equipos() {
		$json = array();
		$db = new medoo();
		// $usuario = $db->select("arbitro", 
		// 					   ["nombres", "id", "correo", "apellidos"], ["id[>]"=>0]);
		$equipos = $db->select("equipo", "*");
		$msg = "";
		foreach ($equipos as $equipo) {
			$nombre = $equipo['nombre'];
			$id = $equipo['id'];
			$botones = "<a href='editar/equipo/$id' class='button primary editEqu'>
							Editar
						</a>
						<a href='eliminar/equipo/$id' class='button danger deleteEqu' data-furatto='modal' data-target='#modal-1'>
							Eliminar
						</a>";
			$msg .= "<tr>
						<td>$nombre</td>
						<td>
							$botones
						</td>
					</tr>";
		}

		$json['data'] = $msg;
		return $json;
	}

	function add_equipo() {
		$json = array();
		$json['title'] = "Guardado";
		$json['msg'] = "El equipo ha sido guardado con éxito";
		$json['success'] = true;

		if (!isset($_POST['name']) || empty($_POST['name'])){
			$json['success'] = false;
			$json['msg'] = "Nombre(s) no válido(s)";
		}

		if (!isset($_POST['capitan']) || !is_numeric($_POST['capitan'])){
			$json['success'] = false;
			$json['msg'] = "Cápitan no seleccionado";
		}
	
		if (json['success']) {
			$db = new medoo();

			if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0){
 				$db->update("equipo", 
 							[ "nombre" => $_POST['name'],
							  "capitan" => $_POST['capitan']
							], 
							["id"=>$_POST['id']]);
 			}else {
				$last_user_id = $db->insert("equipo", [
											"nombre" => $_POST['name'],
											"capitan" => $_POST['capitan']
										]);
				//$usuario = $usuario[0];
				if (is_numeric($last_user_id)) {
					$url = "";
				}else {
					$json['error'] = true;
					$json['msg'] = "Usuario y/o contraseña no válidos";
				}
			}
		}

		return $json;

	}

	function add_arbitro() {
		$json = array();
		$json['title'] = "Guardado";
		$json['msg'] = "El arbitro ha sido guardado con éxito";
		$json['success'] = true;
		if (!isset($_POST['correo']) || !$this->isEmail($_POST['correo'])) {
			$json['error'] = true;
			$json['msg'] = "E-mail no válido";
		}

		if (!isset($_POST['name']) || empty($_POST['name'])){
			$json['error'] = true;
			$json['msg'] = "Nombre(s) no válido(s)";
		}

		if (!isset($_POST['lastname']) || empty($_POST['lastname'])){
			$json['error'] = true;
			$json['msg'] = "Apellido(s) no válido(s)";
		}

		if (!isset($_POST['telefono']) || empty($_POST['telefono'])){
			$json['error'] = true;
			$json['msg'] = "Teléfono no válido";
		}

		if (!$json['error']) {
			$db = new medoo();
 			
 			if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0){
 				$db->update("arbitro", 
 							[ "nombres" => $_POST['name'],
							  "apellidos" => $_POST['lastname'],
							  "correo" => $_POST['correo'],
							  "telefono" => $_POST['telefono']
							], 
							["id"=>$_POST['id']]);
 			}else {
 				$last_user_id = $db->insert("arbitro", [
											"nombres" => $_POST['name'],
											"apellidos" => $_POST['lastname'],
											"correo" => $_POST['correo'],
											"telefono" => $_POST['telefono']
										]);
				//$usuario = $usuario[0];
				if (is_numeric($last_user_id)) {
					$url = "";
				}else {
					$json['error'] = true;
					$json['msg'] = "Usuario y/o contraseña no válidos";
				}
 			}
 			$json['success'] = !$json['error'];
		}

		return $json;
	}

	function delete_arbitro() {
		$json = array();
		$json['title'] = "Borrado";
		$json['msg'] = "El arbitro ha sido borrado con éxito";
		$json['success'] = true;

		if (isset($_GET['id']) && is_numeric($_GET['id'])) {
			$db = new medoo();
			$db->delete("arbitro", [
							"id" => $_GET['id']
						]);
		}

		return $json;
	}

	function delete_equipo() {
		$json = array();
		$json['title'] = "Borrado";
		$json['msg'] = "El equipo ha sido borrado con éxito";
		$json['success'] = true;

		if (isset($_GET['id']) && is_numeric($_GET['id'])) {
			$db = new medoo();
			$db->delete("equipo", [
							"id" => $_GET['id']
						]);
		}

		return $json;
	}

	function list_equipos() {
		$json = array();
		$db = new medoo();
		$usuarios = $db->select("equipo", "*");
		$msg = "<option>Selecciona el equipo</option>";
		foreach ($usuarios as $user) {
			$msg .= "<option value='".$user['id']."'>".$user['nombre']."</option>";
		}
		$json['data'] = $msg;
		return $json;
	}

	function equipo_table() {
		$json = array();
		$db = new medoo();
		$ids = array();
		$equipo = $db->get("equipo", ["nombre", "capitan"], ["id"=>$_POST['id']]);
		$json['equipo'] = $equipo['nombre'];
		$capitan = $equipo['capitan'];
		$equipos = $db->select("equipo_usuario", ["usuario"], ["equipo"=>$_POST['id']]);
		$msg = "";
		foreach ($equipos as $equipo) {
			$uid = $equipo['usuario'];
			array_push($ids, $uid);
			$usuario = $db->get("usuario", ["nombres", "apellidos", "correo"], ["id" => $uid]);
			$id = $_POST['id'];
			$botones = "<a href='expulsar/equipo/$id/$uid' class='button danger expulsarUsuario' data-furatto='modal' data-target='#modal-1'>
							Expulsar
						</a>".($uid==$capitan?"":"<a href='capitan/equipo/$id/$uid' class='button primary makeCapitan'>
							Hacer Capitan
						</a>");
			$nombre = $usuario['nombres']." ".$usuario['apellidos'].($uid==$capitan?" [c]":"");
			$correo = $usuario['correo'];
			$msg .= "<tr>
						<td>$nombre</td>
						<td>$correo</td>
						<td>
							$botones
						</td>
					</tr>";
		}

		$usuarios = $db->select("usuario", "*");
		$sel = "<option>Selecciona Jugador</option>";
		foreach ($usuarios as $usuario) {
			if (!in_array($usuario['id'], $ids)) {
				$sel .= "<option value='".$usuario['id']."'>".$usuario['nombres']." ".$usuario['apellidos']." - ".$usuario['correo']."</option>";
			}
		}
		$json['select'] = $sel;
		$json['data'] = $msg;
		return $json;
	}

	function push_equipo() {
		$json = array();
		$json['title'] = "Agregado";
		$json['msg'] = "El jugador ha sido agregado con éxito";
		$json['success'] = true;

		if (json['success']) {
			$db = new medoo();

			$last_user_id = $db->insert("equipo_usuario", [
										"equipo" => $_POST['equipo'],
										"usuario" => $_POST['jugador']
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

	function pop_equipo() {
		$json = array();
		$json['title'] = "Expulsado";
		$json['msg'] = "El jugador ha sido expulsado con éxito";
		$json['success'] = true;

		if (json['success']) {
			$db = new medoo();

			$db->delete("equipo_usuario", [
							"AND"=>[
								"usuario" => $_GET['uid'],
								"equipo" => $_GET['id']
								]
						]);

		}

		return $json;
	}

	function capi_equipo() {
		$json = array();
		$json['title'] = "Expulsado";
		$json['msg'] = "El jugador ha sido expulsado con éxito";
		$json['success'] = true;

		if (json['success']) {
			$db = new medoo();

			$db->update("equipo", 
						[
							"capitan" => $_GET['uid']
						],
						[
							"id" => $_GET['id']
						]);

		}

		return $json;
	}

	function gen_dates() {
		$json = array("title" => "");
		return json;
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
		case 'getcal':
			$json = $libs->draw_cal($_POST['month'], $_POST['year']);
			break;
		case 'gendates':
			$json = $libs->gen_dates();
			break;
		case 'getarbitros':
			$json = $libs->get_arbitros();
			break;
		case 'getarbitro':
			$json = $libs->get_arbitro();
			break;
		case 'getequipo':
			$json = $libs->get_equipo();
			break;
		case 'getusers':
			$json = $libs->get_users();
			break;
		case 'getequipos':
			$json = $libs->get_equipos();
			break;
		case 'addarbitro':
			$json = $libs->add_arbitro();
			break;
		case 'addequipo':
			$json = $libs->add_equipo();
			break;
		case 'deletearbitro':
			$json = $libs->delete_arbitro();
			break;
		case 'deleteequipo':
			$json = $libs->delete_equipo();
			break;
		case 'listequipos':
			$json = $libs->list_equipos();
			break;
		case 'equipotable':
			$json = $libs->equipo_table();
			break;
		case 'pushequipo':
			$json = $libs->push_equipo();
			break;
		case 'popequipo':
			$json = $libs->pop_equipo();
			break;
		case 'capiequipo':
			$json = $libs->capi_equipo();
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