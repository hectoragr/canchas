<?php
/**
* 
*/
session_start();
setlocale(LC_ALL, "es_ES");
date_default_timezone_set('America/Mexico_City');
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
		$select = "";
		foreach ($usuario as $user) {
			$nombre = $user['nombres']." ".$user['apellidos'];
			$id = $user['id'];
			$select .= "<option value='$id'>$nombre</option>";
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
		$json['select'] = $select;
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
			if (!isset($_POST['excepto']) || $_POST['excepto'] != $user['id']) {
				$msg .= "<option value='".$user['id']."'>".$user['nombre']."</option>";
			}
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

	function get_horario_canchas() {
		$json = array();
		$table = "";
		if (!isset($_POST['year']) || empty($_POST['year']) || !isset($_POST['month']) || empty($_POST['month']) || !isset($_POST['day']) || empty($_POST['day'])) {
			$json['error'] = true;
			$json['msg'] = "Fecha no válida";
		}

		if (!$json['error']) {
			$db = new medoo();
			$date = $_POST['year']."-".$_POST['month']."-".str_pad($_POST['day'], 2, "0", STR_PAD_LEFT);
			$horas = array(8,9,10,11,12,13,14,15,16,17,18,19);
			$canchas = $db->select("cancha", "*");
			foreach ($canchas as $key => $cancha) {
				$tipo = $db->get("tipo_cancha", ["nombre"], ["id"=>$cancha['tipo']]);
				$tipo = $tipo['nombre'];
				$cid = $cancha['nombre'];
				$nombre = "Cancha: ".$tipo." - ".$cid;
				$table .= "<div class='col-6'>
							<table>
								<thead>
			                      <tr>
			                        <td colspan='3'>
			                          $nombre
			                        </td>
			                      </tr>
			                      <tr>
			                        <th>
			                          Hora
			                        </th>
			                        <th>
			                          Partido
			                        </th>
			                        <th>
			                          Acciones
			                        </th>
			                      </tr>
			                    </thead>
			                    <tbody>";
				foreach ($horas as $hora) {

					$inicio = date("Y-m-d H:i:s", mktime($hora, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
					$fin = date("Y-m-d H:i:s", mktime($hora + 1, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
					$hoy = date("Y-m-d H:i:s");
					$json['ahorita'] = $hoy;
					$timeslot = $db->get("partido", "*", ["AND" => ["cancha" => $cancha['id'], "hora_inicio" => $inicio, "hora_fin" => $fin, "estatus[!]" => 0]]);
					if (empty($timeslot)){
						$table .= "<tr>
							<td class='col-4'>
							".date("H:i",mktime($hora, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']))." - ".date("H:i", mktime($hora+1, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']))."
							</td>
							<td class='col-4'>".($inicio < $hoy?"No utilizado":"Libre")."</td>
							<td class='col-4'>
								".($inicio < $hoy?"":"<a href='#agendar' class='button primary agendarPartido' data-hora='$hora' data-cancha='".$cancha['id']."' >Agendar partido</a>")."
							</td>
						</tr>";
					}else {
						$equipo1 = $db->get("equipo", "*", ["id" => $timeslot['local']]);
						$equipo2 = $db->get("equipo", "*", ["id" => $timeslot['visitante']]);
						if(!empty($timeslot['resultado'])){
							$goles = explode("|", $timeslot['resultado']);
						}
						$table .= "<tr>
							<td class='col-4'>
							".date("H:i",mktime($hora, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']))." - ".date("H:i", mktime($hora+1, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']))."
							</td>
							<td class='col-4'>
								".(isset($goles[0])?"<b>".$goles[0]."</b> ":"").$equipo1['nombre']." vs ".$equipo2['nombre'].(isset($goles[1])?" <b>".$goles[1]."</b>":"")."
							</td>
							<td class='col-4'>";
								
						if ($inicio > $hoy) {
							$table .= "<a href='cancelar/partido/".$cancha['id']."/".$hora."' class='button danger cancelPartido'>Cancelar partido</a>";
						}else if(empty($timeslot['resultado'])){
							$table .= "<a href='#resultadopartido' class='button warning resultadoPartido' data-partido='".$timeslot['id']."' data-local='".$equipo1['nombre']."' data-visitante='".$equipo2['nombre']."'>Resultado partido</a>";
						}
								
						$table .= "</td>
							</tr>";
					}
				}
				$table .= "</tbody>
						</table>
					</div>";
				if ($key%2 != 0) {
					$table .= "<div class='clear'></div>";
				}
			} //end foreach canchas
		}
		$json['data'] = $table;
		return $json;
	}

	function cancelar_partido() {
		$json = array();
		if (!isset($_POST['year']) || empty($_POST['year']) || !isset($_POST['month']) || empty($_POST['month']) || !isset($_POST['day']) || empty($_POST['day'])) {
			$json['error'] = true;
			$json['msg'] = "Fecha no válida";
		}
		$count = 0;
		if (!$json['error']) {
			$db = new medoo();
			$hora = $_GET['hora'];
			$date = $_POST['year']."-".str_pad($_POST['month'], 2, "0", STR_PAD_LEFT)."-".str_pad($_POST['day'], 2, "0", STR_PAD_LEFT);
			$inicio = date("Y-m-d H:i:s", mktime($hora, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
			$fin = date("Y-m-d H:i:s", mktime($hora + 1, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
			$vars = array($_GET['cancha'], $date, $inicio, $fin);
			$count = $db->update("partido", 
						["estatus" => 0], 
						["AND" => ["cancha" => $_GET['cancha'], 
								    
								   "hora_inicio" => $inicio, 
								   "hora_fin" => $fin]
						]);
			//die(print_r($vars));
		}
		$json['data'] = $count;

		return $json;
	}

	function get_canchas() {
		$json = array();
		$db = new medoo();
		$canchas = $db->select("cancha", 
							   ["[>]tipo_cancha" => ["tipo" => "id"]],
							   ["cancha.id", 
							   	"cancha.nombre(nombre)", 
							   	"tipo_cancha.nombre(tipo)"],
							   	["cancha.id[>]" => 0]);
		$select = "";
		foreach ($canchas as $cancha) {
			$select .= "<option value='".$cancha['id']."'>".$cancha['tipo']." - ".$cancha['nombre']."</option>";
		}
		$json['data'] = $select;
		return $json;
	}

	function agendar_partido() {
		$json = array('success' => true, 'msg' => 'Agendado con éxito', 'title' => 'Agendado');

        if (!isset($_POST['year']) || empty($_POST['year']) || !isset($_POST['month']) || empty($_POST['month']) || !isset($_POST['day']) || empty($_POST['day'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Fecha no válida";
        }

        if (!isset($_POST['arbitro']) || empty($_POST['arbitro'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Arbitro no seleccionado";
        }

        if (!isset($_POST['local']) || empty($_POST['local'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Equipo local no seleccionado";
        }

        if (!isset($_POST['visitante']) || empty($_POST['visitante'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Equipo visitante no seleccionado";
        }

        if (!isset($_POST['cancha']) || empty($_POST['cancha'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Cancha no seleccionada";
        }

        if (!isset($_POST['horario']) || empty($_POST['horario'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Horario no seleccionado";
        }

        if ($json['success']) {
        	$db = new medoo();
        	$hora = $_POST['horario'];
        	$date = $_POST['year']."-".$_POST['month']."-".str_pad($_POST['day'], 2, "0", STR_PAD_LEFT);
        	$inicio = date("Y-m-d H:i:s", mktime($hora, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
			$fin = date("Y-m-d H:i:s", mktime($hora + 1, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
			$hoy = date("Y-m-d H:i:s");
			if ($inicio < $hoy) {
				$json['success'] = false;
	        	$json['title'] = "Error";
	        	$json['msg'] = "Horario del pasado";
			}else {
				$timeslot = $db->get("partido", 
									 "id", 
									 ["AND" => ["cancha" => $_POST['cancha'], 
									 		    "hora_inicio" => $inicio, 
									 		    "hora_fin" => $fin]]);
				
				if (!empty($timeslot)) {
					$json['success'] = false;
		        	$json['title'] = "Error";
		        	$json['msg'] = "Horario ya reservado";
				}else {
					$vars = array("date" => $date,
								  "hora_inicio" => $inicio,
								  "hora_fin" => $fin,
								  "cancha" => $_POST['cancha'],
								  "local" => $_POST['local'],
								  "visitante" => $_POST['visitante'],
								  "arbitro" => $_POST['arbitro']);
					// die(print_r($vars));
					$last_insert_id = $db->insert("partido", 
												  ["fecha" => $date,
												   "hora_inicio" => $inicio,
												   "hora_fin" => $fin,
												   "cancha" => $_POST['cancha'],
												   "local" => $_POST['local'],
												   "visitante" => $_POST['visitante'],
												   "arbitro" => $_POST['arbitro'],
												   "estatus" => 1]);
				}
			}
        }

		return $json;
	}

	function resultado_partido() {
		$json = array('success' => true, 'msg' => 'Guardado con éxito', 'title' => 'Guardado');
		

		if ( !isset($_POST['partido']) ||
			empty($_POST['partido']) ||
			!isset($_POST['local']) ||
			empty($_POST['local']) ||
			!isset($_POST['visitante']) ||
			empty($_POST['visitante'])
			) {
			$json['success'] = false;
			$json['title'] = "Error";
			$json['msg'] = "Resultados no válidos";
		}

		if ($json['success']) {
			$db = new medoo();
			$resultado = $_POST['local']."|".$_POST['visitante'];
			$db->update("partido", ["resultado" => $resultado], ["id" => $_POST['partido']]);
		}

		return $json;
	}

	function get_juegos_capitan() {
		$id = $_SESSION['user']['id'];
		$db = new medoo();
		$equipos = $db->select("equipo", "*", ["capitan" => $id]);
		$table = "";
		foreach ($equipos as $equipo) {
			$eid = $equipo['id'];
			$partidos = $db->select("partido", 
									"*", 
									["OR" => ["local" => $eid, "visitante" => $eid]]);
			
			foreach ($partidos as $partido) {
				$cancha = $db->get("cancha", "*", ["id" => $partido['cancha']]);
				$tipocancha = $db->get("tipo_cancha", "*", ["id" => $cancha["tipo"]]);
				$local = $db->get("equipo", "*", ["id" => $partido['local']]);
				$visitante = $db->get("equipo", "*", ["id" => $partido['visitante']]);
				$arbitro = $db->get("arbitro", "*", ["id" => $partido['arbitro']]);
				$time = explode(" ", $partido['horario_inicio']);
				$day = explode("-", $time[0]);
				$hours = explode(":", $time[1]);
				$hora = $hours[0];
				$inicio = date("Y-m-d H:i:s", mktime($hours[0], 0, 0, $day[2], $day[1], $day[0]));
				$hoy = date("Y-m-d H:i:s");
				$table .= "<tr>";
				$table .= "<td>".$tipocancha['nombre']." - ".$cancha['nombre']."</td>";
				$table .= "<td>".$local['nombre']." vs ".$visitante['nombre']."</td>";
				$table .= "<td>".date("d M Y", strtotime($partido['fecha']))."</td>";
				$table .= "<td>".date("H:i", strtotime($partido['hora_inicio']))." - ".date("H:i", strtotime("+1 hour", strtotime($partido['hora_inicio'])))."</td>";
				$table .= "<td>".$arbitro['nombres']." ".$arbitro['apellidos']."</td>";
				if ($partido["estatus"] == 1 && $hoy >= $inicio) {
					$table .= "<td>
								<a href='#updatejuego' data-juego='".$partido['id']."' class='button warning cambiarJuego'>Re-agendar</a>
								<a href='cancelar/partido/".$partido['id']."/".date("G", strtotime($partido['hora_inicio']))."' class='button danger cancelPartido'>Cancelar</a>
							   </td>";
				}else if($partido["estatus"] == 2) {
					$table .= "<td> Esperando aprobación de cambio </td>";
				}else if($partido["estatus"] == 0){
					$table .= "<td> Cancelado </td>";
				}else {
					$table .= "<td> --- </td>";
				}

				$table .= "</tr>";
			}
		}
		$json['data'] = $table;
		return $json;
	}

	function get_juegos() {
		$json = array();
		$id = $_SESSION['user']['id'];
		$db = new medoo();
		$table = "";
		$equipos = $db->select("equipo_usuario",
								["[>]equipo" => ["equipo"=>"id"]
								 ], 
								["equipo.capitan","equipo_usuario.equipo", "equipo.id"], 
								["AND" => ["capitan[!]" => $id, "usuario" => $id]]);
		foreach ($equipos as $equipo) {
			$eid = $equipo['id'];
			$partidos = $db->select("partido", 
									"*", 
									["OR" => ["local" => $eid, "visitante" => $eid]]);
			
			foreach ($partidos as $partido) {
				$cancha = $db->get("cancha", "*", ["id" => $partido['cancha']]);
				$tipocancha = $db->get("tipo_cancha", "*", ["id" => $cancha["tipo"]]);
				$local = $db->get("equipo", "*", ["id" => $partido['local']]);
				$visitante = $db->get("equipo", "*", ["id" => $partido['visitante']]);
				$arbitro = $db->get("arbitro", "*", ["id" => $partido['arbitro']]);
				$time = explode(" ", $partido['horario_inicio']);
				$day = explode("-", $time[0]);
				$hours = explode(":", $time[1]);
				$inicio = date("Y-m-d H:i:s", mktime($hours[0], 0, 0, $day[2], $day[1], $day[0]));
				$hoy = date("Y-m-d H:i:s");
				$table .= "<tr>";
				$table .= "<td>".$tipocancha['nombre']." - ".$cancha['nombre']."</td>";
				$table .= "<td>".$local['nombre']." vs ".$visitante['nombre']."</td>";
				$table .= "<td>".date("d M Y", strtotime($partido['fecha']))."</td>";
				$table .= "<td>".date("H:i", strtotime($partido['hora_inicio']))." - ".date("H:i", strtotime("+1 hour", strtotime($partido['hora_inicio'])))."</td>";
				$table .= "<td>".$arbitro['nombres']." ".$arbitro['apellidos']."</td>";

				$table .= "</tr>";
			}
		}

		$json['data'] = $table;
		return $json;
	}

	function update_juego() {
		$json = array('success' => true, 'msg' => 'Solicitud enviada con éxito', 'title' => 'Enviada');

        if (!isset($_POST['year']) || empty($_POST['year']) || !isset($_POST['month']) || empty($_POST['month']) || !isset($_POST['day']) || empty($_POST['day'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Fecha no válida";
        }

        if (!isset($_POST['cancha']) || empty($_POST['cancha'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Cancha no seleccionada";
        }

        if (!isset($_POST['horario']) || empty($_POST['horario'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Horario no seleccionado";
        }

        if (!isset($_POST['id']) || empty($_POST['id'])) {
        	$json['success'] = false;
        	$json['title'] = "Error";
        	$json['msg'] = "Juego no seleccionado";
        }

        if ($json['success']) {
        	$db = new medoo();
        	
        	$date = $_POST['year']."-".str_pad($_POST['month'], 2, "0", STR_PAD_LEFT)."-".str_pad($_POST['day'], 2, "0", STR_PAD_LEFT);
        	$inicio = date("Y-m-d H:i:s", mktime($_POST['horario'], 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
        	$fin = date("Y-m-d H:i:s", mktime($_POST['horario']+1, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));


        	$ocupado = $db->get("partido", "*", ["AND" => ["cancha" => $_POST['cancha'], "hora_inicio" => $inicio, "estatus[>]" => 0]]);

        	if (!empty($ocupado)) {
        		$json['success'] = false;
	        	$json['title'] = "Error";
	        	$json['msg'] = "Horario ocupado";
        	}else {
        		$partido = $db->get("partido", "*", ["id" => $_POST['id']]);
        		$last_insert_id = $db->insert("cambio", 
        									  ["partido" => $_POST['id'], 
        									   "solicita" => $_SESSION['user']['id'],
        									   "aprobado" => 0,
        									   "viejo_horario" => $partido['hora_inicio'],
        									   "vieja_cancha" => $partido['cancha'],
        									   "link" => sha1($_POST['id']."-".$_SESSION['user']['id'])
        									  ]);
        		$local = $db->get("equipo", "*", ["id" => $partido['local']]);
        		$visitante = $db->get("equipo", "*", ["id" => $partido['visitante']]);
        		if ($_SESSION['user']['id'] == $local['capitan']) {
        			$otro = $db->get("usuario", "*", ["id" => $visitante['capitan']]);
        		}else {
        			$otro = $db->get("usuario", "*", ["id" => $local['capitan']]);
        		}
        		$urlacepto = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/canchas/cambio/".$otro['id']."/".sha1($_POST['id']."-".$_SESSION['user']['id'])."/yes";
        		$urlcancel = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/canchas/cambio/".$otro['id']."/".sha1($_POST['id']."-".$_SESSION['user']['id'])."/no";
        		$mail = $otro['correo'];
        		$titulo = "Solicitud de cambio";
        		$mensaje = "<hmtl>
        					<body>
        					<p>
        						Estimado, ".ucwords($otro['nombres'])."
        					</p>
        					<p>
        						El capitán de tu partido programado para las: ".$partido['hora_inicio']." ha solicitado un cambio para el horario ".$inicio.".
        					</p>
        					<p>
        						Si deseas aceptar este cambio da click al siguiente enlace:
        						<a href='".$urlacepto."'>Acepto el cambio</a>
        					</p>
        					<p>
        						En caso contrario da click en este enlace para dejar el horario anterior:
        						<a href='".$urlcancel."'>NO acepto el cambio</a>
        					</p>
        					</body>
        					</html>";

        		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				@mail($mail, $titulo, $mensaje, $cabeceras);
        		$db->update("partido", ["hora_inicio" => $inicio, "hora_fin" => $fin, "fecha" => $date, "cancha" => $_POST['cancha'], "estatus" => 2], ["id" => $_POST['id']]);

        	}
        }

        return $json;
	}

	function set_cambio() {
		$db = new medoo();
		$cambio = $db->get("cambio", "*", ["link" => $_GET['link']]);

		if ($_GET['resp'] == "yes") {
			$db->update("partido", ["estatus" => 1], ["id" => $cambio['partido']]);
			$db->update("cambio", ["aprobado" => $_GET['uid']], ["id"=> $cambio['id']]);
			die("Cambio realizado");
		}else {
			die("Fuuuu");
		}
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
		case 'getHorarioCanchas':
			$json = $libs->get_horario_canchas();
			break;
		case 'cancelarpartido':
			$json = $libs->cancelar_partido();
			break;
		case 'getcanchas':
			$json = $libs->get_canchas();
			break;
		case 'agendarpartido':
			$json = $libs->agendar_partido();
			break;
		case 'resultadopartido':
			$json = $libs->resultado_partido();
			break;
		case 'getjuegoscapitan':
			$json = $libs->get_juegos_capitan();
			break;
		case 'getjuegos':
			$json = $libs->get_juegos();
			break;
		case 'updatejuego':
			$json = $libs->update_juego();
			break;
		case 'setcambio':
			$json = $libs->set_cambio();
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