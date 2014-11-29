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

	function gen_dates() {
		$json = array("title" => );
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
		default:
			$json = array("error" => true, "msg" => "Not found.");
			break;
	}
	echo json_encode($json);
}else {
	die("Acción no definida");
}

?>